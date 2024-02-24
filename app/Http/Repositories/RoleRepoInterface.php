<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface RoleRepoInterface extends BaseRepoInterface
{
    public function getAll();
}
