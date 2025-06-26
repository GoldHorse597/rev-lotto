<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Game;

class LottoController extends BaseController
{
    public function game(Request $request){
        $page_title = '로또 목록';

        $authUser = \Auth::guard('admin')->user();
        $games = Game::all();
    
        return view('admin.lotto.game', compact('page_title', 'games'));

    }
    public function create(Request $request){
        $page_title = '로또 추가';

        $authUser = \Auth::guard('admin')->user();
        $game = new Game;

        $game->game = $request->game;
        $game->abbr = $request->abbr;
        $game->weekday = $request->weekday; 
        $game->lastresult = $request->lastresult;
        $game->bonus = $request->bonus;
        $game->save();
    
        return redirect()->route('admin.lotto.game');

    }
     public function edit(Request $request, $id)
    {
        $page_title = '로또 수정';
        $authUser = \Auth::guard('admin')->user();
      
        $game = Game::where('id', $id)->first();
        if (!$game) {
            session()->flash('error', '로또가 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('put')) {
            $game->game = $request->game;
            $game->abbr = $request->abbr;
            $game->weekday = $request->weekday; 
            $game->lastresult = $request->lastresult;
            $game->bonus = $request->bonus;
          
            $game->save();

            session()->flash('success', '로또 '.$game->game.'를 수정했습니다.');
        }
       
        return view('admin.lotto.edit', compact('page_title', 'game'));
    }

    public function process(Request $request, $id)
    {
        $authUser = \Auth::guard('admin')->user();
       
        $game = Game::where('id', $id)->first();
        if (!$game) {
            session()->flash('error', '로또가 존재하지 않습니다.');
            return abort(404);
        }
        if ($request->isMethod('post')) {
            $param = $request->param;
            switch ($param) {               
                case 'delete':
                    session()->flash('success', $game->game.' 님의 계정을 삭제하였습니다.');
                    $game->delete();
                    break;
            }

            if ($param != 'delete') {
                $game->updated_at = date('Y-m-d H:i:s');
                $game->save();
            }
            
            return redirect()->back();
        }

        session()->flash('error', '비법적인 호출입니다.');
        return redirect()->back();
    }
}
