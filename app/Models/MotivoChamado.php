<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MotivoChamado extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'titulo',
        'descricao',
        'situacao_inicial_id',
        'situacao_final_id',
        'comentario_inicial',
        'inativo',
        'comentario_final'
    ];

    public function situacao_inicial() : BelongsTo
    {
        return $this->belongsTo(situacaoCircuito::class, 'situacao_inicial_id');
    }

    public function situacao_final() : BelongsTo
    {
        return $this->belongsTo(situacaoCircuito::class, 'situacao_final_id');
    }
}
