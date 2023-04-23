<?php

declare(strict_types=1);

namespace App\Traits\v1;

use Illuminate\Http\JsonResponse;

trait apiResponseBuilder
{
    public function responseBuilder($status, $code, $message, $data): JsonResponse
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
