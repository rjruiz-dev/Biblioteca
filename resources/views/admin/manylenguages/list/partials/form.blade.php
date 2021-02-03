<div class="row">
   
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update_list', $idioma->id] : 'admin.manylenguages.store',   
    'method' => $idioma->exists ? 'PUT' : 'POST'
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
    <!-- Prestamo por Fecha -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Prestamo por Fecha</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_ld', 'Título principal') !!}                    
                        {!! Form::text('titulo_ld', $ml_ld['titulo_ld'] ? $ml_ld['titulo_ld'] : null, ['class' => 'form-control', 'id' => 'titulo_ld', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_ld', 'Subtítulo') !!}                    
                        {!! Form::text('subtitulo_ld', $ml_ld['subtitulo_ld'] ? $ml_ld['subtitulo_ld'] : null, ['class' => 'form-control', 'id' => 'subtitulo_ld', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('fecha_desde_ld', 'Fecha desde') !!}                    
                        {!! Form::text('fecha_desde_ld', $ml_ld['fecha_desde_ld'] ? $ml_ld['fecha_desde_ld'] : null, ['class' => 'form-control', 'id' => 'fecha_desde_ld', 'placeholder' => 'Fecha desde']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('fecha_hasta_ld', 'Fecha hasta') !!}                    
                        {!! Form::text('fecha_hasta_ld', $ml_ld['fecha_hasta_ld'] ? $ml_ld['fecha_hasta_ld'] : null, ['class' => 'form-control', 'id' => 'fecha_hasta_ld', 'placeholder' => 'Fecha hasta']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_ld', 'Botón Buscar') !!}                    
                        {!! Form::text('btn_crear_ld', $ml_ld['btn_crear_ld'] ? $ml_ld['btn_crear_ld'] : null, ['class' => 'form-control', 'id' => 'btn_crear_ld', 'placeholder' => 'Botón Buscar']) !!}
                    </div>                                     
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Columnas Datatable </h3>
                </div>
            </div>
            <div class="box-body">              
                <div class="form-group">              
                    {!! Form::label('dt_id_ld', 'Id') !!}                    
                    {!! Form::text('dt_id_ld', $ml_ld['dt_id_ld'] ? $ml_ld['dt_id_ld'] : null, ['class' => 'form-control', 'id' => 'dt_id_ld', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_registro_ld', 'Registro') !!}                    
                    {!! Form::text('dt_registro_ld', $ml_ld['dt_registro_ld'] ? $ml_ld['dt_registro_ld'] : null, ['class' => 'form-control', 'id' => 'dt_registro_ld', 'placeholder' => 'Registro']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titulo_ld', 'Titulo') !!}                    
                    {!! Form::text('dt_titulo_ld', $ml_ld['dt_titulo_ld'] ? $ml_ld['dt_titulo_ld'] : null, ['class' => 'form-control', 'id' => 'dt_titulo_ld', 'placeholder' => 'Titulo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titpodoc_ld', 'Tipo Documento') !!}                    
                    {!! Form::text('dt_titpodoc_ld', $ml_ld['dt_titpodoc_ld'] ? $ml_ld['dt_titpodoc_ld'] : null, ['class' => 'form-control', 'id' => 'dt_titpodoc_ld', 'placeholder' => 'Tipo Documento']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_subtipodoc_ld', 'Subtipo Documento') !!}                    
                    {!! Form::text('dt_subtipodoc_ld', $ml_ld['dt_subtipodoc_ld'] ? $ml_ld['dt_subtipodoc_ld'] : null, ['class' => 'form-control', 'id' => 'dt_subtipodoc_ld', 'placeholder' => 'Subtipo Documento']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_nrosocio_ld', 'Nro socio') !!}                    
                    {!! Form::text('dt_nrosocio_ld', $ml_ld['dt_nrosocio_ld'] ? $ml_ld['dt_nrosocio_ld'] : null, ['class' => 'form-control', 'id' => 'dt_nrosocio_ld', 'placeholder' => 'Nro socio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_nombre_ld', 'Nombre') !!}                    
                    {!! Form::text('dt_nombre_ld', $ml_ld['dt_nombre_ld'] ? $ml_ld['dt_nombre_ld'] : null, ['class' => 'form-control', 'id' => 'dt_nombre_ld', 'placeholder' => 'Nombre']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_fechaprestamo_ld', 'Fecha préstamo') !!}                    
                    {!! Form::text('dt_fechaprestamo_ld', $ml_ld['dt_fechaprestamo_ld'] ? $ml_ld['dt_fechaprestamo_ld'] : null, ['class' => 'form-control', 'id' => 'dt_fechaprestamo_ld', 'placeholder' => 'Fecha préstamo']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('dt_fechadevolucion_ld', 'Fecha devolución') !!}                    
                    {!! Form::text('dt_fechadevolucion_ld', $ml_ld['dt_fechadevolucion_ld'] ? $ml_ld['dt_fechadevolucion_ld'] : null, ['class' => 'form-control', 'id' => 'dt_fechadevolucion_ld', 'placeholder' => 'Fecha devolución']) !!}
                </div>                        
            </div>
        </div>       
    </div>      

    <!-- Prestamo por Aula -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Prestamo por Aula</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_lc', 'Título principal') !!}                    
                        {!! Form::text('titulo_lc', $ml_lc['titulo_lc'] ? $ml_lc['titulo_lc'] : null, ['class' => 'form-control', 'id' => 'titulo_lc', 'placeholder' => 'Título principal']) !!}
                    </div>
                    <div class="form-group">              
                        {!! Form::label('subtitulo_lc', 'Subtítulo') !!}                    
                        {!! Form::text('subtitulo_lc', $ml_lc['subtitulo_lc'] ? $ml_lc['subtitulo_lc'] : null, ['class' => 'form-control', 'id' => 'subtitulo_lc', 'placeholder' => 'Subtítulo']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('curso_lc', 'Curso') !!}                    
                        {!! Form::text('curso_lc', $ml_lc['curso_lc'] ? $ml_lc['curso_lc'] : null, ['class' => 'form-control', 'id' => 'curso_lc', 'placeholder' => 'Curso']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('letra_lc', 'Letra') !!}                    
                        {!! Form::text('letra_lc', $ml_lc['letra_lc'] ? $ml_lc['letra_lc'] : null, ['class' => 'form-control', 'id' => 'letra_lc', 'placeholder' => 'Letra']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('turno_lc', 'Turno') !!}                    
                        {!! Form::text('turno_lc', $ml_lc['turno_lc'] ? $ml_lc['turno_lc'] : null, ['class' => 'form-control', 'id' => 'turno_lc', 'placeholder' => 'Turno']) !!}
                    </div> 
                    <div class="form-group">              
                        {!! Form::label('btn_crear_lc', 'Botón Buscar') !!}                    
                        {!! Form::text('btn_crear_lc', $ml_lc['btn_crear_lc'] ? $ml_lc['btn_crear_lc'] : null, ['class' => 'form-control', 'id' => 'btn_crear_lc', 'placeholder' => 'Botón Buscar']) !!}
                    </div>                                     
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Columnas Datatable </h3>
                </div>
            </div>
            <div class="box-body">               
                <div class="form-group">              
                    {!! Form::label('dt_registro_lc', 'Registro') !!}                    
                    {!! Form::text('dt_registro_lc', $ml_lc['dt_registro_lc'] ? $ml_lc['dt_registro_lc'] : null, ['class' => 'form-control', 'id' => 'dt_registro_lc', 'placeholder' => 'Registro']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titulo_lc', 'Titulo') !!}                    
                    {!! Form::text('dt_titulo_lc', $ml_lc['dt_titulo_lc'] ? $ml_lc['dt_titulo_lc'] : null, ['class' => 'form-control', 'id' => 'dt_titulo_lc', 'placeholder' => 'Titulo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_autor_lc', 'Autor') !!}                    
                    {!! Form::text('dt_autor_lc', $ml_lc['dt_autor_lc'] ? $ml_lc['dt_autor_lc'] : null, ['class' => 'form-control', 'id' => 'dt_autor_lc', 'placeholder' => 'Autor']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_titpodoc_lc', 'Tipo Documento') !!}                    
                    {!! Form::text('dt_titpodoc_lc', $ml_lc['dt_titpodoc_lc'] ? $ml_lc['dt_titpodoc_lc'] : null, ['class' => 'form-control', 'id' => 'dt_titpodoc_lc', 'placeholder' => 'Tipo Documento']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_subtipodoc_lc', 'Subtipo Documento') !!}                    
                    {!! Form::text('dt_subtipodoc_lc', $ml_lc['dt_subtipodoc_lc'] ? $ml_lc['dt_subtipodoc_lc'] : null, ['class' => 'form-control', 'id' => 'dt_subtipodoc_lc', 'placeholder' => 'Subtipo Documento']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_nrosocio_lc', 'Nro socio') !!}                    
                    {!! Form::text('dt_nrosocio_lc', $ml_lc['dt_nrosocio_lc'] ? $ml_lc['dt_nrosocio_lc'] : null, ['class' => 'form-control', 'id' => 'dt_nrosocio_lc', 'placeholder' => 'Nro socio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_socio_lc', 'Socio') !!}                    
                    {!! Form::text('dt_socio_lc', $ml_lc['dt_socio_lc'] ? $ml_lc['dt_socio_lc'] : null, ['class' => 'form-control', 'id' => 'dt_socio_lc', 'placeholder' => 'Socio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_curso_lc', 'Curso') !!}                    
                    {!! Form::text('dt_curso_lc', $ml_lc['dt_curso_lc'] ? $ml_lc['dt_curso_lc'] : null, ['class' => 'form-control', 'id' => 'dt_curso_lc', 'placeholder' => 'Curso']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_fechaprestamo_lc', 'Fecha préstamo') !!}                    
                    {!! Form::text('dt_fechaprestamo_lc', $ml_lc['dt_fechaprestamo_lc'] ? $ml_lc['dt_fechaprestamo_lc'] : null, ['class' => 'form-control', 'id' => 'dt_fechaprestamo_lc', 'placeholder' => 'Fecha préstamo']) !!}
                </div>   
                <div class="form-group">              
                    {!! Form::label('dt_fechadevolucion_lc', 'Fecha devolución') !!}                    
                    {!! Form::text('dt_fechadevolucion_lc', $ml_lc['dt_fechadevolucion_lc'] ? $ml_lc['dt_fechadevolucion_lc'] : null, ['class' => 'form-control', 'id' => 'dt_fechadevolucion_lc', 'placeholder' => 'Fecha devolución']) !!}
                </div>                        
            </div>
        </div>       
    </div>   

     <!-- Registro Base de Datos-->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales Registro Base de Datos</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Vista Principal </h3>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">                    
                    <div class="form-group">              
                        {!! Form::label('titulo_dr', 'Título principal') !!}                    
                        {!! Form::text('titulo_dr', $ml_dr['titulo_dr'] ? $ml_dr['titulo_dr'] : null, ['class' => 'form-control', 'id' => 'titulo_dr', 'placeholder' => 'Título principal']) !!}
                    </div>
                                                   
                </div>
            </div>       
        </div>   
    </div>     
    <div class="col-md-6">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="text-center">
                    <h3 class="box-title">Columnas Datatable </h3>
                </div>
            </div>
            <div class="box-body">     
                <div class="form-group">              
                    {!! Form::label('dt_id_dr', 'Id') !!}                    
                    {!! Form::text('dt_id_dr', $ml_dr['dt_id_dr'] ? $ml_dr['dt_id_dr'] : null, ['class' => 'form-control', 'id' => 'dt_id_dr', 'placeholder' => 'Id']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('dt_concepto_dr', 'Concepto') !!}                    
                    {!! Form::text('dt_concepto_dr', $ml_dr['dt_concepto_dr'] ? $ml_dr['dt_concepto_dr'] : null, ['class' => 'form-control', 'id' => 'dt_concepto_dr', 'placeholder' => 'Concepto']) !!}
                </div>          
                <div class="form-group">              
                    {!! Form::label('dt_registro_dr', 'Registro') !!}                    
                    {!! Form::text('dt_registro_dr', $ml_dr['dt_registro_dr'] ? $ml_dr['dt_registro_dr'] : null, ['class' => 'form-control', 'id' => 'dt_registro_dr', 'placeholder' => 'Registro']) !!}
                </div>                
            </div>
        </div>       
    </div>          
{!! Form::close() !!}    
</div>





  