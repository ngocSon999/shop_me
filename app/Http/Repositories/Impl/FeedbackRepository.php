<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\FeedbackRepoInterface;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;


class FeedbackRepository extends BaseRepository implements FeedbackRepoInterface
{
    public function getAll(): Collection|array
    {
        return Feedback::with('customer')
            ->where('status', 1)
            ->get();
    }
}
