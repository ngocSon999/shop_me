<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\BaseRepoInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseRepository implements BaseRepoInterface
{

    /**
     * @param array $data
     * @param $model
     * @return mixed
     */
    public function store(array $data, $model): mixed
    {
        return $model::create($data);
    }

    /**
     * @param int $id
     * @param $model
     * @return mixed
     */
    public function getById(int $id, $model): mixed
    {
        return $model::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @param $model
     * @return mixed
     */
    public function update(array $data, int $id, $model): mixed
    {
        $result = $model::find($id);
        if (empty($result)) {
            abort(404);
        }
        $result->update($data);

        return $result;
    }

    /**
     * @param int $id
     * @param $model
     * @return void
     * @throws \Exception
     */
    public function delete(int $id, $model): void
    {
        $result = $model::find($id);
        if (empty($result)) {
            abort(404);
        }

        try {
            DB::beginTransaction();
            $result->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error delete record on table '. $model. ':'. $e->getMessage());

            throw $e;
        }
    }
}
