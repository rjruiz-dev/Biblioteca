<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanction extends Model
{
    protected $fillable = ['fines_id', 'users_id', 'copies_id', 'from', 'until', 'valor', 'status'];
   
    public function fine()
    {
        return $this->belongsTo(Fine::class, 'fines_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function copy()
    {
        return $this->belongsTo(Copy::class, 'copies_id');
    }

}
