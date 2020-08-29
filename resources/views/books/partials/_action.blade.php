
<a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $book->document->title }}"><i class="fa fa-eye text-primary"></i></a> | 


@if (Auth::user() != null)


<a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $book->document->title }} "><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 

<a href="{{ $url_copy }}" class="btn-copy" title="Ver Ejemplares: {{ $book->document->title }}"><i class="fa fa-copy text-danger"></i></a> |

@endif

@if (Auth::user() != null && $book->document['status_documents_id'] != 3)
        
<a href="{{ $url_desidherata }}" class="btn-desidherata" title="Desidherata: {{ $book->document->title }}"><i class="fa fa-pause-circle text-info"></i></a> | 
        
@endif


@if (Auth::user() != null && $book->document['status_documents_id'] != 2)
        
        <a href="{{ $url_baja }}" class="btn-baja" title="Baja: {{ $book->document->title }}"><i class="fa fa-arrow-down text-danger"></i></a> |  
       
@endif 

@if (Auth::user() != null && $book->document['status_documents_id'] != 1)
        
        <a href="{{ $url_reactivar }}" class="btn-reactivar" title="Reactivar: {{ $book->document->title }}"><i class="fa fa-arrow-up text-green"></i></a> |  
        
@endif 

@if (Auth::user() != null)

<a href="{{ $url_print }}" title="Imprimir: {{ $book->document->title }}"><i class="fa fa-download text-warning"></i></a> 

@endif



