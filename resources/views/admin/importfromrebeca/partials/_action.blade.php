@if($documentos['document_types_id'] != 100)
<a class="modal-show edit" id="btn-btn-edit" value="{{ $documentos->id }}" title="Re-Asignar Tipo de Documento: {{ $documentos->id }}"><i class="fa fa-list text-success btn-btn-edit-user"></i> </a> 

@if($documentos['document_types_id'] == 1)
<a href="/admin/music/indexsolo/{{ $documentos->id }}/n" title="Edicion de Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif
@if($documentos['document_types_id'] == 2)
<a href="/admin/movies/indexsolo/{{ $documentos->id }}/n" title="Edicion de Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif
@if($documentos['document_types_id'] == 3)
<a href="/admin/books/indexsolo/{{ $documentos->id }}/n" title="Edicion de Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif
@if($documentos['document_types_id'] == 4)
<a href="/admin/multimedias/indexsolo/{{ $documentos->id }}/n" title="Edicion de Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif
@if($documentos['document_types_id'] == 5)
<a href="/admin/photographs/indexsolo/{{ $documentos->id }}/n" title="Edicion de Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif

@else
<a class="modal-show edit" id="btn-btn-edit" value="{{ $documentos->id }}" title="Asignar Tipo a Documento: {{ $documentos->id }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> 
@endif    

