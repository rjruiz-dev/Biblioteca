@extends('layouts.app')

@section('header')    
    <h1>
        {{ $ml_course->titulo_curso }}       
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Cursos</li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">{{ $ml_course->subtitulo_curso }}  
          
                <a href="{{ route('admin.courses.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show"{{ style="margin-top: -8px;" title=" $ml_course->btn_crear_curso }}"><i class="fa fa-user-plus"></i> {{ $ml_course->btn_crear_curso }}</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ $ml_course->dt_id_curso }}</th>
                        <th>{{ $ml_course->dt_curso }}</th>
                        <th>{{ $ml_course->dt_grupo }}</th> 
                        <th>{{ $ml_course->dt_agregado_curso }}</th>                      
                        <th>{{ $ml_course->dt_estado }}</th>                               
                        <th>{{ $ml_course->dt_acciones_curso }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.courses.partials._modal')

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
    <script src="{{ asset('js/course.js') }}"></script>
    
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
                { responsivePriority: 10001, targets: 3 },
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
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-cursos-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-cursos-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-cursos-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2]
                    }
                }
                
            ],             
            ajax: "{{ route('courses.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},               
                {data: 'course_name', name: 'course_name'},        
                {data: 'group', name: 'group'},  
                {data: 'created_at', name: 'agregado'},                  
                {data: 'estado', name: 'estado'},             
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush