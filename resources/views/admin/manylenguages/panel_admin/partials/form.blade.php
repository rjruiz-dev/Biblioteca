<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_panel_admin', $idioma->id] : 'admin.manylenguages.store',   
    'method' => $idioma->exists ? 'PUT' : 'POST'
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

    <!--Traduccion Cursos -->
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones de Panel de Administrador</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <!-- <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div> -->
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('panel_de_control', 'Titulo Panel de Control') !!}                    
                        {!! Form::text('panel_de_control', $panel_admin['panel_de_control'] ? $panel_admin['panel_de_control'] : null, ['class' => 'form-control', 'id' => 'panel_de_control', 'placeholder' => 'Titulo Panel de Control']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('documentos', 'Etiqueta Documentos') !!}                    
                        {!! Form::text('documentos', $panel_admin['documentos'] ? $panel_admin['documentos'] : null, ['class' => 'form-control', 'id' => 'documentos', 'placeholder' => 'Etiqueta Documentos']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('documentos_registrados', 'Etiqueta Documentos Registrados') !!}                    
                        {!! Form::text('documentos_registrados', $panel_admin['documentos_registrados'] ? $panel_admin['documentos_registrados'] : null, ['class' => 'form-control', 'id' => 'documentos_registrados', 'placeholder' => 'Etiqueta Documentos Registrados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('prestamos', 'Etiqueta Prestamos') !!}                    
                        {!! Form::text('prestamos', $panel_admin['prestamos'] ? $panel_admin['prestamos'] : null, ['class' => 'form-control', 'id' => 'prestamos', 'placeholder' => 'Etiqueta Prestamos']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('prestamos_registrados', 'Etiqueta Prestamos Registrados') !!}                    
                        {!! Form::text('prestamos_registrados', $panel_admin['prestamos_registrados'] ? $panel_admin['prestamos_registrados'] : null, ['class' => 'form-control', 'id' => 'prestamos_registrados', 'placeholder' => 'Etiqueta Prestamos Registrados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('prestamos_vencidos', 'Etiqueta Prestamos Vencidos') !!}                    
                        {!! Form::text('prestamos_vencidos', $panel_admin['prestamos_vencidos'] ? $panel_admin['prestamos_vencidos'] : null, ['class' => 'form-control', 'id' => 'prestamos_vencidos', 'placeholder' => 'Etiqueta Prestamos Vencidos']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('vencidos_registrados', 'Etiqueta Vencidos Registrados') !!}                    
                        {!! Form::text('vencidos_registrados', $panel_admin['vencidos_registrados'] ? $panel_admin['vencidos_registrados'] : null, ['class' => 'form-control', 'id' => 'vencidos_registrados', 'placeholder' => 'Etiqueta Vencidos Registrados']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('usuarios', 'Etiquetas Usuarios') !!}                    
                        {!! Form::text('usuarios', $panel_admin['usuarios'] ? $panel_admin['usuarios'] : null, ['class' => 'form-control', 'id' => 'usuarios', 'placeholder' => 'Etiquetas Usuarios']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('usuarios_registrados', 'Etiqueta Usuarios Registrados') !!}                    
                        {!! Form::text('usuarios_registrados', $panel_admin['usuarios_registrados'] ? $panel_admin['usuarios_registrados'] : null, ['class' => 'form-control', 'id' => 'usuarios_registrados', 'placeholder' => 'Etiqueta Usuarios Registrados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('ultimos_cinco_prestamos', 'Ultimos Cinco Prestamos') !!}                    
                        {!! Form::text('ultimos_cinco_prestamos', $panel_admin['ultimos_cinco_prestamos'] ? $panel_admin['ultimos_cinco_prestamos'] : null, ['class' => 'form-control', 'id' => 'ultimos_cinco_prestamos', 'placeholder' => 'Ultimos Cinco Prestamos']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_id', 'Tabla Prestamos Id') !!}                    
                        {!! Form::text('pres_id', $panel_admin['pres_id'] ? $panel_admin['pres_id'] : null, ['class' => 'form-control', 'id' => 'pres_id', 'placeholder' => 'Tabla Prestamos Id']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_prefil', 'Tabla Prestamos Perfil') !!}                    
                        {!! Form::text('pres_prefil', $panel_admin['pres_prefil'] ? $panel_admin['pres_prefil'] : null, ['class' => 'form-control', 'id' => 'pres_prefil', 'placeholder' => 'Tabla Prestamos Perfil']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_nombre', 'Tabla Prestamos Nombre') !!}                    
                        {!! Form::text('pres_nombre', $panel_admin['pres_nombre'] ? $panel_admin['pres_nombre'] : null, ['class' => 'form-control', 'id' => 'pres_nombre', 'placeholder' => 'Tabla Prestamos Nombre']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('pres_email', 'Tabla Prestamos Email') !!}                    
                        {!! Form::text('pres_email', $panel_admin['pres_email'] ? $panel_admin['pres_email'] : null, ['class' => 'form-control', 'id' => 'pres_email', 'placeholder' => 'Tabla Prestamos Email']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_titulo', 'Tabla Prestamos Titulo') !!}                    
                        {!! Form::text('pres_titulo', $panel_admin['pres_titulo'] ? $panel_admin['pres_titulo'] : null, ['class' => 'form-control', 'id' => 'pres_titulo', 'placeholder' => 'Tabla Prestamos Titulo']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_fecha_devolucion', 'Tabla Prestamos Fecha Dev') !!}                    
                        {!! Form::text('pres_fecha_devolucion', $panel_admin['pres_fecha_devolucion'] ? $panel_admin['pres_fecha_devolucion'] : null, ['class' => 'form-control', 'id' => 'pres_fecha_devolucion', 'placeholder' => 'Tabla Prestamos Fecha Dev']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_n_ejemplar', 'Tabla Prestamos N Ejemplar') !!}                    
                        {!! Form::text('pres_n_ejemplar', $panel_admin['pres_n_ejemplar'] ? $panel_admin['pres_n_ejemplar'] : null, ['class' => 'form-control', 'id' => 'pres_n_ejemplar', 'placeholder' => 'Tabla Prestamos N Ejemplar']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('pres_cant_prestamos', 'Tabla Prestamos Cant Prestamos') !!}                    
                        {!! Form::text('pres_cant_prestamos', $panel_admin['pres_cant_prestamos'] ? $panel_admin['pres_cant_prestamos'] : null, ['class' => 'form-control', 'id' => 'pres_cant_prestamos', 'placeholder' => 'Tabla Prestamos Cant Prestamos']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('prestamos_vencidos', 'Prestamos Vencidos') !!}                    
                        {!! Form::text('prestamos_vencidos', $panel_admin['prestamos_vencidos'] ? $panel_admin['prestamos_vencidos'] : null, ['class' => 'form-control', 'id' => 'prestamos_vencidos', 'placeholder' => 'Prestamos Vencidos']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_id', 'Tabla Vencidos Id') !!}                    
                        {!! Form::text('venc_id', $panel_admin['venc_id'] ? $panel_admin['venc_id'] : null, ['class' => 'form-control', 'id' => 'venc_id', 'placeholder' => 'Tabla Vencidos Id']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_perfil', 'Tabla Vencidos Perfil') !!}                    
                        {!! Form::text('venc_perfil', $panel_admin['venc_perfil'] ? $panel_admin['venc_perfil'] : null, ['class' => 'form-control', 'id' => 'venc_perfil', 'placeholder' => 'Tabla Vencidos Perfil']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_nombre', 'Tabla Vencidos Nombre') !!}                    
                        {!! Form::text('venc_nombre', $panel_admin['venc_nombre'] ? $panel_admin['venc_nombre'] : null, ['class' => 'form-control', 'id' => 'venc_nombre', 'placeholder' => 'Tabla Vencidos Nombre']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_email', 'Tabla Vencidos Email') !!}                    
                        {!! Form::text('venc_email', $panel_admin['venc_email'] ? $panel_admin['venc_email'] : null, ['class' => 'form-control', 'id' => 'venc_email', 'placeholder' => 'Tabla Vencidos Email']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_titulo', 'Tabla Vencidos Titulo') !!}                    
                        {!! Form::text('venc_titulo', $panel_admin['venc_titulo'] ? $panel_admin['venc_titulo'] : null, ['class' => 'form-control', 'id' => 'venc_titulo', 'placeholder' => 'Tabla Vencidos Titulo']) !!}
                    </div>
                    
                    <div class="form-group">              
                        {!! Form::label('venc_fecha_devolucion', 'Tabla Vencidos Fecha Dev') !!}                    
                        {!! Form::text('venc_fecha_devolucion', $panel_admin['venc_fecha_devolucion'] ? $panel_admin['venc_fecha_devolucion'] : null, ['class' => 'form-control', 'id' => 'venc_fecha_devolucion', 'placeholder' => 'Tabla Vencidos Fecha Dev']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_n_ejemplar', 'Tabla Vencidos N Ejemplares') !!}                    
                        {!! Form::text('venc_n_ejemplar', $panel_admin['venc_n_ejemplar'] ? $panel_admin['venc_n_ejemplar'] : null, ['class' => 'form-control', 'id' => 'venc_n_ejemplar', 'placeholder' => 'Tabla Vencidos N Ejemplares']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('venc_cant_prestamos', 'Tabla Vencidos Cant Prestamos') !!}                    
                        {!! Form::text('venc_cant_prestamos', $panel_admin['venc_cant_prestamos'] ? $panel_admin['venc_cant_prestamos'] : null, ['class' => 'form-control', 'id' => 'venc_cant_prestamos', 'placeholder' => 'Tabla Vencidos Cant Prestamos']) !!}
                    </div>
                </div>
            </div>       
        </div>   
    </div>      
{!! Form::close() !!}    
</div>





  