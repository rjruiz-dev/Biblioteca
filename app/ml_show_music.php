<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_show_music extends Model
{
    protected $fillable = [ 'many_lenguages_id',
                            'titulo_de_la_obra',
                            'director',
                            'sobre_la_musica',  
                            'compositor',
                            'orquesta',
                            'editado_en',
                            'sello_discofrafico',
                            'detalles_de_la_musica'];
                        
public function many_lenguage()
{
return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
}
}
