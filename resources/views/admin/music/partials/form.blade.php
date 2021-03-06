<div class="row">
{!! Form::model($music, [
    'route' => $music->exists ? ['admin.music.update', $music->id] : 'admin.music.store',   
    'method' => $music->exists ? 'PUT' : 'POST'
]) !!}

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area de Titulo</h3>
            </div>
            <div class="box-body">

                <div class="form-group"><!-- documents V -->
                    {!! Form::label('document_subtypes_id', 'Tipo de musica') !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $music->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id', 'placeholder' => '',  'onchange' => 'yesnoCheck()', 'style' => 'width:100%;']) !!}
                </div>               
                <div class="form-group">               
                    {!! Form::label('title', 'Título', ['id' => 'l_title']) !!}                    
                    {!! Form::text('title', $music->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Título']) !!}
                </div>
                <!-- popular  -->
                <div class="form-group" id="din_subtitle">              
                    {!! Form::label('subtitle', 'Subtítulo') !!}                    
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Subtítulo']) !!}
                </div>
                <!-- culta  -->
                <div class="form-group" id="din_album_title">             
                    {!! Form::label('album_title', 'Título del Disco') !!}                    
                    {!! Form::text('album_title', $music->culture['album_title'], ['class' => 'form-control', 'id' => 'album_title', 'placeholder' => 'Título del Disco']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('creators_id', 'Artista', ['id' => 'l_creators_id']) !!}             
                    {!! Form::select('creators_id', $authors, $music->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div> 
                 <!-- popular  -->
                 <div class="form-group" id="din_other_artists">
                    {!! Form::label('other_artists', 'Otros Artistas') !!}  
                    {!! Form::select('other_artists', $authors, $music->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'other_artists', 'placeholder' => '',  'style' => 'width: 100%']) !!}
                </div>
                <!-- popular  -->
                <div class="form-group" id="din_music_populars">
                    {!! Form::label('music_populars', 'Musica') !!}             
                    {!! Form::text('music_populars', null, ['class' => 'form-control', 'id' => 'music_populars', 'placeholder' => 'Musica']) !!}
                 </div>
                 <!-- popular  -->
                 <div class="form-group" id="din_original_title">
                    {!! Form::label('original_title', 'Título Original') !!} 
                    {!! Form::text('original_title', null, ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => 'Título Original']) !!}
                </div>
                  <!-- culta  -->
                <div class="form-group" id="din_director">              
                    {!! Form::label('director', 'Director') !!}                    
                    {!! Form::text('director', $music->culture['director'], ['class' => 'form-control', 'id' => 'director', 'placeholder' => 'Director']) !!}
                </div>
                <!-- culta  -->
                <div class="form-group" id="din_orchestra">              
                    {!! Form::label('orchestra', 'Orquesta') !!}                    
                    {!! Form::text('orchestra', $music->culture['orchestra'], ['class' => 'form-control', 'id' => 'orchestra', 'placeholder' => 'Orquesta']) !!}
                </div> 
                 <!-- culta  -->
                 <div class="form-group" id="din_soloist">              
                    {!! Form::label('soloist', 'Solista') !!}                    
                    {!! Form::text('soloist', $music->culture['soloist'], ['class' => 'form-control', 'id' => 'soloist', 'placeholder' => 'Solista']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('producer', 'Productor') !!}                    
                    {!! Form::text('producer', null, ['class' => 'form-control', 'id' => 'producer', 'placeholder' => 'Productor']) !!}
                </div>  
            
                <div class="form-group">
                    <label>Adquirido</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $music->document['acquired'] ? $music->document['acquired']->format('d/m/Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div>
                <div class="form-group">
                    <label>Baja</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="drop"
                            class="form-control pull-right"                                                       
                            value="{{ old('drop', $music->document['drop'] ? $music->document['drop']->format('d/m/Y') : null) }}"                            
                            type="text"
                            id="drop"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div> 
                <div class="form-group">
                    {!! Form::label('adequacies_id', 'Adecuado Para') !!}             
                    {!! Form::select('adequacies_id', $adaptations, $music->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('generate_musics_id', 'Género') !!}             
                    {!! Form::select('generate_musics_id', $genders, $music->generate_music['generate_musics_id'], ['class' => 'form-control  select2', 'id' => 'generate_musics_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registry_number', 'Número de Registro') !!}                    
                    {!! Form::text('registry_number', $music->document['registry_number'], ['class' => 'form-control', 'id' => 'registry_number', 'placeholder' => 'Número de Registro']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_author', 'Siglas Autor') !!}                    
                    {!! Form::text('let_author', $music->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', 'Siglas Titulo') !!}                    
                    {!! Form::text('let_title', $music->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del titulo']) !!}
                </div>              
                <div class="form-group">
                    {!! Form::label('generate_subjects_id', 'Cdu') !!}             
                    {!! Form::select('generate_subjects_id', $subjects, null, ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', 'Valoración') !!}                    
                    {!! Form::text('assessment', $music->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => 'Valoración']) !!}
                </div>
                <div class="form-group">      
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::checkbox('desidherata', $music->document['desidherata'])!!}
                </div>
            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area de Edición</h3>                
            </div>
            <div class="box-body">   
                <div class="form-group">    
                     <!--CAMBIAR TIPO DE CAMPO string-->
                    {!! Form::label('published', 'Editado en') !!}                    
                    {!! Form::select('published', $publications, $music->document['published'], ['class' => 'form-control select2', 'id' => 'published', 'placeholder' => '', 'style' => 'width:100%;']) !!}                                                                       
                </div>
                <div class="form-group">              
                    {!! Form::label('made_by', 'Sello Discografico') !!}                    
                    {!! Form::text('made_by', $music->document['made_by'], ['class' => 'form-control', 'id' => 'made_by', 'placeholder' => 'Ingresar el Sello Discografico', 'style' => 'width:100%;']) !!}
               
                </div>
                            
                <div class="form-group">
                    <label>Fecha de Publicación</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $music->document['year'] ? $music->document['year']->format('d/m/Y') : null) }}"                            
                            type="text"
                            id="year"
                            placeholder= "Selecciona Año de Publicación">                       
                    </div>                  
                </div>
                            
                <div class="form-group">                  
                    {!! Form::label('sound', 'Sonido') !!}             
                    {!! Form::select('sound', $sounds, null, ['class' => 'form-control  select2', 'id' => 'sound', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">                   
                    {!! Form::label('volume', 'Volumenes') !!}       
                    {!! Form::select('volume', $volumes, $music->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume', 'placeholder' => '', 'style' => 'width:100%;']) !!}                
                </div>
                <div class="form-group">                 
                    {!! Form::label('quantity_generic', 'Duración') !!}               
                    {!! Form::text('quantity_generic', $music->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => 'Duración de la musica']) !!}
                </div>
                <div class="form-group">                  
                    {!! Form::label('generate_formats_id', 'Formato') !!}             
                    {!! Form::select('generate_formats_id', $formats, null, ['class' => 'form-control  select2', 'id' => 'generate_formats_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="din_collection">                 
                    {!! Form::label('collection', 'Coleccion') !!}               
                    {!! Form::text('collection', $music->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => 'Coleccion']) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', 'Ubicación') !!}               
                    {!! Form::text('location', $music->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Ubicación']) !!}
                </div>
                
             
                <div class="form-group">
                    <label>Observación</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="Ingresa una observación">{{ old('observation', $music->document['observation'])}}</textarea>
                </div>                
                <div class="form-group">
                    <label>Nota</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $music->document['note'])}}</textarea>
                </div>
                <div class="form-group">
                    {!! Form::label('lenguages_id', 'Idioma') !!} 
                    {!! Form::select('lenguages_id', $languages, $music->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group">
                    {!! Form::label('generate_references_id', 'Referencia') !!} 
                    {!! Form::select('generate_references_id', $references, $music->document['generate_references_id'], ['class' => 'form-control  select2', 'id' => 'generate_references_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group">
                    {!! Form::label('photo', 'Imagen') !!}                    
                    {!! Form::file('photo') !!}
                </div>

            </div>
        </div>       
    </div> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area de Contenidos</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Contenido de la publicación</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el contenido completo de la publicacion">{{ old('synopsis', $music->document['synopsis'])}}</textarea>
                </div>                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>