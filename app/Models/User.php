<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// LET OP: 'role' en 'is_active' staan hier bewust NIET in.
// Anders kan iemand zichzelf admin maken via een extra formulierveld (mass assignment).
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ---- Relaties ----

    // 1-op-veel: een user heeft veel logins
    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    // 1-op-veel: een user schrijft veel reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // 1-op-veel: een user plaatst veel comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // veel-op-veel: de reviews die deze user heeft geliket (tussentabel 'likes')
    public function likedReviews(): BelongsToMany
    {
        return $this->belongsToMany(Review::class, 'likes')->withTimestamps();
    }

    // ---- Hulpfuncties ----

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
