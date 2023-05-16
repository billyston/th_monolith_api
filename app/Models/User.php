<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\v1\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasUuid;
    use HasFactory;

    /**
     * @var mixed|string
     */
    protected mixed $resource_id;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'resource_id',
        'first_name',
        'last_name',
        'avatar',
        'status',
        'email',
        'password',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'resource_id';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'id'];
}
