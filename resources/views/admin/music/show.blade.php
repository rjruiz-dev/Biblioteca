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
                &nbsp;
                &nbsp;
                <ul class="list-group list-group-unbordered">
                    <!-- Para Popular pasa a ser Titulo y Título de la Obra no va -->
                    <li class="list-group-item">
                        <b>Título de la Obra:</b> <a class="pull-right">{{ $music->document->title }}</a>
                    </li>
                     <!-- Para Popular Título del Disco no va -->
                    <li class="list-group-item">
                    @if ( $music->culture->album_title === NULL )   
                        <b>Título del Disco:</b> <a class="pull-right"><p class="tex-muted">Sin Título del Disco</p></a>                                                 
                    @else
                        <b>Título del Disco:</b> <a class="pull-right">{{ $music->culture->album_title }}</a>
                    @endif 
                    </li>
                    <!-- Para Popular pasa a ser Autor  y Director no va-->
                    <!-- <li class="list-group-item">
                        <b>Autor:</b> <a class="pull-right"></a>
                    </li> -->
                    <li class="list-group-item">
                    @if (  $music->culture->director  === NULL )   
                        <b>Director:</b> <a class="pull-right"><p class="tex-muted">Sin Director</p></a>                                                 
                    @else
                        <b>Director:</b> <a class="pull-right">{{ $music->culture->director }}</a>
                    @endif 
                    </li>
                    <li class="list-group-item">
                    @if ( $music->document->document_subtype->subtype_name === NULL )   
                        <b>Subtipo del Documento:</b> <a class="pull-right"><p class="tex-muted">Sin Subtipo</p></a>                                                 
                    @else
                        <b>Subtipo del Documento:</b> <a class="pull-right">{{ $music->document->document_subtype->subtype_name }}</a>
                    @endif 
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
                <div class="row col-md-12">                 
                    <div class="col-md-6">
                        <strong><i class="fa fa-user margin-r-5"></i> Compositor:</strong>
                        <p class="text-muted">{{ $music->document->creator->creator_name }}</p>
                        <hr>
                    </div>
                    <div class="row col-md-6">
                        <strong><i class="fa fa-users margin-r-5"></i> Orquesta:</strong>  
                        @if (  $music->culture->orchestra === NULL )                            
                            <p class="tex-muted"><a>Sin Orquesta</a> </p>
                        @else
                            <p class="text-muted">{{ $music->culture->orchestra }}</p> 
                        @endif                 
                        <hr>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Editado En:</strong>
                        @if ( $music->document->published === NULL )                            
                            <p class="tex-muted"><a>Sin Edición</a> </p>
                        @else
                            <p class="text-muted">{{ $music->document->published }}</p>
                        @endif    
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> Sello Discográfico:</strong>
                        @if ( $music->document->made_by === NULL )                            
                            <p class="tex-muted"><a>Sin Discográfico</a> </p>
                        @else
                            <p class="text-muted">{{ $music->document->made_by }}</p>
                        @endif  
                        <hr>
                    </div>                  
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
                        <p class="text-muted">{{ $music->document->lenguage->leguage_description }}</p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($music->document->year)->format('d-m-Y') }}</p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa  fa-filter margin-r-5"></i> Género:</strong>
                        <p class="text-muted">{{ $music->generate_music->genre_music }}</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalles de la Musica </h3>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{  Carbon\Carbon::parse($music->document->acquired)->format('d-m-Y') }}</p>
                            <hr>
                        </div>                    
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                            @if ( $music->document->adequacy['adequacy_description'] === NULL )                            
                                <p class="tex-muted"><a>No tiene Adecuación</a> </p>
                            @else
                            <p class="text-muted">{{ $music->document->adequacy['dequacy_description'] }}</p>
                            @endif  
                            
                            <hr>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> Formato:</strong>
                            @if ( $music->generate_format->genre_format === NULL )                            
                                <p class="tex-muted"><a>Sin Formato</a> </p>
                            @else
                                <p class="text-muted">{{ $music->generate_format->genre_format }}</p>
                            @endif  
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> Duración:</strong>
                            @if ( $music->document->quantity_generic === NULL )                            
                                <p class="tex-muted"><a>Sin Duración</a> </p>
                            @else
                                <p class="text-muted">{{ $music->document->quantity_generic }}</p>
                            @endif                            
                            <hr>
                        </div>
                    </div>
              
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                            @if ( $music->document->assessment === NULL )                            
                                <p class="tex-muted"><a>Sin Valoración</a> </p>
                            @else
                                <p class="text-muted">{{ $music->document->assessment }}</p>
                            @endif      
                            <hr>
                        </div>
                        <div class="col-md-6">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                            @if ( $music->document->location === NULL )                            
                                <p class="tex-muted"><a>Sin Ubicación</a> </p>
                            @else
                                <p class="text-muted">{{ $music->document->location }}</p>
                            @endif 
                            <hr>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-12">
                            <strong><i class="fa fa-info margin-r-5"></i> Sinopsis:</strong>
                            @if ( $music->document->synopsis === NULL )                            
                                <p class="tex-muted"><a>Sin Sinopsis</a> </p>
                            @else
                                <p class="text-muted">{!! $music->document->synopsis !!}</p>
                            @endif 
                            <hr>
                        </div>       
                    </div>  
                    <div class="col-md-12">  
                        <a href="{{ route('requests.solicitud', $music->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud" title="Solicitar Prestamo" type="button"><i class="fa fa-share-square-o"></i>&nbsp;Solicitar Prestamo</a>
                    </div>                
                </div>       
          </div>
    </div>
</div>


   




