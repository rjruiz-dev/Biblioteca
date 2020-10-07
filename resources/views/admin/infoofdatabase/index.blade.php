@extends('layouts.app')

@section('header')    
    <h1>
       INFORMACION GENERAL DE LA BASE DE DATOS
        <!-- <small>Listado</small> -->
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
        
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Concepto</th>                                   
                        <th>Cantidad de Registro</th>
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
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/movies.js') }}"></script>
    
    <script>
     let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    var fechaActual = day + '-' + month + '-' + year;
   
        // fill_datatable(); 

    // function fill_datatable(curso = "", letra = "", turno = ""){

            // console.log("fecha_desde " + fecha_desde);
            // console.log("fecha_hasta " + fecha_hasta);

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
                    title: 'informe-registros-base-datos-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                {
                    extend: 'pdf',
                    title: 'informe-registros-base-datos-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                {
                    extend: 'print',
                    title: 'informe-registros-base-datos-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2]
                    }
                }
                
            ],             
            ajax: "{{ route('infoofdatabase.table') }}",         
            columns: [  
                {data: 'id', name: 'id'},              
                {data: 'name_table', name: 'name_table'},                                                   
                {data: 'cantidades', name: 'cantidades'},                        
            ]
        });
    // }

    // $('#filter').click(function(){
    //     var cursos = $('#cursos').val();
    //     var letra = $('#letra').val(); 
    //     var turno = $('#turno').val(); 

    //     if(cursos != '' || letra != '' || turno != ''){
    //         $('#datatable').DataTable().destroy();
    //         fill_datatable(cursos, letra, turno);
    //     }
    //     else{
    //         $('#datatable').DataTable().destroy();
    //         fill_datatable(); 
    //     }

    // });

    // $('#cursos').select2({
    //             placeholder: 'Curso',
    //             tags: false,               
    //         });
    //         $('#letra').select2({
    //             placeholder: 'Letra',
    //             tags: false,               
    //         });
    //         $('#turno').select2({
    //             placeholder: 'Turno',
    //             tags: false,               
    //         });

    </script>
@endpush