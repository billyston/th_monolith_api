<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Registration\CreateAccountRequest;
use App\Traits\v1\apiResponseBuilder;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    use apiResponseBuilder;

    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(CreateAccountRequest $registrationRequest): JsonResponse
    {
        return response()->json([
            'data' => $registrationRequest,
        ]);
    }
}
