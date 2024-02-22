<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function sellProduct($id);
}
