<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Ping;

use App\Traits\v1\apiResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PingController
{
    use apiResponseBuilder;

    public function __invoke(Request $request): JsonResponse
    {
        return $this->responseBuilder(true, Response::HTTP_OK, 'Service is online.', null);
    }
}
