<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class TituloTickets extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'titulo_tickets';
    protected $guarded = ['id'];

    protected $fillable = ['titulo', 'setor_id'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function setor() : BelongsTo
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }
}
