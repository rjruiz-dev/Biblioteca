<div class="row">
   
{!! Form::open([
    'route' => ['admin.manylenguages.update_book', $idioma->id],   
    'method' => 'PUT'
]) !!}

{{ csrf_field() }}   

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Idioma</h3>
                </div>
            </div>            
            <div class="box-body">
                <div class="form-group" > 
                    {!! Form::label('lenguage_description', 'Idioma') !!}                                  
                    {!! Form::text('lenguage_description', $idioma['lenguage_description'] ? $idioma['lenguage_description'] : null, ['class' => 'form-control', 'id' => 'lenguage_description', 'placeholder' => 'Idioma', 'readonly' => true ]) !!}
                </div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Catalogo Libros</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Titulos Cabeceras </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-6">                    

                        <div class="form-group">              
                            {!! Form::label('cuerpo_desidherata', 'Desidherata') !!}                    
                            {!! Form::text('cuerpo_desidherata', $ml_cat_edit_book['cuerpo_desidherata'] ? $ml_cat_edit_book['cuerpo_desidherata'] : null, ['class' => 'form-control', 'id' => 'cuerpo_desidherata', 'placeholder' => 'Desidherata']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_area_de_titulo', 'Area de Titulo') !!}                    
                            {!! Form::text('compl_area_de_titulo', $ml_cat_edit_book['compl_area_de_titulo'] ? $ml_cat_edit_book['compl_area_de_titulo'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_titulo', 'placeholder' => 'Area de Titulo']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_btn_cancelar', 'Boton Cancelar') !!}                    
                            {!! Form::text('compl_btn_cancelar', $ml_cat_edit_book['compl_btn_cancelar'] ? $ml_cat_edit_book['compl_btn_cancelar'] : null, ['class' => 'form-control', 'id' => 'compl_btn_cancelar', 'placeholder' => 'Boton Cancelar']) !!}
                        </div> 
                                                            
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">              
                            {!! Form::label('compl_area_de_edicion', 'Area de Edicion') !!}                    
                            {!! Form::text('compl_area_de_edicion', $ml_cat_edit_book['compl_area_de_edicion'] ? $ml_cat_edit_book['compl_area_de_edicion'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_edicion', 'placeholder' => 'Area de Edicion']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_area_de_contenidos', 'Area de Contenidos') !!}                    
                            {!! Form::text('compl_area_de_contenidos', $ml_cat_edit_book['compl_area_de_contenidos'] ? $ml_cat_edit_book['compl_area_de_contenidos'] : null, ['class' => 'form-control', 'id' => 'compl_area_de_contenidos', 'placeholder' => 'Area de Contenidos']) !!}
                        </div>
                        <div class="form-group">              
                            {!! Form::label('compl_btn_guardar', 'Boton Guardar') !!}                    
                            {!! Form::text('compl_btn_guardar', $ml_cat_edit_book['compl_btn_guardar'] ? $ml_cat_edit_book['compl_btn_guardar'] : null, ['class' => 'form-control', 'id' => 'compl_btn_guardar', 'placeholder' => 'Boton Guardar']) !!}
                        </div>
                    </div>
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-12">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Campos y descripcion de los mismos </h3>
                </div>
            </div>
            <div class="box-body">  
            <div class="col-md-4">            
                <div class="form-group">              
                    {!! Form::label('cuerpo_tipo_de_libro', 'Tipo de libro(Titulo)') !!}                    
                    {!! Form::text('cuerpo_tipo_de_libro', $ml_cat_edit_book['cuerpo_tipo_de_libro'] ? $ml_cat_edit_book['cuerpo_tipo_de_libro'] : null, ['class' => 'form-control', 'id' => 'cuerpo_tipo_de_libro', 'placeholder' => 'Tipo de libro(Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_tipo_de_libro', 'Tipo de libro(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_tipo_de_libro', $ml_cat_edit_book['ph_cuerpo_tipo_de_libro'] ? $ml_cat_edit_book['ph_cuerpo_tipo_de_libro'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_tipo_de_libro', 'placeholder' => 'Tipo de libro(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo', 'Titulo(Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo', $ml_cat_edit_book['cuerpo_titulo'] ? $ml_cat_edit_book['cuerpo_titulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo', 'placeholder' => 'Titulo(Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo', 'Titulo(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo', $ml_cat_edit_book['ph_cuerpo_titulo'] ? $ml_cat_edit_book['ph_cuerpo_titulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo', 'placeholder' => 'Titulo(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_tema_portada', 'Tema de portada(Titulo)') !!}                    
                    {!! Form::text('cuerpo_tema_portada', $ml_cat_edit_book['cuerpo_tema_portada'] ? $ml_cat_edit_book['cuerpo_tema_portada'] : null, ['class' => 'form-control', 'id' => 'cuerpo_tema_portada', 'placeholder' => 'Tema de portada(Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_tema_portada', 'Tema de portada(Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_tema_portada', $ml_cat_edit_book['ph_cuerpo_tema_portada'] ? $ml_cat_edit_book['ph_cuerpo_tema_portada'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_tema_portada', 'placeholder' => 'Tema de portada(Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_volumen_numero_fecha', 'Volumen, numero,fecha (Titulo)') !!}                    
                    {!! Form::text('cuerpo_volumen_numero_fecha', $ml_cat_edit_book['cuerpo_volumen_numero_fecha'] ? $ml_cat_edit_book['cuerpo_volumen_numero_fecha'] : null, ['class' => 'form-control', 'id' => 'cuerpo_volumen_numero_fecha', 'placeholder' => 'Volumen, numero,fecha (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_volumen_numero_fecha', 'Volumen, numero,fecha (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_volumen_numero_fecha', $ml_cat_edit_book['ph_cuerpo_volumen_numero_fecha'] ? $ml_cat_edit_book['ph_cuerpo_volumen_numero_fecha'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_volumen_numero_fecha', 'placeholder' => 'Volumen, numero,fecha (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_subtitulo', 'Subtitulo (Titulo)') !!}                    
                    {!! Form::text('cuerpo_subtitulo', $ml_cat_edit_book['cuerpo_subtitulo'] ? $ml_cat_edit_book['cuerpo_subtitulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_subtitulo', 'placeholder' => 'Subtitulo (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_subtitulo', 'Subtitulo (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_subtitulo', $ml_cat_edit_book['ph_cuerpo_subtitulo'] ? $ml_cat_edit_book['ph_cuerpo_subtitulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_subtitulo', 'placeholder' => 'Subtitulo (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_autor', 'Autor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_autor', $ml_cat_edit_book['cuerpo_autor'] ? $ml_cat_edit_book['cuerpo_autor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_autor', 'placeholder' => 'Autor (Titulo)']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_autor', 'Autor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_autor', $ml_cat_edit_book['ph_cuerpo_autor'] ? $ml_cat_edit_book['ph_cuerpo_autor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_autor', 'placeholder' => 'Autor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_segundo_autor', 'Segundo Autor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_segundo_autor', $ml_cat_edit_book['cuerpo_segundo_autor'] ? $ml_cat_edit_book['cuerpo_segundo_autor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_segundo_autor', 'placeholder' => 'Segundo Autor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_segundo_autor', 'Segundo Autor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_segundo_autor', $ml_cat_edit_book['ph_cuerpo_segundo_autor'] ? $ml_cat_edit_book['ph_cuerpo_segundo_autor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_segundo_autor', 'placeholder' => 'Segundo Autor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_tercer_autor', 'Tercer Autor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_tercer_autor', $ml_cat_edit_book['cuerpo_tercer_autor'] ? $ml_cat_edit_book['cuerpo_tercer_autor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_tercer_autor', 'placeholder' => 'Tercer Autor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_tercer_autor', 'Tercer Autor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_tercer_autor', $ml_cat_edit_book['ph_cuerpo_tercer_autor'] ? $ml_cat_edit_book['ph_cuerpo_tercer_autor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_tercer_autor', 'placeholder' => 'Tercer Autor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_titulo_original', 'Titulo Original (Titulo)') !!}                    
                    {!! Form::text('cuerpo_titulo_original', $ml_cat_edit_book['cuerpo_titulo_original'] ? $ml_cat_edit_book['cuerpo_titulo_original'] : null, ['class' => 'form-control', 'id' => 'cuerpo_titulo_original', 'placeholder' => 'Titulo Original (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_titulo_original', 'Titulo Original (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_titulo_original', $ml_cat_edit_book['ph_cuerpo_titulo_original'] ? $ml_cat_edit_book['ph_cuerpo_titulo_original'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_titulo_original', 'placeholder' => 'Titulo Original (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_traductor', 'Traductor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_traductor', $ml_cat_edit_book['cuerpo_traductor'] ? $ml_cat_edit_book['cuerpo_traductor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_traductor', 'placeholder' => 'Traductor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_traductor', 'Traductor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_traductor', $ml_cat_edit_book['ph_cuerpo_traductor'] ? $ml_cat_edit_book['ph_cuerpo_traductor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_traductor', 'placeholder' => 'Traductor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_isbn', 'ISBN (Titulo)') !!}                    
                    {!! Form::text('cuerpo_isbn', $ml_cat_edit_book['cuerpo_isbn'] ? $ml_cat_edit_book['cuerpo_isbn'] : null, ['class' => 'form-control', 'id' => 'cuerpo_isbn', 'placeholder' => 'ISBN (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_isbn', 'ISBN (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_isbn', $ml_cat_edit_book['ph_cuerpo_isbn'] ? $ml_cat_edit_book['ph_cuerpo_isbn'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_isbn', 'placeholder' => 'ISBN (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adquirido', 'Adquirido (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adquirido', $ml_cat_edit_book['cuerpo_adquirido'] ? $ml_cat_edit_book['cuerpo_adquirido'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adquirido', 'placeholder' => 'Adquirido (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adquirido', 'Adquirido (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adquirido', $ml_cat_edit_book['ph_cuerpo_adquirido'] ? $ml_cat_edit_book['ph_cuerpo_adquirido'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adquirido', 'placeholder' => 'Adquirido (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_genero', 'Genero (Titulo)') !!}                    
                    {!! Form::text('cuerpo_genero', $ml_cat_edit_book['cuerpo_genero'] ? $ml_cat_edit_book['cuerpo_genero'] : null, ['class' => 'form-control', 'id' => 'cuerpo_genero', 'placeholder' => 'Genero (Titulo)']) !!}
                </div>
            </div>
            <div class="col-md-4">
                
               
                
                
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_genero', 'Genero (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_genero', $ml_cat_edit_book['ph_cuerpo_genero'] ? $ml_cat_edit_book['ph_cuerpo_genero'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_genero', 'placeholder' => 'Genero (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_adecuado_para', 'Adecuado para (Titulo)') !!}                    
                    {!! Form::text('cuerpo_adecuado_para', $ml_cat_edit_book['cuerpo_adecuado_para'] ? $ml_cat_edit_book['cuerpo_adecuado_para'] : null, ['class' => 'form-control', 'id' => 'cuerpo_adecuado_para', 'placeholder' => 'Adecuado para (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_adecuado_para', 'Adecuado para (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_adecuado_para', $ml_cat_edit_book['ph_cuerpo_adecuado_para'] ? $ml_cat_edit_book['ph_cuerpo_adecuado_para'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_adecuado_para', 'placeholder' => 'Adecuado para (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_periodicidad', 'Periocidad (Titulo)') !!}                    
                    {!! Form::text('cuerpo_periodicidad', $ml_cat_edit_book['cuerpo_periodicidad'] ? $ml_cat_edit_book['cuerpo_periodicidad'] : null, ['class' => 'form-control', 'id' => 'cuerpo_periodicidad', 'placeholder' => 'Periocidad (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_periodicidad', 'Periocidad (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_periodicidad', $ml_cat_edit_book['ph_cuerpo_periodicidad'] ? $ml_cat_edit_book['ph_cuerpo_periodicidad'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_periodicidad', 'placeholder' => 'Periocidad (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_issn', 'ISSN (Titulo)') !!}                    
                    {!! Form::text('cuerpo_issn', $ml_cat_edit_book['cuerpo_issn'] ? $ml_cat_edit_book['cuerpo_issn'] : null, ['class' => 'form-control', 'id' => 'cuerpo_issn', 'placeholder' => 'ISSN (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_issn', 'ISSN (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_issn', $ml_cat_edit_book['ph_cuerpo_issn'] ? $ml_cat_edit_book['ph_cuerpo_issn'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_issn', 'placeholder' => 'ISSN (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_otros', 'Otros (Titulo)') !!}                    
                    {!! Form::text('cuerpo_otros', $ml_cat_edit_book['cuerpo_otros'] ? $ml_cat_edit_book['cuerpo_otros'] : null, ['class' => 'form-control', 'id' => 'cuerpo_otros', 'placeholder' => 'Otros (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_otros', 'Otros (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_otros', $ml_cat_edit_book['ph_cuerpo_otros'] ? $ml_cat_edit_book['ph_cuerpo_otros'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_otros', 'placeholder' => 'Otros (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_siglas_autor', 'Siglas Autor (Titulo)') !!}                    
                    {!! Form::text('cuerpo_siglas_autor', $ml_cat_edit_book['cuerpo_siglas_autor'] ? $ml_cat_edit_book['cuerpo_siglas_autor'] : null, ['class' => 'form-control', 'id' => 'cuerpo_siglas_autor', 'placeholder' => 'Siglas Autor (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_siglas_autor', 'Siglas Autor (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_siglas_autor', $ml_cat_edit_book['ph_cuerpo_siglas_autor'] ? $ml_cat_edit_book['ph_cuerpo_siglas_autor'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_siglas_autor', 'placeholder' => 'Siglas Autor (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_siglas_titulo', 'Siglas Titulo (Titulo)') !!}                    
                    {!! Form::text('cuerpo_siglas_titulo', $ml_cat_edit_book['cuerpo_siglas_titulo'] ? $ml_cat_edit_book['cuerpo_siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'cuerpo_siglas_titulo', 'placeholder' => 'Siglas Titulo (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_siglas_titulo', 'Siglas Titulo (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_siglas_titulo', $ml_cat_edit_book['ph_cuerpo_siglas_titulo'] ? $ml_cat_edit_book['ph_cuerpo_siglas_titulo'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_siglas_titulo', 'placeholder' => 'Siglas Titulo (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_cdu', 'CDU (Titulo)') !!}                    
                    {!! Form::text('cuerpo_cdu', $ml_cat_edit_book['cuerpo_cdu'] ? $ml_cat_edit_book['cuerpo_cdu'] : null, ['class' => 'form-control', 'id' => 'cuerpo_cdu', 'placeholder' => 'CDU (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_cdu', 'CDU (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_cdu', $ml_cat_edit_book['ph_cuerpo_cdu'] ? $ml_cat_edit_book['ph_cuerpo_cdu'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_cdu', 'placeholder' => 'CDU (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_valoracion', 'Valoracion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_valoracion', $ml_cat_edit_book['cuerpo_valoracion'] ? $ml_cat_edit_book['cuerpo_valoracion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_valoracion', 'placeholder' => 'Valoracion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_valoracion', 'Valoracion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_valoracion', $ml_cat_edit_book['ph_cuerpo_valoracion'] ? $ml_cat_edit_book['ph_cuerpo_valoracion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_valoracion', 'placeholder' => 'Valoracion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_estado', 'Estado (Titulo)') !!}                    
                    {!! Form::text('cuerpo_estado', $ml_cat_edit_book['cuerpo_estado'] ? $ml_cat_edit_book['cuerpo_estado'] : null, ['class' => 'form-control', 'id' => 'cuerpo_estado', 'placeholder' => 'Estado (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_estado', 'Estado (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_estado', $ml_cat_edit_book['ph_cuerpo_estado'] ? $ml_cat_edit_book['ph_cuerpo_estado'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_estado', 'placeholder' => 'Estado (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_publicado_en', 'Publicado en (Titulo)') !!}                    
                    {!! Form::text('cuerpo_publicado_en', $ml_cat_edit_book['cuerpo_publicado_en'] ? $ml_cat_edit_book['cuerpo_publicado_en'] : null, ['class' => 'form-control', 'id' => 'cuerpo_publicado_en', 'placeholder' => 'Publicado en (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_publicado_en', 'Publicado en (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_publicado_en', $ml_cat_edit_book['ph_cuerpo_publicado_en'] ? $ml_cat_edit_book['ph_cuerpo_publicado_en'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_publicado_en', 'placeholder' => 'Publicado en (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_editorial', 'Editorial (Titulo)') !!}                    
                    {!! Form::text('cuerpo_editorial', $ml_cat_edit_book['cuerpo_editorial'] ? $ml_cat_edit_book['cuerpo_editorial'] : null, ['class' => 'form-control', 'id' => 'cuerpo_editorial', 'placeholder' => 'Editorial (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_editorial', 'Editorial (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_editorial', $ml_cat_edit_book['ph_cuerpo_editorial'] ? $ml_cat_edit_book['ph_cuerpo_editorial'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_editorial', 'placeholder' => 'Editorial (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_anio_de_publicacion', 'Año de publicacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_anio_de_publicacion', $ml_cat_edit_book['cuerpo_anio_de_publicacion'] ? $ml_cat_edit_book['cuerpo_anio_de_publicacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_anio_de_publicacion', 'placeholder' => 'Año de publicacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_anio_de_publicacion', 'Año de publicacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_anio_de_publicacion', $ml_cat_edit_book['ph_cuerpo_anio_de_publicacion'] ? $ml_cat_edit_book['ph_cuerpo_anio_de_publicacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_anio_de_publicacion', 'placeholder' => 'Año de publicacion (Descripcion)']) !!}
                </div>
            </div>
            <div class="col-md-4">
                
                
                
                
               
                <div class="form-group">              
                    {!! Form::label('cuerpo_edicion', 'Edicion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_edicion', $ml_cat_edit_book['cuerpo_edicion'] ? $ml_cat_edit_book['cuerpo_edicion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_edicion', 'placeholder' => 'Edicion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_edicion', 'Edicion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_edicion', $ml_cat_edit_book['ph_cuerpo_edicion'] ? $ml_cat_edit_book['ph_cuerpo_edicion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_edicion', 'placeholder' => 'Edicion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_volumenes', 'Volumenes (Titulo)') !!}                    
                    {!! Form::text('cuerpo_volumenes', $ml_cat_edit_book['cuerpo_volumenes'] ? $ml_cat_edit_book['cuerpo_volumenes'] : null, ['class' => 'form-control', 'id' => 'cuerpo_volumenes', 'placeholder' => 'Volumenes (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_volumenes', 'Volumenes (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_volumenes', $ml_cat_edit_book['ph_cuerpo_volumenes'] ? $ml_cat_edit_book['ph_cuerpo_volumenes'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_volumenes', 'placeholder' => 'Volumenes (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_numero_de_paginas', 'Numero de Paginas (Titulo)') !!}                    
                    {!! Form::text('cuerpo_numero_de_paginas', $ml_cat_edit_book['cuerpo_numero_de_paginas'] ? $ml_cat_edit_book['cuerpo_numero_de_paginas'] : null, ['class' => 'form-control', 'id' => 'cuerpo_numero_de_paginas', 'placeholder' => 'Numero de Paginas (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_numero_de_paginas', 'Numero de Paginas (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_numero_de_paginas', $ml_cat_edit_book['ph_cuerpo_numero_de_paginas'] ? $ml_cat_edit_book['ph_cuerpo_numero_de_paginas'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_numero_de_paginas', 'placeholder' => 'Numero de Paginas (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_tamanio', 'Tamaño (Titulo)') !!}                    
                    {!! Form::text('cuerpo_tamanio', $ml_cat_edit_book['cuerpo_tamanio'] ? $ml_cat_edit_book['cuerpo_tamanio'] : null, ['class' => 'form-control', 'id' => 'cuerpo_tamanio', 'placeholder' => 'Tamaño (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_tamanio', 'Tamaño (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_tamanio', $ml_cat_edit_book['ph_cuerpo_tamanio'] ? $ml_cat_edit_book['ph_cuerpo_tamanio'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_tamanio', 'placeholder' => 'Tamaño (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_coleccion', 'Coleccion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_coleccion', $ml_cat_edit_book['cuerpo_coleccion'] ? $ml_cat_edit_book['cuerpo_coleccion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_coleccion', 'placeholder' => 'Coleccion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_coleccion', 'Coleccion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_coleccion', $ml_cat_edit_book['ph_cuerpo_coleccion'] ? $ml_cat_edit_book['ph_cuerpo_coleccion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_coleccion', 'placeholder' => 'Coleccion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_ubicacion', 'Ubicacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_ubicacion', $ml_cat_edit_book['cuerpo_ubicacion'] ? $ml_cat_edit_book['cuerpo_ubicacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_ubicacion', 'placeholder' => 'Ubicacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_ubicacion', 'Ubicacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_ubicacion', $ml_cat_edit_book['ph_cuerpo_ubicacion'] ? $ml_cat_edit_book['ph_cuerpo_ubicacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_ubicacion', 'placeholder' => 'Ubicacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_idioma', 'Idioma (Titulo)') !!}                    
                    {!! Form::text('cuerpo_idioma', $ml_cat_edit_book['cuerpo_idioma'] ? $ml_cat_edit_book['cuerpo_idioma'] : null, ['class' => 'form-control', 'id' => 'cuerpo_idioma', 'placeholder' => 'Idioma (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_idioma', 'Idioma (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_idioma', $ml_cat_edit_book['ph_cuerpo_idioma'] ? $ml_cat_edit_book['ph_cuerpo_idioma'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_idioma', 'placeholder' => 'Idioma (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_referencia', 'Referencia (Titulo)') !!}                    
                    {!! Form::text('cuerpo_referencia', $ml_cat_edit_book['cuerpo_referencia'] ? $ml_cat_edit_book['cuerpo_referencia'] : null, ['class' => 'form-control', 'id' => 'cuerpo_referencia', 'placeholder' => 'Referencia (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_referencia', 'Referencia (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_referencia', $ml_cat_edit_book['ph_cuerpo_referencia'] ? $ml_cat_edit_book['ph_cuerpo_referencia'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_referencia', 'placeholder' => 'Referencia (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_observacion', 'Observacion (Titulo)') !!}                    
                    {!! Form::text('cuerpo_observacion', $ml_cat_edit_book['cuerpo_observacion'] ? $ml_cat_edit_book['cuerpo_observacion'] : null, ['class' => 'form-control', 'id' => 'cuerpo_observacion', 'placeholder' => 'Observacion (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_observacion', 'Observacion (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_observacion', $ml_cat_edit_book['ph_cuerpo_observacion'] ? $ml_cat_edit_book['ph_cuerpo_observacion'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_observacion', 'placeholder' => 'Observacion (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_nota', 'Notas (Titulo)') !!}                    
                    {!! Form::text('cuerpo_nota', $ml_cat_edit_book['cuerpo_nota'] ? $ml_cat_edit_book['cuerpo_nota'] : null, ['class' => 'form-control', 'id' => 'cuerpo_nota', 'placeholder' => 'Notas (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_nota', 'Notas (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_nota', $ml_cat_edit_book['ph_cuerpo_nota'] ? $ml_cat_edit_book['ph_cuerpo_nota'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_nota', 'placeholder' => 'Notas (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_fotografia', 'Fotografia (Titulo)') !!}                    
                    {!! Form::text('cuerpo_fotografia', $ml_cat_edit_book['cuerpo_fotografia'] ? $ml_cat_edit_book['cuerpo_fotografia'] : null, ['class' => 'form-control', 'id' => 'cuerpo_fotografia', 'placeholder' => 'Fotografia (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_fotografia', 'Fotografia (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_fotografia', $ml_cat_edit_book['ph_cuerpo_fotografia'] ? $ml_cat_edit_book['ph_cuerpo_fotografia'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_fotografia', 'placeholder' => 'Fotografia (Descripcion)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cuerpo_sinopsis', 'Sinopsis (Titulo)') !!}                    
                    {!! Form::text('cuerpo_sinopsis', $ml_cat_edit_book['cuerpo_sinopsis'] ? $ml_cat_edit_book['cuerpo_sinopsis'] : null, ['class' => 'form-control', 'id' => 'cuerpo_sinopsis', 'placeholder' => 'Sinopsis (Titulo)']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('ph_cuerpo_sinopsis', 'Sinopsis (Descripcion)') !!}                    
                    {!! Form::text('ph_cuerpo_sinopsis', $ml_cat_edit_book['ph_cuerpo_sinopsis'] ? $ml_cat_edit_book['ph_cuerpo_sinopsis'] : null, ['class' => 'form-control', 'id' => 'ph_cuerpo_sinopsis', 'placeholder' => 'Sinopsis (Descripcion)']) !!}
                </div>
            </div>
            </div>
        </div>       
    </div>      
{!! Form::close() !!}    
</div>





  