<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
    {{$Ml_loan_partner->titulo_index_lp}}       
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
                <h3 class="box-title">{{$Ml_loan_partner->seccion_socio}}   <b>{{ $user->membership }}</h3>                
            </div>       
            <div class="box-body box-profile">            
                <div class="text-center">      
                 <img class="profile-user-img img-responsive img-circle" 
                    src="/images/{{ $user->user_photo }}" 
                    alt="{{ $user->name}}"
                    width="100px">                   
                </div>  
                <h3 class="profile-username text-center"><strong>{{ $user->nickname }}</strong></h3>  
        
                <p class="text-muted text-center">{{ $user->name }}, {{ $user->surname }}</p>
           
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item"> 
                        @if ( $user->gender === NULL )       
                            <b>{{$Ml_loan_partner->genero}}</b> <a class="pull-right"><small class="tex-muted">No tiene genero asignado</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->genero}}</b> <a class="pull-right">{{ $user->gender }}</a>                                                    
                        @endif    
                    </li>                     
                    <li class="list-group-item">
                        @if ( $user->birthdate === NULL )       
                            <b>{{$Ml_loan_partner->fecha_nac}}</b> <a class="pull-right"><small class="tex-muted">No tiene fecha de nacimiento asignada</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->fecha_nac}}</b> <a class="pull-right">{{ $user->birthdate }}</a>                                                    
                        @endif                           
                    </li>     
                    <li class="list-group-item">
                        <b>{{$Ml_loan_partner->email}}</b> <a class="pull-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        @if ( $user->phone  === NULL )       
                            <b>{{$Ml_loan_partner->telefono}}</b> <a class="pull-right"><small class="tex-muted">No tiene número de telefono asignado</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->telefono}}</b> <a class="pull-right">{{ $user->phone }}</a>                                                    
                        @endif                        
                    </li> 
                    <li class="list-group-item">
                        @if ( $user->address  === NULL )       
                            <b>{{$Ml_loan_partner->direccion}}</b> <a class="pull-right"><small class="tex-muted">No tiene dirección asignada</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->direccion}}</b> <a class="pull-right">{{ $user->address }}</a>                                                    
                        @endif                      
                    </li> 
                    <li class="list-group-item">
                        @if (  $user->postcode  === NULL )       
                            <b>{{$Ml_loan_partner->cod_postal}}</b> <a class="pull-right"><small class="tex-muted">No tiene codigo postal asignado</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->cod_postal}}</b> <a class="pull-right">{{  $user->postcode }}</a>                                                    
                        @endif                       
                    </li>     
                    <li class="list-group-item">
                        @if (  $user->city  === NULL )       
                            <b>{{$Ml_loan_partner->ciudad}}</b> <a class="pull-right"><small class="tex-muted">No tiene ciudad asignada</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->ciudad}}</b> <a class="pull-right">{{  $user->city }}</a>                                                    
                        @endif                          
                    </li>   
                    <li class="list-group-item">
                        @if ( $user->province  === NULL )       
                            <b>{{$Ml_loan_partner->provincia}}</b> <a class="pull-right"><small class="tex-muted">No tiene provinicia asignada</small></a> 
                        @else
                            <b>{{$Ml_loan_partner->provincia}}</b> <a class="pull-right">{{ $user->province }}</a>                                                    
                        @endif                      
                    </li>     
                </ul>               
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_loan_partner->seccion_prestamo}}</h3>                
            </div>
            <div class="box-body">          
                <ul class="list-group list-group-unbordered">
                    @php 
                        $indice = 1
                    @endphp
                    @forelse ($docs_of_user as $docs_of_use)
                        {!! Form::model($docs_of_user, ['route' => ['admin.fastprocess.store', count($docs_of_user)],'method' => 'POST']) !!}
                    
                        @php  
                            $dif = Carbon\Carbon::parse($docs_of_use->date_until)->diffInDays(Carbon\Carbon::now()); 
                           
                        @endphp
                                <!-- 12-11-2020  >=  13-10-2020  -->
                        @if (Carbon\Carbon::parse($docs_of_use->date_until) >= Carbon\Carbon::now())
                            @php
                                $info = "dias de resto";
                                $color = "text-success";
                                $mostrar_sancion = false;
                                $color_sancion = "";
                                $sancion = "-";
                                $disabled_reno = ''; 
                            @endphp 
                        @else
                            @php
                                $info = $Ml_loan_partner->dias_retraso;
                                $color = "text-danger";
                                $color_sancion = "text-danger";
                                $mostrar_sancion = true;
                                $calculo = ($multa->unit * $dif);
                                $sancion = $multa->fine_description." ".$multa->label." ".$calculo;
                                $disabled_reno = 'disabled';
                            @endphp
                        @endif

                    <li class="list-group-item">
                    <b>{{ $docs_of_use->id }}</b>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="text-center"> 
                                    <img class="img-responsive img-thumbnail" src="/images/{{ $docs_of_use->copy->document->photo }}"  alt="{{ $docs_of_use->copy->document->title }}" width="200" height="200">     
                                </div>
                                <h3 class="profile-username text-center"> <b>{{ $docs_of_use->copy->document->id }} - {{ $docs_of_use->copy->document->title }}</b></h3>
                                <p class="text-muted text-center"> <b>{{$Ml_loan_partner->num_copia." ".$docs_of_use->copy->registry_number }}</b></p>
                                <p class="text-muted text-center"> <b>{{ $docs_of_use->copy->document->creator->creator_name }}</b></p>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>{{$Ml_loan_partner->prestado_el}} </b><a class="pull-right">{{ Carbon\Carbon::parse($docs_of_use->date)->format('d-m-Y') }} </a>
                            </div> 
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>{{$Ml_loan_partner->devolver_el}} </b><a class="pull-right">{{ Carbon\Carbon::parse($docs_of_use->date_until)->format('d-m-Y') }}</a>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                            <b class="{{$color}}">{{ $info }} </b><a class="pull-right {{$color}}">{{ $dif }}</a>
                            </div> 
                            <div class="col-md-6" style="padding-top: 1rem;">
                            <b class="{{$color_sancion}}">{{$Ml_loan_partner->sancion}}   </b><a class="pull-right {{$color_sancion}}">{{ $sancion }}</a>
                            </div>
                            <div class="col-md-6 text-center" style="padding-top: 1rem;">                   
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id' =>  $docs_of_use->copies_id, 'bandera' =>  1, 'fecha' =>  $docs_of_use->date_until ]) }}" title="Devolver: {{ $docs_of_use->copy->document->title }}" class="btn btn-warning modal-show btn-sm"  type="button">{{$Ml_loan_partner->btn_devolver}}</a>
                            </div>
                            <div class="col-md-6 text-center" style="padding-top: 1rem;">
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id_copy' =>  $docs_of_use->copies_id, 'bandera' =>  2, 'fecha' =>  $docs_of_use->date_until ]) }}" title="Renovar: {{ $docs_of_use->copy->document->title }}" class="btn btn-info modal-show btn-sm {{ $disabled_reno }}">{{$Ml_loan_partner->btn_renovar}}</a>
                            </div>  
                        </div> 
                    </li> 
                    @php 
                        $indice = $indice + 1
                    @endphp
                    @empty
                        <li class="list-group-item"> <b>Sin Prestamos Asignados </b></li>                       
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