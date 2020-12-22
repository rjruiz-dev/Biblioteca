

    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_maintenance }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-wrench text-info btn-btn-edit-user"></i></a> | 

    


    @if ($idiomas['baja'] == 1)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Reactivar"><i class="fa fa-arrow-up text-green"></i></a> |         
    @endif

    @if ($idiomas['baja'] == 0)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |       
    @endif
        
