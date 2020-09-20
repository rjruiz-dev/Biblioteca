<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_show_fotografia extends Model
{
    protected $fillable = [ 'many_lenguages_id',
                            'detalles_de_la_fotografia', 
                            'notas', 
                            'observaciones'];

public function many_lenguage()
{
return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
}

}
