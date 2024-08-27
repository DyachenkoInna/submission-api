<?php

use App\Middlewares\ForceJsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        apiPrefix: 'v1',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->api([ForceJsonResponse::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            fn (TooManyRequestsHttpException $exception) => response()->json(['error' => $exception->getMessage()], 429),
        );
    })->create();
