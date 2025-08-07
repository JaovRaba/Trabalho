<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filme extends Model
{
    protected $fillable = [
        'titulo',
        'sinopse',
        'ano',
        'categoria_id',
        'capa',
        'link',
    ];

    public function categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class);
    }
}
