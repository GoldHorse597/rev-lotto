<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\LottoController;
use Carbon\Carbon;

class ProcessPriCommand extends Command
{
    protected $signature = 'lotto:processpri';
    protected $description = 'LottoController의 processpri 함수 5분 간격으로 호출';

    public function handle()
    {
        $now = Carbon::now();

        // 분이 5의 배수 && 초가 00일 때만 실행
        if ($now->minute % 5 === 0) {
            $controller = new LottoController();
            $controller->processpri();
            $this->info("[" . $now . "] processpri 함수 실행 완료!");
        } else {
            $this->info("[" . $now . "] 실행 조건 불충족 → 스킵");
        }
    }
}