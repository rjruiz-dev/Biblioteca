<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_cat_list_book extends Model
{
    protected $fillable = [
       'book_text_titulo',
       'book_text_inicio',
       'book_ph_referencia',
       'book_ph_materia',
       'book_ph_adecuacion',
       'book_ph_genero',
       'book_btn_buscar',
       'book_btn_crear',
       'book_dt_id',
       'book_dt_titulo',
       'book_dt_subtipo',
       'book_dt_portada',
       'book_dt_genero',
       'book_dt_idioma',
       'book_dt_estado',
       'book_dt_agregado',
       'book_dt_acciones',

       'movie_text_titulo',
       'movie_text_inicio',
       'movie_btn_buscar',
       'movie_btn_crear',
       'movie_ph_referencia',
       'movie_ph_materia',
       'movie_ph_adecuacion',
       'movie_ph_genero',
       'movie_dt_id',
       'movie_dt_titulo',
       'movie_dt_genero',
       'movie_dt_portada',
       'movie_formato',
       'movie_dt_idioma',
       'movie_dt_estado',
       'movie_dt_agregado',
       'movie_dt_acciones',

       'music_text_titulo',
       'music_text_inicio',
       'music_btn_buscar',
       'music_btn_crear',
       'music_ph_referencia',
       'music_ph_materia',
       'music_ph_adecuacion',
       'music_ph_genero',
       'music_dt_id',
       'music_dt_titulo',
       'music_dt_subtipo',
       'music_dt_portada',
       'music_dt_genero',
       'music_dt_idioma',
       'music_dt_estado',
       'music_dt_agregado',
       'music_dt_acciones',

       'fotografia_text_titulo',
       'fotografia_text_inicio',
       'fotografia_btn_buscar',
       'fotografia_btn_crear',
       'fotografia_ph_referencia',
       'fotografia_ph_materia',
       'fotografia_ph_adecuacion',
       'fotografia_ph_genero',
       'fotografia_dt_id',
       'fotografia_dt_titulo',
       'fotografia_dt_subtipo',
       'fotografia_dt_portada',
       'fotografia_dt_formato',
       'fotografia_dt_estado',
       'fotografia_dt_agregado',
       'fotografia_dt_acciones',

       'multimedias_text_titulo',
       'multimedias_text_inicio',
       'multimedias_btn_buscar',
       'multimedias_btn_crear',
       'multimedias_ph_referencia',
       'multimedias_ph_materia',
       'multimedias_ph_adecuacion',
       'multimedias_ph_genero',
       'multimedias_dt_id',
       'multimedias_dt_titulo',
       'multimedias_dt_portada',
       'multimedias_dt_estado',
       'multimedias_dt_agregado',
       'multimedias_dt_acciones',

        // 'mensaje_exito',
        // 'alta_documento',
        // 'actualizacion_documento',
        // 'preg_solicitar_documento',
        // 'aviso_documento_solicitado',
        // 'preg_eliminar_documento',
        // 'aviso_eliminar_documento',
        // 'aviso_doc_en_baja',
        // 'aclaracion_doc_en_baja',
        // 'preg_desidherata_documento',
        // 'aviso_desidherata_documento',
        // 'preg_baja_documento',
        // 'aviso_baja_documento',
        // 'preg_rechazar_documento',
        // 'aviso_rechazar_documento',
        // 'preg_aceptar_documento',
        // 'aviso_aceptar_documento',
        // 'preg_reactivar_documento',
        // 'aviso_reactivar_documento',
];

}
