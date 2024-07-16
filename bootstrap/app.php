<?php

use App\Jobs\InitializeTitlesJob;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web', 'auth')
                ->group(base_path('routes/auth.php'));
        }
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->job(new InitializeTitlesJob())->everyMinute();
    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
