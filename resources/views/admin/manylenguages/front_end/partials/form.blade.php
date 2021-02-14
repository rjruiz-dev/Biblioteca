<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_front_end', $idioma->id] : 'admin.manylenguages.store',   
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
                    <h3 class="box-title">Traducciones de Front-End</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div> -->
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('doc_mas_recientes', 'Titulo Docs mas Recientes') !!}                    
                        {!! Form::text('doc_mas_recientes', $front_end['doc_mas_recientes'] ? $front_end['doc_mas_recientes'] : null, ['class' => 'form-control', 'id' => 'doc_mas_recientes', 'placeholder' => 'Titulo Docs mas Recientes']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('recientes_cinco', '5 mas Recientes') !!}                    
                        {!! Form::text('recientes_cinco', $front_end['recientes_cinco'] ? $front_end['recientes_cinco'] : null, ['class' => 'form-control', 'id' => 'recientes_cinco', 'placeholder' => '5 mas Recientes']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('recientes_diez', '10 mas Recientes') !!}                    
                        {!! Form::text('recientes_diez', $front_end['recientes_diez'] ? $front_end['recientes_diez'] : null, ['class' => 'form-control', 'id' => 'recientes_diez', 'placeholder' => '10 mas Recientes']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('recientes_veinte', '20 mas Recientes') !!}                    
                        {!! Form::text('recientes_veinte', $front_end['recientes_veinte'] ? $front_end['recientes_veinte'] : null, ['class' => 'form-control', 'id' => 'recientes_veinte', 'placeholder' => '20 mas Recientes']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('recientes_cincuenta', '50 mas Recientes') !!}                    
                        {!! Form::text('recientes_cincuenta', $front_end['recientes_cincuenta'] ? $front_end['recientes_cincuenta'] : null, ['class' => 'form-control', 'id' => 'recientes_cincuenta', 'placeholder' => '50 mas Recientes']) !!}
                    </div>

                    <div class="form-group">              
                        {!! Form::label('doc_mas_reservados', 'Documentos mas Reservados') !!}                    
                        {!! Form::text('doc_mas_reservados', $front_end['doc_mas_reservados'] ? $front_end['doc_mas_reservados'] : null, ['class' => 'form-control', 'id' => 'doc_mas_reservados', 'placeholder' => 'Documentos mas Reservados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('reservados_cinco', '5 mas Reservados') !!}                    
                        {!! Form::text('reservados_cinco', $front_end['reservados_cinco'] ? $front_end['reservados_cinco'] : null, ['class' => 'form-control', 'id' => 'reservados_cinco', 'placeholder' => '5 mas Reservados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('reservados_diez', '10 mas Reservados') !!}                    
                        {!! Form::text('reservados_diez', $front_end['reservados_diez'] ? $front_end['reservados_diez'] : null, ['class' => 'form-control', 'id' => 'reservados_diez', 'placeholder' => '10 mas Reservados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('reservados_veinte', '20 mas Reservados') !!}                    
                        {!! Form::text('reservados_veinte', $front_end['reservados_veinte'] ? $front_end['reservados_veinte'] : null, ['class' => 'form-control', 'id' => 'reservados_veinte', 'placeholder' => '20 mas Reservados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('reservados_cincuenta', '50 mas Reservados') !!}                    
                        {!! Form::text('reservados_cincuenta', $front_end['reservados_cincuenta'] ? $front_end['reservados_cincuenta'] : null, ['class' => 'form-control', 'id' => 'reservados_cincuenta', 'placeholder' => '50 mas Reservados']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('mas_info', 'Boton Mas Informacion') !!}                    
                        {!! Form::text('mas_info', $front_end['mas_info'] ? $front_end['mas_info'] : null, ['class' => 'form-control', 'id' => 'mas_info', 'placeholder' => 'Boton Mas Informacion']) !!}
                    </div>
                                                       
                </div>
            </div>       
        </div>   
    </div>     
         
    </div> 
{!! Form::close() !!}    
</div>





  