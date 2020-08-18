<<<<<<< HEAD
=======
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
              <h3 class="box-title">Imagen de Portada </h3>
            </div>        
            <div class="box-body box-profile">
                                          
                <img class="img-responsive" src="{{ asset('images/'.$book->document->photo) }}" >
                &nbsp;
                &nbsp;
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Titulo:</b> <a class="pull-right">{{ $book->document->title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Autor:</b> <a class="pull-right">{{ $book->document->creator->creator_name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tema de Portada:</b> <a class="pull-right">{{ $book->subtitle }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre el Documento </h3>
            </div>
            <div class="box-body"> 
                
                <div class="col-md-12">
                    <strong><i class="fa fa-book margin-r-5"></i> Subtipo del Documento:</strong>
                    <p class="text-muted">{{ $book->document->document_subtype->subtype_name }}</p>
                    <hr>
                </div>

                
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Publicado En:</strong>
                        <p class="text-muted">{{ $book->document->published }}</p>
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Editorial:</strong>
                        <p class="text-muted">{{ $book->document->made_by }}</p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ $book->document->year }}</p>
                        <hr>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $book->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>        
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalles del Documento </h3>
                </div>
                <div class="box-body"> 

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> Volúmen:</strong>
                            <p class="text-muted">{{  $book->document->volume }}</p>
                            <hr>
                        </div>                        
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{ $book->document->acquired }}</p>
                            <hr>
                        </div>                                         
                    </div>

                    <div class="row col-md-12">                                
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> Número de Paginas:</strong>
                            <p class="text-muted">{{ $book->document->quantity_generic }}</p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> Tamaño:</strong>
                            <p class="text-muted">{{ $book->size }}</p>
                            <hr>
                        </div>
                    </div>      
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                            <p class="text-muted">{{ $book->document->adequacy->adequacy_description }}</p>
                            <hr>
                        </div>  
                        <div class="col-md-6">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                            <p class="text-muted">{{ $book->document->assessment }}</p>
                            <hr>
                        </div>
                    </div>

                    <div class="row col-md-12">          
                        <div class="col-md-12">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                            <p class="text-muted">{{ $book->document->location }}</p>
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
                        <strong><i class="fa fa-file-text margin-r-5"></i> Sinopsis:</strong>
                        <p class="text-muted">{!! $book->document->synopsis !!}</p>
                        <hr>
                    </div>
                </div>

                <div class="col-md-12">  
                    <button type="button" class="btn btn-danger btn-flat btn-block"><i class="fa fa-share-square-o"></i>&nbsp;Solicitar Prestamo</button>
                </div>
            </div>       
          </div>
    </div>

</div>
>>>>>>> parent of 7dea2ed... finish detail book
