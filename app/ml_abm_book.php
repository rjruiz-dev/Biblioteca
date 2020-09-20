<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_book extends Model
{
    protected $fillable = ['many_lenguages_id','crear_libro','tipo_de_libro',
    'numero_de_paginas'];
}
