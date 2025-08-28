<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Game;
use App\Models\Rate;
use App\Models\User;
use App\Models\Prize;
use App\Models\History;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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
            $game->first = $request->first;
            $game->second = $request->second;
            $game->third = $request->third;
            $game->fourth = $request->fourth;
            $game->fifth = $request->fifth;
            $game->sixth = $request->sixth;
            $game->seventh = $request->seventh;
            $game->eighth = $request->eighth;
            $game->nineth = $request->nineth;
          
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
            $setting = Rate::where('id',$request->set_id)->first();
            $site_closed = $request->site_closed;
            if (!is_null($site_closed))
                $setting->site_closed = $site_closed;
            
            $setting->rate_1 = $request->rate_1;
            $setting->rate_2 = $request->rate_2;
            $setting->rate_3 = $request->rate_3;
            $setting->rate_4 = $request->rate_4;
            $setting->rate_5 = $request->rate_5;
            $setting->rate_7 = $request->rate_7;           
            $setting->save();

            return response()->json(['success' => true, 'msg' => '']);
        }

        return response()->json(['success' => false, 'msg' => '']);
    }

    public function setting(Request $request)
    {
        $page_title = '로또 배당률 설정';

        $settings = Rate::all();

        return view('admin.lotto.settings', compact('page_title', 'settings'));
    }

    public function settingedit(Request $request){
        $page_title = '로또 배당률 설정';

        $setting = Rate::where('id',$request->id)->first();

        return view('admin.lotto.settingedit', compact('page_title', 'setting'));
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
            case 10:
                $this->processpri();
                break;
        }
        // $this->calculate($id);
        return response()->json(['success' => true]);
    }
    private function processkr(){
        $game = Game::where('id', 2)->first();
        $round = $game->round-1;
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
        $game->round = $round;
        $date = new \DateTime($drawDate);
        $game->lastday = $date->format('Y-m-d').' 20:00:00';
        $date->modify('next saturday'); // 다음 주 토요일로 이동
        $game->weekday = $date->format('Y-m-d').' 20:00:00';
        $game->save();
    }
    private function processlive(){
        $game = Game::where('id', 1)->first();
        $apiUrl = "https://rev-lotto.com/game_page/api/result";
        $response = file_get_contents($apiUrl);
        
        $data = json_decode($response, true);

        if (!$data) 
        {
            return;                
        }

        $numbersString = implode(',',$data["mainNumbers"]);
        $bonus = $data['bonusNumber'];
        $drawDate = $data['roundDate'];
      
        $game->lastresult = $numbersString;
        $game->bonus = $bonus;
        $game->round = $data['nextRoudStartAt'];
        $date = new \DateTime($drawDate);
        
        $game->lastday = $date->format('Y-m-d').' 19:30:00';
        $date->add(new \DateInterval('P1D'));
        $game->weekday = $date->format('Y-m-d').' 19:30:00';
        $game->save();
    }
    private function processpri(){
       
        // $apiUrl = "http://127.0.0.1:9000/list?type=pending&page=1&size=100000";
         $apiUrl = "http://137.220.191.107/list?type=finish&page=1&size=100000";
        $response = file_get_contents($apiUrl);
        
        $data = json_decode($response, true);
        $now = Carbon::now();
        if (!$data) 
        {
            return;                
        }
        foreach ($data as $item) {
            // UTC 기준으로 파싱 후 서울 시간대 변환
            $drawTime = Carbon::parse($item['startAt'], 'UTC')->setTimezone('Asia/Seoul');

            // 현재 시간과의 차이 계산 ($now - $drawTime)
            $diffInSeconds = $now->diffInSeconds($drawTime, false);

            // 추첨 후 5분 이내
            if ($diffInSeconds < 0 && $diffInSeconds >= -300) {
                $game = Game::where('id', 10)->first();
                $numbersString = implode(',', $item['result']['mainNumbers']);
                $bonus = $item['result']['bonusNumber'];

                $game->lastresult = $numbersString;
                $game->bonus = $bonus;
                $game->round = $item['round'] + 1;

                $game->lastday = $drawTime->format('Y-m-d H:i:s');
                $game->weekday = $drawTime->copy()->addMinutes(5)->format('Y-m-d H:i:s');
                $game->save();
                break;
            }
        }
    }
    private function processmm1(){
        $game = Game::where('id', 3)->first();
       
        $url = "https://data.ny.gov/resource/5xaw-6ayf.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        $numbersString = str_replace(' ', ',',$data[0]["winning_numbers"]);
        
        $drawDate = $data[0]["draw_date"];
        
        $game->lastresult = $numbersString;
        $game->bonus =  $data[0]["mega_ball"];
        $date = new \DateTime($drawDate);
        $date->modify('+1 day');
        $weekday = $date->format('N'); // 요일 숫자 (1: 월 ~ 7: 일)

        if ($weekday == 3) { // 수요일
            $date->modify('next Saturday');
        } elseif ($weekday == 6) { // 토요일
            $date->modify('next Wednesday');
        }
        $game->weekday = $date->format('Y-m-d').' 12:00:00';
        $game->save();
    }
    private function processmm(){
        $this->allscrap("Mega Millions",3);
    }
    private function processpb1(){
        $game = Game::where('id', 4)->first();
       
        $url = "https://data.ny.gov/resource/d6yy-54nr.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        $numbers = explode(' ', $data[0]["winning_numbers"]);
        $bonus = array_pop($numbers);              // 마지막 숫자를 보너스로 분리
        $numbersString = implode(',', $numbers);
        
        $drawDate = $data[0]["draw_date"];
        
        $game->lastresult = $numbersString;
        $game->bonus =  $bonus;
        $date = new \DateTime($drawDate); // 월요일
        $date->modify('+1 day');
        $weekday = (int)$date->format('N'); // 1=월, 3=수, 6=토

        switch ($weekday) {
            case 2: // 월요일
                $date->modify('next Thursday');
                break;
            case 4: // 수요일
                $date->modify('next Sunday');
                break;
            case 7: // 토요일
                $date->modify('next Tuesday');
                break;
            default:
                // 그 외 요일은 그대로 두거나 예외처리
                // $date remains unchanged
                break;
        }
        $game->weekday = $date->format('Y-m-d').' 11:59:00';
        $game->save();
    }
    private function processpb(){
        $this->allscrap("Powerball USA",4);
    }
    private function processssq(){
        $game = Game::where('id', 5)->first();
        $url = 'https://www.zhcw.com/kjxx/ssq/';

        // 1) cURL로 HTML 가져오기
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        $html = curl_exec($ch);
        curl_close($ch);

        if (!$html) {
            die('페이지를 불러오지 못했습니다.');
        }
    }
    private function processdlt(){
        $game = Game::where('id', 6)->first();
    }
    private function process6(){
        $this->allscrap("Lotto 6 ",7);
    }
    private function process7(){
        $this->allscrap("Lotto 7",8);
    }
    private function processmini(){
        $this->allscrap("Mini Loto",9);
    }

    private function allscrap($str,$id){
        $game = Game::where('id', $id)->first();
        $url = "https://en.lottolyzer.com/public/rss/2.0/lottolyzer.news.xml";
        // RSS 불러오기
        $xml = simplexml_load_file($url);

        // 에러 체크
        if (!$xml) {
            die("RSS 데이터를 불러올 수 없습니다.");
        }

        // lotto6 포함된 item만 출력
        foreach ($xml->channel->item as $item) {
            if (strpos($item->title, $str) !== false) {
                // 회차 번호 추출
                preg_match('/Draw (\d+)/', $item->title, $matchDraw);
                $round = $matchDraw[1] ?? null;

                // 날짜 추출
                preg_match('/\d{1,2} \w{3} \d{4}/', $item->description, $matchDate);
                $drawDate = $matchDate[0] ?? null;

                // Winning No 추출
                preg_match('/Winning No:\s*([0-9 ]+)/', $item->description, $matchWin);
                $numbersString = str_replace(' ', ',',trim($matchWin[1] ?? ''));

                // Supp 추출
                preg_match('/Supp:\s*([0-9 ]+)/', $item->description, $matchSupp);
                $bonus = str_replace(' ', ',',trim($matchSupp[1] ?? ''));
                break;
            }
        }

        $game->lastresult = $numbersString;
        $game->bonus = $bonus;
        $game->round = $round;
        $date = new \DateTime($drawDate);
        switch ($id) {
            case 3:
                $date->modify('+1 day');
                $game->lastday = $date->format('Y-m-d').' 18:45:00';
                $weekday = $date->format('N'); // 요일 숫자 (1: 월 ~ 7: 일)

                if ($weekday == 3) { // 수요일
                    $date->modify('next Saturday');
                } elseif ($weekday == 6) { // 토요일
                    $date->modify('next Wednesday');
                }
                $game->weekday = $date->format('Y-m-d').' 12:00:00';
                break;
            case 4:
                $date->modify('+1 day');
                $game->lastday = $date->format('Y-m-d').' 11:59:00';
                $weekday = (int)$date->format('N'); // 1=월, 3=수, 6=토
                switch ($weekday) {
                    case 2: // 화요일
                        $date->modify('next Thursday');
                        break;
                    case 4: // 목요일
                        $date->modify('next Sunday');
                        break;
                    case 7: // 일요일
                        $date->modify('next Tuesday');
                        break;
                    default:
                        // 그 외 요일은 그대로 두거나 예외처리
                        // $date remains unchanged
                        break;
                }
                $game->weekday = $date->format('Y-m-d').' 11:59:00';
                
                break;
            case 7:
                $weekday = $date->format('N'); // 요일 숫자 (1: 월 ~ 7: 일)
                $game->lastday = $date->format('Y-m-d').' 18:45:00';
                if ($weekday == 1) { // 월요일
                    $date->modify('next Thursday');
                } elseif ($weekday == 4) { // 목요일
                    $date->modify('next Monday');
                }
                $game->weekday = $date->format('Y-m-d').' 18:45:00';
                break;
            case 8:
                $game->lastday = $date->format('Y-m-d').' 18:45:00';
                $date->modify('next Friday');
                $game->weekday = $date->format('Y-m-d').' 18:45:00';
                break;
            case 9:
                $game->lastday = $date->format('Y-m-d').' 18:45:00';
                $date->modify('next Tuesday');
                $game->weekday = $date->format('Y-m-d').' 18:45:00';
                break; 
        }       
        $game->save();
    }

    public function calculate(Request $request)
    {
        $id = $request->id;
        $game = Game::where('id',$id)->first();
        $lastday = Carbon::parse($game->lastday);

        // $histories = History::where('status',0)->where('game_id',$id)->where('round', '!=',  $game->round)->get();
        $histories = History::where('status',0)->where('game_id',$id)->where('created_at', '<', $lastday)->get();
        
        switch($id)
        {
            case 1: 
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = $game->bonus;
                    $myNumbers = explode(',',$history->list);
                    $matched = count(array_intersect($myNumbers, $result_nums));
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',$user->level)->first();
                    $prize = new Prize;
                    if($history->reverse == 0)
                        $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    else 
                        $prize->title = Game::where('id', $game->id)->first()->game."-리버스 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    
                    if($history->reverse == 0){
                        $prize->type = 1;     
                        if ($matched === 6) {
                            // "1등";
                            $history->result = 1;                            
                            $user->amount = $user->amount + $game->first;
                            $prize->money = $game->first;                                              
                            $prize->cur_amount = $user->amount;
                            $history->profit = $game->first;
                            $prize->save();
                        } elseif ($matched === 5 && in_array($bonus, $myNumbers)) {
                            // "2등";
                            $history->result = 2;
                            $user->amount = $user->amount + $game->second;
                            $prize->money = $game->second;                                              
                            $prize->cur_amount = $user->amount;
                            $history->profit = $game->second;
                            $prize->save();
                        } elseif ($matched === 5) {
                            // "3등";
                            $history->result = 3;
                            $user->amount = $user->amount + $game->third;
                            $history->profit = $game->first;
                            $prize->money = $game->third;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 4) {
                            // "4등";
                            $history->result = 4;
                            $user->amount = $user->amount + $game->fourth;
                            $history->profit = $game->fourth;
                            $prize->money = $game->fourth;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 3) {
                            // "5등";
                            $user->amount = $user->amount + $game->fifth;
                            $history->profit = $game->fifth;
                            $history->result = 5;
                            $prize->money = $game->fifth;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } else {
                            // "꽝";                            
                            $history->result = 0;
                        }
                        $history->status = 1;
                    }
                    else{
                        if ($matched === 6) {
                            // "1등";
                            $history->result = 1;
                            if($rate->rate_1 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);   
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                            }
                            else{
                                $prize->type = 1;  
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);   
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                            }
                        } elseif ($matched === 5 && in_array($bonus, $myNumbers)) {
                            // "2등";
                            $history->result = 2;
                            if($rate->rate_2 < 0)
                            {
                                $prize->type = 0;
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100); 
                            }
                            else{
                                
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);   
                            }                            
                        } elseif ($matched === 5) {
                            // "3등";
                            $history->result = 3;
                            if($rate->rate_3 < 0)
                            {
                                $prize->type = 0;
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100); 
                            }
                            else{
                                $prize->type = 1;  
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);   
                            }
                        } elseif ($matched === 4) {
                            // "4등";
                            $history->result = 4;
                            if($rate->rate_4 < 0)
                            {
                                $prize->type = 0;
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100); 
                            }
                            else{
                                $prize->type = 1;  
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);   
                            }
                            
                        } elseif ($matched === 3) {
                            // "5등";
                            $history->result = 5;
                            if($rate->rate_5 < 0)
                            {
                                $prize->type = 0;
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_5) / 100); 
                            }
                            else{
                                $prize->type = 1;  
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_5 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_5) / 100);
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_5 / 100);   
                            }
                        } else {
                            // "꽝";
                            if($rate->rate_7 < 0)
                            {
                                $prize->type = 0;
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100); 
                            }
                            else{
                                $prize->type = 1;  
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);   
                            }
                            $history->result = 0;
                        }
                        $history->status = 1;
                        if($prize->money != 0)   
                        {
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                    }                    
                    $user->save();                    
                    $history->save();

                }
                break;
                break;
            case 2:
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = $game->bonus;
                    $myNumbers = explode(',',$history->list);
                    $matched = count(array_intersect($myNumbers, $result_nums));
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',$user->level)->first();
                    $prize = new Prize;
                    if($history->reverse == 0)
                        $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    else 
                        $prize->title = Game::where('id', $game->id)->first()->game."-리버스 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    if($history->reverse == 0){
                        $prize->type = 1;
                        if ($matched === 6) {
                            // "1등";
                            $history->result = 1;                            
                            $user->amount = $user->amount + $game->first;
                            $history->profit = $game->first;
                            $prize->money = $game->first;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 5 && in_array($bonus, $myNumbers)) {
                            // "2등";
                            $history->result = 2;
                             $user->amount = $user->amount + $game->second;
                             $history->profit = $game->second;
                              $prize->money = $game->second;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 5) {
                            // "3등";
                            $history->result = 3;
                             $user->amount = $user->amount + $game->third;
                             $history->profit = $game->third;
                              $prize->money = $game->third;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 4) {
                            // "4등";
                            $history->result = 4;
                             $user->amount = $user->amount + $game->fourth;
                             $history->profit = $game->fourth;  
                              $prize->money = $game->fourth;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 3) {
                            // "5등";
                            $history->result = 5;
                            $user->amount = $user->amount + $game->fifth;
                            $prize->money = $game->fifth;  
                            $history->profit = $game->fifth;                                                
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } else {
                            // "꽝";                            
                            $history->result = 0;
                        }
                        $history->status = 1;
                    }
                    else{
                        if ($matched === 6) {
                            // "1등";
                            $history->result = 1;
                            if($rate->rate_1 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                 $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);   
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);  
                            }

                        } elseif ($matched === 5 && in_array($bonus, $myNumbers)) {
                            // "2등";
                            $history->result = 2;
                            if($rate->rate_2 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                 $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100);   
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);  
                            }
                        } elseif ($matched === 5) {
                            // "3등";
                            $history->result = 3;
                            if($rate->rate_3 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);    
                                 $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100);   
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);  
                            }
                        } elseif ($matched === 4) {
                            // "4등";
                            $history->result = 4;
                            if($rate->rate_4 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                 $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100);   
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);  
                            }
                        } elseif ($matched === 3) {
                            // "5등";
                            $history->result = 5;
                            if($rate->rate_5 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                 $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_5) / 100);   
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_5 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_5 / 100);  
                            }
                        } else {
                            // "꽝";
                            if($rate->rate_7 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                 $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100);   
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);  
                            }
                            $history->result = 0;
                        }
                        $history->status = 1;
                        if($prize->money != 0)   
                        {
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                    }                    
                    $user->save();                    
                    $history->save();

                }
                break;
            case 3: 
            case 4:
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = $game->bonus;
                    $myNumbers = explode(',',$history->list);                    
                    $mainMatch = count(array_intersect($myNumbers, $result_nums));
                    $megaMatch = ($history->bonus == $bonus);
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',$user->level)->first();
                    $prize = new Prize;
                    if($history->reverse == 0)
                        $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    else 
                        $prize->title = Game::where('id', $game->id)->first()->game."-리버스 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    if($history->reverse == 0){
                        $prize->type = 1;
                        if ($mainMatch == 5 && $megaMatch){
                            // "1등";
                            $history->result = 1;
                            $user->amount = $user->amount + $game->first;
                            $history->profit = $game->first;
                            $prize->money = $game->first;                                              
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($mainMatch == 5) {
                            // "2등";
                            $history->result = 2;
                             $user->amount = $user->amount + $game->second;
                             $prize->money = $game->second;  
                             $history->profit = $game->second;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($mainMatch == 4 && $megaMatch) {
                            // "3등";
                            $history->result = 3;
                             $user->amount = $user->amount + $game->third;
                             $prize->money = $game->third;  
                             $history->profit = $game->third;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($mainMatch == 4) {
                             $user->amount = $user->amount + $game->fourth;
                             $prize->money = $game->fourth; 
                             $history->profit  = $game->fourth;                                             
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                            // "4등";
                            $history->result = 4;
                        } elseif ($mainMatch == 3 && $megaMatch) {
                            // "5등";
                            $history->result = 5;
                            $user->amount = $user->amount + $game->fifth;
                            $prize->money = $game->fifth;      
                            $history->profit = $game->fifth;                                        
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }elseif ($mainMatch == 3) {
                            // "6등";
                            $history->result = 6;
                            $user->amount = $user->amount + $game->sixth;
                            $prize->money = $game->sixth; 
                            $history->profit = $game->sixth;                                             
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }elseif ($mainMatch == 2 && $megaMatch) {
                            // "7등";
                            $history->result = 7;
                            $user->amount = $user->amount + $game->seventh;
                            $prize->money = $game->seventh;   
                            $history->profit = $game->seventh;                                           
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }elseif ($mainMatch == 1 && $megaMatch) {
                            // "8등";
                            $history->result =8;
                            $user->amount = $user->amount + $game->eighth;
                            $prize->money = $game->eighth; 
                            $history->profit = $game->eighth;                                             
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                        elseif ($mainMatch == 0 && $megaMatch) {
                            // "9등";
                            $history->result = 9;
                            $user->amount = $user->amount + $game->nineth;
                            $prize->money = $game->nineth;  
                            $history->profit  = $game->nineth;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } else {
                            // "꽝";
                            $history->result = 0;
                        }
                        $history->status = 1;
                    }
                    else{
                        if ($mainMatch == 5 && $megaMatch){
                            // "1등";
                            $history->result = 1;
                            if($rate->rate_1 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);  
                            }

                        } elseif ($mainMatch == 5) {
                            // "2등";
                            $history->result = 2;
                            if($rate->rate_2 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);  
                            }
                        } elseif ($mainMatch == 4 && $megaMatch) {
                            // "3등";
                            $history->result = 3;
                            if($rate->rate_3 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);  
                            }
                        } elseif ($mainMatch == 4) {
                            // "4등";
                            $history->result = 4;
                            if($rate->rate_4 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);  
                            }
                        } elseif ($mainMatch == 3 && $megaMatch) {
                            // "5등";
                            $history->result = 5;
                            if($rate->rate_5 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_5 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_5 / 100);  
                            }
                        } else {
                            // "꽝";
                            if($rate->rate_7 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);  
                            }
                            $history->result = 0;
                        }
                        $history->status = 1;
                        if($prize->money != 0)   
                        {
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                    }                    
                    $user->save();                    
                    $history->save();

                }           
                break;           
            case 7:
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = $game->bonus;
                    $myNumbers = explode(',',$history->list);
                    $matched = count(array_intersect($myNumbers, $result_nums));
                    $hasBonus = in_array($bonus, $myNumbers);
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',$user->level)->first();
                    $prize = new Prize;
                    if($history->reverse == 0)
                        $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    else 
                        $prize->title = Game::where('id', $game->id)->first()->game."-리버스 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    if($history->reverse == 0){
                        $prize->type = 1;
                        if ($matched === 6) {
                            // "1등";
                            $history->result = 1;    
                             $user->amount = $user->amount + $game->first;    
                             $prize->money = $game->first;   
                             $history->profit = $game->first;                                           
                            $prize->cur_amount = $user->amount;
                            $prize->save();                    
                        } elseif ($matched === 5 && $hasBonus) {
                            // "2등";
                            $history->result = 2;
                             $user->amount = $user->amount + $game->second;
                             $prize->money = $game->second;   
                             $history->profit = $game->second;                                           
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                            
                        } elseif ($matched === 5) {
                            // "3등";
                            $history->result = 3;
                             $user->amount = $user->amount + $game->third;
                             $prize->money = $game->third;  
                             $history->profit = $game->third;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                            
                        } elseif ($matched === 4) {
                            // "4등";
                            $history->result = 4;
                             $user->amount = $user->amount + $game->fourth;
                             $prize->money = $game->fourth;    
                             $history->profit = $game->fourth;                                          
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                            
                        } elseif ($matched === 3) {
                            // "5등";
                            $history->result = 5;
                            $user->amount = $user->amount + $game->fifth;
                            $prize->money = $game->fifth;  
                            $history->profit = $game->fifth;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } else {
                            // "꽝";
                           
                            $history->result = 0;
                        }
                        $history->status = 1;
                    }
                    else{
                        if ($matched === 6) {
                            // "1등";
                            $history->result = 1;
                            if($rate->rate_1 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);  
                            }

                        } elseif ($matched === 5 && $hasBonus) {
                            // "2등";
                            $history->result = 2;
                            if($rate->rate_2 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);  
                            }
                        } elseif ($matched === 5) {
                            // "3등";
                            $history->result = 3;
                            if($rate->rate_3 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);  
                            }
                        } elseif ($matched === 4) {
                            // "4등";
                            $history->result = 4;
                            if($rate->rate_4 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);  
                            }
                        } elseif ($matched === 3) {
                            // "5등";
                            $history->result = 5;
                            if($rate->rate_5 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_5 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_5 / 100);  
                            }
                        } else {
                            // "꽝";
                            if($rate->rate_7 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);  
                            }
                            $history->result = 0;
                        }
                        $history->status = 1;
                        if($prize->money != 0)   
                        {
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                    }                    
                    $user->save();                    
                    $history->save();

                }
                break;
            case 8: 
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = explode(',',$game->bonus);
                    $myNumbers = explode(',',$history->list);
                    $matched = count(array_intersect($myNumbers, $result_nums));
                    $bonusMatched  = count(array_intersect($myNumbers, $bonus));
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',$user->level)->first();
                    $prize = new Prize;
                    if($history->reverse == 0)
                        $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    else 
                        $prize->title = Game::where('id', $game->id)->first()->game."-리버스 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    if($history->reverse == 0){
                        $prize->type = 1;
                         if ($matched === 7) {
                            // "1등";
                            $history->result = 1;
                            $user->amount = $user->amount + $game->first;
                             $prize->money = $game->first;    
                             $history->profit = $game->first;                                          
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 6 && $bonusMatched >= 1) {
                            // "2등";
                            $history->result = 2;
                             $user->amount = $user->amount + $game->second;
                              $prize->money = $game->second;   
                              $history->profit = $game->second;                                           
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 6) {
                            // "3등";
                            $history->result = 3;
                             $user->amount = $user->amount + $game->third;
                              $prize->money = $game->third;   
                              $history->profit = $game->third;                                           
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 5) {
                            // "4등";
                            $history->result = 4;
                             $user->amount = $user->amount + $game->fourth;
                              $prize->money = $game->fourth;    
                              $history->profit = $game->fourth;                                          
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 4) {
                            // "5등";
                            $history->result = 5;
                            $user->amount = $user->amount + $game->fifth;
                             $prize->money = $game->fifth; 
                             $history->profit = $game->fifth;                                             
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }elseif ($matched === 3 && $bonusMatched >= 1) {
                            // "6등";
                            $history->result = 6;
                            $history->profit = $game->sixth;
                            $user->amount = $user->amount + $game->sixth;
                        } else {
                            // "꽝";
                          
                            $history->result = 0;
                        }
                        $history->status = 1;
                    }
                    else{
                        if ($matched === 7) {
                            // "1등";
                            $history->result = 1;
                            if($rate->rate_1 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);  
                            }

                        } elseif ($matched === 6 && $bonusMatched >= 1) {
                            // "2등";
                            $history->result = 2;
                            if($rate->rate_2 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);  
                            }
                        } elseif ($matched === 6) {
                            // "3등";
                            $history->result = 3;
                            if($rate->rate_3 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);  
                            }
                        } elseif ($matched === 5) {
                            // "4등";
                            $history->result = 4;
                            if($rate->rate_4 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);  
                            }
                        } elseif ($matched === 4) {
                            // "5등";
                            $history->result = 5;
                            if($rate->rate_5 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_5 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_5) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_5 / 100);  
                            }
                        } else {
                            // "꽝";
                            if($rate->rate_7 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);  
                            }
                            $history->result = 0;
                        }
                        $history->status = 1;
                        if($prize->money != 0)   
                        {
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                    }                    
                    $user->save();                    
                    $history->save();

                }
                break;
            case 9:
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = $game->bonus;
                    $myNumbers = explode(',',$history->list);
                    $matched = count(array_intersect($myNumbers, $result_nums));
                    $hasBonus = in_array($bonus, $myNumbers);
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',$user->level)->first();
                    $prize = new Prize;
                    if($history->reverse == 0)
                        $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    else 
                        $prize->title = Game::where('id', $game->id)->first()->game."-리버스 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    if($history->reverse == 0){
                        $prize->type = 1;
                        if ($matched === 5) {
                            // "1등";
                            $history->result = 1;
                             $user->amount = $user->amount + $game->first;
                             $prize->money = $game->first;  
                             $history->profit = $game->first;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 4 && $hasBonus) {
                            // "2등";
                            $history->result = 2;
                             $user->amount = $user->amount + $game->second;
                             $prize->money = $game->second;  
                             $history->profit = $game->second;                                            
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 4) {
                            // "3등";
                            $history->result = 3;
                             $user->amount = $user->amount + $game->third;
                             $prize->money = $game->third;   
                             $history->profit  = $game->third;                                           
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } elseif ($matched === 3) {
                            // "4등";
                            $history->result = 4;  
                             $user->amount = $user->amount + $game->fourth; 
                             $prize->money = $game->fourth; 
                             $history->profit = $game->fourth;                                             
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        } else {
                           
                            $history->result = 0;
                        }
                        $history->status = 1;
                        
                    }
                    else{
                        if ($matched === 5) {
                            // "1등";
                            $history->result = 1;
                            if($rate->rate_1 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);  
                            }

                        } elseif ($matched === 4 && $hasBonus) {
                            // "2등";
                            $history->result = 2;
                            if($rate->rate_2 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);  
                            }
                        } elseif ($matched === 4) {
                            // "3등";
                            $history->result = 3;
                            if($rate->rate_3 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);  
                            }
                        } elseif ($matched === 3) {
                            // "4등";
                            $history->result = 4;
                            if($rate->rate_4 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                                $prize->type = 1;  
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);  
                            }                        
                        } else {
                            // "꽝";
                            if($rate->rate_7 < 0)
                            {
                                $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 0;
                                $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                            }
                            else{
                                $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                                $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                                $prize->type = 1;
                                $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);  
                            }
                            $history->result = 0;
                        }
                        $history->status = 1;
                        if($prize->money != 0)   
                        {
                            $prize->cur_amount = $user->amount;
                            $prize->save();
                        }
                    }                    
                    $user->save();                    
                    $history->save();

                }
                break;
            case 10:
                foreach($histories as $history)
                {
                    $result_nums = explode(',',$game->lastresult);
                    $bonus = $game->bonus;
                    $myNumbers = explode(',',$history->list);
                    $matched = count(array_intersect($myNumbers, $result_nums));
                    $user = User::where('id', $history->user_id)->first();
                    $rate = Rate::where('level',10)->first();
                    $prize = new Prize;
                    $prize->title = Game::where('id', $game->id)->first()->game." 배팅";
                    $prize->list =  $history->list."  ".$history->bonus;                    
                    $prize->user_id = $user->id;
                    $prize->created_at = date('Y-m-d H:i:s');
                    $prize->updated_at = date('Y-m-d H:i:s');
                    
                    if ($matched === 6) {
                        // "1등";
                        $history->result = 1;
                        if($rate->rate_1 < 0)
                        {
                            $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                            $prize->type = 0;
                            $prize->money = $history->amount - ($history->amount * abs($rate->rate_1) / 100);   
                            $history->profit = $history->amount - ($history->amount * abs($rate->rate_1) / 100);
                        }
                        else{
                            $prize->type = 1;  
                            $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_1 / 100);
                            $prize->money = $history->amount + ($history->amount *  $rate->rate_1 / 100);   
                            $history->profit = $history->amount + ($history->amount * abs($rate->rate_1) / 100);
                        }
                    } elseif ($matched === 5 && in_array($bonus, $myNumbers)) {
                        // "2등";
                        $history->result = 2;
                        if($rate->rate_2 < 0)
                        {
                            $prize->type = 0;
                            $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                            $history->profit = $history->amount - ($history->amount * abs($rate->rate_2) / 100);
                            $prize->money = $history->amount - ($history->amount * abs($rate->rate_2) / 100); 
                        }
                        else{
                            
                            $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_2 / 100);
                            $history->profit = $history->amount + ($history->amount * abs($rate->rate_2) / 100);
                            $prize->type = 1;  
                            $prize->money = $history->amount + ($history->amount *  $rate->rate_2 / 100);   
                        }                            
                    } elseif ($matched === 5) {
                        // "3등";
                        $history->result = 3;
                        if($rate->rate_3 < 0)
                        {
                            $prize->type = 0;
                            $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                            $history->profit = $history->amount - ($history->amount * abs($rate->rate_3) / 100);
                            $prize->money = $history->amount - ($history->amount * abs($rate->rate_3) / 100); 
                        }
                        else{
                            $prize->type = 1;  
                            $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_3 / 100);
                            $history->profit = $history->amount + ($history->amount * abs($rate->rate_3) / 100);
                            $prize->money = $history->amount + ($history->amount *  $rate->rate_3 / 100);   
                        }
                    } elseif ($matched === 4) {
                        // "4등";
                        $history->result = 4;
                        if($rate->rate_4 < 0)
                        {
                            $prize->type = 0;
                            $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                            $history->profit = $history->amount - ($history->amount * abs($rate->rate_4) / 100);
                            $prize->money = $history->amount - ($history->amount * abs($rate->rate_4) / 100); 
                        }
                        else{
                            $prize->type = 1;  
                            $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_4 / 100);
                            $history->profit = $history->amount + ($history->amount * abs($rate->rate_4) / 100);
                            $prize->money = $history->amount + ($history->amount *  $rate->rate_4 / 100);   
                        }
                        
                    } elseif ($matched === 3) {
                        // "5등";
                        $history->result = 5;
                        if($rate->rate_5 < 0)
                        {
                            $prize->type = 0;
                            $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                            $history->profit = $history->amount - ($history->amount * abs($rate->rate_5) / 100);
                            $prize->money = $history->amount - ($history->amount * abs($rate->rate_5) / 100); 
                        }
                        else{
                            $prize->type = 1;  
                            $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_5 / 100);
                            $history->profit = $history->amount + ($history->amount * abs($rate->rate_5) / 100);
                            $prize->money = $history->amount + ($history->amount *  $rate->rate_5 / 100);   
                        }
                    } else {
                        // "꽝";
                        if($rate->rate_7 < 0)
                        {
                            $prize->type = 0;
                            $user->amount = $user->amount + $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                            $history->profit = $history->amount - ($history->amount * abs($rate->rate_7) / 100);
                            $prize->money = $history->amount - ($history->amount * abs($rate->rate_7) / 100); 
                        }
                        else{
                            $prize->type = 1;  
                            $user->amount = $user->amount + $history->amount + ($history->amount *  $rate->rate_7 / 100);
                            $history->profit = $history->amount + ($history->amount * abs($rate->rate_7) / 100);
                            $prize->money = $history->amount + ($history->amount *  $rate->rate_7 / 100);   
                        }
                        $history->result = 0;
                    }
                    $history->status = 1;
                    if($prize->money != 0)   
                    {
                        $prize->cur_amount = $user->amount;
                        $prize->save();
                    }                 
                    $user->save();                    
                    $history->save();

                }
                break;
            }
        return response()->json(['success' => true]);
    }
    
    public function live(){
        $page_title = '로또 목록';
        return view('admin.lotto.live', compact('page_title'));
    }

    public function pri(Request $request){
        $page_title = '프리미엄로또 완료답지';
        $status = $request->query('status');

        if ($status === '0') {
            // 대기중 처리
            $apiUrl = "http://127.0.0.1:9000/list?type=pending&page=1&size=100000";
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true) ?? [];
        } 
        elseif ($status === '1') {
            // 완료 처리
            $apiUrl = "http://127.0.0.1:9000/list?type=finish&page=1&size=100000";
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true) ?? [];
        } 
        else {
            // 전체 처리 → 두 개 API 합치기
            $pendingUrl = "http://127.0.0.1:9000/list?type=pending&page=1&size=100000";
            $finishUrl  = "http://127.0.0.1:9000/list?type=finish&page=1&size=100000";

            $pendingData = json_decode(file_get_contents($pendingUrl), true) ?? [];
            $finishData  = json_decode(file_get_contents($finishUrl), true) ?? [];

            // 두 배열 합치기
            $data = array_merge($pendingData, $finishData);
          
        }
         // startAt 기준으로 내림차순 정렬
        usort($data, function($a, $b) {
            return strtotime($b['startAt']) <=> strtotime($a['startAt']);
        });
        // 컬렉션으로 변환
        $collection = collect($data);

        // 현재 페이지 번호
        $currentPage = request()->get('page', 1);

        // 페이지당 항목 수
        $perPage = 20;

        // LengthAwarePaginator 생성
        $lotteries = new \Illuminate\Pagination\LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.lotto.pri', compact('page_title','lotteries'));
    }

    public function pri1(){
        $page_title = '프리미엄로또 답지';

        $apiUrl = "http://127.0.0.1:9000/list?type=pending&page=1&size=100000";
        $response = file_get_contents($apiUrl);
        
        $data = json_decode($response, true);
        if (!$data) 
        {
            return;                
        }
        $collection = collect($data);

        // 현재 페이지 번호
        $currentPage = request()->get('page', 1);

        // 페이지당 항목 수
        $perPage = 20;

        // LengthAwarePaginator 생성
        $lotteries = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('admin.lotto.pri', compact('page_title','lotteries'));
    }
}
