<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\History;
use App\Models\Game;
use App\Models\Prize;
use App\Models\Purchase;

class PlayController extends BaseController
{
    
    public function lotto_live(){
        $title = "실시간로또";
        $num = 45;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
        $reverse = 0;
        $game = Game::where('id',1)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_kr(){
        $title = "로또6/45(한국)";
        $num = 45;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
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
        $num = 33;
        $num1 = 16;
        $normal = 6;
        $bonus = 1;
        $reverse = 0;
        $game = Game::where('id',5)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_6(){
        $title = "로또6(일본)";
        $num = 43;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
        $reverse = 0;
        $game = Game::where('id',7)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_7(){
        $title = "로또7(일본)";
        $num = 37;
        $num1 = 0;
        $normal = 7;
        $bonus = 0;
        $reverse = 0;
        $game = Game::where('id',8)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function lotto_mini(){
        $title = "미니(일본)";
        $num = 31;
        $num1 = 0;
        $normal = 5;
        $bonus = 0;
        $reverse = 0;
        $game = Game::where('id',9)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }

    public function jlotto_pri(){
        $authUser = \Auth::guard('web')->user();
        if($authUser->primium_menu == 0)
            return redirect()->route('web.index');  
        $title = "프리미엄 로또";
        $num = 45;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
        $reverse = 1;
        $game = Game::where('id',10)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_live(){
        $title = "실시간로또 - 리버스";
        $num = 45;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
        $reverse = 1;
        $game = Game::where('id',1)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_kr(){
        $title = "로또6/45(한국) - 리버스";
        $num = 45;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
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
        $num = 33;
        $num1 = 16;
        $normal = 6;
        $bonus = 1;
        $reverse = 1;
        $game = Game::where('id',5)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_6(){
        $title = "로또6(일본) - 리버스";
        $num = 43;
        $num1 = 0;
        $normal = 6;
        $bonus = 0;
        $reverse = 1;
        $game = Game::where('id',7)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_7(){
        $title = "로또7(일본) - 리버스";
        $num = 37;
        $num1 = 0;
        $normal = 7;
        $bonus = 0;
        $reverse = 1;
        $game = Game::where('id',8)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }
    public function jlotto_mini(){
        $title = "미니(일본) - 리버스";
        $num = 31;
        $num1 = 0;
        $normal = 5;
        $bonus = 0;
        $reverse = 1;
        $game = Game::where('id',9)->first();
        return view('web.game.index', compact('title','num','num1','game','normal','bonus','reverse'));
    }


    public function old_number(Request $request)
    {
        $authUser = \Auth::guard('web')->user();

        $lists = DB::table('histories')
            ->where('histories.user_id', $authUser->id)
            ->where('histories.game_id', $request->id)
            ->where('histories.reverse', $request->reverse)
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
        else if($request->mode == "purchage"){  // 구매하기
            $arr = $request->input('arr_del_list'); // "2@3@4@5"
            
            if($arr==null)
            {
                if (!empty($request->input('del_list'))) {
                    $purchase = Purchase::where('id', $request->input('del_list'))->first();
                    if($authUser->amount >= $purchase->amount){
                        if($purchase->game_id == 10 && $authUser->primium_bet == 0)
                        {
                                return redirect()->route('web.game.numberlist')->withErrors('허가받은 이용자만 이용가능한 메뉴입니다.');
                        }
                        $exists = DB::table('histories')->where([
                            ['user_id', '=', $purchase->user_id],
                            ['game_id', '=', $purchase->game_id],
                            ['amount', '=', $purchase->amount],
                            ['list', '=', $purchase->list],
                            ['bonus', '=', $purchase->bonus],
                            ['round', '=', Game::where('id', $request->part_idx)->first()->round],
                            ['reverse', '=', $purchase->reverse],
                            ['type', '=', $purchase->type],
                        ])->exists();
                        if (!$exists) {
                        DB::table('histories')->insert([
                                'user_id' => $purchase->user_id,
                                'game_id' => $purchase->game_id,
                                'amount' => $purchase->amount,
                                'list' => $purchase->list,
                                'round' => Game::where('id', $request->part_idx)->first()->round,
                                'bonus' => $purchase->bonus,
                                'status' => 0,
                                'reverse' => $purchase->reverse,
                                'type' => $purchase->type,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                        Purchase::where('id', $purchase->id)->delete();
                        $authUser->amount -= $purchase->amount;
                        $authUser->save();

                        $prize = new Prize;
                         if($purchase->reverse == 0)
                                $prize->title = Game::where('id', $request->part_idx)->first()->game." 배팅";
                            else 
                                $prize->title = Game::where('id', $request->part_idx)->first()->game."-리버스 배팅";
                        $prize->list =  $purchase->list."  ".$purchase->bonus;
                        $prize->money = intval(str_replace(',', '', $purchase->amount));
                        $prize->type = 0;                       
                        $prize->cur_amount = $authUser->amount;
                        $prize->created_at = date('Y-m-d H:i:s');
                        $prize->updated_at = date('Y-m-d H:i:s');
                        $prize->user_id = $authUser->id;
                        $prize->save();
                    }
                }
                else{
                     if($authUser->amount >= (int)str_replace(',', '', $request->amount)){
                        if($request->part_idx == 10 && $authUser->primium_bet == 0)
                        {
                            // return redirect()->route('web.index')->withErrors('허가받은 이용자만 이용가능한 메뉴입니다.');
                            return redirect()->route('play.number_list')->withErrors('허가받은 이용자만 이용가능한 메뉴입니다.');
                        }
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
                    
                        // 보너스 2자리
                        $bonusNumbers = array_filter([
                            $request->s_num11, $request->s_num12
                        ], function ($v) {
                            return $v !== null && $v !== '' && $v !== 'undefined';
                        });
                        
                        $exists = DB::table('histories')->where([
                            ['user_id', '=', $authUser->id],
                            ['game_id', '=', $request->part_idx],
                            ['amount', '=', (int)str_replace(',', '', $request->amount)],
                            ['list', '=', implode(',', $normalNumbers)],
                            ['bonus', '=', implode(',', $bonusNumbers)],
                            ['round', '=', Game::where('id', $request->part_idx)->first()->round],
                            ['reverse', '=', $request->reverse],
                            ['type', '=',  $request->cho_method ],
                        ])->exists();
                        if (!$exists) {
                        DB::table('histories')->insert([
                                'user_id' => $authUser->id,
                                'game_id' => $request->part_idx,
                                'amount' => (int)str_replace(',', '', $request->amount),
                                'list' => implode(',', $normalNumbers),
                                'round' => Game::where('id', $request->part_idx)->first()->round,
                                'bonus' => implode(',', $bonusNumbers),
                                'status' => 0,
                                'reverse' => $request->reverse,
                                'type' => $request->cho_method ,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                       
                        $authUser->amount -= (int)str_replace(',', '', $request->amount);
                        $authUser->save();

                        $prize = new Prize;
                         if($request->reverse == 0)
                                $prize->title = Game::where('id', $request->part_idx)->first()->game." 배팅";
                            else 
                                $prize->title = Game::where('id', $request->part_idx)->first()->game."-리버스 배팅";
                        $prize->list =  implode(',', $normalNumbers)."  ".implode(',', $bonusNumbers);
                        $prize->money = intval(str_replace(',', '', $request->amount));
                        $prize->type = 0;                       
                        $prize->cur_amount = $authUser->amount;
                        $prize->created_at = date('Y-m-d H:i:s');
                        $prize->updated_at = date('Y-m-d H:i:s');
                        $prize->user_id = $authUser->id;
                        $prize->save();
                    }
                }
            }
            else{
                $ids = explode('@', $arr); // ['2', '3', '4', '5']
                // 정수로 변환 (보안상 안전하게)
                $ids = array_filter(array_map('intval', $ids));

                if (!empty($ids)) {
                    $purchases = Purchase::whereIn('id', $ids)->get();
                    foreach ($purchases as $purchase) {
                        if($authUser->amount >= $purchase->amount){
                            if($purchase->game_id == 10 && $authUser->primium_bet == 0)
                            {
                                 return redirect()->route('web.game.numberlist')->withErrors('허가받은 이용자만 이용가능한 메뉴입니다.');
                            }
                            $exists = DB::table('histories')->where([
                                ['user_id', '=', $purchase->user_id],
                                ['game_id', '=', $purchase->game_id],
                                ['amount', '=', $purchase->amount],
                                ['list', '=', $purchase->list],
                                ['round', '=', Game::where('id', $request->part_idx)->first()->round],
                                ['bonus', '=', $purchase->bonus],
                                ['reverse', '=', $purchase->reverse],
                                ['type', '=', $purchase->type],
                            ])->exists();
                            if (!$exists) {
                                DB::table('histories')->insert([
                                    'user_id' => $purchase->user_id,
                                    'game_id' => $purchase->game_id,
                                    'amount' => $purchase->amount,
                                    'list' => $purchase->list,
                                    'bonus' => $purchase->bonus,
                                    'round' => Game::where('id', $request->part_idx)->first()->round,
                                    'status' => 0,
                                    'reverse' => $purchase->reverse,
                                    'type' => $purchase->type,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                            Purchase::where('id', $purchase->id)->delete();
                            $authUser->amount -= $purchase->amount;
                            $authUser->save();

                            $prize = new Prize;
                            if($purchase->reverse == 0)
                                $prize->title = Game::where('id', $request->part_idx)->first()->game." 배팅";
                            else 
                                $prize->title = Game::where('id', $request->part_idx)->first()->game."-리버스 배팅";
                            $prize->list =  $purchase->list."  ".$purchase->bonus;
                            $prize->money = intval(str_replace(',', '', $purchase->amount));
                            $prize->type = 0;                       
                            $prize->cur_amount = $authUser->amount;
                            $prize->user_id = $authUser->id;
                            $prize->created_at = date('Y-m-d H:i:s');
                            $prize->updated_at = date('Y-m-d H:i:s');
                            $prize->save();
                        }
                        else{

                        }
                    }
                }
            }
            // 문자열을 @ 기준으로 나눠 배열로 만듦
           
        }
        else if($request->mode == "manyinsert"){
            for($i = 0; $i < $request->game_su;$i++)
            {
                $purchase = new Purchase;
                $purchase->user_id = $authUser->id;
                $purchase->type = 1;
                $purchase->game_id = $request->part_idx;
                $purchase->reverse = $request->reverse;
                if($request->reverse == 0)
                {
                    if($request->part_idx == 1 || $request->part_idx == 2 || $request->part_idx == 5 || $request->part_idx == 6  )
                        $purchase->amount = 1100;
                    else
                        $purchase->amount = 3300;
                }
                else
                    $purchase->amount =(int)str_replace(',', '', $request->amount);
                switch($request->part_idx)
                {
                    case 1:                        
                    case 2:
                        $numbers = range(1, 45);       // 1부터 45까지 숫자 배열
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 6); // 앞에서 6개 자르기
                        sort($randomSix);  
                        break;
                    case 3:
                        $numbers = range(1, 70);       // 1부터 45까지 숫자 배열
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 5); // 앞에서 6개 자르기
                        sort($randomSix);
                        $numbers1 = rand(1, 25);       // 1부터 45까지 숫자 배열                        
                        $purchase->bonus = $numbers1;
                        break;
                    case 4:
                        $numbers = range(1, 69);       
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 5); 
                        sort($randomSix);
                        $numbers1 = rand(1, 26);                            
                        $purchase->bonus = $numbers1;
                        break; 
                    case 5:
                        $numbers = range(1, 33);       
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 5); 
                        sort($randomSix);
                        $numbers1 = rand(1, 16);                            
                        $purchase->bonus = $numbers1;
                        break;
                    case 6:
                        $numbers = range(1, 35);       
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 5); 
                        sort($randomSix);
                        $numbers1 = range(1, 12);  
                        shuffle($numbers1);             // 배열 섞기
                        $randomSix1 = array_slice($numbers1, 0, 2); 
                        sort($randomSix1);                          
                        $purchase->bonus = implode(',', $randomSix1);
                        break;
                    case 7:
                        $numbers = range(1, 43);       // 1부터 45까지 숫자 배열
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 6); // 앞에서 6개 자르기
                        sort($randomSix);  
                        break;
                    case 8:
                        $numbers = range(1, 37);       // 1부터 37까지 숫자 배열
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 7); // 앞에서 7개 자르기
                        sort($randomSix);
                        break;   
                    case 9:
                         $numbers = range(1, 31);       // 1부터 31까지 숫자 배열
                        shuffle($numbers);             // 배열 섞기
                        $randomSix = array_slice($numbers, 0, 5); // 앞에서 5개 자르기
                        sort($randomSix);
                        break; 
                }
                $purchase->list = implode(',', $randomSix);
                $purchase->save();
            }
            $lists = Purchase::where('user_id', $authUser->id)->where('game_id',$request->part_idx)->get();
            $gameId = $request->part_idx;
            $reverse = $request->reverse;
            return view('web.game.numberlist',compact('lists','gameId','reverse'));
        }
        else{
            $purchase = new Purchase;
            $purchase->user_id = $authUser->id;
            $purchase->game_id = $request->part_idx;
            $purchase->type = $request->cho_method;
            if($request->reverse == 0)
            {
                if($request->part_idx == 1 || $request->part_idx == 2 || $request->part_idx == 5 || $request->part_idx == 6  )
                    $purchase->amount = 1100;
                else
                    $purchase->amount = 3300;
            }
            else
                $purchase->amount =(int)str_replace(',', '', $request->amount);
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
        $reverse = $request->reverse;
        return view('web.game.numberlist',compact('lists','gameId','reverse'));
    }


}
