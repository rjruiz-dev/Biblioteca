<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_music_popular extends Model
{
    protected $fillable = ['many_lenguages_id','titulo','subtítulo',
    'artista','otros_artistas','Musica','título_original'];
}
