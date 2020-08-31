<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       RECLAMAR PRESTAMOS ATRASADOS       
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Socios</li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">  
    {!! Form::open(['route' => 'admin.claimloans.store','method' => 'POST']) !!}   
    <div class="col-md-2">
    </div>
    <div class="col-md-8">    
        <div class="box box-primary">  
            <div class="box-header with-border">
                <h3 class="box-title">Reclamos</h3>                
            </div>       
            <div class="box-body box-profile">            
            
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item"> 
                    {!! Form::label('model_types', 'Tipo de Modelo') !!}
                                {!! Form::select('model_types', $model_types, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'model_types']) !!}   
                    </li>
            
                    <li class="list-group-item"> 
                                <label>Adquirido</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>                      
                                    <input name="hasta"
                                        class="form-control pull-right"                                                       
                                        value="{{ old('hasta', Carbon\Carbon::now()) }}"                            
                                        type="text"
                                        id="hasta"
                                        placeholder= "Selecciona una Fecha">                       
                    </li>

                    <li class="list-group-item"> 
                    <label>Enviar a: </label>
                    <select name="send_to" id="send_to" class="form-control select2"                           
                            data-placeholder="Seleccione a quien/quienes se enviara el reclamo" style="width: 100%;">
                            <option selected value="9999">Todos</option> 
                    </select>
                </li>
                     <li class="list-group-item"> 
                    
                        <button type="button" name="filter" id="filter" class="btn btn-info">Enviar Mails de Reclamo</button>
                     
                </li>
                    

                </ul>               
            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
    {!! Form::close() !!}    
</div>
  
@stop

@include('admin.fastprocess.partials._modal')


@push('scripts')   
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/fastprocess.js') }}"></script>  
@endpush