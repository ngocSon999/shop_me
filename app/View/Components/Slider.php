<?php

namespace App\View\Components;

use App\Http\Repositories\MovieRepoInterface;
use App\Http\Services\MovieServiceInterface;
use App\Models\Movie;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    protected MovieServiceInterface $movieService;
    protected MovieRepoInterface $movieRepository;
    /**
     * Create a new component instance.
     */
    public function __construct(
        MovieServiceInterface $movieService,
        MovieRepoInterface $movieRepository
    )
    {
        $this->movieService = $movieService;
        $this->movieRepository = $movieRepository;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $movies = $this->movieRepository->getSlide();

        return view('components.slider', ['movies' => $movies]);
    }
}
