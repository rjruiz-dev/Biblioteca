
@if(($copies['status_copy_id'] == 1) || ($copies['status_copy_id'] == 2) || ($copies['status_copy_id'] == 7) )
<a class="modal-show-e" id="btn-btn-edit" title="Editar: {{ $copies->document->title }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a>  
@else
<a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $copies->document->title }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a>  
@endif







