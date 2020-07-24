<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       DOCUMENTOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Documentos</li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">     
<div class="col-md-6">    
        <div class="box box-primary"> 
        <b>id documento: {{ $documento->id }} </b>     
        <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $documento->title}}">
                <h3 class="profile-username text-center">{{ $documento->title }}</h3>
                
                <p class="text-muted text-center">{{ $documento->creator->creator_name }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Tipo de Documento: </b> <a class="pull-right">{{ $documento->document_type->document_description }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tipo de {{ $documento->document_type->document_description }} </b> <a class="pull-right">{{ $documento->document_subtype->subtype_name }}</a>
                    </li>
                                        
                </ul>
               
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">cantidad de copias habilitadas: {{ $documento->title }}</h3>                
            </div>
            <div class="box-body">   
            <ul class="list-group list-group-unbordered">
            
            @foreach ($copies as $copie)
                        {!! Form::model($copies, [
                        'route' => ['admin.FPSocios.store', count($copies)],   
                        'method' => 'POST'
                        ]) !!}         
            <li class="list-group-item">
            <b>id movimiento: {{ $copie->id }} </b>
                <div class="row"> 
                        <div class="col-md-12">
                        <h3 class="profile-username text-center">N° copia: {{ $copie->id }}</h3>   
                    <p class="text-muted text-center"></p>
                    </div>
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Estado: </b><a class="pull-right">{{ $copie->movement_type->book_status }} </a>
                    </div>
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Prestado a: </b><a class="pull-right">{{ $copie->user->name }} </a>
                    </div>
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Prestado el: </b><a class="pull-right">{{ $copie->created_at->format('d-m-Y') }} </a>
                    </div> 
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>A devolver el: </b><a class="pull-right">{{ $copie->created_at->addDays(3)->format('d-m-Y') }}</a>
                    </div>
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Dias de retraso: </b><a class="pull-right">{{ $copie->created_at->addDays(3)->diffInDays(Carbon\Carbon::now()) }}</a>
                    </div> 
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Sancion de:   </b><a class="pull-right"> $ {{ $copie->created_at->addDays(3)->diffInDays(Carbon\Carbon::now())*10 }}</a>
                    </div>
                     
                    <div class="col-md-6 text-center" style="padding-top: 1rem;">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Devolucion</button> -->
                        <a href="" title="Devolver: " class="btn btn-success modal-show">Devolucion</a>
                        <!-- id="btn-btn-create" class="btn btn-success pull-right modal-show" -->
                     </div>
                    <div class="col-md-6 text-center" style="padding-top: 1rem;">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Renovacion</button> --> 

                    <a href="" title="Renovar:" class="btn btn-success modal-show">Renovacion</a>
                </div>   
         </li> 
             {!! Form::close() !!}             
                @endforeach 

                </ul>   
            </div> 
        </div>                    
    </div>
   
</div>







  
@stop

@include('admin.FPSocios.partials._modal')

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
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/fpsocios.js') }}"></script>
    
@endpush