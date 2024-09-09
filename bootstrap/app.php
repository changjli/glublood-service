<?php

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(CorsMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // kalo mau pake custom middleware buat exception disini
        $exceptions->render(function (AuthenticationException $e) {
            return response()->json([
                'status' => 401,
                'message' => 'Not Authenticated',
            ], 401);
        });

        $exceptions->render(function (QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong! Process not completed',
            ], 200);
        });

        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Resource not found!',
            ], 200);
        });

        $exceptions->render(function (HttpClientException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'External error!',
            ], 200);
        });

        // $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
        //     if ($request->is('api/*')) {
        //         return true;
        //     }

        //     return $request->expectsJson();
        // });
    })->create();
