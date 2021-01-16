<div class="row">
   
{!! Form::open([
    'route' => ['admin.manylenguages.update_listado', $idioma->id],   
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
                    <h2 class="box-title">Traducciones Listados Catalogos</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Libros </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Textos </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('book_text_titulo', 'Título Superior') !!}                    
                                {!! Form::text('book_text_titulo', $ml_catalogos_listado['book_text_titulo'] ? $ml_catalogos_listado['book_text_titulo'] : null, ['class' => 'form-control', 'id' => 'book_text_titulo', 'placeholder' => 'Título Superior']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_text_inicio', 'Inicio (Izquierda)') !!}                    
                                {!! Form::text('book_text_inicio', $ml_catalogos_listado['book_text_inicio'] ? $ml_catalogos_listado['book_text_inicio'] : null, ['class' => 'form-control', 'id' => 'book_text_inicio', 'placeholder' => 'Inicio (Izquierda)']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Botones </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('book_btn_buscar', 'Buscar') !!}                    
                                {!! Form::text('book_btn_buscar', $ml_catalogos_listado['book_btn_buscar'] ? $ml_catalogos_listado['book_btn_buscar'] : null, ['class' => 'form-control', 'id' => 'book_btn_buscar', 'placeholder' => 'Buscar']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_btn_crear', 'Crear Libro') !!}                    
                                {!! Form::text('book_btn_crear', $ml_catalogos_listado['book_btn_crear'] ? $ml_catalogos_listado['book_btn_crear'] : null, ['class' => 'form-control', 'id' => 'book_btn_crear', 'placeholder' => 'Crear Libro']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Parametros de Busqueda</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('book_ph_referencia', 'Referencias') !!}                    
                                {!! Form::text('book_ph_referencia', $ml_catalogos_listado['book_ph_referencia'] ? $ml_catalogos_listado['book_ph_referencia'] : null, ['class' => 'form-control', 'id' => 'book_ph_referencia', 'placeholder' => 'Referencias']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_ph_materia', 'Materias') !!}                    
                                {!! Form::text('book_ph_materia', $ml_catalogos_listado['book_ph_materia'] ? $ml_catalogos_listado['book_ph_materia'] : null, ['class' => 'form-control', 'id' => 'book_ph_materia', 'placeholder' => 'Materias']) !!}
                            </div> 
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('book_ph_adecuacion', 'Adecuaciones') !!}                    
                                {!! Form::text('book_ph_adecuacion', $ml_catalogos_listado['book_ph_adecuacion'] ? $ml_catalogos_listado['book_ph_adecuacion'] : null, ['class' => 'form-control', 'id' => 'book_ph_adecuacion', 'placeholder' => 'Adecuaciones']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_ph_genero', 'Generos') !!}                    
                                {!! Form::text('book_ph_genero', $ml_catalogos_listado['book_ph_genero'] ? $ml_catalogos_listado['book_ph_genero'] : null, ['class' => 'form-control', 'id' => 'book_ph_genero', 'placeholder' => 'Generos']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Cabeceras Data Table</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('book_dt_id', 'Id') !!}                    
                                {!! Form::text('book_dt_id', $ml_catalogos_listado['book_dt_id'] ? $ml_catalogos_listado['book_dt_id'] : null, ['class' => 'form-control', 'id' => 'book_dt_id', 'placeholder' => 'Id']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_dt_titulo', 'Titulo') !!}                    
                                {!! Form::text('book_dt_titulo', $ml_catalogos_listado['book_dt_titulo'] ? $ml_catalogos_listado['book_dt_titulo'] : null, ['class' => 'form-control', 'id' => 'book_dt_titulo', 'placeholder' => 'Titulo']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_dt_subtipo', 'Subtipo') !!}                    
                                {!! Form::text('book_dt_subtipo', $ml_catalogos_listado['book_dt_subtipo'] ? $ml_catalogos_listado['book_dt_subtipo'] : null, ['class' => 'form-control', 'id' => 'book_dt_subtipo', 'placeholder' => 'Subtipo']) !!}
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('book_dt_portada', 'Portada') !!}                    
                                {!! Form::text('book_dt_portada', $ml_catalogos_listado['book_dt_portada'] ? $ml_catalogos_listado['book_dt_portada'] : null, ['class' => 'form-control', 'id' => 'book_dt_portada', 'placeholder' => 'Portada']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_dt_genero', 'Genero') !!}                    
                                {!! Form::text('book_dt_genero', $ml_catalogos_listado['book_dt_genero'] ? $ml_catalogos_listado['book_dt_genero'] : null, ['class' => 'form-control', 'id' => 'book_dt_genero', 'placeholder' => 'Genero']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_dt_idioma', 'Idioma') !!}                    
                                {!! Form::text('book_dt_idioma', $ml_catalogos_listado['book_dt_idioma'] ? $ml_catalogos_listado['book_dt_idioma'] : null, ['class' => 'form-control', 'id' => 'book_dt_idioma', 'placeholder' => 'Idioma']) !!}
                            </div> 
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('book_dt_estado', 'Estado') !!}                    
                                {!! Form::text('book_dt_estado', $ml_catalogos_listado['book_dt_estado'] ? $ml_catalogos_listado['book_dt_estado'] : null, ['class' => 'form-control', 'id' => 'book_dt_estado', 'placeholder' => 'Estado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_dt_agregado', 'Agregado') !!}                    
                                {!! Form::text('book_dt_agregado', $ml_catalogos_listado['book_dt_agregado'] ? $ml_catalogos_listado['book_dt_agregado'] : null, ['class' => 'form-control', 'id' => 'book_dt_agregado', 'placeholder' => 'Agregado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('book_dt_acciones', 'Acciones') !!}                    
                                {!! Form::text('book_dt_acciones', $ml_catalogos_listado['book_dt_acciones'] ? $ml_catalogos_listado['book_dt_acciones'] : null, ['class' => 'form-control', 'id' => 'book_dt_acciones', 'placeholder' => 'Acciones']) !!}
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
                    <h3 class="box-title">Cine </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Textos </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('movie_text_titulo', 'Título Superior') !!}                    
                                {!! Form::text('movie_text_titulo', $ml_catalogos_listado['movie_text_titulo'] ? $ml_catalogos_listado['movie_text_titulo'] : null, ['class' => 'form-control', 'id' => 'movie_text_titulo', 'placeholder' => 'Título Superior']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_text_inicio', 'Inicio (Izquierda)') !!}                    
                                {!! Form::text('movie_text_inicio', $ml_catalogos_listado['movie_text_inicio'] ? $ml_catalogos_listado['movie_text_inicio'] : null, ['class' => 'form-control', 'id' => 'movie_text_inicio', 'placeholder' => 'Inicio (Izquierda)']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Botones </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('movie_btn_buscar', 'Buscar') !!}                    
                                {!! Form::text('movie_btn_buscar', $ml_catalogos_listado['movie_btn_buscar'] ? $ml_catalogos_listado['movie_btn_buscar'] : null, ['class' => 'form-control', 'id' => 'movie_btn_buscar', 'placeholder' => 'Buscar']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_btn_crear', 'Crear Libro') !!}                    
                                {!! Form::text('movie_btn_crear', $ml_catalogos_listado['movie_btn_crear'] ? $ml_catalogos_listado['movie_btn_crear'] : null, ['class' => 'form-control', 'id' => 'movie_btn_crear', 'placeholder' => 'Crear Libro']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Parametros de Busqueda</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('movie_ph_referencia', 'Referencias') !!}                    
                                {!! Form::text('movie_ph_referencia', $ml_catalogos_listado['movie_ph_referencia'] ? $ml_catalogos_listado['movie_ph_referencia'] : null, ['class' => 'form-control', 'id' => 'movie_ph_referencia', 'placeholder' => 'Referencias']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_ph_materia', 'Materias') !!}                    
                                {!! Form::text('movie_ph_materia', $ml_catalogos_listado['movie_ph_materia'] ? $ml_catalogos_listado['movie_ph_materia'] : null, ['class' => 'form-control', 'id' => 'movie_ph_materia', 'placeholder' => 'Materias']) !!}
                            </div> 
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('movie_ph_adecuacion', 'Adecuaciones') !!}                    
                                {!! Form::text('movie_ph_adecuacion', $ml_catalogos_listado['movie_ph_adecuacion'] ? $ml_catalogos_listado['movie_ph_adecuacion'] : null, ['class' => 'form-control', 'id' => 'movie_ph_adecuacion', 'placeholder' => 'Adecuaciones']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_ph_genero', 'Generos') !!}                    
                                {!! Form::text('movie_ph_genero', $ml_catalogos_listado['movie_ph_genero'] ? $ml_catalogos_listado['movie_ph_genero'] : null, ['class' => 'form-control', 'id' => 'movie_ph_genero', 'placeholder' => 'Generos']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Cabeceras Data Table</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('movie_dt_id', 'Id') !!}                    
                                {!! Form::text('movie_dt_id', $ml_catalogos_listado['movie_dt_id'] ? $ml_catalogos_listado['movie_dt_id'] : null, ['class' => 'form-control', 'id' => 'movie_dt_id', 'placeholder' => 'Id']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_dt_titulo', 'Titulo') !!}                    
                                {!! Form::text('movie_dt_titulo', $ml_catalogos_listado['movie_dt_titulo'] ? $ml_catalogos_listado['movie_dt_titulo'] : null, ['class' => 'form-control', 'id' => 'movie_dt_titulo', 'placeholder' => 'Titulo']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_dt_genero', 'Genero') !!}                    
                                {!! Form::text('movie_dt_genero', $ml_catalogos_listado['movie_dt_genero'] ? $ml_catalogos_listado['movie_dt_genero'] : null, ['class' => 'form-control', 'id' => 'movie_dt_genero', 'placeholder' => 'Genero']) !!}
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('movie_dt_portada', 'Portada') !!}                    
                                {!! Form::text('movie_dt_portada', $ml_catalogos_listado['movie_dt_portada'] ? $ml_catalogos_listado['movie_dt_portada'] : null, ['class' => 'form-control', 'id' => 'movie_dt_portada', 'placeholder' => 'Portada']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_formato', 'Formato') !!}                    
                                {!! Form::text('movie_formato', $ml_catalogos_listado['movie_formato'] ? $ml_catalogos_listado['movie_formato'] : null, ['class' => 'form-control', 'id' => 'movie_formato', 'placeholder' => 'Formato']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_dt_idioma', 'Idioma') !!}                    
                                {!! Form::text('movie_dt_idioma', $ml_catalogos_listado['movie_dt_idioma'] ? $ml_catalogos_listado['movie_dt_idioma'] : null, ['class' => 'form-control', 'id' => 'movie_dt_idioma', 'placeholder' => 'Idioma']) !!}
                            </div> 
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('movie_dt_estado', 'Estado') !!}                    
                                {!! Form::text('movie_dt_estado', $ml_catalogos_listado['movie_dt_estado'] ? $ml_catalogos_listado['movie_dt_estado'] : null, ['class' => 'form-control', 'id' => 'movie_dt_estado', 'placeholder' => 'Estado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_dt_agregado', 'Agregado') !!}                    
                                {!! Form::text('movie_dt_agregado', $ml_catalogos_listado['movie_dt_agregado'] ? $ml_catalogos_listado['movie_dt_agregado'] : null, ['class' => 'form-control', 'id' => 'movie_dt_agregado', 'placeholder' => 'Agregado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('movie_dt_acciones', 'Acciones') !!}                    
                                {!! Form::text('movie_dt_acciones', $ml_catalogos_listado['movie_dt_acciones'] ? $ml_catalogos_listado['movie_dt_acciones'] : null, ['class' => 'form-control', 'id' => 'movie_dt_acciones', 'placeholder' => 'Acciones']) !!}
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
                    <h3 class="box-title">Musica </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Textos </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('music_text_titulo', 'Título Superior') !!}                    
                                {!! Form::text('music_text_titulo', $ml_catalogos_listado['music_text_titulo'] ? $ml_catalogos_listado['music_text_titulo'] : null, ['class' => 'form-control', 'id' => 'music_text_titulo', 'placeholder' => 'Título Superior']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_text_inicio', 'Inicio (Izquierda)') !!}                    
                                {!! Form::text('music_text_inicio', $ml_catalogos_listado['music_text_inicio'] ? $ml_catalogos_listado['music_text_inicio'] : null, ['class' => 'form-control', 'id' => 'music_text_inicio', 'placeholder' => 'Inicio (Izquierda)']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Botones </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('music_btn_buscar', 'Buscar') !!}                    
                                {!! Form::text('music_btn_buscar', $ml_catalogos_listado['music_btn_buscar'] ? $ml_catalogos_listado['music_btn_buscar'] : null, ['class' => 'form-control', 'id' => 'music_btn_buscar', 'placeholder' => 'Buscar']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_btn_crear', 'Crear Libro') !!}                    
                                {!! Form::text('music_btn_crear', $ml_catalogos_listado['music_btn_crear'] ? $ml_catalogos_listado['music_btn_crear'] : null, ['class' => 'form-control', 'id' => 'music_btn_crear', 'placeholder' => 'Crear Libro']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Parametros de Busqueda</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('music_ph_referencia', 'Referencias') !!}                    
                                {!! Form::text('music_ph_referencia', $ml_catalogos_listado['music_ph_referencia'] ? $ml_catalogos_listado['music_ph_referencia'] : null, ['class' => 'form-control', 'id' => 'music_ph_referencia', 'placeholder' => 'Referencias']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_ph_materia', 'Materias') !!}                    
                                {!! Form::text('music_ph_materia', $ml_catalogos_listado['music_ph_materia'] ? $ml_catalogos_listado['music_ph_materia'] : null, ['class' => 'form-control', 'id' => 'music_ph_materia', 'placeholder' => 'Materias']) !!}
                            </div> 
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('music_ph_adecuacion', 'Adecuaciones') !!}                    
                                {!! Form::text('music_ph_adecuacion', $ml_catalogos_listado['music_ph_adecuacion'] ? $ml_catalogos_listado['music_ph_adecuacion'] : null, ['class' => 'form-control', 'id' => 'music_ph_adecuacion', 'placeholder' => 'Adecuaciones']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_ph_genero', 'Generos') !!}                    
                                {!! Form::text('music_ph_genero', $ml_catalogos_listado['music_ph_genero'] ? $ml_catalogos_listado['music_ph_genero'] : null, ['class' => 'form-control', 'id' => 'music_ph_genero', 'placeholder' => 'Generos']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Cabeceras Data Table</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('music_dt_id', 'Id') !!}                    
                                {!! Form::text('music_dt_id', $ml_catalogos_listado['music_dt_id'] ? $ml_catalogos_listado['music_dt_id'] : null, ['class' => 'form-control', 'id' => 'music_dt_id', 'placeholder' => 'Id']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_dt_titulo', 'Titulo') !!}                    
                                {!! Form::text('music_dt_titulo', $ml_catalogos_listado['music_dt_titulo'] ? $ml_catalogos_listado['music_dt_titulo'] : null, ['class' => 'form-control', 'id' => 'music_dt_titulo', 'placeholder' => 'Titulo']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_dt_subtipo', 'Sub-Tipo') !!}                    
                                {!! Form::text('music_dt_subtipo', $ml_catalogos_listado['music_dt_subtipo'] ? $ml_catalogos_listado['music_dt_subtipo'] : null, ['class' => 'form-control', 'id' => 'music_dt_subtipo', 'placeholder' => 'Sub-Tipo']) !!}
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('music_dt_portada', 'Portada') !!}                    
                                {!! Form::text('music_dt_portada', $ml_catalogos_listado['music_dt_portada'] ? $ml_catalogos_listado['music_dt_portada'] : null, ['class' => 'form-control', 'id' => 'music_dt_portada', 'placeholder' => 'Portada']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_dt_genero', 'Genero') !!}                    
                                {!! Form::text('music_dt_genero', $ml_catalogos_listado['music_dt_genero'] ? $ml_catalogos_listado['music_dt_genero'] : null, ['class' => 'form-control', 'id' => 'music_dt_genero', 'placeholder' => 'Genero']) !!}
                            </div>
                            
                            <div class="form-group">              
                                {!! Form::label('music_dt_idioma', 'Idioma') !!}                    
                                {!! Form::text('music_dt_idioma', $ml_catalogos_listado['music_dt_idioma'] ? $ml_catalogos_listado['music_dt_idioma'] : null, ['class' => 'form-control', 'id' => 'music_dt_idioma', 'placeholder' => 'Idioma']) !!}
                            </div> 
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('music_dt_estado', 'Estado') !!}                    
                                {!! Form::text('music_dt_estado', $ml_catalogos_listado['music_dt_estado'] ? $ml_catalogos_listado['music_dt_estado'] : null, ['class' => 'form-control', 'id' => 'music_dt_estado', 'placeholder' => 'Estado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_dt_agregado', 'Agregado') !!}                    
                                {!! Form::text('music_dt_agregado', $ml_catalogos_listado['music_dt_agregado'] ? $ml_catalogos_listado['music_dt_agregado'] : null, ['class' => 'form-control', 'id' => 'music_dt_agregado', 'placeholder' => 'Agregado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('music_dt_acciones', 'Acciones') !!}                    
                                {!! Form::text('music_dt_acciones', $ml_catalogos_listado['music_dt_acciones'] ? $ml_catalogos_listado['music_dt_acciones'] : null, ['class' => 'form-control', 'id' => 'music_dt_acciones', 'placeholder' => 'Acciones']) !!}
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
                    <h3 class="box-title">Multimedia </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Textos </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_text_titulo', 'Título Superior') !!}                    
                                {!! Form::text('multimedias_text_titulo', $ml_catalogos_listado['multimedias_text_titulo'] ? $ml_catalogos_listado['multimedias_text_titulo'] : null, ['class' => 'form-control', 'id' => 'multimedias_text_titulo', 'placeholder' => 'Título Superior']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_text_inicio', 'Inicio (Izquierda)') !!}                    
                                {!! Form::text('multimedias_text_inicio', $ml_catalogos_listado['multimedias_text_inicio'] ? $ml_catalogos_listado['multimedias_text_inicio'] : null, ['class' => 'form-control', 'id' => 'multimedias_text_inicio', 'placeholder' => 'Inicio (Izquierda)']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Botones </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_btn_buscar', 'Buscar') !!}                    
                                {!! Form::text('multimedias_btn_buscar', $ml_catalogos_listado['multimedias_btn_buscar'] ? $ml_catalogos_listado['multimedias_btn_buscar'] : null, ['class' => 'form-control', 'id' => 'multimedias_btn_buscar', 'placeholder' => 'Buscar']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_btn_crear', 'Crear Libro') !!}                    
                                {!! Form::text('multimedias_btn_crear', $ml_catalogos_listado['multimedias_btn_crear'] ? $ml_catalogos_listado['multimedias_btn_crear'] : null, ['class' => 'form-control', 'id' => 'multimedias_btn_crear', 'placeholder' => 'Crear Libro']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Parametros de Busqueda</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('multimedias_ph_referencia', 'Referencias') !!}                    
                                {!! Form::text('multimedias_ph_referencia', $ml_catalogos_listado['multimedias_ph_referencia'] ? $ml_catalogos_listado['multimedias_ph_referencia'] : null, ['class' => 'form-control', 'id' => 'multimedias_ph_referencia', 'placeholder' => 'Referencias']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_ph_materia', 'Materias') !!}                    
                                {!! Form::text('multimedias_ph_materia', $ml_catalogos_listado['multimedias_ph_materia'] ? $ml_catalogos_listado['multimedias_ph_materia'] : null, ['class' => 'form-control', 'id' => 'multimedias_ph_materia', 'placeholder' => 'Materias']) !!}
                            </div> 
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('multimedias_ph_adecuacion', 'Adecuaciones') !!}                    
                                {!! Form::text('multimedias_ph_adecuacion', $ml_catalogos_listado['multimedias_ph_adecuacion'] ? $ml_catalogos_listado['multimedias_ph_adecuacion'] : null, ['class' => 'form-control', 'id' => 'multimedias_ph_adecuacion', 'placeholder' => 'Adecuaciones']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_ph_genero', 'Generos') !!}                    
                                {!! Form::text('multimedias_ph_genero', $ml_catalogos_listado['multimedias_ph_genero'] ? $ml_catalogos_listado['multimedias_ph_genero'] : null, ['class' => 'form-control', 'id' => 'multimedias_ph_genero', 'placeholder' => 'Generos']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Cabeceras Data Table</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('multimedias_dt_id', 'Id') !!}                    
                                {!! Form::text('multimedias_dt_id', $ml_catalogos_listado['multimedias_dt_id'] ? $ml_catalogos_listado['multimedias_dt_id'] : null, ['class' => 'form-control', 'id' => 'multimedias_dt_id', 'placeholder' => 'Id']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_dt_titulo', 'Titulo') !!}                    
                                {!! Form::text('multimedias_dt_titulo', $ml_catalogos_listado['multimedias_dt_titulo'] ? $ml_catalogos_listado['multimedias_dt_titulo'] : null, ['class' => 'form-control', 'id' => 'multimedias_dt_titulo', 'placeholder' => 'Titulo']) !!}
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('multimedias_dt_portada', 'Portada') !!}                    
                                {!! Form::text('multimedias_dt_portada', $ml_catalogos_listado['multimedias_dt_portada'] ? $ml_catalogos_listado['multimedias_dt_portada'] : null, ['class' => 'form-control', 'id' => 'multimedias_dt_portada', 'placeholder' => 'Portada']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_dt_estado', 'Estado') !!}                    
                                {!! Form::text('multimedias_dt_estado', $ml_catalogos_listado['multimedias_dt_estado'] ? $ml_catalogos_listado['multimedias_dt_estado'] : null, ['class' => 'form-control', 'id' => 'multimedias_dt_estado', 'placeholder' => 'Estado']) !!}
                            </div> 
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('multimedias_dt_agregado', 'Agregado') !!}                    
                                {!! Form::text('multimedias_dt_agregado', $ml_catalogos_listado['multimedias_dt_agregado'] ? $ml_catalogos_listado['multimedias_dt_agregado'] : null, ['class' => 'form-control', 'id' => 'multimedias_dt_agregado', 'placeholder' => 'Agregado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('multimedias_dt_acciones', 'Acciones') !!}                    
                                {!! Form::text('multimedias_dt_acciones', $ml_catalogos_listado['multimedias_dt_acciones'] ? $ml_catalogos_listado['multimedias_dt_acciones'] : null, ['class' => 'form-control', 'id' => 'multimedias_dt_acciones', 'placeholder' => 'Acciones']) !!}
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
                    <h3 class="box-title">Fotografia </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Textos </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_text_titulo', 'Título Superior') !!}                    
                                {!! Form::text('fotografia_text_titulo', $ml_catalogos_listado['fotografia_text_titulo'] ? $ml_catalogos_listado['fotografia_text_titulo'] : null, ['class' => 'form-control', 'id' => 'fotografia_text_titulo', 'placeholder' => 'Título Superior']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_text_inicio', 'Inicio (Izquierda)') !!}                    
                                {!! Form::text('fotografia_text_inicio', $ml_catalogos_listado['fotografia_text_inicio'] ? $ml_catalogos_listado['fotografia_text_inicio'] : null, ['class' => 'form-control', 'id' => 'fotografia_text_inicio', 'placeholder' => 'Inicio (Izquierda)']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Botones </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_btn_buscar', 'Buscar') !!}                    
                                {!! Form::text('fotografia_btn_buscar', $ml_catalogos_listado['fotografia_btn_buscar'] ? $ml_catalogos_listado['fotografia_btn_buscar'] : null, ['class' => 'form-control', 'id' => 'fotografia_btn_buscar', 'placeholder' => 'Buscar']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_btn_crear', 'Crear Libro') !!}                    
                                {!! Form::text('fotografia_btn_crear', $ml_catalogos_listado['fotografia_btn_crear'] ? $ml_catalogos_listado['fotografia_btn_crear'] : null, ['class' => 'form-control', 'id' => 'fotografia_btn_crear', 'placeholder' => 'Crear Libro']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Parametros de Busqueda</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_referencia', 'Referencias') !!}                    
                                {!! Form::text('fotografia_ph_referencia', $ml_catalogos_listado['fotografia_ph_referencia'] ? $ml_catalogos_listado['fotografia_ph_referencia'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_referencia', 'placeholder' => 'Referencias']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_materia', 'Materias') !!}                    
                                {!! Form::text('fotografia_ph_materia', $ml_catalogos_listado['fotografia_ph_materia'] ? $ml_catalogos_listado['fotografia_ph_materia'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_materia', 'placeholder' => 'Materias']) !!}
                            </div> 
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_adecuacion', 'Adecuaciones') !!}                    
                                {!! Form::text('fotografia_ph_adecuacion', $ml_catalogos_listado['fotografia_ph_adecuacion'] ? $ml_catalogos_listado['fotografia_ph_adecuacion'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_adecuacion', 'placeholder' => 'Adecuaciones']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_genero', 'Generos') !!}                    
                                {!! Form::text('fotografia_ph_genero', $ml_catalogos_listado['fotografia_ph_genero'] ? $ml_catalogos_listado['fotografia_ph_genero'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_genero', 'placeholder' => 'Generos']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Cabeceras Data Table</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_id', 'Id') !!}                    
                                {!! Form::text('fotografia_dt_id', $ml_catalogos_listado['fotografia_dt_id'] ? $ml_catalogos_listado['fotografia_dt_id'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_id', 'placeholder' => 'Id']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_titulo', 'Titulo') !!}                    
                                {!! Form::text('fotografia_dt_titulo', $ml_catalogos_listado['fotografia_dt_titulo'] ? $ml_catalogos_listado['fotografia_dt_titulo'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_titulo', 'placeholder' => 'Titulo']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_subtipo', 'Sub-Tipo') !!}                    
                                {!! Form::text('fotografia_dt_subtipo', $ml_catalogos_listado['fotografia_dt_subtipo'] ? $ml_catalogos_listado['fotografia_dt_subtipo'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_subtipo', 'placeholder' => 'Sub-Tipo']) !!}
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_portada', 'Portada') !!}                    
                                {!! Form::text('fotografia_dt_portada', $ml_catalogos_listado['fotografia_dt_portada'] ? $ml_catalogos_listado['fotografia_dt_portada'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_portada', 'placeholder' => 'Portada']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_formato', 'Formato') !!}                    
                                {!! Form::text('fotografia_dt_formato', $ml_catalogos_listado['fotografia_dt_formato'] ? $ml_catalogos_listado['fotografia_dt_formato'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_formato', 'placeholder' => 'Formato']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_estado', 'Estado') !!}                    
                                {!! Form::text('fotografia_dt_estado', $ml_catalogos_listado['fotografia_dt_estado'] ? $ml_catalogos_listado['fotografia_dt_estado'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_estado', 'placeholder' => 'Estado']) !!}
                            </div>
                            </div>
                            <div class="col-md-4">
                            
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_agregado', 'Agregado') !!}                    
                                {!! Form::text('fotografia_dt_agregado', $ml_catalogos_listado['fotografia_dt_agregado'] ? $ml_catalogos_listado['fotografia_dt_agregado'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_agregado', 'placeholder' => 'Agregado']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_dt_acciones', 'Acciones') !!}                    
                                {!! Form::text('fotografia_dt_acciones', $ml_catalogos_listado['fotografia_dt_acciones'] ? $ml_catalogos_listado['fotografia_dt_acciones'] : null, ['class' => 'form-control', 'id' => 'fotografia_dt_acciones', 'placeholder' => 'Acciones']) !!}
                            </div>
                            </div>
                   </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Textos </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_text_titulo', 'Título Superior') !!}                    
                                {!! Form::text('fotografia_text_titulo', $ml_catalogos_listado['fotografia_text_titulo'] ? $ml_catalogos_listado['fotografia_text_titulo'] : null, ['class' => 'form-control', 'id' => 'fotografia_text_titulo', 'placeholder' => 'Título Superior']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_text_inicio', 'Inicio (Izquierda)') !!}                    
                                {!! Form::text('fotografia_text_inicio', $ml_catalogos_listado['fotografia_text_inicio'] ? $ml_catalogos_listado['fotografia_text_inicio'] : null, ['class' => 'form-control', 'id' => 'fotografia_text_inicio', 'placeholder' => 'Inicio (Izquierda)']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Botones </h3>
                                </div>
                                </div>
                        </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_btn_buscar', 'Buscar') !!}                    
                                {!! Form::text('fotografia_btn_buscar', $ml_catalogos_listado['fotografia_btn_buscar'] ? $ml_catalogos_listado['fotografia_btn_buscar'] : null, ['class' => 'form-control', 'id' => 'fotografia_btn_buscar', 'placeholder' => 'Buscar']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_btn_crear', 'Crear Libro') !!}                    
                                {!! Form::text('fotografia_btn_crear', $ml_catalogos_listado['fotografia_btn_crear'] ? $ml_catalogos_listado['fotografia_btn_crear'] : null, ['class' => 'form-control', 'id' => 'fotografia_btn_crear', 'placeholder' => 'Crear Libro']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Parametros de Busqueda</h3>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_referencia', 'Referencias') !!}                    
                                {!! Form::text('fotografia_ph_referencia', $ml_catalogos_listado['fotografia_ph_referencia'] ? $ml_catalogos_listado['fotografia_ph_referencia'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_referencia', 'placeholder' => 'Referencias']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_materia', 'Materias') !!}                    
                                {!! Form::text('fotografia_ph_materia', $ml_catalogos_listado['fotografia_ph_materia'] ? $ml_catalogos_listado['fotografia_ph_materia'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_materia', 'placeholder' => 'Materias']) !!}
                            </div> 
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_adecuacion', 'Adecuaciones') !!}                    
                                {!! Form::text('fotografia_ph_adecuacion', $ml_catalogos_listado['fotografia_ph_adecuacion'] ? $ml_catalogos_listado['fotografia_ph_adecuacion'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_adecuacion', 'placeholder' => 'Adecuaciones']) !!}
                            </div>
                            <div class="form-group">              
                                {!! Form::label('fotografia_ph_genero', 'Generos') !!}                    
                                {!! Form::text('fotografia_ph_genero', $ml_catalogos_listado['fotografia_ph_genero'] ? $ml_catalogos_listado['fotografia_ph_genero'] : null, ['class' => 'form-control', 'id' => 'fotografia_ph_genero', 'placeholder' => 'Generos']) !!}
                            </div> 
                                                            
                    </div>
                    <div class="col-md-12">
                        <div class="box box-primary">                    
                                <div class="box-header with-border">
                                <div class="text-center">
                                <h3 class="box-title">Mensajes de confirmacion y avisos</h3>
                                </div>
                                </div>
                        </div>
                            <div class="col-md-6">
                                <div class="form-group">              
                                    {!! Form::label('mensaje_exito', 'Exito') !!}                    
                                    {!! Form::text('mensaje_exito', $ml_cat_sweetalert['mensaje_exito'] ? $ml_cat_sweetalert['mensaje_exito'] : null, ['class' => 'form-control', 'id' => 'mensaje_exito', 'placeholder' => 'Exito']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('alta_documento', 'Alta Documento') !!}                    
                                    {!! Form::text('alta_documento', $ml_cat_sweetalert['alta_documento'] ? $ml_cat_sweetalert['alta_documento'] : null, ['class' => 'form-control', 'id' => 'alta_documento', 'placeholder' => 'Alta Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('actualizacion_documento', 'Actualizacion Documento') !!}                    
                                    {!! Form::text('actualizacion_documento', $ml_cat_sweetalert['actualizacion_documento'] ? $ml_cat_sweetalert['actualizacion_documento'] : null, ['class' => 'form-control', 'id' => 'actualizacion_documento', 'placeholder' => 'Actualizacion Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('preg_solicitar_documento', 'Pregunta Solicitud Documento') !!}                    
                                    {!! Form::text('preg_solicitar_documento', $ml_cat_sweetalert['preg_solicitar_documento'] ? $ml_cat_sweetalert['preg_solicitar_documento'] : null, ['class' => 'form-control', 'id' => 'preg_solicitar_documento', 'placeholder' => 'Pregunta Solicitud Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('resp_solicitar_documento', 'Respuesta Solicitud Documento') !!}                    
                                    {!! Form::text('resp_solicitar_documento', $ml_cat_sweetalert['resp_solicitar_documento'] ? $ml_cat_sweetalert['resp_solicitar_documento'] : null, ['class' => 'form-control', 'id' => 'resp_solicitar_documento', 'placeholder' => 'Respuesta Solicitud Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('preg_baja_documento', 'Pregunta Baja Documento') !!}                    
                                    {!! Form::text('preg_baja_documento', $ml_cat_sweetalert['preg_baja_documento'] ? $ml_cat_sweetalert['preg_baja_documento'] : null, ['class' => 'form-control', 'id' => 'preg_baja_documento', 'placeholder' => 'Pregunta Baja Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('resp_baja_documento', 'Respuesta Baja Documento') !!}                    
                                    {!! Form::text('resp_baja_documento', $ml_cat_sweetalert['resp_baja_documento'] ? $ml_cat_sweetalert['resp_baja_documento'] : null, ['class' => 'form-control', 'id' => 'resp_baja_documento', 'placeholder' => 'Respuesta Baja Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('preg_rechazar_documento', 'Pregunta Rechazar Documento') !!}                    
                                    {!! Form::text('preg_rechazar_documento', $ml_cat_sweetalert['preg_rechazar_documento'] ? $ml_cat_sweetalert['preg_rechazar_documento'] : null, ['class' => 'form-control', 'id' => 'preg_rechazar_documento', 'placeholder' => 'Pregunta Rechazar Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('resp_rechazar_documento', 'Respuesta Rechazar Documento') !!}                    
                                    {!! Form::text('resp_rechazar_documento', $ml_cat_sweetalert['resp_rechazar_documento'] ? $ml_cat_sweetalert['resp_rechazar_documento'] : null, ['class' => 'form-control', 'id' => 'resp_rechazar_documento', 'placeholder' => 'Respuesta Rechazar Documento']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                            
                                <div class="form-group">              
                                    {!! Form::label('preg_reactivar_documento', 'Pregunta Reactivar Documento') !!}                    
                                    {!! Form::text('preg_reactivar_documento', $ml_cat_sweetalert['preg_reactivar_documento'] ? $ml_cat_sweetalert['preg_reactivar_documento'] : null, ['class' => 'form-control', 'id' => 'preg_reactivar_documento', 'placeholder' => 'Pregunta Reactivar Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('resp_reactivar_documento', 'Respuesta Reactivar Documento') !!}                    
                                    {!! Form::text('resp_reactivar_documento', $ml_cat_sweetalert['resp_reactivar_documento'] ? $ml_cat_sweetalert['resp_reactivar_documento'] : null, ['class' => 'form-control', 'id' => 'resp_reactivar_documento', 'placeholder' => 'Respuesta Reactivar Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('preg_aceptar_documento', 'Pregunta Aceptar Documento') !!}                    
                                    {!! Form::text('preg_aceptar_documento', $ml_cat_sweetalert['preg_aceptar_documento'] ? $ml_cat_sweetalert['preg_aceptar_documento'] : null, ['class' => 'form-control', 'id' => 'preg_aceptar_documento', 'placeholder' => 'Pregunta Aceptar Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('resp_aceptar_documento', 'Respuesta Aceptar Documento') !!}                    
                                    {!! Form::text('resp_aceptar_documento', $ml_cat_sweetalert['resp_aceptar_documento'] ? $ml_cat_sweetalert['resp_aceptar_documento'] : null, ['class' => 'form-control', 'id' => 'resp_aceptar_documento', 'placeholder' => 'Respuesta Aceptar Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('preg_desidherata_documento', 'Pregunta Desidherata Documento') !!}                    
                                    {!! Form::text('preg_desidherata_documento', $ml_cat_sweetalert['preg_desidherata_documento'] ? $ml_cat_sweetalert['preg_desidherata_documento'] : null, ['class' => 'form-control', 'id' => 'preg_desidherata_documento', 'placeholder' => 'Pregunta Desidherata Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('resp_desidherata_documento', 'Respuesta Desidherata Documento') !!}                    
                                    {!! Form::text('resp_desidherata_documento', $ml_cat_sweetalert['resp_desidherata_documento'] ? $ml_cat_sweetalert['resp_desidherata_documento'] : null, ['class' => 'form-control', 'id' => 'resp_desidherata_documento', 'placeholder' => 'Respuesta Desidherata Documento']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('actualizacion_copia', 'Actualizacion Copia') !!}                    
                                    {!! Form::text('actualizacion_copia', $ml_cat_sweetalert['actualizacion_copia'] ? $ml_cat_sweetalert['actualizacion_copia'] : null, ['class' => 'form-control', 'id' => 'actualizacion_copia', 'placeholder' => 'Actualizacion Copia']) !!}
                                </div>
                                <div class="form-group">              
                                    {!! Form::label('alta_copia', 'Alta Copia') !!}                    
                                    {!! Form::text('alta_copia', $ml_cat_sweetalert['alta_copia'] ? $ml_cat_sweetalert['alta_copia'] : null, ['class' => 'form-control', 'id' => 'alta_copia', 'placeholder' => 'Alta Copia']) !!}
                                </div>
                            </div>
                            
                   </div>
                </div>       
        </div>   
    </div>
          
{!! Form::close() !!}    
</div>





  