<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    protected $fillable = [
        'username',
        'phone_number',
    ];


    public function link(): HasOne
    {
        return $this->hasOne(Link::class);
    }


    public function games(): HasMany
    {
        return $this->hasMany(Game::class)->orderBy('created_at', 'DESC')->limit(3);
    }

    public function allGames(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function score(){
        return $this->allGames()->sum('sum');
    }

}
