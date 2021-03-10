<div class="row">
{!! Form::model($book, [
    'route' => $book->exists ? ['admin.books.update', $book->id] : 'admin.books.store',   
    'method' => $book->exists ? 'PUT' : 'POST',
    'enctype' => 'multipart/form-data'
]) !!}

    


    @if (!$book->exists)<!-- SI NO EXISTE, OSEA SI ES NUEVO --> 
        @php 
            $visible_status_doc = "display:none";
            $visible_desidherata = "";
        @endphp
    @else

            @php 
            $visible_desidherata = "display:none";
            @endphp

        @if ($book->document['status_documents_id'] == 100)
            @php  
            $visible_status_doc = "display:none";
            @endphp
        @else
            @php  
            $visible_status_doc = "";
            @endphp
        @endif

    @endif       

    <div class="col-md-6">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_cat_edit_book->compl_area_de_titulo }}</h3>
            </div>
            <div class="box-body">
                {{ csrf_field() }}
                <div class="form-group" id="fg_document_subtypes_id">
                    {!! Form::label('document_subtypes_id', $idioma_cat_edit_book->cuerpo_tipo_de_libro) !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $book->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id', 'placeholder' => '',  'onchange' => 'yesnoCheck()', 'style' => 'width:100%;']) !!}

                </div>
               
                <div class="form-group" >              
                    {!! Form::label('title', $idioma_cat_edit_book->cuerpo_titulo) !!}                    
                    {!! Form::text('title', $book->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_titulo ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('subtitle', '', ['id' => 'l_subtitle']) !!}                  
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle']) !!}
                </div>
                <!-- pub periodica -->
                <div class="form-group" id="din_volume_number_date">               
                    {!! Form::label('volume_number_date', $idioma_cat_edit_book->cuerpo_volumen_numero_fecha) !!}                  
                    {!! Form::text('volume_number_date', $book->periodical_publication['volume_number_date'], ['class' => 'form-control', 'id' => 'volume_number_date', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_volumen_numero_fecha]) !!}
                </div>      
                <div class="form-group" id="fg_creators_id">
                    {!! Form::label('creators_id', $idioma_cat_edit_book->cuerpo_autor) !!}             
                    {!! Form::select('creators_id', $authors, $book->document['creators_id'], ['class' => 'form-control  select2', 'id' => 'creators_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group" id="fg_second_author_id">
                    {!! Form::label('second_author_id', $idioma_cat_edit_book->ph_cuerpo_segundo_autor) !!}             
                    {!! Form::select('second_author_id', $authors, null, ['class' => 'form-control  select2', 'id' => 'second_author_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group" id="din_third_author_id"> 
                    {!! Form::label('third_author_id', $idioma_cat_edit_book->ph_cuerpo_tercer_autor) !!}                    
                    {!! Form::select('third_author_id', $authors, null, ['class' => 'form-control select2', 'id' => 'third_author_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>                                        
                <div class="form-group">
                    {!! Form::label('original_title', $idioma_cat_edit_book->cuerpo_titulo_original) !!} 
                    {!! Form::text('original_title', $book->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => $idioma_cat_edit_book->cuerpo_titulo_original]) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('translator', $idioma_cat_edit_book->cuerpo_traductor) !!}                    
                    {!! Form::text('translator', null, ['class' => 'form-control', 'id' => 'translator', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_traductor]) !!}
                </div> 
                <div class="form-group" id="din_isbn">              
                    {!! Form::label('isbn', $idioma_cat_edit_book->cuerpo_isbn) !!}                    
                    {!! Form::text('isbn', null, ['class' => 'form-control', 'id' => 'isbn', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_isbn]) !!}
                </div> 
               
                <div class="form-group">
                    <label>{{ $idioma_cat_edit_book->cuerpo_adquirido }}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $book->document['acquired'] ? $book->document['acquired']->format('d-m-Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "{{ $idioma_cat_edit_book->ph_cuerpo_adquirido }}">                       
                    </div>                  
                </div>
                
                <div class="form-group"  id="fg_adequacies_id">
                    {!! Form::label('adequacies_id', $idioma_cat_edit_book->cuerpo_adecuado_para ) !!}             
                    {!! Form::select('adequacies_id', $adaptations, $book->document['adequacies_id'], ['class' => 'form-control  select2', 'id' => 'adequacies_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}
                </div>
                <!-- lit o otros -->
                <div class="form-group" id="din_generate_books_id"> 
                    {!! Form::label('generate_books_id', $idioma_cat_edit_book->cuerpo_otros, ['id' => 'l_generate_books_id']) !!}             
                    {!! Form::select('generate_books_id', $genders, $book->generate_book['generate_books_id'], ['class' => 'form-control  select2', 'id' => 'generate_books_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>
                <div class="form-group"  id="din_periodicities_id">                       
                    {!! Form::label('periodicities_id', $idioma_cat_edit_book->cuerpo_periodicidad) !!} 
                    {!! Form::select('periodicities_id', $periodicities, $book->periodical_publication['periodicities_id'], ['class' => 'form-control select2', 'id' => 'periodicities_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group" id="din_issn">              
                    {!! Form::label('issn', $idioma_cat_edit_book->cuerpo_issn) !!}                  
                    {!! Form::text('issn', $book->periodical_publication['issn'], ['class' => 'form-control', 'id' => 'issn', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_issn]) !!}
                </div>
              
                <div class="form-group" >              
                    {!! Form::label('let_author', $idioma_cat_edit_book->cuerpo_siglas_autor) !!}                    
                    {!! Form::text('let_author', $book->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_siglas_autor]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', $idioma_cat_edit_book->cuerpo_siglas_titulo) !!}                    
                    {!! Form::text('let_title', $book->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_siglas_titulo]) !!}
                </div>
                <div class="form-group" id="fg_generate_subjects_id">
                    {!! Form::label('generate_subjects_id', $idioma_cat_edit_book->cuerpo_cdu) !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $book->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', $idioma_cat_edit_book->cuerpo_valoracion) !!}                    
                    {!! Form::text('assessment', $book->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_valoracion]) !!}
                </div>
                <div class="form-group" style="{{{ $visible_desidherata }}}">      
                    {!! Form::label('desidherata', $idioma_cat_edit_book->cuerpo_desidherata) !!}                    
                    {!! Form::checkbox('desidherata', '1')!!}
                </div>

                <div class="form-group" id="fg_status_documents_id" style="{{{ $visible_status_doc }}}">
                {!! Form::label('status_documents_id', $idioma_cat_edit_book->cuerpo_estado) !!}             
                {!! Form::select('status_documents_id', $status_documents, $book->document['status_documents_id'], ['class' => 'form-control  select2', 'id' => 'status_documents_id', 'style' => 'width:100%;']) !!}    
                </div>
            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_cat_edit_book->compl_area_de_edicion }}</h3>                
            </div>
            <div class="box-body">   
                <div class="form-group" id="fg_published">                       
                    {!! Form::label('published', $idioma_cat_edit_book->cuerpo_publicado_en) !!} 
                    {!! Form::select('published', $publications, $book->document['published'], ['class' => 'form-control select2', 'id' => 'published', 'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group" id="fg_made_by">              
                    {!! Form::label('made_by', $idioma_cat_edit_book->cuerpo_editorial) !!}        
                    {!! Form::select('made_by', $editorials, $book->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div>            
                <div class="form-group">
                    <label>{{ $idioma_cat_edit_book->cuerpo_anio_de_publicacion }}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="year"
                            class="form-control pull-right"                                                       
                            value="{{ old('year', $book->document['year'] ? $book->document['year']->format('Y') : null) }}"                            
                            type="text"
                            id="year"
                            placeholder= "Selecciona {{{ $idioma_cat_edit_book->ph_cuerpo_anio_de_publicacion }}}">                       
                    </div>                  
                </div>
                <div class="form-group"  id="fg_edition">              
                    {!! Form::label('edition', $idioma_cat_edit_book->cuerpo_edicion) !!}        
                    {!! Form::select('edition', $editions, null, ['class' => 'form-control  select2', 'id' => 'edition', 'placeholder' => '', 'style' => 'width:100%;']) !!}                            
                </div>
                <div class="form-group" id="fg_volume">
                    {!! Form::label('volume', $idioma_cat_edit_book->ph_cuerpo_volumenes) !!}
                    {!! Form::select('volume', $volumes, $book->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume', 'placeholder' => '',  'style' => 'width:100%;']) !!}            
                </div>
                <div class="form-group">                  
                    {!! Form::label('quantity_generic', $idioma_cat_edit_book->cuerpo_numero_de_paginas) !!}               
                    {!! Form::text('quantity_generic', $book->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_numero_de_paginas]) !!}
                </div>
                <div class="form-group">                   
                    {!! Form::label('size', $idioma_cat_edit_book->cuerpo_tamanio) !!}               
                    {!! Form::text('size', null, ['class' => 'form-control', 'id' => 'size', 'placeholder' =>  $idioma_cat_edit_book->ph_cuerpo_tamanio ]) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('collection', $idioma_cat_edit_book->cuerpo_coleccion ) !!}               
                    {!! Form::text('collection', $book->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' =>  $idioma_cat_edit_book->ph_cuerpo_coleccion ]) !!}
                </div>
                <div class="form-group">                 
                    {!! Form::label('location', $idioma_cat_edit_book->cuerpo_ubicacion) !!}               
                    {!! Form::text('location', $book->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => $idioma_cat_edit_book->ph_cuerpo_ubicacion ]) !!}
                </div>
                <div class="form-group" id="fg_lenguages_id">
                    {!! Form::label('lenguages_id', $idioma_cat_edit_book->cuerpo_idioma) !!} 
                    {!! Form::select('lenguages_id', $languages, $book->document['lenguages_id'], ['class' => 'form-control  select2', 'id' => 'lenguages_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                     
                </div>
                <div class="form-group" id="fg_references">
                    <label>{{ $idioma_cat_edit_book->cuerpo_referencia }}</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="{{ $idioma_cat_edit_book->ph_cuerpo_referencia }}" style="width: 100%;">
                        @foreach($references as $reference)
                            <option {{ collect( old('references', $document->references->pluck('id')))->contains($reference->id) ? 'selected' : '' }} value="{{ $reference->id}}"> {{ $reference->reference_description }} </option>
                        @endforeach
                    </select>
                </div>
             
                <div class="form-group">
                    <label>{{ $idioma_cat_edit_book->cuerpo_observacion }}</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="{{ $idioma_cat_edit_book->ph_cuerpo_observacion }}">{{ old('observation', $book->document['observation'])}}</textarea>
                </div>                
                <div class="form-group">
                    <label>{{ $idioma_cat_edit_book->cuerpo_nota }}</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="{{ $idioma_cat_edit_book->ph_cuerpo_nota }}">{{ old('note', $book->document['note'])}}</textarea>
                </div>
                
                <div class="form-group">
                    {!! Form::label('photo', $idioma_cat_edit_book->cuerpo_fotografia) !!}                    
                    {!! Form::file('photo') !!}
                </div>

            </div>
        </div>       
    </div> 
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_cat_edit_book->compl_area_de_contenidos }}</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                <label>{{ $idioma_cat_edit_book->cuerpo_sinopsis }}</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="{{ $idioma_cat_edit_book->ph_cuerpo_sinopsis }}">{{ old('synopsis', $book->document['synopsis'])}}</textarea>
                </div>                              
            </div>
         
        </div>       
    </div>   
{!! Form::close() !!}    
</div>
<script>
document.getElementById("modal-btn-save").disabled = false;
// document.getElementById('modal-btn-save').style.visibility = 'hidden';
</script>




  