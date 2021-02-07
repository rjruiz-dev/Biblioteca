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

    <!--Traduccion Cursos -->
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_curso', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_curso', $ml_course['mod_titulo_curso'] ? $ml_course['mod_titulo_curso'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_curso', 'placeholder' => 'Título Modal']) !!}
                </div> -->
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

     <!--Swal Cursos -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Mensajes de Alertas Curso</h3>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Exito </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_exito', 'Titulo del mensaje de exito') !!}                    
                    {!! Form::text('swal_exito', $swal_course['swal_exito'] ? $swal_course['swal_exito'] : null, ['class' => 'form-control', 'id' => 'swal_exito', 'placeholder' => 'Titulo del mensaje de exito']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('swal_info_exito', 'Mensaje de exito') !!}                    
                    {!! Form::text('swal_info_exito', $swal_course['swal_info_exito'] ? $swal_course['swal_info_exito'] : null, ['class' => 'form-control', 'id' => 'swal_info_exito', 'placeholder' => 'Mensaje de exito']) !!}
                </div>                    
            </div>
        </div>       
    </div>    

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Advertencias </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_advertencia', 'Titulo del mensaje de advertencia') !!}                    
                    {!! Form::text('swal_advertencia', $swal_course['swal_advertencia'] ? $swal_course['swal_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_advertencia', 'placeholder' => 'Titulo del mensaje de advertencia']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_advertencia', 'Mensaje de advertencia') !!}                    
                    {!! Form::text('swal_info_advertencia', $swal_course['swal_info_advertencia'] ? $swal_course['swal_info_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_info_advertencia', 'placeholder' => 'Mensaje de advertencia']) !!}
                </div>     
            </div>
        </div>       
    </div>   

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Baja y Reactivar Curso </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_baja', 'Dar de baja') !!}                    
                    {!! Form::text('swal_baja', $swal_course['swal_baja'] ? $swal_course['swal_baja'] : null, ['class' => 'form-control', 'id' => 'swal_baja', 'placeholder' => 'Dar de baja']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_bajado', 'Dado de baja') !!}                    
                    {!! Form::text('swal_bajado', $swal_course['swal_bajado'] ? $swal_course['swal_bajado'] : null, ['class' => 'form-control', 'id' => 'swal_bajado', 'placeholder' => 'Dado de baja']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('swal_reactivar', 'Reactivar') !!}                    
                    {!! Form::text('swal_reactivar', $swal_course['swal_reactivar'] ? $swal_course['swal_reactivar'] : null, ['class' => 'form-control', 'id' => 'swal_reactivar', 'placeholder' => 'Reactivar']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_reactivado', 'Reactivado') !!}                    
                    {!! Form::text('swal_reactivado', $swal_course['swal_reactivado'] ? $swal_course['swal_reactivado'] : null, ['class' => 'form-control', 'id' => 'swal_reactivado', 'placeholder' => 'Reactivado']) !!}
                </div>     
            </div>
        </div>       
    </div>   

    <!--Traduccion Referencias -->
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
                    {!! Form::label('dt_referencia', 'Referencia') !!}                    
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_ref', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_ref', $ml_reference['mod_titulo_ref'] ? $ml_reference['mod_titulo_ref'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_ref', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_ref', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_ref', $ml_reference['mod_subtitulo_ref'] ? $ml_reference['mod_subtitulo_ref'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_ref', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_referencia', 'Referencia') !!}                    
                    {!! Form::text('cam_referencia', $ml_reference['cam_referencia'] ? $ml_reference['cam_referencia'] : null, ['class' => 'form-control', 'id' => 'cam_referencia', 'placeholder' => 'Referencia']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

     <!--Swal Referencias -->
     <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Mensajes de Alertas Referencias</h3>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Exito </h3>
                </div>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('swal_reference', 'Alerta para') !!}                    
                    {!! Form::text('swal_reference', $swal_reference['swal_reference'] ? $swal_reference['swal_reference'] : null, ['class' => 'form-control', 'id' => 'swal_reference', 'placeholder' => 'Alerta para']) !!}
                </div>            
                <div class="form-group">              
                    {!! Form::label('swal_exito', 'Titulo del mensaje de exito') !!}                    
                    {!! Form::text('swal_exito', $swal_reference['swal_exito'] ? $swal_reference['swal_exito'] : null, ['class' => 'form-control', 'id' => 'swal_exito', 'placeholder' => 'Titulo del mensaje de exito']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('swal_info_exito', 'Mensaje de exito') !!}                    
                    {!! Form::text('swal_info_exito', $swal_reference['swal_info_exito'] ? $swal_reference['swal_info_exito'] : null, ['class' => 'form-control', 'id' => 'swal_info_exito', 'placeholder' => 'Mensaje de exito']) !!}
                </div>                    
            </div>
        </div>       
    </div>    

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Eliminación </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_eliminar', 'Titulo del mensaje de eliminación') !!}                    
                    {!! Form::text('swal_eliminar', $swal_reference['swal_eliminar'] ? $swal_reference['swal_eliminar'] : null, ['class' => 'form-control', 'id' => 'swal_eliminar', 'placeholder' => 'Titulo del mensaje de eliminación']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_eliminar', 'Mensaje de eliminación') !!}                    
                    {!! Form::text('swal_info_eliminar', $swal_reference['swal_info_eliminar'] ? $swal_reference['swal_info_eliminar'] : null, ['class' => 'form-control', 'id' => 'swal_info_eliminar', 'placeholder' => 'Mensaje de eliminación']) !!}
                </div>     
            </div>
        </div>       
    </div> 
    
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Advertencias </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_advertencia', 'Titulo del mensaje de advertencia') !!}                    
                    {!! Form::text('swal_advertencia', $swal_reference['swal_advertencia'] ? $swal_reference['swal_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_advertencia', 'placeholder' => 'Titulo del mensaje de advertencia']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_advertencia', 'Mensaje de advertencia') !!}                    
                    {!! Form::text('swal_info_advertencia', $swal_reference['swal_info_advertencia'] ? $swal_reference['swal_info_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_info_advertencia', 'placeholder' => 'Mensaje de advertencia']) !!}
                </div>     
            </div>
        </div>       
    </div> 

    <!--Traduccion Formatos Graficos  -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Formatos Gráficos</h3>
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
                        {!! Form::label('titulo_fg', 'Título principal') !!}                    
                        {!! Form::text('titulo_fg', $ml_fg['titulo_fg'] ? $ml_fg['titulo_fg'] : null, ['class' => 'form-control', 'id' => 'titulo_fg', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_fg', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_fg', $ml_fg['subtitulo_fg'] ? $ml_fg['subtitulo_fg'] : null, ['class' => 'form-control', 'id' => 'subtitulo_fg', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_fg', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_fg', $ml_fg['btn_crear_fg'] ? $ml_fg['btn_crear_fg'] : null, ['class' => 'form-control', 'id' => 'btn_crear_fg', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_fg', 'Id') !!}                    
                    {!! Form::text('dt_id_fg', $ml_fg['dt_id_fg'] ? $ml_fg['dt_id_fg'] : null, ['class' => 'form-control', 'id' => 'dt_id_fg', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_fg', 'Formato Gráfico') !!}                    
                    {!! Form::text('dt_fg', $ml_fg['dt_fg'] ? $ml_fg['dt_fg'] : null, ['class' => 'form-control', 'id' => 'dt_fg', 'placeholder' => 'Formato Gráfico']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_fg', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_fg', $ml_fg['dt_agregado_fg'] ? $ml_fg['dt_agregado_fg'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_fg', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_fg', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_fg', $ml_fg['dt_acciones_fg'] ? $ml_fg['dt_acciones_fg'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_fg', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_fg', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_fg', $ml_fg['mod_titulo_fg'] ? $ml_fg['mod_titulo_fg'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_fg', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_fg', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_fg', $ml_fg['mod_subtitulo_fg'] ? $ml_fg['mod_subtitulo_fg'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_fg', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_fg', 'Formato Gráfico') !!}                    
                    {!! Form::text('cam_fg', $ml_fg['cam_fg'] ? $ml_fg['cam_fg'] : null, ['class' => 'form-control', 'id' => 'cam_fg', 'placeholder' => 'Formato Gráfico']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

    <!--Swal Formatos Graficos -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Mensajes de Alertas Formatos Gráficos</h3>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Exito </h3>
                </div>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('swal_formato', 'Alerta para') !!}                    
                    {!! Form::text('swal_formato', $swal_fg['swal_formato'] ? $swal_fg['swal_formato'] : null, ['class' => 'form-control', 'id' => 'swal_formato', 'placeholder' => 'Alerta para']) !!}
                </div>            
                <div class="form-group">              
                    {!! Form::label('swal_exito', 'Titulo del mensaje de exito') !!}                    
                    {!! Form::text('swal_exito', $swal_fg['swal_exito'] ? $swal_fg['swal_exito'] : null, ['class' => 'form-control', 'id' => 'swal_exito', 'placeholder' => 'Titulo del mensaje de exito']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('swal_info_exito', 'Mensaje de exito') !!}                    
                    {!! Form::text('swal_info_exito', $swal_fg['swal_info_exito'] ? $swal_fg['swal_info_exito'] : null, ['class' => 'form-control', 'id' => 'swal_info_exito', 'placeholder' => 'Mensaje de exito']) !!}
                </div>                    
            </div>
        </div>       
    </div> 
    
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Eliminación </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_eliminar', 'Titulo del mensaje de eliminación') !!}                    
                    {!! Form::text('swal_eliminar', $swal_fg['swal_eliminar'] ? $swal_fg['swal_eliminar'] : null, ['class' => 'form-control', 'id' => 'swal_eliminar', 'placeholder' => 'Titulo del mensaje de eliminación']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_eliminar', 'Mensaje de eliminación') !!}                    
                    {!! Form::text('swal_info_eliminar', $swal_fg['swal_info_eliminar'] ? $swal_fg['swal_info_eliminar'] : null, ['class' => 'form-control', 'id' => 'swal_info_eliminar', 'placeholder' => 'Mensaje de eliminación']) !!}
                </div>     
            </div>
        </div>       
    </div> 

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Advertencias </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_advertencia', 'Titulo del mensaje de advertencia') !!}                    
                    {!! Form::text('swal_advertencia', $swal_fg['swal_advertencia'] ? $swal_fg['swal_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_advertencia', 'placeholder' => 'Titulo del mensaje de advertencia']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_advertencia', 'Mensaje de advertencia') !!}                    
                    {!! Form::text('swal_info_advertencia', $swal_fg['swal_info_advertencia'] ? $swal_fg['swal_info_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_info_advertencia', 'placeholder' => 'Mensaje de advertencia']) !!}
                </div>     
            </div>
        </div>       
    </div>   

    <!--Traduccion Idiomas  -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Idiomas</h3>
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
                        {!! Form::label('titulo_lang', 'Título principal') !!}                    
                        {!! Form::text('titulo_lang', $ml_lang['titulo_lang'] ? $ml_lang['titulo_lang'] : null, ['class' => 'form-control', 'id' => 'titulo_lang', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_lang', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_lang', $ml_lang['subtitulo_lang'] ? $ml_lang['subtitulo_lang'] : null, ['class' => 'form-control', 'id' => 'subtitulo_lang', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_lang', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_lang', $ml_lang['btn_crear_lang'] ? $ml_lang['btn_crear_lang'] : null, ['class' => 'form-control', 'id' => 'btn_crear_lang', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_lang', 'Id') !!}                    
                    {!! Form::text('dt_id_lang', $ml_lang['dt_id_lang'] ? $ml_lang['dt_id_lang'] : null, ['class' => 'form-control', 'id' => 'dt_id_lang', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_lang', 'Idioma') !!}                    
                    {!! Form::text('dt_lang', $ml_lang['dt_lang'] ? $ml_lang['dt_lang'] : null, ['class' => 'form-control', 'id' => 'dt_lang', 'placeholder' => 'Idioma']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_lang', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_lang', $ml_lang['dt_agregado_lang'] ? $ml_lang['dt_agregado_lang'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_lang', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_lang', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_lang', $ml_lang['dt_acciones_lang'] ? $ml_lang['dt_acciones_lang'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_lang', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_lang', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_lang', $ml_lang['mod_titulo_lang'] ? $ml_lang['mod_titulo_lang'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_lang', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_lang', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_lang', $ml_lang['mod_subtitulo_lang'] ? $ml_lang['mod_subtitulo_lang'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_lang', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_lang', 'Idioma') !!}                    
                    {!! Form::text('cam_lang', $ml_lang['cam_lang'] ? $ml_lang['cam_lang'] : null, ['class' => 'form-control', 'id' => 'cam_lang', 'placeholder' => 'Idioma']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

    <!--Swal Idiomas -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Mensajes de Alertas Lenguajes</h3>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Exito </h3>
                </div>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('swal_formato', 'Alerta para') !!}                    
                    {!! Form::text('swal_formato', $swal_lang['swal_formato'] ? $swal_lang['swal_formato'] : null, ['class' => 'form-control', 'id' => 'swal_formato', 'placeholder' => 'Alerta para']) !!}
                </div>            
                <div class="form-group">              
                    {!! Form::label('swal_exito', 'Titulo del mensaje de exito') !!}                    
                    {!! Form::text('swal_exito', $swal_lang['swal_exito'] ? $swal_lang['swal_exito'] : null, ['class' => 'form-control', 'id' => 'swal_exito', 'placeholder' => 'Titulo del mensaje de exito']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('swal_info_exito', 'Mensaje de exito') !!}                    
                    {!! Form::text('swal_info_exito', $swal_lang['swal_info_exito'] ? $swal_lang['swal_info_exito'] : null, ['class' => 'form-control', 'id' => 'swal_info_exito', 'placeholder' => 'Mensaje de exito']) !!}
                </div>                    
            </div>
        </div>       
    </div>  
    
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Eliminación </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_eliminar', 'Titulo del mensaje de eliminación') !!}                    
                    {!! Form::text('swal_eliminar', $swal_lang['swal_eliminar'] ? $swal_lang['swal_eliminar'] : null, ['class' => 'form-control', 'id' => 'swal_eliminar', 'placeholder' => 'Titulo del mensaje de eliminación']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_eliminar', 'Mensaje de eliminación') !!}                    
                    {!! Form::text('swal_info_eliminar', $swal_lang['swal_info_eliminar'] ? $swal_lang['swal_info_eliminar'] : null, ['class' => 'form-control', 'id' => 'swal_info_eliminar', 'placeholder' => 'Mensaje de eliminación']) !!}
                </div>     
            </div>
        </div>       
    </div> 

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Alertas Advertencias </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('swal_advertencia', 'Titulo del mensaje de advertencia') !!}                    
                    {!! Form::text('swal_advertencia', $swal_lang['swal_advertencia'] ? $swal_lang['swal_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_advertencia', 'placeholder' => 'Titulo del mensaje de advertencia']) !!}
                </div>                 
                <div class="form-group">              
                    {!! Form::label('swal_info_advertencia', 'Mensaje de advertencia') !!}                    
                    {!! Form::text('swal_info_advertencia', $swal_lang['swal_info_advertencia'] ? $swal_lang['swal_info_advertencia'] : null, ['class' => 'form-control', 'id' => 'swal_info_advertencia', 'placeholder' => 'Mensaje de advertencia']) !!}
                </div>     
            </div>
        </div>       
    </div>  

     <!--Traduccion Publicacion Periodica  -->
     <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Publicación Periodica</h3>
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
                        {!! Form::label('titulo_publ', 'Título principal') !!}                    
                        {!! Form::text('titulo_publ', $ml_pp['titulo_publ'] ? $ml_pp['titulo_publ'] : null, ['class' => 'form-control', 'id' => 'titulo_publ', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_publ', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_publ', $ml_pp['subtitulo_publ'] ? $ml_pp['subtitulo_publ'] : null, ['class' => 'form-control', 'id' => 'subtitulo_publ', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_publ', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_publ', $ml_pp['btn_crear_publ'] ? $ml_pp['btn_crear_publ'] : null, ['class' => 'form-control', 'id' => 'btn_crear_publ', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_publ', 'Id') !!}                    
                    {!! Form::text('dt_id_publ', $ml_pp['dt_id_publ'] ? $ml_pp['dt_id_publ'] : null, ['class' => 'form-control', 'id' => 'dt_id_publ', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_publ', 'Periodicidades') !!}                    
                    {!! Form::text('dt_publ', $ml_pp['dt_publ'] ? $ml_pp['dt_publ'] : null, ['class' => 'form-control', 'id' => 'dt_publ', 'placeholder' => 'Periodicidades']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_publ', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_publ', $ml_pp['dt_agregado_publ'] ? $ml_pp['dt_agregado_publ'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_publ', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_publ', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_publ', $ml_pp['dt_acciones_publ'] ? $ml_pp['dt_acciones_publ'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_publ', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_publ', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_publ', $ml_pp['mod_titulo_publ'] ? $ml_pp['mod_titulo_publ'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_publ', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_publ', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_publ', $ml_pp['mod_subtitulo_publ'] ? $ml_pp['mod_subtitulo_publ'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_publ', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_publ', 'Periodicidades') !!}                    
                    {!! Form::text('cam_publ', $ml_pp['cam_publ'] ? $ml_pp['cam_publ'] : null, ['class' => 'form-control', 'id' => 'cam_publ', 'placeholder' => 'Periodicidades']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

     <!--Traduccion Genero Literario  -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Género Literario</h3>
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
                        {!! Form::label('titulo_gl', 'Título principal') !!}                    
                        {!! Form::text('titulo_gl', $ml_gl['titulo_gl'] ? $ml_gl['titulo_gl'] : null, ['class' => 'form-control', 'id' => 'titulo_gl', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_gl', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_gl', $ml_gl['subtitulo_gl'] ? $ml_gl['subtitulo_gl'] : null, ['class' => 'form-control', 'id' => 'subtitulo_gl', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_gl', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_gl', $ml_gl['btn_crear_gl'] ? $ml_gl['btn_crear_gl'] : null, ['class' => 'form-control', 'id' => 'btn_crear_gl', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_gl', 'Id') !!}                    
                    {!! Form::text('dt_id_gl', $ml_gl['dt_id_gl'] ? $ml_gl['dt_id_gl'] : null, ['class' => 'form-control', 'id' => 'dt_id_gl', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_gl', 'Género Literario') !!}                    
                    {!! Form::text('dt_gl', $ml_gl['dt_gl'] ? $ml_gl['dt_gl'] : null, ['class' => 'form-control', 'id' => 'dt_gl', 'placeholder' => 'Género Literario']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_gl', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_gl', $ml_gl['dt_agregado_gl'] ? $ml_gl['dt_agregado_gl'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_gl', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_gl', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_gl', $ml_gl['dt_acciones_gl'] ? $ml_gl['dt_acciones_gl'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_gl', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_gl', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_gl', $ml_gl['mod_titulo_gl'] ? $ml_gl['mod_titulo_gl'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_gl', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_gl', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_gl', $ml_gl['mod_subtitulo_gl'] ? $ml_gl['mod_subtitulo_gl'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_gl', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_gl', 'Género Literario') !!}                    
                    {!! Form::text('cam_gl', $ml_gl['cam_gl'] ? $ml_gl['cam_gl'] : null, ['class' => 'form-control', 'id' => 'cam_gl', 'placeholder' => 'Género Literario']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

     <!--Traduccion Genero Musical  -->
     <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Género Musical</h3>
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
                        {!! Form::label('titulo_gm', 'Título principal') !!}                    
                        {!! Form::text('titulo_gm', $ml_gm['titulo_gm'] ? $ml_gm['titulo_gm'] : null, ['class' => 'form-control', 'id' => 'titulo_gm', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_gm', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_gm', $ml_gm['subtitulo_gm'] ? $ml_gm['subtitulo_gm'] : null, ['class' => 'form-control', 'id' => 'subtitulo_gm', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_gm', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_gm', $ml_gm['btn_crear_gm'] ? $ml_gm['btn_crear_gm'] : null, ['class' => 'form-control', 'id' => 'btn_crear_gm', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_gm', 'Id') !!}                    
                    {!! Form::text('dt_id_gm', $ml_gm['dt_id_gm'] ? $ml_gm['dt_id_gm'] : null, ['class' => 'form-control', 'id' => 'dt_id_gm', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_gm', 'Género Musical') !!}                    
                    {!! Form::text('dt_gm', $ml_gm['dt_gm'] ? $ml_gm['dt_gm'] : null, ['class' => 'form-control', 'id' => 'dt_gm', 'placeholder' => 'Género Musical']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_gm', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_gm', $ml_gm['dt_agregado_gm'] ? $ml_gm['dt_agregado_gm'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_gm', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_gm', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_gm', $ml_gm['dt_acciones_gm'] ? $ml_gm['dt_acciones_gm'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_gm', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_gm', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_gm', $ml_gm['mod_titulo_gm'] ? $ml_gm['mod_titulo_gm'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_gm', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_gm', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_gm', $ml_gm['mod_subtitulo_gm'] ? $ml_gm['mod_subtitulo_gm'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_gm', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_gm', 'Género  Musical') !!}                    
                    {!! Form::text('cam_gm', $ml_gm['cam_gm'] ? $ml_gm['cam_gm'] : null, ['class' => 'form-control', 'id' => 'cam_gm', 'placeholder' => 'Género  Musical']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

    <!--Traduccion Genero Cinematografico  -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Género Cinematográfico</h3>
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
                        {!! Form::label('titulo_gc', 'Título principal') !!}                    
                        {!! Form::text('titulo_gc', $ml_gc['titulo_gc'] ? $ml_gc['titulo_gc'] : null, ['class' => 'form-control', 'id' => 'titulo_gc', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_gc', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_gc', $ml_gc['subtitulo_gc'] ? $ml_gc['subtitulo_gc'] : null, ['class' => 'form-control', 'id' => 'subtitulo_gc', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_gc', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_gc', $ml_gc['btn_crear_gc'] ? $ml_gc['btn_crear_gc'] : null, ['class' => 'form-control', 'id' => 'btn_crear_gc', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_gc', 'Id') !!}                    
                    {!! Form::text('dt_id_gc', $ml_gc['dt_id_gc'] ? $ml_gc['dt_id_gc'] : null, ['class' => 'form-control', 'id' => 'dt_id_gc', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_gc', 'Género Cinematográfico') !!}                    
                    {!! Form::text('dt_gc', $ml_gc['dt_gc'] ? $ml_gc['dt_gc'] : null, ['class' => 'form-control', 'id' => 'dt_gc', 'placeholder' => 'Género Cinematográfico']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_gc', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_gc', $ml_gc['dt_agregado_gc'] ? $ml_gc['dt_agregado_gc'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_gc', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_gc', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_gc', $ml_gc['dt_acciones_gc'] ? $ml_gc['dt_acciones_gc'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_gc', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_gc', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_gc', $ml_gc['mod_titulo_gc'] ? $ml_gc['mod_titulo_gc'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_gc', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_gc', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_gc', $ml_gc['mod_subtitulo_gc'] ? $ml_gc['mod_subtitulo_gc'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_gc', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_gc', 'Género Cinematográfico') !!}                    
                    {!! Form::text('cam_gc', $ml_gc['cam_gc'] ? $ml_gc['cam_gc'] : null, ['class' => 'form-control', 'id' => 'cam_gc', 'placeholder' => 'Género Cinematográfico']) !!}
                </div>                                  
            </div>
        </div>       
    </div>

    <!--Traduccion Adecuaciones  -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Adecuaciónes</h3>
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
                        {!! Form::label('titulo_adequacy', 'Título principal') !!}                    
                        {!! Form::text('titulo_adequacy', $ml_adequacy['titulo_adequacy'] ? $ml_adequacy['titulo_adequacy'] : null, ['class' => 'form-control', 'id' => 'titulo_adequacy', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_adequacy', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_adequacy', $ml_adequacy['subtitulo_adequacy'] ? $ml_adequacy['subtitulo_adequacy'] : null, ['class' => 'form-control', 'id' => 'subtitulo_adequacy', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_adequacy', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_adequacy', $ml_adequacy['btn_crear_adequacy'] ? $ml_adequacy['btn_crear_adequacy'] : null, ['class' => 'form-control', 'id' => 'btn_crear_adequacy', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_adequacy', 'Id') !!}                    
                    {!! Form::text('dt_id_adequacy', $ml_adequacy['dt_id_adequacy'] ? $ml_adequacy['dt_id_adequacy'] : null, ['class' => 'form-control', 'id' => 'dt_id_adequacy', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_adequacy', 'Adecuaciónes') !!}                    
                    {!! Form::text('dt_adequacy', $ml_adequacy['dt_adequacy'] ? $ml_adequacy['dt_adequacy'] : null, ['class' => 'form-control', 'id' => 'dt_adequacy', 'placeholder' => 'Adecuaciónes']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_adequacy', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_adequacy', $ml_adequacy['dt_agregado_adequacy'] ? $ml_adequacy['dt_agregado_adequacy'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_adequacy', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_adequacy', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_adequacy', $ml_adequacy['dt_acciones_adequacy'] ? $ml_adequacy['dt_acciones_adequacy'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_adequacy', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_adequacy', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_adequacy', $ml_adequacy['mod_titulo_adequacy'] ? $ml_adequacy['mod_titulo_adequacy'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_adequacy', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_adequacy', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_adequacy', $ml_adequacy['mod_subtitulo_adequacy'] ? $ml_adequacy['mod_subtitulo_adequacy'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_adequacy', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_adequacy', 'Adecuaciónes') !!}                    
                    {!! Form::text('cam_adequacy', $ml_adequacy['cam_adequacy'] ? $ml_adequacy['cam_adequacy'] : null, ['class' => 'form-control', 'id' => 'cam_adequacy', 'placeholder' => 'Adecuaciónes']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 

    <!--Traduccion Materias  -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Materias</h3>
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
                        {!! Form::label('titulo_subject', 'Título principal') !!}                    
                        {!! Form::text('titulo_subject', $ml_subject['titulo_subject'] ? $ml_subject['titulo_subject'] : null, ['class' => 'form-control', 'id' => 'titulo_subject', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_subject', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_subject', $ml_subject['subtitulo_subject'] ? $ml_subject['subtitulo_subject'] : null, ['class' => 'form-control', 'id' => 'subtitulo_subject', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_subject', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_subject', $ml_subject['btn_crear_subject'] ? $ml_subject['btn_crear_subject'] : null, ['class' => 'form-control', 'id' => 'btn_crear_subject', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_subject', 'Id') !!}                    
                    {!! Form::text('dt_id_subject', $ml_subject['dt_id_subject'] ? $ml_subject['dt_id_subject'] : null, ['class' => 'form-control', 'id' => 'dt_id_subject', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_subject', 'Materia') !!}                    
                    {!! Form::text('dt_subject', $ml_subject['dt_subject'] ? $ml_subject['dt_subject'] : null, ['class' => 'form-control', 'id' => 'dt_subject', 'placeholder' => 'Materia']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_cdu_subject', 'Cdu') !!}                    
                    {!! Form::text('dt_cdu_subject', $ml_subject['dt_cdu_subject'] ? $ml_subject['dt_cdu_subject'] : null, ['class' => 'form-control', 'id' => 'dt_cdu_subject', 'placeholder' => 'Cdu']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_subject', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_subject', $ml_subject['dt_agregado_subject'] ? $ml_subject['dt_agregado_subject'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_subject', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_subject', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_subject', $ml_subject['dt_acciones_subject'] ? $ml_subject['dt_acciones_subject'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_subject', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_subject', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_subject', $ml_subject['mod_titulo_subject'] ? $ml_subject['mod_titulo_subject'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_subject', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_subject', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_subject', $ml_subject['mod_subtitulo_subject'] ? $ml_subject['mod_subtitulo_subject'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_subject', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_subject', 'Materia') !!}                    
                    {!! Form::text('cam_subject', $ml_subject['cam_subject'] ? $ml_subject['cam_subject'] : null, ['class' => 'form-control', 'id' => 'cam_subject', 'placeholder' => 'Materia']) !!}
                </div>   

                <div class="form-group">              
                    {!! Form::label('cam_cdu_subject', 'Cdu') !!}                    
                    {!! Form::text('cam_cdu_subject', $ml_subject['cam_cdu_subject'] ? $ml_subject['cam_cdu_subject'] : null, ['class' => 'form-control', 'id' => 'cam_cdu_subject', 'placeholder' => 'Cdu']) !!}
                </div>                               
            </div>
        </div>       
    </div> 

    <!--Traduccion Cartas -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Modelo de Cartas</h3>
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
                        {!! Form::label('titulo_letter', 'Título principal') !!}                    
                        {!! Form::text('titulo_letter', $ml_letter['titulo_letter'] ? $ml_letter['titulo_letter'] : null, ['class' => 'form-control', 'id' => 'titulo_letter', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_letter', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_letter', $ml_letter['subtitulo_letter'] ? $ml_letter['subtitulo_letter'] : null, ['class' => 'form-control', 'id' => 'subtitulo_letter', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_letter', 'Botón Crear') !!}                    
                        {!! Form::text('btn_crear_letter', $ml_letter['btn_crear_letter'] ? $ml_letter['btn_crear_letter'] : null, ['class' => 'form-control', 'id' => 'btn_crear_letter', 'placeholder' => 'Botón Crear']) !!}
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
                    {!! Form::label('dt_id_letter', 'Id') !!}                    
                    {!! Form::text('dt_id_letter', $ml_letter['dt_id_letter'] ? $ml_letter['dt_id_letter'] : null, ['class' => 'form-control', 'id' => 'dt_id_letter', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titulo_letter', 'Título') !!}                    
                    {!! Form::text('dt_titulo_letter', $ml_letter['dt_titulo_letter'] ? $ml_letter['dt_titulo_letter'] : null, ['class' => 'form-control', 'id' => 'dt_titulo_letter', 'placeholder' => 'Título']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_cuerpo_letter', 'Contenido') !!}                    
                    {!! Form::text('dt_cuerpo_letter', $ml_letter['dt_cuerpo_letter'] ? $ml_letter['dt_cuerpo_letter'] : null, ['class' => 'form-control', 'id' => 'dt_cuerpo_letter', 'placeholder' => 'Contenido']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_despedida_letter', 'Despedida') !!}                    
                    {!! Form::text('dt_despedida_letter', $ml_letter['dt_despedida_letter'] ? $ml_letter['dt_despedida_letter'] : null, ['class' => 'form-control', 'id' => 'dt_despedida_letter', 'placeholder' => 'Despedida']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_agregado_letter', 'Agregados') !!}                    
                    {!! Form::text('dt_agregado_letter', $ml_letter['dt_agregado_letter'] ? $ml_letter['dt_agregado_letter'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_letter', 'placeholder' => 'Agregados']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_letter', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_letter', $ml_letter['dt_acciones_letter'] ? $ml_letter['dt_acciones_letter'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_letter', 'placeholder' => 'Acciones']) !!}
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
                <!-- <div class="form-group">              
                    {!! Form::label('mod_titulo_letter', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_letter', $ml_letter['mod_titulo_letter'] ? $ml_letter['mod_titulo_letter'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_letter', 'placeholder' => 'Título Modal']) !!}
                </div> -->
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_letter', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_letter', $ml_letter['mod_subtitulo_letter'] ? $ml_letter['mod_subtitulo_letter'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_letter', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_titulo_letter', 'Título') !!}                    
                    {!! Form::text('cam_titulo_letter', $ml_letter['cam_titulo_letter'] ? $ml_letter['cam_titulo_letter'] : null, ['class' => 'form-control', 'id' => 'cam_titulo_letter', 'placeholder' => 'Título']) !!}
                </div>   

                <div class="form-group">              
                    {!! Form::label('cam_cuerpo_letter', 'Cuerpo') !!}                    
                    {!! Form::text('cam_cuerpo_letter', $ml_letter['cam_cuerpo_letter'] ? $ml_letter['cam_cuerpo_letter'] : null, ['class' => 'form-control', 'id' => 'cam_cuerpo_letter', 'placeholder' => 'Cuerpo']) !!}
                </div> 

                 <div class="form-group">              
                    {!! Form::label('cam_despedida_letter', 'Despedida') !!}                    
                    {!! Form::text('cam_despedida_letter', $ml_letter['cam_despedida_letter'] ? $ml_letter['cam_despedida_letter'] : null, ['class' => 'form-control', 'id' => 'cam_despedida_letter', 'placeholder' => 'Despedida']) !!}
                </div>                              
            </div>
        </div>       
    </div> 
{!! Form::close() !!}    
</div>





  