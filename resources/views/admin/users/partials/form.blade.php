<div class="row">
{!! Form::model($user, [
    'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',   
    'method' => $user->exists ? 'PUT' : 'POST'
]) !!}
    <div class="col-md-6">
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
                        {!! Form::label('email', 'Email') !!}             
                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                    </div>
                   
                    @if (!$user->exists)
                        @php 
                            $visible = "display:none"
                        @endphp
                    @else
                        @php  
                            $visible = ""
                        @endphp
                    @endif                                

                    <div id="dpassword" class="form-group" style="{{{ $visible }}}">
                        {!! Form::label('password', 'Contraseña') !!}                                                              
                        {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña')) !!}        
                        
                        <span class="help-block">Dejar en blanco para no cambiar la contraseña</span>   
                    </div> 

                     <div id="dpassword_confirmation"  class="form-group" style="{{{ $visible }}}">
                        {!! Form::label('password_confirmation', 'Repite la Contraseña') !!}                                                                     
                        {!! Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Repite la Contraseña')) !!}   
                    </div> 
                    
                    <span class="help-block">La contraseña será generada y enviada al nuevo usuario vía email</span>                 
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Roles</h3>                
            </div>
            <div class="box-body">  
            @role('Admin')              
                @include('admin.users.partials.roles-checkboxes')       
            @else            
                <ul class="list-group">
                    @forelse ($user->roles as $role)
                        <li class="list-group-item">{{ $role->name }}</li>
                    @empty
                        <li class="list-group-item">No tiene roles</li>
                    @endforelse
                </ul>
            @endrole
            </div>
        </div>
        
    </div>    

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos</h3>                
            </div>
            <div class="box-body">
                @role('Admin')              
                    @include('admin.users.partials.permissions-checkboxes') 
                @else      
                    <ul class="list-group">
                        @forelse ($user->permissions as $permission)
                            <li class="list-group-item col-sm-6 widthLi">{{ $permission->name }}</li>
                        @empty
                            <li class="list-group-item ">No tiene permisos</li>
                        @endforelse
                    </ul>
                @endrole     
            </div>
        </div>       
    </div>
{!! Form::close() !!}    
</div>
<style>
    .widthLi
    {
        display: inline-block;
        width: 45%
    }
</style>





  