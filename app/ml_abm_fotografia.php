<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_fotografia extends Model
{
    protected $fillable = ['many_lenguages_id','crear_fotografia','tipo_de_fotografia',
    'realizador','edicion','num_diapositivas','Observaciones','detalles_de_la_fotografia'];

}
