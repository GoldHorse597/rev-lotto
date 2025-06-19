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

        return view('admin.dashboard.index', compact('page_title', 'searchAgent'));
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
            
            return response()->json(['success' => true, 'msg' => '', 'data' => [
                'new_inquiries_cnt' => $new_inquiries_cnt,
                'new_users_cnt' => $new_users_cnt,
                'online_users_cnt' => $online_users_cnt
            ]]);
        }
        else {
            $new_messages_cnt = Message::where(['receiver_id' => $authUser->id, 'receiver_type' => 0, 'status' => 0])->count();
            $inquiry_ids = Inquiry::where(['sender_id' => $authUser->id, 'sender_type' => 0])->pluck('id');
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
}
