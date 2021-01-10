

    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_course }}" class="modal-show edit" id="btn-btn-edit" title="Editar"><i class="fa fa-wrench text-info btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_book }}" class="modal-show edit" id="btn-btn-edit" title="Catalogo Libros"><i class="fa fa-book text-info btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_music }}" class="modal-show edit" id="btn-btn-edit" title="Catalogo Musica"><i class="fa fa-music text-info btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_movie }}" class="modal-show edit" id="btn-btn-edit" title="Catalogo Cine"><i class="fa fa-video-camera text-info btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_multimedia }}" class="modal-show edit" id="btn-btn-edit" title="Catalogo Multimedia"><i class="fa fa-youtube-play text-info btn-btn-edit-user"></i></a> | 

    <a href="{{ $url_edit_fotografia }}" class="modal-show edit" id="btn-btn-edit" title="Catalogo Fotografia"><i class="fa fa-photo text-info btn-btn-edit-user"></i></a> | 

    @if ($idiomas['baja'] == 1)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Reactivar"><i class="fa fa-arrow-up text-green"></i></a> |         
    @endif

    @if ($idiomas['baja'] == 0)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |       
    @endif
        
