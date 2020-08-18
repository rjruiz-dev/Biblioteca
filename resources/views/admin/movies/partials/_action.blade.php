
<a href="{{ $url_show }}" class="btn-show" title="Detalle"><i class="fa fa-eye text-primary"></i></a> | 


<a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 

<a href="{{ $url_copy }}" class="btn-copy" title="Ver Copias"><i class="fa fa-copy text-danger"></i></a> |

@if ($movie->document['status_documents_id'] != 3)
        @php 
        @endphp
<a href="{{ $url_desidherata }}" class="btn-desidherata" title="Desidherata"><i class="fa fa-pause-circle"></i></a> | 
        @php 
        @endphp
@endif


@if ($movie->document['status_documents_id'] != 2)
        @php 
        @endphp
        <a href="{{ $url_baja }}" class="btn-baja" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |  
       @php 
        @endphp
@endif 

@if ($movie->document['status_documents_id'] != 1)
        @php 
        @endphp
        <a href="{{ $url_reactivar }}" class="btn-reactivar" title="Reactivar"><i class="fa fa-arrow-up text-green"></i></a> |  
        @php 
        @endphp
@endif 

<a href="{{ $url_print }}" title="Imprimir: {{ $movie->document['title'] }}"><i class="fa fa-download text-success"></i></a> |  





