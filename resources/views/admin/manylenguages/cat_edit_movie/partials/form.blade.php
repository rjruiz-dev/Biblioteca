<div class="row">
   
{!! Form::open([
    'route' => ['admin.manylenguages.update_movie', $idioma->id],   
    'method' => 'PUT'
]) !!}

{{ csrf_field() }}   

    <div class="col-md-12">
        <div class="box box-primary">
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
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Catalogo Cine</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="box box-primary">
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
                            {!! Form::text('compl_editar', $ml_cat_edit_movie['compl_editar'] ? $ml_cat_edit_movie['compl_editar'] : null, ['class' => 'form-control', 'id' => 'compl_editar', 'placeholder' => 'Título principal']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_area_de_titulo', 'Area de Titulo') !!}                    
                            {!! Form::text('compl_area_de_titulo', $ml_cat_edit_movie['compl_area_de_titulo'] ? $ml_cat_edit_movie['compl_area_de_titulo'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_titulo', 'placeholder' => 'Area de Titulo']) !!}
                        </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">              
                            {!! Form::label('compl_area_de_edicion', 'Area de Edicion') !!}                    
                            {!! Form::text('compl_area_de_edicion', $ml_cat_edit_movie['compl_area_de_edicion'] ? $ml_cat_edit_movie['compl_area_de_edicion'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_edicion', 'placeholder' => 'Area de Edicion']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_area_de_contenidos', 'Area de Contenidos') !!}                    
                            {!! Form::text('compl_area_de_contenidos', $ml_cat_edit_movie['compl_area_de_contenidos'] ? $ml_cat_edit_movie['compl_area_de_contenidos'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_contenidos', 'placeholder' => 'Area de Contenidos']) !!}
                        </div>
                    </div>
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Campos y descripcion de los mismos </h3>
                </div>
            </div>
            <div class="box-body">  
            <div class="col-md-4">            
              
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo', 'Titulo(Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo', $ml_cat_edit_movie['cuerpo_titulo'] ? $ml_cat_edit_movie['cuerpo_titulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo', 'placeholder' => 'Titulo(Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo', 'Titulo(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo', $ml_cat_edit_movie['ph_cuerpo_titulo'] ? $ml_cat_edit_movie['ph_cuerpo_titulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo', 'placeholder' => 'Titulo(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_subtitulo', 'Subtitulo (Titulo)') !!}                    
                    {!! Form::text('cuerpo_subtitulo', $ml_cat_edit_movie['cuerpo_subtitulo'] ? $ml_cat_edit_movie['cuerpo_subtitulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_subtitulo', 'placeholder' => 'Subtitulo (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_subtitulo', 'Subtitulo (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_subtitulo', $ml_cat_edit_movie['ph_cuerpo_subtitulo'] ? $ml_cat_edit_movie['ph_cuerpo_subtitulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_subtitulo', 'placeholder' => 'Subtitulo (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_director', 'Director (Titulo)') !!}                    
                    {!! Form::text('cuerpo_director', $ml_cat_edit_movie['cuerpo_director'] ? $ml_cat_edit_movie['cuerpo_director'] : null, ['class' => 'form-control', 'id' => 'cuerpo_director', 'placeholder' => 'Director (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_director', 'Director (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_director', $ml_cat_edit_movie['ph_cuerpo_director'] ? $ml_cat_edit_movie['ph_cuerpo_director'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_director', 'placeholder' => 'Director (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_reparto', 'Reparto (Titulo)') !!}                    
                    {!! Form::text('cuerpo_reparto', $ml_cat_edit_movie['cuerpo_reparto'] ? $ml_cat_edit_movie['cuerpo_reparto'] : null, ['class' => 'form-control', 'id' => 'cuerpo_reparto', 'placeholder' => 'Reparto (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_reparto', 'Reparto(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_reparto', $ml_cat_edit_movie['ph_cuerpo_reparto'] ? $ml_cat_edit_movie['ph_cuerpo_reparto'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_reparto', 'placeholder' => 'Reparto(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo_original', 'Titulo Original (Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo_original', $ml_cat_edit_movie['cuerpo_titulo_original'] ? $ml_cat_edit_movie['cuerpo_titulo_original'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo_original', 'placeholder' => 'Titulo Original (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo_original', 'Titulo Original (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo_original', $ml_cat_edit_movie['ph_cuerpo_titulo_original'] ? $ml_cat_edit_movie['ph_cuerpo_titulo_original'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo_original', 'placeholder' => 'Titulo Original (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adaptacion', 'Adaptacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adaptacion', $ml_cat_edit_movie['cuerpo_adaptacion'] ? $ml_cat_edit_movie['cuerpo_adaptacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adaptacion', 'placeholder' => 'Adaptacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adaptacion', 'Adaptacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adaptacion', $ml_cat_edit_movie['ph_cuerpo_adaptacion'] ? $ml_cat_edit_movie['ph_cuerpo_adaptacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adaptacion', 'placeholder' => 'Adaptacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_guion', 'Guion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_guion', $ml_cat_edit_movie['cuerpo_guion'] ? $ml_cat_edit_movie['cuerpo_guion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_guion', 'placeholder' => 'Guion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_guion', 'Guion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_guion', $ml_cat_edit_movie['ph_cuerpo_guion'] ? $ml_cat_edit_movie['ph_cuerpo_guion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_guion', 'placeholder' => 'Guion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_contenido_especifico', 'Contenido Especifico (Titulo)') !!}                    
                    {!! Form::text('cuerpo_contenido_especifico', $ml_cat_edit_movie['cuerpo_contenido_especifico'] ? $ml_cat_edit_movie['cuerpo_contenido_especifico'] : null, ['class' => 'form-control', 'id' => 'cuerpo_contenido_especifico', 'placeholder' => 'Contenido Especifico (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_contenido_especifico', 'Contenido Especifico (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_contenido_especifico', $ml_cat_edit_movie['ph_cuerpo_contenido_especifico'] ? $ml_cat_edit_movie['ph_cuerpo_contenido_especifico'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_contenido_especifico', 'placeholder' => 'Contenido Especifico (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adquirido', 'Adquirido (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adquirido', $ml_cat_edit_movie['cuerpo_adquirido'] ? $ml_cat_edit_movie['cuerpo_adquirido'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adquirido', 'placeholder' => 'Adquirido (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adquirido', 'Adquirido (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adquirido', $ml_cat_edit_movie['ph_cuerpo_adquirido'] ? $ml_cat_edit_movie['ph_cuerpo_adquirido'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adquirido', 'placeholder' => 'Adquirido (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adecuado_para', 'Adecuado para (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adecuado_para', $ml_cat_edit_movie['cuerpo_adecuado_para'] ? $ml_cat_edit_movie['cuerpo_adecuado_para'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adecuado_para', 'placeholder' => 'Adecuado para (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adecuado_para', 'Adecuado para (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adecuado_para', $ml_cat_edit_movie['ph_cuerpo_adecuado_para'] ? $ml_cat_edit_movie['ph_cuerpo_adecuado_para'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adecuado_para', 'placeholder' => 'Adecuado para (Descripcion)']) !!}
                </div>


                
                <!-- ------aaaaaaaaaaaaaaaaa--------- -->
            
            </div>
            <div class="col-md-4">
            
           
                <div class="form-group">              
                    {!! Form::label('cuerpo_genero', 'Genero (Titulo)') !!}                    
                    {!! Form::text('cuerpo_genero', $ml_cat_edit_movie['cuerpo_genero'] ? $ml_cat_edit_movie['cuerpo_genero'] : null, ['class' => 'form-control', 'id' => 'cuerpo_genero', 'placeholder' => 'Genero (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_genero', 'Genero (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_genero', $ml_cat_edit_movie['ph_cuerpo_genero'] ? $ml_cat_edit_movie['ph_cuerpo_genero'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_genero', 'placeholder' => 'Genero (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_siglas_director', 'Siglas director (Titulo)') !!}                    
                    {!! Form::text('cuerpo_siglas_director', $ml_cat_edit_movie['cuerpo_siglas_director'] ? $ml_cat_edit_movie['cuerpo_siglas_director'] : null, ['class' => 'form-control', 'id' => 'cuerpo_siglas_director', 'placeholder' => 'Siglas director (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_siglas_director', 'Siglas director (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_siglas_director', $ml_cat_edit_movie['ph_cuerpo_siglas_director'] ? $ml_cat_edit_movie['ph_cuerpo_siglas_director'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_siglas_director', 'placeholder' => 'Siglas director (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_siglas_titulo', 'Siglas Titulo (Titulo)') !!}                    
                    {!! Form::text('cuerpo_siglas_titulo', $ml_cat_edit_movie['cuerpo_siglas_titulo'] ? $ml_cat_edit_movie['cuerpo_siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_siglas_titulo', 'placeholder' => 'Siglas Titulo (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_siglas_titulo', 'Siglas Titulo (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_siglas_titulo', $ml_cat_edit_movie['ph_cuerpo_siglas_titulo'] ? $ml_cat_edit_movie['ph_cuerpo_siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_siglas_titulo', 'placeholder' => 'Siglas Titulo (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_cdu', 'CDU (Titulo)') !!}                    
                    {!! Form::text('cuerpo_cdu', $ml_cat_edit_movie['cuerpo_cdu'] ? $ml_cat_edit_movie['cuerpo_cdu'] : null, ['class' => 'form-control', 'id' => 'cuerpo_cdu', 'placeholder' => 'CDU (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_cdu', 'CDU (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_cdu', $ml_cat_edit_movie['ph_cuerpo_cdu'] ? $ml_cat_edit_movie['ph_cuerpo_cdu'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_cdu', 'placeholder' => 'CDU (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_valoracion', 'Valoracion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_valoracion', $ml_cat_edit_movie['cuerpo_valoracion'] ? $ml_cat_edit_movie['cuerpo_valoracion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_valoracion', 'placeholder' => 'Valoracion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_valoracion', 'Valoracion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_valoracion', $ml_cat_edit_movie['ph_cuerpo_valoracion'] ? $ml_cat_edit_movie['ph_cuerpo_valoracion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_valoracion', 'placeholder' => 'Valoracion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_estado', 'Estado (Titulo)') !!}                    
                    {!! Form::text('cuerpo_estado', $ml_cat_edit_movie['cuerpo_estado'] ? $ml_cat_edit_movie['cuerpo_estado'] : null, ['class' => 'form-control', 'id' => 'cuerpo_estado', 'placeholder' => 'Estado (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_estado', 'Estado (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_estado', $ml_cat_edit_movie['ph_cuerpo_estado'] ? $ml_cat_edit_movie['ph_cuerpo_estado'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_estado', 'placeholder' => 'Estado (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_nacionalidad', 'Nacionalidad (Titulo)') !!}                    
                    {!! Form::text('cuerpo_nacionalidad', $ml_cat_edit_movie['cuerpo_nacionalidad'] ? $ml_cat_edit_movie['cuerpo_nacionalidad'] : null, ['class' => 'form-control', 'id' => 'cuerpo_nacionalidad', 'placeholder' => 'Nacionalidad (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_nacionalidad', 'Nacionalidad (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_nacionalidad', $ml_cat_edit_movie['ph_cuerpo_nacionalidad'] ? $ml_cat_edit_movie['ph_cuerpo_nacionalidad'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_nacionalidad', 'placeholder' => 'Nacionalidad (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_productora', 'Productora (Titulo)') !!}                    
                    {!! Form::text('cuerpo_productora', $ml_cat_edit_movie['cuerpo_productora'] ? $ml_cat_edit_movie['cuerpo_productora'] : null, ['class' => 'form-control', 'id' => 'cuerpo_productora', 'placeholder' => 'Productora (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_productora', 'Productora (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_productora', $ml_cat_edit_movie['ph_cuerpo_productora'] ? $ml_cat_edit_movie['ph_cuerpo_productora'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_productora', 'placeholder' => 'Productora (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_anio_de_publicacion', 'Año de publicacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_anio_de_publicacion', $ml_cat_edit_movie['cuerpo_anio_de_publicacion'] ? $ml_cat_edit_movie['cuerpo_anio_de_publicacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_anio_de_publicacion', 'placeholder' => 'Año de publicacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_anio_de_publicacion', 'Año de publicacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_anio_de_publicacion', $ml_cat_edit_movie['ph_cuerpo_anio_de_publicacion'] ? $ml_cat_edit_movie['ph_cuerpo_anio_de_publicacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_anio_de_publicacion', 'placeholder' => 'Año de publicacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_fotografia', 'Fotografia (Titulo)') !!}                    
                    {!! Form::text('cuerpo_fotografia', $ml_cat_edit_movie['cuerpo_fotografia'] ? $ml_cat_edit_movie['cuerpo_fotografia'] : null, ['class' => 'form-control', 'id' => 'cuerpo_fotografia', 'placeholder' => 'Fotografia (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_fotografia', 'Fotografia (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_fotografia', $ml_cat_edit_movie['ph_cuerpo_fotografia'] ? $ml_cat_edit_movie['ph_cuerpo_fotografia'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_fotografia', 'placeholder' => 'Fotografia (Descripcion)']) !!}
                </div>
                
                
            </div>
            <div class="col-md-4">
            
               
           
               
                <div class="form-group">              
                    {!! Form::label('cuerpo_duracion', 'Duracion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_duracion', $ml_cat_edit_movie['cuerpo_duracion'] ? $ml_cat_edit_movie['cuerpo_duracion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_duracion', 'placeholder' => 'Duracion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_duracion', 'Duracion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_duracion', $ml_cat_edit_movie['ph_cuerpo_duracion'] ? $ml_cat_edit_movie['ph_cuerpo_duracion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_duracion', 'placeholder' => 'Duracion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_formato', 'Formato (Titulo)') !!}                    
                    {!! Form::text('cuerpo_formato', $ml_cat_edit_movie['cuerpo_formato'] ? $ml_cat_edit_movie['cuerpo_formato'] : null, ['class' => 'form-control', 'id' => 'cuerpo_formato', 'placeholder' => 'Formato (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_formato', 'Formato (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_formato', $ml_cat_edit_movie['ph_cuerpo_formato'] ? $ml_cat_edit_movie['ph_cuerpo_formato'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_formato', 'placeholder' => 'Formato (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_distribuidora', 'Distribuidora (Titulo)') !!}                    
                    {!! Form::text('cuerpo_distribuidora', $ml_cat_edit_movie['cuerpo_distribuidora'] ? $ml_cat_edit_movie['cuerpo_distribuidora'] : null, ['class' => 'form-control', 'id' => 'cuerpo_distribuidora', 'placeholder' => 'Distribuidora (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_distribuidora', 'Distribuidora (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_distribuidora', $ml_cat_edit_movie['ph_cuerpo_distribuidora'] ? $ml_cat_edit_movie['ph_cuerpo_distribuidora'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_distribuidora', 'placeholder' => 'Distribuidora (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_ubicacion', 'Ubicacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_ubicacion', $ml_cat_edit_movie['cuerpo_ubicacion'] ? $ml_cat_edit_movie['cuerpo_ubicacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_ubicacion', 'placeholder' => 'Ubicacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_ubicacion', 'Ubicacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_ubicacion', $ml_cat_edit_movie['ph_cuerpo_ubicacion'] ? $ml_cat_edit_movie['ph_cuerpo_ubicacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_ubicacion', 'placeholder' => 'Ubicacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_premios', 'Premios (Titulo)') !!}                    
                    {!! Form::text('cuerpo_premios', $ml_cat_edit_movie['cuerpo_premios'] ? $ml_cat_edit_movie['cuerpo_premios'] : null, ['class' => 'form-control', 'id' => 'cuerpo_premios', 'placeholder' => 'Premios (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_premios', 'Premios (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_premios', $ml_cat_edit_movie['ph_cuerpo_premios'] ? $ml_cat_edit_movie['ph_cuerpo_premios'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_premios', 'placeholder' => 'Premios (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_nota', 'Notas (Titulo)') !!}                    
                    {!! Form::text('cuerpo_nota', $ml_cat_edit_movie['cuerpo_nota'] ? $ml_cat_edit_movie['cuerpo_nota'] : null, ['class' => 'form-control', 'id' => 'cuerpo_nota', 'placeholder' => 'Notas (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_nota', 'Notas (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_nota', $ml_cat_edit_movie['ph_cuerpo_nota'] ? $ml_cat_edit_movie['ph_cuerpo_nota'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_nota', 'placeholder' => 'Notas (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_idioma', 'Idioma (Titulo)') !!}                    
                    {!! Form::text('cuerpo_idioma', $ml_cat_edit_movie['cuerpo_idioma'] ? $ml_cat_edit_movie['cuerpo_idioma'] : null, ['class' => 'form-control', 'id' => 'cuerpo_idioma', 'placeholder' => 'Idioma (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_idioma', 'Idioma (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_idioma', $ml_cat_edit_movie['ph_cuerpo_idioma'] ? $ml_cat_edit_movie['ph_cuerpo_idioma'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_idioma', 'placeholder' => 'Idioma (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_referencia', 'Referencia (Titulo)') !!}                    
                    {!! Form::text('cuerpo_referencia', $ml_cat_edit_movie['cuerpo_referencia'] ? $ml_cat_edit_movie['cuerpo_referencia'] : null, ['class' => 'form-control', 'id' => 'cuerpo_referencia', 'placeholder' => 'Referencia (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_referencia', 'Referencia (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_referencia', $ml_cat_edit_movie['ph_cuerpo_referencia'] ? $ml_cat_edit_movie['ph_cuerpo_referencia'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_referencia', 'placeholder' => 'Referencia (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_imagen', 'Imagen (Titulo)') !!}                    
                    {!! Form::text('cuerpo_imagen', $ml_cat_edit_movie['cuerpo_imagen'] ? $ml_cat_edit_movie['cuerpo_imagen'] : null, ['class' => 'form-control', 'id' => 'cuerpo_imagen', 'placeholder' => 'Imagen (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_imagen', 'Imagen (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_imagen', $ml_cat_edit_movie['ph_cuerpo_imagen'] ? $ml_cat_edit_movie['ph_cuerpo_imagen'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_imagen', 'placeholder' => 'Imagen (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_sinopsis', 'Sinopsis (Titulo)') !!}                    
                    {!! Form::text('cuerpo_sinopsis', $ml_cat_edit_movie['cuerpo_sinopsis'] ? $ml_cat_edit_movie['cuerpo_sinopsis'] : null, ['class' => 'form-control', 'id' => 'cuerpo_sinopsis', 'placeholder' => 'Sinopsis (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_sinopsis', 'Sinopsis (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_sinopsis', $ml_cat_edit_movie['ph_cuerpo_sinopsis'] ? $ml_cat_edit_movie['ph_cuerpo_sinopsis'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_sinopsis', 'placeholder' => 'Sinopsis (Descripcion)']) !!}
                </div>
                
            </div>
            </div>
        </div>       
    </div>      
{!! Form::close() !!}    
</div>





  