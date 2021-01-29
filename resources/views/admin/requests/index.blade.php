@extends('layouts.app')

@section('header')    
    <h1>
    {{$Ml_web_loan->titulo_wl}}
        <!-- <small>Listado</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{$idioma->inicio}}</a></li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">{{$Ml_web_loan->subtitulo_wl}}   
          
                <!-- <a href="{{ route('admin.requests.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Libro"><i class="fa fa-user-plus"></i> Crear libro</a> -->
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                    <th>{{$Ml_web_loan->dt_id_wl}}</th>
                        <!-- <th>Tipo Mov(provis)</th>  -->
                        <th>{{$Ml_web_loan->dt_titulo_wl}}</th>                         
                        <th>{{$Ml_web_loan->dt_documento_wl}}</th>
                        <th>{{$Ml_web_loan->dt_tipo_wl}}</th>
                        <th>{{$Ml_web_loan->dt_subtipo_wl}}</th>
                        <th>{{$Ml_web_loan->dt_curso_wl}}</th>                        
                        <th>{{$Ml_web_loan->dt_agregado_wl}}</th>                                
                        <th>{{$Ml_web_loan->dt_acciones_wl}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.requests.partials._modal')

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
    <script src="{{ asset('js/requests.js') }}"></script> 
    
    <script>
    let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    var fechaActual = day + '-' + month + '-' + year;

        $('#datatable').DataTable({
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
                        columns: [0,1,2,3,4,5]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-solicitudes-web-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-solicitudes-web-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-solicitudes-web-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                }
                
            ],             
            ajax: "{{ route('requests.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},
                // {data: 'tipo_movimiento', name: 'tipo_movimiento'},               
                {data: 'usuario_solicitante', name: 'usuario_solicitante'}, 
                {data: 'documento_solicitado', name: 'documento_solicitado'}, 
                {data: 'tipo_solicitado', name: 'tipo_solicitado'},
                {data: 'sub_tipo_solicitado', name: 'sub_tipo_solicitado'}, 
                {data: 'curso', name: 'curso'},
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                         
            ]
        });
    </script>
@endpush