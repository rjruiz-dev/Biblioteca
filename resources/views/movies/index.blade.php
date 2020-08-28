@extends('layouts.app')

@section('header')    
    <h1>
       CATÁLOGO DE CINES
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <!-- <li class="active">Catálogo</li>
         -->
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de Cine   
          
             
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>                                   
                        <th>Titulo y Director</th>  
                        <th>Género</th>  
                        <th>Formato</th>  
                        <th>Idioma</th> 
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

@include('movies.partials._modal')

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
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/movies.js') }}"></script>
    
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],     
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
                
            ],          
            ajax: "{{ route('movies.table') }}",    
            columns: [                
                {data: 'id_doc', name: 'id_doc'},                                                   
                {data: 'documents_id', name: 'documents_id'}, 
                {data: 'generate_films_id', name: 'generate_films_id'}, 
                {data: 'generate_formats_id', name: 'generate_formats_id'}, 
                {data: 'lenguages_id', name: 'lenguages_id'},
                {data: 'status', name: 'status'},             
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
        
    </script>
@endpush