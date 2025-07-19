<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Depowith;
use App\Models\Message;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class MypageController extends BaseController
{
    //
    public function deposit(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $query = Depowith::where('user_id',$authUser->id)->where('status', 0)->where('type', 0)->orderBy('created_at', 'DESC');       
        $items = $query->paginate(10);
        $type = 1;
        $title = "입금신청";
        return view('web.mypage.request',compact('items','type','title'));
    }
    public function postDeposit(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $deposit = new Depowith;     
        $deposit->user_id = $authUser->id;
        $deposit->amount =  str_replace(',', '', $request->amount);;
        $deposit->status = 0;
        $deposit->type = 0;   
        $deposit->save();          
        return redirect()->route('mypage.deposit');
    }
    public function withdrawal(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $query = Depowith::where('user_id',$authUser->id)->where('status', 0)->where('type', 1)->orderBy('created_at', 'DESC');       
        $items = $query->paginate(10);
        $type = 2;
        $title = "출금신청";
        return view('web.mypage.request',compact('items','type','title'));
    }
    public function postWithdrawal(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $deposit = new Depowith;     
        $deposit->user_id = $authUser->id;
        $deposit->amount =  str_replace(',', '', $request->amount);;
        $deposit->status = 0;
        $deposit->type = 1;   
        $deposit->save();          
        return redirect()->route('mypage.withdrawal');
    }
    public function depoWith(Request $request){
        $authUser = \Auth::guard('web')->user();
        $query = Depowith::where('user_id',$authUser->id)->where('status','!=', 0)->orderBy('created_at', 'DESC');       
        $items = $query->paginate(10);
        $type = 3;
        $title = "입출금내역";
        return view('web.mypage.request',compact('items','type','title'));
    }
    public function message(request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $query = Message::where('user_id',$authUser->id)->where('status','!=', 2)->orderBy('created_at', 'DESC'); 
        $title = $request->title;
        if (!empty($request->title))
            $query = $query->where('title', 'LIKE', '%'.$request->title.'%');
        $totalCnt = $query->count();
        $messages = $query->paginate(10);
        return view('web.mypage.message',compact('messages','title','totalCnt'));
    }
    public function delete(request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $query = Message::where('user_id',$authUser->id)->where('status','!=', 2)->where('id',$request->id)->first();
        if (empty($query))
             return response()->json(['success' => false, 'msg' => '쪽지가 존재하지 않습니다.']);
        $query->status = 2;
        $query->save();
        return redirect()->route('mypage.message');
    }
    public function messageView(request $request){
        $authUser = \Auth::guard('web')->user();
        $id = $request->id;

        // 현재 쪽지
        $item = Message::where('id', $id)
            ->where('user_id', $authUser->id)
            ->first();

        if (empty($item)) {
            // 쪽지가 없으면 리턴 (예: 다른 유저의 쪽지 ID 입력했을 때)
            return redirect()->route('web.mypage.message')->withErrors('쪽지가 존재하지 않습니다.');
        }

        // 다음 쪽지
        $next = Message::where('user_id', $authUser->id)
            ->where('id', '>', $id)
            ->orderBy('id', 'asc')
            ->first();

        // 이전 쪽지
        $prev = Message::where('user_id', $authUser->id)
            ->where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();

        $type_name = "쪽지";

        // 읽음처리
        $item->status = 1;
        $item->save();

        return view('web.mypage.view', compact('type_name', 'item', 'next', 'prev'));
    }

    public function modify(request $request){
         return view('web.mypage.modify');
    }

    public function buyList(request $request){

        $authUser = \Auth::guard('web')->user();
        $part_idx = $request->part_idx;
       
        $games = Game::all();
        $query = DB::table('histories')
            ->where('histories.user_id', $authUser->id)
            ->join('games', 'histories.game_id', '=', 'games.id')
            ->select('histories.*', 'games.game as game') // histories의 모든 필드 + games.name
            ->orderBy('histories.created_at', 'desc');
        if (!empty($part_idx)) {
            $query->where('histories.game_id', $part_idx);
        }
        $lists = $query->paginate(10);
        return view('web.mypage.buylist', compact('lists','games','part_idx'));
    }  

}
