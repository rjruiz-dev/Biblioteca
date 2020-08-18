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
                &nbsp;
                &nbsp;
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
                <div class="row col-md-12">                   
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

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $multimedia->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($multimedia->document->year)->format('d-m-Y') }}</p>
                        <hr>
                    </div>                    
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalles de Multmedia </h3>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{ Carbon\Carbon::parse($multimedia->document->acquired)->format('d-m-Y') }}</p>
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
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa  fa-filter margin-r-5"></i> Páginas:</strong>
                            <p class="text-muted">{{ $multimedia->document->quantity_generic }}</p>
                            <hr>
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
                    <div class="row col-md-12">                      
                        <div class="col-md-12">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                            <p class="text-muted">{{ $multimedia->document->location }}</p>
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


   




