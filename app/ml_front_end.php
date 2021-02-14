<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_front_end extends Model
{
    protected $fillable = [ 
    'many_lenguages_id', 
    'doc_mas_recientes',
    'recientes_cinco',
    'recientes_diez',
    'recientes_veinte',
    'recientes_cincuenta',
    'doc_mas_reservados',
    'reservados_cinco',
    'reservados_diez',
    'reservados_veinte',
    'reservados_cincuenta',
    'mas_info'
    ];
}
