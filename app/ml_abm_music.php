<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_music extends Model
{
    protected $fillable = ['many_lenguages_id','crear_musica',
                            'tipo_de_musica','productor',
                            'siglas_compositor','volumenes'];

}
