
|   <a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $movie->document->title }}"><i class="fa fa-eye text-primary"></i></a> | 

@if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $movie->document->title }} "><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 
@endif

@if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
    <a href="{{ $url_copy }}" class="btn-copy" title="Ver Ejemplares: {{ $movie->document->title }}"><i class="fa fa-copy text-danger"></i></a> |
@endif

@if($idd != 'none')

@if ($movie->document['status_documents_id'] != 2)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_baja }}" class="btn-baja" id="id_btn-baja" title="Rechazar Importacion: {{ $movie->document->title }}"><i class="fa fa-arrow-down text-danger"></i></a> |  
        @endif   
@endif 
@if ($movie->document['status_documents_id'] != 1)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_reactivar }}" class="btn-reactivar" id="id_btn-reactivar" title="Aceptar Importacion: {{ $movie->document->title }}"><i class="fa fa-arrow-up text-green"></i></a> |  
        @endif
@endif 
 
@else
 
@if ($movie->document['status_documents_id'] != 3)        
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_desidherata }}" class="btn-desidherata" id="id_btn-desidherata" title="Desidherata: {{ $movie->document->title }}"><i class="fa fa-pause-circle text-info"></i></a> | 
        @endif
@endif
@if ($movie->document['status_documents_id'] != 2)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_baja }}" class="btn-baja" id="id_btn-baja" title="Baja: {{ $movie->document->title }}"><i class="fa fa-arrow-down text-danger"></i></a> |  
        @endif   
@endif 
@if ($movie->document['status_documents_id'] != 1)
        @if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
                <a href="{{ $url_reactivar }}" class="btn-reactivar" id="id_btn-reactivar" title="Reactivar: {{ $movie->document->title }}"><i class="fa fa-arrow-up text-green"></i></a> |  
        @endif
@endif 
 
@if(Auth::user() != null && (Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian') )
   <a href="{{ $url_print }}" id="id_btn-imprimir" title="Imprimir: {{ $movie->document->title }}"><i class="fa fa-download text-warning"></i></a> |
@endif

@endif




