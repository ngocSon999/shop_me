<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class, 'categories_products', 'product_id', 'category_id'
        )->withPivot([]);
    }
}
