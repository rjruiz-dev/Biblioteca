<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_movement extends Model
{
       protected $fillable = ['actions_id','users_id'];

       public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
