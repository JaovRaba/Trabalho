<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Filme extends Model
{
    protected $fillable = [
        'titulo',
        'sinopse',
        'ano',
        'categoria_id',
        'capa',
        'link',
        'status',
    ];

    public function categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class);
    }

public function avaliacoes()
{
    return $this->hasMany(Avaliacao::class);
}

}
