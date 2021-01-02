<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_database_record extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_dr', 'dt_id_dr',  'dt_concepto_dr','dt_registro_dr'     
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
