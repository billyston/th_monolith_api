<?php

declare(strict_types=1);

namespace App\Traits\v1;

use Illuminate\Http\JsonResponse;

trait apiResponseBuilder
{
    public function responseBuilder(bool $status, int $code, string $message, array $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'meta' => [
                'version' => '1.0',
                'timestamp' => now()->toDateTime(),
            ],
        ]);
    }
}
