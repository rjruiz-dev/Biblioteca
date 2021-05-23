<div class="row">
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">        
            <div class="box-body box-profile"> 
            <div class="text-center">      
                <img class="img-responsive img-thumbnail" src="{{ asset('images/'.$prestamo_solicitado->copy->document->photo) }}"  width="200" height="200">     
            </div>
                <h3 class="profile-username text-center"> <strong>{{ $prestamo_solicitado->copy->document['title'] }}</strong></h3>             
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{$Ml_web_loan->mod_tipo_doc}}</b> <a class="pull-right">{{ $prestamo_solicitado->copy->document->document_type['document_description'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_web_loan->mod_subtipo_doc}}</b> <a class="pull-right">{{ $prestamo_solicitado->copy->document->document_subtype['subtype_name'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_web_loan->mod_socio}}</b> <a class="pull-right">{{ $prestamo_solicitado->user['nickname'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{$Ml_web_loan->mod_fecha}}</b> <a class="pull-right">{{ $prestamo_solicitado->date }}</a>
                        <b>aa{{$prestamo_solicitado->id}}</b>
                    </li>       
                </ul>
            </div>
        </div>    
        <div class="col-md-6">
            <ul class="list-group list-group-unbordered "> 
                <li class="list-group-item text-center">                    
                    <a href="{{ route('loanmanual.abm_prestamo', ['id' =>  $prestamo_solicitado->copy->document->id, 'bandera' =>  3, 'n_mov' =>  $prestamo_solicitado->id ]) }}" title="Aceptar Solicitud a: {{ $prestamo_solicitado->user['nickname'] }}" class="btn btn-success"  type="button">{{$Ml_web_loan->btn_aceptar}}</a>       
                </li>                      
            </ul> 
        </div>  
        <div class="col-md-6">
            <ul class="list-group list-group-unbordered "> 
                <li class="list-group-item text-center">                    
                    <a href="{{ route('requests.desestimar', ['id' =>  $prestamo_solicitado->copies_id, 'bandera' =>  1 ]) }}" title="Rechazar Solicitud a: {{ $prestamo_solicitado->user['nickname'] }}" class="btn-desestimar btn btn-danger"  type="button">{{$Ml_web_loan->btn_rechazar}}</a>       
                </li>                     
            </ul>  
        </div>  
    </div>  
</div>
  


