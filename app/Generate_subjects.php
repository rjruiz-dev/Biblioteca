<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_subjects extends Model
{
    protected $fillable = ['subject_name', 'cdu'];   

    public function document()
    {
        return $this->hasOne(Document::class);
    }
    
}
