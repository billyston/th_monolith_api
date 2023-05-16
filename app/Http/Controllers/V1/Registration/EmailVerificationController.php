<?php

namespace App\Http\Controllers\V1\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Registration\VerifyEmailRequest;
use App\Repositories\Registration\RegistrationRepository;
use Illuminate\Http\JsonResponse;

class EmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyEmailRequest $verifyEmailRequest, RegistrationRepository $registrationRepository): JsonResponse
    {
        return $registrationRepository->verification($verifyEmailRequest);
    }
}
