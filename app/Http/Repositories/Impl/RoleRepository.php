<?php

namespace App\Http\Repositories\Impl;

use App\Http\Repositories\RoleRepoInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends BaseRepository implements RoleRepoInterface
{
    public function getAll(): Collection
    {
        return Role::all();
    }
}
