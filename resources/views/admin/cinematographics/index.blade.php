@extends('layouts.app')

@section('header')    
    <h1>
        {{ $ml_gc->titulo_gc }}      
    </h1>
    {{ Form::hidden('swal_eliminar_cin', $swal_gc->swal_eliminar_cin, ['id' => 'swal_eliminar_cin']) }}
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Géneros Cinematográficos</li>
        
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">{{ $ml_gc->subtitulo_gc }}  
          
                <a href="{{ route('admin.cinematographics.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="{{ $ml_gc->btn_crear_gc }}"><i class="fa fa-user-plus"></i> {{ $ml_gc->btn_crear_gc }}</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ $ml_gc->dt_id_gc }}ID</th>
                        <th>{{ $ml_gc->dt_gc }}</th>                       
                        <th>{{ $ml_gc->dt_agregado_gc }}</th>                                
                        <th>{{ $ml_gc->dt_acciones_gc }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.cinematographics.partials._modal')

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
    <script src="{{ asset('js/cinematographic.js') }}"></script>
    
    <script>
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
                        columns: [0,1,2]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                // {
                //     extend: 'pdf',
                //     exportOptions: {
                //         columns: [0,1,2]
                //     }
                // },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                }
                
            ],             
            ajax: "{{ route('cinematographics.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},               
                {data: 'genre_film', name: 'genre_film'},             
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush