<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_abm_doc extends Model
{
    protected $fillable = ['many_lenguages_id','area_de_titulo','area_de_edición',
    'area_de_contenidos','cerrar','crear','titulo',
    'subtítulo','autor','segundo_autor','tercer_autor',
    'título_original','traductor','Isbn','adquirido'
    ,'adecuado_para','siglas_autor','siglas_titulo','cdu'
    ,'valoración','desidherata','contenido_sinopsis_o_indice','publicado_en','anio_de_publicación'
    ,'edicion','tamanio','volumenes','coleccion','editorial'
    ,'ubicacion','idioma','referencia','observacion','genero'
    ,'editado_en','sello_discografico','fotografia','duracion','formato','director'];
}
