<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaliacao extends Model
{
    protected $table = "avaliacoes";
    protected $fillable = [
        'nota',
        'status',
        'filme_id',
        'user_id',
    ];

    public function filme(): BelongsTo
    {
        return $this->belongsTo(Filme::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
