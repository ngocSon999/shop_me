<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Collection;

interface SettingServiceInterface extends BaseServiceInterface
{
    public function update(array $data, int $id);

    public function getSetting(string $slug): Collection;

    public function updateLogo(int $id, $request);
}
