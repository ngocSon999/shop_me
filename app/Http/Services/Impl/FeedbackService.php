<?php

namespace App\Http\Services\Impl;


use App\Http\Repositories\FeedbackRepoInterface;
use App\Http\Services\FeedbackServiceInterface;

class FeedbackService implements FeedbackServiceInterface
{
    protected FeedbackRepoInterface $feedbackRepository;

    public function __construct(FeedbackRepoInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function show()
    {
        return $this->feedbackRepository->getAll();
    }
}
