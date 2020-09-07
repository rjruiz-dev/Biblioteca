<div class="row">
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update', $idioma->id] : 'admin.manylenguages.store',   
    'method' => $idioma->exists ? 'PUT' : 'POST'
]) !!}

{{ csrf_field() }}

    @if (!$idioma->exists)
        @php 
        $visible_status_doc = "display:none";
            $visible_desidherata = "";
        @endphp
    @else
        @php  
        $visible_status_doc = "";
            $visible_desidherata = "display:none";
        @endphp
    @endif       

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Idioma</h3>
                </div>
            </div>            
            <div class="box-body">
                <div class="form-group" > 
                    {!! Form::label('lenguage_description', 'Idioma') !!}                                  
                    {!! Form::text('lenguage_description', $idioma['lenguage_description'] ? $idioma['lenguage_description'] : null, ['class' => 'form-control', 'id' => 'lenguage_description', 'placeholder' => 'Idioma' ]) !!}
                </div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Frontend</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Menu Lateral </h3>
            </div>
            <div class="box-body">
            <div class="form-group">              
                    {!! Form::label('inicio', 'Inicio') !!}                    
                    {!! Form::text('inicio', $ml_dashboard['inicio'] ? $ml_dashboard['inicio'] : null, ['class' => 'form-control', 'id' => 'inicio', 'placeholder' => 'Inicio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('libros', 'Libros') !!}                    
                    {!! Form::text('libros', $ml_dashboard['libros'] ? $ml_dashboard['libros'] : null, ['class' => 'form-control', 'id' => 'libros', 'placeholder' => 'Libros']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cines', 'Cines') !!}                    
                    {!! Form::text('cines', $ml_dashboard['cines'] ? $ml_dashboard['cines'] : null, ['class' => 'form-control', 'id' => 'cines', 'placeholder' => 'Cines']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('musica', 'Musica') !!}                    
                    {!! Form::text('musica', $ml_dashboard['musica'] ? $ml_dashboard['musica'] : null, ['class' => 'form-control', 'id' => 'musica', 'placeholder' => 'Musica']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('fotografia', 'Fotografia') !!}                    
                    {!! Form::text('fotografia', $ml_dashboard['fotografia'] ? $ml_dashboard['fotografia'] : null, ['class' => 'form-control', 'id' => 'fotografia', 'placeholder' => 'Fotografia']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('multimedia', 'Multimedia') !!}                    
                    {!! Form::text('multimedia', $ml_dashboard['multimedia'] ? $ml_dashboard['multimedia'] : null, ['class' => 'form-control', 'id' => 'multimedia', 'placeholder' => 'Multimedia']) !!}
                </div>
            </div>
        </div>       
    </div>    
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cabecera y Pie</h3>                
            </div>
            <div class="box-body">   
            <div class="form-group" >              
                    {!! Form::label('biblioteca', 'Biblioteca') !!}                    
                    {!! Form::text('biblioteca', $ml_dashboard['biblioteca'] ? $ml_dashboard['biblioteca'] : null, ['class' => 'form-control', 'id' => 'biblioteca', 'placeholder' => 'Biblioteca' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('iniciar_sesion', 'Iniciar Sesion') !!}                    
                    {!! Form::text('iniciar_sesion', $ml_dashboard['iniciar_sesion'] ? $ml_dashboard['iniciar_sesion'] : null, ['class' => 'form-control', 'id' => 'iniciar_sesion', 'placeholder' => 'Iniciar Sesion' ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registrarse', 'Registrarse') !!}                  
                    {!! Form::text('registrarse', $ml_dashboard['registrarse'] ? $ml_dashboard['registrarse'] : null, ['class' => 'form-control', 'id' => 'registrarse', 'placeholder' => 'Registrarse']) !!}
                </div>
                <!-- pub periodica -->
                <div class="form-group">               
                    {!! Form::label('navegacion', 'Navegacion') !!}                  
                    {!! Form::text('navegacion', $ml_dashboard['navegacion'] ? $ml_dashboard['navegacion'] : null, ['class' => 'form-control', 'id' => 'navegacion', 'placeholder' => 'Navegacion']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('invitado', 'Invitado') !!} 
                    {!! Form::text('invitado', $ml_dashboard['invitado'] ? $ml_dashboard['invitado'] : null, ['class' => 'form-control', 'id' => 'invitado', 'placeholder' => 'Invitado']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('en_linea', 'En Linea') !!}                    
                    {!! Form::text('en_linea', $ml_dashboard['en_linea'] ? $ml_dashboard['en_linea'] : null, ['class' => 'form-control', 'id' => 'en_linea', 'placeholder' => 'En Linea']) !!}
                </div>
            </div>
        </div>       
    </div>  
    <!-- <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pie</h3>                
            </div>
            <div class="box-body">   
            <div class="form-group" >              
                    {!! Form::label('biblioteca', 'Biblioteca') !!}                    
                    {!! Form::text('biblioteca', $ml_dashboard['biblioteca'] ? $ml_dashboard['biblioteca'] : null, ['class' => 'form-control', 'id' => 'biblioteca', 'placeholder' => 'Biblioteca' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('iniciar_sesion', 'Iniciar Sesion') !!}                    
                    {!! Form::text('iniciar_sesion', $ml_dashboard['iniciar_sesion'] ? $ml_dashboard['iniciar_sesion'] : null, ['class' => 'form-control', 'id' => 'iniciar_sesion', 'placeholder' => 'Iniciar Sesion' ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registrarse', 'Registrarse') !!}                  
                    {!! Form::text('registrarse', $ml_dashboard['registrarse'] ? $ml_dashboard['registrarse'] : null, ['class' => 'form-control', 'id' => 'registrarse', 'placeholder' => 'Registrarse']) !!}
                </div>

                <div class="form-group">               
                    {!! Form::label('navegacion', 'Navegacion') !!}                  
                    {!! Form::text('navegacion', $ml_dashboard['navegacion'] ? $ml_dashboard['navegacion'] : null, ['class' => 'form-control', 'id' => 'navegacion', 'placeholder' => 'Navegacion']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('invitado', 'Invitado') !!} 
                    {!! Form::text('invitado', $ml_dashboard['invitado'] ? $ml_dashboard['invitado'] : null, ['class' => 'form-control', 'id' => 'invitado', 'placeholder' => 'Invitado']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('en_linea', 'En Linea') !!}                    
                    {!! Form::text('en_linea', $ml_dashboard['en_linea'] ? $ml_dashboard['en_linea'] : null, ['class' => 'form-control', 'id' => 'en_linea', 'placeholder' => 'En Linea']) !!}
                </div>
            </div>
        </div>       
    </div>   -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Documento</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">      
        <div class="box box-primary">                   
            <div class="box-body">   
                <div class="form-group">               
                    {!! Form::label('tipo_doc', 'Tipo') !!}                  
                    {!! Form::text('tipo_doc', $ml_document['tipo_doc'] ? $ml_document['tipo_doc'] : null, ['class' => 'form-control', 'id' => 'tipo_doc', 'placeholder' => 'Tipo']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('subtipo_doc', 'Subtipo') !!} 
                    {!! Form::text('subtipo_doc', $ml_document['subtipo_doc'] ? $ml_document['subtipo_doc'] : null, ['class' => 'form-control', 'id' => 'subtipo_doc', 'placeholder' => 'Subtipo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('creador', 'Creador') !!}                    
                    {!! Form::text('creador', $ml_document['creador'] ? $ml_document['creador'] : null, ['class' => 'form-control', 'id' => 'creador', 'placeholder' => 'Creador']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('titulo', 'Titulo') !!}                    
                    {!! Form::text('titulo', $ml_document['titulo'] ? $ml_document['titulo'] : null, ['class' => 'form-control', 'id' => 'titulo', 'placeholder' => 'Titulo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('titulo_original', 'Titulo Original') !!}                    
                    {!! Form::text('titulo_original', $ml_document['titulo_original'] ? $ml_document['titulo_original'] : null, ['class' => 'form-control', 'id' => 'titulo_original', 'placeholder' => 'Titulo Original']) !!}
                </div> 
                <div class="form-group" >              
                    {!! Form::label('cdu', 'Cdu') !!}                    
                    {!! Form::text('cdu', $ml_document['cdu'] ? $ml_document['cdu'] : null, ['class' => 'form-control', 'id' => 'cdu', 'placeholder' => 'Cdu' ]) !!}
                </div>      
            <div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-md-3">    
        <div class="box box-primary">            
            <div class="box-body"> 
                <div class="form-group">              
                    {!! Form::label('idioma', 'Idioma') !!}                  
                    {!! Form::text('idioma', $ml_document['idioma'] ? $ml_document['idioma'] : null, ['class' => 'form-control', 'id' => 'idioma', 'placeholder' => 'Idioma']) !!}
                </div> 
                <div class="form-group" >              
                    {!! Form::label('adecuacion', 'Adecuación') !!}                    
                    {!! Form::text('adecuacion', $ml_document['adecuacion'] ? $ml_document['adecuacion'] : null, ['class' => 'form-control', 'id' => 'adecuacion', 'placeholder' => 'Adecuación' ]) !!}
                </div>                 
                <div class="form-group">
                    {!! Form::label('adquirido', 'Adquirido') !!}                    
                    {!! Form::text('adquirido', $ml_document['adquirido'] ? $ml_document['adquirido'] : null, ['class' => 'form-control', 'id' => 'adquirido', 'placeholder' => 'Adquirido']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('siglas_autor', 'Siglas Autor') !!}                    
                    {!! Form::text('siglas_autor', $ml_document['siglas_autor'] ? $ml_document['siglas_autor'] : null, ['class' => 'form-control', 'id' => 'siglas_autor', 'placeholder' => 'Siglas Autor']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('siglas_titulo', 'Siglas Titulo') !!}                    
                    {!! Form::text('siglas_titulo', $ml_document['siglas_titulo'] ? $ml_document['siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'siglas_titulo', 'placeholder' => 'Siglas Titulo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('valoracion', 'Valoración') !!}                    
                    {!! Form::text('valoracion', $ml_document['valoracion'] ? $ml_document['valoracion'] : null, ['class' => 'form-control', 'id' => 'valoracion', 'placeholder' => 'Valoración']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">    
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::text('desidherata', $ml_document['desidherata'] ? $ml_document['desidherata'] : null, ['class' => 'form-control', 'id' => 'desidherata', 'placeholder' => 'Desidherata']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('publicado', 'Nacionalidad') !!}                    
                    {!! Form::text('publicado', $ml_document['publicado'] ? $ml_document['publicado'] : null, ['class' => 'form-control', 'id' => 'publicado', 'placeholder' => 'Nacionalidad']) !!}
                </div>   
                <div class="form-group">
                    {!! Form::label('hecho_por', 'Productora') !!}                    
                    {!! Form::text('hecho_por', $ml_document['hecho_por'] ? $ml_document['hecho_por'] : null, ['class' => 'form-control', 'id' => 'hecho_por', 'placeholder' => 'Productora']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('año', 'Año') !!}                    
                    {!! Form::text('año', $ml_document['año'] ? $ml_document['año'] : null, ['class' => 'form-control', 'id' => 'año', 'placeholder' => 'Año']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('volumen', 'Volumen') !!}                    
                    {!! Form::text('volumen', $ml_document['volumen'] ? $ml_document['volumen'] : null, ['class' => 'form-control', 'id' => 'volumen', 'placeholder' => 'Volumen']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('cant_generica', 'Duración') !!}                    
                    {!! Form::text('cant_generica', $ml_document['cant_generica'] ? $ml_document['cant_generica'] : null, ['class' => 'form-control', 'id' => 'cant_generica', 'placeholder' => 'Duración']) !!}
                </div>                
            </div>
        </div>       
    </div>   
    <div class="col-md-3">    
        <div class="box box-primary">
            <div class="box-body">   
                <div class="form-group">
                    {!! Form::label('coleccion', 'Colección') !!}                    
                    {!! Form::text('coleccion', $ml_document['coleccion'] ? $ml_document['coleccion'] : null, ['class' => 'form-control', 'id' => 'cant_generica', 'placeholder' => 'Colección']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('ubicacion', 'Ubicación') !!}                    
                    {!! Form::text('ubicacion', $ml_document['ubicacion'] ? $ml_document['ubicacion'] : null, ['class' => 'form-control', 'id' => 'ubicacion', 'placeholder' => 'Ubicación']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('observacion', 'Observación') !!}                    
                    {!! Form::text('observacion', $ml_document['observacion'] ? $ml_document['observacion'] : null, ['class' => 'form-control', 'id' => 'observacion', 'placeholder' => 'Observación']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nota', 'Nota') !!}                    
                    {!! Form::text('nota', $ml_document['nota'] ? $ml_document['nota'] : null, ['class' => 'form-control', 'id' => 'nota', 'placeholder' => 'Nota']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sinopsis', 'Sinopsis') !!}                    
                    {!! Form::text('sinopsis', $ml_document['sinopsis'] ? $ml_document['sinopsis'] : null, ['class' => 'form-control', 'id' => 'sinopsis', 'placeholder' => 'Sinopsis']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('foto', 'Foto') !!}                    
                    {!! Form::text('foto', $ml_document['foto'] ? $ml_document['foto'] : null, ['class' => 'form-control', 'id' => 'foto', 'placeholder' => 'Foto']) !!}
                </div>
            </div>
        </div>       
    </div>   
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Cines</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">      
        <div class="box box-primary">                   
            <div class="box-body">   
                <div class="form-group">               
                    {!! Form::label('genero', 'Genero') !!}                  
                    {!! Form::text('genero', $ml_movie['genero'] ? $ml_movie['genero'] : null, ['class' => 'form-control', 'id' => 'genero', 'placeholder' => 'Genero']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('subtipo_doc', 'Formato') !!} 
                    {!! Form::text('subtipo_doc', $ml_movie['subtipo_doc'] ? $ml_movie['subtipo_doc'] : null, ['class' => 'form-control', 'id' => 'subtipo_doc', 'placeholder' => 'Subtipo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('adaptacion', 'Adaptación') !!}                    
                    {!! Form::text('adaptacion', $ml_movie['adaptacion'] ? $ml_movie['adaptacion'] : null, ['class' => 'form-control', 'id' => 'adaptacion', 'placeholder' => 'Adaptación']) !!}
                </div>
               
            <div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-md-4">      
        <div class="box box-primary">                   
            <div class="box-body">              
                <div class="form-group">
                    {!! Form::label('fotografia_tipo', 'Fotografia') !!}                    
                    {!! Form::text('fotografia_tipo', $ml_movie['fotografia_tipo'] ? $ml_movie['fotografia_tipo'] : null, ['class' => 'form-control', 'id' => 'fotografia_tipo', 'placeholder' => 'Fotografia']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('subtitulo', 'Subtitulo') !!}                    
                    {!! Form::text('subtitulo', $ml_movie['subtitulo'] ? $ml_movie['subtitulo'] : null, ['class' => 'form-control', 'id' => 'subtitulo', 'placeholder' => 'Subtitulo']) !!}
                </div> 
                <div class="form-group" >              
                    {!! Form::label('guion', 'Guion') !!}                    
                    {!! Form::text('guion', $ml_movie['guion'] ? $ml_movie['guion'] : null, ['class' => 'form-control', 'id' => 'guion', 'placeholder' => 'Guion' ]) !!}
                </div>                
            <div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-md-4">      
        <div class="box box-primary">                   
            <div class="box-body">                
                <div class="form-group" >              
                    {!! Form::label('contenido_especifico', 'Contenido Especifico') !!}                    
                    {!! Form::text('contenido_especifico', $ml_movie['contenido_especifico'] ? $ml_movie['contenido_especifico'] : null, ['class' => 'form-control', 'id' => 'contenido_especifico', 'placeholder' => 'Contenido Especifico' ]) !!}
                </div>      
                <div class="form-group" >              
                    {!! Form::label('premios', 'Premios') !!}                    
                    {!! Form::text('premios', $ml_movie['premios'] ? $ml_movie['premios'] : null, ['class' => 'form-control', 'id' => 'premios', 'placeholder' => 'Premios' ]) !!}
                </div> 
                <div class="form-group" >              
                    {!! Form::label('distribuidor', 'Distribuidor') !!}                    
                    {!! Form::text('distribuidor', $ml_movie['distribuidor'] ? $ml_movie['distribuidor'] : null, ['class' => 'form-control', 'id' => 'distribuidor', 'placeholder' => 'Distribuidor' ]) !!}
                </div> 
            <div>
        </div>
    </div>
{!! Form::close() !!}    
</div>





  