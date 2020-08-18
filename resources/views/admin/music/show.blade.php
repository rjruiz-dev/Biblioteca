<div class="row">
    <div  class="col-md-12">
        <nav class="navbar navbar-default navbar-dark ">
            <div class="container-fluid">               
           
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                     
                        <li><a href="#">{{ $music->document->let_author }}</a></li>   
                        <li><a href="#">{{ $music->document->let_title }}</a></li>                        
                        <li><a href="#">{{ $music->document->subjects->cdu }}</a></li>                        
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
                <img class="img-responsive" src="/images/{{ $music->document->photo }}"  alt="{{ $music->document->title }}">
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Título de la Obra:</b> <a class="pull-right">{{ $music->document->title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Título del Disco:</b> <a class="pull-right">{{ $music->document->creator->creator_name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Director:</b> <a class="pull-right">{{ $music->document->creator->creator_name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre la Musica</h3>
            </div>
            <div class="box-body">                
                <div class="col-md-12">
                    <strong><i class="fa fa-book margin-r-5"></i> Compositor:</strong>
                    <p class="text-muted">{{ $music->document->original_title }}</p>
                    <hr>
                </div>
                <div class="col-md-12">
                    <strong><i class="fa fa-users margin-r-5"></i> Orquesta:</strong>
                    <!-- @php 
                        $reparto = '';
                        $cantidad = 0;
                    @endphp                
                    @foreach($music->actors as $actor)

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
                    <p class="text-muted">{{ $reparto }}</p> -->
                    <p class="text-muted">{{ $music->culture->orchestra }}</p> 
                    <hr>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Editado En:</strong>
                        <p class="text-muted">{{ $music->document->published }}</p>
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Sello Discográfico:</strong>
                        <p class="text-muted">{{ $music->document->made_by }}</p>
                        <hr>
                    </div>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i>Volumen:</strong>
                        <p class="text-muted">{{  $music->document->volume }}</p>
<<<<<<< HEAD
=======
                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ $music->document->year }}</p>
>>>>>>> parent of 7dea2ed... finish detail book
=======
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
                        <hr>
                    </div>
                </div>

                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                    <p class="text-muted">{{ $music->document->year }}</p>
                    <hr>
<<<<<<< HEAD
                </div>
<<<<<<< HEAD

                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                    <p class="text-muted">{{ $music->document->acquired }}</p>
                    <hr>
                </div>

=======
                </div>

                <div class="col-md-6">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                    <p class="text-muted">{{ $music->document->acquired }}</p>
                    <hr>
                </div>

>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa  fa-filter margin-r-5"></i> Género:</strong>
                        <p class="text-muted">{{ $music->generate_music->genre_music }}</p>
                        <hr>
<<<<<<< HEAD
=======
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{ $music->document->acquired }}</p>
                            <hr>
                        </div>                    
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                            <p class="text-muted">{{ $music->document->adequacy->adequacy_description }}</p>
                            <hr>
                        </div>
>>>>>>> parent of 7dea2ed... finish detail book
=======
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-clock-o margin-r-5"></i> Formato:</strong>
                        <p class="text-muted">{{ $music->generate_format->genre_format }}</p>
                        <hr>
<<<<<<< HEAD
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-clock-o margin-r-5"></i> Duración:</strong>
                        <p class="text-muted">{{ $music->document->quantity_generic }}</p>
                        <hr>
                    </div>
=======
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-clock-o margin-r-5"></i> Duración:</strong>
                        <p class="text-muted">{{ $music->document->quantity_generic }}</p>
                        <hr>
                    </div>
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
                </div>
              
                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $music->document->lenguage->leguage_description }}</p>
                        <hr>
<<<<<<< HEAD
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                        <p class="text-muted">{{ $music->document->adequacy->adequacy_description }}</p>
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                        <p class="text-muted">{{ $music->document->assessment }}</p>
                        <hr>
                    </div>
=======
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                        <p class="text-muted">{{ $music->document->adequacy->adequacy_description }}</p>
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                        <p class="text-muted">{{ $music->document->assessment }}</p>
                        <hr>
                    </div>
>>>>>>> parent of 4970df2... Merge remote-tracking branch 'origin/copia-17-08-20/rodrigo' into copia-17-8-2020-feature/Prestamos
                </div>

                <div class="col-md-12">               
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                    <p class="text-muted">{{ $music->document->location }}</p>
                    <hr>
                </div>

                <!-- <div class="col-md-12">
                    <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                    <p class="text-muted">{{ $music->specific_content }}</p>
                    <hr>
                </div> -->

                <div class="col-md-12">
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas:</strong>
                    @php 
                        $reparto = '';
                        $cantidad = 0;
                    @endphp                
                    @foreach($music->actors as $actor)

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
                    @foreach($music->actors as $actor)

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
                    <button type="button" class="btn btn-danger btn-flat btn-block"><i class="fa fa-share-square-o"></i>&nbsp;Solicitar Prestamo</button>
                </div>
                
            </div>       
          </div>
    </div>

</div>


   




