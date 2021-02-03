<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_login extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'pri_nombre_is','seg_nombre_is','login_is','login_msg_is', 'email_is',
        'contraseña_is', 'link_pass_is', 'btn_entrar_is'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}

