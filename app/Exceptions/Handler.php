<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    // ...

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $statusCode = 500;
            $message = 'Server Error';
            $errors = [];

            if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
                $statusCode = 404;
                $message = 'Resource not found';
            } elseif ($exception instanceof ValidationException) {
                $statusCode = 422;
                $message = 'Validation Failed';
                $errors = $exception->errors();
            } elseif ($exception instanceof AuthenticationException) {
                $statusCode = 401;
                $message = 'Unauthenticated';
            } else {
                // For debugging purposes, you might include the exception message
                // $message = $exception->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ], $statusCode);
        }

        return parent::render($request, $exception);
    }
}
