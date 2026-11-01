<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]
class Category extends Model
{
    // 1-op-veel: een categorie heeft veel cafes
    public function cafes(): HasMany
    {
        return $this->hasMany(Cafe::class);
    }
}
