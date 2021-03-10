@if($music->document['photo'] == null)
    @php
    $url=asset("./images/doc-default.jpg");
    @endphp
@else
    @if(file_exists("./images/". $music->document['photo']))
        @php
        $url=asset("./images/". $music->document['photo']);
        @endphp
    @else
        @php
        $url=asset("./images/doc-default.jpg");  
        @endphp
    @endif
@endif
<div class="row">
    <div class="container-fluid"> 
        <div class="row col-md-12" >
            <div class="col-md-3">
                <strong> Siglas Autor:</strong>
                    <b class="tex-muted"><a>{{ $music->document->let_author }}</a> </b>
                <hr>
            </div>
            <div class="col-md-3">
                <strong> Siglas Título:</strong>
                    <b class="text-muted"><a>{{ $music->document->let_title }}</a></b>
                <hr>
            </div>
            <div class="col-md-3">
                <strong> Cdu:</strong>
                    <b class="text-muted"></a>{{ $music->document->subjects->cdu }}</a></b>
                <hr>
            </div>
            <div class="col-md-3">
                <strong> NR:</strong>
                    <b class="text-muted"></a> {{ $music->document->id }}</a></b>
                <hr>
            </div>
        </div>   
    </div>
    <div class="col-md-6">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_doc->imagen_de_portada }} </h3>
            </div>        
            <div class="box-body box-profile">
                <img class="img-responsive" src="{{$url}}"  alt="{{ $music->document->title }}">
                &nbsp;
                &nbsp;
                <ul class="list-group list-group-unbordered">
                    <!-- Para Popular pasa a ser Titulo y Título de la Obra no va -->
                    <li class="list-group-item">
                        <b>{{ $idioma_music->titulo_de_la_obra }}:</b> <a class="pull-right">{{ $music->document->title }}</a>
                    </li>
                     <!-- Para Popular Título del Disco no va -->
                    <li class="list-group-item">
                    @if ( $music->culture['album_title'] === NULL )   
                        <b>Título del Disco:</b> <a class="pull-right"><p class="tex-muted">Sin Título del Disco</p></a>                                                 
                    @else
                        <b>Título del Disco:</b> <a class="pull-right">{{ $music->culture['album_title'] }}</a>
                    @endif 
                    </li>
                    <!-- Para Popular pasa a ser Autor  y Director no va-->
                    <!-- <li class="list-group-item">
                        <b>Autor:</b> <a class="pull-right"></a>
                    </li> -->
                    <li class="list-group-item">
                    @if (  $music->culture['director']  === NULL )   
                        <b>{{ $idioma_music->director }}:</b> <a class="pull-right"><p class="tex-muted">Sin {{ $idioma_music->director }}</p></a>                                                 
                    @else
                        <b>{{ $idioma_music->director }}:</b> <a class="pull-right">{{ $music->culture['director'] }}</a>
                    @endif 
                    </li>
                    <li class="list-group-item">
                    @if ( $music->document->document_subtype->subtype_name === NULL )   
                        <b>{{ $idioma_doc->subtipo_de_documento }}:</b> <a class="pull-right"><p class="tex-muted">Sin {{ $idioma_doc->subtipo_de_documento }}</p></a>                                                 
                    @else
                        <b>{{ $idioma_doc->subtipo_de_documento }}:</b> <a class="pull-right">{{ $music->document->document_subtype->subtype_name }}</a>
                    @endif 
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_music->sobre_la_musica }}</h3>
            </div>
            <div class="box-body">      
                <div class="row col-md-12">                 
                    <div class="col-md-6">
                        <strong><i class="fa fa-user margin-r-5"></i> {{ $idioma_music->compositor }}:</strong>
                        <p class="text-muted">{{ $music->document->creator['creator_name'] }}</p>
                        <hr>
                    </div>
                    <div class="row col-md-6">
                        <strong><i class="fa fa-users margin-r-5"></i> {{ $idioma_music->orquesta }}:</strong>  
                        @if (  $music->culture['orchestra'] === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_music->orquesta }}</a> </p>
                        @else
                            <p class="text-muted">{{ $music->culture['orchestra'] }}</p> 
                        @endif                 
                        <hr>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_music->editado_en }}:</strong>
                        @if ( $music->document->published === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_music->editado_en }}</a> </p>
                        @else
                            <p class="text-muted">{{ $music->document->published }}</p>
                        @endif    
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_music->sello_discofrafico }}:</strong>
                        @if ( $music->document->made_by === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_music->sello_discofrafico }}</a> </p>
                        @else
                            <p class="text-muted">{{ $music->document->made_by }}</p>
                        @endif  
                        <hr>
                    </div>                  
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> {{ $idioma_doc->idioma }}:</strong>
                        <p class="text-muted">{{ $music->document->lenguage['leguage_description'] }}</p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->anio }}:</strong>
                        <p class="text-muted">&nbsp;&nbsp;&nbsp;{{ Carbon\Carbon::parse($music->document->year)->format('Y') }}</p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa  fa-filter margin-r-5"></i> {{ $idioma_doc->genero }}:</strong>
                        <p class="text-muted">{{ $music->generate_music->genre_music }}</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="box box-primary" style="border-color: {{ $setting->skin }};">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $idioma_music->detalles_de_la_musica }} </h3>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->disponible_desde }}:</strong>
                            <p class="text-muted">{{  Carbon\Carbon::parse($music->document->acquired)->format('d-m-Y') }}</p>
                            <hr>
                        </div>                    
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> {{ $idioma_doc->adecuado_para }}:</strong>
                            @if ( $music->document->adequacy['adequacy_description'] === NULL )                            
                                <p class="tex-muted"><a>No tiene Adecuación</a> </p>
                            @else
                            <p class="text-muted">{{ $music->document->adequacy['adequacy_description'] }}</p>
                            @endif  
                            
                            <hr>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> {{ $idioma_doc->formato }}:</strong>
                            @if ( $music->generate_format['genre_format'] === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->formato }}</a> </p>
                            @else
                                <p class="text-muted">{{ $music->generate_format['genre_format'] }}</p>
                            @endif  
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> {{ $idioma_doc->duracion }}:</strong>
                            @if ( $music->document->quantity_generic === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->duracion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $music->document->quantity_generic }}</p>
                            @endif                            
                            <hr>
                        </div>
                    </div>
              
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> {{ $idioma_doc->valoracion }}:</strong>
                            @if ( $music->document->assessment === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->valoracion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $music->document->assessment }}</p>
                            @endif      
                            <hr>
                        </div>
                        <div class="col-md-6">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> {{ $idioma_doc->ubicacion }}:</strong>
                            @if ( $music->document->location === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->ubicacion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $music->document->location }}</p>
                            @endif 
                            <hr>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-12">
                            <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->sinopsis }}:</strong>
                            @if ( $music->document->synopsis === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->sinopsis }}</a> </p>
                            @else
                                <p class="text-muted">{!! $music->document->synopsis !!}</p>
                            @endif 
                            <hr>
                        </div>       
                    </div>  
                    <div class="col-md-12">  
                        <label>{{ $label_copia_no_disponible }}</label>
                        <a href="{{ route('requests.solicitud', $music->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud {{ $disabled }}" title="Solicitar Prestamo" type="button"><i class="fa fa-share-square-o"></i>&nbsp;{{ $idioma_doc->solicitar_prestamo }}</a>
                    </div>                
                </div>       
          </div>
    </div>
</div>


   




