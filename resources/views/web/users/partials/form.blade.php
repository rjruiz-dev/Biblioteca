<div class="row">  
{!! Form::model($user, ['route' => $user->exists ? ['vusers.update', $user->id] : 'vusers.store', 'method' => $user->exists ? 'PUT' : 'POST', 'enctype' => 'multipart/form-data'])  !!}
{{ csrf_field() }}
<div class="col-md-12">
    <div class="box box-primary">
        <div class="pad margin no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <h4><i class="fa fa-info"></i> Importante:</h4>
                Complete el formulario con los campos solicitados para enviar la solicitud de socio adherente.
            </div>
        </div> 
        <div class="box-header with-border">
            <h3 class="box-title">Datos Personales</h3>                
        </div>
              
        <div class="box-body">
            <div class="form-group">              
                {!! Form::label('name', 'Nombres') !!}                    
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombres']) !!}
            </div>
            <div class="form-group">              
                {!! Form::label('surname', 'Apellidos') !!}                    
                {!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'placeholder' => 'Apellidos']) !!}
            </div>                                
            <div class="form-group">              
                {!! Form::label('nickname', 'Nickname') !!}                    
                {!! Form::text('nickname', null, ['class' => 'form-control', 'id' => 'nickname', 'placeholder' => 'Nickname']) !!}
            </div> 
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}             
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
            </div>
            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>                      
                    <input name="birthdate"
                        class="form-control pull-right" 
                        value="{{ old('birthdate',  $user->birthdate ?  $user->birthdate->format('d/m/Y') : null) }}" 
                        type="text"
                        id="datepicker"
                        placeholder= "Selecciona una Fecha">                       
                </div>                  
            </div>
        </div>
    </div>       
</div>  
{!! Form::close() !!}    
</div>

@include('web.users.partials._modal')
@push('scripts')  
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endpush
