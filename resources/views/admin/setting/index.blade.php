@extends('layouts.app')

@section('header')    
    <h1>Perfil de la Biblioteca</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>       
    </ol> 
@stop

@section('content')
<div class="row" id="setting-form">
    {!! Form::model ($setting, ['route' => ['admin.setting.update', $setting->id],'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}   
    {{ csrf_field() }}
    <di></div>   
    <div class="row"> 
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Logo</h3>  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>              
                </div>
                <div class="box-body box-profile" id="logo-img">
                    <div class="text-center">      
                        <img class="img-responsive img-thumbnail"
                            src="/images/{{ $setting->logo }}" 
                            alt="{{ $setting->library_name }}"                           
                            style="width:300px; height:300px">              
                    </div>              
                
                    <h3 class="profile-username text-center"><strong>{{ $setting->library_name }}</strong></h3>  
            
                    <p class="text-muted text-center">{{ $setting->library_email }}</p>
                </div>         
            </div> 
        </div> 
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Perfil</h3>  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>              
                </div>
                <div class="box-body">
                    <div class="form-group">              
                        {!! Form::label('library_name', 'Biblioteca') !!}                    
                        {!! Form::text('library_name', null, ['class' => 'form-control', 'id' => 'library_name', 'placeholder' => 'Nombre de la Biblioteca']) !!}
                    </div> 
                    <div class="form-group">
                        {!! Form::label('library_phone', 'Teléfono') !!}               
                        {!! Form::text('library_phone', null, ['class' => 'form-control', 'id' => 'library_phone',  'placeholder' => 'Teléfono de la Biblioteca']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('library_email', 'Email') !!}             
                        {!! Form::text('library_email', null, ['class' => 'form-control', 'id' => 'library_email', 'placeholder' => 'Email de la Biblioteca']) !!}
                    </div>  
                    <div class="form-group">
                        {!! Form::label('language', 'Idioma') !!}             
                        {!! Form::text('language', null, ['class' => 'form-control', 'id' => 'language', 'placeholder' => 'Idioma de la Biblioteca']) !!}
                    </div>  
                    <div class="form-group">
                        {{ Form::label('logo', 'Logo') }}
                        {{ Form::file('logo') }}
                    </div>             
                    <span class="help-block"><b>Medidas del Logo 80px por 80px</b></span>   
                </div>
            </div>         
        </div>   
    </div>  
    <div class="row"> 
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dirección</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div> 
                </div>
                <div class="box-body">  
                    <div class="form-group">              
                        {!! Form::label('street', 'Calle') !!}                    
                        {!! Form::text('street', null, ['class' => 'form-control', 'id' => 'street', 'placeholder' => 'Calle y Número']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('postal_code', 'Código Postal') !!}                    
                        {!! Form::text('postal_code', null, ['class' => 'form-control', 'id' => 'postal_code', 'placeholder' => 'Código Postal']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('city', 'Ciudad') !!}                    
                        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Ciudad']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('province', 'Provincia') !!}                    
                        {!! Form::text('province', null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => 'Región/Provincia']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('country', 'País') !!}                    
                        {!! Form::text('country', null, ['class' => 'form-control', 'id' => 'country', 'placeholder' => 'País']) !!}
                    </div> 
                </div>
            </div>       
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuración de Prestamos</h3>          
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>       
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('loan_limit', 'Cantidad Maxima de Prestamos') !!}                
                        {!! Form::text('loan_limit', null, ['class' => 'form-control', 'id' => 'loan_limit', 'placeholder' => 'Cantidad Maxima de Prestamos']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('loan_day', 'Cantidad Maxima de Dias por Ejemplar') !!}               
                        {!! Form::text('loan_day', null, ['class' => 'form-control', 'id' => 'loan_day', 'placeholder' => 'Cantidad Maxima de Dias por Ejemplar']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('group', 'Tipo de Multa') !!}&nbsp;
                        <label>
                            &nbsp;{!! Form::radio('group', '1', $setting->fines_id == 1 ? 'checked' : '', ['id' => 'group_economica']) !!}&nbsp;Económica                                
                        </label>
                        <label>
                            &nbsp;{!! Form::radio('group', '2', $setting->fines_id == 2 ? 'checked' : '', ['id' => 'group_sancion']) !!}&nbsp;Sanción                                   
                        </label>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('price_penalty', 'Valor de Sanción Económica') !!}                
                        {!! Form::text('price_penalty', $multa_economica['unit'] ? $multa_economica['unit'] : null, ['class' => 'form-control', 'id' => 'price_penalty', 'placeholder' => 'Valor de sanción económica']) !!}
                    </div>  

                    <div class="form-group">
                        {!! Form::label('days_penalty', 'Dias de Sanción por Retraso') !!}                
                        {!! Form::text('days_penalty', $multa_suspension['unit'] ? $multa_suspension['unit'] : null, ['class' => 'form-control', 'id' => 'days_penalty', 'placeholder' => 'Dias de sanción por restraso']) !!}
                    </div>                  
                </div>
            </div>       
        </div>  
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Otros Detalles</h3>  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>              
                </div>
                <div class="box-body">
                    <div class="form-group">              
                        {!! Form::label('child_age', 'Edad Minima Infantil') !!}                    
                        {!! Form::text('child_age', null, ['class' => 'form-control', 'id' => 'child_age', 'placeholder' => 'Edad Minima Infantil']) !!}
                    </div> 
                    <div class="form-group">
                        {!! Form::label('adult_age', 'Edad Minima Adulto') !!}               
                        {!! Form::text('adult_age', null, ['class' => 'form-control', 'id' => 'adult_age',  'placeholder' => 'Edad Minima Adulto']) !!}
                    </div>  
                    {!! Form::label('skin', 'Seleccionar Color') !!}   
                    <div id="skin" class="input-group colorpicker colorpicker-component"> 
                        <input type="text" value="{{ $setting->skin }}" name="skin" id="skin" class="form-control" /> 
                        <span class="input-group-addon"><i></i></span>
                    </div> 
                    <span class="help-block">Seleccionar Color para Cambiar estilo de Biblioteca</span> 
                    {!! Form::label('skin_footer', 'Seleccionar Color de Fuente') !!}   
                    <div id="skin_footer" class="input-group colorpicker colorpicker-component"> 
                        <input type="text" value="{{ $setting->skin_footer }}" name="skin_footer" id="skin_footer" class="form-control" /> 
                        <span class="input-group-addon"><i></i></span>
                    </div> 
                    <span class="help-block">Seleccionar Color de Fuente para Cambiar estilo del Footer</span>   
                </div>          
            </div>      
        </div> 
    </div>   
    <div class="row">
        <div class="col-md-12"> 
            <div class="box-footer">         
            
                <button type="submit" class="btn btn-info pull-right" id="btn-save">Guardar Cambios</button>
            </div>  
        </div> 
    </div> 
    {!! Form::close() !!}    
</div>
@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
@endpush

@push('scripts')  
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script>  
    <!-- <script src="{{ asset('js/setting.js') }}"></script> -->

    <script>
$('.colorpicker').colorpicker({});



 

    var checkbox_economica = document.getElementById('group_economica');
    checkbox_economica.addEventListener( 'change', function() {
        if(this.checked) {
        // alert('checkbox economica ha sido  seleccionado');
        document.getElementById("days_penalty").disabled = true;
        document.getElementById("price_penalty").disabled = false;
        }
    });

    var isChecked_economica = document.getElementById('group_economica').checked;
    if(isChecked_economica){
    // alert('checkbox economica ya estaba seleccionado');
    document.getElementById("days_penalty").disabled = true;
    document.getElementById("price_penalty").disabled = false;
        
    }

    var checkbox_sancion = document.getElementById('group_sancion');
    checkbox_sancion.addEventListener( 'change', function() {
        if(this.checked) {
        // alert('checkbox sancion ha sido  seleccionado');
        document.getElementById("days_penalty").disabled = false;
        document.getElementById("price_penalty").disabled = true;
        }
    });
    
    var isChecked_sancion = document.getElementById('group_sancion').checked;
    if(isChecked_sancion){
    // alert('checkbox sancion ya estaba seleccionado');
        document.getElementById("days_penalty").disabled = false;
        document.getElementById("price_penalty").disabled = true;
    }



$('#btn-save').click(function (event) {
    event.preventDefault();
    

    $avatarInput = $('#logo');

    var formData  = new FormData();        
        formData.append('logo', $avatarInput[0].files[0]);
        
    var form = $('#setting-form form'), 
        url = form.attr('action'),
        method =  'POST' ;
      

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    
    $.ajax({
        url : url + '?' + form.serialize(),
        method: method,
        data : formData, 
        cache: false,  
        processData: false,
        contentType: false,
        success: function (response) {                    
            $("#logo-img").load(" #logo-img"); 
            swal({
                type : 'success',
                title : '¡Éxito!',
                text : '¡Se han guardado los datos!'
            }).then(function() {
                window.location.reload(); 
            });
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
});
    </script>
@endpush