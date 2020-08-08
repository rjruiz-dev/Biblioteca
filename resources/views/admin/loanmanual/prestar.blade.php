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
            <div class="box-body" id="form_prestamo">          
                <ul class="list-group list-group-unbordered"> 



    @if ($n_mov == 0)
    {!! Form::model($documento, ['route' => ['admin.loanmanual.update',  $documento->id],'method' => 'PUT']) !!}
        @php
         
      
        $visible = false;
        $var_copy = '';
        $var_user = '';

        @endphp
        @else
        {!! Form::model($prestamo_solicitado, ['route' => ['admin.loanmanual.update',  $documento->id],'method' => 'PUT']) !!}
        @php
      
     
        $visible = true;
        $id_copy = $prestamo_solicitado->copies_id;
        $id_user = $prestamo_solicitado->users_id;
        $var_copy = Form::hidden('copies_id', $id_copy );
        $var_user = Form::hidden('users_id', $id_user );

        @endphp
    @endif           
                    <li class="list-group-item">
                        <b></b>
                        <div class="row"  style="margin: 5px;">
                        {{ Form::hidden('bandera', $bandera,['id' => 'bandera']) }} 
                            <div class="form-group">
                                {!! Form::label('copies_id', 'Número de Registro') !!}
                                {!! Form::select('copies_id', $copies, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'copies_id',  $visible ? 'disabled' : '' ]) !!}
                               
                                {!! $var_copy !!}
                                                        
                            </div>
                            <div class="form-group">
                                {!! Form::label('users_id', 'Usuario') !!} 
                                {!! Form::select('users_id', $users, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'users_id',  $visible ? 'disabled' : '' ]) !!}
                               
                               {!! $var_user !!}

                            </div>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">                               
                                    <b>Nickname</b> <a class="pull-right" id="nickname"></a> 
                                </li>                                   
                                <li class="list-group-item">
                                    <b>Apellido</b> <a class="pull-right" id="surname"></a>  
                                </li>                                 
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right" id="email"></a>
                                </li>  
                                <li class="list-group-item">
                                    <b>Prestamo actuales</b> <a class="pull-right" id="loan"></a>
                                </li>                              
                            </ul>

                            <!-- <div class="form-group">                            
                               {!! Form::label('nickname', 'Nickname', ['id' => 'nickname']) !!} 
                            </div>                         
                            <div class="form-group"> 
                                {!! Form::label('surname', 'Surname', ['id' => 'surname']) !!}                                
                            </div>
                            <div class="form-group">   
                                {!! Form::label('email', 'Email', ['id' => 'email']) !!}                              
                            </div> -->
                           
                            <div class="form-group">
                                {!! Form::label('course_id', 'Curso') !!}
                                {!! Form::select('course_id', $courses, null, ['class' => 'form-control select2', 'id' => 'course_id', 'placeholder' => 'Elija el Curso']) !!}
                            </div>
                            <div class="form-group">
                                <label>Grupo</label>
                                <select name="grupo" style="width:100%;">
                                    <option value="A">A</option> 
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label>Turno</label>
                                <select name="turno" style="width:100%;">
                                    <option value="Dia">Dia</option> 
                                    <option value="Noche">Noche</option>
                                    <option value="Tarde">Tarde</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fecha de Devolución: </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>                      
                                    <input name="acquired"
                                        class="form-control pull-right"                                                       
                                        value="{{ old('acquired', Carbon\Carbon::now()->format('d/m/Y')) }}"                            
                                        type="text"
                                        id="acquired"
                                        placeholder= "Selecciona una Fecha de Devolución">                       
                                </div>                  
                            </div>                
                        </div>                        
                    </li> 
                    <div class="modal-footer" id="modal-footer">                  
                        <button type="submit" class="btn btn-primary" id="modal-btn-save-prestar">Prestar</button>
                    </div>     
                    {!! Form::close() !!}                                                   
                </ul>  
            </div>  
        </div>       
    </div>   
</div>  
@stop




@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">       
@endpush
 

@push('scripts')   
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/prestar.js') }}"></script>  
    
@endpush