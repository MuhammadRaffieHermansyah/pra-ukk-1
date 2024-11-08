<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FotoCategory extends Model
{
    protected $table = 'foto_categories';

    protected $fillable = ['name'];

    public function foto(): BelongsTo
    {
        return $this->belongsTo(Foto::class);
    }
}
