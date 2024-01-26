<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';

    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'categories_movies',
            'movie_id',
            'category_id'
        )->withTimestamps();
    }
}
