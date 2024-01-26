<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class BaseAdminController extends Controller
{
    public function returnJsonError(\Exception $exception): JsonResponse
    {
        return response()->json([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ]);
    }
}
