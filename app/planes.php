<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class planes extends Model
{
    protected $fillable = [
        'nombre_plan',
        'cantidad_documentos',
        'cantidad_socios',
        'procentaje_documentos',
        'procentaje_socios'];
}
