<?php

declare(strict_types=1);

namespace App\Traits\v1;

trait Observable
{
    public static function bootObservable(): void
    {
        $observer = '\\App\\Observers\\'.class_basename(static::class).'\\'.class_basename(static::class).'Observer';
        if (! class_exists($observer)) {
            return;
        }

        (new static)->registerObserver($observer);
    }
}
