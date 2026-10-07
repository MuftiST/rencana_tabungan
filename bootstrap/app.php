<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendSavingsReminders;

return Application::configure(
    basePath: dirname(__DIR__)
)
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withCommands([SendSavingsReminders::class])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:cek-reminder-tabungan')->daily();
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: ['payments/midtrans/webhook']);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();