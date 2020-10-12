<div class="row">  
    {!! Form::model($user, [
        'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',   
        'method' => $user->exists ? 'PUT' : 'POST',
        'enctype' => 'multipart/form-data'
    ]) !!} 
    {{ csrf_field() }}
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Perfil</h3>                
            </div>
            <div class="box-body">
                @if (!$user->exists)
                    @php 
                        $visible = "display:none";                        
                        $visible_label = "";    
                    @endphp
                @else
                    @php  
                        $visible = "";               
                        $visible_label = "display:none";
                    @endphp
                @endif   
                <div class="form-group">
                    {!! Form::label('group', 'Seleccione tipo de Usuario:') !!}&nbsp;
                
                    <label>
                        &nbsp;{!! Form::radio('group', '1', $rol_lib ? 'checked' : '') !!} Bibliotecario                               
                    </label>
                    <label>
                        &nbsp;{!! Form::radio('group', '2', $rol_part ? 'checked' : '') !!} Socio                        
                    </label>
                </div>
                <div class="form-group" >              
                    {!! Form::label('membership', 'Número de Usuario') !!}                    
                    {!! Form::text('membership',  $user->exists ? null : $num_socio, ['class' => 'form-control', 'id' => 'membership', 'placeholder' => 'Número de Socio' ]) !!}
                    <span class="help-block">Número de Usuario Sugerido para Asignar a Nuevo Socio: <strong>{{ $num_socio }}</strong></span>
                </div>

                <div class="form-group">              
                    {!! Form::label('nickname', 'Nickname') !!}                    
                    {!! Form::text('nickname', null, ['class' => 'form-control', 'id' => 'nickname', 'placeholder' => 'Nickname']) !!}
                </div>                                           
                <div class="form-group" id="fg_status_id">
                    {!! Form::label('status_id', 'Estado') !!}
                    {!! Form::select('status_id', $status, $user->status_id, ['class' => 'form-control select2', 'id' => 'status_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('user_photo', 'Imagen de Perfil') }}
                    {{ Form::file('user_photo', ['style' => 'color: transparent']) }}
                    
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}             
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                </div>
                
                <span class="help-block" style="{{{ $visible_label }}}">La contraseña será generada y enviada al nuevo usuario vía email</span>
         
            </div>
        </div>       
    </div>     
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos personales</h3>
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
                <div class="form-group" id="fg_gender">
                    {!! Form::label('gender', 'Género') !!}
                    {!! Form::select('gender', $genders, null, ['class' => 'form-control select2', 'id' => 'gender', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>           
                      
                <div class="form-group">
                    <label>Fecha de Nacimiento</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="birthdate"
                            class="form-control pull-right" 
                            value="{{ old('birthdate',  $user->birthdate ?  $user->birthdate->format('d-m-Y') : null) }}" 
                            type="text"
                            id="birthdate"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div>

               
                <div id="dpassword" class="form-group" style="{{{ $visible }}}">
                    {!! Form::label('password', 'Contraseña') !!}                                                              
                    {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña')) !!}                    
                    <span class="help-block">Dejar en blanco para no cambiar la contraseña</span>   
                </div> 
                <div id="dpassword_confirmation"  class="form-group" style="{{{ $visible }}}">
                    {!! Form::label('password_confirmation', 'Repite la Contraseña') !!}                                                                     
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Repite la Contraseña')) !!}   
                </div>                 
                         
            </div>
        </div>       
    </div>
    
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('phone', 'Teléfono') !!}               
                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone',  'placeholder' => 'Teléfono']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Dirección') !!}                
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'Dirección', 'placeholder' => 'Dirección']) !!}
                </div>  
                <div class="form-group">
                    {!! Form::label('postcode', 'Código Postal') !!}                
                    {!! Form::text('postcode', null, ['class' => 'form-control', 'id' => 'Código Postal', 'placeholder' => 'Código Postal']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city', 'Ciudad') !!}               
                    {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Ciudad']) !!}
                </div> 
                <div class="form-group" id="fg_province">
                    {!! Form::label('province', 'Provincia') !!}               
                    {!! Form::select('province', $provinces, null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => '', 'style' => 'width:100%;']) !!}           
                </div>        
            </div>
        </div>       
    </div>      

    {!! Form::close() !!}    
</div>