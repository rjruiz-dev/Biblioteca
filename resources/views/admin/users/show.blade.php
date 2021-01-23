<div class="row">
    <div class="col-md-6">    
        <div class="box box-primary">        
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/images/{{ $user->user_photo }}" 
                    alt="{{ $user->name}}"
                    width="100px">
                    
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                
                <p class="text-muted text-center">{{ $user->surname }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{$Ml_partner->mod_usuario}}</b> <a class="pull-right">{{ $user->nickname }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_partner->mod_email}}</b> <a class="pull-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_partner->mod_estado}}</b> <a class="pull-right">{{ $user->statu['state_description'] }}</a>
                    </li>           
                                    
                </ul>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
            </div>
        <!-- /.box-body -->
        </div>
    </div>     
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$Ml_partner->seccion_personales}}</h3>
            </div>
            <div class="box-body">
                         
                <ul class="list-group list-group-unbordered"> 
                    <li class="list-group-item">                    
                    @if ( $user->address === NULL )       
                        <b>{{$Ml_partner->mod_info_direccion}}</b> <a class="pull-right"><small class="tex-muted">No tiene direccion asignada</small></a> 
                    @else
                        <b>{{$Ml_partner->mod_info_direccion}}</b> <a class="pull-right">{{ $user->address}}</a>
                                                 
                    @endif    
                    </li>                     
                    <li class="list-group-item">
                    @if ( $user->postcode === NULL )       
                        <b>{{$Ml_partner->mod_info_cod_postal}}</b> <a class="pull-right"><small class="tex-muted">No tiene codigo postal asignado</small></a> 
                    @else
                        <b>{{$Ml_partner->mod_info_cod_postal}}</b> <a class="pull-right">{{ $user->postcode }}</a>
                    @endif
                    </li> 
                    <li class="list-group-item">
                    @if ( $user->phone === NULL )       
                        <b>{{$Ml_partner->mod_info_telefono}}</b> <a class="pull-right"><small class="tex-muted">No tiene telefono asignado</small></a> 
                    @else
                        <b>{{$Ml_partner->mod_info_telefono}}</b> <a class="pull-right">{{ $user->phone}}</a>                                                 
                    @endif    
                    </li> 
                </ul> 
                
            </div>
        </div>
    </div>  
</div>
    


