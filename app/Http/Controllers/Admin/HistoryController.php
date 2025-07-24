<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;

class HistoryController extends BaseController
{
    //
    public function betting_history(Request $request)
    {
        $page_title = '배팅내역';

        $authUser = \Auth::guard('admin')->user();
        $identity = $request->query('identity');
        $name = $request->query('name');
        $status = $request->query('status');
        $reverse = $request->query('reverse');
        $game_id = $request->query('game_id');

        // History + users + games 조인
        $histories = History::query()
            ->select('histories.*', 'users.identity', 'users.name', 'games.game as game_title')  // 필요한 컬럼 추가
            ->leftJoin('users', 'histories.user_id', '=', 'users.id')  // user join
            ->leftJoin('games', 'histories.game_id', '=', 'games.id'); // game join

        if (!empty($identity)) {
            $histories = $histories->where('users.identity', 'LIKE', '%' . $identity . '%');
        }

        if (!empty($name)) {
            $histories = $histories->where('users.name', 'LIKE', '%' . $name . '%');
        }

         if (is_numeric($reverse)) {
            $histories = $histories->where('histories.reverse', $reverse);
        }

        if ($game_id !== null) {
            $histories = $histories->where('histories.game_id', $game_id); // depowiths는 오타일 가능성 있음
        }

        if ($status !== null) {
            $histories = $histories->where('histories.status', $status); 
        }

        $histories = $histories->orderBy('histories.created_at', 'DESC')->paginate(20);

        return view('admin.history.index', compact('page_title', 'histories', 'game_id','status', 'identity', 'name','reverse'));
    }
    public function process(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level < 0) {
            session()->flash('error', '귀하의 권한이 부족합니다.');
            return redirect()->back();
        }
        $history = History::where('id', $id)->first();
        if (!$history) {
            session()->flash('error', '배팅내역이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('post')) {
            $param = $request->param;
            switch ($param) {                
                case 'delete':
                    session()->flash('success', '배팅내역을 삭제하였습니다.');
                    $history->delete();
                    break;
            }

            if ($param != 'delete') {
                $history->updated_at = date('Y-m-d H:i:s');
                $history->save();
            }
            
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $page_title = '배팅내역 수정';
        $authUser = \Auth::guard('admin')->user();
      
        $history = History::where('id', $id)->first();
        if (!$history) {
            session()->flash('error', '배팅내역이 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('put')) {
            $history->list = $request->list;
            $history->bonus = $request->bonus;
          
            $history->save();

            session()->flash('success', '배팅내역을 수정했습니다.');
        }
       
        return view('admin.history.edit', compact('page_title', 'history'));
    }
}
