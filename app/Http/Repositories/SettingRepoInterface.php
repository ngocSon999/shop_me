<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface SettingRepoInterface extends BaseRepoInterface
{
    public function getSetting(string $slug): Collection;
}
