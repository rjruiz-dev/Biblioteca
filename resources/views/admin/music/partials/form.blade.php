<div class="row">
{!! Form::model($music, [
    'route' => $music->exists ? ['admin.music.update', $music->id] : 'admin.music.store',   
    'method' => $music->exists ? 'PUT' : 'POST',
        'enctype' => 'multipart/form-data'
]) !!}

@if (!$music->exists)
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
                    {!! Form::text('title', $music->document['title'], ['class' => 'form-control', 'id' => 'title']) !!} 
                </div>
                <!-- popular  -->
                <div class="form-group" id="din_subtitle">              
                    {!! Form::label('subtitle', 'Subtítulo') !!}                    
                    {!! Form::text('subtitle', $music->popular['subtitle'], ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Subtítulo']) !!}
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
                    {!! Form::label('other_artists', 'Otro Artista') !!}  
                    {!! Form::select('other_artists', $authors, $music->popular['other_artists'], ['class' => 'form-control  select2', 'id' => 'other_artists', 'placeholder' => '',  'style' => 'width: 100%']) !!}
                </div>
                <!-- popular  -->
                <div class="form-group" id="din_music_populars">
                    {!! Form::label('music_populars', 'Musica') !!}             
                    {!! Form::text('music_populars', $music->popular['music_populars'], ['class' => 'form-control', 'id' => 'music_populars', 'placeholder' => 'Musica']) !!}
                 </div>
                 <!-- popular  -->
                 <div class="form-group" id="din_original_title">
                    {!! Form::label('original_title', 'Título Original') !!} 
                    {!! Form::text('original_title', $music->popular['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => 'Título Original']) !!}
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
                            placeholder= "Selecciona una Fecha de Adquisición">                       
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
                    {!! Form::label('let_author', 'Siglas Compositor') !!}                    
                    {!! Form::text('let_author', $music->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', 'Siglas Titulo') !!}                    
                    {!! Form::text('let_title', $music->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del titulo']) !!}
                </div>              
                <div class="form-group">
                    {!! Form::label('generate_subjects_id', 'Cdu') !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $music->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', 'Valoración') !!}                    
                    {!! Form::text('assessment', $music->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => 'Valoración']) !!}
                </div>
                <div class="form-group" style="{{{ $visible_desidherata }}}">      
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::checkbox('desidherata', '1')!!}
                </div>

                <div class="form-group" style="{{{ $visible_status_doc }}}">
                {!! Form::label('status_documents_id', 'Estado') !!}             
                {!! Form::select('status_documents_id', $status_documents, $music->document['status_documents_id'], ['class' => 'form-control  select2', 'id' => 'status_documents_id', 'style' => 'width:100%;']) !!}    
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
                    {!! Form::select('made_by', $editorials, $music->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div> 
                            
                <div class="form-group">
                    <label>Año de Publicación</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $music->document['year'] ? $music->document['year']->format('Y') : null) }}"                            
                            type="text"
                            type="text"
                            id="year"
                            placeholder= "Selecciona Año de Publicación">                       
                    </div>                  
                </div>
                            
                <div class="form-group">                  
                    {!! Form::label('sound', 'Fotografia') !!}             
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
                    {!! Form::label('collection', 'Colección') !!}               
                    {!! Form::text('collection', $music->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => 'Colección']) !!}
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
                    <label>Notas</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $music->document['note'])}}</textarea>
                </div>
                <div class="form-group">
                    {!! Form::label('lenguages_id', 'Idioma') !!} 
                    {!! Form::select('lenguages_id', $languages, $music->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group">
                    <label>Referencia</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="Selecciona una o mas Referencias" style="width: 100%;">
                        @foreach($references as $reference)
                            <option {{ collect( old('references', $document->references->pluck('id')))->contains($reference->id) ? 'selected' : '' }} value="{{ $reference->id}}"> {{ $reference->reference_description }} </option>
                        @endforeach
                    </select>
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
                <label>Contenido, Sinopsis o Índice</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el Contenido, Sinopsis o Índice">{{ old('synopsis', $music->document['synopsis'])}}</textarea>
                </div>                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>