<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class ChamadoInterno extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'chamado_internos';

    protected $guarded = ['id'];

    protected $fillable =
        [
          'id',
          'motivo_chamados_id',
          'descricao',
          'demandante',
          'status',
          'designacao',
          'data_previsao',
          'created_at',
          'updated_at',
          'empresa'
        ];

    protected $with = ['motivo_chamado', 'cliente_tecnico'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function anexo_chamado_internos() : HasMany
    {
        return $this->hasMany(AnexoChamadoInterno::class, 'chamado_interno_id');
    }

    public function motivo_chamado() : BelongsTo
    {
        return $this->belongsTo(MotivoChamado::class, 'motivo_chamados_id');
    }

    public function cliente_tecnico() : BelongsTo
    {
        return $this->belongsTo(ClienteTecnico::class, 'designacao');
    }

}
