<div class="row">
    <div  class="col-md-12">
        <nav class="navbar navbar-default navbar-dark ">
            <div class="container-fluid">               
           
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                     
                        <li><a href="#">{{ $movie->document->let_author }}</a></li>   
                        <li><a href="#">{{ $movie->document->let_title }}</a></li>                        
                        <li><a href="#">{{ $movie->document->subjects->cdu }}</a></li>                        
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
                                          
                <img class="img-responsive" src="/images/{{ $movie->document->photo }}"  alt="{{ $movie->document->title }}">
                &nbsp;
                &nbsp;
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Título:</b> <a class="pull-right">{{ $movie->document->title }}</a>
                    </li>

                    <li class="list-group-item">
                        @if ( $movie->document->original_title === NULL )   
                            <b>{{ $idioma_doc->titulo_original }}:</b> <a class="pull-right"><p class="tex-muted">Sin {{ $idioma_doc->titulo_original }}</p></a>                                                 
                        @else
                            <b>{{ $idioma_doc->titulo_original }}:</b> <a class="pull-right">{{ $movie->document->original_title }}</a>
                        @endif 
                    </li>                    
                    <li class="list-group-item">
                        <b>{{ $idioma_movie->dirigido_por }}:</b> <a class="pull-right">{{ $movie->document->creator->creator_name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_movie->sobre_la_pelicula }} </h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <strong><i class="fa fa-users margin-r-5"></i> {{ $idioma_movie->reparto }}:</strong>
                    @php 
                        $reparto = '';
                        $cantidad = 0;
                    @endphp                
                    @foreach($movie->actors as $actor)

                        @if($cantidad == 0)

                        @php
                            $reparto = $reparto . $actor->actor_name;
                        @endphp

                        @else

                        @php
                            $reparto = $reparto . ", ". $actor->actor_name;
                        @endphp
                        
                        @endif

                        @php
                            $cantidad = $cantidad + 1 ;
                        @endphp
                        
                    @endforeach 
                    <!-- <p class="text-muted">{{ $reparto }}</p> -->
                    @if ( $reparto == '' )                            
                        <p class="tex-muted"><a>Sin {{ $idioma_movie->reparto }}</a> </p>
                    @else                           
                        <p class="text-muted">{{ $reparto }}</p>
                    @endif  
                    <hr>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->nacionalidad }}:</strong>
                        @if ( $movie->document->published === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->nacionalidad }}</a> </p>
                        @else
                            <p class="text-muted">{{ $movie->document->published }}</p>
                        @endif                       
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_movie->productora }}:</strong>
                        @if ( $movie->document->made_by === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_movie->productora }}</a> </p>
                        @else
                            <p class="text-muted">{{ $movie->document->made_by }}</p>
                        @endif  
                        <hr>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_movie->distribuidora }}:</strong>
                        @if ( $movie->distributor === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_movie->distribuidora }}</a> </p>
                        @else
                            <p class="text-muted">{{ $movie->distributor }}</p>
                        @endif
                        
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->anio }}:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($movie->document->year)->format('d-m-Y') }}</p>
                        <hr>
                    </div>
                </div>           
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-globe margin-r-5"></i> {{ $idioma_doc->idioma }}:</strong>
                        <p class="text-muted">{{ $movie->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa  fa-filter margin-r-5"></i> {{ $idioma_doc->genero }}:</strong>
                        <p class="text-muted">{{ $movie->generate_movie->genre_film }}</p>
                        <hr>
                    </div> 
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $idioma_movie->detalles_de_la_pelicula }} </h3>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->disponible_desde }}:</strong>
                            <p class="text-muted">{{ Carbon\Carbon::parse($movie->document->acquired)->format('d-m-Y') }}</p>
                            <hr>
                        </div>                      
                      
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> {{ $idioma_doc->adecuado_para }}:</strong>
                            @if ( $movie->document->adequacy['adequacy_description'] === NULL )                            
                                <p class="tex-muted"><a>Sin Adecuación</a> </p>
                            @else
                                <p class="text-muted">{{ $movie->document->adequacy['adequacy_description'] }}</p>
                            @endif
                            <hr>
                        </div>
                      
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa fa-film margin-r-5"></i> {{ $idioma_movie->fotografia }}:</strong>
                            <p class="text-muted">{{ $movie->photography_movie['photography_movies_name'] }}</p>
                            @if ( $movie->photography_movie['photography_movies_name'] === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_movie->fotografia }}</a> </p>
                            @else
                                <p class="text-muted">{{ $movie->photography_movie['photography_movies_name'] }}</p>
                            @endif     
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> {{ $idioma_doc->duracion }}:</strong>
                            @if ( $movie->document->quantity_generic === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->duracion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $movie->document->quantity_generic }}</p>
                            @endif                            
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> {{ $idioma_doc->valoracion }}:</strong>
                            @if ( $movie->document->assessment === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->valoracion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $movie->document->assessment }}</p>
                            @endif                            
                            <hr>
                        </div>                   
                    </div>
                    <div class="row col-md-12">
                        <!-- <div class="col-md-6">
                            <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                            <p class="text-muted">{{ $movie->specific_content }}</p>
                            <hr>
                        </div>   -->
                        <div class="col-md-12">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> {{ $idioma_doc->ubicacion }}:</strong>
                            @if ( $movie->document->location  === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->ubicacion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $movie->document->location }}</p>
                            @endif                               
                            <hr>
                        </div>                      
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-12">
                            <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->sinopsis }}:</strong>
                            @if ( $movie->document->synopsis === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->sinopsis }}</a> </p>
                            @else
                                <p class="text-muted">{!! $movie->document->synopsis !!}</p>
                            @endif                               
                            <hr>
                        </div>       
                    </div>                  
                    <div class="col-md-12">  
                        <a href="{{ route('requests.solicitud', $movie->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud" title="Solicitar Prestamo" type="button"><i class="fa fa-share-square-o"></i>&nbsp;{{ $idioma_doc->solicitar_prestamo }}</a>
                    </div>
                </div>       
          </div>
    </div>
</div>