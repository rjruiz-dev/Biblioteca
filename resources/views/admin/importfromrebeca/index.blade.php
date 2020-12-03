<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       LISTADO DE DOCUMENTOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Catálogo</li>
    </ol> 
@stop

@section('content')
<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
            <h3 class="panel-title">Listado de Documentos   
          
                <!-- <a href="{{ route('admin.loanmanual.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Libro"><i class="fa fa-user-plus"></i> Modal 1</a> -->
    
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th> 
                        <th>Tipo Documento</th>                         
                        <th>SubTipo Documento</th>                        
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
                {data: 'created_at', name: 'agregado'},                  
                {data: 'accion', name: 'accion'}                         
            ]
        });


        $('body').on('click', '.modal-show', function(event) {
            event.preventDefault();
            (async () => {
            const { value: fruit } = await Swal.fire({
            title: 'Seleccione el tipo de Documento',
            input: 'select',
            inputOptions: {  
                '1': 'Musica',  
                '2': 'Cine',     
                '3': 'Libros',
                '4': 'Multimedia',
                '5': 'Fotografia'
            },
            inputPlaceholder: 'Seleccione un tipo',
            showCancelButton: true,
            inputValidator: (value) => {
                return new Promise((resolve) => {
                if (value === '3') {
                    var me = $(this),
                    url = me.attr('https://test.ebookspain.es/admin/books/11/edit'),
                    title = me.attr('title');

                $('#modal-title').text(title);
                $('#modal-btn-save').removeClass('hide')
                    .text(me.hasClass('edit') ? 'Actualizar' : 'Crear');

                $.ajax({
                    url: url,
                    dataType: 'html',
                    success: function(response) {
                        $('#modal-body').html(response);

                        $('#document_subtypes_id').select2({
                            dropdownParent: $("#fg_document_subtypes_id"),
                            placeholder: 'Selecciona un subtipo de Documento'
                        });

                        $('#periodicities_id').select2({
                            dropdownParent: $("#din_periodicities_id"),
                            placeholder: 'Selecciona una periodicidad'
                        });

                        $('#lenguages_id').select2({
                            dropdownParent: $("#fg_lenguages_id"),
                            placeholder: 'Selecciona un Idioma'
                        });

                        $('#adequacies_id').select2({
                            dropdownParent: $("#fg_adequacies_id"),
                            placeholder: 'Selecciona una Adecuación'
                        });


                        $('#generate_books_id').select2({
                            dropdownParent: $("#din_generate_books_id"),
                            placeholder: 'Selecciona un Género'
                        });

                        $("#generate_subjects_id").select2({
                            dropdownParent: $("#fg_generate_subjects_id"),
                            placeholder: 'Selecciona Cdu'
                        });

                        $("#creators_id").select2({
                            dropdownParent: $("#fg_creators_id"),
                            placeholder: 'Seleccione o Ingrese Autor',
                            tags: true
                        });

                        $("#second_author_id").select2({
                            dropdownParent: $("#fg_second_author_id"),
                            placeholder: 'Seleccione o Ingrese Segundo Autor',
                            tags: true,
                        });

                        $("#third_author_id").select2({
                            dropdownParent: $("#din_third_author_id"),
                            placeholder: 'Seleccione o Ingrese Tercer Autor',
                            tags: true,
                        });

                        $('#acquired').datepicker({
                            autoclose: true,
                            todayHighlight: true,
                            format: 'dd-mm-yyyy',
                            language: 'es'
                        });

                        $('#published').select2({
                            dropdownParent: $("#fg_published"),
                            placeholder: 'Selecciona Lugar de Publicación',
                            tags: true

                        });
                        $('#made_by').select2({
                            dropdownParent: $("#fg_made_by"),
                            placeholder: 'Selecciona una Editorial',
                            tags: true
                        });

                        $('#year').datepicker({
                            autoclose: true,
                            format: "yyyy",
                            viewMode: "years",
                            minViewMode: "years",
                            language: 'es'
                        });

                        $('#edition').select2({
                            dropdownParent: $("#fg_edition"),
                            placeholder: 'Selecciona Número de Edición',
                            tags: true
                        });

                        $('#volume').select2({
                            dropdownParent: $("#fg_volume"),
                            placeholder: 'Selecciona un Volúmen',
                            tags: true
                        });

                        $('#status_documents_id').select2({
                            dropdownParent: $("#fg_status_documents_id"),
                            tags: false
                        });

                        $('#references').select2({
                            dropdownParent: $("#fg_references"),    
                            // tokenSeparators: [','],            
                            tags: true
                        });


                        CKEDITOR.replace('synopsis');
                        CKEDITOR.config.height = 190;


                        yesnoCheck();
                    }
                });

                $('#modal').modal('show');


                    resolve()
                } else {
                    resolve('You need to select oranges :)')
                }
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