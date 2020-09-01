@can('view', $multimedia)
   <a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $multimedia->document->title }}"><i class="fa fa-eye text-primary"></i></a> | 
@endcan
@can('update', $multimedia)
   <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $multimedia->document->title }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 
@endcan
@can('copy', $multimedia)
   <a href="{{ $url_copy }}" class="btn-copy" title="Ver Ejemplares: {{ $multimedia->document->title }}"><i class="fa fa-copy text-danger"></i></a> |
@endcan
@if ($multimedia->document['status_documents_id'] != 3)
        @can('copy', $multimedia)    
        <a href="{{ $url_desidherata }}" class="btn-desidherata" title="Desidherata: {{ $multimedia->document->title }}"><i class="fa fa-pause-circle text-info"></i></a> | 
        @endcan
@endif
@if ($multimedia->document['status_documents_id'] != 2)
        @can('status', $multimedia)
        <a href="{{ $url_baja }}" class="btn-baja" title="Baja: {{ $multimedia->document->title }}"><i class="fa fa-arrow-down text-danger"></i></a> |  
        @endcan     
@endif 
@if ($multimedia->document['status_documents_id'] != 1)
        @can('status', $multimedia)
        <a href="{{ $url_reactivar }}" class="btn-reactivar" title="Reactivar: {{ $multimedia->document->title }}"><i class="fa fa-arrow-up text-green"></i></a> |  
        @endcan 
@endif 
@can('download', $multimedia)
   <a href="{{ $url_print }}" title="Imprimir: {{ $multimedia->document->title }}"><i class="fa fa-download text-warning"></i></a> 
@endcan 