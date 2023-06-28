<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AnexoChamadoInterno extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

    protected $guarded = ['id'];

    protected $table = 'anexo_chamado_internos';

    protected $fillable =
        [
            'arquivo'
        ];


    public function chamado_internos(): BelongsToMany
    {
        return $this->belongsToMany(ChamadoInterno::class, 'chamado_interno_id');
    }

    public function ticket(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class, 'ticket_id');
    }
}
