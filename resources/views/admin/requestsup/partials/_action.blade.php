
 
  
<a href="{{ $url_destroy }}" class="btn-delete" title="Aceptar esta Solicitud de Asociamiento"><i class="fa fa-user-plus text-success"></i></a>  
@if ($usuarios['status_id'] != 2) 
|
<a href="{{ $url_rechazar }}" class="btn-rechazar" title="Rechazar esta Solicitud de Asociamiento"><i class="fa fa-user-times text-danger"></i></a>  
@endif
    

