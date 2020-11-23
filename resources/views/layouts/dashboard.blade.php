@extends('layouts.app')

@section('header')        
    <h1>
        Panel de Control 
        <small>Version 1.0 </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>        
    </ol> 
@stop

@section('content')
<div class="row">     
    <div class="col-md-3">         
        <div class="small-box bg-aqua">
            <div class="inner">
                @foreach($documentos as $documento)
                    <span class="info-box-text">                          
                        DOCUMENTOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $documento->documents }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Documentos registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>            
        </div>
    </div>
    <div class="col-md-3">         
        <div class="small-box bg-blue">
            <div class="inner">
                @foreach($prestamos as $prestamo)
                    <span class="info-box-text">                          
                        PRESTAMOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $prestamo->book_movements }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Prestamos registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>            
        </div>
    </div>
    <div class="col-md-3">         
        <div class="small-box bg-red">
            <div class="inner">
                @foreach($prestamos_vencidos as $vencido)
                    <span class="info-box-text">                          
                        PRESTAMOS VENCIDOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $vencido->book_movements }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vencidos registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-warning "></i>
            </div>            
        </div>
    </div>

    <div class="col-md-3">         
        <div class="small-box bg-green">
            <div class="inner">
                @foreach($socios as $socio)
                    <span class="info-box-text">                          
                        USUARIOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $socio->users }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Usuarios registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
           
        </div>
    </div>
</div> 

<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
        <h3 class="panel-title">Ultimos 5 Prestamos</h3>
    </div>
    <div class="panel-body">
        <table id="datatable" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>                     
                    <th>Perfil</th>       
                    <th>Nombre</th>                                           
                    <th>Email</th>
                    <th>Título</th>  
                    <th>Fecha de Devolución</th>   
                    <th>N° de Ejemplar</th>
                    <th>Cant de Prestamos</th>                    
                </tr>
            </thead>
            <tbody>
                
            </tbody>                
        </table>
    </div>
</div> 

<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
        <h3 class="panel-title">Prestamos vencidos</h3>
    </div>
    <div class="panel-body">
        <table id="datatable1" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>                     
                    <th>Perfil</th>       
                    <th>Nombre</th>                                           
                    <th>Email</th>
                    <th>Título</th>  
                    <th>Fecha de Devolución</th>   
                    <th>N° de Ejemplar</th>
                    <th>Cant de Prestamos</th>                    
                </tr>
            </thead>
            <tbody>
                
            </tbody>                
        </table>
    </div>
</div> 
@stop

@push('styles')  
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">   
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">   
@endpush

@push('scripts')     
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
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
                {
                    extend: 'excel',
                    title: 'informe-usuarios-'+ fechaActual,
                    exportOptions: {                       
                        columns: [0,1,2,4,5,6,7]
                    }
                },              
                {
                    extend: 'print',
                    title: 'informe-usuarios-'+ fechaActual,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }
                
            ],             
            ajax: "{{ route('currentloan.table') }}",            
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'user_photo', name: 'user_photo'},                
                {data: 'name', name: 'name'},               
                {data: 'email', name: 'email'}, 
                {data: 'title', name: 'title'},
                {data: 'date_until', name: 'date_until'},   
                {data: 'registry_number', name: 'registry_number'},                 
                {data: 'prestamos', name: 'prestamos'},                                
            ]
        });

       

        $('#datatable1').DataTable({
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
                {
                    extend: 'excel',
                    title: 'informe-usuarios-'+ fechaActual,
                    exportOptions: {                       
                        columns: [0,1,2,4,5,6,7]
                    }
                },              
                {
                    extend: 'print',
                    title: 'informe-usuarios-'+ fechaActual,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }
                
            ],             
            ajax: "{{ route('overdueloan.table') }}",            
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'user_photo', name: 'user_photo'},                
                {data: 'name', name: 'name'},               
                {data: 'email', name: 'email'}, 
                {data: 'title', name: 'title'},
                {data: 'date_until', name: 'date_until'},   
                {data: 'registry_number', name: 'registry_number'},                 
                {data: 'prestamos', name: 'prestamos'},                                
            ]
        });
    </script>

@endpush
