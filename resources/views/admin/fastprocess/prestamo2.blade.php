<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
    {{$Ml_loan_document->titulo_index_ld}}
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{$idioma->inicio}}</a></li>
        <li><a href="{{ route('admin.fastprocess.index') }}"><i class="fa fa-retweet"></i>{{$idioma->prest_y_dev.' - '}}<i class="fa fa-folder-open"></i>{{$idioma->pyd_por_doc}}</a></li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">     
    <div class="col-md-6">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};"> 
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_loan_document->seccion_doc}} <b>{{ $documento->id }}</h3>                
            </div>       
            <div class="box-body box-profile"> 
                <div class="text-center">      
                    <img class="img-responsive img-thumbnail" src="/images/{{ $documento->photo }}"  alt="{{ $documento->title }}"  width="200" height="200">     
                </div>  
                <h3 class="profile-username text-center"><strong>{{ $documento->title }}</strong></h3>          
                <p class="text-muted text-center">{{ $documento->creator->creator_name }}</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{$Ml_loan_document->tipo_doc}} </b> <a class="pull-right">{{ $documento->document_type->document_description }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_loan_document->tipo_libro}}</a>
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
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
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
                <a href="{{ route('loanmanual.abm_prestamo', ['id' =>  $documento->id, 'bandera' =>  0, 'n_mov' =>  0 ]) }}" class="btn btn-success pull-right {{ $disabled }}" title="{{$Ml_loan_document->btn_prestamo_ld }}"><i class="fa ion-android-add-circle"></i> {{$Ml_loan_document->btn_prestamo_ld }}</a>
            </div>        
        </div>
            <div class="box-body">          
                <ul class="list-group list-group-unbordered">
                    @php 
                        $indice = 1
                    @endphp


                    
                    @forelse ($copies_prestadas  as $copie)
                        {!! Form::model($copies_prestadas, ['route' => ['admin.fastprocess.store',  count($copies_prestadas)],'method' => 'POST']) !!}

                        @php
                        $fecha_actual = Carbon\Carbon::now(); 
                        $fecha_actual_modificada = date_time_set($fecha_actual, 23, 59, 59);
                        $dif = Carbon\Carbon::parse($copie->date_until)->diffInDays($fecha_actual_modificada); 
                        @endphp
                                  
                        @if (Carbon\Carbon::parse($copie->date_until) >= Carbon\Carbon::now())
                            @php
                                $info = $Ml_loan_document->dias_resto_ld;
                                $color = "text-success";
                                $mostrar_sancion = false;
                                $color_sancion = "";
                                $sancion = "-";
                                $disabled_reno = '';                      
                            @endphp 
                        @else
                            @php
                                $info = $Ml_loan_document->dias_retraso_ld;
                                $color = "text-danger";
                                $color_sancion = "text-danger";
                                $mostrar_sancion = true;
                                $calculo = ($multa->unit * $dif);
                            @endphp
                                @if ($multa->id == 1)
                                    @php
                                    $idioma_multa = $traduccion_multa->economica;
                                    @endphp
                                @else
                                    @php
                                    $idioma_multa = $traduccion_multa->suspension;
                                    @endphp
                                @endif
                                    @php
                                    $sancion = $multa->fine_description." ".$multa->label." ".$calculo;
                                    $disabled_reno = 'disabled'; 
                                    $disabled_reno = '';     
                                    @endphp
                        @endif

                        

                        <li class="list-group-item">
                        <b>{{ $copie->id }}</b>                        
                        <div class="row"> 
                            <div class="col-md-12">
                                <h3 class="profile-username text-center">{{$Ml_loan_document->num_copia_ld." ".$copie->copy->registry_number }}</h3>   
                                <p class="text-muted text-center"></p>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>{{$Ml_loan_document->estado }} </b><a class="pull-right">{{ $copie->movement_type['description_movement'] }} </a>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>{{$Ml_loan_document->prestado_a }} </b> <a class="pull-right">{{ $copie->user['name'] }} </a>
                                <img class="profile-user-img img-responsive img-circle" 
                                                        src="/images/{{ $copie->user['user_photo'] }}" 
                                                        alt="{{ $copie->user['name'] }}"
                                                        width="100px" style="max-height:100px;">
                                                       
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>{{$Ml_loan_document->prestado_ld }} </b><a class="pull-right">{{ Carbon\Carbon::parse($copie->date)->format('d-m-Y') }} </a>
                               
                            </div> 
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b>{{$Ml_loan_document->devolver_ld }}</b><a class="pull-right">{{ Carbon\Carbon::parse($copie->date_until)->format('d-m-Y') }}</a>
                            </div>
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b class="{{$color}}">{{ $info }} </b><a class="pull-right {{$color}}">{{ $dif }}</a>
                            </div> 
                    
                            <div class="col-md-6" style="padding-top: 1rem;">
                                <b class="{{$color_sancion}}">{{$Ml_loan_document->sancion_ld }}   </b><a class="pull-right {{$color_sancion}}">{{ $sancion }}</a>
                            </div>

                            <div class="col-md-6 text-center" style="padding-top: 1rem;">                   
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id' =>  $copie->copies_id, 'bandera' =>  1, 'fecha' =>  $copie->date_until]) }}" title="Devolver: {{ $copie->copy->document->title }}" class="btn btn-warning modal-show btn-sm"  type="button">{{$Ml_loan_document->btn_devolver_ld }}</a>
                            </div> 
                            <div class="col-md-6 text-center" style="padding-top: 1rem;">
                                <a href="{{ route('fastprocess.vista_devo_reno', ['id_copy' =>  $copie->copies_id, 'bandera' =>  0, 'fecha' =>  $copie->date_until]) }}" title="Renovar: {{ $copie->copy->document->title }}" class="btn btn-info modal-show btn-sm {{ $disabled_reno }}">{{$Ml_loan_document->btn_renovar_ld }}</a>
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
