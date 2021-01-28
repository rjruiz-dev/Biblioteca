<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_password extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'pri_nombre_rp', 'seg_nombre_rp',
        'reset_rp', 'reset_msg_rp','email_rp','btn_reestablecer_rp',    
    ];
   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
       