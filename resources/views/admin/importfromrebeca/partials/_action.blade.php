@if($documentos['document_types_id'] != 100)
<a class="modal-show edit" id="btn-btn-edit" value="{{ $documentos->id }}" title="Re-Asignar Tipo de Documento: {{ $documentos->id }}"><i class="fa fa-list text-success btn-btn-edit-user"></i> </a> 
<a href="/admin/movies/indexsolo/{{ $documentos->id }}/n" title="Edicion de Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@else
<a class="modal-show edit" id="btn-btn-edit" value="{{ $documentos->id }}" title="Asignar Tipo a Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif    

