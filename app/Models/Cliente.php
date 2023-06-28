<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'clientes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'fantasia',
        'cnpj_cpf',
        'status',
        'contato',
        'telefone',
        'email',
        'telefone_fin',
        'email_fin',
        'celular',
        'cargo_cliente',
        'comentario'
    ];

    public function cliente_tecnicos(){
        return $this->belongsTo(ClienteTecnico::class, 'cnpj_cpf');
    }
}
