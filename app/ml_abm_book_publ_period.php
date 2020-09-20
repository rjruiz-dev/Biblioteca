<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_book_publ_period extends Model
{
    protected $fillable = ['many_lenguages_id','tema_de_portada','volumen_numero_y_fecha',
    'periodicidad','issn'];

}
