@extends('layouts.app')

@section('header')    
    <h1>{{ $ml_library['titulo'] }}</h1>
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
            <div class="box box-primary" style="border-color: {{ $setting->skin }};">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $ml_library['logo'] }}</h3>  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>              
                </div>
                <div class="box-body box-profile" id="logo-img">
                    <div class="text-center" style="height:320px;">      
                        <img class="img-responsive img-thumbnail"
                            src="/images/{{ $setting->logo }}" 
                            alt="{{ $setting->library_name }}"                           
                            style="width:300px;">              
                    </div>              
                
                    <h3 class="profile-username text-center"><strong>{{ $setting->library_name }}</strong></h3>  
            
                    <p class="text-muted text-center">{{ $setting->library_email }}</p>
                </div>         
            </div> 
        </div> 
        <div class="col-md-6">
            <div class="box box-primary" style="border-color: {{ $setting->skin }};">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $ml_library['perfil'] }}</h3>  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>              
                </div>
                <div class="box-body">
                    <div class="form-group">              
                        {!! Form::label('library_name', $ml_library['biblioteca'] ) !!}                    
                        {!! Form::text('library_name', null, ['class' => 'form-control', 'id' => 'library_name', 'placeholder' => $ml_library['biblioteca']]) !!}
                    </div> 
                    <div class="form-group">
                        {!! Form::label('library_phone', $ml_library['telefono']) !!}               
                        {!! Form::text('library_phone', null, ['class' => 'form-control', 'id' => 'library_phone',  'placeholder' => $ml_library['telefono']]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('library_email', $ml_library['email']) !!}             
                        {!! Form::text('library_email', null, ['class' => 'form-control', 'id' => 'library_email', 'placeholder' => $ml_library['email']]) !!}
                    </div>  
                    <div class="form-group">
                        {!! Form::label('language', $ml_library['idioma']) !!}             
                        {!! Form::text('language', null, ['class' => 'form-control', 'id' => 'language', 'placeholder' => $ml_library['idioma']]) !!}
                    </div>  
                    <div class="form-group">
                        {{ Form::label('logo', $ml_library['select_logo']) }}
                        {{ Form::file('logo') }}
                    </div>             
                    <span class="help-block"><b>{{ $ml_library['medidas_logo'] }}</b></span>   
                </div>
            </div>         
        </div>   
    </div>  
    <div class="row"> 
        <div class="col-md-4">
            <div class="box box-primary" style="border-color: {{ $setting->skin }};">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $ml_library['direccion'] }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div> 
                </div>
                <div class="box-body">  
                    <div class="form-group">              
                        {!! Form::label('street', $ml_library['calle']) !!}                    
                        {!! Form::text('street', null, ['class' => 'form-control', 'id' => 'street', 'placeholder' => $ml_library['calle'] ]) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('postal_code', $ml_library['codigo_postal']) !!}                    
                        {!! Form::text('postal_code', null, ['class' => 'form-control', 'id' => 'postal_code', 'placeholder' => $ml_library['codigo_postal']]) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('city', $ml_library['ciudad']) !!}                    
                        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => $ml_library['ciudad']]) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('province', $ml_library['provincia']) !!}                    
                        {!! Form::text('province', null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => $ml_library['provincia']]) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('country', $ml_library['pais']) !!}                    
                        {!! Form::text('country', null, ['class' => 'form-control', 'id' => 'country', 'placeholder' => $ml_library['pais']]) !!}
                    </div> 
                </div>
            </div>       
        </div>
        <div class="col-md-4">
            <div class="box box-primary" style="border-color: {{ $setting->skin }};">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $ml_library['config_prestamo'] }}</h3>          
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>       
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('loan_limit', $ml_library['cant_max_prestamo']) !!}                
                        {!! Form::text('loan_limit', null, ['class' => 'form-control', 'id' => 'loan_limit', 'placeholder' => $ml_library['cant_max_prestamo']]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('loan_day', $ml_library['cant_max_dias']) !!}               
                        {!! Form::text('loan_day', null, ['class' => 'form-control', 'id' => 'loan_day', 'placeholder' => $ml_library['cant_max_dias']]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('group', $ml_library['tipo_multa']) !!}&nbsp;
                        <label>
                            &nbsp;{!! Form::radio('group', '1', $setting->fines_id == 1 ? 'checked' : '', ['id' => 'group_economica']) !!}&nbsp;{{ $ml_library['economica'] }}                                
                        </label>
                        <label>
                            &nbsp;{!! Form::radio('group', '2', $setting->fines_id == 2 ? 'checked' : '', ['id' => 'group_sancion']) !!}&nbsp;{{ $ml_library['sancion'] }}                                   
                        </label>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('price_penalty', $ml_library['sancion_economica']) !!}                
                        {!! Form::text('price_penalty', $multa_economica['unit'] ? $multa_economica['unit'] : null, ['class' => 'form-control', 'id' => 'price_penalty', 'placeholder' => $ml_library['sancion_economica'] ]) !!}
                    </div>  

                    <div class="form-group">
                        {!! Form::label('days_penalty', $ml_library['dias_sancion']) !!}                
                        {!! Form::text('days_penalty', $multa_suspension['unit'] ? $multa_suspension['unit'] : null, ['class' => 'form-control', 'id' => 'days_penalty', 'placeholder' => $ml_library['dias_sancion'] ]) !!}
                    </div> 
                    @if( (Auth::user() != null) && (Auth::user()->getRoleNames() == 'Admin') )

                    <div class="form-group">
                    {!! Form::select('id_plan', $planes_listado, null, ['class' => 'form-control select2', 'id' => 'id_plan']) !!}   
                    </div>  
                    @endif           
                </div>
            </div>       
        </div>  
        <div class="col-md-4">
            <div class="box box-primary" style="border-color: {{ $setting->skin }};">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $ml_library['otros_detalles'] }}</h3>  
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>              
                </div>
                <div class="box-body">
                    <div class="form-group">              
                        {!! Form::label('child_age', $ml_library['edad_infantil']) !!}                    
                        {!! Form::text('child_age', null, ['class' => 'form-control', 'id' => 'child_age', 'placeholder' => $ml_library['edad_infantil']]) !!}
                    </div> 
                    <div class="form-group">
                        {!! Form::label('adult_age', $ml_library['edad_adulto']) !!}               
                        {!! Form::text('adult_age', null, ['class' => 'form-control', 'id' => 'adult_age',  'placeholder' => $ml_library['edad_adulto']]) !!}
                    </div>  
                    {!! Form::label('skin', $ml_library['select_color']) !!}   
                    <div id="skin" class="input-group colorpicker colorpicker-component"> 
                        <input type="text" value="{{ $setting->skin }}" name="skin" id="skin" class="form-control" /> 
                        <span class="input-group-addon"><i></i></span>
                    </div> 
                    <span class="help-block">{{$ml_library['info_color']}} </span> 
                    {!! Form::label('skin_footer', $ml_library['select_color_fuente'] ) !!}   
                    <div id="skin_footer" class="input-group colorpicker colorpicker-component"> 
                        <input type="text" value="{{ $setting->skin_footer }}" name="skin_footer" id="skin_footer" class="form-control" /> 
                        <span class="input-group-addon"><i></i></span>
                    </div> 
                    <span class="help-block">{{$ml_library['info_color_fuente']}} </span>   
                </div>          
            </div>      
        </div> 
    </div>   
    <div class="row">
        <div class="col-md-12"> 
            <div class="box-footer">         
            
                <button type="submit" class="btn btn-info pull-right" id="btn-save">{{ $ml_library['btn_guardar'] }}</button>
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
            
            var swal_exito_set = response.swal_exito_set;
            var swal_info_exito_set = response.swal_info_exito_set;

            swal({
                type : 'success',
                title: swal_exito_set,
                text: swal_info_exito_set
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