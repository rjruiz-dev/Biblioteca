<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_send_letter extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo', 'subtitulo', 'select_modelo',
        'ph_modelo', 'fecha', 'select_enviar', 'ph_enviar', 'check_informe',                     
        'btn_email'    
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }   
}
