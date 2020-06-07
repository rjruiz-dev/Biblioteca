<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['action_description'];

    public function user_movements()
    {
        return $this->hasMany(User_movement::class);
    }
}
