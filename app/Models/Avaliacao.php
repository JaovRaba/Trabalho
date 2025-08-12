<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Avaliacao extends Model
{

    protected $table = "avaliacoes";
    protected $fillable = [
        'nota',
        'status',
        'filme_id',
        'user_id',
    ];

    public function avaliacoes() : HasMany{
        return $this->hasMany(Filme::class);
    }
}
