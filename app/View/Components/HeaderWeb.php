<?php

namespace App\View\Components;

use App\Http\Services\CategoryServiceInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderWeb extends Component
{
    protected CategoryServiceInterface $categoryService;

    /**
     * Create a new component instance.
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = $this->categoryService->getAll();

        return view('components.header-web', compact('categories'));
    }
}
