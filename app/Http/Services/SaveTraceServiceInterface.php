<?php
namespace App\Http\Services;;

interface SaveTraceServiceInterface
{
    public function saveTraces($collect, $action = null): void;
}
