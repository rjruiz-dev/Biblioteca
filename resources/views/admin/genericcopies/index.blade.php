@extends('layouts.app')

@section('header')    
    <h1>
    {{ $document->title }} 
        <small>{{ $document->document_type->document_description }} - {{ $document->document_subtype->subtype_name }}</small>
    </h1>
    <ol class="breadcrumb">
    @if($bandera == 'i') <!-- CUANDO VIENE POR CATALOGOS NO POR IMPORTACION. letra c para catalogo. para importacion letra i -->
        <li class="active"><a title="Volver a listado de Importacion" href="{{ route('admin.importfromrebeca.index') }}"><i class="fa fa-share-square-o"></i> Importaciones</a> </li>
    @else
    @if($document->document_type->id == 1)  <!-- musica --> 
        <li class="active"><a title="{{ 'Regresar a listado de : '.$document->document_type->document_description}}" href="{{ route('admin.music.index') }}"><i class="fa fa-music"></i> Musica </a> </li>
        @endif
        @if($document->document_type->id == 2)  <!-- cine --> 
        <li class="active"><a title="{{ 'Regresar a listado de : '.$document->document_type->document_description}}" href="{{ route('admin.movies.index') }}"><i class="fa fa-video-camera"></i> Cines </a> </li>
        @endif
        @if($document->document_type->id == 3)  <!-- libro --> 
        <li class="active"><a title="{{ 'Regresar a listado de : '.$document->document_type->document_description}}" href="{{ route('admin.books.index') }}"><i class="fa fa-book"></i> Libros </a> </li>
        @endif
        @if($document->document_type->id == 4)  <!-- multimedia --> 
        <li class="active"><a title="{{ 'Regresar a listado de : '.$document->document_type->document_description}}" href="{{ route('admin.multimedias.index') }}"><i class="fa fa-youtube-play"></i> Multimedias </a> </li>
        @endif
        @if($document->document_type->id == 5)  <!-- fotografia --> 
        <li class="active"><a title="{{ 'Regresar a listado de : '.$document->document_type->document_description}}" href="{{ route('admin.photographs.index') }}"><i class="fa fa-photo"></i> Fotografias </a> </li>
        @endif
    @endif
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">Listado de Ejemplares     
          
                <a href="{{ route('genericcopies.newcopies', $document->id) }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Nuevo Ejemplar para el Documento: {{ $document->title }}"><i class="fa fa-user-plus"></i> Agregar Ejemplar</a>
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° Registro</th>                      
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

@include('admin.genericcopies.partials._modal')

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
    <script src="{{ asset('js/genericcopies.js') }}"></script>
    
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
                    title: 'informe-copias-{{ $document->title }}-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'informe-copias-{{ $document->title }}-'+ fechaActual,
                //     exportOptions: {
                //         columns: [0,1,2,3]
                //     }
                // },
                {
                    extend: 'print',
                    title: 'informe-copias-{{ $document->title }}-'+ fechaActual,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
                
            ],             
            ajax: "{{ route('genericcopies.table', $document->id) }}",        
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'registry_number', name: 'registry_number'},                                             
                {data: 'status', name: 'status'},           
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                          
            ]
        });
        
    </script>
@endpush