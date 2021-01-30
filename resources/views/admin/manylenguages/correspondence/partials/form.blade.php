<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_send_letter', $idioma->id] : 'admin.manylenguages.store',   
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
    <!-- Enviar reclamo-->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Enviar Reclamo</h3>
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
                        {!! Form::label('titulo', 'Título Principal') !!}                    
                        {!! Form::text('titulo', $ml_sl['titulo'] ? $ml_sl['titulo'] : null, ['class' => 'form-control', 'id' => 'titulo', 'placeholder' => 'Título Principal']) !!}
                    </div>                      
                </div>
            </div>       
        </div>   
    </div>    
   
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                     <h3 class="box-title">Sección Reclamo </h3>
                </div>
            </div>
            <div class="box-body">                  
                <div class="form-group">              
                        {!! Form::label('subtitulo', 'Subtítulo') !!}                    
                        {!! Form::text('subtitulo', $ml_sl['subtitulo'] ? $ml_sl['subtitulo'] : null, ['class' => 'form-control', 'id' => 'subtitulo', 'placeholder' => 'Subtítulo']) !!}
                    </div>                                          
                <div class="form-group">              
                    {!! Form::label('select_modelo', 'Tipo de Modelo') !!}                    
                    {!! Form::text('select_modelo', $ml_sl['select_modelo'] ? $ml_sl['select_modelo'] : null, ['class' => 'form-control', 'id' => 'select_modelo', 'placeholder' => 'Tipo de Modelo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_modelo', 'Placeholder modelo de carta') !!}                    
                    {!! Form::text('ph_modelo', $ml_sl['ph_modelo'] ? $ml_sl['ph_modelo'] : null, ['class' => 'form-control', 'id' => 'ph_modelo', 'placeholder' => 'Placeholder modelo de carta']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('fecha', 'Fecha hasta') !!}                    
                    {!! Form::text('fecha', $ml_sl['fecha'] ? $ml_sl['fecha'] : null, ['class' => 'form-control', 'id' => 'fecha', 'placeholder' => 'Fecha hasta']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('select_enviar', 'Enviar a') !!}                    
                    {!! Form::text('select_enviar', $ml_sl['select_enviar'] ? $ml_sl['select_enviar'] : null, ['class' => 'form-control', 'id' => 'select_enviar', 'placeholder' => 'Enviar a']) !!}
                </div>    
                <div class="form-group">              
                    {!! Form::label('ph_enviar', 'Placeholder enviar a') !!}                    
                    {!! Form::text('ph_enviar', $ml_sl['ph_enviar'] ? $ml_sl['ph_enviar'] : null, ['class' => 'form-control', 'id' => 'ph_enviar', 'placeholder' => 'Placeholder enviar a']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('check_informe', 'Informe por email') !!}                    
                    {!! Form::text('check_informe', $ml_sl['check_informe'] ? $ml_sl['check_informe'] : null, ['class' => 'form-control', 'id' => 'check_informe', 'placeholder' => 'Enviar informe']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('btn_email', 'Enviar informe') !!}                    
                    {!! Form::text('btn_email', $ml_sl['btn_email'] ? $ml_sl['btn_email'] : null, ['class' => 'form-control', 'id' => 'btn_email', 'placeholder' => 'Informe por email']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('mensaje_exito', 'Mensaje de Exito') !!}                    
                    {!! Form::text('mensaje_exito', $ml_sl['mensaje_exito'] ? $ml_sl['mensaje_exito'] : null, ['class' => 'form-control', 'id' => 'mensaje_exito', 'placeholder' => 'Mensaje de Exito']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('noti_envio_mails', 'Mensaje de Envio Mail') !!}                    
                    {!! Form::text('noti_envio_mails', $ml_sl['noti_envio_mails'] ? $ml_sl['noti_envio_mails'] : null, ['class' => 'form-control', 'id' => 'noti_envio_mails', 'placeholder' => 'Mensaje de Envio Mail']) !!}
                </div>                                     
            </div>       
        </div>   
    </div>  
   
{!! Form::close() !!}    
</div>


               
                


                      




  