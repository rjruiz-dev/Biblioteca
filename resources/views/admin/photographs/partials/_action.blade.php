@can('view', $photograph)
|   <a href="{{ $url_show }}" class="btn-show" title="Detalle"><i class="fa fa-eye text-primary"></i></a> | 
@endcan
@can('update', $photograph)
<a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 
@endcan
@can('copy', $photograph)
<a href="{{ $url_copy }}" class="btn-copy" title="Ver Copias"><i class="fa fa-copy text-danger"></i></a> |
@endcan
@if ($photograph->document['status_documents_id'] != 3)
        @can('copy', $photograph)
        <a href="{{ $url_desidherata }}" class="btn-desidherata" title="Desidherata"><i class="fa fa-pause-circle"></i></a> | 
        @endcan       
@endif
@if ($photograph->document['status_documents_id'] != 2)
        @can('status', $photograph)
        <a href="{{ $url_baja }}" class="btn-baja" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |  
        @endcan    
@endif 
@if ($photograph->document['status_documents_id'] != 1)
        @can('status', $photograph)
        <a href="{{ $url_reactivar }}" class="btn-reactivar" title="Reactivar"><i class="fa fa-arrow-up text-green"></i></a> |  
        @endcan 
@endif 
@can('download', $photograph)
   <a href="{{ $url_print }}" title="Imprimir: {{ $photograph->document['title'] }}"><i class="fa fa-download text-success"></i></a> |  
@endcan 

