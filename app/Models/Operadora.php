<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Operadora extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'operadora';
    protected $primaryKey = 'id';

    protected $fillable = [ 'id', 'nome', 'obrigatorio'];

}
