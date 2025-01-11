<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\BannerRepoInterface;
use App\Http\Services\BannerServiceInterface;
use App\Models\Banner;
use App\Traits\StorageTrait;

class BannerService extends BaseService implements BannerServiceInterface
{
    use StorageTrait;
    protected BannerRepoInterface $bannerRepository;

    public function __construct(BannerRepoInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @throws \Exception
     */
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

    /**
     * @throws \Exception
     */
    public function update($request, Banner $banner)
    {
        $oldImage = '';
        if ($request->hasFile('image')) {
            if (!empty($banner->image)) {
                $oldImage = public_path($banner->image);
            }
        }
        $data = $this->formatDataCreateAndUpdateBanner($request);

        $banner = $this->bannerRepository->update($data, $banner->id, Banner::class);

        if (!empty($oldImage)) {
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        return $banner;
    }

    public function getAll()
    {
        return $this->bannerRepository->getAll();
    }

    /**
     * @throws \Exception
     */
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

    public function delete(Banner $banner): void
    {
        if (!empty($banner->image)) {
            $oldImage = public_path($banner->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }
    }
}
