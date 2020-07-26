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
                <h3 class="box-title">Datos del prestamo</h3>                
            </div>
            <div class="box-body">          
                <ul class="list-group list-group-unbordered">
               
            {!! Form::model($documento, ['route' => ['loanmanual.prestar',  $documento->id],'method' => 'POST']) !!}
                    <li class="list-group-item">
                        <b></b>
                        <div class="row"  style="margin: 5px;"> 
                        <div class="form-group">
                            {!! Form::label('copy_id', 'Copia') !!}
                            {!! Form::select('copy_id', $copies, null, ['class' => 'form-control select2', 'id' => 'copy_id']) !!}
                         </div>

                        <div class="form-group">
                            {!! Form::label('user_id', 'Usuario') !!}
                            {!! Form::select('user_id', $users, null, ['class' => 'form-control select2', 'id' => 'user_id', 'placeholder' => 'Elija el Socio']) !!}
                         </div>
                         <div class="form-group">
                            {!! Form::label('course_id', 'Curso') !!}
                            {!! Form::select('course_id', $courses, null, ['class' => 'form-control select2', 'id' => 'course_id', 'placeholder' => 'Elija el Curso']) !!}
                         </div>
                         
               
                

                        </div> 
                    </li> 
                    {!! Form::close() !!}                                                   
                </ul>             
            </div>  
        </div>      
        
    </div>   
</div>
  
@stop

@include('admin.fastprocess.partials._modal')


@push('scripts')   
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/prestar.js') }}"></script>  
@endpush