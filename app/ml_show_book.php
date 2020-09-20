<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_show_book extends Model
{
    protected $fillable = [ 'many_lenguages_id', 
                            'tema_de_portada',
                             'sobre_el_documento', 
                             'subtitulo', 
                            'otros_autores',
                             'publicado_en',
                             'detalles_del_documento',
                             'volumen',
                             'numero_de_paginas',
                            'tamanio']; 

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
