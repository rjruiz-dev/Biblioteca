<?php
use App\Music;
?>
@extends('layouts.app')

@section('header')    
    <h1>
    {{$ml_cat_list_book->music_text_titulo}}
        <small>Listado</small>
    </h1>
    {{ Form::hidden('idf', $idf, ['id' => 'idf']) }}
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}"><i class="fa fa-dashboard"></i> {{$ml_cat_list_book->music_text_inicio}}</a></li>
        <!-- <li class="active">Catálogo</li>
         -->
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary" style="border-color: {{ $setting->skin }};">        
        <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <div class="row">           
                <div  class="col-md-2" style="margin-bottom:5px;">
                    {!! Form::select('references', $references, null, ['class' => 'form-control select2', 'id' => 'references', 'placeholder' => '', 'style' => 'width:100%;']) !!}   
                </div>
                <div  class="col-md-2" style="margin-bottom:5px;">
                    {!! Form::select('subjects', $subjects, null, ['class' => 'form-control select2', 'id' => 'subjects', 'placeholder' => '', 'style' => 'width:100%;']) !!}   
                </div>
                <div  class="col-md-2" style="margin-bottom:5px;">
                    {!! Form::select('adaptations', $adaptations, null, ['class' => 'form-control select2', 'id' => 'adaptations', 'placeholder' => '', 'style' => 'width:100%;']) !!}   
                </div>
                <div  class="col-md-2" style="margin-bottom:5px;">
                    {!! Form::select('genders', $genders, null, ['class' => 'form-control select2', 'id' => 'genders', 'placeholder' => '', 'style' => 'width:100%;']) !!}   
                </div>
                <div  class="col-md-4" style="margin-bottom:5px;">
                    <button type="button" name="filter" id="filter" class="btn btn-info">{{$ml_cat_list_book->music_btn_buscar}}</button>
                
                </div>        
            </div>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                    <th>{{$ml_cat_list_book->music_dt_id}}</th>                       
                        <th>{{$ml_cat_list_book->music_dt_titulo}}</th>                        
                        <th>{{$ml_cat_list_book->music_dt_subtipo}}</th>                  
                        <th>{{$ml_cat_list_book->music_dt_genero}}</th>
                        <th>{{$ml_cat_list_book->music_dt_portada}}</th>    
                        <th>{{$ml_cat_list_book->music_dt_idioma}}</th>
                        <th>{{$ml_cat_list_book->music_dt_estado}}</th>                       
                        <th>{{$ml_cat_list_book->music_dt_agregado}}</th>                                
                        <th>{{$ml_cat_list_book->music_dt_acciones}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('web.music.partials._modal')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">    
@endpush

@push('scripts')     
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
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
    <script src="{{ asset('js/music.js') }}"></script>
    
    <script>
       $('#references').select2({                
            placeholder: '{!! $ml_cat_list_book->music_ph_referencia !!}',
            allowClear: true                                                      
        });
        $('#subjects').select2({                
            placeholder: '{!! $ml_cat_list_book->music_ph_materia !!}',
            allowClear: true                                                      
        });
        $('#adaptations').select2({                
            placeholder: '{!! $ml_cat_list_book->music_ph_adecuacion !!}',
            allowClear: true                                                      
        });
        $('#genders').select2({                
            placeholder: '{!! $ml_cat_list_book->music_ph_genero !!}',
            allowClear: true                                                      
        });
        
        let date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        var fechaActual = day + '-' + month + '-' + year;
        fill_datatable();

        function fill_datatable(references = "", subjects = "", adaptations = "", genders = "", indexsolo = ""){

            if( ($('#idf').val() != 'none') && ($('#idf').val() != null) ){
            indexsolo = $('#idf').val();
            // document.getElementById('aref').style.display = 'block';
            // document.getElementById('id_btn-desidherata').style.display = 'none';
            // document.getElementById('id_btn-baja').style.display = 'none';
            // document.getElementById('id_btn-reactivar').style.display = 'none';
            // document.getElementById('id_btn-imprimir').style.display = 'none';  
            // $('aref').attr('href') = "https://www.instagram.com/"; 
                        // $('#aref').prop('href','/admin/importfromrebeca/');
                        // $("#aref").text("Volver a Rebecca");
                // console.log("aaaa: " + $('#idf').val());
                // console.log('lo trae ?: ' + indexsolo);
            }else{
                // document.getElementById('btn-btn-create').style.display = 'block';
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
                        columns: [0,1,2,4,5,6,7]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,4,5,6,7]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-musica-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,4,5,6,7]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-musica-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,4,5,6,7]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-musica-'+ fechaActual,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }
                
            ],    
            ajax:{ 
                url: "{{ route('musica.table') }}",        
                data: {references:references, subjects:subjects, adaptations:adaptations, genders:genders, indexsolo:indexsolo},
                type: 'GET' 
            },        
            columns: [                
                {data: 'id_doc', name: 'id_doc'},      
                {data: 'documents_id', name: 'documents_id'},        
                {data: 'document_subtypes_id', name: 'document_subtypes_id'},
                {data: 'generate_musics_id', name: 'generate_musics_id'},       
                {data: 'photo', name: 'photo'},                  
                {data: 'lenguages_id', name: 'lenguages_id'},             
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