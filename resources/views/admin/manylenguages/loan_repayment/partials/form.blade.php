<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_loan_repayment', $idioma->id] : 'admin.manylenguages.store',   
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
    <!--  Préstamo por Socio -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Préstamo Por Socio</h3>
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
                        {!! Form::label('titulo_lp', 'Título Principal') !!}                    
                        {!! Form::text('titulo_lp', $ml_lp['titulo_lp'] ? $ml_lp['titulo_lp'] : null, ['class' => 'form-control', 'id' => 'titulo_lp', 'placeholder' => 'Título Principal']) !!}
                    </div>   
                    <div class="form-group">              
                        {!! Form::label('subtitulo_lp', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_lp', $ml_lp['subtitulo_lp'] ? $ml_lp['subtitulo_lp'] : null, ['class' => 'form-control', 'id' => 'subtitulo_lp', 'placeholder' => 'Subtítulo']) !!}
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
                    {!! Form::label('dt_id_lp', 'Id') !!}                    
                    {!! Form::text('dt_id_lp', $ml_lp['dt_id_lp'] ? $ml_lp['dt_id_lp'] : null, ['class' => 'form-control', 'id' => 'dt_id_lp', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_socio_lp', 'Num de Socio') !!}                    
                    {!! Form::text('dt_socio_lp', $ml_lp['dt_socio_lp'] ? $ml_lp['dt_socio_lp'] : null, ['class' => 'form-control', 'id' => 'dt_socio_lp', 'placeholder' => 'Num de Socio']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_nickname_lp', 'Nickname') !!}                    
                    {!! Form::text('dt_nickname_lp', $ml_lp['dt_nickname_lp'] ? $ml_lp['dt_nickname_lp'] : null, ['class' => 'form-control', 'id' => 'dt_nickname_lp', 'placeholder' => 'Nickname']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_nombre_lp', 'Nombre') !!}                    
                    {!! Form::text('dt_nombre_lp', $ml_lp['dt_nombre_lp'] ? $ml_lp['dt_nombre_lp'] : null, ['class' => 'form-control', 'id' => 'dt_nombre_lp', 'placeholder' => 'Nombre']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_email_lp', 'Email') !!}                    
                    {!! Form::text('dt_email_lp', $ml_lp['dt_email_lp'] ? $ml_lp['dt_email_lp'] : null, ['class' => 'form-control', 'id' => 'dt_email_lp', 'placeholder' => 'Email']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_estado_lp', 'Estado') !!}                    
                    {!! Form::text('dt_estado_lp', $ml_lp['dt_estado_lp'] ? $ml_lp['dt_estado_lp'] : null, ['class' => 'form-control', 'id' => 'dt_estado_lp', 'placeholder' => 'Estado']) !!}
                </div>
             
                <div class="form-group">              
                    {!! Form::label('dt_acciones_lp', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_lp', $ml_lp['dt_acciones_lp'] ? $ml_lp['dt_acciones_lp'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_lp', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div>   

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Préstamos Asignados </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_index_lp', 'Título') !!}                    
                        {!! Form::text('titulo_index_lp', $ml_lp['titulo_index_lp'] ? $ml_lp['titulo_index_lp'] : null, ['class' => 'form-control', 'id' => 'titulo_index_lp', 'placeholder' => 'Título']) !!}
                    </div>                                 
                </div>
            </div>       
        </div>   
    </div>     

    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Socio</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('seccion_socio', 'Num de socio') !!}                    
                    {!! Form::text('seccion_socio', $ml_lp['seccion_socio'] ? $ml_lp['seccion_socio'] : null, ['class' => 'form-control', 'id' => 'seccion_socio', 'placeholder' => 'Num de socio']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('genero', 'Género') !!}                    
                    {!! Form::text('genero', $ml_lp['genero'] ? $ml_lp['genero'] : null, ['class' => 'form-control', 'id' => 'genero', 'placeholder' => 'Género']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('fecha_nac', 'Fecha de nacimiento') !!}                    
                    {!! Form::text('fecha_nac', $ml_lp['fecha_nac'] ? $ml_lp['fecha_nac'] : null, ['class' => 'form-control', 'id' => 'fecha_nac', 'placeholder' => 'Fecha de nacimiento']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('email', 'Email') !!}                    
                    {!! Form::text('email', $ml_lp['email'] ? $ml_lp['email'] : null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                
                </div>    
                <div class="form-group">              
                    {!! Form::label('telefono', 'Teléfono') !!}                    
                    {!! Form::text('telefono', $ml_lp['telefono'] ? $ml_lp['telefono'] : null, ['class' => 'form-control', 'id' => 'telefono', 'placeholder' => 'Teléfono']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('direccion', 'Dirección') !!}                    
                    {!! Form::text('direccion', $ml_lp['direccion'] ? $ml_lp['direccion'] : null, ['class' => 'form-control', 'id' => 'direccion', 'placeholder' => 'Dirección']) !!}
                </div> 

                <div class="form-group">              
                    {!! Form::label('cod_postal', 'Código postal') !!}                    
                    {!! Form::text('cod_postal', $ml_lp['cod_postal'] ? $ml_lp['cod_postal'] : null, ['class' => 'form-control', 'id' => 'cod_postal', 'placeholder' => 'Código postal']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('ciudad', 'Ciudad') !!}                    
                    {!! Form::text('ciudad', $ml_lp['ciudad'] ? $ml_lp['ciudad'] : null, ['class' => 'form-control', 'id' => 'ciudad', 'placeholder' => 'Ciudad']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('provincia', 'Provincia') !!}                    
                    {!! Form::text('provincia', $ml_lp['provincia'] ? $ml_lp['provincia'] : null, ['class' => 'form-control', 'id' => 'provincia', 'placeholder' => 'Provincia']) !!}
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
                    {!! Form::label('seccion_prestamo', 'Sus presmos') !!}                    
                    {!! Form::text('seccion_prestamo', $ml_lp['seccion_prestamo'] ? $ml_lp['seccion_prestamo'] : null, ['class' => 'form-control', 'id' => 'seccion_prestamo', 'placeholder' => 'Sus presmos']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('num_copia', 'Número de copia') !!}                    
                    {!! Form::text('num_copia', $ml_lp['num_copia'] ? $ml_lp['num_copia'] : null, ['class' => 'form-control', 'id' => 'num_copia', 'placeholder' => 'Número de copia']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('prestado_el', 'Péstado el') !!}                    
                    {!! Form::text('prestado_el', $ml_lp['prestado_el'] ? $ml_lp['prestado_el'] : null, ['class' => 'form-control', 'id' => 'prestado_el', 'placeholder' => 'Péstado el']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('devolver_el', 'A devolver el') !!}                    
                    {!! Form::text('devolver_el', $ml_lp['devolver_el'] ? $ml_lp['devolver_el'] : null, ['class' => 'form-control', 'id' => 'devolver_el', 'placeholder' => 'A devolver el']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dias_retraso', 'Días de retraso') !!}                    
                    {!! Form::text('dias_retraso', $ml_lp['dias_retraso'] ? $ml_lp['dias_retraso'] : null, ['class' => 'form-control', 'id' => 'dias_retraso', 'placeholder' => 'Días de retraso']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('sancion', 'Sanción') !!}                    
                    {!! Form::text('sancion', $ml_lp['sancion'] ? $ml_lp['sancion'] : null, ['class' => 'form-control', 'id' => 'sancion', 'placeholder' => 'Sanción']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('economica', 'Económica') !!}                    
                    {!! Form::text('economica', $ml_lp['economica'] ? $ml_lp['economica'] : null, ['class' => 'form-control', 'id' => 'economica', 'placeholder' => 'Económica']) !!}
                </div>                                               
            </div>       
        </div>   
    </div>  

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Ventana Modal </h3>
                </div>
            </div>                 
        </div>   
    </div>     

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">               
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('mod_titulo_lp', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_lp', $ml_lp['mod_titulo_lp'] ? $ml_lp['mod_titulo_lp'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_lp', 'placeholder' => 'Título Modal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_lp', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_lp', $ml_lp['mod_subtitulo_lp'] ? $ml_lp['mod_subtitulo_lp'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_lp', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_devolver_lp', 'Devuelto en la fecha') !!}                    
                    {!! Form::text('cam_devolver_lp', $ml_lp['cam_devolver_lp'] ? $ml_lp['cam_devolver_lp'] : null, ['class' => 'form-control', 'id' => 'cam_devolver_lp', 'placeholder' => 'Devuelto en la fecha']) !!}
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
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('btn_devolver', 'Botón devolver') !!}                    
                    {!! Form::text('btn_devolver', $ml_lp['btn_devolver'] ? $ml_lp['btn_devolver'] : null, ['class' => 'form-control', 'id' => 'btn_devolver', 'placeholder' => 'Botón devolver']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_renovar', 'Botón renovar') !!}                    
                    {!! Form::text('btn_renovar', $ml_lp['btn_renovar'] ? $ml_lp['btn_renovar'] : null, ['class' => 'form-control', 'id' => 'btn_renovar', 'placeholder' => 'Botón renovar']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('btn_cerrar', 'Botón cerrar') !!}                    
                    {!! Form::text('btn_cerrar', $ml_lp['btn_cerrar'] ? $ml_lp['btn_cerrar'] : null, ['class' => 'form-control', 'id' => 'btn_cerrar', 'placeholder' => 'Botón cerrar']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('btn_si', 'Botón si') !!}                    
                    {!! Form::text('btn_si', $ml_lp['btn_si'] ? $ml_lp['btn_si'] : null, ['class' => 'form-control', 'id' => 'btn_si', 'placeholder' => 'Botón si']) !!}
                </div>                                  
            </div>
        </div>       
    </div> 


    <!--  Préstamo por Documento -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Préstamo Por Documento</h3>
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
                        {!! Form::label('titulo_ld', 'Título Principal') !!}                    
                        {!! Form::text('titulo_ld', $ml_ld['titulo_ld'] ? $ml_ld['titulo_ld'] : null, ['class' => 'form-control', 'id' => 'titulo_ld', 'placeholder' => 'Título Principal']) !!}
                    </div>   
                    <div class="form-group">              
                        {!! Form::label('subtitulo_ld', 'Subtítulo datatable') !!}                    
                        {!! Form::text('subtitulo_ld', $ml_ld['subtitulo_ld'] ? $ml_ld['subtitulo_ld'] : null, ['class' => 'form-control', 'id' => 'subtitulo_ld', 'placeholder' => 'Subtítulo']) !!}
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
                    {!! Form::label('dt_id_ld', 'Id') !!}                    
                    {!! Form::text('dt_id_ld', $ml_ld['dt_id_ld'] ? $ml_ld['dt_id_ld'] : null, ['class' => 'form-control', 'id' => 'dt_id_ld', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titulo_ld', 'Título') !!}                    
                    {!! Form::text('dt_titulo_ld', $ml_ld['dt_titulo_ld'] ? $ml_ld['dt_titulo_ld'] : null, ['class' => 'form-control', 'id' => 'dt_titulo_ld', 'placeholder' => 'Título']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_tipo_ld', 'Tipo') !!}                    
                    {!! Form::text('dt_tipo_ld', $ml_ld['dt_tipo_ld'] ? $ml_ld['dt_tipo_ld'] : null, ['class' => 'form-control', 'id' => 'dt_tipo_ld', 'placeholder' => 'Tipo']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('dt_subtipo_ld', 'Subtipo') !!}                    
                    {!! Form::text('dt_subtipo_ld', $ml_ld['dt_subtipo_ld'] ? $ml_ld['dt_subtipo_ld'] : null, ['class' => 'form-control', 'id' => 'dt_subtipo_ld', 'placeholder' => 'Subtipo']) !!}
                </div>
     
                <div class="form-group">              
                    {!! Form::label('dt_copias_ld', 'Copias') !!}                    
                    {!! Form::text('dt_copias_ld', $ml_ld['dt_copias_ld'] ? $ml_ld['dt_copias_ld'] : null, ['class' => 'form-control', 'id' => 'dt_copias_ld', 'placeholder' => 'Copias']) !!}
                </div>
                         
                <div class="form-group">              
                    {!! Form::label('dt_acciones_ld', 'Acciones') !!}                    
                    {!! Form::text('dt_acciones_ld', $ml_ld['dt_acciones_ld'] ? $ml_ld['dt_acciones_ld'] : null, ['class' => 'form-control', 'id' => 'dt_acciones_ld', 'placeholder' => 'Acciones']) !!}
                </div>                        
            </div>
        </div>       
    </div> 

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Préstamos Documentos </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_index_ld', 'Título') !!}                    
                        {!! Form::text('titulo_index_ld', $ml_ld['titulo_index_ld'] ? $ml_ld['titulo_index_ld'] : null, ['class' => 'form-control', 'id' => 'titulo_index_ld', 'placeholder' => 'Título']) !!}
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
                    {!! Form::text('seccion_doc', $ml_ld['seccion_doc'] ? $ml_ld['seccion_doc'] : null, ['class' => 'form-control', 'id' => 'seccion_doc', 'placeholder' => 'Documento']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('tipo_doc', 'Tipo de documento') !!}                    
                    {!! Form::text('tipo_doc', $ml_ld['tipo_doc'] ? $ml_ld['tipo_doc'] : null, ['class' => 'form-control', 'id' => 'tipo_doc', 'placeholder' => 'Tipo de documento']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('tipo_libro', 'Tipo de libro') !!}                    
                    {!! Form::text('tipo_libro', $ml_ld['tipo_libro'] ? $ml_ld['tipo_libro'] : null, ['class' => 'form-control', 'id' => 'tipo_libro', 'placeholder' => 'Tipo de libro']) !!}
                </div>  
                                                   
            </div>       
        </div>   
    </div>  

    
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Préstamo</h3>
                </div>
            </div>
            <div class="box-body">             
                <div class="form-group">              
                    {!! Form::label('num_copia_ld', 'N° copia') !!}                    
                    {!! Form::text('num_copia_ld', $ml_ld['num_copia_ld'] ? $ml_ld['num_copia_ld'] : null, ['class' => 'form-control', 'id' => 'num_copia_ld', 'placeholder' => 'N° copia']) !!}
                
                </div>    
                <div class="form-group">              
                    {!! Form::label('estado', 'Estado') !!}                    
                    {!! Form::text('estado', $ml_ld['estado'] ? $ml_ld['estado'] : null, ['class' => 'form-control', 'id' => 'estado', 'placeholder' => 'Estado']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('prestado_a', 'Préstado a') !!}                    
                    {!! Form::text('prestado_a', $ml_ld['prestado_a'] ? $ml_ld['prestado_a'] : null, ['class' => 'form-control', 'id' => 'prestado_a', 'placeholder' => 'Préstado a']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('prestado_el', 'Péstado el') !!}                    
                    {!! Form::text('prestado_el', $ml_ld['prestado_el'] ? $ml_ld['prestado_el'] : null, ['class' => 'form-control', 'id' => 'prestado_el', 'placeholder' => 'Péstado el']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('devolver_el', 'A devolver el') !!}                    
                    {!! Form::text('devolver_el', $ml_ld['devolver_el'] ? $ml_ld['devolver_el'] : null, ['class' => 'form-control', 'id' => 'devolver_el', 'placeholder' => 'A devolver el']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dias_retraso', 'Días de retraso') !!}                    
                    {!! Form::text('dias_retraso', $ml_ld['dias_retraso'] ? $ml_ld['dias_retraso'] : null, ['class' => 'form-control', 'id' => 'dias_retraso', 'placeholder' => 'Días de retraso']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('sancion', 'Sanción') !!}                    
                    {!! Form::text('sancion', $ml_ld['sancion'] ? $ml_ld['sancion'] : null, ['class' => 'form-control', 'id' => 'sancion', 'placeholder' => 'Sanción']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('economica', 'Económica') !!}                    
                    {!! Form::text('economica', $ml_ld['economica'] ? $ml_ld['economica'] : null, ['class' => 'form-control', 'id' => 'economica', 'placeholder' => 'Económica']) !!}
                </div>                                     
            </div>       
        </div>   
    </div>  

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Ventana Modal </h3>
                </div>
            </div>                 
        </div>   
    </div>     

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">               
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('mod_titulo_ld', 'Título Modal') !!}                    
                    {!! Form::text('mod_titulo_ld', $ml_ld['mod_titulo_ld'] ? $ml_ld['mod_titulo_ld'] : null, ['class' => 'form-control', 'id' => 'mod_titulo_ld', 'placeholder' => 'Título Modal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mod_subtitulo_ld', 'Subtítulo Modal') !!}                    
                    {!! Form::text('mod_subtitulo_ld', $ml_ld['mod_subtitulo_ld'] ? $ml_ld['mod_subtitulo_ld'] : null, ['class' => 'form-control', 'id' => 'mod_subtitulo_ld', 'placeholder' => 'Subtítulo Modal']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('cam_devolver_ld', 'Devuelto en la fecha') !!}                    
                    {!! Form::text('cam_devolver_ld', $ml_ld['cam_devolver_ld'] ? $ml_ld['cam_devolver_ld'] : null, ['class' => 'form-control', 'id' => 'cam_devolver_ld', 'placeholder' => 'Devuelto en la fecha']) !!}
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
            </div>
            <div class="box-body">    
                <div class="form-group">              
                    {!! Form::label('btn_prestamo_ld', 'Botón préstamo') !!}                    
                    {!! Form::text('btn_prestamo_ld', $ml_ld['btn_prestamo_ld'] ? $ml_ld['btn_prestamo_ld'] : null, ['class' => 'form-control', 'id' => 'btn_prestamo_ld', 'placeholder' => 'Botón préstamo']) !!}
                </div>          
                <div class="form-group">              
                    {!! Form::label('btn_devolver_ld', 'Botón devolver') !!}                    
                    {!! Form::text('btn_devolver_ld', $ml_ld['btn_devolver_ld'] ? $ml_ld['btn_devolver_ld'] : null, ['class' => 'form-control', 'id' => 'btn_devolver_ld', 'placeholder' => 'Botón devolver']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_renovar_ld', 'Botón renovar') !!}                    
                    {!! Form::text('btn_renovar_ld', $ml_ld['btn_renovar_ld'] ? $ml_ld['btn_renovar_ld'] : null, ['class' => 'form-control', 'id' => 'btn_renovar_ld', 'placeholder' => 'Botón renovar']) !!}
                </div>
               
                <div class="form-group">              
                    {!! Form::label('btn_cerrar_ld', 'Botón cerrar') !!}                    
                    {!! Form::text('btn_cerrar_ld', $ml_ld['btn_cerrar_ld'] ? $ml_ld['btn_cerrar_ld'] : null, ['class' => 'form-control', 'id' => 'btn_cerrar_ld', 'placeholder' => 'Botón cerrar']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('btn_si_ld', 'Botón si') !!}                    
                    {!! Form::text('btn_si_ld', $ml_ld['btn_si_ld'] ? $ml_ld['btn_si_ld'] : null, ['class' => 'form-control', 'id' => 'btn_si_ld', 'placeholder' => 'Botón si']) !!}
                </div>                                                  
            </div>
        </div>       
    </div> 
   
{!! Form::close() !!}    
</div>


               
                


                      




  