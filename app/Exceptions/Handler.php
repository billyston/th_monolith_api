<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Traits\v1\apiResponseBuilder;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use apiResponseBuilder;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
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
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return Response|JsonResponse
     * @throws Exception|Throwable
     */
    public function render($request, $exception): Response|JsonResponse
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return $this->responseBuilder(false, Response::HTTP_NOT_FOUND, 'Resource not found.');
        } elseif ($exception instanceof NotFoundHttpException) {
            return $this->responseBuilder(false, Response::HTTP_NOT_FOUND, 'Route not found.');
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            return $this->responseBuilder(false, Response::HTTP_METHOD_NOT_ALLOWED, 'You are not allowed to perform this action.');
        } elseif ($exception instanceof QueryException) {
            return $this->responseBuilder(false, Response::HTTP_UNAUTHORIZED, 'Invalid database query.');
        } elseif ($exception instanceof RelationNotFoundException) {
            return $this->responseBuilder(false, Response::HTTP_INTERNAL_SERVER_ERROR, 'Undefined relationship.');
        } elseif ($exception instanceof AuthenticationException) {
            return $this->responseBuilder(false, Response::HTTP_UNAUTHORIZED, 'User not authenticated.');
        } elseif ($exception instanceof ThrottleRequestsException) {
            return $this->responseBuilder(false, Response::HTTP_TOO_MANY_REQUESTS, 'Too many requests.');
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
