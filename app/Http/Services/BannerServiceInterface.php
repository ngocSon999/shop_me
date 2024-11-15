<?php

namespace App\Http\Services;

use App\Models\Banner;
use Illuminate\Http\Request;

interface BannerServiceInterface extends BaseServiceInterface
{
    public function store(Request $request);

    public function getList(Request $request): array;

    public function getById(int $id);

    public function update(Request $request, Banner $banner);

    public function getAll();

    public function formatDataCreateAndUpdateBanner($request): array;

    public function delete(Banner $banner): void;
}
