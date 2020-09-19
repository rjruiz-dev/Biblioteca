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
            <div class="box-header with-border">
                <h3 class="box-title">Documento: <b>{{ $documento->id }}</h3>                
            </div>       
            <div class="box-body box-profile"> 
                <div class="text-center">      
                    <img class="img-responsive img-thumbnail" src="/images/{{ $documento->photo }}"  alt="{{ $documento->title }}"  width="200" height="200">     
                </div>  
                <h3 class="profile-username text-center"><strong>{{ $documento->title }}</strong></h3>          
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
    
    @if($copies_disponibles->count() > 0)
        @php 
        $disabled = '';
        @endphp 
    @else
        @php 
        $disabled = 'disabled';
        @endphp
    @endif
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
        <div class="row"> 
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-2">
                    <b title="Prestados">{{ count($copies_prestadas) }} <i class="fa ion-arrow-right-a text-primary"></i></b>  
                    </div>
                    <div class="col-md-2">
                    <b title="Disponibles">{{ count($copies_disponibles) }} <i class="fa fa-arrow-up text-green"></i></b>  
                    </div>
                    <div class="col-md-2">
                    <b title="De Baja">{{ count($copies_baja) }} <i class="fa fa-arrow-down text-danger"></i></b>  
                    </div>
                    <div class="col-md-2">
                    <b title="En Mantenimiento">{{ count($copies_mantenimiento) }} <i class="fa ion-gear-a text-dark"></i></b>  
                    </div>
                    <div class="col-md-2">
                    <b title="Solicitados">{{ count($copies_solicitadas) }} <i class="fa ion-pull-request text-warning"></i></b>  
                    </div>
                    
                </div>
            </div>
            <div class="col-md-2">              
                <a href="{{ route('loanmanual.abm_prestamo', ['id' =>  $documento->id, 'bandera' =>  0, 'n_mov' =>  0 ]) }}" class="btn btn-success pull-right {{ $disabled }}" title="Nuevo Prestamo"><i class="fa ion-android-add-circle"></i> Prestamo</a>
            </div>        
        </div>
            <div class="box-body">          
                <ul class="list-group list-group-unbordered">
                    @php 
                        $indice = 1
                    @endphp



                    @forelse ($copies_prestadas  as $copie)
                        {!! Form::model($copies_prestadas, ['route' => ['admin.fastprocess.store',  count($copies_prestadas)],'method' => 'POST']) !!}
                    
                        @if (Carbon\Carbon::parse($copie->date_until) < Carbon\Carbon::now())
                            @php
                                $info = "dias de retraso";
                                $color = "text-danger";
                                $color_sancion = "text-danger";
                                $mostrar_sancion = true;
                                $sancion = "TAL COSA";
                            @endphp 
                        @else
                            @php
                                $info = "dias de resto";
                                $color = "text-success";
                                $mostrar_sancion = false;
                                $color_sancion = "";
                                $sancion = "-";
                            @endphp
                        @endif

                        @php  
                        $dif = Carbon\Carbon::parse($copie->date_until)->diffInDays(Carbon\Carbon::now()); 
                        @endphp

                        <li class="list-group-item">
                        <b>{{ $copie->id }}</b>
                        <div class="row"> 
                            <div class="col-md-12">
                                <h3 class="profile-username text-center">N° copia: {{ $copie->copies_id }}</h3>   
                                <p class="text-muted text-center"></p>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>Estado: </b><a class="pull-right">{{ $copie->movement_type->book_status }} </a>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>Prestado a: </b><a class="pull-right">{{ $copie->user->name }} </a>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>Prestado el: </b><a class="pull-right">{{ Carbon\Carbon::parse($copie->date)->format('d-m-Y') }} </a>
                               
                            </div> 
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>A devolver el: </b><a class="pull-right">{{ Carbon\Carbon::parse($copie->date_until)->format('d-m-Y') }}</a>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b class="{{$color}}">{{ $info }} </b><a class="pull-right {{$color}}">{{ $dif }}</a>
                            </div> 
                    
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b class="{{$color_sancion}}">Sancion de:   </b><a class="pull-right {{$color_sancion}}">{{ $sancion }}</a>
                            </div>

                            <div class="col-md-6 text-center" style="padding-top: 1rem;">                   
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id' =>  $copie->copies_id, 'bandera' =>  1, 'fecha' =>  $copie->date_until ]) }}" title="Devolver: {{ $copie->copy->document->title }}" class="btn btn-warning modal-show btn-sm"  type="button">Devolver</a>
                            </div> 
                            <div class="col-md-6 text-center" style="padding-top: 1rem;">
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id_copy' =>  $copie->copies_id, 'bandera' =>  0, 'fecha' =>  $copie->date_until ]) }}" title="Renovar: {{ $copie->copy->document->title }}" class="btn btn-info modal-show btn-sm">Renovar</a>
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

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')   
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/fastprocess.js') }}"></script>  
@endpush