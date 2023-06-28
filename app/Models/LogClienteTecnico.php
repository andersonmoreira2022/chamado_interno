<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LogClienteTecnico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'log_cliente_tecnicos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'usuario',
        'avatar',
        'designacao',
        'situacao',
        'comentario',
        'file_tmp',
        'file_name'
    ];

    public function cliente_tecnicos() {
        return $this->belongsTo(ClienteTecnico::class, 'designacao');
    }
}
