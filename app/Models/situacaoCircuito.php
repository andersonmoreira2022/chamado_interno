<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class situacaoCircuito extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'situacao_circuitos';

    protected $primaryKey = 'id';

    protected $fillable = [ 'id', 'situacao', 'created_at', 'updated_at'];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('id', 'like', $term)
                  ->orWhere('situacao', 'like', $term);
        });
    }
}
