<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_movement extends Model
{
       protected $fillable = ['actions_id','users_id','usuario_aud'];

       public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
