<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       RECLAMAR PRESTAMOS ATRASADOS       
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Socios</li>
    </ol> 
@stop

@section('content')

<div class="row" id="form_reclamo">  
    {!! Form::open(['route' => 'admin.claimloans.store','method' => 'POST']) !!}   
    <!-- {{ csrf_field() }} -->
    <div class="col-md-2">
    </div>
    <div class="col-md-8">    
        <div class="box box-primary">  
            <div class="box-header with-border">
                <h3 class="box-title">Reclamos</h3>                
            </div>       
            <div class="box-body box-profile">            
            
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item"> 
                    {!! Form::label('model_types', 'Tipo de Modelo') !!}
                                {!! Form::select('model_types', $model_types, null, ['class' => 'form-control select2', 'id' => 'model_types']) !!}   
                    </li>
            
                    <li class="list-group-item"> 
                                <label>Hasta</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>                      
                                    <input name="hasta"
                                        class="form-control pull-right"                                                       
                                        value="{{ old('hasta', Carbon\Carbon::now()->format('d-m-Y')) }}"                            
                                        type="text"
                                        id="hasta"
                                        placeholder= "Selecciona una Fecha">                       
                    </li>

                    <li class="list-group-item"> 
                    <label>Enviar a: </label>
                    <select name="send_to" id="send_to" class="form-control select2"                           
                            data-placeholder="Seleccione a quien/quienes se enviara el reclamo" style="width: 100%;">
                            <option selected value="9999">Todos</option> 
                    </select>
                </li>
                    <li class="list-group-item"> 
                    {!! Form::label('informe', 'informe por mail para el bibliotecario ? ') !!}                    
                    {!! Form::checkbox('informe', '1')!!}
                    </li> 
                     <li class="list-group-item"> 
                    
                        <button type="submit" name="filter" id="send-mail" class="btn btn-info">Enviar Mails de Reclamo</button>
                     <!-- <button type="submit" class="btn btn-primary" id="send-mail">Prestar</button> -->
                </li>
                    

                </ul>               
            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
    {!! Form::close() !!}    
</div>
  
@stop

@include('admin.fastprocess.partials._modal')


@push('styles')
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">  
@endpush

@push('scripts') 
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>   
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script> 

            $('#model_types').select2({
                            placeholder: 'Seleccione un Modelo de Carta',
                            tags: false,               
                        });

                $('#hasta').datepicker({
                            autoclose: true,
                            todayHighlight: true,  
                            format: 'dd-mm-yyyy',                 
                            language: 'es'
                        });
                        
                        var date_select = $('#hasta');
                        date_select.on('change', function() {
                            var fecha = $(this).val();

                            console.log('Fecha: ' + fecha);
                            filtrarPrestamosVencidos(fecha);
                        
                        });

                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth() + 1;
                        var yyyy = today.getFullYear();
                        var fechaActual = dd +'-'+ mm +'-'+ yyyy;

                        filtrarPrestamosVencidos();
                        // console.log("qwe: " + fechaActual);
                        function filtrarPrestamosVencidos(fecha = fechaActual) {
                            $.ajax({                    
                                url: '/admin/claimloans/filtarPorFecha/' + fecha,
                                type: 'GET',
                                dataType: 'json',
                                success: function (response) {
                                    // acá podés loguear la respuesta del servidor
                                    console.log(response);
                                    // le pasás la data a la función que llena los otros inputs
                                    refrescarSelect(response)
                                },
                                error: function () { 
                                    // console.log(error);
                                    alert('Hubo un error obteniendo el detalle de la Compañía!');
                                }
                            })
                        }

                        function refrescarSelect(fecha) {    
                            
                            // console.log("select traido: " + fecha);
                            //Funcion para agregar opciones a un <select>.
                            //Funcion para agregar opciones a un <select>.
                            
                            $("#send_to").empty();
                            //Recorremos el array.
                            var select = document.getElementById("send_to");
                            
                            if(fecha.length > 0){
                                var ii = 0;
                                if(fecha.length == 1){
                                    var ii = 0;    
                                }else{
                                    var ii = 1;
                                    select.options[0] = new Option("Todos", 0);
                                }
                                for(var i=0;i<fecha.length;i++){
                                        select.options[ii] = new Option(fecha[i].user.nickname + ' - ' + fecha[i].copy.document.title, fecha[i].user.id);
                                        ii = ii + 1;
                                    }
                                    $("#send-mail").prop('disabled', false);
                            }else{
                                $("#send-mail").prop('disabled', true);
                                select.options[0] = new Option("Sin Resultados", -1);
                            }    
                        } 
    
    
$('#send-mail').click(function (event) {
    event.preventDefault();

    // $avatarInput = $('#rebeca');

    // var formData  = new FormData();        
    //     formData.append('rebeca', $avatarInput[0].files[0]);

    var form = $('#form_reclamo form'),
        url = form.attr('action'),
        method =  'POST' ;
        // method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

   

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
        // data : formData,
        cache: false,  
        processData: false,
        contentType: false,
        success: function (response) {
            var info = response.bandera;
            form.trigger('reset');
            $('#form_reclamo').modal('hide');
            swal({
                type : 'success',
                title : '¡Éxito!',
                text : '¡Se han enviado los mails correctamente!',
            }) 
            // .then(function() {
            //     // window.location = "../";
            //     window.location="/admin/loanmanual/";
            // }) 
            ;
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