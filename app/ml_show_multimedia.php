<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_show_multimedia extends Model
{
    protected $fillable = [ 'many_lenguages_id',
                            'sobre_multimedia', 
                            'detalles_de_multimedia', 
                            'paginas', 
                            'volumen', 
                            'edicion'];

public function many_lenguage()
{
return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
}
}
