<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;
use App\Models\Setting;
use App\Models\Agent;
use App\Models\User;
use App\Models\Message;
use App\Models\Inquiry;
use App\Models\Depowith;
use App\Models\History;
use App\Models\Prize;

class DashboardController extends BaseController
{
    //
    public function __construct()
    {
        parent::__construct();        
    }

    public function index(Request $request)
    {
        $page_title = '대시보드';

        $authUser = \Auth::guard('admin')->user();

        $searchAgent = $request->searchAgent;
        if (empty($searchAgent))
            $searchAgent = $authUser;
        else
            $searchAgent = Agent::where('id', $searchAgent)->where('ancestry', 'LIKE', $authUser->ancestry.$authUser->id.'/%')->first();
        if (!$searchAgent) {
            session()->flash('error', '에이전트가 존재하지 않습니다.');
            return abort(404);
        }

        $todayUser = User::whereDate('created_at', Carbon::today())->count();
        $totaldepo = Depowith::where('type', 0)
            ->where('status', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalwith =Depowith::where('type', 1)
            ->where('status', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalmoney =History::whereDate('created_at', Carbon::today())
            ->sum('amount');
        $totalprize = Prize::whereDate('created_at', Carbon::today())
                ->where('type', 1)
                ->where('title', 'not like', '%관리자%')
                ->sum('money');
        return view('admin.dashboard.index', compact('page_title', 'searchAgent','todayUser','totaldepo','totalwith','totalmoney','totalprize'));
    }

    public function tick(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();

        $lastActivityTime = session()->get('lastActivityTime');
        $expireTime = 60 * 15;
        if ($authUser->parent_level == 0) 
            $expireTime = 60 * 10;
        if ((time() - $lastActivityTime) > 60 * $expireTime) {
            \Session::flush();
            \Auth::guard('admin')->logout();

            return response()->json(['success' => true, 'logout' => true, 'reason' => 'inactivity'], 200);
        }

        if ($authUser->parent_level == 0) {
            $new_inquiries_cnt = Inquiry::where(['referer_id' => 0, 'status' => 0])->count();
            $new_users_cnt = User::where(['status' => 0])->count();
            $online_users_cnt = User::where(function ($condition) use ($authUser) {
                        $condition->where('last_access_at', '>=', Carbon::now()->subSeconds(20));
                    })->count();
            $new_statistics_cnt = Depowith::where(['status' => 0])->count();
            return response()->json(['success' => true, 'msg' => '', 'data' => [
                'new_inquiries_cnt' => $new_inquiries_cnt,
                'new_users_cnt' => $new_users_cnt,
                'new_statistics_cnt' => $new_statistics_cnt,
                'online_users_cnt' => $online_users_cnt
            ]]);
        }
        else {
            $new_messages_cnt = Message::where(['receiver_id' => $authUser->id, 'receiver_type' => 0, 'status' => 0])->count();
            $inquiry_ids = Inquiry::where(['sender_id' => $authUser->id])->pluck('id');
            $new_inquiries_cnt = Inquiry::whereIn('referer_id', $inquiry_ids)->where('status', 0)->count();
            $online_users_cnt = User::where('ancestry', 'LIKE',  $authUser->ancestry.$authUser->id.'/%')
                    ->where(function ($condition) use ($authUser) {
                        $condition->where('last_access_at', '>=', Carbon::now()->subSeconds(20));
                    })->count();

            return response()->json(['success' => true, 'msg' => '', 'data' => [
                'new_messages_cnt' => $new_messages_cnt,
                'new_inquiries_cnt' => $new_inquiries_cnt,
                'online_users_cnt' => $online_users_cnt
            ]]);
        }

        return response()->json(['success' => true, 'msg' => '', 'data' => []]);
    }

    public function setting(Request $request)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level == 0) {
            $setting = Setting::first();
            $site_closed = $request->site_closed;
            if (!is_null($site_closed))
                $setting->site_closed = $site_closed;
            
            $setting->closed_start_time = $request->closed_start_time;
            $setting->closed_end_time = $request->closed_end_time;
           
            $setting->user_forbidden_ip = $request->user_forbidden_ip;
            $setting->admin_forbidden_ip = $request->admin_forbidden_ip;

            $is_auto_withdraw = $request->is_auto_withdraw;
            if (!is_null($is_auto_withdraw))
                $setting->is_auto_withdraw = $is_auto_withdraw;
            $setting->save();

            return response()->json(['success' => true, 'msg' => '']);
        }

        return response()->json(['success' => false, 'msg' => '']);
    }

    public function statistics(Request $request)
    {
        $page_title = '입출금관리';
        $identity = $request->query('identity');
        $type = $request->query('type');
        $status = $request->query('status');
        $query = \DB::table('depowiths')
            ->join('users', 'depowiths.user_id', '=', 'users.id')
            ->select('depowiths.*', 'users.identity','users.name') ->orderBy('created_at', 'desc');

        if (!empty($identity)) {
            $userIds = User::where('identity', 'like', '%' . $identity . '%')->pluck('id');
            if ($userIds->count() > 0) {
                $query->whereIn('depowiths.user_id', $userIds);
            } else {
                $query->whereRaw('1=0'); // 없는 경우 빈 결과
            }
        }
        if ($type !== null) {
            $query->where('depowiths.type', $type);
        }
        if ($status !== null) {
            $query->where('depowiths.status', $status);
        }

        $statistics = $query->paginate(20);
        $total = $query->clone()->count();
        $reqDeposit  = Depowith::where('status',0)->where('type',0)->sum('amount');
        $reqWithdrawal  = Depowith::where('status',0)->where('type',1)->sum('amount');
        $totalWithdrawal  = Depowith::where('status',1)->where('type',1)->sum('amount');
        $totalDeposit  = Depowith::where('status',1)->where('type',0)->sum('amount');
        return view('admin.dashboard.statistics', compact('statistics', 'page_title', 'total', 'identity','type','status','reqDeposit','reqWithdrawal','totalDeposit','totalWithdrawal'));
    }
    public function process(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level < 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }
        $statistic = Depowith::where('id', $id)->first();
        if (!$statistic) {
            session()->flash('error', '내역이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('post')) {
            $param = $request->param;
            switch ($param) {
                case 'approve':
                    session()->flash('success', '신청을 승인하였습니다.');
                    $statistic->status = 1;
                    $user = User::where('id', $statistic->user_id)->first();
                    if($statistic->type == 0)
                        $user->amount = $user->amount + $statistic->amount;
                    // else
                    //     $user->amount = $user->amount - $statistic->amount;
                   
                    // $total  = Depowith::where('user_id',$user->id)->where('type', 0)->where('status', 1)->sum('amount');
                    // if ($total < 5000000) {
                    //     $user->level = 0;
                    // } elseif ($total < 30000000) {
                    //    $user->level = 1;
                    // } else {
                    //     $user->level = 2;
                    // }
                    $user->save();
                    break;
                case 'block':
                    session()->flash('success', ' 신청을 취소하였습니다.');
                    if($statistic->type == 1)
                        $user->amount = $user->amount + $statistic->amount;
                    $statistic->status = 2;                   
                    break;
               
                case 'delete':
                    session()->flash('success', ' 신청을 삭제하였습니다.');
                    $statistic->delete();                    
                    break;
            }

            if ($param != 'delete') {
                $statistic->updated_at = date('Y-m-d H:i:s');
                $statistic->save();
            }
            
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
