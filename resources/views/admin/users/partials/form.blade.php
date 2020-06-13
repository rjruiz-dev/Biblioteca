<div class="row">
{!! Form::model($user, [
    'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',   
    'method' => $user->exists ? 'PUT' : 'POST'
]) !!}
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos personales</h3>
            </div>
            <div class="box-body">                      
                <div class="form-group">              
                    {!! Form::label('name', 'Nombre') !!}                    
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombre']) !!}
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

                <div id="dpassword" class="form-group">
                    {!! Form::label('password', 'Contraseña') !!}                                                              
                    {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña')) !!}        
                    
                    <!-- <span class="help-block">Dejar en blanco para no cambiar la contraseña</span>    -->
                </div> 

                    <div id="dpassword_confirmation"  class="form-group" >
                    {!! Form::label('password_confirmation', 'Repite la Contraseña') !!}                                                                     
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Repite la Contraseña')) !!}   
                </div> 
                
                <!-- <span class="help-block">La contraseña será generada y enviada al nuevo usuario vía email</span>                  -->
            </div>
        </div>
        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Roles</h3>                
            </div>
            <div class="box-body">  
                      
               
 
            </div>
        </div> -->
        
    </div>    

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('address', 'Dirección') !!}                
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'Dirección', 'placeholder' => 'Dirección']) !!}
                </div>  

                <div class="form-group">
                    {!! Form::label('postcode', 'Código Postal') !!}                
                    {!! Form::text('postcode', null, ['class' => 'form-control', 'id' => 'Código Postal', 'placeholder' => 'Código Postal']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Telefono') !!}               
                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'Telefono',  'placeholder' => 'Telefono']) !!}
                </div>               
            </div>
        </div>       
    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Perfil</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('gender', 'Género') !!}
                    {!! Form::select('gender', $gender, null, ['class' => 'form-control select2', 'id' => 'gender', 'placeholder' => 'Genero']) !!}
                </div>  

                <div class="form-group">
                    {!! Form::label('birthdate', 'Fecha de Nacimiento') !!}                
                    {!! Form::text('birthdate', null, ['class' => 'form-control', 'id' => 'Fecha de Nacimiento', 'placeholder' => 'Fecha de Nacimiento']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('user_photo', 'Imagen de Perfil') !!}               
                    {!! Form::text('user_photo', null, ['class' => 'form-control', 'id' => 'Imagen de Perfil', 'placeholder' => 'Imagen de Perfil']) !!}
                </div>
            </div>
        </div>       
    </div>
{!! Form::close() !!}    
</div>






  