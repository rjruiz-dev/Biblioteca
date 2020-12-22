<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_maintenance', $idioma->id] : 'admin.manylenguages.store',   
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
                        {!! Form::label('titulo_curso', 'Título principal') !!}                    
                        {!! Form::text('titulo_curso', $ml_course['titulo_curso'] ? $ml_course['titulo_curso'] : null, ['class' => 'form-control', 'id' => 'titulo_curso', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_curso', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_curso', $ml_course['subtitulo_curso'] ? $ml_course['subtitulo_curso'] : null, ['class' => 'form-control', 'id' => 'subtitulo_curso', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_curso', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_curso', $ml_course['btn_crear_curso'] ? $ml_course['btn_crear_curso'] : null, ['class' => 'form-control', 'id' => 'btn_crear_curso', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_curso', 'Id') !!}                    
                    {!! Form::text('dt_id_curso', $ml_course['dt_id_curso'] ? $ml_course['dt_id_curso'] : null, ['class' => 'form-control', 'id' => 'dt_id_curso', 'placeholder' => 'Id']) !!}
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
                    {!! Form::label('dt_agregado_curso', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_curso', $ml_course['dt_agregado_curso'] ? $ml_course['dt_agregado_curso'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_curso', 'placeholder' => 'Agregados']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_estado', 'Estado') !!}                    
                    {!! Form::text('dt_estado', $ml_course['dt_estado'] ? $ml_course['dt_estado'] : null, ['class' => 'form-control', 'id' => 'dt_estado', 'placeholder' => 'Estado']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_acciones_curso', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_curso', $ml_course['dt_acciones_curso'] ? $ml_course['dt_acciones_curso'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_curso', 'placeholder' => 'Acciones']) !!}
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
                    {!! Form::label('mod_titulo_curso', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_curso', $ml_course['mod_titulo_curso'] ? $ml_course['mod_titulo_curso'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_curso', 'placeholder' => 'Título Modal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_curso', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_curso', $ml_course['mod_subtitulo_curso'] ? $ml_course['mod_subtitulo_curso'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_curso', 'placeholder' => 'Subtítulo Modal']) !!}
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


    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Referencia</h3>
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
                        {!! Form::label('titulo_ref', 'Título principal') !!}                    
                        {!! Form::text('titulo_ref', $ml_reference['titulo_ref'] ? $ml_reference['titulo_ref'] : null, ['class' => 'form-control', 'id' => 'titulo_ref', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_ref', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_ref', $ml_reference['subtitulo_ref'] ? $ml_reference['subtitulo_ref'] : null, ['class' => 'form-control', 'id' => 'subtitulo_ref', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_ref', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_ref', $ml_reference['btn_crear_ref'] ? $ml_reference['btn_crear_ref'] : null, ['class' => 'form-control', 'id' => 'btn_crear_ref', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_ref', 'Id') !!}                    
                    {!! Form::text('dt_id_ref', $ml_reference['dt_id_ref'] ? $ml_reference['dt_id_ref'] : null, ['class' => 'form-control', 'id' => 'dt_id_ref', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_referencia', 'Rwferencia') !!}                    
                    {!! Form::text('dt_referencia', $ml_reference['dt_referencia'] ? $ml_reference['dt_referencia'] : null, ['class' => 'form-control', 'id' => 'dt_referencia', 'placeholder' => 'Referencia']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_ref', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_ref', $ml_reference['dt_agregado_ref'] ? $ml_reference['dt_agregado_ref'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_ref', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_ref', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_ref', $ml_reference['dt_acciones_ref'] ? $ml_reference['dt_acciones_ref'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_ref', 'placeholder' => 'Acciones']) !!}
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
                    {!! Form::label('mod_titulo_ref', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_ref', $ml_reference['mod_titulo_ref'] ? $ml_reference['mod_titulo_ref'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_ref', 'placeholder' => 'Título Modal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_ref', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_ref', $ml_reference['mod_subtitulo_ref'] ? $ml_reference['mod_subtitulo_ref'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_ref', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_formato', 'Formato') !!}                    
                    {!! Form::text('cam_formato', $ml_reference['cam_formato'] ? $ml_reference['cam_formato'] : null, ['class' => 'form-control', 'id' => 'cam_formato', 'placeholder' => 'Formato']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 
{!! Form::close() !!}    
</div>





  