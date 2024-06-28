<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username', 'email', 'password', 'is_admin',
        'github_id', 'github_name', 'github_username',
        'github_token', 'github_refresh_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(History::class, 'id_user');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_user');
    }
}
