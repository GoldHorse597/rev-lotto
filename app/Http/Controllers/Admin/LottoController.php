<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Game;
use App\Models\Rate;
use Illuminate\Support\Facades\Http;

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
        $game->round = $round;
        $date = new \DateTime($drawDate);
        $date->modify('next saturday'); // 다음 주 토요일로 이동
        $game->weekday = $date->format('Y-m-d').' 20:00:00';
        $game->save();
    }
    private function processlive(){

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
        $url = "https://kr.lottolyzer.com/public/rss/2.0/lottolyzer.news.xml";
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

                if ($weekday == 1) { // 월요일
                    $date->modify('next Thursday');
                } elseif ($weekday == 4) { // 목요일
                    $date->modify('next Monday');
                }
                $game->weekday = $date->format('Y-m-d').' 18:45:00';
                break;
            case 8:
                $date->modify('next Friday');
                $game->weekday = $date->format('Y-m-d').' 18:45:00';
                break;
            case 9:
                $date->modify('next Tuesday');
                $game->weekday = $date->format('Y-m-d').' 18:45:00';
                break; 
        }       
        $game->save();
    }
    
}
