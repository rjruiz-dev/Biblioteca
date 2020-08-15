<a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $photograph->document['title'] }}"><i class="fa fa-eye text-primary"></i></a> | 


<a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $photograph->document['title'] }}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 


<a href="{{ $url_destroy }}" class="btn-delete" title="{{ $photograph->document['title'] }}"><i class="fa fa-trash text-danger"></i></a> |

<a href="{{ $url_print }}" title="Imprimir: {{ $photograph->document['title'] }}"><i class="fa fa-download text-success"></i></a> |  


