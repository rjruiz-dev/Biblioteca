
   <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $cursos->course_name }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 

   @if ($cursos['baja'] == 1)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Reactivar"><i class="fa fa-arrow-up text-green"></i></a> |         
   @endif

   @if ($cursos['baja'] == 0)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |       
   @endif

   <a href="{{ $url_deleteCourse }}" class="btn-deleteCourse" title="Eliminar"><i class="fa fa-trash text-danger"></i></a> |       

