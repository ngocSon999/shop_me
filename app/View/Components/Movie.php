<?php

namespace App\View\Components;

use App\Http\Repositories\MovieRepoInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Movie extends Component
{
    protected MovieRepoInterface $movieRepository;
    /**
     * Create a new component instance.
     */
    public function __construct(
        MovieRepoInterface $movieRepository
    )
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $movies = $this->movieRepository->getMovie();

        return view('components.movie', ['movies' => $movies]);
    }
}
