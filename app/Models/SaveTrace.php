<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaveTrace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'record_id', 'table_name', 'data_type', 'action'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
