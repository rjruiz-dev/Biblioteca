<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_movie extends Model
{
    protected $fillable = [ 'many_lenguages_id', 'genero', 'formato', 'adaptacion', 
                            'fotografia_tipo', 'subtitulo','guion','contenido_especifico', 'premios',
                            'distribuidor'
                        ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
