<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_cine extends Model
{
    protected $fillable = ['many_lenguages_id','crear_cine','reparto',
    'adaptacion','guión','cont_específico','diglas_director','nacionalidad','productora','distribuidora','premios'];
}
