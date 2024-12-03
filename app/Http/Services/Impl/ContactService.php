<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\CategoryRepoInterface;
use App\Http\Repositories\ContactRepoInterface;
use App\Http\Services\ContactServiceInterface;
use App\Models\Category;
use App\Models\Contact;
use App\Traits\StorageTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactService extends BaseService implements ContactServiceInterface
{
    protected ContactRepoInterface $contactRepository;

    public function __construct(ContactRepoInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @throws \Exception
     */
    public function store(array $data)
    {

        if (empty($data['email'])) {
           if (auth()->check()) {
               $data['email'] = auth()->user()->email;
               $data['customer_id'] = auth()->user()->id;
           }
        }
        if ($data['email'] && auth()->check()) {
            $data['customer_id'] = auth()->user()->id;
        }

        return $this->contactRepository->store($data, Contact::class);
    }

    public function update(int $isRead, int $id)
    {
        $data = [
            'is_read' => $isRead
        ];
        return $this->contactRepository->update($data, $id, Contact::class);
    }

    public function getList(Request $request): array
    {
        $request->merge([
            'filter' => [
                'searchColumns' => [
                    'name',
                    'email',
                    'subject',
                    'message'
                ],
                'inputFields' => [
                    'is_read' => $request->input('is_read')
                ],
            ],
            'withRelation' => ['customer']
        ]);

        return $this->getDataBuilder($request, Contact::class);
    }

//    public function getList($request): array
//    {
//        $request->merge([
//            'filter' => [
//                'searchColumns' => [
//                    'name',
//                    'slug'
//                ]
//            ]
//        ]);
//        return $this->getDataBuilder($request, Category::class);
//    }
//
//    public function getById($id = null)
//    {
//        return $this->categoryRepository->getById($id, Category::class);
//    }
//
//    /**
//     * @throws \Exception
//     */
//    public function update($request, $id): void
//    {
//        $data = [
//            'name' => $request->name,
//            'slug' => Str::slug($request->name),
//        ];
//        if (!empty($request->image)) {
//            $resultPath = $this->storageTraitUpload($request, 'image','categories');
//            if ($resultPath) {
//                $data['image'] =  $resultPath['file_path'];
//            }
//        }
//        $this->categoryRepository->update($data, $id, Category::class);
//    }
//
//    public function delete($id = null): void
//    {
//        $this->categoryRepository->delete($id, Category::class);
//    }
//
//    public function getAll(): Collection
//    {
//        return $this->categoryRepository->getList();
//    }
}
