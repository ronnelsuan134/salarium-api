<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        BusinessRuleException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (\Throwable $e) {
        });
    }

    public function render($request, \Throwable $exception)
    {
        // Form Exceptions
        if ($exception instanceof ValidationException) {

            return response()->json([
                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Http Exceptions
        if ($exception instanceof HttpException) {
            $message = $exception->getMessage() ?? 'Http Exception!';
            if ($exception->getStatusCode() == Response::HTTP_UNAUTHORIZED) {
                $message = 'UNAUTHORIZED!';
            }

            if ($exception->getStatusCode() == Response::HTTP_FORBIDDEN) {
                $message = 'FORBIDDEN!';
            }
            return response()->json([
                'message' => $message,
            ], $exception->getStatusCode());
        }

        // Internal Exceptions
        if (
            $exception instanceof \Error
            || $exception instanceof \ErrorException
            || $exception instanceof QueryException
            || $exception instanceof ModelNotFoundException
        ) {
            $response = ['message' => 'Internal error, please contact the server administrator!'];

            if (config('app.debug')) {
                if (!empty($exception->getMessage())) {
                    data_set($response, 'error', $exception->getMessage());
                }

                if (!empty($exception->getFile())) {
                    data_set($response, 'file', $exception->getFile());
                }

                if (!empty($exception->getLine())) {
                    data_set($response, 'line', $exception->getLine());
                }
            }

            $errorCodes = [
                Response::HTTP_INTERNAL_SERVER_ERROR,
                Response::HTTP_BAD_REQUEST,
            ];

            $status = (in_array($exception->getCode(), $errorCodes)) ?: Response::HTTP_INTERNAL_SERVER_ERROR;
            return response()->json($response, $status);
        }

        return parent::render($request, $exception);
    }
}
