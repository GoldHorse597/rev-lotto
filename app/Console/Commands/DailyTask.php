<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:task';
    protected $description = '매일 자정 실행되는 작업';

    public function handle(): void
    {
        \Log::info('[DailyTask] 자정에 실행됨');
        // 원하는 로직 실행
    }
}
