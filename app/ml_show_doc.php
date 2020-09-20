<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_show_doc extends Model
{
    protected $fillable = [ 'many_lenguages_id', 'imagen_de_portada', 'idioma', 'disponible_desde', 
                            'adecuado_para', 'ubicacion','solicitar_prestamo','valoracion','anio',
                            'subtipo_de_documento','titulo','autor','sinopsis','titulo_original',
                            'editorial','nacionalidad','genero','duracion','formato'];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
