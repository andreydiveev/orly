<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PwAuthService;

class LoginCommand extends Command {

    protected $signature = 'pw:login';

    public function handle()
    {

        $service = new PwAuthService();

        var_dump($service->send());
    }
}