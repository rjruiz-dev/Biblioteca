<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_dashboard extends Model
{
    protected $fillable = [ 'many_lenguages_id', 'biblioteca', 'iniciar_sesion', 'registrarse', 
                            'navegacion', 'inivitado','en_linea','inicio','libros', 'cines',
                            'musica', 'fotografia', 'multimedia'
                        ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
