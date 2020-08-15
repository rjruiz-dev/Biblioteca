<div class="row">
    <div class="col-md-6">    
        <div class="box box-primary">        
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $prestamo_solicitado->copy->document['title'] }}">
                <h3 class="profile-username text-center">{{ $prestamo_solicitado->copy->document['title'] }}</h3>
                
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Tipo de Documento</b> <a class="pull-right">{{ $prestamo_solicitado->copy->document->document_type['document_description'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Sub-Tipo de Documento</b> <a class="pull-right">{{ $prestamo_solicitado->copy->document->document_subtype['subtype_name'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Socio Solicitante</b> <a class="pull-right">{{ $prestamo_solicitado->user['nickname'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Fecha de Solicitud</b> <a class="pull-right">{{ $prestamo_solicitado->date }}</a>
                    </li>           
                                    
                </ul>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
            </div>
        <!-- /.box-body -->
        </div>
    </div>     
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Acciones</h3>
            </div>
            <div class="box-body">
                         
                <ul class="list-group list-group-unbordered"> 
                    <li class="list-group-item text-center">                    
                    <a href="{{ route('loanmanual.abm_prestamo', ['id' =>  $prestamo_solicitado->copy->document->id, 'bandera' =>  3, 'n_mov' =>  $prestamo_solicitado->id ]) }}" title="Aceptar Solicitud a: {{ $prestamo_solicitado->user['nickname'] }}" class="btn btn-success"  type="button">Aceptar Solicitud</a>       
                    </li>                      
                </ul> 
                <ul class="list-group list-group-unbordered"> 
                    <li class="list-group-item text-center">                    
                    <a href="{{ route('requests.desestimar', ['id' =>  $prestamo_solicitado->copy->document->id, 'bandera' =>  1 ]) }}" title="Rechazar Solicitud a: {{ $prestamo_solicitado->user['nickname'] }}" class="btn btn-warning"  type="button">Rechazar Solicitud</a>       
                    </li>                     
                </ul>  
                
            </div>
        </div>
    </div>  
</div>
    


