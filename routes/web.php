<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/entrypointi6l9bpCsguYpc', function () use ($router) {
    try {
        $bot = new \TelegramBot\Api\Client(env('TELEGRAM_BOT_TOKEN'));
        // or initialize with botan.io tracker api key
        // $bot = new \TelegramBot\Api\Client('YOUR_BOT_API_TOKEN', 'YOUR_BOTAN_TRACKER_API_KEY');

        $bot->command('start', function ($message) use ($bot) {
            $msg = "Welcome!";
            $bot->sendMessage($message->getChat()->getId(), $msg);
        });

        $bot->command('list', function ($message) use ($bot) {
            $msg = "List...\n";
            $g = new \Google\Authenticator\GoogleAuthenticator();

            try {
                $secrets = \App\Models\Secret::get();
                foreach ($secrets as $s) {
                    $msg .= $g->getCode($s->secret) . " - " . $s->label . "\n";
                }
            } catch (\Exception $e) {
                $msg .= $e->getMessage();
            }
            $bot->sendMessage($message->getChat()->getId(), $msg);
        });

        $bot->run();

    } catch (\TelegramBot\Api\Exception $e) {
        $e->getMessage();
    }
});

