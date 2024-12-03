<?php

namespace App\Http\Repositories;

use Illuminate\Contracts\Auth\Authenticatable;

interface CustomerRepoInterface extends BaseRepoInterface
{
    /**
     * @param $inputs
     * @return mixed
     * @throws \Exception
     */
    public function register($inputs): mixed;

    public function exchangeCoin($coin): bool;

    public function updateProfile($request): ?Authenticatable;
}
