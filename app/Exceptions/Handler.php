<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Traits\v1\apiResponseBuilder;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
     * @param  Request  $request
     * @param  Exception  $e
     *
     * @throws Exception|Throwable
     */
    public function render($request, $e): Response|JsonResponse
    {
        if ($e instanceof ThrottleRequestsException) {
            return $this->responseBuilder(false, Response::HTTP_TOO_MANY_REQUESTS, 'Too many requests.');
        } elseif ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            return $this->responseBuilder(false, Response::HTTP_NOT_FOUND, 'Resource '.str_replace('App', '', $e->getModel()).' not found.');
        } elseif ($e instanceof NotFoundHttpException) {
            return $this->responseBuilder(false, Response::HTTP_NOT_FOUND, 'Route not found.');
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return $this->responseBuilder(false, Response::HTTP_METHOD_NOT_ALLOWED, 'You are not allowed to perform this action.');
        } elseif ($e instanceof QueryException) {
            return $this->responseBuilder(false, Response::HTTP_UNAUTHORIZED, 'Invalid database query.', $e->getMessage());
        } elseif ($e instanceof RelationNotFoundException) {
            return $this->responseBuilder(false, Response::HTTP_INTERNAL_SERVER_ERROR, 'Undefined relationship.');
        } elseif ($e instanceof AuthenticationException) {
            return $this->responseBuilder(false, Response::HTTP_UNAUTHORIZED, 'User not authenticated.');
        } elseif ($e instanceof AuthorizationException) {
            return $this->responseBuilder(false, Response::HTTP_FORBIDDEN, 'This action is unauthorized.');
        } elseif ($e instanceof AccessDeniedHttpException) {
            return $this->responseBuilder(false, Response::HTTP_FORBIDDEN, 'This action is unauthorized.');
        }

        return parent::render($request, $e);
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
