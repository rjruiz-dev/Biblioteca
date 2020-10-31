@extends('layouts.app')

@section('header')    
    <h1>
       MANTENIMIENTO DE MATERIAS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Materias</li>
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de Materias  
          
                <a href="{{ route('admin.subjects.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Materia"><i class="fa fa-user-plus"></i> Crear Materia</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Materias</th>  
                        <th>Cdu</th>                       
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

@include('admin.subjects.partials._modal')

@push('styles')    
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">       
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">    
@endpush

@push('scripts')     
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
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
    <script src="{{ asset('js/subject.js') }}"></script>
    
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
                { responsivePriority: 10001, targets: 2 },
                { responsivePriority: -1, targets: -1 }
            ],
            order: [ [0, 'desc'] ],     
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,3]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-materias-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-materias-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-materias-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                }
                
            ],             
            ajax: "{{ route('subjects.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},               
                {data: 'subject_name', name: 'subject_name'},     
                {data: 'cdu', name: 'cdu'},             
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush