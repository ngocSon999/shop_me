<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ContactServiceInterface extends BaseServiceInterface
{
   public function store(array $data);

   public function update(int $isRead, int $id);

   public function getList(Request $request);
}
