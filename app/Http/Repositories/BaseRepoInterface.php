<?php

namespace App\Http\Repositories;

interface BaseRepoInterface
{
    /**
     * @param array $data
     * @param $model
     * @return mixed
     */
    public function store(array $data, $model): mixed;

    /**
     * @param int $id
     * @param $model
     * @return mixed
     */
    public function getById(int $id, $model): mixed;

    /**
     * @param array $data
     * @param int $id
     * @param $model
     * @return mixed
     */
    public function update(array $data, int $id, $model): mixed;

    /**
     * @param int $id
     * @param $model
     * @return void
     */
    public function delete(int $id, $model): void;
}
