<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\LottoController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalaPriCommand extends Command
{
    /**
     * 명령어 이름
     *
     * @var string
     */
    protected $signature = 'lotto:calculate {id}';

    /**
     * 명령어 설명
     *
     * @var string
     */
    protected $description = 'LottoController의 calculate 함수 실행';

    /**
     * 명령 실행 로직
     */
    public function handle()
    {
        $now = Carbon::now();
        if ($now->minute % 5 === 0 && $now->second === 10) {
            $id = $this->argument('id');
            $request = new Request(['id' => $id]);
            $controller = new LottoController();
            $controller->calculate($request);
        }   
    }
}
