@extends('layouts.app')

@section('header')    
    <h1>
       LISTADO DE PRESTAMOS
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
        <div class="row">
                <div  class="col-md-3">
                <h3 class="panel-title">Listado de Prestamos</h3>
                </div>
                <div  class="col-md-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>                      
                                    <input name="desde"
                                        class="form-control pull-right"                                                                                   
                                        type="text"
                                        id="desde"
                                        placeholder= "Fecha desde">                       
                                </div>
                </div>
                    <div  class="col-md-3">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>                      
                                        <input name="hasta"
                                            class="form-control pull-right"                                                                                   
                                            type="text"
                                            id="hasta"
                                            placeholder= "Fecha hasta">                       
                                    </div>
                    </div>
            <div  class="col-md-3">
            <button type="button" name="filter" id="filter" class="btn btn-info">Buscar</button>
            </div>
        </div>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>                                   
                        <th>Tipo Mov</th>  
                        <th>Usuario</th>  
                        <th>N° Copia</th>  
                        <th>Curso</th> 
                        <th>Grupo</th>                     
                        <th>Turno</th>
                        <th>Activo</th>
                        <th>Fecha</th>
                        <th>Fecha Hasta</th>                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.movies.partials._modal')

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
        fill_datatable(); 

    function fill_datatable(fecha_desde = "", fecha_hasta = ""){

            console.log("fecha_desde " + fecha_desde);
            console.log("fecha_hasta " + fecha_hasta);

        var dataTable = $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
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
            ajax:{ 
                url: "{{ route('loansbydate.table') }}", 
                data: {fecha_desde:fecha_desde, fecha_hasta:fecha_hasta},
                type: 'GET' 
                },        
            columns: [                
                {data: 'id', name: 'id'},                                                   
                {data: 'movement_types_id', name: 'movement_types_id'}, 
                {data: 'users_id', name: 'users_id'}, 
                {data: 'copies_id', name: 'copies_id'}, 
                {data: 'courses_id', name: 'courses_id'},
                {data: 'grupo', name: 'grupo'},             
                {data: 'turno', name: 'turno'},                  
                {data: 'active', name: 'active'},                          
                {data: 'date', name: 'date'},                          
                {data: 'date_until', name: 'date_until'}                         
            ]
        });
    }

    $('#filter').click(function(){
        var fecha_desde = $('#desde').val();
        var fecha_hasta = $('#hasta').val(); 

        if(fecha_desde != '' && fecha_hasta != ''){
            $('#datatable').DataTable().destroy();
            fill_datatable(fecha_desde, fecha_hasta);
        }else{
            alert('todo vacio estas pasandooo');
        }

    });

    $('#desde').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: 'dd/mm/yyyy',                      
                language: 'es'
            }); 
        
    $('#hasta').datepicker({
        autoclose: true,
        todayHighlight: true,  
        format: 'dd/mm/yyyy',                      
        language: 'es'
    }); 

    </script>
@endpush