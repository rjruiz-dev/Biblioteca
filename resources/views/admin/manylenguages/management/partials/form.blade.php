<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_loan', $idioma->id] : 'admin.manylenguages.store',   
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
    <!--  Préstamo Manual -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Préstamo Manual</h3>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_wl', 'Título Principal') !!}                    
                        {!! Form::text('titulo_ml', $ml_ml['titulo_ml'] ? $ml_ml['titulo_ml'] : null, ['class' => 'form-control', 'id' => 'titulo_ml', 'placeholder' => 'Título Principal']) !!}
                    </div>   
                    <div class="form-group">              
                        {!! Form::label('subtitulo_ml', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_ml', $ml_ml['subtitulo_ml'] ? $ml_ml['subtitulo_ml'] : null, ['class' => 'form-control', 'id' => 'subtitulo_ml', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                                         
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Columnas Datatable </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('dt_id_ml', 'Id') !!}                    
                    {!! Form::text('dt_id_ml', $ml_ml['dt_id_ml'] ? $ml_ml['dt_id_ml'] : null, ['class' => 'form-control', 'id' => 'dt_id_ml', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titulo_ml', 'Título') !!}                    
                    {!! Form::text('dt_titulo_ml', $ml_ml['dt_titulo_ml'] ? $ml_ml['dt_titulo_ml'] : null, ['class' => 'form-control', 'id' => 'dt_titulo_ml', 'placeholder' => 'Título']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_tipo_ml', 'Tipo') !!}                    
                    {!! Form::text('dt_tipo_ml', $ml_ml['dt_tipo_ml'] ? $ml_ml['dt_tipo_ml'] : null, ['class' => 'form-control', 'id' => 'dt_tipo_ml', 'placeholder' => 'Tipo']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_subtipo_ml', 'Subtipo') !!}                    
                    {!! Form::text('dt_subtipo_ml', $ml_ml['dt_subtipo_ml'] ? $ml_ml['dt_subtipo_ml'] : null, ['class' => 'form-control', 'id' => 'dt_subtipo_ml', 'placeholder' => 'Subtipo']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_copias_ml', 'Copias disponibles') !!}                    
                    {!! Form::text('dt_copias_ml', $ml_ml['dt_copias_ml'] ? $ml_ml['dt_copias_ml'] : null, ['class' => 'form-control', 'id' => 'dt_copias_ml', 'placeholder' => 'Copias disponibles']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_ml', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_ml', $ml_ml['dt_acciones_ml'] ? $ml_ml['dt_acciones_ml'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_ml', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div>   

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Préstamos </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_index', 'Título') !!}                    
                        {!! Form::text('titulo_index', $ml_ml['titulo_index'] ? $ml_ml['titulo_index'] : null, ['class' => 'form-control', 'id' => 'titulo_index', 'placeholder' => 'Título']) !!}
                    </div>                                 
                </div>
            </div>       
        </div>   
    </div>     

    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Documento</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('seccion_doc', 'Documento') !!}                    
                    {!! Form::text('seccion_doc', $ml_ml['seccion_doc'] ? $ml_ml['seccion_doc'] : null, ['class' => 'form-control', 'id' => 'seccion_doc', 'placeholder' => 'Documento']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('tipo_doc', 'Tipo documento') !!}                    
                    {!! Form::text('tipo_doc', $ml_ml['tipo_doc'] ? $ml_ml['tipo_doc'] : null, ['class' => 'form-control', 'id' => 'tipo_doc', 'placeholder' => 'Tipo documento']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('tipo_libro', 'Tipo de Libro') !!}                    
                    {!! Form::text('tipo_libro', $ml_ml['tipo_libro'] ? $ml_ml['tipo_libro'] : null, ['class' => 'form-control', 'id' => 'tipo_libro', 'placeholder' => 'Tipo de Libro']) !!}
                </div>                   
            </div>       
        </div>   
    </div>  
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                     <h3 class="box-title">Sección Préstamo </h3>
                </div>
            </div>
            <div class="box-body">                  
                <div class="form-group">              
                    {!! Form::label('seccion_prestamo', 'Datos del préstamo') !!}                    
                    {!! Form::text('seccion_prestamo', $ml_ml['seccion_prestamo'] ? $ml_ml['seccion_prestamo'] : null, ['class' => 'form-control', 'id' => 'seccion_prestamo', 'placeholder' => 'Datos del préstamo']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('select_registro', 'Número de registro') !!}                    
                    {!! Form::text('select_registro', $ml_ml['select_registro'] ? $ml_ml['select_registro'] : null, ['class' => 'form-control', 'id' => 'select_registro', 'placeholder' => 'Número de registro']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_registro', 'Selecciona número de copia') !!}                    
                    {!! Form::text('ph_registro', $ml_ml['ph_registro'] ? $ml_ml['ph_registro'] : null, ['class' => 'form-control', 'id' => 'ph_registro', 'placeholder' => 'Selecciona número de copia']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('select_usuario', 'Usuario') !!}                    
                    {!! Form::text('select_usuario', $ml_ml['select_usuario'] ? $ml_ml['select_usuario'] : null, ['class' => 'form-control', 'id' => 'select_usuario', 'placeholder' => 'Usuario']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_usuario', 'Selecciona usuario') !!}                    
                    {!! Form::text('ph_usuario', $ml_ml['ph_usuario'] ? $ml_ml['ph_usuario'] : null, ['class' => 'form-control', 'id' => 'ph_usuario', 'placeholder' => 'Selecciona usuario']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('nickname', 'Nickname') !!}                    
                    {!! Form::text('nickname', $ml_ml['nickname'] ? $ml_ml['nickname'] : null, ['class' => 'form-control', 'id' => 'nickname', 'placeholder' => 'Nickname']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('apellido', 'Apellido') !!}                    
                    {!! Form::text('apellido', $ml_ml['apellido'] ? $ml_ml['apellido'] : null, ['class' => 'form-control', 'id' => 'apellido', 'placeholder' => 'Apellido']) !!}
                </div>     

                 <div class="form-group">              
                    {!! Form::label('email', 'Email') !!}                    
                    {!! Form::text('email', $ml_ml['email'] ? $ml_ml['email'] : null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('cant_prestamos', 'Préstamos actuales') !!}                    
                    {!! Form::text('cant_prestamos', $ml_ml['cant_prestamos'] ? $ml_ml['cant_prestamos'] : null, ['class' => 'form-control', 'id' => 'cant_prestamos', 'placeholder' => 'Préstamos actuales']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('select_curso', 'Curso') !!}                    
                    {!! Form::text('select_curso', $ml_ml['select_curso'] ? $ml_ml['select_curso'] : null, ['class' => 'form-control', 'id' => 'select_curso', 'placeholder' => 'Curso']) !!}
                </div>     
                <div class="form-group">              
                    {!! Form::label('ph_curso', 'Selecciona curso') !!}                    
                    {!! Form::text('ph_curso', $ml_ml['ph_curso'] ? $ml_ml['ph_curso'] : null, ['class' => 'form-control', 'id' => 'ph_curso', 'placeholder' => 'Selecciona curso']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('select_grupo', 'Grupo') !!}                    
                    {!! Form::text('select_grupo', $ml_ml['select_grupo'] ? $ml_ml['select_grupo'] : null, ['class' => 'form-control', 'id' => 'select_grupo', 'placeholder' => 'Grupo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_grupo', 'Selecciona grupo') !!}                    
                    {!! Form::text('ph_grupo', $ml_ml['ph_grupo'] ? $ml_ml['ph_grupo'] : null, ['class' => 'form-control', 'id' => 'ph_grupo', 'placeholder' => 'Selecciona grupo']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('select_turno', 'Turno') !!}                    
                    {!! Form::text('select_turno', $ml_ml['select_turno'] ? $ml_ml['select_turno'] : null, ['class' => 'form-control', 'id' => 'select_turno', 'placeholder' => 'Turno']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('ph_turno', 'Selecciona turno') !!}                    
                    {!! Form::text('ph_turno', $ml_ml['ph_turno'] ? $ml_ml['ph_turno'] : null, ['class' => 'form-control', 'id' => 'ph_turno', 'placeholder' => 'Selecciona turno']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('fecha_prestamo', 'Prestado hasta') !!}                    
                    {!! Form::text('fecha_prestamo', $ml_ml['fecha_prestamo'] ? $ml_ml['fecha_prestamo'] : null, ['class' => 'form-control', 'id' => 'fecha_prestamo', 'placeholder' => 'Prestado hasta']) !!}                                     
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_prestar', 'Boton Prestar') !!}                    
                    {!! Form::text('btn_prestar', $ml_ml['btn_prestar'] ? $ml_ml['btn_prestar'] : null, ['class' => 'form-control', 'id' => 'btn_prestar', 'placeholder' => 'Boton Prestar']) !!}                                     
                </div>
            </div>       
        </div>   
    </div>  
  

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Préstamo desde la Web</h3>
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
                        {!! Form::label('titulo_wl', 'Título Principal') !!}                    
                        {!! Form::text('titulo_wl', $ml_wl['titulo_wl'] ? $ml_wl['titulo_wl'] : null, ['class' => 'form-control', 'id' => 'titulo_wl', 'placeholder' => 'Título Principal']) !!}
                    </div>   
                    <div class="form-group">              
                        {!! Form::label('subtitulo_wl', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_wl', $ml_wl['subtitulo_wl'] ? $ml_wl['subtitulo_wl'] : null, ['class' => 'form-control', 'id' => 'subtitulo_wl', 'placeholder' => 'Subtítulo']) !!}
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
                    {!! Form::label('dt_id_wl', 'Id') !!}                    
                    {!! Form::text('dt_id_wl', $ml_wl['dt_id_wl'] ? $ml_wl['dt_id_wl'] : null, ['class' => 'form-control', 'id' => 'dt_id_wl', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titulo_wl', 'Título') !!}                    
                    {!! Form::text('dt_titulo_wl', $ml_wl['dt_titulo_wl'] ? $ml_wl['dt_titulo_wl'] : null, ['class' => 'form-control', 'id' => 'dt_titulo_wl', 'placeholder' => 'Título']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_documento_wl', 'Documento') !!}                    
                    {!! Form::text('dt_documento_wl', $ml_wl['dt_documento_wl'] ? $ml_wl['dt_documento_wl'] : null, ['class' => 'form-control', 'id' => 'dt_documento_wl', 'placeholder' => 'Documento']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_tipo_wl', 'Tipo') !!}                    
                    {!! Form::text('dt_tipo_wl', $ml_wl['dt_tipo_wl'] ? $ml_wl['dt_tipo_wl'] : null, ['class' => 'form-control', 'id' => 'dt_tipo_wl', 'placeholder' => 'Tipo']) !!}
                </div>
                

                <div class="form-group">              
                    {!! Form::label('dt_subtipo_wl', 'Subtipo') !!}                    
                    {!! Form::text('dt_subtipo_wl', $ml_wl['dt_subtipo_wl'] ? $ml_wl['dt_subtipo_wl'] : null, ['class' => 'form-control', 'id' => 'dt_subtipo_wl', 'placeholder' => 'Subtipo']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_curso_wl', 'Curso') !!}                    
                    {!! Form::text('dt_curso_wl', $ml_wl['dt_curso_wl'] ? $ml_wl['dt_curso_wl'] : null, ['class' => 'form-control', 'id' => 'dt_curso_wl', 'placeholder' => 'Curso']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_agregado_wl', 'Agregado') !!}                    
                    {!! Form::text('dt_agregado_wl', $ml_wl['dt_agregado_wl'] ? $ml_wl['dt_agregado_wl'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_wl', 'placeholder' => 'Agregado']) !!}
                </div> 

                <div class="form-group">              
                    {!! Form::label('dt_acciones_wl', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_wl', $ml_wl['dt_acciones_wl'] ? $ml_wl['dt_acciones_wl'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_wl', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div>   

    

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Documento</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('mod_titulo', 'Solicitud') !!}                    
                    {!! Form::text('mod_titulo', $ml_wl['mod_titulo'] ? $ml_wl['mod_titulo'] : null, ['class' => 'form-control', 'id' => 'mod_titulo', 'placeholder' => 'Solicitud']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_tipo_doc', 'Tipo documento') !!}                    
                    {!! Form::text('mod_tipo_doc', $ml_wl['mod_tipo_doc'] ? $ml_wl['mod_tipo_doc'] : null, ['class' => 'form-control', 'id' => 'mod_tipo_doc', 'placeholder' => 'Tipo documento']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_subtipo_doc', 'Subtipo de documento') !!}                    
                    {!! Form::text('mod_subtipo_doc', $ml_wl['mod_subtipo_doc'] ? $ml_wl['mod_subtipo_doc'] : null, ['class' => 'form-control', 'id' => 'mod_subtipo_doc', 'placeholder' => 'Subtipo de documento']) !!}
                </div>  

                 <div class="form-group">              
                    {!! Form::label('mod_socio', 'Socio solicitante') !!}                    
                    {!! Form::text('mod_socio', $ml_wl['mod_socio'] ? $ml_wl['mod_socio'] : null, ['class' => 'form-control', 'id' => 'mod_socio', 'placeholder' => 'Socio solicitante']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_fecha', 'Fecha de Solicitud') !!}                    
                    {!! Form::text('mod_fecha', $ml_wl['mod_fecha'] ? $ml_wl['mod_fecha'] : null, ['class' => 'form-control', 'id' => 'mod_fecha', 'placeholder' => 'Fecha de Solicitud']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('btn_aceptar', 'Aceptar solicitud') !!}                    
                    {!! Form::text('btn_aceptar', $ml_wl['btn_aceptar'] ? $ml_wl['btn_aceptar'] : null, ['class' => 'form-control', 'id' => 'btn_aceptar', 'placeholder' => 'Aceptar solicitud']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_rechazar', 'Rechazar solicitud') !!}                    
                    {!! Form::text('btn_rechazar', $ml_wl['btn_rechazar'] ? $ml_wl['btn_rechazar'] : null, ['class' => 'form-control', 'id' => 'btn_rechazar', 'placeholder' => 'Rechazar solicitud']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('btn_cerrar', 'Boton Cerrar') !!}                    
                    {!! Form::text('btn_cerrar', $ml_wl['btn_cerrar'] ? $ml_wl['btn_cerrar'] : null, ['class' => 'form-control', 'id' => 'btn_cerrar', 'placeholder' => 'Boton Cerrar']) !!}
                </div>                  
            </div>       
        </div>   
    </div>  

{!! Form::close() !!}    
</div>


               
                


                      




  