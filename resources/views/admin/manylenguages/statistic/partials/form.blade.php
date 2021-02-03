<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_statistic', $idioma->id] : 'admin.manylenguages.store',   
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
    <!-- Estadisticas -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Estadísticas</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('estadistica', 'Estadísticas') !!}                    
                        {!! Form::text('estadistica', $ml_statistic['estadistica'] ? $ml_statistic['estadistica'] : null, ['class' => 'form-control', 'id' => 'estadistica', 'placeholder' => 'Estadísticas']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('mes_y_año', 'Mes y Año') !!}                    
                        {!! Form::text('mes_y_año', $ml_statistic['mes_y_año'] ? $ml_statistic['mes_y_año'] : null, ['class' => 'form-control', 'id' => 'mes_y_año', 'placeholder' => 'Mes y Año']) !!}
                    </div> 

                    <div class="form-group">              
                        {!! Form::label('ph_mes_y_año', 'Selecciona un Año') !!}                    
                        {!! Form::text('ph_mes_y_año', $ml_statistic['ph_mes_y_año'] ? $ml_statistic['ph_mes_y_año'] : null, ['class' => 'form-control', 'id' => 'ph_mes_y_año', 'placeholder' => 'Selecciona un Año']) !!}
                    </div> 

                    <div class="form-group">              
                        {!! Form::label('btn_buscar', 'Botón Buscar') !!}                    
                        {!! Form::text('btn_buscar', $ml_statistic['btn_buscar'] ? $ml_statistic['btn_buscar'] : null, ['class' => 'form-control', 'id' => 'btn_buscar', 'placeholder' => 'Botón Buscar']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('total', 'Total') !!}                    
                        {!! Form::text('total', $ml_statistic['total'] ? $ml_statistic['total'] : null, ['class' => 'form-control', 'id' => 'total', 'placeholder' => 'Total']) !!}
                    </div>                                      
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Tabla Socios </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('sub_socio', 'Socios') !!}                    
                    {!! Form::text('sub_socio', $ml_statistic['sub_socio'] ? $ml_statistic['sub_socio'] : null, ['class' => 'form-control', 'Socio' => 'sub_socio', 'placeholder' => 'Socios']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_tipodesocio', 'Tipo de socio') !!}                    
                    {!! Form::text('col_tipodesocio', $ml_statistic['col_tipodesocio'] ? $ml_statistic['col_tipodesocio'] : null, ['class' => 'form-control', 'id' => 'col_tipodesocio', 'placeholder' => 'Tipo de socio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_alta', 'Altas') !!}                    
                    {!! Form::text('col_alta', $ml_statistic['col_alta'] ? $ml_statistic['col_alta'] : null, ['class' => 'form-control', 'id' => 'col_alta', 'placeholder' => 'Altas']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_baja', 'Bajas') !!}                    
                    {!! Form::text('col_baja', $ml_statistic['col_baja'] ? $ml_statistic['col_baja'] : null, ['class' => 'form-control', 'id' => 'col_baja', 'placeholder' => 'Bajas']) !!}
                </div>                              
            </div>
        </div>       
    </div>      

    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Tabla Préstamos - Tabla Colecciones </h3>
                </div>
            </div>
            <div class="box-body">  
                <div class="text-center">
                    <h4 class="box-title">Préstamo</h4>
                </div>            
                <div class="form-group">              
                    {!! Form::label('sub_prestamo', 'Préstamos') !!}                    
                    {!! Form::text('sub_prestamo', $ml_statistic['sub_prestamo'] ? $ml_statistic['sub_prestamo'] : null, ['class' => 'form-control', 'id' => 'sub_prestamo', 'placeholder' => 'Préstamos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_prestamo', 'Préstamo') !!}                    
                    {!! Form::text('col_prestamo', $ml_statistic['col_prestamo'] ? $ml_statistic['col_prestamo'] : null, ['class' => 'form-control', 'id' => 'col_prestamo', 'placeholder' => 'Prestamo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_libro', 'Libro') !!}                    
                    {!! Form::text('col_libro', $ml_statistic['col_libro'] ? $ml_statistic['col_libro'] : null, ['class' => 'form-control', 'id' => 'col_libro', 'placeholder' => 'Libro']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('col_cine', 'Cine') !!}                    
                    {!! Form::text('col_cine', $ml_statistic['col_cine'] ? $ml_statistic['col_cine'] : null, ['class' => 'form-control', 'id' => 'col_cine', 'placeholder' => 'Cine']) !!}
                </div>     
                <div class="form-group">     
                    {!! Form::label('col_musica', 'Musica') !!}                    
                    {!! Form::text('col_musica', $ml_statistic['col_musica'] ? $ml_statistic['col_musica'] : null, ['class' => 'form-control', 'id' => 'col_musica', 'placeholder' => 'Musica']) !!}
                </div> 
                <div class="form-group">     
                    {!! Form::label('col_multimedia', 'Multimedia') !!}                    
                    {!! Form::text('col_multimedia', $ml_statistic['col_multimedia'] ? $ml_statistic['col_multimedia'] : null, ['class' => 'form-control', 'id' => 'col_multimedia', 'placeholder' => 'Multimedia']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_fotografia', 'Fotografia') !!}                    
                    {!! Form::text('col_fotografia', $ml_statistic['col_fotografia'] ? $ml_statistic['col_fotografia'] : null, ['class' => 'form-control', 'id' => 'col_fotografia', 'placeholder' => 'Fotografia']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('col_librodigital', 'Libro digital') !!}                    
                    {!! Form::text('col_librodigital', $ml_statistic['col_librodigital'] ? $ml_statistic['col_librodigital'] : null, ['class' => 'form-control', 'id' => 'col_librodigital', 'placeholder' => 'Libro digital']) !!}
                </div>    

                <div class="text-center">
                    <h4 class="box-title">Colección</h4>
                </div>

                <div class="form-group">              
                    {!! Form::label('sub_coleccion', 'Colecciones') !!}                    
                    {!! Form::text('sub_coleccion', $ml_statistic['sub_coleccion'] ? $ml_statistic['sub_coleccion'] : null, ['class' => 'form-control', 'id' => 'sub_coleccion', 'placeholder' => 'Colecciones']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('sub_coleccion', 'Colección') !!}                    
                    {!! Form::text('sub_coleccion', $ml_statistic['sub_coleccion'] ? $ml_statistic['sub_coleccion'] : null, ['class' => 'form-control', 'id' => 'sub_coleccion', 'placeholder' => 'Colección']) !!}
                </div>                                     
            </div>
        </div>       
    </div>   

    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Filas tablas Socios - Préstamos</h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('infantil', 'Infantil') !!}                    
                    {!! Form::text('infantil', $ml_statistic['infantil'] ? $ml_statistic['infantil'] : null, ['class' => 'form-control', 'id' => 'infantil', 'placeholder' => 'Infantil']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('adulto', 'Adulto') !!}                    
                    {!! Form::text('adulto', $ml_statistic['adulto'] ? $ml_statistic['adulto'] : null, ['class' => 'form-control', 'id' => 'adulto', 'placeholder' => 'Adulto']) !!}
                </div>                     
            </div>
        </div>       
    </div>          

     <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Filas tabla Incorporaciones</h3>
                </div>
            </div>
            <div class="box-body">    
                <div class="form-group">              
                    {!! Form::label('incorporacion', 'Incorporaciones') !!}                    
                    {!! Form::text('incorporacion', $ml_statistic['incorporacion'] ? $ml_statistic['incorporacion'] : null, ['class' => 'form-control', 'id' => 'incorporacion', 'placeholder' => 'Incorporaciones']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('baja', 'Dados de baja') !!}                    
                    {!! Form::text('baja', $ml_statistic['baja'] ? $ml_statistic['baja'] : null, ['class' => 'form-control', 'id' => 'baja', 'placeholder' => 'Dados de baja']) !!}
                </div>            
            </div>
        </div>       
    </div>                
{!! Form::close() !!}    
</div>


               
                


                      




  