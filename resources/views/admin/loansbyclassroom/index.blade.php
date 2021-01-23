@extends('layouts.app')

@section('header')    
    <h1>
        {{ $ml_lc->titulo_lc }}       
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
        <div class="row">
                <div  class="col-md-2">
                <h3 class="panel-title" style="margin-top:25px; margin-bottom:8px;">{{ $ml_lc->subtitulo_lc }}</h3>
                </div>
                <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::label('cursos', $ml_lc->curso_lc ) !!} 
                {!! Form::select('cursos', $cursos, null, ['class' => 'form-control  select2', 'id' => 'cursos', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                
                </div>
                <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::label('letra', $ml_lc->letra_lc) !!} 
                {!! Form::select('letra', array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G'), null, ['class' => 'form-control  select2', 'id' => 'letra', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                
                </div>    
                <div  class="col-md-2" style="margin-bottom:5px;">
                {!! Form::label('turno', $ml_lc->turno_lc) !!} 
                {!! Form::select('turno', array('D' => 'D', 'T' => 'T', 'N' => 'N'), null, ['class' => 'form-control  select2', 'id' => 'turno', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                </div>
            <div  class="col-md-4" style="margin-top:25px;margin-bottom:5px;">
            <button type="button" name="filter" id="filter" class="btn btn-info">{{ $ml_lc->btn_crear_lc }}</button>
            </div>
        </div>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ $ml_lc->dt_registro_lc }}</th>                                   
                        <th>{{ $ml_lc->dt_titulo_lc }}</th>
                        <th>{{ $ml_lc->dt_autor_lc }}</th>   
                        <th>{{ $ml_lc->dt_tipodoc_lc }}</th>  
                        <th>{{ $ml_lc->dt_subtipodoc_lc }}</th>   
                        <th>{{ $ml_lc->dt_nrosocio_lc }}</th> 
                        <th>{{ $ml_lc->dt_socio_lc }}</th>
                        <th>{{ $ml_lc->dt_curso_lc }}</th>
                        <th>{{ $ml_lc->dt_fechaprestamo_lc }}</th>
                        <th>{{ $ml_lc->dt_fechadevolucion_lc }}</th>                                
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

        fill_datatable(); 

    function fill_datatable(curso = "", letra = "", turno = ""){

            // console.log("fecha_desde " + fecha_desde);
            // console.log("fecha_hasta " + fecha_hasta);

        var dataTable = $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 10001, targets: 4 },
                { responsivePriority: -1, targets: -1 }
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5,6,7,8,9]
                //     }
                // },
                {
                    extend: 'excel',
                    title: 'informe-prestamos-por-aula-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-prestamos-por-aula-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5,6,7,8,9]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-prestamos-por-aula-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                }
                
            ],             
            ajax:{ 
                url: "{{ route('loansbyclassroom.table') }}", 
                data: {curso:curso, letra:letra, turno:turno}, 
                type: 'GET' 
                },        
            columns: [                
                {data: 'registry_number', name: 'registry_number'},                                                   
                {data: 'documento', name: 'documento'},
                {data: 'creador', name: 'creador'}, 
                {data: 'tipo', name: 'tipo'}, 
                {data: 'subtipo', name: 'subtipo'}, 
                {data: 'membership', name: 'membership'}, 
                {data: 'usuario', name: 'usuario'}, 
                {data: 'curso', name: 'curso'},                                            
                {data: 'date', name: 'date'},                          
                {data: 'date_until', name: 'date_until'}                         
            ]
        });
    }

    $('#filter').click(function(){
        var cursos = $('#cursos').val();
        var letra = $('#letra').val(); 
        var turno = $('#turno').val(); 

        if(cursos != '' || letra != '' || turno != ''){
            $('#datatable').DataTable().destroy();
            fill_datatable(cursos, letra, turno);
        }
        else{
            $('#datatable').DataTable().destroy();
            fill_datatable(); 
        }

    });

    // $('#cursos').select2({
    //     placeholder: 'Curso',
    //     tags: false,               
    // });
    // $('#letra').select2({
    //     placeholder: 'Letra',
    //     tags: false,               
    // });
    // $('#turno').select2({
    //     placeholder: 'Turno',
    //     tags: false,               
    // });

    </script>
@endpush