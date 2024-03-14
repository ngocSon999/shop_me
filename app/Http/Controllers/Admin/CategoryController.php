<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseAdminController
{
    protected  CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admins.categories.index');
    }

    public function createForm($categoryId = null): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $category= $categoryId ? $this->categoryService->getById($categoryId) : null;

        return view('admins.categories.form_create', compact('category'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categoryService->store($request);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công');
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->categoryService->getList($request);

        return response()->json($data);

    }

    public function edit($id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $category = $this->categoryService->getById($id);

        return view('admins.categories.form_create', compact('category'));
    }

    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $this->categoryService->update($request, $id);

        return redirect()->route('admin.categories.index')->with('success', 'update danh mục thành công!');
    }

    public function delete($id): RedirectResponse
    {
        $this->categoryService->delete($id);

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}
