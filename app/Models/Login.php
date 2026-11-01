<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Login extends Model
{
    // De logins-tabel heeft alleen created_at, geen updated_at.
    const UPDATED_AT = null;

    // belongsTo: deze tabel heeft de user_id kolom
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
