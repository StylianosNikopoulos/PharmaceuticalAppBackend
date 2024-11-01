<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Nop;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use Throwable;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $exception) {
            return $request->is('api/*');
        });
        // Define how to render NotFoundHttpException
        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {
            // Return JSON response for NotFoundHttpException
            return response()->json([
                'message' => $exception->getMessage(), 
            ], 404);
        });

    })->create();