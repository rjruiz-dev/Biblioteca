<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       LISTADO DE DOCUMENTOS IMPORTADOS
        <!-- <small>Listado</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Catálogo</li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <!-- <h3 class="panel-title">Listado de Documentos    -->
          
                <!-- <a href="{{ route('admin.loanmanual.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Libro"><i class="fa fa-user-plus"></i> Modal 1</a> -->
    
            <!-- </h3> -->
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th> 
                        <th>Tipo Documento</th>                         
                        <th>SubTipo Documento</th>                        
                        <th>Archivo</th>
                        <th>Carga</th>                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.importfromrebeca.partials._modal')

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
   
    
    <script>
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
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5]
                //     }
                // },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                // {
                //     extend: 'pdf',
                //     exportOptions: {
                //         columns: [0,1,2,3,4,5]
                //     }
                // },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                }
                
            ],             
            ajax: "{{ route('importfromrebeca.table') }}",        
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},               
                {data: 'document_types_id', name: 'document_types_id'}, 
                {data: 'document_subtypes_id', name: 'document_subtypes_id'}, 
                {data: 'archivo', name: 'archivo'}, 
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                         
            ]
        });


        $('body').on('click', '.modal-show', function(event) {
            event.preventDefault();
            // console.log("aaaaaaqa");
            var me = $(this),
            // idd = me.attr('title');
            idd = me.attr('value');
            // console.log("aaaaaaaaeee: " + idd);
            (async () => {
            const { value: fruit } = await Swal.fire({
            title: 'Seleccione el tipo de Documento',
            input: 'select',
            inputOptions: {  
                // '1': 'Musica',  
                // '2': 'Cine',     
                '3': 'Libros',
                // '4': 'Multimedia',
                // '5': 'Fotografia'
            },
            inputPlaceholder: 'Seleccione un tipo',
            showCancelButton: true,
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    // console.log("valor elegido: " + value);
                
                    if (value === '') {
                        swal({
                        type: 'error',
                        title: '¡Cuidado!',
                        text: '¡No ha seleccionado el Tipo de Documento!'
                    });
                    }
                
                
                // if (value === '1') {
                //     // window.location = "/admin/books/index";
                //     window.location="/admin/music/";
                //     window.location="/admin/music/indexsolo/" + idd + "/" + 1;

                // }
                // if (value === '2') {
                //     window.location="/admin/movies/indexsolo/" + idd + "/" + 2; 

                //     // window.location = "/admin/movies";
                // } 
                if (value === '3') {
                    // window.location="/admin/books/{request}/{idd}";
                    window.location="/admin/books/indexsolo/" + idd + "/" + 3; 
                    // window.location = "/admin/movies";
                } 
                // if (value === '4') {
                //     // window.location="/admin/multimedias/";
                //     window.location="/admin/multimedias/indexsolo/" + idd + "/" + 4;
                //     // window.location = "/admin/movies";
                // } 
                // if (value === '5') {
                //     // window.location="/admin/photographs/";
                //     window.location="/admin/photographs/indexsolo/" + idd + "/" + 5;
                //     // window.location = "/admin/movies";
                // } 
                })
             }
            })

            // if (fruit) {
            // Swal.fire(`You selected: ${fruit}`)
            // }

            })()
        });
      
        
     
    </script>
@endpush