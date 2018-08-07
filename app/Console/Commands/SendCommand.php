<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PwAuthService;

class SendCommand extends Command {

    protected $signature = 'pw:login';

    public function handle()
    {
        $service = new PwAuthService();

        $title = '3322заголовок';
        $text  = '***текст***';

        $result = $service->send($title, $text);

        var_dump($result);
    }
}