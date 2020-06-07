<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['fines_id','library_name','loan_day','loan_limit'];

    public function fine()
    {
        return $this->belongsTo(Fine::class);
    }
    
}

