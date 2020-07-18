<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       SOCIOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Socios</li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">     
    <div class="col-md-6">    
        <div class="box box-primary">        
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $user->nickname}}">
                <h3 class="profile-username text-center">{{ $user->nickname }}</h3>
                
                <p class="text-muted text-center">{{ $user->name }}</p>
                <p class="text-muted text-center">{{ $user->surname }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Genero</b> <a class="pull-right">{{ $user->gender }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Provincia</b> <a class="pull-right">{{ $user->province }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Ciudad</b> <a class="pull-right">{{ $user->city }}</a>
                    </li>   
                    <li class="list-group-item">
                        <b>Direccion</b> <a class="pull-right">{{ $user->address }}</a>
                    </li> 
                    <li class="list-group-item">
                        <b>Codigo Postal</b> <a class="pull-right">{{ $user->postcode }}</a>
                    </li>     
                    <li class="list-group-item">
                        <b>Telefono</b> <a class="pull-right">{{ $user->phone }}</a>
                    </li>     
                    <li class="list-group-item">
                        <b>Fecha de Nacimiento</b> <a class="pull-right">{{ $user->birthdate }}</a>
                    </li>                    
                </ul>
               
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sus Prestamos:</h3>                
            </div>
            <div class="box-body">   
            <ul class="list-group list-group-unbordered">
            @php 
            $indice = 1
            @endphp
                        @foreach ($docs_of_user as $docs_of_use)
                        {!! Form::model($docs_of_user, [
                        'route' => ['admin.FPSocios.store', count($docs_of_user)],   
                        'method' => 'POST'
                        ]) !!}
        <li class="list-group-item">
                    <div class="row"> 
                <div class="col-md-12">
                        <h3 class="profile-username text-center">{{ $docs_of_use->copy->document->id }} - {{ $docs_of_use->copy->document->title }}</h3>
                
                        <p class="text-muted text-center">{{ $docs_of_use->copy->document->creator->creator_name }}</p>
                    </div>
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Prestado el: </b><a class="pull-right">{{ $docs_of_use->created_at->format('d-m-Y') }} </a>
                    </div> 
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>A devolver el: </b><a class="pull-right">{{ $docs_of_use->created_at->addDays(3)->format('d-m-Y') }}</a>
                    </div>
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Dias de retraso: </b><a class="pull-right">{{ $docs_of_use->created_at->addDays(3)->diffInDays(Carbon\Carbon::now()) }}</a>
                    </div> 
                    <div class="col-md-6" style="padding-top: 1rem;">
                        <b>Sancion de:   </b><a class="pull-right"> $ {{ $docs_of_use->created_at->addDays(3)->diffInDays(Carbon\Carbon::now())*10 }}</a>
                    </div>
                     
                    <div class="col-md-6 text-center" style="padding-top: 1rem;">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Devolucion</button> -->
                    <a href="{{ route('FPSocios.vista_devo_reno', ['id' =>  $docs_of_use->id, 'bandera' =>  1 ]) }}" title="Devolver: {{ $docs_of_use->copy->document->title }}" class="btn btn-success modal-show">Devolucion</a>
                    <!-- id="btn-btn-create" class="btn btn-success pull-right modal-show" -->
                     </div>
                    <div class="col-md-6 text-center" style="padding-top: 1rem;">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Renovacion</button> --> 

                    <a href="{{ route('FPSocios.vista_devo_reno', ['id_copy' =>  $docs_of_use->id, 'bandera' =>  2 ]) }}" title="Renovar: {{ $docs_of_use->copy->document->title }}" class="btn btn-success modal-show">Renovacion</a>
                    </div>  
                </div> 
                    </li> 
                   @php 
                   $indice = $indice + 1
                    @endphp
                        @endforeach                                                    
                </ul>   

            </div>
        </div> 
        {!! Form::close() !!}   

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