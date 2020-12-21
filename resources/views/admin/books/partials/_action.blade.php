
|   <a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $libros->document->title }}"><i class="fa fa-eye text-primary"></i></a> | 
@if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $libros->document->title }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 
@endif
@if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
    <a href="{{ $url_copy }}" class="btn-copy" title="Ver Ejemplares: {{ $libros->document->title }}"><i class="fa fa-copy text-danger"></i></a> |
@endif

@if($idd != 'none')

@if ($libros->document['status_documents_id'] != 2)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_baja }}" class="btn-baja" value="rechazar" title="Baja: {{ $libros->document->title }}"><i class="fa fa-arrow-down text-danger"></i></a> |  
        @endif
@endif 
@if ($libros->document['status_documents_id'] != 1)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_reactivar }}" class="btn-reactivar"  value="aceptar" title="Reactivar: {{ $libros->document->title }}"><i class="fa fa-arrow-up text-green"></i></a> |  
        @endif 
@endif

@else

@if ($libros->document['status_documents_id'] != 3)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_desidherata }}" class="btn-desidherata" title="Desidherata: {{ $libros->document->title }}"><i class="fa fa-pause-circle text-info"></i></a> | 
        @endif
@endif

@if ($libros->document['status_documents_id'] != 2)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_baja }}" class="btn-baja" title="Baja: {{ $libros->document->title }}"><i class="fa fa-arrow-down text-danger"></i></a> |  
        @endif
@endif 
@if ($libros->document['status_documents_id'] != 1)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_reactivar }}" class="btn-reactivar" title="Reactivar: {{ $libros->document->title }}"><i class="fa fa-arrow-up text-green"></i></a> |  
        @endif 
@endif

@if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
    <a href="{{ $url_print }}" title="Imprimir: {{ $libros->document->title }}"><i class="fa fa-download text-warning"></i></a> 
@endif

@endif
