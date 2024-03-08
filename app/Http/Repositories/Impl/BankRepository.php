<?php

namespace App\Http\Repositories\Impl;

use App\Http\Repositories\BankRepoInterface;
use App\Models\Bank;

class BankRepository extends BaseRepository implements BankRepoInterface
{
    public function getAll()
    {
        return Bank::where('status', 1)->get();
    }
}
