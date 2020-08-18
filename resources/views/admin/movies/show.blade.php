
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
              <h3 class="box-title">Imagen de Portada </h3>
            </div>        
            <div class="box-body box-profile">
                                          
                <img class="img-responsive" src="{{ asset('/images/'.$movie->document->photo) }}"  alt="{{ $movie->document->title }}" >
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Titulo Original:</b> <a class="pull-right">{{ $movie->document->original_title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Dirigido Por:</b> <a class="pull-right">{{ $movie->document->creator->creator_name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre la Pelicula </h3>
            </div>
            <div class="box-body">
                <!-- <div class="col-md-6">
                    <strong><i class="fa fa-book margin-r-5"></i> Titulo Original:</strong>
                    <p class="text-muted">{{ $movie->document->original_title }}</p>
                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fa fa-user margin-r-5"></i> Dirigido Por:</strong>
                    <p class="text-muted">{{ $movie->document->creator->creator_name }}</p>
                    <hr>
                </div> -->

                <div class="col-md-12">
                    <strong><i class="fa fa-users margin-r-5"></i> Reparto:</strong>
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
                    <p class="text-muted">{{ $reparto }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-info margin-r-5"></i> Nacionalidad:</strong>
                    <p class="text-muted">{{ $movie->document->published }}</p>
                    <hr>
                </div>
<<<<<<< HEAD

                <div class="col-md-4">
                    <strong><i class="fa fa-info margin-r-5"></i> Productora:</strong>
                    <p class="text-muted">{{ $movie->document->made_by }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-info margin-r-5"></i> Distribuidora:</strong>
                    <p class="text-muted">{{ $movie->distributor }}</p>
                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                    <p class="text-muted">{{ $movie->document->year }}</p>
                    <hr>
                </div>

              
                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                    <p class="text-muted">{{ $movie->document->acquired }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa  fa-filter margin-r-5"></i> Género:</strong>
                    <p class="text-muted">{{ $movie->generate_movie->genre_film }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Duración:</strong>
                    <p class="text-muted">{{ $movie->document->quantity_generic }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
=======

                <div class="col-md-4">
                    <strong><i class="fa fa-info margin-r-5"></i> Productora:</strong>
                    <p class="text-muted">{{ $movie->document->made_by }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-info margin-r-5"></i> Distribuidora:</strong>
                    <p class="text-muted">{{ $movie->distributor }}</p>
                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                    <p class="text-muted">{{ $movie->document->year }}</p>
                    <hr>
                </div>

              
                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                    <p class="text-muted">{{ $movie->document->acquired }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa  fa-filter margin-r-5"></i> Género:</strong>
                    <p class="text-muted">{{ $movie->generate_movie->genre_film }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-clock-o margin-r-5"></i> Duración:</strong>
                    <p class="text-muted">{{ $movie->document->quantity_generic }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
                    <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                    <p class="text-muted">{{ $movie->document->lenguage->leguage_description }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                    <p class="text-muted">{{ $movie->document->adequacy->adequacy_description }}</p>
                    <hr>
                </div>

                <div class="col-md-4">
                    <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                    <p class="text-muted">{{ $movie->document->assessment }}</p>
                    <hr>
                </div>

                <div class="col-md-4">               
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                    <p class="text-muted">{{ $movie->document->location }}</p>
                    <hr>
                </div>

                <div class="col-md-12">
<<<<<<< HEAD
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                        <p class="text-muted">{{ $movie->specific_content }}</p>
                        <hr>
                    </div>               
                    <div class="col-md-6">
<<<<<<< HEAD
                        <strong><i class="fa fa-video-camera margin-r-5"></i> Fotografia:</strong>
                        <p class="text-muted">{{ $movie->photography_movie->photography_movies_name }}</p>
                        <hr>
                    </div>
                </div>
                <div class="col-md-12">
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas:</strong>
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
                    <p class="text-muted">{{ $reparto }}</p>
                    <hr>
                </div>

                <div class="col-md-12">
                    <strong><i class="fa fa-quote-left margin-r-5"></i> Observaciones:</strong>
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
                    <p class="text-muted">{{ $reparto }}</p>
                    <hr>
                </div>
                <div class="col-md-12">  
                    <a href="{{ route('requests.solicitud', $movie->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud" title="Solicitar Prestamo" type="button">Solicitud Documento</a>       
                    
            
                </div>
            </div>       
=======
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ $movie->document->year }}</p>
                        <hr>
                    </div>
                </div>           
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $movie->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalles de la Pelicula </h3>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{ $movie->document->acquired }}</p>
                            <hr>
                        </div>                      
                        <div class="col-md-4">
                            <strong><i class="fa  fa-filter margin-r-5"></i> Género:</strong>
                            <p class="text-muted">{{ $movie->generate_movie->genre_film }}</p>
                            <hr>
                        </div> 
                        <div class="col-md-4">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                            <p class="text-muted">{{ $movie->document->adequacy->adequacy_description }}</p>
                            <hr>
                        </div>
                      
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa fa-film margin-r-5"></i> Fotografia:</strong>
                            <p class="text-muted">{{ $movie->photography_movie->photography_movies_name }}</p>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> Duración:</strong>
                            <p class="text-muted">{{ $movie->document->quantity_generic }}</p>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                            <p class="text-muted">{{ $movie->document->assessment }}</p>
                            <hr>
                        </div>                   
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                            <p class="text-muted">{{ $movie->specific_content }}</p>
                            <hr>
                        </div>  
                        <div class="col-md-6">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                            <p class="text-muted">{{ $movie->document->location }}</p>
                            <hr>
                        </div>                      
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-12">
                            <strong><i class="fa fa-info margin-r-5"></i> Sinopsis:</strong>
                            <p class="text-muted">{!! $movie->document->synopsis !!}</p>
                            <hr>
                        </div>       
                    </div>                  
                    <div class="col-md-12">  
                        <button type="button" class="btn btn-danger btn-flat btn-block"><i class="fa fa-share-square-o"></i>&nbsp;Solicitar Prestamo</button>
                    </div>
                </div>       
>>>>>>> parent of 7dea2ed... finish detail book
=======
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                        <p class="text-muted">{{ $movie->specific_content }}</p>
                        <hr>
                    </div>               
                    <div class="col-md-6">
                        <strong><i class="fa fa-video-camera margin-r-5"></i> Fotografia:</strong>
                        <p class="text-muted">{{ $movie->photography_movie->photography_movies_name }}</p>
                        <hr>
                    </div>
                </div>
                <div class="col-md-12">
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas:</strong>
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
                    <p class="text-muted">{{ $reparto }}</p>
                    <hr>
                </div>

                <div class="col-md-12">
                    <strong><i class="fa fa-quote-left margin-r-5"></i> Observaciones:</strong>
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
                    <p class="text-muted">{{ $reparto }}</p>
                    <hr>
                </div>
                <div class="col-md-12">  
                    <a href="{{ route('requests.solicitud', $movie->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud" title="Solicitar Prestamo" type="button">Solicitud Documento</a>       
                    
            
                </div>
            </div>       
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
          </div>
    </div>

</div>

