<div class="row">
{!! Form::model($photograph, [
    'route' => $photograph->exists ? ['admin.photographs.update', $photograph->id] : 'admin.photographs.store',   
    'method' => $photograph->exists ? 'PUT' : 'POST',
        'enctype' => 'multipart/form-data'
]) !!}

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area de Titulo</h3>
            </div>
            <div class="box-body">

                @if (!$photograph->exists)
                    @php 
                        $visible = "display:none"
                    @endphp
                @else
                    @php  
                        $visible = ""
                    @endphp
                @endif

        

                <div class="form-group"><!-- documents V -->
                    {!! Form::label('document_subtypes_id', 'Tipo de Fotografia') !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $photograph->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">               
                    {!! Form::label('title', 'Título') !!}                    
                    {!! Form::text('title', $photograph->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Título']) !!}
                </div>
                
                 <div class="form-group">              
                    {!! Form::label('subtitle', 'Subtítulo') !!}                    
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Subtítulo']) !!}
                </div>
                
                 <div class="form-group">
                    {!! Form::label('creators_id', 'Autor') !!}             
                    {!! Form::select('creators_id', $authors, $photograph->document['creators_id'], ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'creators_id','style' => 'width:100%;']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('second_author_id', 'Segundo Autor') !!}             
                    {!! Form::select('second_author_id', $authors, null, ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'second_author_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('third_author_id', 'Tercer Autor') !!}                    
                    {!! Form::select('third_author_id', $authors, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'third_author_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('original_title', 'Título Original') !!} 
                    {!! Form::text('original_title', $photograph->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => 'Título Original']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('producer', 'Realizador') !!}             
                    {!! Form::text('producer', null, ['class' => 'form-control', 'id' => 'producer', 'placeholder' => 'Realizador']) !!}
                 </div>

                 <div class="form-group">
                    <label>Adquirido</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $photograph->document['acquired'] ? $photograph->document['acquired']->format('d-m-Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "Selecciona una Fecha de Adquisición">                       
                    </div>                  
                </div>             

                <div class="form-group">
                    {!! Form::label('adequacies_id', 'Adecuado Para') !!}             
                    {!! Form::select('adequacies_id', $adaptations, $photograph->document['adequacies_id'], ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'adequacies_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('let_author', 'Siglas Autor') !!}                    
                    {!! Form::text('let_author', $photograph->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del Autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', 'Siglas Título') !!}                    
                    {!! Form::text('let_title', $photograph->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del Título']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('generate_subjects_id', 'Cdu') !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $photograph->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', 'Valoración') !!}                    
                    {!! Form::text('assessment', $photograph->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => 'Valoración']) !!}
                </div>

                <div class="form-group">      
                    {!! Form::label('desidherata', 'Desidherata') !!}                    
                    {!! Form::checkbox('desidherata', $photograph->document['desidherata'])!!}
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
                    {!! Form::label('published', 'Editado En') !!} 
                    {!! Form::select('published', $publications, $photograph->document['published'], ['class' => 'form-control select2', 'id' => 'published', 'placeholder' => '',  'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group">              
                    {!! Form::label('made_by', 'Sello Discografico') !!}                    
                    {!! Form::select('made_by', $editorials, $photograph->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div>
                            
                <div class="form-group">
                    <label>Año de Publicación</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $photograph->document['year'] ? $photograph->document['year']->format('Y') : null) }}"                            
                            type="text"
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
                    {!! Form::label('volume', 'Volúmenes') !!}
                    {!! Form::select('volume', $volumes, $photograph->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume', 'placeholder' => '',  'style' => 'width:100%;']) !!}            
                </div>

                <div class="form-group">                 
                    {!! Form::label('quantity_generic', 'N° Diapositivas') !!}               
                    {!! Form::text('quantity_generic', $photograph->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => 'N° Diapositivas']) !!}
                </div>

                <div class="form-group">                  
                    {!! Form::label('generate_formats_id', 'Formato') !!}             
                    {!! Form::select('generate_formats_id', $formats, null, ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'generate_formats_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">                 
                    {!! Form::label('collection', 'Colección') !!}               
                    {!! Form::text('collection', $photograph->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => 'Colección']) !!}
                </div>

                <div class="form-group">                 
                    {!! Form::label('location', 'Ubicación') !!}               
                    {!! Form::text('location', $photograph->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Ubicación']) !!}
                </div>

                <div class="form-group">
                    <label>Observaciónes</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="Ingresa una observación">{{ old('observation', $photograph->document['observation'])}}</textarea>
                </div> 

                <div class="form-group">
                    <label>Notas</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $photograph->document['note'])}}</textarea>
                </div>
            
                <div class="form-group">
                    {!! Form::label('lenguages_id', 'Idioma') !!} 
                    {!! Form::select('lenguages_id', $languages, $photograph->document['lenguages_id'], ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'lenguages_id', 'style' => 'width:100%;']) !!}                     
                </div>               
                <div class="form-group">
                    <label>Referencia</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="Selecciona o Ingresa uno o mas Referencias" style="width: 100%;">
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
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el Contenido, Sinopsis o Índice">{{ old('synopsis', $photograph->document['synopsis'])}}</textarea>
                </div>
                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>