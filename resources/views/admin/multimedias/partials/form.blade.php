<div class="row">
{!! Form::model($multimedia, [
    'route' => $multimedia->exists ? ['admin.multimedias.update', $multimedia->id] : 'admin.multimedias.store',   
    'method' => $multimedia->exists ? 'PUT' : 'POST'
]) !!}

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area de Titulo</h3>
            </div>
            <div class="box-body">

                @if (!$multimedia->exists)
                    @php 
                        $visible = "display:none"
                    @endphp
                @else
                    @php  
                        $visible = ""
                    @endphp
                @endif

        

                

                <div class="form-group">               
                    {!! Form::label('title', 'Título') !!}                    
                    {!! Form::text('title', $multimedia->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Título']) !!}
                </div>
                
                 <div class="form-group">              
                    {!! Form::label('subtitle', 'Subtítulo') !!}                    
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Subtítulo']) !!}
                </div>
                
                 <div class="form-group">
                    {!! Form::label('creators_id', 'Autor') !!}             
                    {!! Form::select('creators_id', $authors, $multimedia->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('second_author_id', 'Segundo Artista') !!}             
                    {!! Form::select('second_author_id', $authors, null, ['class' => 'form-control  select2', 'id' => 'second_author_id']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('third_author_id', 'Tercer Autor') !!}                    
                    {!! Form::select('third_author_id', $authors, null, ['class' => 'form-control select2', 'id' => 'third_author_id']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('original_title', 'Título Original') !!} 
                    {!! Form::text('original_title', $multimedia->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => 'Título Original']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('translator', 'Traductor') !!} 
                    {!! Form::text('translator', null, ['class' => 'form-control', 'id' => 'translator', 'placeholder' => 'Traductor']) !!}
                </div> 

                
                <div class="form-group">
                    {!! Form::label('isbn', 'ISBN') !!}             
                    {!! Form::text('isbn', null, ['class' => 'form-control', 'id' => 'isbn', 'placeholder' => 'isbn']) !!}
                 </div>

                 <div class="form-group">
                    <label>Adquirido</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $multimedia->document['acquired'] ? $multimedia->document['acquired']->format('m/d/Y') : null) }}"                            
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
                            value="{{ old('drop', $multimedia->document['drop'] ? $multimedia->document['drop']->format('m/d/Y') : null) }}"                            
                            type="text"
                            id="drop"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div> 

                <div class="form-group">
                    {!! Form::label('adequacies_id', 'Adecuado Para') !!}             
                    {!! Form::select('adequacies_id', $adaptations, $multimedia->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id']) !!}
                </div>

                <div class="form-group" style="{{{ $visible }}}">              
                    {!! Form::label('registry_number', 'Número de Registro'.$multimedia->document['id']) !!}                    
                </div>

                <div class="form-group">              
                    {!! Form::label('let_author', 'let_author') !!}                    
                    {!! Form::text('let_author', $multimedia->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', 'let_title') !!}                    
                    {!! Form::text('let_title', $multimedia->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del titulo']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('generate_subjects_id', 'Cdu') !!}             
                    {!! Form::select('generate_subjects_id', $subjects, null, ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', 'Valoración') !!}                    
                    {!! Form::text('assessment', $multimedia->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => 'Valoración']) !!}
                </div>

                <div class="form-group">      
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::checkbox('desidherata', $multimedia->document['desidherata'])!!}
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
                    {!! Form::label('published', 'Publicado en') !!} 
                    {!! Form::text('published', $multimedia->document['published'], ['class' => 'form-control', 'id' => 'published', 'placeholder' => 'Publicado en']) !!}                                      
                </div>
                <div class="form-group">              
                    {!! Form::label('made_by', 'Editorial') !!}                    
                    {!! Form::text('made_by', $multimedia->document['made_by'], ['class' => 'form-control', 'id' => 'made_by', 'placeholder' => 'Editorial']) !!}
                </div>
                            
                <div class="form-group">
                    <label>Fecha de Publicación</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $multimedia->document['year'] ? $multimedia->document['year']->format('m/d/Y') : null) }}"                            
                            type="text"
                            id="year"
                            placeholder= "Selecciona Año de Publicación">                       
                    </div>                  
                </div>

                <div class="form-group">
                    {!! Form::label('edition', 'Edicion') !!}                    
                    {!! Form::text('edition', null, ['class' => 'form-control', 'id' => 'edition', 'placeholder' => 'Edicion']) !!}
                </div> 
                
                <div class="form-group">                   
                    {!! Form::label('volume', 'Volumenes') !!}               
                    {!! Form::text('volume', $multimedia->document['volume'], ['class' => 'form-control', 'id' => 'volume', 'placeholder' => 'Volumenes']) !!}
                </div>
                
                <div class="form-group">                 
                    {!! Form::label('quantity_generic', 'Duracion') !!}               
                    {!! Form::text('quantity_generic', $multimedia->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => 'Duracion de la multimedia']) !!}
                </div>

                <div class="form-group">                   
                    {!! Form::label('size', 'Tamaño') !!}               
                    {!! Form::text('size', null, ['class' => 'form-control', 'id' => 'size', 'placeholder' => 'Tamaño']) !!}
                </div>
                
                <div class="form-group">                 
                    {!! Form::label('collection', 'Coleccion') !!}               
                    {!! Form::text('collection', $multimedia->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => 'Coleccion']) !!}
                </div>

                <div class="form-group">                 
                    {!! Form::label('location', 'Ubicacion') !!}               
                    {!! Form::text('location', $multimedia->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Ubicacion']) !!}
                </div>

                <div class="form-group">
                    <label>Observación</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="Ingresa una observación">{{ old('observation', $multimedia->document['observation'])}}</textarea>
                </div>                
                <div class="form-group">
                    <label>Nota</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $multimedia->document['note'])}}</textarea>
                </div>

                <div class="form-group">
                    {!! Form::label('lenguages_id', 'Idioma') !!} 
                    {!! Form::select('lenguages_id', $languages, $multimedia->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id']) !!}                     
                </div>
                <div class="form-group">
                    {!! Form::label('generate_references_id', 'Referencia') !!} 
                    {!! Form::select('generate_references_id', $references, $multimedia->document['generate_references_id'], ['class' => 'form-control  select2', 'id' => 'generate_references_id', 'style' => 'width:100%;']) !!}                     
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
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el contenido completo de la publicacion">{{ old('synopsis', $multimedia->document['synopsis'])}}</textarea>
                </div>
                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>
