<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{    
    protected $fillable = ['state_description'];

    public function user()
    {
        return $this->hasOne(User::class);
    } 
}
