<?php

namespace App\Models;

use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
    protected $fillable = [
        'slug',
        'name',
        'permissions',
        'created_at',
        'updated_at',
    ];
}
