<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $id = $this->argument('id');

        // Request 객체 생성
        $request = new Request(['id' => $id]);

        // 컨트롤러 호출
        $controller = new LottoController();
        $response = $controller->calculate($request);

        // 결과 출력
        $data = $response->getData();
        if (isset($data->success) && $data->success) {
            $this->info("Game ID {$id} → calculate() 함수 실행 성공!");
        } else {
            $this->error("Game ID {$id} → calculate() 함수 실행 실패!");
        }
    }
}
