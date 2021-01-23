<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_library_profile', $idioma->id] : 'admin.manylenguages.store',   
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
                    <h3 class="box-title">Traducciones Globales Perfil de la Biblioteca</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Título </h3>
                </div>
            </div>
            <div class="box-body">               
                <div class="form-group">              
                    {!! Form::label('titulo', 'Perfil de la Biblioteca') !!}                    
                    {!! Form::text('titulo', $ml_library['titulo'] ? $ml_library['titulo'] : null, ['class' => 'form-control', 'id' => 'titulo', 'placeholder' => 'Perfil de la Biblioteca']) !!}
                </div>                    
            </div>       
        </div>   
    </div>  


    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Logo </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">              
                    {!! Form::label('logo', 'Logo') !!}                    
                    {!! Form::text('logo', $ml_library['logo'] ? $ml_library['logo'] : null, ['class' => 'form-control', 'id' => 'logo', 'placeholder' => 'Logo']) !!}
                </div>                   
            </div>       
        </div>   
    </div>  
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                     <h3 class="box-title">Sección Perfil </h3>
                </div>
            </div>
            <div class="box-body">                  
                <div class="form-group">              
                    {!! Form::label('perfil', 'Perfil') !!}                    
                    {!! Form::text('perfil', $ml_library['perfil'] ? $ml_library['perfil'] : null, ['class' => 'form-control', 'id' => 'perfil', 'placeholder' => 'Perfil']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('biblioteca', 'Biblioteca') !!}                    
                    {!! Form::text('biblioteca', $ml_library['biblioteca'] ? $ml_library['biblioteca'] : null, ['class' => 'form-control', 'id' => 'biblioteca', 'placeholder' => 'Biblioteca']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('telefono', 'Teléfono') !!}                    
                    {!! Form::text('telefono', $ml_library['telefono'] ? $ml_library['telefono'] : null, ['class' => 'form-control', 'id' => 'telefono', 'placeholder' => 'Teléfono']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('email', 'Email') !!}                    
                    {!! Form::text('email', $ml_library['email'] ? $ml_library['email'] : null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('idioma', 'Idioma') !!}                    
                    {!! Form::text('idioma', $ml_library['idioma'] ? $ml_library['idioma'] : null, ['class' => 'form-control', 'id' => 'idioma', 'placeholder' => 'Idioma']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('select_logo', 'Selecciona logo') !!}                    
                    {!! Form::text('select_logo', $ml_library['select_logo'] ? $ml_library['select_logo'] : null, ['class' => 'form-control', 'id' => 'select_logo', 'placeholder' => 'Selecciona logo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('medidas_logo', 'Medidas Logo') !!}                    
                    {!! Form::text('medidas_logo', $ml_library['medidas_logo'] ? $ml_library['medidas_logo'] : null, ['class' => 'form-control', 'id' => 'medidas_logo', 'placeholder' => 'Medidas Logo']) !!}
                </div>                                      
            </div>       
        </div>   
    </div>  
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Dirección </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('direccion', 'Dirección') !!}                    
                    {!! Form::text('direccion', $ml_library['direccion'] ? $ml_library['direccion'] : null, ['class' => 'form-control', 'Socio' => 'direccion', 'placeholder' => 'Dirección']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('calle', 'Calle') !!}                    
                    {!! Form::text('calle', $ml_library['calle'] ? $ml_library['calle'] : null, ['class' => 'form-control', 'id' => 'calle', 'placeholder' => 'Calle']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('codigo_postal', 'Código postal') !!}                    
                    {!! Form::text('codigo_postal', $ml_library['codigo_postal'] ? $ml_library['codigo_postal'] : null, ['class' => 'form-control', 'id' => 'codigo_postal', 'placeholder' => 'Código postal']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ciudad', 'Ciudad') !!}                    
                    {!! Form::text('ciudad', $ml_library['ciudad'] ? $ml_library['ciudad'] : null, ['class' => 'form-control', 'id' => 'ciudad', 'placeholder' => 'Ciudad']) !!}
                </div>          
                <div class="form-group">              
                    {!! Form::label('provincia', 'Provincia') !!}                    
                    {!! Form::text('provincia', $ml_library['provincia'] ? $ml_library['provincia'] : null, ['class' => 'form-control', 'id' => 'provincia', 'placeholder' => 'Provincia']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('pais', 'País') !!}                    
                    {!! Form::text('pais', $ml_library['pais'] ? $ml_library['pais'] : null, ['class' => 'form-control', 'id' => 'pais', 'placeholder' => 'País']) !!}
                </div>                              
            </div>
        </div>       
    </div> 
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Configuración de Prestamos </h3>
                </div>
            </div>
            <div class="box-body">                
                <div class="form-group">              
                    {!! Form::label('config_prestamo', 'Configuración de prestamos') !!}                    
                    {!! Form::text('config_prestamo', $ml_library['config_prestamo'] ? $ml_library['config_prestamo'] : null, ['class' => 'form-control', 'id' => 'config_prestamo', 'placeholder' => 'Configuración de prestamos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cant_max_prestamo', 'Cantidad maxima de prestamo') !!}                    
                    {!! Form::text('cant_max_prestamo', $ml_library['cant_max_prestamo'] ? $ml_library['cant_max_prestamo'] : null, ['class' => 'form-control', 'id' => 'cant_max_prestamo', 'placeholder' => 'Cantidad maxima de prestamo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cant_max_dias', 'Cantidad maxima de días por ejemplar') !!}                    
                    {!! Form::text('cant_max_dias', $ml_library['cant_max_dias'] ? $ml_library['cant_max_dias'] : null, ['class' => 'form-control', 'id' => 'cant_max_dias', 'placeholder' => 'Cantidad maxima de días por ejemplar']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('tipo_multa', 'Tipo de multa') !!}                    
                    {!! Form::text('tipo_multa', $ml_library['tipo_multa'] ? $ml_library['tipo_multa'] : null, ['class' => 'form-control', 'id' => 'tipo_multa', 'placeholder' => 'Tipo de multa']) !!}
                </div>      
                <div class="form-group">     
                    {!! Form::label('economica', 'Económica') !!}                    
                    {!! Form::text('economica', $ml_library['economica'] ? $ml_library['economica'] : null, ['class' => 'form-control', 'id' => 'economica', 'placeholder' => 'Económica']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('sancion', 'Sanción') !!}                    
                    {!! Form::text('sancion', $ml_library['sancion'] ? $ml_library['sancion'] : null, ['class' => 'form-control', 'id' => 'sancion', 'placeholder' => 'Sanción']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('sancion_economica', 'Valor de sanción económica') !!}                    
                    {!! Form::text('sancion_economica', $ml_library['sancion_economica'] ? $ml_library['sancion_economica'] : null, ['class' => 'form-control', 'id' => 'sancion_economica', 'placeholder' => 'Valor de sanción económica']) !!}
                </div>  
                <div class="form-group">              
                    {!! Form::label('dias_sancion', 'Días de sanción por restraso') !!}                    
                    {!! Form::text('dias_sancion', $ml_library['dias_sancion'] ? $ml_library['dias_sancion'] : null, ['class' => 'form-control', 'id' => 'dias_sancion', 'placeholder' => 'Días de sanción por restraso']) !!}
                </div> 
            </div>
        </div>       
    </div>  

    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Sección Otros Detalles</h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('otros_detalles', 'Otros detalles') !!}                    
                    {!! Form::text('otros_detalles', $ml_library['otros_detalles'] ? $ml_library['otros_detalles'] : null, ['class' => 'form-control', 'id' => 'otros_detalles', 'placeholder' => 'Otros detalles']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('edad_infantil', 'Edad mínima infantil') !!}                    
                    {!! Form::text('edad_infantil', $ml_library['edad_infantil'] ? $ml_library['edad_infantil'] : null, ['class' => 'form-control', 'id' => 'edad_infantil', 'placeholder' => 'Edad mínima infantil']) !!}
                </div>  

                <div class="form-group">              
                    {!! Form::label('edad_adulto', 'Edad mínima adulto') !!}                    
                    {!! Form::text('edad_adulto', $ml_library['edad_adulto'] ? $ml_library['edad_adulto'] : null, ['class' => 'form-control', 'id' => 'edad_adulto', 'placeholder' => 'Edad mínima adulto']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('select_color', 'Seleccionar color') !!}                    
                    {!! Form::text('select_color', $ml_library['select_color'] ? $ml_library['select_color'] : null, ['class' => 'form-control', 'id' => 'select_color', 'placeholder' => 'Seleccionar color']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('info_color', 'Seleccionar color para cambiar estilo de biblioteca') !!}                    
                    {!! Form::text('info_color', $ml_library['info_color'] ? $ml_library['info_color'] : null, ['class' => 'form-control', 'id' => 'info_color', 'placeholder' => 'Seleccionar color para cambiar estilo de biblioteca']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('select_color_fuente', 'Seleccionar color de fuente') !!}                    
                    {!! Form::text('select_color_fuente', $ml_library['select_color_fuente'] ? $ml_library['select_color_fuente'] : null, ['class' => 'form-control', 'id' => 'select_color_fuente', 'placeholder' => 'Seleccionar color de fuente']) !!}
                </div>                                     
                <div class="form-group">              
                    {!! Form::label('info_color_fuente', 'Seleccionar color de fuente para cambiar estilo del footer') !!}                    
                    {!! Form::text('info_color_fuente', $ml_library['info_color_fuente'] ? $ml_library['info_color_fuente'] : null, ['class' => 'form-control', 'id' => 'info_color_fuente', 'placeholder' => 'Seleccionar color de fuente para cambiar estilo del footer']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('btn_guardar', 'Botón guardar') !!}                    
                    {!! Form::text('btn_guardar', $ml_library['btn_guardar'] ? $ml_library['btn_guardar'] : null, ['class' => 'form-control', 'id' => 'btn_guardar', 'placeholder' => 'Botón guardar']) !!}
                </div> 
            </div>
        </div>       
    </div> 


{!! Form::close() !!}    
</div>


               
                


                      




  