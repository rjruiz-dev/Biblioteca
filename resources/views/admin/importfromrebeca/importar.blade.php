<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       IMPORTACION DE CATALOGOS REBECCA
        <!-- <small>Listado</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Documentos</li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">     
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};"> 
            <div class="box-header with-border">
                <h3 class="box-title">Documento</h3>                
            </div>       
            <div class="box-body box-profile" id="form_prestamo">   
                {!! Form::open(['route' => 'admin.importfromrebeca.store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                
                <div class="form-group">
                    {!! Form::label('rebeca', 'Archivo REBECA') !!}                    
                    {!! Form::file('rebeca') !!}
                </div> 
                <div class="modal-footer" id="modal-footer">                  
                    <button type="submit" class="btn btn-primary" id="modal-btn-save-importar">Importar</button>
                </div> 

                <!-- <div class="modal-footer" id="modal-footer">
                    <a href="{{ route('admin.importfromrebeca.index') }}"><i class="fa fa-user-plus"></i> Index Rebeca</a>     
                </div>  -->
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
        
        $('#modal-btn-save-importar').click(function (event) {
    event.preventDefault();

    var form = $('#form_prestamo form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    
    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (response) {
            var info = response.bandera;
            var info2 = response.id;
            var error = response.error;
            console.log("id" + info2);
            console.log("ALGO" + info);
            form.trigger('reset');
            // $('#modal').modal('hide');
            // $('#datatable').DataTable().ajax.reload(null, false);
    
            swal({
                type : 'success',
                title : '¡Éxito!',
                text : '¡Se ha procesado el archivo. Ahora podra ver lo que se proceso!',
            }).then(function() {
                window.location="/admin/importfromrebeca/";
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