<div class="row">
    <div class="col-md-6">    
        <div class="box box-primary">        
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $user->name}}">
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                
                <p class="text-muted text-center">{{ $user->surname }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Usuario</b> <a class="pull-right">{{ $user->nickname }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Estado</b> <a class="pull-right">{{ $user->statu['state_description'] }}</a>
                    </li>                                 
                </ul>             
            </div>     
        </div>
    </div>     
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos Personales</h3>
            </div>
            <div class="box-body">
                         
                <ul class="list-group list-group-unbordered"> 
                    <li class="list-group-item">                    
                    @if ( $user->address === NULL )       
                        <b>Direccion</b> <a class="pull-right"><small class="tex-muted">No tiene direccion asignada</small></a> 
                    @else
                        <b>Direccion</b> <a class="pull-right">{{ $user->address}}</a>
                                                 
                    @endif    
                    </li>                     
                    <li class="list-group-item">
                    @if ( $user->postcode === NULL )       
                        <b>Codigo Postal</b> <a class="pull-right"><small class="tex-muted">No tiene codigo postal asignado</small></a> 
                    @else
                        <b>Codigo Postal</b> <a class="pull-right">{{ $user->postcode }}</a>
                    @endif
                    </li> 
                    <li class="list-group-item">
                    @if ( $user->phone === NULL )       
                        <b>Telefono</b> <a class="pull-right"><small class="tex-muted">No tiene telefono asignado</small></a> 
                    @else
                        <b>Telefono</b> <a class="pull-right">{{ $user->phone}}</a>                                                 
                    @endif    
                    </li> 
                </ul>               
            </div>
        </div>
    </div>  
</div>