<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       PRESTAMOS ASIGNADOS       
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
            <div class="box-header with-border">
                <h3 class="box-title">Socio: <b>{{ $user->membership }}</h3>                
            </div>       
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $user->nickname}}">
                <h3 class="profile-username text-center">{{ $user->nickname }}</h3>
                
                <p class="text-muted text-center">{{ $user->name }}</p>
                <p class="text-muted text-center">{{ $user->surname }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item"> 
                        @if ( $user->gender === NULL )       
                            <b>Genero</b> <a class="pull-right"><small class="tex-muted">No tiene genero asignado</small></a> 
                        @else
                            <b>Genero</b> <a class="pull-right">{{ $user->gender }}</a>                                                    
                        @endif    
                    </li>                     
                    <li class="list-group-item">
                        @if ( $user->birthdate === NULL )       
                            <b>Fecha de Nacimiento</b> <a class="pull-right"><small class="tex-muted">No tiene fecha de nacimiento asignada</small></a> 
                        @else
                            <b>Fecha de Nacimiento</b> <a class="pull-right">{{ $user->birthdate }}</a>                                                    
                        @endif                           
                    </li>     
                    <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        @if ( $user->phone  === NULL )       
                            <b>Telefono</b> <a class="pull-right"><small class="tex-muted">No tiene número de telefono asignado</small></a> 
                        @else
                            <b>Telefono</b> <a class="pull-right">{{ $user->phone }}</a>                                                    
                        @endif                        
                    </li> 
                    <li class="list-group-item">
                        @if ( $user->address  === NULL )       
                            <b>Dirección</b> <a class="pull-right"><small class="tex-muted">No tiene dirección asignada</small></a> 
                        @else
                            <b>Dirección</b> <a class="pull-right">{{ $user->address }}</a>                                                    
                        @endif                      
                    </li> 
                    <li class="list-group-item">
                        @if (  $user->postcode  === NULL )       
                            <b>Codigo Postal</b> <a class="pull-right"><small class="tex-muted">No tiene codigo postal asignado</small></a> 
                        @else
                            <b>Codigo Postal</b> <a class="pull-right">{{  $user->postcode }}</a>                                                    
                        @endif                       
                    </li>     
                    <li class="list-group-item">
                        @if (  $user->city  === NULL )       
                            <b>Ciudad</b> <a class="pull-right"><small class="tex-muted">No tiene ciudad asignada</small></a> 
                        @else
                            <b>Ciudad</b> <a class="pull-right">{{  $user->city }}</a>                                                    
                        @endif                          
                    </li>   
                    <li class="list-group-item">
                        @if ( $user->province  === NULL )       
                            <b>Provincia</b> <a class="pull-right"><small class="tex-muted">No tiene provinicia asignada</small></a> 
                        @else
                            <b>Provincia</b> <a class="pull-right">{{ $user->province }}</a>                                                    
                        @endif                      
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
                    @forelse ($docs_of_user as $docs_of_use)
                        {!! Form::model($docs_of_user, ['route' => ['admin.fastprocess.store', count($docs_of_user)],'method' => 'POST']) !!}
                    <li class="list-group-item">
                    <b>{{ $docs_of_use->id }}</b>
                        <div class="row"> 
                            <div class="col-md-12">
                                <h3 class="profile-username text-center"> <b>{{ $docs_of_use->copy->document->id }} - {{ $docs_of_use->copy->document->title }}</b></h3>
                                <p class="text-muted text-center"> <b>{{ $docs_of_use->copy->document->creator->creator_name }}</b></p>
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
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id' =>  $docs_of_use->id, 'bandera' =>  1 ]) }}" title="Devolver: {{ $docs_of_use->copy->document->title }}" class="btn btn-warning modal-show btn-sm"  type="button">Devolver</a>
                            </div>
                            <div class="col-md-6 text-center" style="padding-top: 1rem;">
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id_copy' =>  $docs_of_use->id, 'bandera' =>  2 ]) }}" title="Renovar: {{ $docs_of_use->copy->document->title }}" class="btn btn-info modal-show btn-sm">Renovar</a>
                            </div>  
                        </div> 
                    </li> 
                    @php 
                        $indice = $indice + 1
                    @endphp
                    @empty
                        <li class="list-group-item"> <b>No Prestamos Asignados </b></li>                       
                    @endforelse                                                   
                </ul>             
            </div>  
        </div>      
        {!! Form::close() !!} 
    </div>   
</div>
  
@stop

@include('admin.fastprocess.partials._modal')


@push('scripts')   
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/fastprocess.js') }}"></script>  
@endpush