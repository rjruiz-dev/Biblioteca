
    <a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $usuarios->name}}"><i class="fa fa-eye text-primary"></i></a> | 


    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $usuarios->name}}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 

    @if ($usuarios['status_id'] == 3)
        @php 
        @endphp
        <a href="{{ $url_destroy }}" class="btn-delete" title="Baja"><i class="fa fa-arrow-down text-danger"></i></a> |  
       @php 
        @endphp
    @endif

    @if ($usuarios['status_id'] == 4)
        @php 
        @endphp
        <a href="{{ $url_destroy }}" class="btn-delete" title="Activar"><i class="fa fa-arrow-up text-green"></i></a> |  
       @php 
        @endphp
    @endif 

    

