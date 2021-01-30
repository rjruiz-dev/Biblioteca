@extends('layouts.app')

@section('header')    
    <h1>
       SOCIOS
        <small>Listado</small>
    </h1>
    {{ Form::hidden('preg_reactivar_socio', $Ml_partner->preg_reactivar_socio, ['id' => 'preg_reactivar_socio']) }}
    {{ Form::hidden('preg_baja_socio', $Ml_partner->preg_baja_socio, ['id' => 'preg_baja_socio']) }}
       
    <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{$idioma->inicio}}</a></li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">{{$Ml_partner->subtitulo_ams}}     
          
                <a href="{{ route('admin.users.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Socio"><i class="fa fa-user-plus"></i> {{$Ml_partner->btn_crear}}</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{$Ml_partner->dt_id_ams}}</th>
                        <th>{{$Ml_partner->dt_usuario_ams}}</th>       
                        <th>{{$Ml_partner->dt_nickname_ams}}</th>
                        <th>{{$Ml_partner->dt_perfil_ams}}</th>       
                        <th>{{$Ml_partner->dt_nombre_ams}}</th>                                           
                        <th>{{$Ml_partner->dt_email_ams}}</th>   
                        <th>{{$Ml_partner->dt_estado_ams}}</th>  
                        <th>{{$Ml_partner->dt_agregado_ams}}</th>                                
                        <th>{{$Ml_partner->dt_acciones_ams}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.users.partials._modal')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">   
@endpush

@push('scripts')  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
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
    <script src="{{ asset('js/user.js') }}"></script>
    
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
                        stripHtml: false,
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5,6,7]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-usuarios-'+ fechaActual,
                    exportOptions: {                       
                        columns: [0,1,2,4,5,6,7]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-usuarios-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5,6,7]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-usuarios-'+ fechaActual,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }
                
            ],             
            ajax: "{{ route('users.table') }}",            
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'membership', name: 'membership'},                       
                {data: 'nickname', name: 'ninckname'},
                {data: 'user_photo', name: 'user_photo'},
                {data: 'name', name: 'name'},               
                {data: 'email', name: 'email'}, 
                {data: 'status_id', name: 'status_id'}, 
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush