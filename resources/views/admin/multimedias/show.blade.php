<div class="row">
    <div  class="col-md-12">
        <nav class="navbar navbar-default navbar-dark ">
            <div class="container-fluid">               
           
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                     
                        <li><a href="#">{{ $multimedia->document->let_author }}</a></li>   
                        <li><a href="#">{{ $multimedia->document->let_title }}</a></li>                        
                        <li><a href="#">{{ $multimedia->document->subjects->cdu }}</a></li>                        
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
                <img class="img-responsive" src="/images/{{ $multimedia->document->photo }}"  alt="{{ $multimedia->document->title }}">
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Titulo:</b> <a class="pull-right">{{ $multimedia->document->title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Autor:</b> <a class="pull-right">{{ $multimedia->document->creator->creator_name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre Multimedia </h3>
            </div>
            <div class="box-body">
                <!-- <div class="col-md-6">
                    <strong><i class="fa fa-book margin-r-5"></i> Titulo Original:</strong>
                    <p class="text-muted">{{ $multimedia->document->original_title }}</p>
                    <hr>
                </div>

                <div class="col-md-6">
                    <strong><i class="fa fa-user margin-r-5"></i> Dirigido Por:</strong>
                    <p class="text-muted">{{ $multimedia->document->creator->creator_name }}</p>
                    <hr>
                </div> -->

                <!-- <div class="col-md-12">
                    <strong><i class="fa fa-users margin-r-5"></i> Reparto:</strong>
                    @php 
                        $reparto = '';
                        $cantidad = 0;
                    @endphp                
                    @foreach($multimedia->actors as $actor)

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
                </div> -->

                <div class="col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Nacionalidad:</strong>
                        <p class="text-muted">{{ $multimedia->document->published }}</p>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Editorial:</strong>
                        <p class="text-muted">{{ $multimedia->document->made_by }}</p>
                        <hr>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ $multimedia->document->year }}</p>
                        <hr>
                    </div>

                    <div class="col-md-6">
<<<<<<< HEAD
                        <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                        <p class="text-muted">{{ $multimedia->document->acquired }}</p>
=======
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ $multimedia->document->year }}</p>
>>>>>>> parent of 7dea2ed... finish detail book
                        <hr>
                    </div>
                </div>
<<<<<<< HEAD

                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa  fa-filter margin-r-5"></i> Género:</strong>
                        <p class="text-muted">{{ $multimedia->generate_format->genre_format }}</p>
                        <hr>
=======
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{ $multimedia->document->acquired }}</p>
                            <hr>
                        </div>                        
                        <div class="col-md-4">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                            <p class="text-muted">{{ $multimedia->document->adequacy->adequacy_description }}</p>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                            <p class="text-muted">{{ $multimedia->document->assessment }}</p>
                            <hr>
                        </div>
>>>>>>> parent of 7dea2ed... finish detail book
                    </div>
                    
                    <div class="col-md-4">
                            <strong><i class="fa fa-info margin-r-5"></i>Volumen:</strong>
                            <p class="text-muted">{{ $multimedia->document->volume }}</p>
                            <hr>
                        </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-clock-o margin-r-5"></i> Edición:</strong>
                        <p class="text-muted">{{ $multimedia->edition }}</p>
                        <hr>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $multimedia->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                        <p class="text-muted">{{ $multimedia->document->adequacy->adequacy_description }}</p>
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                        <p class="text-muted">{{ $multimedia->document->assessment }}</p>
                        <hr>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">               
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                        <p class="text-muted">{{ $multimedia->document->location }}</p>
                        <hr>
                    </div>
               
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Isbn:</strong>
                        <p class="text-muted">{{ $multimedia->specific_content }}</p>
                        <hr>
                    </div>               
                </div>
                <div class="col-md-12">
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas:</strong>
                    @php 
                        $reparto = '';
                        $cantidad = 0;
                    @endphp                
                    @foreach($multimedia->actors as $actor)

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
                    @foreach($multimedia->actors as $actor)

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


   




