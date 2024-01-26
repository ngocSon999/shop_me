<?php

namespace App\Observers;

use App\Http\Services\SaveTraceServiceInterface;
use App\Models\User;

class UserObserver
{
    protected SaveTraceServiceInterface $saveTrace;

    public function __construct(SaveTraceServiceInterface $saveTrace)
    {
        $this->saveTrace = $saveTrace;
    }

    public bool $afterCommit = true;
    /**
     * Handle the User "created" event.
     */
    /**
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        $this->saveTrace->saveTraces($user, 'create');
    }

    /**
     * Handle the User "updated" event.
     */
    /**
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        $this->saveTrace->saveTraces($user, 'update');
    }

    /**
     * Handle the User "deleted" event.
     */
    /**
     * @param User $user
     * @return void
     */
    public function deleted(User $user): void
    {
        $this->saveTrace->saveTraces($user, 'delete');
    }
}
