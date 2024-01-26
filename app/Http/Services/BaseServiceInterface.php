<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    public function getDataBuilder(Request $request, $model = null): array;
}
