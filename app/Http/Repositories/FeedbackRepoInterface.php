<?php

namespace App\Http\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface FeedbackRepoInterface extends BaseRepoInterface
{
    public function getAll(): Collection|array;
}
