

    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-edit text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_edit_maintenance }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Mantenimiento"><i class="fa fa-wrench text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_edit_list }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Listado"><i class="fa fa-list text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_edit_statistic }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Estadistica"><i class="fa fa-bar-chart text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_library_profile }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Perfil Biblioteca"><i class="fa fa-gears text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_loan }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Gestion"><i class="fa fa-th-large text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_loan_repayment }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Prestamos Devoluciones"><i class="fa fa-retweet text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_send_letter }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Enviar Reclamos"><i class="fa  fa-envelope text-dark btn-btn-edit-user"></i></a> | 
    <a href="{{ $url_edit_partner }}" class="modal-show edit" id="btn-btn-edit" title="Editar: Socios"><i class="fa fa-users text-dark btn-btn-edit-user"></i></a> | 

    


    @if ($idiomas['baja'] == 1)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Reactivar"><i class="fa fa-arrow-up text-green"></i></a> |         
    @endif

    @if ($idiomas['baja'] == 0)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |       
    @endif
        
