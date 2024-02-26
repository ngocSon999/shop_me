<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = "customers";
    protected $guarded = [];

    protected $hidden = [
      'password'
    ];

    public function customerHistory(): HasMany
    {
        return $this->hasMany(CustomerHistory::class, 'customer_id', 'id');
    }
}
