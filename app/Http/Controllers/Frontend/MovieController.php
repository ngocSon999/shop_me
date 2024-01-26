<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\MovieServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected MovieServiceInterface $movieService;

    public function __construct(
        MovieServiceInterface $movieService,
    )
    {
        $this->movieService = $movieService;
    }

    public function show($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $movie = $this->movieService->getById($id);

        return view('frontend.movie.show', ['movie' => $movie]);
    }
}
