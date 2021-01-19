<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
    {{$Ml_manual_loan->titulo_index}}
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
                <h3 class="box-title">{{$Ml_manual_loan->seccion_doc}} <b>{{ $documento->id }}</h3>                
            </div>       
            <div class="box-body box-profile">
                <div class="text-center"> 
                    <img class="img-responsive img-thumbnail" src="/images/{{ $documento->photo }}"  alt="{{ $documento->title }}" width="200" height="200">     
                </div>  
                <h3 class="profile-username text-center"><strong>{{  $documento->title }}</strong></h3>  
             
                <p class="text-muted text-center"><span class="help-block">{{ $documento->creator->creator_name }}</span></p>                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{$Ml_manual_loan->seccion_doc}} </b> <a class="pull-right">{{ $documento->document_type->document_description }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_manual_loan->tipo_libro}}  </b> <a class="pull-right">{{ $documento->document_subtype->subtype_name }}</a>
                    </li>                                        
                </ul>                        
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_manual_loan->seccion_prestamo}}</h3>                
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
                                {!! Form::label('copies_id', $Ml_manual_loan->select_registro) !!}
                                {!! Form::select('copies_id', $copies, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'copies_id',  $visible ? 'disabled' : '', 'style' => 'width:100%;']) !!}
                                {!! $var_copy !!}     
                            </div>
                            <div class="form-group">
                                {!! Form::label('users_id', $Ml_manual_loan->select_usuario) !!} 
                                {!! Form::select('users_id', $users, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'users_id',  $visible ? 'disabled' : '', 'style' => 'width:100%;' ]) !!}
                                {!! $var_user !!}
                            </div>
                            <div class="text-center">     
                                <img id="user_photo" class="profile-user-img img-responsive img-circle" src="">                             
                            </div>
                            &nbsp;
                            <ul class="list-group list-group-unbordered">                           
                                <li class="list-group-item">                               
                                    <b>{{$Ml_manual_loan->nickname}}</b> <a class="pull-right" id="nickname"></a> 
                                </li>                                   
                                <li class="list-group-item">
                                    <b>{{$Ml_manual_loan->apellido}}</b> <a class="pull-right" id="surname"></a>  
                                </li>                                 
                                <li class="list-group-item">
                                    <b>{{$Ml_manual_loan->email}}</b> <a class="pull-right" id="email"></a>
                                </li>  
                                <li class="list-group-item">
                                    <b>{{$Ml_manual_loan->cant_prestamos}}</b> <a class="pull-right" id="loan"></a>
                                </li>                              
                            </ul>
                            <div class="form-group">
                                {!! Form::label('course_id', $Ml_manual_loan->select_curso) !!}
                                {!! Form::select('course_id', $courses, null, ['class' => 'form-control select2', 'id' => 'course_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                            </div>
                            <div class="form-group">
                                <label>{{$Ml_manual_loan->select_grupo}}</label>
                                <select name="grupo" style="width:100%;" id="grupo" class="form-control select2">
                                   
                                    <option value="A">A</option> 
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label>{{$Ml_manual_loan->select_turno}}</label>
                                <select name="turno" style="width:100%;" id="turno" class="form-control select2">
                                    <option value="Dia">Dia</option> 
                                    <option value="Noche">Noche</option>
                                    <option value="Tarde">Tarde</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label>{{$Ml_manual_loan->fecha_prestamo}}</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>                      
                                <input name="acquired"
                                    class="form-control pull-right"                                                       
                                    value="{{ old('acquired', Carbon\Carbon::now()->addDays($hastaprestamo)->format('d-m-Y')) }}"                            
                                    type="text"
                                    id="acquired"
                                    placeholder= "Selecciona una Fecha de Adquisición">                       
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
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush
 

@push('scripts')   
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/prestar.js') }}"></script>  
    
@endpush