<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\BannerRepoInterface;
use App\Http\Repositories\ProductRepoInterface;
use App\Http\Services\BannerServiceInterface;
use App\Models\Banner;
use App\Models\Product;
use App\Traits\StorageTrait;

class BannerService extends BaseService implements BannerServiceInterface
{
    use StorageTrait;
    protected BannerRepoInterface $bannerRepository;

    public function __construct(BannerRepoInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function store($request)
    {
        $data = $this->formatDataCreateAndUpdateBanner($request);

        return $this->bannerRepository->store($data, Banner::class);
    }

    public function getList($request): array
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'name',
                    'description',
                    'link',
                ],
                'inputFields' => [
                    'position' => $request->position,
                    'active' => $request->status,
                ],
            ]
        ];

        $request->merge($filter);

        return $this->getDataBuilder($request, Banner::class);
    }

    public function getById($id)
    {
        return $this->bannerRepository->getById($id, Banner::class);
    }

    public function update($request, $id)
    {
        $data = $this->formatDataCreateAndUpdateBanner($request);

        return $this->bannerRepository->update($data, $id, Banner::class);
    }

    public function delete($id = null): void
    {
        $this->bannerRepository->delete($id, Banner::class);
    }

    public function getAll()
    {
        return $this->bannerRepository->getAll();
    }

    public function formatDataCreateAndUpdateBanner($request): array
    {
        if (!empty($request->image)) {
            $resultPath = $this->storageTraitUpload($request, 'image','banners');
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'active' => $request->active,
            'link' => $request->link,
            'position' => $request->position,
        ];

        if (!empty($resultPath)) {
            $data['image'] = $resultPath['file_path'];
        }

        return $data;
    }
}
