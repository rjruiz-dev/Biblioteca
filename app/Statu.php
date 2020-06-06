<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{    
    protected $fillable = ['state_description'];

    public function users()
    {
        return $this->hasMany(User::class);
    } 
}
