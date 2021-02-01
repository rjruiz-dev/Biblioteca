<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['fines_id','library_name','library_email','library_phone',
                            'language','logo','street','city','province','postal_code',
                            'country','child_age','adult_age','skin','skin_footer','loan_day','loan_limit'];

    public function fine()
    {
        return $this->belongsTo(Fine::class);
    }
    
}

