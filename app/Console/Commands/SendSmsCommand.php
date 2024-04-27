<?php

namespace App\Console\Commands;

use App\Jobs\SmsSend;
use Illuminate\Console\Command;

class SendSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sms succesfully sended';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SmsSend::dispatch();
    }
}
