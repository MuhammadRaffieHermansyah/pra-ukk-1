<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FotoLike extends Model
{
    protected $table = 'foto_likes';

    protected $fillable = ['foto_id', 'user_id'];

    public function Foto(): BelongsTo
    {
        return $this->belongsTo(Foto::class);
    }
}
