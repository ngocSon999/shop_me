<?php

namespace App\Observers;

use App\Http\Services\SaveTraceServiceInterface;
use App\Models\Category;

class CategoryObserver
{
    protected SaveTraceServiceInterface $saveTrace;

    public function __construct(SaveTraceServiceInterface $saveTrace)
    {
        $this->saveTrace = $saveTrace;
    }
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $this->saveTrace->saveTraces($category, 'create');
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $this->saveTrace->saveTraces($category, 'update');
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $this->saveTrace->saveTraces($category, 'delete');
    }
}
