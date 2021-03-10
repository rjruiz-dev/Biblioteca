<div class="row">
   
{!! Form::open([
    'route' => ['admin.manylenguages.update_music', $idioma->id],   
    'method' => 'PUT'
]) !!}

{{ csrf_field() }}   

    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Idioma</h3>
                </div>
            </div>            
            <div class="box-body">
                <div class="form-group" > 
                    {!! Form::label('lenguage_description', 'Idioma') !!}                                  
                    {!! Form::text('lenguage_description', $idioma['lenguage_description'] ? $idioma['lenguage_description'] : null, ['class' => 'form-control', 'id' => 'lenguage_description', 'placeholder' => 'Idioma', 'readonly' => true ]) !!}
                </div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Catalogo Musica</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Titulos Cabeceras </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">                    

                        <div class="form-group">              
                            {!! Form::label('compl_editar', 'Título Superior') !!}                    
                            {!! Form::text('compl_editar', $ml_cat_edit_music['compl_editar'] ? $ml_cat_edit_music['compl_editar'] : null, ['class' => 'form-control', 'id' => 'compl_editar', 'placeholder' => 'Título principal']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_area_de_titulo', 'Area de Titulo') !!}                    
                            {!! Form::text('compl_area_de_titulo', $ml_cat_edit_music['compl_area_de_titulo'] ? $ml_cat_edit_music['compl_area_de_titulo'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_titulo', 'placeholder' => 'Area de Titulo']) !!}
                        </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">              
                            {!! Form::label('compl_area_de_edicion', 'Area de Edicion') !!}                    
                            {!! Form::text('compl_area_de_edicion', $ml_cat_edit_music['compl_area_de_edicion'] ? $ml_cat_edit_music['compl_area_de_edicion'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_edicion', 'placeholder' => 'Area de Edicion']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_area_de_contenidos', 'Area de Contenidos') !!}                    
                            {!! Form::text('compl_area_de_contenidos', $ml_cat_edit_music['compl_area_de_contenidos'] ? $ml_cat_edit_music['compl_area_de_contenidos'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_contenidos', 'placeholder' => 'Area de Contenidos']) !!}
                        </div>
                    </div>
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-12">        
        <div class="box box-primary"  style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Campos y descripcion de los mismos </h3>
                </div>
            </div>
            <div class="box-body">  
            <div class="col-md-4">            
                <div class="form-group">              
                    {!! Form::label('cuerpo_tipo_de_musica', 'Tipo de Musica (Titulo)') !!}                    
                    {!! Form::text('cuerpo_tipo_de_musica', $ml_cat_edit_music['cuerpo_tipo_de_musica'] ? $ml_cat_edit_music['cuerpo_tipo_de_musica'] : null, ['class' => 'form-control', 'id' => 'cuerpo_tipo_de_musica', 'placeholder' => 'Tipo de Musica (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_tipo_de_musica', 'Tipo de musica(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_tipo_de_musica', $ml_cat_edit_music['ph_cuerpo_tipo_de_musica'] ? $ml_cat_edit_music['ph_cuerpo_tipo_de_musica'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_tipo_de_musica', 'placeholder' => 'Tipo de musica(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo_de_la_obra', 'Titulo de la Obra (Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo_de_la_obra', $ml_cat_edit_music['cuerpo_titulo_de_la_obra'] ? $ml_cat_edit_music['cuerpo_titulo_de_la_obra'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo_de_la_obra', 'placeholder' => 'Titulo de la Obra (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo_de_la_obra', 'Titulo de la Obra (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo_de_la_obra', $ml_cat_edit_music['ph_cuerpo_titulo_de_la_obra'] ? $ml_cat_edit_music['ph_cuerpo_titulo_de_la_obra'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo_de_la_obra', 'placeholder' => 'Titulo de la Obra (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo', 'Titulo(Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo', $ml_cat_edit_music['cuerpo_titulo'] ? $ml_cat_edit_music['cuerpo_titulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo', 'placeholder' => 'Titulo(Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo', 'Titulo(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo', $ml_cat_edit_music['ph_cuerpo_titulo'] ? $ml_cat_edit_music['ph_cuerpo_titulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo', 'placeholder' => 'Titulo(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_subtitulo', 'Subtitulo (Titulo)') !!}                    
                    {!! Form::text('cuerpo_subtitulo', $ml_cat_edit_music['cuerpo_subtitulo'] ? $ml_cat_edit_music['cuerpo_subtitulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_subtitulo', 'placeholder' => 'Subtitulo (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_subtitulo', 'Subtitulo (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_subtitulo', $ml_cat_edit_music['ph_cuerpo_subtitulo'] ? $ml_cat_edit_music['ph_cuerpo_subtitulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_subtitulo', 'placeholder' => 'Subtitulo (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_artista', 'Artista (Titulo)') !!}                    
                    {!! Form::text('cuerpo_artista', $ml_cat_edit_music['cuerpo_artista'] ? $ml_cat_edit_music['cuerpo_artista'] : null, ['class' => 'form-control', 'id' => 'cuerpo_artista', 'placeholder' => 'Artista (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_artista', 'Artista(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_artista', $ml_cat_edit_music['ph_cuerpo_artista'] ? $ml_cat_edit_music['ph_cuerpo_artista'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_artista', 'placeholder' => 'Artista(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_otros_artistas', 'Otros Artistas (Titulo)') !!}                    
                    {!! Form::text('cuerpo_otros_artistas', $ml_cat_edit_music['cuerpo_otros_artistas'] ? $ml_cat_edit_music['cuerpo_otros_artistas'] : null, ['class' => 'form-control', 'id' => 'cuerpo_otros_artistas', 'placeholder' => 'Otros Artistas (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_otros_artistas', 'Otros Artistas (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_otros_artistas', $ml_cat_edit_music['ph_cuerpo_otros_artistas'] ? $ml_cat_edit_music['ph_cuerpo_otros_artistas'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_otros_artistas', 'placeholder' => 'Otros Artistas (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_musica', 'Musica (Titulo)') !!}                    
                    {!! Form::text('cuerpo_musica', $ml_cat_edit_music['cuerpo_musica'] ? $ml_cat_edit_music['cuerpo_musica'] : null, ['class' => 'form-control', 'id' => 'cuerpo_musica', 'placeholder' => 'Musica (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_musica', 'Musica (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_musica', $ml_cat_edit_music['ph_cuerpo_musica'] ? $ml_cat_edit_music['ph_cuerpo_musica'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_musica', 'placeholder' => 'Musica (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo_original', 'Titulo Original (Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo_original', $ml_cat_edit_music['cuerpo_titulo_original'] ? $ml_cat_edit_music['cuerpo_titulo_original'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo_original', 'placeholder' => 'Titulo Original (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo_original', 'Titulo Original (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo_original', $ml_cat_edit_music['ph_cuerpo_titulo_original'] ? $ml_cat_edit_music['ph_cuerpo_titulo_original'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo_original', 'placeholder' => 'Titulo Original (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo_del_disco', 'Titulo del Disco (Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo_del_disco', $ml_cat_edit_music['cuerpo_titulo_del_disco'] ? $ml_cat_edit_music['cuerpo_titulo_del_disco'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo_del_disco', 'placeholder' => 'Titulo del Disco (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo_del_disco', 'Titulo del Disco (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo_del_disco', $ml_cat_edit_music['ph_cuerpo_titulo_del_disco'] ? $ml_cat_edit_music['ph_cuerpo_titulo_del_disco'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo_del_disco', 'placeholder' => 'Titulo del Disco (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_compositor', 'Compositor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_compositor', $ml_cat_edit_music['cuerpo_compositor'] ? $ml_cat_edit_music['cuerpo_compositor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_compositor', 'placeholder' => 'Compositor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_compositor', 'Compositor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_compositor', $ml_cat_edit_music['ph_cuerpo_compositor'] ? $ml_cat_edit_music['ph_cuerpo_compositor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_compositor', 'placeholder' => 'Compositor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_director', 'Director (Titulo)') !!}                    
                    {!! Form::text('cuerpo_director', $ml_cat_edit_music['cuerpo_director'] ? $ml_cat_edit_music['cuerpo_director'] : null, ['class' => 'form-control', 'id' => 'cuerpo_director', 'placeholder' => 'Director (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_director', 'Director (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_director', $ml_cat_edit_music['ph_cuerpo_director'] ? $ml_cat_edit_music['ph_cuerpo_director'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_director', 'placeholder' => 'Director (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_orquesta', 'Orquesta (Titulo)') !!}                    
                    {!! Form::text('cuerpo_orquesta', $ml_cat_edit_music['cuerpo_orquesta'] ? $ml_cat_edit_music['cuerpo_orquesta'] : null, ['class' => 'form-control', 'id' => 'cuerpo_orquesta', 'placeholder' => 'Orquesta (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_orquesta', 'Orquesta (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_orquesta', $ml_cat_edit_music['ph_cuerpo_orquesta'] ? $ml_cat_edit_music['ph_cuerpo_orquesta'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_orquesta', 'placeholder' => 'Orquesta (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adquirido', 'Adquirido (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adquirido', $ml_cat_edit_music['cuerpo_adquirido'] ? $ml_cat_edit_music['cuerpo_adquirido'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adquirido', 'placeholder' => 'Adquirido (Titulo)']) !!}
                </div>
        
            </div>
            <div class="col-md-4">
            <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adquirido', 'Adquirido (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adquirido', $ml_cat_edit_music['ph_cuerpo_adquirido'] ? $ml_cat_edit_music['ph_cuerpo_adquirido'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adquirido', 'placeholder' => 'Adquirido (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_genero', 'Genero (Titulo)') !!}                    
                    {!! Form::text('cuerpo_genero', $ml_cat_edit_music['cuerpo_genero'] ? $ml_cat_edit_music['cuerpo_genero'] : null, ['class' => 'form-control', 'id' => 'cuerpo_genero', 'placeholder' => 'Genero (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_genero', 'Genero (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_genero', $ml_cat_edit_music['ph_cuerpo_genero'] ? $ml_cat_edit_music['ph_cuerpo_genero'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_genero', 'placeholder' => 'Genero (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adecuado_para', 'Adecuado para (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adecuado_para', $ml_cat_edit_music['cuerpo_adecuado_para'] ? $ml_cat_edit_music['cuerpo_adecuado_para'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adecuado_para', 'placeholder' => 'Adecuado para (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adecuado_para', 'Adecuado para (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adecuado_para', $ml_cat_edit_music['ph_cuerpo_adecuado_para'] ? $ml_cat_edit_music['ph_cuerpo_adecuado_para'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adecuado_para', 'placeholder' => 'Adecuado para (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_solista', 'Solista (Titulo)') !!}                    
                    {!! Form::text('cuerpo_solista', $ml_cat_edit_music['cuerpo_solista'] ? $ml_cat_edit_music['cuerpo_solista'] : null, ['class' => 'form-control', 'id' => 'cuerpo_solista', 'placeholder' => 'Solista (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_solista', 'Solista (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_solista', $ml_cat_edit_music['ph_cuerpo_solista'] ? $ml_cat_edit_music['ph_cuerpo_solista'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_solista', 'placeholder' => 'Solista (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_productor', 'Productor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_productor', $ml_cat_edit_music['cuerpo_productor'] ? $ml_cat_edit_music['cuerpo_productor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_productor', 'placeholder' => 'Productor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_productor', 'Productor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_productor', $ml_cat_edit_music['ph_cuerpo_productor'] ? $ml_cat_edit_music['ph_cuerpo_productor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_productor', 'placeholder' => 'Productor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_siglas_compositor', 'Siglas compositor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_siglas_compositor', $ml_cat_edit_music['cuerpo_siglas_compositor'] ? $ml_cat_edit_music['cuerpo_siglas_compositor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_siglas_compositor', 'placeholder' => 'Siglas compositor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_siglas_compositor', 'Siglas compositor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_siglas_compositor', $ml_cat_edit_music['ph_cuerpo_siglas_compositor'] ? $ml_cat_edit_music['ph_cuerpo_siglas_compositor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_siglas_compositor', 'placeholder' => 'Siglas compositor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_siglas_titulo', 'Siglas Titulo (Titulo)') !!}                    
                    {!! Form::text('cuerpo_siglas_titulo', $ml_cat_edit_music['cuerpo_siglas_titulo'] ? $ml_cat_edit_music['cuerpo_siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_siglas_titulo', 'placeholder' => 'Siglas Titulo (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_siglas_titulo', 'Siglas Titulo (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_siglas_titulo', $ml_cat_edit_music['ph_cuerpo_siglas_titulo'] ? $ml_cat_edit_music['ph_cuerpo_siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_siglas_titulo', 'placeholder' => 'Siglas Titulo (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_cdu', 'CDU (Titulo)') !!}                    
                    {!! Form::text('cuerpo_cdu', $ml_cat_edit_music['cuerpo_cdu'] ? $ml_cat_edit_music['cuerpo_cdu'] : null, ['class' => 'form-control', 'id' => 'cuerpo_cdu', 'placeholder' => 'CDU (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_cdu', 'CDU (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_cdu', $ml_cat_edit_music['ph_cuerpo_cdu'] ? $ml_cat_edit_music['ph_cuerpo_cdu'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_cdu', 'placeholder' => 'CDU (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_valoracion', 'Valoracion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_valoracion', $ml_cat_edit_music['cuerpo_valoracion'] ? $ml_cat_edit_music['cuerpo_valoracion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_valoracion', 'placeholder' => 'Valoracion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_valoracion', 'Valoracion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_valoracion', $ml_cat_edit_music['ph_cuerpo_valoracion'] ? $ml_cat_edit_music['ph_cuerpo_valoracion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_valoracion', 'placeholder' => 'Valoracion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_estado', 'Estado (Titulo)') !!}                    
                    {!! Form::text('cuerpo_estado', $ml_cat_edit_music['cuerpo_estado'] ? $ml_cat_edit_music['cuerpo_estado'] : null, ['class' => 'form-control', 'id' => 'cuerpo_estado', 'placeholder' => 'Estado (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_estado', 'Estado (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_estado', $ml_cat_edit_music['ph_cuerpo_estado'] ? $ml_cat_edit_music['ph_cuerpo_estado'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_estado', 'placeholder' => 'Estado (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_editado_en', 'editado en (Titulo)') !!}                    
                    {!! Form::text('cuerpo_editado_en', $ml_cat_edit_music['cuerpo_editado_en'] ? $ml_cat_edit_music['cuerpo_editado_en'] : null, ['class' => 'form-control', 'id' => 'cuerpo_editado_en', 'placeholder' => 'editado en (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_editado_en', 'editado en (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_editado_en', $ml_cat_edit_music['ph_cuerpo_editado_en'] ? $ml_cat_edit_music['ph_cuerpo_editado_en'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_editado_en', 'placeholder' => 'editado en (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_sello_discografico', 'Sello Discografico (Titulo)') !!}                    
                    {!! Form::text('cuerpo_sello_discografico', $ml_cat_edit_music['cuerpo_sello_discografico'] ? $ml_cat_edit_music['cuerpo_sello_discografico'] : null, ['class' => 'form-control', 'id' => 'cuerpo_sello_discografico', 'placeholder' => 'Sello Discografico (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_sello_discografico', 'Sello Discografico (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_sello_discografico', $ml_cat_edit_music['ph_cuerpo_sello_discografico'] ? $ml_cat_edit_music['ph_cuerpo_sello_discografico'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_sello_discografico', 'placeholder' => 'Sello Discografico (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_anio_de_publicacion', 'Año de publicacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_anio_de_publicacion', $ml_cat_edit_music['cuerpo_anio_de_publicacion'] ? $ml_cat_edit_music['cuerpo_anio_de_publicacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_anio_de_publicacion', 'placeholder' => 'Año de publicacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_anio_de_publicacion', 'Año de publicacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_anio_de_publicacion', $ml_cat_edit_music['ph_cuerpo_anio_de_publicacion'] ? $ml_cat_edit_music['ph_cuerpo_anio_de_publicacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_anio_de_publicacion', 'placeholder' => 'Año de publicacion (Descripcion)']) !!}
                </div>
                
                
                
                <!-- ---- -->
                
                

                
            </div>
            <div class="col-md-4">
            <div class="form-group">              
                    {!! Form::label('cuerpo_fotografia', 'Fotografia (Titulo)') !!}                    
                    {!! Form::text('cuerpo_fotografia', $ml_cat_edit_music['cuerpo_fotografia'] ? $ml_cat_edit_music['cuerpo_fotografia'] : null, ['class' => 'form-control', 'id' => 'cuerpo_fotografia', 'placeholder' => 'Fotografia (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_fotografia', 'Fotografia (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_fotografia', $ml_cat_edit_music['ph_cuerpo_fotografia'] ? $ml_cat_edit_music['ph_cuerpo_fotografia'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_fotografia', 'placeholder' => 'Fotografia (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_volumenes', 'Volumenes (Titulo)') !!}                    
                    {!! Form::text('cuerpo_volumenes', $ml_cat_edit_music['cuerpo_volumenes'] ? $ml_cat_edit_music['cuerpo_volumenes'] : null, ['class' => 'form-control', 'id' => 'cuerpo_volumenes', 'placeholder' => 'Volumenes (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_volumenes', 'Volumenes (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_volumenes', $ml_cat_edit_music['ph_cuerpo_volumenes'] ? $ml_cat_edit_music['ph_cuerpo_volumenes'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_volumenes', 'placeholder' => 'Volumenes (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_duracion', 'Duracion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_duracion', $ml_cat_edit_music['cuerpo_duracion'] ? $ml_cat_edit_music['cuerpo_duracion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_duracion', 'placeholder' => 'Duracion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_duracion', 'Duracion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_duracion', $ml_cat_edit_music['ph_cuerpo_duracion'] ? $ml_cat_edit_music['ph_cuerpo_duracion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_duracion', 'placeholder' => 'Duracion (Descripcion)']) !!}
                </div>
            <div class="form-group">              
                    {!! Form::label('cuerpo_formato', 'Formato (Titulo)') !!}                    
                    {!! Form::text('cuerpo_formato', $ml_cat_edit_music['cuerpo_formato'] ? $ml_cat_edit_music['cuerpo_formato'] : null, ['class' => 'form-control', 'id' => 'cuerpo_formato', 'placeholder' => 'Formato (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_formato', 'Formato (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_formato', $ml_cat_edit_music['ph_cuerpo_formato'] ? $ml_cat_edit_music['ph_cuerpo_formato'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_formato', 'placeholder' => 'Formato (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_coleccion', 'Coleccion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_coleccion', $ml_cat_edit_music['cuerpo_coleccion'] ? $ml_cat_edit_music['cuerpo_coleccion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_coleccion', 'placeholder' => 'Coleccion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_coleccion', 'Coleccion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_coleccion', $ml_cat_edit_music['ph_cuerpo_coleccion'] ? $ml_cat_edit_music['ph_cuerpo_coleccion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_coleccion', 'placeholder' => 'Coleccion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_ubicacion', 'Ubicacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_ubicacion', $ml_cat_edit_music['cuerpo_ubicacion'] ? $ml_cat_edit_music['cuerpo_ubicacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_ubicacion', 'placeholder' => 'Ubicacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_ubicacion', 'Ubicacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_ubicacion', $ml_cat_edit_music['ph_cuerpo_ubicacion'] ? $ml_cat_edit_music['ph_cuerpo_ubicacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_ubicacion', 'placeholder' => 'Ubicacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_observacion', 'Observacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_observacion', $ml_cat_edit_music['cuerpo_observacion'] ? $ml_cat_edit_music['cuerpo_observacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_observacion', 'placeholder' => 'Observacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_observacion', 'Observacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_observacion', $ml_cat_edit_music['ph_cuerpo_observacion'] ? $ml_cat_edit_music['ph_cuerpo_observacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_observacion', 'placeholder' => 'Observacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_nota', 'Notas (Titulo)') !!}                    
                    {!! Form::text('cuerpo_nota', $ml_cat_edit_music['cuerpo_nota'] ? $ml_cat_edit_music['cuerpo_nota'] : null, ['class' => 'form-control', 'id' => 'cuerpo_nota', 'placeholder' => 'Notas (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_nota', 'Notas (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_nota', $ml_cat_edit_music['ph_cuerpo_nota'] ? $ml_cat_edit_music['ph_cuerpo_nota'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_nota', 'placeholder' => 'Notas (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_idioma', 'Idioma (Titulo)') !!}                    
                    {!! Form::text('cuerpo_idioma', $ml_cat_edit_music['cuerpo_idioma'] ? $ml_cat_edit_music['cuerpo_idioma'] : null, ['class' => 'form-control', 'id' => 'cuerpo_idioma', 'placeholder' => 'Idioma (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_idioma', 'Idioma (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_idioma', $ml_cat_edit_music['ph_cuerpo_idioma'] ? $ml_cat_edit_music['ph_cuerpo_idioma'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_idioma', 'placeholder' => 'Idioma (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_referencia', 'Referencia (Titulo)') !!}                    
                    {!! Form::text('cuerpo_referencia', $ml_cat_edit_music['cuerpo_referencia'] ? $ml_cat_edit_music['cuerpo_referencia'] : null, ['class' => 'form-control', 'id' => 'cuerpo_referencia', 'placeholder' => 'Referencia (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_referencia', 'Referencia (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_referencia', $ml_cat_edit_music['ph_cuerpo_referencia'] ? $ml_cat_edit_music['ph_cuerpo_referencia'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_referencia', 'placeholder' => 'Referencia (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_imagen', 'Imagen (Titulo)') !!}                    
                    {!! Form::text('cuerpo_imagen', $ml_cat_edit_music['cuerpo_imagen'] ? $ml_cat_edit_music['cuerpo_imagen'] : null, ['class' => 'form-control', 'id' => 'cuerpo_imagen', 'placeholder' => 'Imagen (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_imagen', 'Imagen (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_imagen', $ml_cat_edit_music['ph_cuerpo_imagen'] ? $ml_cat_edit_music['ph_cuerpo_imagen'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_imagen', 'placeholder' => 'Imagen (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_sinopsis', 'Sinopsis (Titulo)') !!}                    
                    {!! Form::text('cuerpo_sinopsis', $ml_cat_edit_music['cuerpo_sinopsis'] ? $ml_cat_edit_music['cuerpo_sinopsis'] : null, ['class' => 'form-control', 'id' => 'cuerpo_sinopsis', 'placeholder' => 'Sinopsis (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_sinopsis', 'Sinopsis (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_sinopsis', $ml_cat_edit_music['ph_cuerpo_sinopsis'] ? $ml_cat_edit_music['ph_cuerpo_sinopsis'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_sinopsis', 'placeholder' => 'Sinopsis (Descripcion)']) !!}
                </div>
                
                
            </div>
            </div>
        </div>       
    </div>      
{!! Form::close() !!}    
</div>





  