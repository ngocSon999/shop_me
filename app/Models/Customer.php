<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable, HasFactory, SoftDeletes;

    protected $table = "customers";
    protected $guarded = [];

    protected $hidden = [
      'password'
    ];

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'customer.'.$this->id;
    }

    public function customerHistory(): HasMany
    {
        return $this
            ->hasMany(CustomerHistory::class, 'customer_id', 'id')
            ->orderBy('created_at', 'desc');
    }


    public function products(): HasMany
    {
        return $this
            ->hasMany(Product::class, 'customer_id', 'id')
            ->orderBy('updated_at', 'desc');
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'customer_id', 'id');
    }
}
