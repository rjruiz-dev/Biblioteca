@if($multimedia->document['photo'] == null)
    @php
    $url=asset("./images/doc-default.jpg");
    @endphp
@else
    @if(file_exists("./images/". $multimedia->document['photo']))
        @php
        $url=asset("./images/". $multimedia->document['photo']);
        @endphp
    @else
        @php
        $url=asset("./images/doc-default.jpg");  
        @endphp
    @endif
@endif
<div class="row">
<div class="container-fluid"> 
        <div class="row col-md-12" >
            <div class="col-md-3">
                <strong> Siglas Autor:</strong>
                    <b class="tex-muted"><a>{{ $multimedia->document->let_author }}</a> </b>
                <hr>
            </div>
            <div class="col-md-3">
                <strong> Siglas Título:</strong>
                    <b class="text-muted"><a>{{ $multimedia->document->let_title }}</a></b>
                <hr>
            </div>
            <div class="col-md-3">
                <strong> Cdu:</strong>
                    <b class="text-muted"></a>{{ $multimedia->document->subjects->cdu }}</a></b>
                <hr>
            </div>
            <div class="col-md-3">
                <strong> NR:</strong>
                    <b class="text-muted"></a>{{ $multimedia->document->id }}</a></b>
                <hr>
            </div>
        </div>   
    </div>
    <div class="col-md-6">    
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_doc->imagen_de_portada }} </h3>
            </div>        
            <div class="box-body box-profile">
              
                <img class="img-responsive" src="{{$url}}"  alt="{{ $multimedia->document->title }}">
                &nbsp;
                &nbsp;
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{ $idioma_doc->titulo }}:</b> <a class="pull-right">{{ $multimedia->document->title }}</a>
                    </li>
                    <li class="list-group-item" style="overflow:hidden;">
                        <b>{{ $idioma_doc->autor }}:</b> <a class="pull-right">{{ $multimedia->document->creator['creator_name'] }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>  
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $idioma_multimedia->sobre_multimedia }} </h3>
            </div>
            <div class="box-body">
                <div class="row col-md-12">                   
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->nacionalidad }}:</strong>
                        @if ( $multimedia->document->published === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->nacionalidad }}</a> </p>
                        @else                           
                        <p class="text-muted">{{ $multimedia->document->published }}</p>
                        @endif                      
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-info margin-r-5"></i> {{ $idioma_doc->editorial }}:</strong>
                        @if ( $multimedia->document->made_by === NULL )                            
                            <p class="tex-muted"><a>Sin {{ $idioma_doc->editorial }}</a> </p>
                        @else
                        <p class="text-muted">{{ $multimedia->document->made_by }}</p>
                        @endif                       
                        <hr>
                    </div>                    
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <strong><i class="fa fa-globe margin-r-5"></i> {{ $idioma_doc->idioma }}:</strong>
                        <p class="text-muted">{{ $multimedia->document->lenguage['leguage_description'] }}</p>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->anio }}:</strong>
                        <p class="text-muted">&nbsp;&nbsp;&nbsp;{{ Carbon\Carbon::parse($multimedia->document->year)->format('Y') }}</p>
                        <hr>
                    </div>                    
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $idioma_multimedia->detalles_de_multimedia }} </h3>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa fa-calendar margin-r-5"></i> {{ $idioma_doc->disponible_desde }}:</strong>
                            <p class="text-muted">{{ Carbon\Carbon::parse($multimedia->document->acquired)->format('d-m-Y') }}</p>
                            <hr>
                        </div>                        
                        <div class="col-md-4">
                            <strong><i class="fa fa-exclamation-triangle margin-r-5"></i> {{ $idioma_doc->adecuado_para }}:</strong>
                            @if ( $multimedia->document->adequacy['adequacy_description'] === NULL )                                
                                <p class="tex-muted"><a>Sin Adecuación</a> </p>
                            @else
                                <p class="text-muted">{{ $multimedia->document->adequacy['adequacy_description'] }}</p>
                            @endif
                            
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-star-half-empty margin-r-5"></i> {{ $idioma_doc->valoracion }}:</strong>
                            @if ( $multimedia->document->assessment === NULL )                                
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->valoracion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $multimedia->document->assessment }}</p>
                            @endif                       
                            <hr>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong><i class="fa  fa-filter margin-r-5"></i> Páginas:</strong>
                            @if ( $multimedia->document->quantity_generic === NULL )                            
                                <p class="tex-muted"><a>Sin Páginas</a> </p>
                            @else
                                <p class="text-muted">{{ $multimedia->document->quantity_generic }}</p>
                            @endif 
                            <hr>
                        </div>                    
                        <div class="col-md-4">
                            <strong><i class="fa fa-info margin-r-5"></i>{{ $idioma_multimedia->volumen }}:</strong>
                            @if ( $multimedia->document->volume === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_multimedia->volumen }}</a> </p>
                            @else
                                <p class="text-muted">{{ $multimedia->document->volume }}</p>
                            @endif  
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> {{ $idioma_multimedia->edicion }}:</strong>
                            @if ( $multimedia->edition === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_multimedia->edicion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $multimedia->edition }}</p>
                            @endif
                            <hr>
                        </div>
                    </div>
                    <div class="row col-md-12">                      
                        <div class="col-md-12">               
                            <strong><i class="fa fa-map-marker margin-r-5"></i> {{ $idioma_doc->ubicacion }}:</strong>
                            @if ( $multimedia->document->location === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->ubicacion }}</a> </p>
                            @else
                                <p class="text-muted">{{ $multimedia->document->location }}</p>
                            @endif    
                            <hr>
                        </div>
                    </div> 
                    <!-- <div class="row col-md-12">          
                        <div class="col-md-12">               
                            <strong><i class="fa fa-file-text margin-r-5"></i> {{ $idioma_doc->sinopsis }}:</strong>
                            @if ( $multimedia->document->synopsis === NULL )                            
                                <p class="tex-muted"><a>Sin {{ $idioma_doc->sinopsis }}:</a> </p>
                            @else
                                <p class="text-muted">{!! $multimedia->document->synopsis !!}</p>
                            @endif   
                        
                            <hr>
                        </div>
                    </div>                    -->
                    <div class="row col-md-12">                     
                        <label>{{ $label_copia_no_disponible }}</label> 
                        <a href="{{ route('requests.solicitud', $multimedia->document->id) }}" class="btn btn-danger btn-flat btn-block btn-solicitud {{ $disabled }}" title="Solicitar Prestamo" type="button"><i class="fa fa-share-square-o"></i>&nbsp;{{ $idioma_doc->solicitar_prestamo }}</a>
                    </div>
                </div>       
          </div>
    </div>
</div>


   




