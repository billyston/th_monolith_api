<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Ping;

use Illuminate\Http\Request;

final class PingController
{
    public function __invoke( Request $request ) : bool
    {
        return true;
    }
}
