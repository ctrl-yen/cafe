<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['category_id', 'name', 'city', 'image'])]
class Cafe extends Model
{
    // belongsTo: cafes heeft de kolom category_id
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // 1-op-veel: een cafe heeft veel reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
