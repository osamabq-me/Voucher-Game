<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username', 'email', 'password', 'is_admin'
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
        return $this->hasMany(Favorite::class, 'id_user');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_user');
    }
}
