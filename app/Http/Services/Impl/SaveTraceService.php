<?php
namespace App\Http\Services\Impl;

use App\Http\Services\SaveTraceServiceInterface;
use App\Models\SaveTrace;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SaveTraceService implements SaveTraceServiceInterface
{
    public function saveTraces($collect, $action = null): void
    {
        $data = [
            'user_id' => Sentinel::getUser()?->id,
            'record_id' => $collect->id,
            'table_name' => $collect->getTableName(),
            'action' => $action,
        ];

        SaveTrace::create($data);
    }
}
