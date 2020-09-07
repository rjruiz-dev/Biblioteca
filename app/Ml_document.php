<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_document extends Model
{
    protected $fillable = [ 'many_lenguages_id', 'cdu', 'adecuacion', 'idioma', 'tipo_doc', 'subtipo_doc','creador',
                            'titulo','titulo_original', 'adquirido', 'siglas_autor','siglas_titulo',
                            'valoracion', 'desidherata',  'publicado', 'hecho_por','año','volumen','cant_generica',
                            'coleccion', 'ubicacion','observacion', 'nota','sinopsis','foto'
                        ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
