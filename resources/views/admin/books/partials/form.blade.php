<div class="row">
{!! Form::model($book, [
    'route' => $book->exists ? ['admin.books.update', $book->id] : 'admin.books.store',   
    'method' => $book->exists ? 'PUT' : 'POST'
]) !!}

    @if (!$book->exists)
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
                <div class="form-group">
                    {!! Form::label('document_subtypes_id', 'Subtipo') !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $book->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id' ]) !!}

                </div>
               
                <div class="form-group" >              
                    {!! Form::label('title', 'Título') !!}                    
                    {!! Form::text('title', $book->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Título' ]) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('subtitle', 'Tema de Portada') !!}                  
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Tema de Portada']) !!}
                </div>
              
                            
                <div class="form-group">
                    {!! Form::label('creators_id', 'Autor') !!}             
                    {!! Form::select('creators_id', $authors, $book->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('second_author', 'Segundo Autor') !!}             
                    {!! Form::select('second_author', $authors, null, ['class' => 'form-control  select2', 'id' => 'second_author']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('third_author', 'Tercer Autor') !!}  
                    {!! Form::select('third_author', [' ' => 'Seleccione Tercer Autor'] + $authors, null, ['class' => 'form-control  select2', 'id' => 'third_author', 'style' => 'width:100%;']) !!}
                </div>
                               
                <div class="form-group">
                    {!! Form::label('original_title', 'Título Original') !!} 
                    {!! Form::text('original_title', null, ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => 'Título Original']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('translator', 'Traductor') !!}                    
                    {!! Form::text('translator', null, ['class' => 'form-control', 'id' => 'translator', 'placeholder' => 'Traductor']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('isbn', 'Isbn') !!}                    
                    {!! Form::text('isbn', null, ['class' => 'form-control', 'id' => 'isbn', 'placeholder' => 'Isbn']) !!}
                </div> 
                <div class="form-group">
                    <label>Adquirido</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $book->document['acquired'] ? $book->document['acquired']->format('d/m/Y') : null) }}"                            
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
                            value="{{ old('drop', $book->document['drop'] ? $book->document['drop']->format('d/m/Y') : null) }}"                            
                            type="text"
                            id="drop"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div> 
                <div class="form-group">
                    {!! Form::label('adequacies_id', 'Adecuado Para') !!}             
                    {!! Form::select('adequacies_id', $adaptations, $book->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('generate_books_id', 'Genero') !!}             
                    {!! Form::select('generate_books_id', $genders, $book->generate_book['generate_books_id'], ['class' => 'form-control  select2', 'id' => 'generate_books_id', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registry_number', 'Número de Registro') !!}                    
                    {!! Form::text('registry_number', $book->document['registry_number'], ['class' => 'form-control', 'id' => 'registry_number', 'placeholder' => 'Número de Registro']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_author', 'let_author') !!}                    
                    {!! Form::text('let_author', $book->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', 'let_title') !!}                    
                    {!! Form::text('let_title', $book->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del titulo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cdu', 'Cdu') !!}                    
                    {!! Form::text('cdu', $book->document['cdu'], ['class' => 'form-control', 'id' => 'cdu', 'placeholder' => 'Cdu']) !!}
                </div>
                <div class="form-group">   
                    {!! Form::label('assessment', 'Valoración') !!}                    
                    {!! Form::text('assessment', $book->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => 'Valoración']) !!}
                </div>
                <div class="form-group">      
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::checkbox('desidherata', $book->document['desidherata'])!!}
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
                    {!! Form::label('published', 'Publicado En') !!} 
                    {!! Form::select('published', $publications, $book->document['published'], ['class' => 'form-control select2', 'id' => 'published']) !!}                                      
                </div>
                <div class="form-group">              
                    {!! Form::label('made_by', 'Editorial') !!}        
                    {!! Form::select('made_by', $editorials, $book->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by']) !!}                            
                </div>            
                <div class="form-group">
                    <label>Año de Publicación</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $book->document['year'] ? $book->document['year']->format('d/m/Y') : null) }}"                            
                            type="text"
                            id="year"
                            placeholder= "Selecciona Año de Publicación">                       
                    </div>                  
                </div>
                <div class="form-group">              
                    {!! Form::label('edition', 'Edición') !!}        
                    {!! Form::select('edition', $editions, null, ['class' => 'form-control  select2', 'id' => 'edition']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('volume', 'Volúmenes') !!}
                    {!! Form::select('volume', $volumes, $book->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume']) !!}            
                </div>
                <div class="form-group">                  
                    {!! Form::label('quantity_generic', 'Número de Paginas') !!}               
                    {!! Form::number('quantity_generic', $book->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => 'Número de Paginas']) !!}
                </div>
                <div class="form-group">                   
                    {!! Form::label('size', 'Tamaño') !!}               
                    {!! Form::text('size', null, ['class' => 'form-control', 'id' => 'size', 'placeholder' => 'Tamaño']) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('collection', 'Colección') !!}               
                    {!! Form::text('collection', $book->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => 'Colecciones']) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', 'Ubicación') !!}               
                    {!! Form::text('location', $book->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Ubicación']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lenguages_id', 'Idioma') !!} 
                    {!! Form::select('lenguages_id', $languages, $book->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id']) !!}                     
                </div>
             
                <div class="form-group">
                    <label>Observación</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="Ingresa una observación">{{ old('observation', $book->document['observation'])}}</textarea>
                </div>                
                <div class="form-group">
                    <label>Nota</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $book->document['note'])}}</textarea>
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
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el contenido completo de la publicacion">{{ old('synopsis', $book->document['synopsis'])}}</textarea>
                </div>
                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>





  