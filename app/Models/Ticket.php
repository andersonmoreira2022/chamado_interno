<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Ticket extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'tickets';

    protected $guarded = ['id'];

    protected $fillable =
        [
          'user_id',
          'setor_id',
          'chamado_interno_id',
          'titulo_tickets_id',
          'nr_ticket',
          'mensagem',
          'status',
          'data_leitura',
          'data_fechamento',
          'criado_por_usuario',
          'created_at',
          'updated_at',
          'empresa'
        ];

    protected $with = ['users', 'chamado_interno', 'titulo_tickets', 'setor'];

    public function users() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   public function chamado_interno(): BelongsTo
   {
       return $this->belongsTo(ChamadoInterno::class, 'chamado_interno_id');
   }

    public function comentario_tickets(): HasMany
    {
        return $this->hasMany(ComentarioTicket::class, 'ticket_id');
    }

    public function anexo_chamado_internos() : HasMany
    {
        return $this->hasMany(AnexoChamadoInterno::class, 'ticket_id');
    }

    public function titulo_tickets() : BelongsTo
    {
        return $this->belongsTo(TituloTickets::class, 'titulo_tickets_id');
    }

    public function setor() : BelongsTo
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }
}
