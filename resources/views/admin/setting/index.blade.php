@extends('layouts.app')

@section('header')    
    <h1>Perfil de la Biblioteca</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>       
    </ol> 
@stop

@section('content')
<div class="row">  
    
    {{ csrf_field() }}
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Perfil</h3>                
            </div>
            <div class="box-body">
               

                <div class="form-group">              
                    {!! Form::label('membership', 'Número de Socio') !!}                    
                    {!! Form::text('membership', null, ['class' => 'form-control', 'id' => 'membership', 'placeholder' => 'Número de Socio']) !!}
                </div>      
                                
                <div class="form-group">              
                    {!! Form::label('nickname', 'Nickname') !!}                    
                    {!! Form::text('nickname', null, ['class' => 'form-control', 'id' => 'nickname', 'placeholder' => 'Nickname']) !!}
                </div>                                           
               
                <div class="form-group">
                    {{ Form::label('user_photo', 'Imagen de Perfil') }}
                    {{ Form::file('user_photo') }}
                    
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}             
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                </div>
                <span class="help-block">La contraseña será generada y enviada al nuevo usuario vía email</span>
         
            </div>
        </div>       
    </div>     
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos personales</h3>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('name', 'Nombres') !!}                    
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombres']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('surname', 'Apellidos') !!}                    
                    {!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'placeholder' => 'Apellidos']) !!}
                </div> 
             
                      
               

               
                           
                         
            </div>
        </div>       
    </div>
    
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('phone', 'Teléfono') !!}               
                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone',  'placeholder' => 'Teléfono']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Dirección') !!}                
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'Dirección', 'placeholder' => 'Dirección']) !!}
                </div>  
                <div class="form-group">
                    {!! Form::label('postcode', 'Código Postal') !!}                
                    {!! Form::text('postcode', null, ['class' => 'form-control', 'id' => 'Código Postal', 'placeholder' => 'Código Postal']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city', 'Ciudad') !!}               
                    {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Ciudad']) !!}
                </div> 
                   
            </div>
        </div>       
    </div>      

    {!! Form::close() !!}    
</div>
@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">   
@endpush

@push('scripts')  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script> 
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/user.js') }}"></script>
    
   
@endpush