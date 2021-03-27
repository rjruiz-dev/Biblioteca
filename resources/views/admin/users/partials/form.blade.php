<div class="row">  
    {!! Form::model($user, [
        'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',   
        'method' => $user->exists ? 'PUT' : 'POST',
        'enctype' => 'multipart/form-data'
    ]) !!} 
    {{ csrf_field() }}
    <div class="col-md-4">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_partner->seccion_perfil}}</h3>                
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
                    {!! Form::label('group', $Ml_partner->mod_select_tipo) !!}&nbsp;
                    @if($mostrar_radio_biblio)
                    <label>
                        &nbsp;{!! Form::radio('group', 'Librarian', $rol_lib ? 'checked' : '', ['id' => 'Librarian']) !!} {{$Ml_partner->mod_check_biblio}}                               
                    </label>
                    @endif
                    <label>
                        &nbsp;{!! Form::radio('group', 'Partner', $rol_part ? 'checked' : '', ['id' => 'Partner']) !!} {{$Ml_partner->mod_check_socio}}                        
                    </label>
                </div>
                <div class="form-group" >              
                    {!! Form::label('membership', $Ml_partner->mod_num_user) !!}                    
                    {!! Form::text('membership',  $user->exists ? null : $num_socio, ['class' => 'form-control', 'id' => 'membership', 'placeholder' => 'Número de Socio' ]) !!}
                    <span class="help-block">Número de Usuario Sugerido para Asignar a Nuevo Socio: <strong>{{ $num_socio }}</strong></span>
                </div>

                <div class="form-group">              
                    {!! Form::label('nickname', $Ml_partner->mod_nickname) !!}                    
                    {!! Form::text('nickname', null, ['class' => 'form-control', 'id' => 'nickname', 'placeholder' => 'Nickname']) !!}
                </div>                                           
                <div class="form-group" id="fg_status_id">
                    {!! Form::label('status_id', $Ml_partner->mod_select_estado) !!}
                    {!! Form::select('status_id', $status, $user->status_id, ['class' => 'form-control select2', 'id' => 'status_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('user_photo', $Ml_partner->mod_imagen) }}
                    {{ Form::file('user_photo', ['style' => 'color: transparent']) }}
                    
                </div>
                <div class="form-group">
                    {!! Form::label('email', $Ml_partner->mod_span_email) !!}             
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                </div>
                
                <span class="help-block" style="{{{ $visible_label }}}">La contraseña será generada y enviada al nuevo usuario vía email</span>
         
            </div>
        </div>       
    </div>     
    <div class="col-md-4">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_partner->seccion_personales}}</h3>
            </div>
            <div class="box-body">  
                <div class="form-group">              
                    {!! Form::label('name', $Ml_partner->mod_nombre) !!}                    
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombres']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('surname', $Ml_partner->mod_apellido) !!}                    
                    {!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'placeholder' => 'Apellidos']) !!}
                </div> 
                <div class="form-group" id="fg_gender">
                    {!! Form::label('gender', $Ml_partner->mod_select_genero) !!}
                    {!! Form::select('gender', $genders, null, ['class' => 'form-control select2', 'id' => 'gender', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>           
                      
                <div class="form-group">
                    <label>{{$Ml_partner->mod_fecha_nac}}</label>
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
                    {!! Form::label('password', $Ml_partner->mod_pass) !!}                                                              
                    {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña')) !!}                    
                    <span class="help-block">{{$Ml_partner->mod_span_pass}}</span>   
                </div> 
                <div id="dpassword_confirmation"  class="form-group" style="{{{ $visible }}}">
                    {!! Form::label('password_confirmation', $Ml_partner->mod_repite_pass) !!}                                                                     
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Repite la Contraseña')) !!}   
                </div>                 
                         
            </div>
        </div>       
    </div>
    
    <div class="col-md-4">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_partner->seccion_direccion}}</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('phone', $Ml_partner->mod_telefono) !!}               
                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone',  'placeholder' => 'Teléfono']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', $Ml_partner->mod_direccion) !!}                
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'Dirección', 'placeholder' => 'Dirección']) !!}
                </div>  
                <div class="form-group">
                    {!! Form::label('postcode', $Ml_partner->mod_cod_postal) !!}                
                    {!! Form::text('postcode', null, ['class' => 'form-control', 'id' => 'Código Postal', 'placeholder' => 'Código Postal']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city', $Ml_partner->mod_ciudad) !!}               
                    {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Ciudad']) !!}
                </div> 
                <div class="form-group" id="fg_province">
                    {!! Form::label('province', $Ml_partner->mod_select_provincia) !!}               
                    {!! Form::select('province', $provinces, null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => '', 'style' => 'width:100%;']) !!}           
                </div>        
            </div>
        </div>       
    </div>      

    {!! Form::close() !!}    
</div>
@if (!$user->exists) 
<script>
    $('input[type=radio][name=group]').change(function() {
    if (this.value == 'Librarian') {
        // alert("Librarian");
        $("#status_id").find("option[value='1']").remove(); 
    }
    else if (this.value == 'Partner') {
        // alert("Partner");
        $('#status_id').append('<option value="1">Pendiente</option>');
    }
    });
</script>
@endif