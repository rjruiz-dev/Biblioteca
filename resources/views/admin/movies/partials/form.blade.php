<div class="row">
{!! Form::model($movie, [
    'route' => $movie->exists ? ['admin.movies.update', $movie->id] : 'admin.movies.store',   
    'method' => $movie->exists ? 'PUT' : 'POST',
    'enctype' => 'multipart/form-data'
]) !!}

    @if (!$movie->exists)
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
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_cat_edit_movie->compl_area_de_titulo }}</h3>
            </div>
            <div class="box-body">
                {{ csrf_field() }}                             
                <div class="form-group" >              
                    {!! Form::label('title', $idioma_cat_edit_movie->cuerpo_titulo) !!}                    
                    {!! Form::text('title', $movie->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_titulo ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('subtitle', $idioma_cat_edit_movie->cuerpo_titulo) !!}                  
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_titulo]) !!}
                </div>                         
                <div class="form-group"  id="fg_creators_id">
                    {!! Form::label('creators_id', $idioma_cat_edit_movie->cuerpo_director) !!}             
                    {!! Form::select('creators_id', $authors, $movie->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group" id="fg_actors">
                    <label>{{$idioma_cat_edit_movie->cuerpo_reparto}}</label>
                    <select name="actors[]" id="actors" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="{{$idioma_cat_edit_movie->ph_cuerpo_reparto}}" style="width: 100%;">
                        @foreach($actors as $actor)
                            <option {{ collect( old('actors', $movie->actors->pluck('id')))->contains($actor->id) ? 'selected' : '' }} value="{{ $actor->id}}"> {{ $actor->actor_name }} </option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    {!! Form::label('original_title', $idioma_cat_edit_movie->cuerpo_titulo_original) !!} 
                    {!! Form::text('original_title', $movie->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_titulo_original]) !!}
                </div>
                <div class="form-group" id="fg_adaptations_id">
                    {!! Form::label('adaptations_id', $idioma_cat_edit_movie->cuerpo_adaptacion) !!}             
                    {!! Form::select('adaptations_id', $adaptations_bis, null, ['class' => 'form-control  select2', 'id' => 'adaptations_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('script', $idioma_cat_edit_movie->cuerpo_guion) !!}             
                    {!! Form::text('script', null, ['class' => 'form-control', 'id' => 'script', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_guion]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('specific_content', $idioma_cat_edit_movie->cuerpo_contenido_especifico) !!}             
                    {!! Form::text('specific_content', null, ['class' => 'form-control', 'id' => 'specific_content', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_contenido_especifico]) !!}
                </div>
                <div class="form-group">
                    <label>{{$idioma_cat_edit_movie->cuerpo_adquirido}}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $movie->document['acquired'] ? $movie->document['acquired']->format('d-m-Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "{{$idioma_cat_edit_movie->ph_cuerpo_adquirido}}">                       
                    </div>                  
                </div>
                <div class="form-group" id="fg_adequacies_id">
                    {!! Form::label('adequacies_id', $idioma_cat_edit_movie->cuerpo_adecuado_para) !!}             
                    {!! Form::select('adequacies_id', $adaptations, $movie->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="fg_generate_films_id">
                    {!! Form::label('generate_films_id', $idioma_cat_edit_movie->cuerpo_genero) !!}             
                    {!! Form::select('generate_films_id', $genders, null, ['class' => 'form-control  select2', 'id' => 'generate_films_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div>                
                <div class="form-group">              
                    {!! Form::label('let_author', $idioma_cat_edit_movie->cuerpo_siglas_director) !!}                    
                    {!! Form::text('let_author', $movie->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_siglas_director]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', $idioma_cat_edit_movie->cuerpo_siglas_titulo) !!}                    
                    {!! Form::text('let_title', $movie->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_siglas_titulo]) !!}
                </div>
                <div class="form-group" id="fg_generate_subjects_id">
                    {!! Form::label('generate_subjects_id', $idioma_cat_edit_movie->cuerpo_cdu) !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $movie->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', $idioma_cat_edit_movie->cuerpo_valoracion) !!}                    
                    {!! Form::text('assessment', $movie->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_valoracion]) !!}
                </div>
                <div class="form-group" style="{{{ $visible_desidherata }}}">      
                    {!! Form::label('desidherata', $idioma_cat_edit_movie->cuerpo_desidherata) !!}                    
                    {!! Form::checkbox('desidherata', '1')!!}
                </div>

                <div class="form-group" id="fg_status_documents_id" style="{{{ $visible_status_doc }}}">
                    {!! Form::label('status_documents_id', $idioma_cat_edit_movie->cuerpo_estado) !!}             
                    {!! Form::select('status_documents_id', $status_documents, $movie->document['status_documents_id'], ['class' => 'form-control  select2', 'id' => 'status_documents_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}    
                </div> 

            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{$idioma_cat_edit_movie->compl_area_de_edicion}}</h3>                
            </div>
            <div class="box-body">   
                <div class="form-group" id="fg_published">                       
                    {!! Form::label('published', $idioma_cat_edit_movie->cuerpo_nacionalidad) !!} 
                    {!! Form::select('published', $publications, $movie->document['published'], ['class' => 'form-control', 'id' => 'published', 'placeholder' => '', 'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group" id="fg_made_by">              
                    {!! Form::label('made_by', $idioma_cat_edit_movie->cuerpo_productora) !!}        
                    {!! Form::select('made_by', $editorials, $movie->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div>       
                <div class="form-group">
                    <label>{{$idioma_cat_edit_movie->cuerpo_anio_de_publicacion}}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $movie->document['year'] ? $movie->document['year']->format('Y') : null) }}"                            
                            type="text"
                            type="text"
                            id="year"
                            placeholder= "{{$idioma_cat_edit_movie->ph_cuerpo_anio_de_publicacion}}">                       
                    </div>                  
                </div>
                <div class="form-group" id="fg_photography_movies_id">
                    {!! Form::label('photography_movies_id', $idioma_cat_edit_movie->cuerpo_fotografia) !!}             
                    {!! Form::select('photography_movies_id', $photographs, $movie->photography_movie['photography_movies_id'], ['class' => 'form-control  select2', 'id' => 'photography_movies_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>             
                <div class="form-group" >                 
                    {!! Form::label('quantity_generic', $idioma_cat_edit_movie->cuerpo_duracion) !!}               
                    {!! Form::text('quantity_generic', $movie->document['quantity_generic'], ['class' => 'form-control', 'id' => '', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_duracion]) !!}
                </div>
                <div class="form-group" id="fg_generate_formats_id">
                    {!! Form::label('generate_formats_id', $idioma_cat_edit_movie->cuerpo_formato) !!}             
                    {!! Form::select('generate_formats_id', $formats, null, ['class' => 'form-control  select2', 'id' => 'generate_formats_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group"  id="fg_distributor">
                    {!! Form::label('distributor', $idioma_cat_edit_movie->cuerpo_distribuidora) !!}             
                    {!! Form::select('distributor', $distributors, null, ['class' => 'form-control', 'id' => 'distributor', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', $idioma_cat_edit_movie->cuerpo_ubicacion) !!}               
                    {!! Form::text('location', $movie->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_ubicacion]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('awards', $idioma_cat_edit_movie->cuerpo_premios) !!}             
                    {!! Form::text('awards', null, ['class' => 'form-control', 'id' => 'awards', 'placeholder' => $idioma_cat_edit_movie->ph_cuerpo_premios]) !!}
                 </div>
                 <div class="form-group">
                    <label>{{$idioma_cat_edit_movie->cuerpo_notas}}</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="{{$idioma_cat_edit_movie->ph_cuerpo_notas}}">{{ old('note', $movie->document['note'])}}</textarea>
                </div>
                <div class="form-group" id="fg_lenguages_id">
                    {!! Form::label('lenguages_id', $idioma_cat_edit_movie->cuerpo_idioma) !!} 
                    {!! Form::select('lenguages_id', $languages, $movie->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group" id="fg_references">
                    <label>{{$idioma_cat_edit_movie->cuerpo_referencia}}</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="{{$idioma_cat_edit_movie->ph_cuerpo_referencia}}" style="width: 100%;">
                        @foreach($references as $reference)
                            <option {{ collect( old('references', $document->references->pluck('id')))->contains($reference->id) ? 'selected' : '' }} value="{{ $reference->id}}"> {{ $reference->reference_description }} </option>
                        @endforeach
                    </select>
                </div>  
                <div class="form-group">
                    {!! Form::label('photo', $idioma_cat_edit_movie->cuerpo_imagen) !!}                    
                    {!! Form::file('photo') !!}
                </div>
            </div>
        </div>       
    </div> 
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{$idioma_cat_edit_movie->compl_area_de_contenidos}}</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>{{$idioma_cat_edit_movie->cuerpo_sinopsis}}</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="{{$idioma_cat_edit_movie->ph_cuerpo_sinopsis}}">{{ old('synopsis', $movie->document['synopsis'])}}</textarea>
                </div>                              
            </div>            
        </div>       
    </div>   
{!! Form::close() !!}    
</div>





  