<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Foto extends Model
{
    protected $table = 'fotos';

    protected $fillable = [
        'name',
        'description',
        'file_location',
        'album_id',
        'category_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fotoLikes(): HasMany
    {
        return $this->hasMany(FotoLike::class);
    }

    public function commentFotos(): HasMany
    {
        return $this->hasMany(CommentFoto::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(FotoCategory::class);
    }
}
