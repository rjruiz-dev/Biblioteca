<div class="row">
       
    <div  class="col-md-12">
        <nav class="navbar navbar-default navbar-dark ">
            <div class="container-fluid">               
           
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                     
                        <li><a href="#">{{ $book->document->let_author }}</a></li>   
                        <li><a href="#">{{ $book->document->let_title }}</a></li>                        
                        <li><a href="#">{{ $book->document->subjects->cdu }}</a></li>                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li> 
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="col-md-6">    
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_doc->imagen_de_portada }} </h3>
            </div>        
            <div class="box-body box-profile">
                                           
                <img class="img-responsive" src="/images/{{ $book->document->photo }}" alt="{{  $book->title }}">
                &nbsp;
                &nbsp;
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{ $idioma_doc->titulo }}:</b> <a class="pull-right">{{ $book->document->title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ $idioma_doc->autor }}:</b> <a class="pull-right">{{ $book->document->creator->creator_name }}</a>
                    </li>
                    <!-- Publ. periodica -->
                    <li id="ls_tema" class="list-group-item">
                    @if ( $book->subtitle === NULL )   
                        <b>{{ $idioma_book->tema_de_portada }}:</b> <a class="pull-right"><p class="tex-muted">Sin {{ $idioma_book->tema_de_portada }}</p></a>                                                 
                    @else
                        <b>{{ $idioma_book->tema_de_portada }}:</b> <a class="pull-right">{{ $book->subtitle }}</a>
                    @endif 
                    </li>
                    <!-- Publ. periodica  aca va el campo: volume_number_date-->
                    
                    <li class="list-group-item">
                    @if ( $book->document->document_subtype->subtype_name === NULL )   
                        <b>{{ $idioma_doc->subtipo_de_documento }}:</b> <a class="pull-right"><p class="tex-muted">Sin {{ $idioma_doc->subtipo_de_documento }}</p></a>                                                 
                    @else
                        <b>{{ $idioma_doc->subtipo_de_documento }}:</b> <a class="pull-right">{{ $book->document->document_subtype->subtype_name }}</a>
                    @endif 
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_book->sobre_el_documento }} </h3>
            </div>
            <div class="box-body"> 
                
                <!-- <div class="col-md-12">
                    <strong><i class="fa fa-book margin-r-5"></i> Subtipo del Documento:</strong>    
                    <p class="text-muted">{{ $book->document->document_subtype->subtype_name }}</p>                 
                    <hr>               
                </div> -->

                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->titulo_original }}:</strong>
                        @if (  $book->document->original_title === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->titulo_original }}</a> </p>
                        @else                           
                            <p class="text-muted">{{ $book->document->original_title }}</p>
                        @endif                          
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i>{{ $idioma_book->subtitulo }}:</strong>
                        @if ( $book->subtitle === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_book->subtitulo }}</a> </p>
                        @else
                            <p class="text-muted">{{ $book->subtitle }}</p>
                        @endif                     
                        <hr>
                    </div>

                    <!-- Pub. Periodica -->
                    <div class="col-md-4">
                        <strong><i class="fa fa-users margin-r-5"></i>{{ $idioma_book->otros_autores }}:</strong>
                        @if ( $book->document->made_by === NULL )                            
                            <p class="tex-muted"><a>No Tiene {{ $idioma_book->otros_autores }}</a> </p>
                        @else
                            <p class="text-muted">{{ $book->document->made_by }}</p>
                        @endif                     
                        <hr>
                    </div>                   
                </div>
                
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_book->publicado_en }}:</strong>
                        @if (  $book->document->published === NULL )                            
                            <p class="tex-muted"><a>Sin Lugar de Publicación</a> </p>
                        @else                           
                            <p class="text-muted">{{ $book->document->published }}</p>
                        @endif                          
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->editorial }}:</strong>
                        @if ( $book->document->made_by === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->editorial }}</a> </p>
                        @else
                            <p class="text-muted">{{ $book->document->made_by }}</p>
                        @endif                     
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->anio }}:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($book->document->year)->format('d-m-Y') }}</p>
                        <hr>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> {{ $idioma_doc->idioma }}:</strong>
                        <p class="text-muted">{{ $book->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div> 
                    <!-- <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                        <p class="text-muted">{{ $book->isbn }}</p>
                        <hr>
                    </div> -->
                    <!-- Publ. Periodica  Issn-->
                  
                    <!-- Publ. Periodica Periodicidad-->
                  
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $idioma_book->detalles_del_documento }} </h3>
                </div>
                <div class="box-body"> 

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> {{ $idioma_book->volumen }}:</strong>
                            @if ( $book->document->volume === NULL )                             
                                <p class="tex-muted"><a>Sin {{ $idioma_book->volumen }}</a> </p>
                            @else
                                <p class="text-muted">{{  $book->document->volume }}</p>
                            @endif                              
                            <hr>
                        </div>                        
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->disponible_desde }}:</strong>
                            <p class="text-muted">{{ Carbon\Carbon::parse($book->document->acquired)->format('d-m-Y') }}</p>
                            <hr>
                        </div>                                         
                    </div>

                    <div class="row col-md-12">                                
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> {{ $idioma_book->numero_de_paginas }}:</strong>
                            @if ( $book->document->quantity_generic === NULL )                                
                                <p class="tex-muted"><a>Sin {{ $idioma_book->numero_de_paginas }}</a> </p>
                            @else
                                <p class="text-muted">{{ $book->document->quantity_generic }}</p>
                            @endif                             
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> {{ $idioma_book->tamanio }}:</strong>
                            @if ( $book->size === NULL )                                
                                <p class="tex-muted"><a>Sin {{ $idioma_book->tamanio }}</a> </p>
                            @else
                                <p class="text-muted">{{  $book->size }}</p>
                            @endif
                            <hr>
                        </div>
                    </div>      
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> {{ $idioma_doc->adecuado_para }}:</strong>
                            @if ( $book->document->adequacy['adequacy_description'] === NULL )                                
                                <p class="tex-muted"><a>Sin Adecuación</a> </p>
                            @else
                            <p class="text-muted">{{ $book->document->adequacy['adequacy_description'] }}</p>
                            @endif  
                          
                            <hr>
                        </div>  
                        <div class="col-md-6">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> {{ $idioma_doc->valoracion }}:</strong>
                            @if ( $book->document->assessment === NULL )                                
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->valoracion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $book->document->assessment }}</p>
                            @endif                           
                            <hr>
                        </div>
                    </div>

                    <div class="row col-md-12">          
                        <div class="col-md-12">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> {{ $idioma_doc->ubicacion }}:</strong>
                            @if ( $book->document->location === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->ubicacion }}:</a> </p>
                            @else
                                <p class="text-muted">{{ $book->document->location }}</p>
                            @endif                       
                            <hr>
                        </div>
                        
                        <!-- <div class="col-md-4">
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas:</strong>
                            <p class="text-muted"></p>
                            <hr>
                        </div>

                        <div class="col-md-4">
                            <strong><i class="fa fa-quote-left margin-r-5"></i> Observaciones:</strong>
                        
                            <p class="text-muted"></p>
                            <hr>
                        </div> -->
                    </div>

                <div class="row col-md-12">          
                    <div class="col-md-12">               
                        <strong><i class="fa fa-file-text margin-r-5"></i> {{ $idioma_doc->sinopsis }}:</strong>
                        @if ( $book->document->synopsis === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->sinopsis }}:</a> </p>
                        @else
                            <p class="text-muted">{!! $book->document->synopsis !!}</p>
                        @endif   
                       
                        <hr>
                    </div>
                </div>             
                <div class="col-md-12" >  
                    <a href="{{ route('requests.solicitud', $book->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud" title="Solicitar Prestamo" type="button"><i class="fa fa-share-square-o"></i>&nbsp;{{ $idioma_doc->solicitar_prestamo }}</a>
                </div>
            </div>       
          </div>
    </div>
</div>


