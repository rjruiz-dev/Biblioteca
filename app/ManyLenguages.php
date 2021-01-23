<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManyLenguages extends Model
{
    protected $fillable = ['lenguage_description','baja'];

    public function ml_dashboard()
    {
        return $this->hasMany(Ml_dashboard::class);
    }

    public function ml_document()
    {
        return $this->hasMany(Ml_document::class);
    }

    public function ml_movie()
    {
        return $this->hasMany(Ml_movie::class);
    }

    public function ml_course()
    {
        return $this->hasMany(Ml_course::class);
    }

    public function ml_reference()
    {
        return $this->hasMany(Ml_reference::class);
    }

    public function ml_graphic_format()
    {
        return $this->hasMany(Ml_graphic_format::class);
    }

    public function ml_language()
    {
        return $this->hasMany(Ml_language::class);
    }
    
    public function ml_periodical_publication()
    {
        return $this->hasMany(Ml_periodical_publication::class);
    }

    public function ml_literary_genre()
    {
        return $this->hasMany(Ml_literary_genre::class);
    }

    public function ml_musical_genre()
    {
        return $this->hasMany(Ml_musical_genre::class);
    }

    public function ml_cinematographic_genre()
    {
        return $this->hasMany(Ml_cinematographic_genre::class);
    }

    public function ml_adequacy()
    {
        return $this->hasMany(Ml_adequacy::class);
    }

    public function ml_subjects()
    {
        return $this->hasMany(Ml_subjects::class);
    }

    public function ml_letter()
    {
        return $this->hasMany(Ml_letter::class);
    }

    public function ml_loan_by_date()
    {
        return $this->hasMany(Ml_loan_by_date::class);
    }

    public function ml_classroom_loan()
    {
        return $this->hasMany(Ml_classroom_loan::class);
    }
    
    public function ml_database_record()
    {
        return $this->hasMany(Ml_database_record::class);
    }

    public function ml_statistic()
    {
        return $this->hasMany(Ml_statistic::class);
    }

    public function ml_library_profile()
    {
        return $this->hasMany(Ml_library_profile::class);
    }

    public function ml_manual_loan()
    {
        return $this->hasMany(Ml_manual_loan::class);
    }

    public function ml_web_loan()
    {
        return $this->hasMany(Ml_web_loan::class);
    }

    public function ml_loan_partner()
    {
        return $this->hasMany(Ml_loan_partner::class);
    }

    public function ml_loan_document()
    {
        return $this->hasMany(Ml_loan_document::class);
    }

    public function ml_send_letter()
    {
        return $this->hasMany(Ml_send_letter::class);
    }

    public function ml_partner()
    {
        return $this->hasMany(Ml_partner::class);
    }

    public function ml_web_request()
    {
        return $this->hasMany(Ml_web_request::class);
    }

    public function ml_login()
    {
        return $this->hasMany(Ml_login::class);
    }

    public function ml_registry()
    {
        return $this->hasMany(Ml_registry::class);
    }
}
