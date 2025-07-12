<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Game;
use App\Models\Rate;

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

    public function postSetting(Request $request){
        $authUser = \Auth::guard('admin')->user();
        if ($authUser->parent_level == 0) {
            $setting = Rate::first();
            $site_closed = $request->site_closed;
            if (!is_null($site_closed))
                $setting->site_closed = $site_closed;
            
            $setting->rate_1 = $request->rate_1;
            $setting->rate_2 = $request->rate_2;
            $setting->rate_3 = $request->rate_3;
            $setting->rate_4 = $request->rate_4;
            $setting->rate_5 = $request->rate_5;
            $setting->rate_6 = $request->rate_6;
            $setting->rate_7 = $request->rate_7;           
            $setting->save();

            return response()->json(['success' => true, 'msg' => '']);
        }

        return response()->json(['success' => false, 'msg' => '']);
    }

    public function setting(Request $request)
    {
        $page_title = '로또 배당률 설정';

        $setting = Rate::first();

        return view('admin.lotto.settings', compact('page_title', 'setting'));
    }

    public function scrap(Request $request){
        $id = $request->id;

        switch ($id) {
            case 1:
                $this->processlive();
                break;

            case 2:
                $this->processkr();
                break;

            case 3:
                $this->processmm();
                break;

            case 4:
                $this->processpb();
                break;

            case 5:
                $this->processssq();
                break;

            case 6:
                $this->processdlt();
                break;

            case 7:
                $this->process6();
                break;

            case 8:
                $this->process7();
                break;

            case 9:
                $this->processmini();
                break;
        }
        return response()->json(['success' => true]);
    }
    private function processkr(){
        $game = Game::where('id', 2)->first();
        $round = $game->round;
        if (is_null($round)) {
            $round = 1178;
        }
        while (true) {
            
            $apiUrl = "https://www.dhlottery.co.kr/common.do?method=getLottoNumber&drwNo={$round}";
            $response = file_get_contents($apiUrl);
            if (!$response) continue;

            $data = json_decode($response, true);
            if (!$data || $data['returnValue'] !== 'success') 
            {
                break;                
            }

            $numbers = [];
            for ($i = 1; $i <= 6; $i++) {
                $numbers[] = $data["drwtNo{$i}"];
            }
            $numbersString = implode(',', $numbers);
            $bonus = $data['bnusNo'];
            $drawDate = $data['drwNoDate'];
            $round++;
        }
        $game->lastresult = $numbersString;
        $game->bonus = $bonus;
        $date = new \DateTime($drawDate);
        $date->modify('next saturday'); // 다음 주 토요일로 이동
        $game->weekday = $date->format('Y-m-d').' 20:35:00';
        $game->save();
    }
    private function processlive(){

    }
    private function processmm(){

    }
    private function processpb(){

    }
    private function processssq(){

    }
    private function processdlt(){

    }
    private function process6(){

    }
     private function process7(){

    }
     private function processmini(){

    }
    
}
