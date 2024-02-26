<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BankRepoInterface extends BaseRepoInterface
{
    public function getAll();
}
