<div class="row">
{!! Form::model($movie, [
    'route' => $movie->exists ? ['admin.movies.update', $movie->id] : 'admin.movies.store',   
    'method' => $movie->exists ? 'PUT' : 'POST'
]) !!}

    @if (!$movie->exists)
        @php 
            $visible = "display:none"
        @endphp
    @else
        @php  
            $visible = ""
        @endphp
    @endif       

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area de Titulo</h3>
            </div>
            <div class="box-body">
                {{ csrf_field() }}
                             
                <div class="form-group" >              
                    {!! Form::label('title', 'Título') !!}                    
                    {!! Form::text('title', $movie->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Título' ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('subtitle', 'Subtitulo') !!}                  
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Tema de Portada']) !!}
                </div>                         
                <div class="form-group">
                    {!! Form::label('creators_id', 'Director') !!}             
                    {!! Form::select('creators_id', $authors, $movie->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
         

                <div class="form-group">
                    <label>Reparto</label>
                    <select name="actors[]" id="actors" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="Selecciona o Ingresa uno o mas Actores" style="width: 100%;">
                        @foreach($actors as $actor)
                            <option {{ collect( old('actors', $movie->actors->pluck('id')))->contains($actor->id) ? 'selected' : '' }} value="{{ $actor->id}}"> {{ $actor->actor_name }} </option>
                        @endforeach
                    </select>
                </div>  

                <div class="form-group">
                    {!! Form::label('original_title', 'Título Original') !!} 
                    {!! Form::text('original_title', $movie->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => 'Título Original']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('adaptations_id', 'Adaptacion') !!}             
                    {!! Form::select('adaptations_id', $adaptations_bis, null, ['class' => 'form-control  select2', 'id' => 'adaptations_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('script', 'Guion') !!}             
                    {!! Form::text('script', null, ['class' => 'form-control', 'id' => 'script', 'placeholder' => 'Guion']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('specific_content', 'Cont. Específico') !!}             
                    {!! Form::text('specific_content', null, ['class' => 'form-control', 'id' => 'specific_content', 'placeholder' => 'Cont. Específico']) !!}
                </div>
                <div class="form-group">
                    <label>Adquirido</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $movie->document['acquired'] ? $movie->document['acquired']->format('d/m/Y') : null) }}"                            
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
                            value="{{ old('drop', $movie->document['drop'] ? $movie->document['drop']->format('d/m/Y') : null) }}"                            
                            type="text"
                            id="drop"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div> 
                <div class="form-group">
                    {!! Form::label('adequacies_id', 'Adecuado Para') !!}             
                    {!! Form::select('adequacies_id', $adaptations, $movie->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registry_number', 'Número de Registro') !!}                    
                    {!! Form::text('registry_number', $movie->document['registry_number'], ['class' => 'form-control', 'id' => 'registry_number', 'placeholder' => 'Número de Registro']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('generate_films_id', 'Genero') !!}             
                    {!! Form::select('generate_films_id', $genders, null, ['class' => 'form-control  select2', 'id' => 'generate_films_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('let_author', 'Siglas Autor') !!}                    
                    {!! Form::text('let_author', $movie->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', 'Siglas Titulo') !!}                    
                    {!! Form::text('let_title', $movie->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del titulo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('generate_subjects_id', 'Cdu') !!}             
                    {!! Form::select('generate_subjects_id', $subjects, null, ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                

                <div class="form-group">   
                    {!! Form::label('assessment', 'Valoración') !!}                    
                    {!! Form::text('assessment', $movie->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => 'Valoración']) !!}
                </div>

                <div class="form-group">      
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::checkbox('desidherata', $movie->document['desidherata'])!!}
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
                    {!! Form::label('published', 'Nacionalidad') !!} 
                    {!! Form::text('published', $movie->document['published'], ['class' => 'form-control', 'id' => 'published', 'placeholder' => 'Publicado en']) !!}                                      
                </div>
                <div class="form-group">              
                    {!! Form::label('made_by', 'Editorial') !!}        
                    {!! Form::select('made_by', $editorials, $movie->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div>       
                <div class="form-group">
                    <label>Año de Publicación</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $movie->document['year'] ? $movie->document['year']->format('m/d/Y') : null) }}"                            
                            type="text"
                            type="text"
                            id="year"
                            placeholder= "Selecciona Año de Publicación">                       
                    </div>                  
                </div>
                <div class="form-group">
                    {!! Form::label('photography_movies_id', 'Fotografia') !!}             
                    {!! Form::select('photography_movies_id', $photographs, null, ['class' => 'form-control  select2', 'id' => 'photography_movies_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
            
                <div class="form-group">                 
                    {!! Form::label('quantity_generic', 'Duracion') !!}               
                    {!! Form::text('quantity_generic', $movie->document['quantity_generic'], ['class' => 'form-control', 'id' => '', 'placeholder' => 'Duración']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('generate_formats_id', 'Formatos') !!}             
                    {!! Form::select('generate_formats_id', $formats, null, ['class' => 'form-control  select2', 'id' => 'generate_formats_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('distributor', 'Distribuidora') !!}             
                    {!! Form::select('distributor', $distributors, null, ['class' => 'form-control', 'id' => 'distributor', 'placeholder' => '']) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', 'Ubicacion') !!}               
                    {!! Form::text('location', $movie->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Ubicacion']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('awards', 'Premios') !!}             
                    {!! Form::text('awards', null, ['class' => 'form-control', 'id' => 'awards', 'placeholder' => 'Premios']) !!}
                 </div>
                 <div class="form-group">
                    <label>Nota</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $movie->document['note'])}}</textarea>
                </div>

                <div class="form-group">
                    {!! Form::label('lenguages_id', 'Idioma') !!} 
                    {!! Form::select('lenguages_id', $languages, $movie->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                </div>

                <div class="form-group">
                    {!! Form::label('generate_references_id', 'Referencia') !!} 
                    {!! Form::select('generate_references_id', $references, $movie->document['generate_references_id'], ['class' => 'form-control  select2', 'id' => 'generate_references_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}                     
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
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el contenido completo de la publicacion">{{ old('synopsis', $movie->document['synopsis'])}}</textarea>
                </div>                              
            </div>
            
        </div>       
    </div>   
{!! Form::close() !!}    
</div>





  