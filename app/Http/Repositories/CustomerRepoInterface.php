<?php

namespace App\Http\Repositories;


interface CustomerRepoInterface extends BaseRepoInterface
{
    /**
     * @param $inputs
     * @return mixed
     * @throws \Exception
     */
    public function register($inputs): mixed;

    public function exchangeCoin($coin): bool;
}
