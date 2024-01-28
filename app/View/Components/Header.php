<?php

namespace App\View\Components;

use App\Http\Repositories\CategoryRepoInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    protected CategoryRepoInterface $categoryRepository;
    /**
     * Create a new component instance.
     */
    public function __construct(
        CategoryRepoInterface $categoryRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = $this->categoryRepository->getList();

        return view('components.header', ['categories' => $categories]);
    }
}
