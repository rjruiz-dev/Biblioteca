<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_partner', $idioma->id] : 'admin.manylenguages.store',   
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
    <!-- Alta manual de socio-->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Alta manual de socio</h3>
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
                        {!! Form::label('titulo_ams', 'Título Principal') !!}                    
                        {!! Form::text('titulo_ams', $ml_partner['titulo_ams'] ? $ml_partner['titulo_ams'] : null, ['class' => 'form-control', 'id' => 'titulo_ams', 'placeholder' => 'Título Principal']) !!}
                    </div>     
                    <div class="form-group">              
                        {!! Form::label('subtitulo_ams', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_ams', $ml_partner['subtitulo_ams'] ? $ml_partner['subtitulo_ams'] : null, ['class' => 'form-control', 'id' => 'subtitulo_ams', 'placeholder' => 'Subtítulo']) !!}
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
                    {!! Form::label('dt_id_ams', 'Id') !!}                    
                    {!! Form::text('dt_id_ams', $ml_partner['dt_id_ams'] ? $ml_partner['dt_id_ams'] : null, ['class' => 'form-control', 'id' => 'dt_id_ams', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_usuario_ams', 'N° Usuario') !!}                    
                    {!! Form::text('dt_usuario_ams', $ml_partner['dt_usuario_ams'] ? $ml_partner['dt_usuario_ams'] : null, ['class' => 'form-control', 'id' => 'dt_usuario_ams', 'placeholder' => 'N° Usuario']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_nickname_ams', 'Nickname') !!}                    
                    {!! Form::text('dt_nickname_ams', $ml_partner['dt_nickname_ams'] ? $ml_partner['dt_nickname_ams'] : null, ['class' => 'form-control', 'id' => 'dt_nickname_ams', 'placeholder' => 'Nickname']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_perfil_ams', 'Perfil') !!}                    
                    {!! Form::text('dt_perfil_ams', $ml_partner['dt_perfil_ams'] ? $ml_partner['dt_perfil_ams'] : null, ['class' => 'form-control', 'id' => 'dt_perfil_ams', 'placeholder' => 'Perfil']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_nombre_ams', 'Nombre') !!}                    
                    {!! Form::text('dt_nombre_ams', $ml_partner['dt_nombre_ams'] ? $ml_partner['dt_nombre_ams'] : null, ['class' => 'form-control', 'id' => 'dt_nombre_ams', 'placeholder' => 'Nombre']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_email_ams', 'Email') !!}                    
                    {!! Form::text('dt_email_ams', $ml_partner['dt_email_ams'] ? $ml_partner['dt_email_ams'] : null, ['class' => 'form-control', 'id' => 'dt_email_ams', 'placeholder' => 'Email']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_estado_ams', 'Estado') !!}                    
                    {!! Form::text('dt_estado_ams', $ml_partner['dt_estado_ams'] ? $ml_partner['dt_estado_ams'] : null, ['class' => 'form-control', 'id' => 'dt_estado_ams', 'placeholder' => 'Estado']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_agregado_ams', 'Agregado') !!}                    
                    {!! Form::text('dt_agregado_ams', $ml_partner['dt_agregado_ams'] ? $ml_partner['dt_agregado_ams'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_ams', 'placeholder' => 'Agregado']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_ams', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_ams', $ml_partner['dt_acciones_ams'] ? $ml_partner['dt_acciones_ams'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_ams', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div>   

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Formulario </h3>
                </div>
            </div>
                 
        </div>   
    </div>     
   
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                     <h3 class="box-title">Sección crear usuario </h3>
                </div>
            </div>
            <div class="box-body">                  
                <div class="form-group">              
                    {!! Form::label('mod_titulo', 'Título modal') !!}                    
                    {!! Form::text('mod_titulo', $ml_partner['mod_titulo'] ? $ml_partner['mod_titulo'] : null, ['class' => 'form-control', 'id' => 'mod_titulo', 'placeholder' => 'Título modal']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('seccion_perfil', 'Seccion perfil') !!}                    
                    {!! Form::text('seccion_perfil', $ml_partner['seccion_perfil'] ? $ml_partner['seccion_perfil'] : null, ['class' => 'form-control', 'id' => 'seccion_perfil', 'placeholder' => 'Seccion perfil']) !!}
                </div>                                                
                <div class="form-group">              
                    {!! Form::label('mod_select_tipo', 'Tipo de Usuario') !!}                    
                    {!! Form::text('mod_select_tipo', $ml_partner['mod_select_tipo'] ? $ml_partner['mod_select_tipo'] : null, ['class' => 'form-control', 'id' => 'mod_select_tipo', 'placeholder' => 'Tipo de Usuario']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_check_biblio', 'Bibliotecario') !!}                    
                    {!! Form::text('mod_check_biblio', $ml_partner['mod_check_biblio'] ? $ml_partner['mod_check_biblio'] : null, ['class' => 'form-control', 'id' => 'mod_check_biblio', 'placeholder' => 'Bibliotecario']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_check_biblio', 'Bibliotecario') !!}                    
                    {!! Form::text('mod_check_biblio', $ml_partner['mod_check_biblio'] ? $ml_partner['mod_check_biblio'] : null, ['class' => 'form-control', 'id' => 'mod_check_biblio', 'placeholder' => 'Bibliotecario']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_check_socio', 'Socio') !!}                    
                    {!! Form::text('mod_check_socio', $ml_partner['mod_check_socio'] ? $ml_partner['mod_check_socio'] : null, ['class' => 'form-control', 'id' => 'mod_check_socio', 'placeholder' => 'Socio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_num_user', 'Número de usuario') !!}                    
                    {!! Form::text('mod_num_user', $ml_partner['mod_num_user'] ? $ml_partner['mod_num_user'] : null, ['class' => 'form-control', 'id' => 'mod_num_user', 'placeholder' => 'Número de usuario']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_span_num', 'Span número sugerido') !!}                    
                    {!! Form::text('mod_span_num', $ml_partner['mod_span_num'] ? $ml_partner['mod_span_num'] : null, ['class' => 'form-control', 'id' => 'mod_span_num', 'placeholder' => 'Span número sugerido']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_nickname', 'Nickname') !!}                    
                    {!! Form::text('mod_nickname', $ml_partner['mod_nickname'] ? $ml_partner['mod_nickname'] : null, ['class' => 'form-control', 'id' => 'mod_nickname', 'placeholder' => 'Nickname']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_select_estado', 'Seleccione estado') !!}                    
                    {!! Form::text('mod_select_estado', $ml_partner['mod_select_estado'] ? $ml_partner['mod_select_estado'] : null, ['class' => 'form-control', 'id' => 'mod_select_estado', 'placeholder' => 'Seleccione estado']) !!}
                </div>  

                <div class="form-group">              
                    {!! Form::label('mod_ph_estado', 'Placeholder estado') !!}                    
                    {!! Form::text('mod_ph_estado', $ml_partner['mod_ph_estado'] ? $ml_partner['mod_ph_estado'] : null, ['class' => 'form-control', 'id' => 'mod_ph_estado', 'placeholder' => 'Placeholder estado']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('mod_imagen', 'Seleccione imagen') !!}                    
                    {!! Form::text('mod_imagen', $ml_partner['mod_imagen'] ? $ml_partner['mod_imagen'] : null, ['class' => 'form-control', 'id' => 'mod_imagen', 'placeholder' => 'Seleccione imagen']) !!}
                </div>  
                
                <div class="form-group">              
                    {!! Form::label('mod_span_email', 'Span email') !!}                    
                    {!! Form::text('mod_span_email', $ml_partner['mod_span_email'] ? $ml_partner['mod_span_email'] : null, ['class' => 'form-control', 'id' => 'mod_span_email', 'placeholder' => 'Span email']) !!}
                </div>                                      
            </div>       
        </div>   
    </div>  

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Datos Personales</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('seccion_personales', 'Datos personales') !!}                    
                    {!! Form::text('seccion_personales',  $ml_partner['seccion_personales'] ?  $ml_partner['seccion_personales'] : null, ['class' => 'form-control', 'id' => 'seccion_personales', 'placeholder' => 'Datos personales']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_nombre', 'Nombre') !!}                    
                    {!! Form::text('mod_nombre',  $ml_partner['mod_nombre'] ?  $ml_partner['mod_nombre'] : null, ['class' => 'form-control', 'id' => 'mod_nombre', 'placeholder' => 'Nombre']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_apellido', 'Apellido') !!}                    
                    {!! Form::text('mod_apellido',  $ml_partner['mod_apellido'] ?  $ml_partner['mod_apellido'] : null, ['class' => 'form-control', 'id' => 'mod_apellido', 'placeholder' => 'Apellido']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('mod_select_genero', 'Seleccione género') !!}                    
                    {!! Form::text('mod_select_genero',  $ml_partner['mod_select_genero'] ?  $ml_partner['mod_select_genero'] : null, ['class' => 'form-control', 'id' => 'mod_select_genero', 'placeholder' => 'Seleccione género']) !!}
                
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_ph_genero', 'Placeholder género') !!}                    
                    {!! Form::text('mod_ph_genero',  $ml_partner['mod_ph_genero'] ?  $ml_partner['mod_ph_genero'] : null, ['class' => 'form-control', 'id' => 'mod_ph_genero', 'placeholder' => 'Placeholder género']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_fecha_nac', 'Fecha de nacimiento') !!}                    
                    {!! Form::text('mod_fecha_nac',  $ml_partner['mod_fecha_nac'] ?  $ml_partner['mod_fecha_nac'] : null, ['class' => 'form-control', 'id' => 'mod_fecha_nac', 'placeholder' => 'Fecha de nacimiento']) !!}
                </div> 

                <div class="form-group">              
                    {!! Form::label('mod_pass', 'Contraseña') !!}                    
                    {!! Form::text('mod_pass',  $ml_partner['mod_pass'] ?  $ml_partner['mod_pass'] : null, ['class' => 'form-control', 'id' => 'mod_pass', 'placeholder' => 'Contraseña']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('mod_span_pass', 'Span contraseña') !!}                    
                    {!! Form::text('mod_span_pass',  $ml_partner['mod_span_pass'] ?  $ml_partner['mod_span_pass'] : null, ['class' => 'form-control', 'id' => 'mod_span_pass', 'placeholder' => 'Span contraseña']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_repite_pass', 'Repite contraseña') !!}                    
                    {!! Form::text('mod_repite_pass',  $ml_partner['mod_repite_pass'] ?  $ml_partner['mod_repite_pass'] : null, ['class' => 'form-control', 'id' => 'mod_repite_pass', 'placeholder' => 'Repite contraseñas']) !!}
                </div>    
                            
            </div>       
        </div>   
    </div>  

    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Dirección</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('seccion_direccion', 'Dirección') !!}                    
                    {!! Form::text('seccion_direccion',  $ml_partner['seccion_direccion'] ?  $ml_partner['seccion_direccion'] : null, ['class' => 'form-control', 'id' => 'seccion_direccion', 'placeholder' => 'Dirección']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_telefono', 'Teléfono') !!}                    
                    {!! Form::text('mod_telefono',  $ml_partner['mod_telefono'] ?  $ml_partner['mod_telefono'] : null, ['class' => 'form-control', 'id' => 'mod_telefono', 'placeholder' => 'Teléfono']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_direccion', 'Dirección') !!}                    
                    {!! Form::text('mod_direccion',  $ml_partner['mod_direccion'] ?  $ml_partner['mod_direccion'] : null, ['class' => 'form-control', 'id' => 'mod_direccion', 'placeholder' => 'Dirección']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('mod_cod_postal', 'Código postal') !!}                    
                    {!! Form::text('mod_cod_postal',  $ml_partner['mod_cod_postal'] ?  $ml_partner['mod_cod_postal'] : null, ['class' => 'form-control', 'id' => 'mod_cod_postal', 'placeholder' => 'Código postal']) !!}
                
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_ciudad', 'Ciudad') !!}                    
                    {!! Form::text('mod_ciudad',  $ml_partner['mod_ciudad'] ?  $ml_partner['mod_ciudad'] : null, ['class' => 'form-control', 'id' => 'mod_ciudad', 'placeholder' => 'Ciudad']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_select_provincia', 'Seleccione provincia') !!}                    
                    {!! Form::text('mod_select_provincia',  $ml_partner['mod_select_provincia'] ?  $ml_partner['mod_select_provincia'] : null, ['class' => 'form-control', 'id' => 'mod_select_provincia', 'placeholder' => 'Seleccione provincia']) !!}
                </div> 

                <div class="form-group">              
                    {!! Form::label('mod_ph_provincia', 'Placeholder provincia') !!}                    
                    {!! Form::text('mod_ph_provincia',  $ml_partner['mod_ph_provincia'] ?  $ml_partner['mod_ph_provincia'] : null, ['class' => 'form-control', 'id' => 'mod_ph_provincia', 'placeholder' => 'Placeholder provincia']) !!}
                </div>  
                
                            
            </div>       
        </div>   
    </div>  

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Show </h3>
                </div>
            </div>
                 
        </div>   
    </div>     

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Detalle usuario</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('mod_titulo_show', 'Título vista show') !!}                    
                    {!! Form::text('mod_titulo_show',  $ml_partner['mod_titulo_show'] ?  $ml_partner['mod_titulo_show'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_show', 'placeholder' => 'Título vista show']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_usuario', 'Usuario') !!}                    
                    {!! Form::text('mod_usuario',  $ml_partner['mod_usuario'] ?  $ml_partner['mod_usuario'] : null, ['class' => 'form-control', 'id' => 'mod_usuario', 'placeholder' => 'Usuario']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_email', 'Email') !!}                    
                    {!! Form::text('mod_email',  $ml_partner['mod_email'] ?  $ml_partner['mod_email'] : null, ['class' => 'form-control', 'id' => 'mod_email', 'placeholder' => 'Email']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('mod_estado', 'Estado') !!}                    
                    {!! Form::text('mod_estado',  $ml_partner['mod_estado'] ?  $ml_partner['mod_estado'] : null, ['class' => 'form-control', 'id' => 'mod_estado', 'placeholder' => 'Estado']) !!}
                
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_info_direccion', 'Info dirección') !!}                    
                    {!! Form::text('mod_info_direccion',  $ml_partner['mod_info_direccion'] ?  $ml_partner['mod_info_direccion'] : null, ['class' => 'form-control', 'id' => 'mod_info_direccion', 'placeholder' => 'Info dirección']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('mod_info_cod_postal', 'Info código postal') !!}                    
                    {!! Form::text('mod_info_cod_postal',  $ml_partner['mod_info_cod_postal'] ?  $ml_partner['mod_info_cod_postal'] : null, ['class' => 'form-control', 'id' => 'mod_info_cod_postal', 'placeholder' => 'Info código postal']) !!}
                </div> 

                <div class="form-group">              
                    {!! Form::label('mod_info_telefono', 'Info teléfono') !!}                    
                    {!! Form::text('mod_info_telefono',  $ml_partner['mod_info_telefono'] ?  $ml_partner['mod_info_telefono'] : null, ['class' => 'form-control', 'id' => 'mod_info_telefono', 'placeholder' => 'Info teléfono']) !!}
                </div>                            
            </div>       
        </div>   
    </div>  

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Botónes </h3>
                </div>
            </div>
                 
        </div>   
    </div>     
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Seccion Botónes</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('btn_crear', 'Botón crear') !!}                    
                    {!! Form::text('btn_crear',  $ml_partner['btn_crear'] ?  $ml_partner['btn_crear'] : null, ['class' => 'form-control', 'id' => 'btn_crear', 'placeholder' => 'Botón crear']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('btn_actualizar', 'Botón actualizar') !!}                    
                    {!! Form::text('btn_actualizar',  $ml_partner['btn_actualizar'] ?  $ml_partner['btn_actualizar'] : null, ['class' => 'form-control', 'id' => 'btn_actualizar', 'placeholder' => 'Botón actualizar']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('btn_cerrar', 'Botón cerrar') !!}                    
                    {!! Form::text('btn_cerrar',  $ml_partner['btn_cerrar'] ?  $ml_partner['btn_cerrar'] : null, ['class' => 'form-control', 'id' => 'btn_cerrar', 'placeholder' => 'Botón cerrar']) !!}
                </div>               
            </div>       
        </div>   
    </div> 

    <!-- Solcitud desde la web -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Solicitud desde la web</h3>
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
                        {!! Form::label('titulo_wr', 'Título Principal') !!}                    
                        {!! Form::text('titulo_wr', $ml_wr['titulo_wr'] ? $ml_wr['titulo_wr'] : null, ['class' => 'form-control', 'id' => 'titulo_wr', 'placeholder' => 'Título Principal']) !!}
                    </div>     
                    <div class="form-group">              
                        {!! Form::label('subtitulo_wr', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_wr', $ml_wr['subtitulo_wr'] ? $ml_wr['subtitulo_wr'] : null, ['class' => 'form-control', 'id' => 'subtitulo_wr', 'placeholder' => 'Subtítulo']) !!}
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
                    {!! Form::label('dt_id_wr', 'Id') !!}                    
                    {!! Form::text('dt_id_wr', $ml_wr['dt_id_wr'] ? $ml_wr['dt_id_wr'] : null, ['class' => 'form-control', 'id' => 'dt_id_wr', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_nombre_wr', 'Nombre') !!}                    
                    {!! Form::text('dt_nombre_wr', $ml_wr['dt_nombre_wr'] ? $ml_wr['dt_nombre_wr'] : null, ['class' => 'form-control', 'id' => 'dt_nombre_wr', 'placeholder' => 'Nombre']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_usuario_wr', 'N° Usuario') !!}                    
                    {!! Form::text('dt_usuario_wr', $ml_wr['dt_usuario_wr'] ? $ml_wr['dt_usuario_wr'] : null, ['class' => 'form-control', 'id' => 'dt_usuario_wr', 'placeholder' => 'N° Usuario']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('dt_email_wr', 'Email') !!}                    
                    {!! Form::text('dt_email_wr', $ml_wr['dt_email_wr'] ? $ml_wr['dt_email_wr'] : null, ['class' => 'form-control', 'id' => 'dt_email_wr', 'placeholder' => 'Email']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_estado_wr', 'Estado') !!}                    
                    {!! Form::text('dt_estado_wr', $ml_wr['dt_estado_wr'] ? $ml_wr['dt_estado_wr'] : null, ['class' => 'form-control', 'id' => 'dt_estado_wr', 'placeholder' => 'Estado']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_agregado_wr', 'Agregado') !!}                    
                    {!! Form::text('dt_agregado_wr', $ml_wr['dt_agregado_wr'] ? $ml_wr['dt_agregado_wr'] : null, ['class' => 'form-control', 'id' => 'dt_agregado_wr', 'placeholder' => 'Agregado']) !!}
                </div>             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_wr', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_wr', $ml_wr['dt_acciones_wr'] ? $ml_wr['dt_acciones_wr'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_wr', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>


               
                


                      




  