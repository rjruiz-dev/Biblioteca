<div class="row">
    <div  class="col-md-12">
        <nav class="navbar navbar-default navbar-dark ">
            <div class="container-fluid">               
           
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                     
                        <li><a href="#">{{ $photograph->document->let_author }}</a></li>   
                        <li><a href="#">{{ $photograph->document->let_title }}</a></li>                        
                        <li><a href="#">{{ $photograph->document->subjects->cdu }}</a></li>                        
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
                <img class="img-responsive" src="/images/{{ $photograph->document->photo }}"  alt="{{ $photograph->document->title }}">
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Titulo:</b> <a class="pull-right">{{ $photograph->document->title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Autor:</b> <a class="pull-right">{{ $photograph->document->creator->creator_name }}</a>
                    </li>
                    <li class="list-group-item">
                    @if ( $photograph->document->document_subtype->subtype_name === NULL )   
                        <b>Subtipo del Documento:</b> <a class="pull-right"><p class="tex-muted">Sin Subtipo</p></a>                                                 
                    @else
                        <b>Subtipo del Documento:</b> <a class="pull-right">{{ $photograph->document->document_subtype->subtype_name }}</a>
                    @endif 
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detalles de la Fotografia </h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($photograph->document->acquired)->format('d-m-Y') }}</p>
                        <hr>
                    </div>  
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $photograph->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                        @if ( $photograph->document->adequacy->adequacy_description  === NULL )                            
                            <p class="tex-muted"><a>Sin Adecuación</a> </p>
                        @else
                        <p class="text-muted">{{ $photograph->document->adequacy->adequacy_description }}</p>
                        @endif 
                       
                        <hr>
                    </div>                                       
                </div>
                <div class=" col-md-12">                
                    <strong><i class="fa fa-film margin-r-5"></i> Formato:</strong>
                    @if ( $photograph->generate_format->genre_format  === NULL )                            
                        <p class="tex-muted"><a>Sin Formato</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->generate_format->genre_format }}</p>
                    @endif  
                    <hr>
                </div>
                <div class=" col-md-12">                
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas:</strong>
                    @if ( $photograph->document->note  === NULL )                            
                        <p class="tex-muted"><a>Sin Notas</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->document->note }}</p>
                    @endif           
                    <hr>
                </div>
                <div class=" col-md-12">
                    <strong><i class="fa fa-quote-left margin-r-5"></i> Observaciones:</strong>      
                    @if ( $photograph->document->observation  === NULL )                            
                        <p class="tex-muted"><a>Sin Observaciones</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->document->observation }}</p>
                    @endif  
                    <hr>
                </div>
                <div class="col-md-12">               
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                    @if ( $photograph->document->location  === NULL )                            
                        <p class="tex-muted"><a>Sin Ubicación</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->document->location }}</p>
                    @endif                               
                    <hr>
                </div>           
                <div class="col-md-12">  
                    <button type="button" class="btn btn-danger btn-flat btn-block"><i class="fa fa-share-square-o"></i>&nbsp;Solicitar Prestamo</button>
                </div>
            </div>       
        </div>
    </div>
</div>


   




