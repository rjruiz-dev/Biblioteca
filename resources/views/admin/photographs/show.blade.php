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
              <h3 class="box-title">{{ $idioma_doc->imagen_de_portada }} </h3>
            </div>        
            <div class="box-body box-profile">
                <img class="img-responsive" src="/images/{{ $photograph->document->photo }}"  alt="{{ $photograph->document->title }}">
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{ $idioma_doc->titulo }}:</b> <a class="pull-right">{{ $photograph->document->title }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ $idioma_doc->autor }}:</b> <a class="pull-right">{{ $photograph->document->creator->creator_name }}</a>
                    </li>
                    <li class="list-group-item">
                    @if ( $photograph->document->document_subtype->subtype_name === NULL )   
                        <b>{{ $idioma_doc->subtipo_de_documento }}:</b> <a class="pull-right"><p class="tex-muted">Sin {{ $idioma_doc->subtipo_de_documento }}</p></a>                                                 
                    @else
                        <b>{{ $idioma_doc->subtipo_de_documento }}:</b> <a class="pull-right">{{ $photograph->document->document_subtype->subtype_name }}</a>
                    @endif 
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_fotografia->detalles_de_la_fotografia }} </h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->disponible_desde }}:</strong>
                        <p class="text-muted">{{ Carbon\Carbon::parse($photograph->document->acquired)->format('d-m-Y') }}</p>
                        <hr>
                    </div>  
                    <div class="col-md-4">
                        <strong><i class="fa fa-globe margin-r-5"></i> {{ $idioma_doc->idioma }}:</strong>
                        <p class="text-muted">{{ $photograph->document->lenguage['leguage_description'] }}</p>
                        @if (  $photograph->document->lenguage['leguage_description']  === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->idioma }}</a> </p>
                        @else
                        <p class="text-muted">{{  $photograph->document->lenguage['leguage_description'] }}</p>
                        @endif 
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> {{ $idioma_doc->adecuado_para }}:</strong>
                        @if ( $photograph->document->adequacy['adequacy_description']  === NULL )                            
                            <p class="tex-muted"><a>Sin Adecuación</a> </p>
                        @else
                        <p class="text-muted">{{ $photograph->document->adequacy['adequacy_description'] }}</p>
                        @endif 
                       
                        <hr>
                    </div>                                       
                </div>
                <div class=" col-md-12">                
                    <strong><i class="fa fa-film margin-r-5"></i> {{ $idioma_doc->formato }}:</strong>
                    @if ( $photograph->generate_format->genre_format  === NULL )                            
                        <p class="tex-muted"><a>Sin {{ $idioma_doc->formato }}</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->generate_format->genre_format }}</p>
                    @endif  
                    <hr>
                </div>
                <div class=" col-md-12">                
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ $idioma_fotografia->notas }}:</strong>
                    @if ( $photograph->document->note  === NULL )                            
                        <p class="tex-muted"><a>Sin {{ $idioma_fotografia->notas }}</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->document->note }}</p>
                    @endif           
                    <hr>
                </div>
                <div class=" col-md-12">
                    <strong><i class="fa fa-quote-left margin-r-5"></i> {{ $idioma_fotografia->observaciones }}:</strong>      
                    @if ( $photograph->document->observation  === NULL )                            
                        <p class="tex-muted"><a>Sin {{ $idioma_fotografia->observaciones }}</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->document->observation }}</p>
                    @endif  
                    <hr>
                </div>
                <div class="col-md-12">               
                    <strong><i class="fa fa-map-marker margin-r-5"></i> {{ $idioma_doc->ubicacion }}:</strong>
                    @if ( $photograph->document->location  === NULL )                            
                        <p class="tex-muted"><a>Sin {{ $idioma_doc->ubicacion }}</a> </p>
                    @else
                        <p class="text-muted">{{ $photograph->document->location }}</p>
                    @endif                               
                    <hr>
                </div>           
                <div class="col-md-12">  
                    <a href="{{ route('requests.solicitud', $photograph->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud" title="Solicitar Prestamo" type="button"><i class="fa fa-share-square-o"></i>&nbsp;{{ $idioma_doc->solicitar_prestamo }}</a>
                </div>
            </div>       
        </div>
    </div>
</div>


   




