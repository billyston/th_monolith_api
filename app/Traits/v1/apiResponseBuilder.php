<?php

declare(strict_types=1);

namespace App\Traits\v1;

use Illuminate\Http\JsonResponse;

trait apiResponseBuilder
{
    public function responseBuilder(bool $status, int $code, string $message, string $description = null, array $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'description' => $description,
            'meta' => [
                'version' => '1.0',
                'timestamp' => now()->toDateTime(),
            ],
            'data' => $data,
        ]);
    }
}
