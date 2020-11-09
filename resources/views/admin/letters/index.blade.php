@extends('layouts.app')

@section('header')    
    <h1>
       MANTENIMIENTO DE CARTAS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Modelos de Cartas</li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">Listado de Modelos de Cartas  
          
                <a href="{{ route('admin.letters.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Carta"><i class="fa fa-user-plus"></i> Crear Carta</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th> 
                        <th>Contenido</th> 
                        <th>Despedida</th>                       
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

@include('admin.adequacies.partials._modal')

@push('styles')   
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">    
@endpush


@stack('script')
@push('scripts')   
    
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>   
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>   
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/letter.js') }}"></script>
    
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
                        columns: [0,1,2,3,4]
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
                    title: 'informe-modelos-de-cartas-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-modelos-de-cartas-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3,4]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-modelos-de-cartas-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
                
            ],             
            ajax: "{{ route('letters.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},               
                {data: 'title', name: 'title'},            
                {data: 'body', name: 'body'},             
                {data: 'excerpt', name: 'excerpt'},            
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush