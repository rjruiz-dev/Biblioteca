<?php
use App\Multimedia;
?>

@extends('layouts.app')

@section('header')    
    <h1>
    {{$ml_cat_list_book->multimedias_text_titulo}}
       {{ Form::hidden('idd', $idd, ['id' => 'idd']) }}
       
       {{ Form::hidden('preg_solicitar_documento', $traduccionsweet->preg_solicitar_documento, ['id' => 'preg_solicitar_documento']) }}
       
       {{ Form::hidden('preg_desidherata_documento', $traduccionsweet->preg_desidherata_documento, ['id' => 'preg_desidherata_documento']) }}
       
       {{ Form::hidden('preg_baja_documento', $traduccionsweet->preg_baja_documento, ['id' => 'preg_baja_documento']) }}
       {{ Form::hidden('preg_rechazar_documento', $traduccionsweet->preg_rechazar_documento, ['id' => 'preg_rechazar_documento']) }}
       
       {{ Form::hidden('preg_aceptar_documento', $traduccionsweet->preg_aceptar_documento, ['id' => 'preg_aceptar_documento']) }}
       {{ Form::hidden('preg_reactivar_documento', $traduccionsweet->preg_reactivar_documento, ['id' => 'preg_reactivar_documento']) }}
            
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{$ml_cat_list_book->multimedias_text_inicio}}</a></li>
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
                    <button type="button" name="filter" id="filter" class="btn btn-info">{{$ml_cat_list_book->multimedias_btn_buscar}}</button>
                    @if(Auth::user() != null && ((Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian')))
                    <a href="{{ route('admin.multimedias.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px; display: none;" title="Crear Multimedia"><i class="fa fa-user-plus"></i> {{$ml_cat_list_book->multimedias_btn_crear}}</a>
                    @endif
                    <a href="/admin/importfromrebeca/"  id="aref" class="btn btn-success pull-right" style="margin-top: -8px; display: none;" title="Volver a Importacion de Rebecca"><i class="fa fa-user-plus"></i> Volver a Importacion</a>
                </div>        
            </div>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{$ml_cat_list_book->multimedias_dt_id}}</th>                                   
                        <th>{{$ml_cat_list_book->multimedias_dt_titulo}}</th>
                        <th>{{$ml_cat_list_book->multimedias_dt_portada}}</th>    
                        <th>{{$ml_cat_list_book->multimedias_dt_estado}}</th>                     
                        <th>{{$ml_cat_list_book->multimedias_dt_agregado}}</th>                                
                        <th>{{$ml_cat_list_book->multimedias_dt_acciones}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.multimedias.partials._modal')

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
    <script src="{{ asset('js/multimedias.js') }}"></script>
    
    <script>
        $('#references').select2({                
            placeholder: '{!! $ml_cat_list_book->multimedias_ph_referencia !!}',
            allowClear: true                                                      
        });
        $('#subjects').select2({                
            placeholder: '{!! $ml_cat_list_book->multimedias_ph_materia !!}',
            allowClear: true                                                      
        });
        $('#adaptations').select2({                
            placeholder: '{!! $ml_cat_list_book->multimedias_ph_adecuacion !!}',
            allowClear: true                                                      
        });
        $('#genders').select2({                
            placeholder: '{!! $ml_cat_list_book->multimedias_ph_genero !!}',
            allowClear: true                                                      
        });
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
                if($("#btn-btn-create").length > 0){
                document.getElementById('btn-btn-create').style.display = 'block';
                }
            console.log("trajo none o trajo por alguna razon extraña null");
        }
        // console.log("idnex solo:" + indexsolo);
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
                            columns: [0,1,3,4]
                        }
                    },
                    // {
                    //     extend: 'csv',
                    //     exportOptions: {
                    //         columns: [0,1,2,3,4]
                    //     }
                    // },
                    {
                        extend: 'excel',
                        title: 'informe-multimedias-'+ fechaActual,
                        exportOptions: {
                            columns: [0,1,3,4]
                        }
                    },
                    // {
                    //     extend: 'pdf',
                    //     title: 'informe-multimedias-'+ fechaActual,
                    //     exportOptions: {
                            // stripHtml: false,
                    //         columns: [0,1,2,3,4]
                    //     }
                    // },
                    {
                        extend: 'print',
                        title: 'informe-multimedias-'+ fechaActual,
                        exportOptions: {
                            stripHtml: false,
                            columns: [0,1,2,3,4]
                        }
                    }
                    
                ],             
                ajax:{
                    url: "{{ route('multimedias.table') }}",        
                    data: {references:references, subjects:subjects, adaptations:adaptations, genders:genders, indexsolo:indexsolo},
                    type: 'GET' 
                },
                columns: [                
                    {data: 'id_doc', name: 'id_doc'},                                            
                    {data: 'documents_id', name: 'documents_id'},  
                    {data: 'photo', name: 'photo'},  
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