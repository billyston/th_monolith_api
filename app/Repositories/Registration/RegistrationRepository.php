<?php

declare(strict_types=1);

namespace App\Repositories\Registration;

use App\Http\Requests\V1\Registration\VerifyEmailRequest;
use App\Models\User;
use App\Traits\v1\apiResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RegistrationRepository
{
    use apiResponseBuilder;

    /**
     * @param VerifyEmailRequest $verifyEmailRequest
     * @return JsonResponse
     */
    public function verification(VerifyEmailRequest $verifyEmailRequest): JsonResponse
    {
        return DB::transaction(function () use ($verifyEmailRequest) {
            $created = User::query()
                ->create([
                    'resource_id' => Str::ulid()->toBase58(),
                    'email' => $verifyEmailRequest['data.attributes.email'],
                ]);

            return $this->responseBuilder(true, Response::HTTP_OK, '', '', $created->toArray());
        });
    }
}
