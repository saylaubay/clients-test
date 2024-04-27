<?php

use App\Models\Rule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use function Illuminate\Foundation\Configuration\withSchedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule) {
        try {
            $rule = Rule::find(1);

            $schedule->command('send-sms')
                ->dailyAt($rule->sendHour . ':' . $rule->sendMinute)
                ->timezone('Asia/Tashkent');

        } catch (Exception $exception){

        }


    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
