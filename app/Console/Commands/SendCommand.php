<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PwAuthService;

class SendCommand extends Command {

    protected $signature = 'pw:login';

    public function handle()
    {
$bot = '';
$r = function ($message) use ($bot) {
            $msg = "List...\n";
            $g = new \Google\Authenticator\GoogleAuthenticator();

                $secrets = \App\Models\Secret::get();
                foreach ($secrets as $s) {
                    $msg .= $g->getCode($s->secret) . " - " . $s->label . "\n";
                }
echo $msg;exit;
};$r('ff');

        $service = new PwAuthService();

        $title = '3322заголовок';
        $text  = '***текст***';

        $result = $service->send($title, $text);

        var_dump($result);
    }
}