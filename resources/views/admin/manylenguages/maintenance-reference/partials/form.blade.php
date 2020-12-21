<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_course', $idioma->id] : 'admin.manylenguages.store',   
    'method' => $idioma->exists ? 'PUT' : 'POST'
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
                    <h3 class="box-title">Traducciones Globales Curso</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo', 'Título principal') !!}                    
                        {!! Form::text('titulo', $ml_course['titulo'] ? $ml_course['titulo'] : null, ['class' => 'form-control', 'id' => 'titulo', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo', $ml_course['subtitulo'] ? $ml_course['subtitulo'] : null, ['class' => 'form-control', 'id' => 'subtitulo', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear', $ml_course['btn_crear'] ? $ml_course['btn_crear'] : null, ['class' => 'form-control', 'id' => 'btn_crear', 'placeholder' => 'Botón Crear']) !!}
                    </div>                                     
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Columnas Datatable </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('dt_id', 'Id') !!}                    
                    {!! Form::text('dt_id', $ml_course['dt_id'] ? $ml_course['dt_id'] : null, ['class' => 'form-control', 'id' => 'dt_id', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_curso', 'Curso') !!}                    
                    {!! Form::text('dt_curso', $ml_course['dt_curso'] ? $ml_course['dt_curso'] : null, ['class' => 'form-control', 'id' => 'dt_curso', 'placeholder' => 'Curso']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_grupo', 'Grupo') !!}                    
                    {!! Form::text('dt_grupo', $ml_course['dt_grupo'] ? $ml_course['dt_grupo'] : null, ['class' => 'form-control', 'id' => 'dt_grupo', 'placeholder' => 'Grupo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_agregado', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado', $ml_course['dt_agregado'] ? $ml_course['dt_agregado'] : null, ['class' => 'form-control', 'id' => 'dt_agregado', 'placeholder' => 'Agregados']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_estado', 'Estado') !!}                    
                    {!! Form::text('dt_estado', $ml_course['dt_estado'] ? $ml_course['dt_estado'] : null, ['class' => 'form-control', 'id' => 'dt_estado', 'placeholder' => 'Estado']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_acciones', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones', $ml_course['dt_acciones'] ? $ml_course['dt_acciones'] : null, ['class' => 'form-control', 'id' => 'dt_acciones', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div>   
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
            <div class="text-center">
                <h3 class="box-title">Ventana Modal </h3>
            </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('mod_titulo', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo', $ml_course['mod_titulo'] ? $ml_course['mod_titulo'] : null, ['class' => 'form-control', 'id' => 'mod_titulo', 'placeholder' => 'Título Modal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo', $ml_course['mod_subtitulo'] ? $ml_course['mod_subtitulo'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cam_nombre_curso', 'Curso') !!}                    
                    {!! Form::text('cam_nombre_curso', $ml_course['cam_nombre_curso'] ? $ml_course['cam_nombre_curso'] : null, ['class' => 'form-control', 'id' => 'cam_nombre_curso', 'placeholder' => 'Curso']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('cam_grupo', 'Grupo') !!}                    
                    {!! Form::text('cam_grupo', $ml_course['cam_grupo'] ? $ml_course['cam_grupo'] : null, ['class' => 'form-control', 'id' => 'cam_grupo', 'placeholder' => 'Grupo']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('cam_grupo_si', 'Si') !!}                    
                    {!! Form::text('cam_grupo_si', $ml_course['cam_grupo_si'] ? $ml_course['cam_grupo_si'] : null, ['class' => 'form-control', 'id' => 'cam_grupo_si', 'placeholder' => 'Si']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('cam_grupo_no', 'No') !!}                    
                    {!! Form::text('cam_grupo_no', $ml_course['cam_grupo_no'] ? $ml_course['cam_grupo_no'] : null, ['class' => 'form-control', 'id' => 'cam_grupo_no', 'placeholder' => 'No']) !!}
                </div>                                  
            </div>
        </div>       
    </div>     
{!! Form::close() !!}    
</div>





  