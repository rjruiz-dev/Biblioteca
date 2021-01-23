<div class="row">  
{!! Form::model($user, ['route' => $user->exists ? ['vusers.update', $user->id] : 'vusers.store', 'method' => $user->exists ? 'PUT' : 'POST', 'enctype' => 'multipart/form-data'])  !!}
{{ csrf_field() }}
<div class="col-md-12">
    <div class="box box-primary">
        <div class="pad margin no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <h4><i class="fa fa-info"></i>{{ $ml_registry->titulo_reg }} </h4>
                {{ $ml_registry->info_reg }}
            </div>
        </div> 
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_registry->seccion }}</h3>                
        </div>
              
        <div class="box-body">
            <div class="form-group">              
                {!! Form::label('name', $ml_registry->nombre_reg) !!}                    
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => $ml_registry->nombre_reg]) !!}
            </div>
            <div class="form-group">              
                {!! Form::label('surname', $ml_registry->apellido_reg) !!}                    
                {!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'placeholder' => $ml_registry->apellido_reg]) !!}
            </div>                                
            <div class="form-group">              
                {!! Form::label('nickname', $ml_registry->nickname_reg) !!}                    
                {!! Form::text('nickname', null, ['class' => 'form-control', 'id' => 'nickname', 'placeholder' => $ml_registry->nickname_reg]) !!}
            </div> 
            <div class="form-group">
                {!! Form::label('email', $ml_registry->email_reg) !!}             
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => $ml_registry->email_reg]) !!}
            </div>
            <div class="form-group">
                <label>{{ $ml_registry->fecha_nac_reg }}</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>                      
                    <input name="birthdate"
                        class="form-control pull-right" 
                        value="{{ old('birthdate',  $user->birthdate ?  $user->birthdate->format('d/m/Y') : null) }}" 
                        type="text"
                        id="birthdate"
                        placeholder= "{{ $ml_registry->ph_fecha_nac_reg }}">                       
                </div>                  
            </div>
        </div>
    </div>       
</div>  
{!! Form::close() !!}    
</div>

<!-- @include('web.users.partials._modal')
@push('scripts')  
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endpush -->
