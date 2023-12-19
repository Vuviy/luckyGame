<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = ['result', 'user_id', 'sum'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
