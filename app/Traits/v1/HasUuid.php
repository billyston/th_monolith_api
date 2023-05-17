<?php

declare(strict_types=1);

namespace App\Traits\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(fn (Model $model) => $model->resource_id = Str::uuid()->toString());
    }
}
