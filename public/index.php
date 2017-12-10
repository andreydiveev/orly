<?php
require_once "../vendor/autoload.php";

try {
    $bot = new \TelegramBot\Api\Client(getenv('TELEGRAM_BOT_TOKEN'));

    $bot->command('ping', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), 'pong');
    });
    $bot->run();
} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}
