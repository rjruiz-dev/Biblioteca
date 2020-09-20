<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_show_movie extends Model
{ 
    protected $fillable = [ 'many_lenguages_id',
                            'dirigido_por',
                            'sobre_la_pelicula',
                            'reparto', 
                            'productora', 
                            'distribuidora',
                            'detalles_de_la_pelicula',
                            'fotografia'];

public function many_lenguage()
{
return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
}
}
