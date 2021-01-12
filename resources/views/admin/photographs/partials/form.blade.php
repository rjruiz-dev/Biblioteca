<div class="row">
{!! Form::model($photograph, [
    'route' => $photograph->exists ? ['admin.photographs.update', $photograph->id] : 'admin.photographs.store',   
    'method' => $photograph->exists ? 'PUT' : 'POST',
        'enctype' => 'multipart/form-data'
]) !!}

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $idioma_cat_edit_fotografia->compl_area_de_titulo }}</h3>
            </div>
            <div class="box-body">

            @if (!$photograph->exists)
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

        

                <div class="form-group"  id="fg_document_subtypes_id"><!-- documents V -->
                    {!! Form::label('document_subtypes_id', $idioma_cat_edit_fotografia->cuerpo_tipo_de_fotografia) !!}
                    {!! Form::select('document_subtypes_id', $subtypes, $photograph->document['document_subtypes_id'], ['class' => 'form-control select2', 'id' => 'document_subtypes_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">               
                    {!! Form::label('title', $idioma_cat_edit_fotografia->cuerpo_titulo) !!}                    
                    {!! Form::text('title', $photograph->document['title'], ['class' => 'form-control', 'id' => 'title', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_titulo]) !!}
                </div>
                
                 <div class="form-group">              
                    {!! Form::label('subtitle', $idioma_cat_edit_fotografia->cuerpo_subtitulo) !!}                    
                    {!! Form::text('subtitle', null, ['class' => 'form-control', 'id' => 'subtitle', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_subtitulo]) !!}
                </div>
                
                 <div class="form-group"  id="fg_creators_id">
                    {!! Form::label('creators_id', $idioma_cat_edit_fotografia->cuerpo_autor) !!}             
                    {!! Form::select('creators_id', $authors, $photograph->document['creators_id'], ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'creators_id','style' => 'width:100%;']) !!}
                </div> 

                <div class="form-group" id="fg_second_author_id">
                    {!! Form::label('second_author_id', $idioma_cat_edit_fotografia->cuerpo_segundo_autor) !!}             
                    {!! Form::select('second_author_id', $authors, null, ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'second_author_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group" id="din_third_author_id">
                    {!! Form::label('third_author_id', $idioma_cat_edit_fotografia->cuerpo_tercer_autor) !!}                    
                    {!! Form::select('third_author_id', $authors, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'third_author_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('original_title', $idioma_cat_edit_fotografia->cuerpo_titulo_original) !!} 
                    {!! Form::text('original_title', $photograph->document['original_title'], ['class' => 'form-control', 'id' => 'original_title', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_titulo_original]) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('producer', $idioma_cat_edit_fotografia->cuerpo_realizador) !!}             
                    {!! Form::text('producer', null, ['class' => 'form-control', 'id' => 'producer', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_realizador]) !!}
                 </div>

                 <div class="form-group">
                    <label>{{$idioma_cat_edit_fotografia->cuerpo_adquirido}}</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', $photograph->document['acquired'] ? $photograph->document['acquired']->format('d-m-Y') : null) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "{{$idioma_cat_edit_fotografia->ph_cuerpo_adquirido}}">                       
                    </div>                  
                </div>             

                <div class="form-group" id="fg_adequacies_id">
                    {!! Form::label('adequacies_id', $idioma_cat_edit_fotografia->cuerpo_adecuado_para) !!}             
                    {!! Form::select('adequacies_id', $adaptations, $photograph->document['adequacies_id'], ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'adequacies_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">              
                    {!! Form::label('let_author', $idioma_cat_edit_fotografia->cuerpo_siglas_autor) !!}                    
                    {!! Form::text('let_author', $photograph->document['let_author'], ['class' => 'form-control', 'id' => 'let_author', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_siglas_autor]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('let_title', $idioma_cat_edit_fotografia->cuerpo_siglas_titulo) !!}                    
                    {!! Form::text('let_title', $photograph->document['let_title'], ['class' => 'form-control', 'id' => 'let_title', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_siglas_titulo]) !!}
                </div>
                <div class="form-group" id="fg_generate_subjects_id">
                    {!! Form::label('generate_subjects_id', $idioma_cat_edit_fotografia->cuerpo_cdu) !!}             
                    {!! Form::select('generate_subjects_id', $subjects, $photograph->document['generate_subjects_id'], ['class' => 'form-control  select2', 'id' => 'generate_subjects_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div> 
                <div class="form-group">   
                    {!! Form::label('assessment', $idioma_cat_edit_fotografia->cuerpo_valoracion) !!}                    
                    {!! Form::text('assessment', $photograph->document['assessment'], ['class' => 'form-control', 'id' => 'assessment', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_valoracion]) !!}
                </div>

                <div class="form-group" style="{{{ $visible_desidherata }}}">      
                    {!! Form::label('desidherata', $idioma_cat_edit_fotografia->cuerpo_desidherata) !!}                    
                    {!! Form::checkbox('desidherata', '1')!!}
                </div>

                <div class="form-group" id="fg_status_documents_id" style="{{{ $visible_status_doc }}}">
                    {!! Form::label('status_documents_id', $idioma_cat_edit_fotografia->cuerpo_estado) !!}             
                    {!! Form::select('status_documents_id', $status_documents, $photograph->document['status_documents_id'], ['class' => 'form-control  select2', 'id' => 'status_documents_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}    
                </div> 
   
            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$idioma_cat_edit_fotografia->compl_area_de_edicion}}</h3>                
            </div>
            <div class="box-body">   
                <div class="form-group"  id="fg_published">                       
                    {!! Form::label('published', $idioma_cat_edit_fotografia->cuerpo_editado_en) !!} 
                    {!! Form::select('published', $publications, $photograph->document['published'], ['class' => 'form-control select2', 'id' => 'published', 'placeholder' => '',  'style' => 'width:100%;']) !!}                                      
                </div>
                <div class="form-group" id="fg_made_by">              
                    {!! Form::label('made_by', $idioma_cat_edit_fotografia->cuerpo_sello_discografico) !!}                    
                    {!! Form::select('made_by', $editorials, $photograph->document['made_by'], ['class' => 'form-control  select2', 'id' => 'made_by', 'placeholder' => '',  'style' => 'width:100%;']) !!}                            
                </div>
                            
                <div class="form-group">
                    <label>{{$idioma_cat_edit_fotografia->cuerpo_anio_de_publicacion}}</label>
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
                            placeholder= "{{$idioma_cat_edit_fotografia->ph_cuerpo_anio_de_publicacion}}">                       
                    </div>                  
                </div>

                <div class="form-group"  id="fg_edition">
                    {!! Form::label('edition', $idioma_cat_edit_fotografia->cuerpo_edicion) !!}                    
                    {!! Form::text('edition', null, ['class' => 'form-control', 'id' => 'edition', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_edicion]) !!}
                </div> 
                <div class="form-group" id="fg_volume">
                    {!! Form::label('volume', $idioma_cat_edit_fotografia->cuerpo_volumenes) !!}
                    {!! Form::select('volume', $volumes, $photograph->document['volume'], ['class' => 'form-control  select2', 'id' => 'volume', 'placeholder' => '',  'style' => 'width:100%;']) !!}            
                </div>

                <div class="form-group">                 
                    {!! Form::label('quantity_generic', $idioma_cat_edit_fotografia->cuerpo_numero_de_diapositivas) !!}               
                    {!! Form::text('quantity_generic', $photograph->document['quantity_generic'], ['class' => 'form-control', 'id' => 'quantity_generic', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_numero_de_diapositivas]) !!}
                </div>

                <div class="form-group" id="fg_generate_formats_id">                  
                    {!! Form::label('generate_formats_id', $idioma_cat_edit_fotografia->cuerpo_formato) !!}             
                    {!! Form::select('generate_formats_id', $formats, null, ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'generate_formats_id', 'style' => 'width:100%;']) !!}
                </div>

                <div class="form-group">                 
                    {!! Form::label('collection', $idioma_cat_edit_fotografia->cuerpo_coleccion) !!}               
                    {!! Form::text('collection', $photograph->document['collection'], ['class' => 'form-control', 'id' => 'collection', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_coleccion]) !!}
                </div>

                <div class="form-group">                 
                    {!! Form::label('location', $idioma_cat_edit_fotografia->cuerpo_coleccion) !!}               
                    {!! Form::text('location', $photograph->document['location'], ['class' => 'form-control', 'id' => 'location', 'placeholder' => $idioma_cat_edit_fotografia->ph_cuerpo_coleccion]) !!}
                </div>

                <div class="form-group">
                    <label>{{$idioma_cat_edit_fotografia->cuerpo_obsevacion}}</label>
                    <textarea name='observation' id='observation' rows="3" class="form-control" placeholder="{{$idioma_cat_edit_fotografia->ph_cuerpo_obsevacion}}">{{ old('observation', $photograph->document['observation'])}}</textarea>
                </div> 

                <div class="form-group">
                    <label>{{$idioma_cat_edit_fotografia->cuerpo_notas}}</label>
                    <textarea name='note' id='note' rows="3" class="form-control" placeholder="{{$idioma_cat_edit_fotografia->ph_cuerpo_notas}}">{{ old('note', $photograph->document['note'])}}</textarea>
                </div>
            
                <div class="form-group" id="fg_lenguages_id">
                    {!! Form::label('lenguages_id', $idioma_cat_edit_fotografia->cuerpo_idioma) !!} 
                    {!! Form::select('lenguages_id', $languages, $photograph->document['lenguages_id'], ['class' => 'form-control  select2', 'placeholder' => '', 'id' => 'lenguages_id', 'style' => 'width:100%;']) !!}                     
                </div>               
                <div class="form-group" id="fg_references">
                    <label>{{$idioma_cat_edit_fotografia->cuerpo_referencia}}</label>
                    <select name="references[]" id="references" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="{{$idioma_cat_edit_fotografia->ph_cuerpo_referencia}}" style="width: 100%;">
                        @foreach($references as $reference)
                            <option {{ collect( old('references', $document->references->pluck('id')))->contains($reference->id) ? 'selected' : '' }} value="{{ $reference->id}}"> {{ $reference->reference_description }} </option>
                        @endforeach
                    </select>
                </div>  
                <div class="form-group">
                    {!! Form::label('photo', $idioma_cat_edit_fotografia->cuerpo_imagen) !!}                    
                    {!! Form::file('photo') !!}
                </div>
            </div>
        </div>       
    </div> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$idioma_cat_edit_fotografia->compl_area_de_contenidos}}</h3>                
            </div>
            <div class="box-body">
                <div class="form-group">
                <label>{{$idioma_cat_edit_fotografia->cuerpo_sinopsis}}</label>
                    <textarea name="synopsis" id="synopsis" rows="10" class="form-control" placeholder="{{$idioma_cat_edit_fotografia->ph_cuerpo_sinopsis}}">{{ old('synopsis', $photograph->document['synopsis'])}}</textarea>
                </div>
                              
            </div>
        </div>       
    </div>   
{!! Form::close() !!}    
</div>