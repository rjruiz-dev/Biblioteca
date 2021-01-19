<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
    {{$Ml_loan_document->titulo_ld}}
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Documentos</li>
    </ol> 
@stop
@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">{{$Ml_loan_document->subtitulo_ld}}   
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{$Ml_loan_document->dt_id_ld}}</th>
                        <th>{{$Ml_loan_document->dt_titulo_ld}}</th> 
                        <th>{{$Ml_loan_document->dt_tipo_ld}}</th>                         
                        <th>{{$Ml_loan_document->dt_subtipo_ld}}</th>                        
                        <th>{{$Ml_loan_document->dt_copias_ld}}</th>                                
                        <th>{{$Ml_loan_document->dt_acciones_ld}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.fastprocess.partials._modal')
@stack('script')
@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">    
@endpush

@push('scripts')  
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
    <script src="{{ asset('js/fastprocess.js') }}"></script>
    
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
                    title: 'informe-documentos-disponibles-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-documentos-disponibles-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-documentos-disponibles-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                }
                
            ],             
            ajax: "{{ route('fastprocess.table2') }}",            
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},               
                {data: 'document_description', name: 'document_description'}, 
                {data: 'subtype_name', name: 'subtype_name'},
                {data: 'copias', name: 'copias'}, 
                // {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                            
            ]
        });
    </script>
@endpush