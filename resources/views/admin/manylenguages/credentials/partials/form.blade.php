<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_credentials', $idioma->id] : 'admin.manylenguages.store',   
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
                    <h3 class="box-title">Traducciones Globales Iniciar Sesion</h3>
                </div>
            </div>
        </div>
    </div>
     <!-- Sección Login-->
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                     <h3 class="box-title"> Sección Login</h3>
                </div>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('pri_nombre_is', 'Primer nombre') !!}                    
                    {!! Form::text('pri_nombre_is', $ml_login['pri_nombre_is'] ? $ml_login['pri_nombre_is'] : null, ['class' => 'form-control', 'id' => 'pri_nombre_is', 'placeholder' => 'Primer nombre']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('seg_nombre_is', 'Segundo nombre') !!}                    
                    {!! Form::text('seg_nombre_is', $ml_login['seg_nombre_is'] ? $ml_login['seg_nombre_is'] : null, ['class' => 'form-control', 'id' => 'seg_nombre_is', 'placeholder' => 'Segundo nombre']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('login_is', 'Pestaña login') !!}                    
                    {!! Form::text('login_is', $ml_login['login_is'] ? $ml_login['login_is'] : null, ['class' => 'form-control', 'id' => 'login_is', 'placeholder' => 'Pestaña login']) !!}
                </div>                   
                <div class="form-group">              
                    {!! Form::label('login_msg_is', 'Información de acceso') !!}                    
                    {!! Form::text('login_msg_is', $ml_login['login_msg_is'] ? $ml_login['login_msg_is'] : null, ['class' => 'form-control', 'id' => 'login_msg_is', 'placeholder' => 'Información de acceso']) !!}
                </div>                                          
                <div class="form-group">              
                    {!! Form::label('email_is', 'Email') !!}                    
                    {!! Form::text('email_is', $ml_login['email_is'] ? $ml_login['email_is'] : null, ['class' => 'form-control', 'id' => 'email_is', 'placeholder' => 'Email']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('contraseña_is', 'Contresaña') !!}                    
                    {!! Form::text('contraseña_is', $ml_login['contraseña_is'] ? $ml_login['contraseña_is'] : null, ['class' => 'form-control', 'id' => 'contraseña_is', 'placeholder' => 'Contresaña']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('link_pass_is', 'Link recuperar contraseña') !!}                    
                    {!! Form::text('link_pass_is', $ml_login['link_pass_is'] ? $ml_login['link_pass_is'] : null, ['class' => 'form-control', 'id' => 'link_pass_is', 'placeholder' => 'Link recuperar contraseña']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_entrar_is', 'Botón entrar al sistema') !!}                    
                    {!! Form::text('btn_entrar_is', $ml_login['btn_entrar_is'] ? $ml_login['btn_entrar_is'] : null, ['class' => 'form-control', 'id' => 'btn_entrar_is', 'placeholder' => 'Botón entrar al sistema']) !!}
                </div>                                                     
            </div>       
        </div>   
    </div>  

      <!-- Sección registro -->
      <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                     <h3 class="box-title"> Sección solicitud de registro</h3>
                </div>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('titulo_reg', 'Título Modal') !!}                    
                    {!! Form::text('titulo_reg', $ml_registry['titulo_reg'] ? $ml_registry['titulo_reg'] : null, ['class' => 'form-control', 'id' => 'titulo_reg', 'placeholder' => 'Título Modal']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('info_reg', 'Informacion de Registro') !!}                    
                    {!! Form::text('info_reg', $ml_registry['info_reg'] ? $ml_registry['info_reg'] : null, ['class' => 'form-control', 'id' => 'info_reg', 'placeholder' => 'Informacion de Registro']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('seccion', 'Sección Datos personales') !!}                    
                    {!! Form::text('seccion', $ml_registry['seccion'] ? $ml_registry['seccion'] : null, ['class' => 'form-control', 'id' => 'seccion', 'placeholder' => 'Sección Datos personales']) !!}
                </div>                   
                <div class="form-group">              
                    {!! Form::label('nombre_reg', 'Nombre') !!}                    
                    {!! Form::text('nombre_reg', $ml_registry['nombre_reg'] ? $ml_registry['nombre_reg'] : null, ['class' => 'form-control', 'id' => 'nombre_reg', 'placeholder' => 'Nombre']) !!}
                </div>                                          
                <div class="form-group">              
                    {!! Form::label('apellido_reg', 'Apellido') !!}                    
                    {!! Form::text('apellido_reg', $ml_registry['apellido_reg'] ? $ml_registry['apellido_reg'] : null, ['class' => 'form-control', 'id' => 'apellido_reg', 'placeholder' => 'Apellido']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('nickname_reg', 'Nickname') !!}                    
                    {!! Form::text('nickname_reg', $ml_registry['nickname_reg'] ? $ml_registry['nickname_reg'] : null, ['class' => 'form-control', 'id' => 'contraseña_is', 'placeholder' => 'Nickname']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('email_reg', 'Email') !!}                    
                    {!! Form::text('email_reg', $ml_registry['email_reg'] ? $ml_registry['email_reg'] : null, ['class' => 'form-control', 'id' => 'email_reg', 'placeholder' => 'Email']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('fecha_nac_reg', 'Fecha de nacimiento') !!}                    
                    {!! Form::text('fecha_nac_reg', $ml_registry['fecha_nac_reg'] ? $ml_registry['fecha_nac_reg'] : null, ['class' => 'form-control', 'id' => 'fecha_nac_reg', 'placeholder' => 'Fecha de nacimiento']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_fecha_nac_reg', 'Selecciona Fecha de nacimiento') !!}                    
                    {!! Form::text('ph_fecha_nac_reg', $ml_registry['ph_fecha_nac_reg'] ? $ml_registry['ph_fecha_nac_reg'] : null, ['class' => 'form-control', 'id' => 'ph_fecha_nac_reg', 'placeholder' => 'Selecciona Fecha de nacimiento']) !!}
                </div>
                <!-- <div class="form-group">              
                    {!! Form::label('btn_cerrar_reg', 'Botón cerrar') !!}                    
                    {!! Form::text('btn_cerrar_reg', $ml_registry['btn_cerrar_reg'] ? $ml_registry['btn_cerrar_reg'] : null, ['class' => 'form-control', 'id' => 'btn_cerrar_reg', 'placeholder' => 'Botón cerrar']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_enviar_reg', 'Botón enviar solicitud') !!}                    
                    {!! Form::text('btn_enviar_reg', $ml_registry['btn_enviar_reg'] ? $ml_registry['btn_enviar_reg'] : null, ['class' => 'form-control', 'id' => 'btn_enviar_reg', 'placeholder' => 'Botón enviar solicitud']) !!}
                </div>                                                      -->
            </div>       
        </div>   
    </div>  
   
{!! Form::close() !!}    
</div>


               
                


                      




  