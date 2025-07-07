<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\History;
use App\Models\Game;
use App\Models\Purchase;

class PlayController extends Controller
{
    public function lotto_live(){
        $title = "실시간로또";
        $num = 69;
        $num1 = 26;
        $normal = 6;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',1)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_kr(){
        $title = "로또6/45(한국)";
        $num = 45;
        $num1 = 26;
        $normal = 6;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',2)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_pb(){
        $title = "파워볼(미국)";
        $num = 69;
        $num1 = 26;
        $normal = 5;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',4)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_mm(){
        $title = "메가밀리언(미국)";
        $num = 70;
        $num1 = 25;
        $normal = 5;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',3)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_dlt(){
        $title = "따루토(중국)";
        $num = 35;
        $num1 = 12;
        $normal = 5;
        $bonus = 2;
        $reverse = 0;
        $game = Game::where('id',6)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_ssq(){
        $title = "쌍색구(중국)";
        $num = 133;
        $num1 = 116;
        $normal = 6;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',5)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_6(){
        $title = "로또6(일본)";
        $num = 43;
        $num1 = 6;
        $normal = 6;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',7)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_7(){
        $title = "로또7(일본)";
        $num = 37;
        $num1 = 7;
        $normal = 7;
        $bonus = 2;
        $reverse = 0;
        $game = Game::where('id',8)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_mini(){
        $title = "미니(일본)";
        $num = 31;
        $num1 = 5;
        $normal = 5;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',9)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }

    public function jlotto_live(){
        $title = "실시간로또 - 리버스";
        $num = 69;
        $num1 = 26;
        $normal = 6;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',1)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_kr(){
        $title = "로또6/45(한국) - 리버스";
        $num = 45;
        $num1 = 26;
        $normal = 6;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',2)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_pb(){
        $title = "파워볼(미국) - 리버스";
        $num = 69;
        $num1 = 26;
        $normal = 5;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',4)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_mm(){
        $title = "메가밀리언(미국) - 리버스";
        $num = 70;
        $num1 = 25;
        $normal = 5;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',3)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_dlt(){
        $title = "따루토(중국) - 리버스";
        $num = 35;
        $num1 = 12;
        $normal = 5;
        $bonus = 2;
        $reverse = 1;
        $game = Game::where('id',6)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_ssq(){
        $title = "쌍색구(중국) - 리버스";
        $num = 133;
        $num1 = 116;
        $normal = 6;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',5)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_6(){
        $title = "로또6(일본) - 리버스";
        $num = 43;
        $num1 = 6;
        $normal = 6;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',7)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_7(){
        $title = "로또7(일본) - 리버스";
        $num = 37;
        $num1 = 7;
        $normal = 7;
        $bonus = 2;
        $reverse = 1;
        $game = Game::where('id',8)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_mini(){
        $title = "미니(일본) - 리버스";
        $num = 31;
        $num1 = 5;
        $normal = 5;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',9)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }


    public function old_number(Request $request)
    {
        $authUser = \Auth::guard('web')->user();

        $lists = DB::table('histories')
            ->where('histories.user_id', $authUser->id)
            ->join('games', 'histories.game_id', '=', 'games.id')
            ->select('histories.*', 'games.game as game') // histories의 모든 필드 + games.name
            ->orderBy('histories.created_at', 'desc')
            ->paginate(20);

        return view('web.game.oldnum', compact('lists'));
    }
    public function number_list(Request $request)
    {
        $authUser = \Auth::guard('web')->user();

        $lists = Purchase::where('user_id', $authUser->id)->where('game_id',$request->id)->where('reverse',$request->reverse)->get();
        $gameId = $request->id;
        $reverse = $request->reverse;
        return view('web.game.numberlist', compact('lists','gameId','reverse'));
    }

    public function number_list_ok(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        if($request->mode == "del"){
            $purchase = Purchase::where('id',$request->idx);
            $purchase->delete();
        }
        else if($request->mode == "alldel"){
            $arr = $request->input('arr_del_list'); // "2@3@4@5"
    
            // 문자열을 @ 기준으로 나눠 배열로 만듦
            $ids = explode('@', $arr); // ['2', '3', '4', '5']

            // 정수로 변환 (보안상 안전하게)
            $ids = array_filter(array_map('intval', $ids));

            if (!empty($ids)) {
                Purchase::whereIn('id', $ids)->delete();
            }
        }
        else{
            $purchase = new Purchase;
            $purchase->user_id = $authUser->id;
            $purchase->game_id = $request->part_idx;
            $purchase->type = $request->cho_method;
            $purchase->amount = 1000;
           
            // 숫자 리스트 7자리
            $normalNumbers = array_filter([
                $request->s_num1, $request->s_num2, $request->s_num3,
                $request->s_num4, $request->s_num5, $request->s_num6, $request->s_num7,
            ]);
            $normalNumbers = array_filter([
                $request->s_num1, $request->s_num2, $request->s_num3,
                $request->s_num4, $request->s_num5, $request->s_num6, $request->s_num7,
            ], function ($v) {
                return $v !== null && $v !== '' && $v !== 'undefined';
            });
            // while (count($normalNumbers) < 7) {
            //     $normalNumbers[] = '';
            // }
            $purchase->list = implode(',', $normalNumbers);

            // 보너스 2자리
            $bonusNumbers = array_filter([
                $request->s_num11, $request->s_num12
            ], function ($v) {
                return $v !== null && $v !== '' && $v !== 'undefined';
            });
            // while (count($bonusNumbers) < 2) {
            //     $bonusNumbers[] = '';
            // }
            $purchase->bonus = implode(',', $bonusNumbers);
            $purchase->reverse = $request->reverse;
            $purchase->save();
        }        
        $lists = Purchase::where('user_id', $authUser->id)->where('game_id',$request->part_idx)->get();
        $gameId = $request->part_idx;
        return view('web.game.numberlist',compact('lists','gameId'));
    }


}
