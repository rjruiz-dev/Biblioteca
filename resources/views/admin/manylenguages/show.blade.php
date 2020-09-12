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
                    <!-- Publ. periodica -->
                    <li id="ls_tema" class="list-group-item">
                    @if ( $book->subtitle === NULL )   
                        <b>Tema de Portada:</b> <a class="pull-right"><p class="tex-muted">Sin Tema de Portada</p></a>                                                 
                    @else
                        <b>Tema de Portada:</b> <a class="pull-right">{{ $book->subtitle }}</a>
                    @endif 
                    </li>
                    <!-- Publ. periodica  aca va el campo: volume_number_date-->
                    
                    <li class="list-group-item">
                    @if ( $book->document->document_subtype->subtype_name === NULL )   
                        <b>Subtipo del Documento:</b> <a class="pull-right"><p class="tex-muted">Sin Subtipo</p></a>                                                 
                    @else
                        <b>Subtipo del Documento:</b> <a class="pull-right">{{ $book->document->document_subtype->subtype_name }}</a>
                    @endif 
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
                
                <!-- <div class="col-md-12">
                    <strong><i class="fa fa-book margin-r-5"></i> Subtipo del Documento:</strong>    
                    <p class="text-muted">{{ $book->document->document_subtype->subtype_name }}</p>                 
                    <hr>               
                </div> -->

                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Título Original:</strong>
                        @if (  $book->document->original_title === NULL )                            
                            <p class="tex-muted"><a>Sin Título Original</a> </p>
                        @else                           
                            <p class="text-muted">{{ $book->document->original_title }}</p>
                        @endif                          
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i>Subtítulo:</strong>
                        @if ( $book->subtitle === NULL )                            
                            <p class="tex-muted"><a>Sin Subtítulo</a> </p>
                        @else
                            <p class="text-muted">{{ $book->subtitle }}</p>
                        @endif                     
                        <hr>
                    </div>

                    <!-- Pub. Periodica -->
                    <div class="col-md-4">
                        <strong><i class="fa fa-users margin-r-5"></i>Otros Autores:</strong>
                        @if ( $book->document->made_by === NULL )                            
                            <p class="tex-muted"><a>No Tiene Otros Autores</a> </p>
                        @else
                            <p class="text-muted">{{ $book->document->made_by }}</p>
                        @endif                     
                        <hr>
                    </div>                   
                </div>
                
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Publicado En:</strong>
                        @if (  $book->document->published === NULL )                            
                            <p class="tex-muted"><a>Sin Lugar de Publicación</a> </p>
                        @else                           
                            <p class="text-muted">{{ $book->document->published }}</p>
                        @endif                          
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="fa fa-info margin-r-5"></i> Editorial:</strong>
                        @if ( $book->document->made_by === NULL )                            
                            <p class="tex-muted"><a>Sin Editorial</a> </p>
                        @else
                            <p class="text-muted">{{ $book->document->made_by }}</p>
                        @endif                     
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> Año:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($book->document->year)->format('d-m-Y') }}</p>
                        <hr>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> Idioma:</strong>
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
                    <h3 class="box-title">Detalles del Documento </h3>
                </div>
                <div class="box-body"> 

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> Volúmen:</strong>
                            @if ( $book->document->volume === NULL )                             
                                <p class="tex-muted"><a>Sin Volúmen</a> </p>
                            @else
                                <p class="text-muted">{{  $book->document->volume }}</p>
                            @endif                              
                            <hr>
                        </div>                        
                        <div class="col-md-6">
                            <strong><i class="fa fa-calendar margin-r-5"></i> Disponible Desde:</strong>
                            <p class="text-muted">{{ Carbon\Carbon::parse($book->document->acquired)->format('d-m-Y') }}</p>
                            <hr>
                        </div>                                         
                    </div>

                    <div class="row col-md-12">                                
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> Número de Paginas:</strong>
                            @if ( $book->document->quantity_generic === NULL )                                
                                <p class="tex-muted"><a>Sin Número de Paginas</a> </p>
                            @else
                                <p class="text-muted">{{ $book->document->quantity_generic }}</p>
                            @endif                             
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-book margin-r-5"></i> Tamaño:</strong>
                            @if ( $book->size === NULL )                                
                                <p class="tex-muted"><a>Sin Tamaño</a> </p>
                            @else
                                <p class="text-muted">{{  $book->size }}</p>
                            @endif
                            <hr>
                        </div>
                    </div>      
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> Adecuado Para:</strong>
                            @if ( $book->document->adequacy['adequacy_description'] === NULL )                                
                                <p class="tex-muted"><a>Sin Adecuación</a> </p>
                            @else
                            <p class="text-muted">{{ $book->document->adequacy['adequacy_description'] }}</p>
                            @endif  
                          
                            <hr>
                        </div>  
                        <div class="col-md-6">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> Valoración:</strong>
                            @if ( $book->document->assessment === NULL )                                
                                <p class="tex-muted"><a>Sin Valoración</a> </p>
                            @else
                                <p class="text-muted">{{ $book->document->assessment }}</p>
                            @endif                           
                            <hr>
                        </div>
                    </div>

                    <div class="row col-md-12">          
                        <div class="col-md-12">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación:</strong>
                            @if ( $book->document->location === NULL )                            
                                <p class="tex-muted"><a>Sin Ubicación:</a> </p>
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
                        <strong><i class="fa fa-file-text margin-r-5"></i> Sinopsis:</strong>
                        @if ( $book->document->synopsis === NULL )                            
                            <p class="tex-muted"><a>Sin Sinopsis:</a> </p>
                        @else
                            <p class="text-muted">{!! $book->document->synopsis !!}</p>
                        @endif   
                       
                        <hr>
                    </div>
                </div>
                @if( auth()->user()->getRoleNames() == 'Admin' ||  auth()->user()->getRoleNames() == 'Librarian') 
                @php                        
                    $visible = "display:none"
                @endphp
                @else
                    @php  
                        $visible = ""
                    @endphp
                @endif 
                <div class="col-md-12" >  
                    <button type="button" class="btn btn-danger btn-flat btn-block" style="{{{ $visible }}}" id="loan"><i class="fa fa-share-square-o"></i>&nbsp;Solicitar Prestamo</button>
                </div>
            </div>       
          </div>
    </div>

</div>

<script>
  $('#loan').css('display', 'none');
</script>
