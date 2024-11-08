<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentFoto extends Model
{
    protected $table = 'comment_fotos';

    protected $fillable = ['foto_id', 'user_id', 'comment'];

    public function Foto(): BelongsTo
    {
        return $this->belongsTo(Foto::class);
    }
}
