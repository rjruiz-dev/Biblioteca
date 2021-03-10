@extends('layouts.app')
@if(Auth::user() != null && ((Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian')))

@section('header')        
    <h1>
    {{$ml_panel_admin['panel_de_control']}} 
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
                    {{$ml_panel_admin['documentos']}} 
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $documento->documents }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{$ml_panel_admin['documentos_registrados']}} </font></font></p>
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
                    {{$ml_panel_admin['prestamos']}}
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $prestamo->book_movements }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$ml_panel_admin['prestamos_registrados']}}</font></font></p>
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
                    {{$ml_panel_admin['prestamos_vencidos']}}
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $vencido->book_movements }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$ml_panel_admin['vencidos_registrados']}}</font></font></p>
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
                    {{$ml_panel_admin['usuarios']}}
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $socio->users }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$ml_panel_admin['usuarios_registrados']}}</font></font></p>
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
        <h3 class="panel-title">{{$ml_panel_admin['ultimos_cinco_prestamos']}}</h3>
    </div>
    <div class="panel-body">
        <table id="datatable" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>{{$ml_panel_admin['pres_id']}}</th>                     
                    <th>{{$ml_panel_admin['pres_prefil']}}</th>       
                    <th>{{$ml_panel_admin['pres_nombre']}}</th>                                           
                    <th>{{$ml_panel_admin['pres_email']}}</th>
                    <th>{{$ml_panel_admin['pres_titulo']}}</th>  
                    <th>{{$ml_panel_admin['pres_fecha_devolucion']}}</th>   
                    <th>{{$ml_panel_admin['pres_n_ejemplar']}}</th>
                    <th>{{$ml_panel_admin['pres_cant_prestamos']}}</th>                    
                </tr>
            </thead>
            <tbody>
                
            </tbody>                
        </table>
    </div>
</div> 

<div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
        <h3 class="panel-title">{{$ml_panel_admin['prestamos_vencidos']}}</h3>
    </div>
    <div class="panel-body">
        <table id="datatable1" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>{{$ml_panel_admin['venc_id']}}</th>                     
                    <th>{{$ml_panel_admin['venc_perfil']}}</th>       
                    <th>{{$ml_panel_admin['venc_nombre']}}</th>                                           
                    <th>{{$ml_panel_admin['venc_email']}}</th>
                    <th>{{$ml_panel_admin['venc_titulo']}}</th>  
                    <th>{{$ml_panel_admin['venc_fecha_devolucion']}}</th>   
                    <th>{{$ml_panel_admin['venc_n_ejemplar']}}</th>
                    <th>{{$ml_panel_admin['venc_cant_prestamos']}}</th>                    
                </tr>
            </thead>
            <tbody>
                
            </tbody>                
        </table>
    </div>
</div> 
@stop
@else
@section('content')
<section class="all-pages-content">
    <!-- <div class="container"> -->
    <div class="panel panel-primary" style="border-color: {{ $setting->skin }};"> 
    <div class="panel-heading" style="background-color: {{ $setting->skin }};">
        <h3 class="panel-title">Sus prestamos Actuales</h3>
    </div>
    <div class="panel-body">
        <table id="datatable3" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>                     
                    <th>Titulo</th>       
                    <th>Tipo de Documento</th>                                           
                    <th>Fecha Prestamo</th>
                    <th>Fecha Devolucion</th>  
                    </tr>
            </thead>
            <tbody>
                
            </tbody>                
        </table>
    </div>
</div>
        <div class="row">
        <div  id="recargar">
                <!-- <div class="col-xs-12"> -->
                    <h1 class="text-center wow pulse all-titles-pages">{{$ml_front_end->doc_mas_recientes}}</h1>
                 
                    <!-- <select name="filtro" id="filtro" class="form-control select2 text-center" onchange="filtrar()" style="width:200px; margin-left:10px;">
                                    <option value="2">Ultimos 2</option> 
                                    <option value="3">Ultimos 3</option>
                                    <option value="4">Ultimos 4</option>
                                    <option value="5">Ultimos 5</option>
                                </select> -->
                    {!! Form::select('filtro', ['5' => $ml_front_end->recientes_cinco, '10' => $ml_front_end->recientes_diez, '20' => $ml_front_end->recientes_veinte, '50' => $ml_front_end->recientes_cincuenta], $recientes, ['class' => 'form-control select2', 'id' => 'filtro','onchange' => 'filtrar()', 'style' => 'width:200px; margin-left:10px;']) !!}

                   <br>
                    <br>
                <!-- </div> -->
            @php
            $contadorRecientes = 0;
            @endphp
            @foreach($documentos as $doc)
            @php
                    if($doc['photo'] == null){
                        $url=asset("images/doc-default.png");
                    }else{
                        if(file_exists("images/". $doc['photo'])){
                            $url=asset("images/". $doc['photo']);
                        }else{
                            $url=asset("images/doc-default.png");  
                        }    
                    }
            @endphp
            <div class="col-md-15">   
                <div class="box box-primary" style="border-color: {{ $setting->skin }};" style="border-top-color: {{ $setting->skin }};">        
                <!-- style="word-wrap: break-word;" -->
                    <div class="box-body box-profile" style="word-wrap: break-word;">            
            
                        <img class="img-responsive img-rounded" 
                        src="{{ $url }}" alt="{{ $doc['title'] }}" style="border: 3px solid #d2d6de; width: 100%;"> 
                    
                    @if ( strlen(trim($doc['title'])) > 25)
                    @php
                    $titulo = substr(trim($doc['title']), 0, 25)."..";
                    @endphp
                    @else
                    @php
                    $titulo = trim($doc['title']);
                    @endphp
                    @endif

                    @if ( strlen(trim($doc['synopsis'])) > 35)
                    @php
                    $sinopsis = substr(trim($doc['synopsis']), 0, 35)."..";
                    $sinopsis = strip_tags($sinopsis);
                    @endphp
                    @else
                    @php
                    $sinopsis = trim($doc['synopsis']);
                    $sinopsis = strip_tags($sinopsis);
                    @endphp
                    @endif
                      
                        <h3 class="text-center" style="height: 45px;">{{ $titulo }}</h3>
                     <p style="height: 45px;">{!! $sinopsis !!}</p>
                     @if($doc['document_types_id'] == 1)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 2)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 3)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 4)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 5)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                        
                        
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div> 
            </div> 
            @php
            $contadorRecientes = $contadorRecientes + 1;
            @endphp
            @if($contadorRecientes == 5)
            <div class="col-md-15" style="width: 100%"> 
            </div>
            @php
            $contadorRecientes = 0;
            @endphp
            @endif 
            @endforeach	
        </div>
        </div>
        <hr>      
        <div class="row">
        <div  id="recargar_reservados">
            <!-- <div class="col-xs-12"> -->
                <h1 class="text-center wow pulse all-titles-pages">{{$ml_front_end->doc_mas_reservados}}</h1>
                {!! Form::select('filtro_reservados', ['5' => $ml_front_end->reservados_cinco, '10' => $ml_front_end->reservados_diez, '20' => $ml_front_end->reservados_veinte, '50' => $ml_front_end->reservados_cincuenta], $reservados, ['class' => 'form-control select2', 'id' => 'filtro_reservados','onchange' => 'filtrar_reservados()', 'style' => 'width:200px; margin-left:10px;']) !!}

                   <br>
                    <br>
            <!-- </div> -->
            @php
            $contadorReservados = 0;
            @endphp
            @foreach($CincoMasResevados  as $masreservados)
            @php
                    if($masreservados->photo == null){
                        $url_d=asset("images/doc-default.png");
                    }else{
                        if(file_exists("images/". $masreservados->photo)){
                            $url_d=asset("images/". $masreservados->photo);
                        }else{
                            $url_d=asset("images/doc-default.png");  
                        }    
                    }
            @endphp
            <div class="col-md-15">   
                <div class="box box-primary" style="border-color: {{ $setting->skin }};">        
                <!-- style="word-wrap: break-word;" -->
                    <div class="box-body box-profile" style="word-wrap: break-word;">            
            
                        <img class="img-responsive img-rounded" 
                        src="{{ $url_d }}" alt="{{ $masreservados->title }}" style="border: 3px solid #d2d6de; width: 100%;"> 
                    
                    @if ( strlen(trim($masreservados->title)) > 25)
                    @php
                    $titulo_d = substr(trim($masreservados->title), 0, 25)."..";
                    @endphp
                    @else
                    @php
                    $titulo_d = trim($masreservados->title);
                    @endphp
                    @endif

                    @if ( strlen(trim($masreservados->synopsis)) > 35)
                    @php
                    $sinopsis_d = substr(trim($masreservados->synopsis), 0, 35)."..";
                    $sinopsis_d = strip_tags($sinopsis_d);
                    @endphp
                    @else
                    @php
                    $sinopsis_d = trim($masreservados->synopsis);
                    $sinopsis_d = strip_tags($sinopsis_d);
                    @endphp
                    @endif
                      
                        <h3 class="text-center" style="height: 45px;">{{ $titulo_d }}</h3>
                     <p style="height: 45px;">{!! $sinopsis_d !!}</p>
                     @if($masreservados->document_types_id == 1)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 2)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 3)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 4)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 5)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                        
                        
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div> 
            </div>
            @php
            $contadorReservados = $contadorReservados + 1;
            @endphp
            @if($contadorReservados == 5)
            <div class="col-md-15" style="width: 100%"> 
            </div>
            @php
            $contadorReservados = 0;
            @endphp
            @endif           
            @endforeach	
        </div>
        </div>     
    <!-- </div> -->
    
</section>
@stop


<script>
        
</script>

<style type="text/css">
    .col-xs-15,
    .col-sm-15,
    .col-md-15,
    .col-lg-15 {
        position: relative;
        min-height: 1px;
        padding-right: 10px;
        padding-left: 10px;
    }
    .col-xs-15 {
    width: 20%;
    float: left;
}
@media (min-width: 768px) {
.col-sm-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 992px) {
    .col-md-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 1200px) {
    .col-lg-15 {
        width: 20%;
        float: left;
    }
}
</style>



@endif


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

        function filtrar() {
            valor_filtro = document.getElementById("filtro").value;
            console.log("ssssss: " + valor_filtro);
            $.ajax({                    
                url: '/web/filtrarhome/' + valor_filtro,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log("llego a succes: " + response.recientes);
                $("#recargar").load(" #recargar");
                },
                error: function () { 
                    // console.log(error);
                    alert('Hubo un error obteniendo el detalle de la Compañía!');
                }
            })
        }

        function filtrar_reservados() {
            valor_filtro_reservados = document.getElementById("filtro_reservados").value;
            console.log("ssssss: " + valor_filtro_reservados);
            $.ajax({                    
                url: '/web/filtrarhome_reservados/' + valor_filtro_reservados,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log("llego a succes: " + response.recientes);
                $("#recargar_reservados").load(" #recargar_reservados");
                },
                error: function () { 
                    // console.log(error);
                    alert('Hubo un error obteniendo el detalle de la Compañía!');
                }
            })
        }

        var idiomaEsp = 
            {
                "zeroRecords": "Actualmente usted no tiene prestamos"
            }

        $('#datatable3').DataTable({
            bPaginate: false,
            bInfo : false,
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
            ajax: "{{ route('susprestamos.table') }}",            
            columns: [                
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'}, 
                {data: 'type_document', name: 'type_document'},                  
                {data: 'date', name: 'date'},               
                {data: 'date_until', name: 'date_until'}, 
                                            
            ],
            language: idiomaEsp
        });
 </script>

@endpush
