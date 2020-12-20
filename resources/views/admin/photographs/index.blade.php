<?php
use App\Photography;
?>

@extends('layouts.app')

@section('header')    
    <h1>
       CATÁLOGO DE FOTOGRAFIAS
       {{ Form::hidden('idd', $idd, ['id' => 'idd']) }}
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <!-- <li class="active">Catálogo</li>
         -->
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
        <div class="row">           
            <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::select('references', $references, null, ['class' => 'form-control select2', 'id' => 'references', 'placeholder' => 'Elija Referencia', 'style' => 'width:100%;']) !!}   
            </div>
            <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::select('subjects', $subjects, null, ['class' => 'form-control select2', 'id' => 'subjects', 'placeholder' => 'Elija Materia', 'style' => 'width:100%;']) !!}   
            </div>
            <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::select('adaptations', $adaptations, null, ['class' => 'form-control select2', 'id' => 'adaptations', 'placeholder' => 'Elija Adecuacion', 'style' => 'width:100%;']) !!}   
            </div>
            <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::select('genders', $genders, null, ['class' => 'form-control select2', 'id' => 'genders', 'placeholder' => 'Elija Genero', 'style' => 'width:100%;']) !!}   
            </div>
            <div  class="col-md-4" style="margin-bottom:5px;">
                <button type="button" name="filter" id="filter" class="btn btn-info">Buscar</button>
                <a href="{{ route('admin.photographs.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px; display: none;" title="Crear Fotografias"><i class="fa fa-user-plus"></i> Crear Fotografias</a>
                <a href="/admin/importfromrebeca/"  id="aref" class="btn btn-success pull-right" style="margin-top: -8px; display: none;" title="Volver a Importacion de Rebecca"><i class="fa fa-user-plus"></i> Volver a Importacion</a>
                
            </div>        
        </div>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>          
                        <th>Título</th>             
                        <th>Subtipo</th> 
                        <th>Portada</th>   
                        <th>Formato</th> 
                        <th>Estado</th>                         
                        <th>Agregado</th>                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.photographs.partials._modal')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">    
@endpush

@push('scripts')  
    <script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
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
    <script src="{{ asset('js/photographs.js') }}"></script>
    
    <script>
    let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    var fechaActual = day + '-' + month + '-' + year;
    
    fill_datatable();

    function fill_datatable(references = "", subjects = "", adaptations = "", genders = "", indexsolo = ""){
        
        if( ($('#idd').val() != 'none') && ($('#idd').val() != null) ){
            indexsolo = $('#idd').val();
            document.getElementById('aref').style.display = 'block';
            // document.getElementById('id_btn-desidherata').style.display = 'none';
            // document.getElementById('id_btn-baja').style.display = 'none';
            // document.getElementById('id_btn-reactivar').style.display = 'none';
            // document.getElementById('id_btn-imprimir').style.display = 'none';  
            // $('aref').attr('href') = "https://www.instagram.com/"; 
                        // $('#aref').prop('href','/admin/importfromrebeca/');
                        // $("#aref").text("Volver a Rebecca");
                // console.log("aaaa: " + $('#idd').val());
                // console.log('lo trae ?: ' + indexsolo);
            }else{
                document.getElementById('btn-btn-create').style.display = 'block';
            console.log("trajo none o trajo por alguna razon extraña null");
        }

        var dataTable = $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 10001, targets: 4 },
                { responsivePriority: -1, targets: -1 }
            ],
            order: [ [0, 'desc'] ],     
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0,1,2,4,5,6]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5,6]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-fotografias-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,4,5,6]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-fotografias-'+ fechaActual,
                //     exportOptions: {
                        // stripHtml: false,
                //         columns: [0,1,2,3,4,5,6]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-fotografias-'+ fechaActual,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0,1,2,3,4,5,6]
                    }
                }
                
            ],             
            ajax:{ 
                url: "{{ route('photographs.table') }}", 
                data: {references:references, subjects:subjects, adaptations:adaptations, genders:genders, indexsolo:indexsolo},
                type: 'GET' 
                },        
            columns: [                
                {data: 'id_doc', name: 'id_doc'},         
                {data: 'documents_id', name: 'documents_id'},       
                {data: 'document_subtypes_id', name: 'document_subtypes_id'},  
                {data: 'photo', name: 'photo'},  
                {data: 'generate_formats_id', name: 'generate_formats_id'},                     
                {data: 'status', name: 'status'}, 
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });

    }

    $('#filter').click(function(){
        var references = '';
        var subjects = ''; 
        var adaptations = ''; 
        var genders = '';  
        references = $('#references').val();
        subjects = $('#subjects').val(); 
        adaptations = $('#adaptations').val(); 
        genders = $('#genders').val(); 

        if((references != '') || subjects != '' || adaptations != '' || genders != ''){
            $('#datatable').DataTable().destroy();
            fill_datatable(references, subjects, adaptations, genders);
        }
        else{
            $('#datatable').DataTable().destroy();
            fill_datatable(); 
        }

    });        
    </script>
@endpush