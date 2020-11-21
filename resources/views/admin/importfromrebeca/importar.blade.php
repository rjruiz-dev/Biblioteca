<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       DOCUMENTOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Documentos</li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">     
    <div class="col-md-12">    
        <div class="box box-primary"> 
            <div class="box-header with-border">
                <h3 class="box-title">Documento</h3>                
            </div>       
            <div class="box-body box-profile" id="form_prestamo">   
                {!! Form::open(['route' => 'admin.importfromrebeca.store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group"><!-- documents V -->
                    {!! Form::label('document_types_id', 'Tipo de Documento') !!}
                    {!! Form::select('document_types_id', $types, null, ['class' => 'form-control select2', 'id' => 'document_types_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('rebeca', 'Archivo REBECA') !!}                    
                    {!! Form::file('rebeca') !!}
                </div> 
                <div class="modal-footer" id="modal-footer">                  
                    <button type="submit" class="btn btn-primary" id="modal-btn-save-importar">Importar</button>
                </div> 

                <div class="modal-footer" id="modal-footer">
                    <a href="{{ route('admin.importfromrebeca.index') }}"><i class="fa fa-user-plus"></i> Index Rebeca</a>     
                </div> 
                {!! Form::close() !!}                                 
            </div>
        </div>
    </div>
    
      
</div>  
@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')   
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/importar.js') }}"></script>  
    <script>
        
        $('#document_types_id').select2({
            placeholder: 'Seleccione un Modelo de Carta',
            tags: false,               
        });

    </script>
@endpush