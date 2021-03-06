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
                <h3 class="box-title">Cantidad de Copias Habilitadas: {{ $documento->title }}:</h3>                
            </div>
            <div class="box-body">          
                <ul class="list-group list-group-unbordered">
                    @php 
                        $indice = 1
                    @endphp
                    @forelse ($copies  as $copie)
                        {!! Form::model($copies, ['route' => ['admin.fastprocess.store',  count($copies)],'method' => 'POST']) !!}
                    <li class="list-group-item">
                    <b>{{ $copie->id }}</b>
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