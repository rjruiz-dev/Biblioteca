<div class="row">
{!! Form::model($book, [
    'route' => $book->exists ? ['admin.books.update', $book->id] : 'admin.books.store',   
    'method' => $book->exists ? 'PUT' : 'POST',
    'enctype' => 'multipart/form-data'
]) !!}

    @if (!$book->exists)
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
                <h3 class="box-title">{{ $idioma_abm_doc->area_de_titulo }}</h3>
            </div>
            <div class="box-body">
                {{ csrf_field() }}
                <div class="form-group">
                    {!! Form::label('document_subtypes_id', $idioma_abm_book->tipo_de_libro) !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $book->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id', 'placeholder' => '',  'onchange' => 'yesnoCheck()', 'style' => 'width:100%;']) !!}

                </div>
               
                <div class="form-group" >              
                    {!! Form::label('title', $idioma_abm_doc->titulo) !!}                    
                    {!! Form::text('title', $book->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => $idioma_abm_doc->titulo ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('subtitle', 'Subtitulo', ['id' => 'l_subtitle']) !!}                  
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => 'Tema de Portada']) !!}
                </div>
                <!-- pub periodica -->
                <div class="form-group" id="din_volume_number_date">               
                    {!! Form::label('volume_number_date', 'Volumen, Número y Fecha') !!}                  
                    {!! Form::text('volume_number_date', $book->periodical_publication['volume_number_date'], ['class' => 'form-control', 'id' => 'volume_number_date', 'placeholder' => 'Volumen, Número y Fecha']) !!}
                </div>      
                <div class="form-group">
                    {!! Form::label('creators_id', $idioma_abm_doc->autor) !!}             
                    {!! Form::select('creators_id', $authors, $book->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('second_author_id', $idioma_abm_doc->segundo_autor) !!}             
                    {!! Form::select('second_author_id', $authors, null, ['class' => 'form-control  select2', 'id' => 'second_author_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="din_third_author_id"> 
                    {!! Form::label('third_author_id', $idioma_abm_doc->tercer_autor) !!}                    
                    {!! Form::select('third_author_id', $authors, null, ['class' => 'form-control select2', 'id' => 'third_author_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>                                        
                <div class="form-group">
                    {!! Form::label('original_title', $idioma_abm_doc->título_original) !!} 
                    {!! Form::text('original_title', $book->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => $idioma_abm_doc->título_original]) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('translator', $idioma_abm_doc->traductor) !!}                    
                    {!! Form::text('translator', null, ['class' => 'form-control', 'id' => 'translator', 'placeholder' => $idioma_abm_doc->traductor]) !!}
                </div> 
                <div class="form-group" id="din_isbn">              
                    {!! Form::label('isbn', 'Isbn') !!}                    
                    {!! Form::text('isbn', null, ['class' => 'form-control', 'id' => 'isbn', 'placeholder' => 'Isbn']) !!}
                </div> 
               
                <div class="form-group">
                    <label>{{ $idioma_abm_doc->adquirido }}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $book->document['acquired'] ? $book->document['acquired']->format('d-m-Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div>
                
                <div class="form-group">
                    {!! Form::label('adequacies_id', $idioma_abm_doc->adecuado_para ) !!}             
                    {!! Form::select('adequacies_id', $adaptations, $book->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div>
                <!-- lit o otros -->
                <div class="form-group" id="din_generate_books_id"> 
                    {!! Form::label('generate_books_id', 'Otros', ['id' => 'l_generate_books_id']) !!}             
                    {!! Form::select('generate_books_id', $genders, $book->generate_book['generate_books_id'], ['class' => 'form-control  select2', 'id' => 'generate_books_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group"  id="din_periodicities_id">                       
                    {!! Form::label('periodicities_id', 'Periodicidad') !!} 
                    {!! Form::select('periodicities_id', $periodicities, $book->periodical_publication['periodicities_id'], ['class' => 'form-control select2', 'id' => 'periodicities_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group" id="din_issn">              
                    {!! Form::label('issn', 'Issn') !!}                  
                    {!! Form::text('issn', $book->periodical_publication['issn'], ['class' => 'form-control', 'id' => 'issn', 'placeholder' => 'Issn']) !!}
                </div>
              
                <div class="form-group">              
                    {!! Form::label('let_author', $idioma_abm_doc->siglas_autor) !!}                    
                    {!! Form::text('let_author', $book->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => 'Ingresar 3 letras del autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', $idioma_abm_doc->siglas_titulo) !!}                    
                    {!! Form::text('let_title', $book->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => 'Ingresar 3 letras del titulo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('generate_subjects_id', $idioma_abm_doc->cdu) !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $book->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', $idioma_abm_doc->valoración) !!}                    
                    {!! Form::text('assessment', $book->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => $idioma_abm_doc->valoración]) !!}
                </div>
                <div class="form-group" style="{{{ $visible_desidherata }}}">      
                    {!! Form::label('desidherata', $idioma_abm_doc->desidherata) !!}                    
                    {!! Form::checkbox('desidherata', '1')!!}
                </div>

                <div class="form-group" style="{{{ $visible_status_doc }}}">
                {!! Form::label('status_documents_id', 'Estado') !!}             
                {!! Form::select('status_documents_id', $status_documents, $book->document['status_documents_id'], ['class' => 'form-control  select2', 'id' => 'status_documents_id', 'style' => 'width:100%;']) !!}    
                </div>
            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_abm_doc->area_de_edición }}</h3>                
            </div>
            <div class="box-body">   
                <div class="form-group">                       
                    {!! Form::label('published', $idioma_abm_doc->publicado_en) !!} 
                    {!! Form::select('published', $publications, $book->document['published'], ['class' => 'form-control select2', 'id' => 'published', 'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group">              
                    {!! Form::label('made_by', $idioma_abm_doc->editorial) !!}        
                    {!! Form::select('made_by', $editorials, $book->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div>            
                <div class="form-group">
                    <label>{{ $idioma_abm_doc->anio_de_publicación }}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $book->document['year'] ? $book->document['year']->format('Y') : null) }}"                            
                            type="text"
                            id="year"
                            placeholder= "Selecciona {{{ $idioma_abm_doc->anio_de_publicación }}}">                       
                    </div>                  
                </div>
                <div class="form-group">              
                    {!! Form::label('edition', $idioma_abm_doc->edicion) !!}        
                    {!! Form::select('edition', $editions, null, ['class' => 'form-control  select2', 'id' => 'edition', 'placeholder' => '', 'style' => 'width:100%;']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('volume', $idioma_abm_doc->volumenes) !!}
                    {!! Form::select('volume', $volumes, $book->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume', 'placeholder' => '',  'style' => 'width:100%;']) !!}            
                </div>
                <div class="form-group">                  
                    {!! Form::label('quantity_generic', $idioma_abm_book->numero_de_paginas) !!}               
                    {!! Form::number('quantity_generic', $book->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => $idioma_abm_book->numero_de_paginas]) !!}
                </div>
                <div class="form-group">                   
                    {!! Form::label('size', $idioma_abm_doc->tamanio) !!}               
                    {!! Form::text('size', null, ['class' => 'form-control', 'id' => 'size', 'placeholder' =>  $idioma_abm_doc->tamanio ]) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('collection', $idioma_abm_doc->coleccion ) !!}               
                    {!! Form::text('collection', $book->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' =>  $idioma_abm_doc->coleccion ]) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', $idioma_abm_doc->ubicacion) !!}               
                    {!! Form::text('location', $book->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => $idioma_abm_doc->ubicacion ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lenguages_id', $idioma_abm_doc->idioma) !!} 
                    {!! Form::select('lenguages_id', $languages, $book->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group">
                    <label>{{ $idioma_abm_doc->referencia }}</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="Selecciona o Ingresa uno o mas Referencias" style="width: 100%;">
                        @foreach($references as $reference)
                            <option {{ collect( old('references', $document->references->pluck('id')))->contains($reference->id) ? 'selected' : '' }} value="{{ $reference->id}}"> {{ $reference->reference_description }} </option>
                        @endforeach
                    </select>
                </div>
             
                <div class="form-group">
                    <label>{{ $idioma_abm_doc->observacion }}</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="Ingresa una observación">{{ old('observation', $book->document['observation'])}}</textarea>
                </div>                
                <div class="form-group">
                    <label>Nota</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="Ingresa una nota">{{ old('note', $book->document['note'])}}</textarea>
                </div>
                
                <div class="form-group">
                    {!! Form::label('photo', $idioma_abm_doc->fotografia) !!}                    
                    {!! Form::file('photo') !!}
                </div>

            </div>
        </div>       
    </div> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_abm_doc->area_de_contenidos }}</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                <label>{{ $idioma_abm_doc->contenido_sinopsis_o_indice }}</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="Ingresa el contenido completo de la publicacion">{{ old('synopsis', $book->document['synopsis'])}}</textarea>
                </div>                              
            </div>
         
        </div>       
    </div>   
{!! Form::close() !!}    
</div>





  