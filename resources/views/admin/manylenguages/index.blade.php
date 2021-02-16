@extends('layouts.app')

@section('header')    
    <h1>
       CATÁLOGO DE LENGUAJES
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
            <h3 class="panel-title">Listado de Lenguajes   
          
                <a href="{{ route('admin.manylenguages.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Lenguaje"><i class="fa fa-user-plus"></i> Crear Lenguaje</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>                    
                        <th>Lenguaje</th>
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

@include('admin.manylenguages.partials._modal')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">      
@endpush

@push('scripts')  
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>   
    <script src="{{ asset('js/manylenguages.js') }}"></script>
    
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
                        columns: [0,1,2,3,4,5,6]
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
                    title: 'informe-idiomas-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-idiomas-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5,6]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-idiomas-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
                
            ],             
            ajax: "{{ route('manylenguages.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'lenguage_description', name: 'lenguage_description'},
                {data: 'label_estado', name: 'label_estado'},             
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush