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
                <h3 class="box-title">{{ $idioma_cat_edit_music->compl_area_de_titulo }}</h3>
            </div>
            <div class="box-body">

                <div class="form-group" id="fg_document_subtypes_id"><!-- documents V -->
                    {!! Form::label('document_subtypes_id', $idioma_cat_edit_music->cuerpo_tipo_de_musica ) !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $music->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id', 'placeholder' => '',  'onchange' => 'yesnoCheck()', 'style' => 'width:100%;']) !!}
                </div>               
                <div class="form-group">               
                    {!! Form::label('title', $idioma_cat_edit_music->cuerpo_titulo, ['id' => 'l_title']) !!}                    
                    {!! Form::text('title', $music->document['title'], ['class' => 'form-control', 'id' => 'title']) !!} 
                </div>
                <!-- popular  -->
                <div class="form-group" id="din_subtitle">              
                    {!! Form::label('subtitle', $idioma_cat_edit_music->cuerpo_subtitulo) !!}                    
                    {!! Form::text('subtitle', $music->popular['subtitle'], ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_subtitulo]) !!}
                </div>
                <!-- culta  -->
                <div class="form-group" id="din_album_title">             
                    {!! Form::label('album_title', $idioma_cat_edit_music->cuerpo_titulo_del_disco) !!}                    
                    {!! Form::text('album_title', $music->culture['album_title'], ['class' => 'form-control', 'id' => 'album_title', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_titulo_del_disco]) !!}
                </div>

                <div class="form-group" id="fg_creators_id">
                    {!! Form::label('creators_id', $idioma_cat_edit_music->cuerpo_artista, ['id' => 'l_creators_id']) !!}             
                    {!! Form::select('creators_id', $authors, $music->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div> 
                 <!-- popular  -->
                 <div class="form-group" id="din_other_artists">
                    {!! Form::label('other_artists', $idioma_cat_edit_music->cuerpo_otros_artistas) !!}                     
                    {!! Form::text('other_artists',  $music->popular['other_artists'], ['class' => 'form-control', 'id' => 'other_artists', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_otros_artistas]) !!}
                </div>
                <!-- popular  -->
                <div class="form-group" id="din_music_populars">
                    {!! Form::label('music_populars', $idioma_cat_edit_music->cuerpo_musica) !!}             
                    {!! Form::text('music_populars', $music->popular['music_populars'], ['class' => 'form-control', 'id' => 'music_populars', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_musica]) !!}
                 </div>
                 <!-- popular  -->
                 <div class="form-group" id="din_original_title">
                    {!! Form::label('original_title', $idioma_cat_edit_music->cuerpo_titulo_original) !!} 
                    {!! Form::text('original_title', $music->popular['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_titulo_original]) !!}
                </div>
                  <!-- culta  -->
                <div class="form-group" id="din_director">              
                    {!! Form::label('director', $idioma_cat_edit_music->cuerpo_director) !!}                    
                    {!! Form::text('director', $music->culture['director'], ['class' => 'form-control', 'id' => 'director', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_director]) !!}
                </div>
                <!-- culta  -->
                <div class="form-group" id="din_orchestra">              
                    {!! Form::label('orchestra', $idioma_cat_edit_music->cuerpo_orquesta) !!}                    
                    {!! Form::text('orchestra', $music->culture['orchestra'], ['class' => 'form-control', 'id' => 'orchestra', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_orquesta]) !!}
                </div> 
                 <!-- culta  -->
                 <div class="form-group" id="din_soloist">              
                    {!! Form::label('soloist', $idioma_cat_edit_music->cuerpo_solista) !!}                    
                    {!! Form::text('soloist', $music->culture['soloist'], ['class' => 'form-control', 'id' => 'soloist', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_solista]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('producer', $idioma_cat_edit_music->cuerpo_productor) !!}                    
                    {!! Form::text('producer', null, ['class' => 'form-control', 'id' => 'producer', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_productor]) !!}
                </div>              
                <div class="form-group">
                    <label>{{$idioma_cat_edit_music->cuerpo_adquirido}}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $music->document['acquired'] ? $music->document['acquired']->format('d-m-Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "{{$idioma_cat_edit_music->ph_cuerpo_adquirido}}">                       
                    </div>                  
                </div>    
                <div class="form-group"  id="fg_adequacies_id">
                    {!! Form::label('adequacies_id', $idioma_cat_edit_music->cuerpo_adecuado_para) !!}             
                    {!! Form::select('adequacies_id', $adaptations, $music->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="fg_generate_musics_id">
                    {!! Form::label('generate_musics_id', $idioma_cat_edit_music->cuerpo_genero) !!}             
                    {!! Form::select('generate_musics_id', $genders, $music->generate_music['generate_musics_id'], ['class' => 'form-control  select2', 'id' => 'generate_musics_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>              
                <div class="form-group">              
                    {!! Form::label('let_author', $idioma_cat_edit_music->cuerpo_siglas_compositor) !!}                    
                    {!! Form::text('let_author', $music->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_siglas_compositor]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', $idioma_cat_edit_music->cuerpo_siglas_titulo) !!}                    
                    {!! Form::text('let_title', $music->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_siglas_titulo]) !!}
                </div>              
                <div class="form-group"  id="fg_generate_subjects_id">
                    {!! Form::label('generate_subjects_id', $idioma_cat_edit_music->cuerpo_cdu) !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $music->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', $idioma_cat_edit_music->cuerpo_valoracion) !!}                    
                    {!! Form::text('assessment', $music->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_valoracion]) !!}
                </div>
                <div class="form-group" style="{{{ $visible_desidherata }}}">      
                    {!! Form::label('desidherata', $idioma_cat_edit_music->cuerpo_desidherata) !!}                    
                    {!! Form::checkbox('desidherata', '1')!!}
                </div>

                <div class="form-group" id="fg_status_documents_id" style="{{{ $visible_status_doc }}}">
                {!! Form::label('status_documents_id', $idioma_cat_edit_music->cuerpo_estado) !!}             
                {!! Form::select('status_documents_id', $status_documents, $music->document['status_documents_id'], ['class' => 'form-control  select2', 'id' => 'status_documents_id', 'style' => 'width:100%;']) !!}    
                </div>
            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_cat_edit_music->compl_area_de_edicion }}</h3>                
            </div>
            <div class="box-body">   
                <div class="form-group" id="fg_published">    
                     <!--CAMBIAR TIPO DE CAMPO string-->
                    {!! Form::label('published', $idioma_cat_edit_music->cuerpo_editado_en) !!}                    
                    {!! Form::select('published', $publications, $music->document['published'], ['class' => 'form-control select2', 'id' => 'published', 'placeholder' => '', 'style' => 'width:100%;']) !!}                                                                       
                </div>
                <div class="form-group" id="fg_made_by">              
                    {!! Form::label('made_by', $idioma_cat_edit_music->cuerpo_sello_discografico) !!}        
                    {!! Form::select('made_by', $editorials, $music->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div> 
                            
                <div class="form-group">
                    <label>{{ $idioma_cat_edit_music->cuerpo_anio_de_publicacion }}</label>
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
                            placeholder= "{{$idioma_cat_edit_music->ph_cuerpo_anio_de_publicacion}}">                       
                    </div>                  
                </div>
                            
                <div class="form-group" id="fg_sound">                  
                    {!! Form::label('sound', $idioma_cat_edit_music->cuerpo_fotografia) !!}             
                    {!! Form::select('sound', $sounds, null, ['class' => 'form-control  select2', 'id' => 'sound', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="fg_volume">                   
                    {!! Form::label('volume', $idioma_cat_edit_music->cuerpo_volumenes) !!}       
                    {!! Form::select('volume', $volumes, $music->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume', 'placeholder' => '', 'style' => 'width:100%;']) !!}                
                </div>
                <div class="form-group">                 
                    {!! Form::label('quantity_generic', $idioma_cat_edit_music->cuerpo_duracion) !!}               
                    {!! Form::text('quantity_generic', $music->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_duracion]) !!}
                </div>
                <div class="form-group" id="fg_generate_formats_id">                  
                    {!! Form::label('generate_formats_id', $idioma_cat_edit_music->cuerpo_formato) !!}             
                    {!! Form::select('generate_formats_id', $formats, null, ['class' => 'form-control  select2', 'id' => 'generate_formats_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="din_collection">                 
                    {!! Form::label('collection', $idioma_cat_edit_music->cuerpo_coleccion) !!}               
                    {!! Form::text('collection', $music->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_coleccion]) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', $idioma_cat_edit_music->cuerpo_ubicacion) !!}               
                    {!! Form::text('location', $music->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => $idioma_cat_edit_music->ph_cuerpo_ubicacion]) !!}
                </div>
                <div class="form-group">
                    <label>{{$idioma_cat_edit_music->cuerpo_observacion}}</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="{{$idioma_cat_edit_music->ph_cuerpo_observacion}}">{{ old('observation', $music->document['observation'])}}</textarea>
                </div>                
                <div class="form-group">
                    <label>{{$idioma_cat_edit_music->cuerpo_notas}}</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="{{$idioma_cat_edit_music->ph_cuerpo_notas}}">{{ old('note', $music->document['note'])}}</textarea>
                </div>
                <div class="form-group" id="fg_lenguages_id">
                    {!! Form::label('lenguages_id', $idioma_cat_edit_music->cuerpo_idioma) !!} 
                    {!! Form::select('lenguages_id', $languages, $music->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group"  id="fg_references">
                    <label>{{$idioma_cat_edit_music->cuerpo_referencia}}</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="{{$idioma_cat_edit_music->ph_cuerpo_referencia}}" style="width: 100%;">
                        @foreach($references as $reference)
                            <option {{ collect( old('references', $document->references->pluck('id')))->contains($reference->id) ? 'selected' : '' }} value="{{ $reference->id}}"> {{ $reference->reference_description }} </option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    {!! Form::label('photo', $idioma_cat_edit_music->cuerpo_imagen) !!}                    
                    {!! Form::file('photo') !!}
                </div>

            </div>
        </div>       
    </div> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$idioma_cat_edit_music->compl_area_de_contenidos}}</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                <label>{{$idioma_cat_edit_music->cuerpo_sinopsis}}</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="{{$idioma_cat_edit_music->ph_cuerpo_sinopsis}}">{{ old('synopsis', $music->document['synopsis'])}}</textarea>
                </div>                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>