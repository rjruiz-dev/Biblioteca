<div class="row">
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update', $idioma->id] : 'admin.manylenguages.store',   
    'method' => $idioma->exists ? 'PUT' : 'POST'
]) !!}

{{ csrf_field() }}

    @if (!$idioma->exists)
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

    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Idioma</h3>
                </div>
            </div>            
            <div class="box-body">
                <div class="form-group" > 
                    {!! Form::label('lenguage_description', 'Idioma') !!}                                  
                    {!! Form::text('lenguage_description', $idioma['lenguage_description'] ? $idioma['lenguage_description'] : null, ['class' => 'form-control', 'id' => 'lenguage_description', 'placeholder' => 'Idioma' ]) !!}
                </div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Traducciones Globales(aparecen tanto en front-end como en administrador)</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">        
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
            <div class="text-center">
                <h3 class="box-title">Menu Lateral </h3>
            </div>
            </div>
            <div class="box-body">
        <div class="col-md-4">
            <div class="form-group">              
                    {!! Form::label('inicio', 'Inicio') !!}                    
                    {!! Form::text('inicio', $ml_dashboard['inicio'] ? $ml_dashboard['inicio'] : null, ['class' => 'form-control', 'id' => 'inicio', 'placeholder' => 'Inicio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('gestion', 'Gestion') !!}                    
                    {!! Form::text('gestion', $ml_dashboard['gestion'] ? $ml_dashboard['gestion'] : null, ['class' => 'form-control', 'id' => 'gestion', 'placeholder' => 'Gestion']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('prestamos_web', 'Prestamos desde la web') !!}                    
                    {!! Form::text('prestamos_web', $ml_dashboard['prestamos_web'] ? $ml_dashboard['prestamos_web'] : null, ['class' => 'form-control', 'id' => 'prestamos_web', 'placeholder' => 'Prestamos desde la web']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('prestamos_manuales', 'Prestamos manuales') !!}                    
                    {!! Form::text('prestamos_manuales', $ml_dashboard['prestamos_manuales'] ? $ml_dashboard['prestamos_manuales'] : null, ['class' => 'form-control', 'id' => 'prestamos_manuales', 'placeholder' => 'Prestamos manuales']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('prest_y_dev', 'Prestamos y Devoluciones') !!}                    
                    {!! Form::text('prest_y_dev', $ml_dashboard['prest_y_dev'] ? $ml_dashboard['prest_y_dev'] : null, ['class' => 'form-control', 'id' => 'prest_y_dev', 'placeholder' => 'Prestamos y Devoluciones']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('pyd_por_socio', 'P y D por Socios') !!}                    
                    {!! Form::text('pyd_por_socio', $ml_dashboard['pyd_por_socio'] ? $ml_dashboard['pyd_por_socio'] : null, ['class' => 'form-control', 'id' => 'pyd_por_socio', 'placeholder' => 'P y D por Socios']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('pyd_por_doc', 'P y D por Documentos') !!}                    
                    {!! Form::text('pyd_por_doc', $ml_dashboard['pyd_por_doc'] ? $ml_dashboard['pyd_por_doc'] : null, ['class' => 'form-control', 'id' => 'pyd_por_doc', 'placeholder' => 'P y D por Documentos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('correspondencia', 'Correspondencia') !!}                    
                    {!! Form::text('correspondencia', $ml_dashboard['correspondencia'] ? $ml_dashboard['correspondencia'] : null, ['class' => 'form-control', 'id' => 'correspondencia', 'placeholder' => 'Correspondencia']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('reclamar_prestamos', 'Reclamar Prestamos') !!}                    
                    {!! Form::text('reclamar_prestamos', $ml_dashboard['reclamar_prestamos'] ? $ml_dashboard['reclamar_prestamos'] : null, ['class' => 'form-control', 'id' => 'reclamar_prestamos', 'placeholder' => 'Reclamar Prestamos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('socios', 'Socios') !!}                    
                    {!! Form::text('socios', $ml_dashboard['socios'] ? $ml_dashboard['socios'] : null, ['class' => 'form-control', 'id' => 'socios', 'placeholder' => 'Socios']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('socios_alta_manual', 'Alta Manual de Socios') !!}                    
                    {!! Form::text('socios_alta_manual', $ml_dashboard['socios_alta_manual'] ? $ml_dashboard['socios_alta_manual'] : null, ['class' => 'form-control', 'id' => 'socios_alta_manual', 'placeholder' => 'Alta Manual de Socios']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('socios_solicitudes', 'Solicitudes desde la Web') !!}                    
                    {!! Form::text('socios_solicitudes', $ml_dashboard['socios_solicitudes'] ? $ml_dashboard['socios_solicitudes'] : null, ['class' => 'form-control', 'id' => 'socios_solicitudes', 'placeholder' => 'Solicitudes desde la Web']) !!}
                </div>
                
            </div>
            <div class="col-md-4">
            <div class="form-group">              
                    {!! Form::label('catalogo', 'Catalogo') !!}                    
                    {!! Form::text('catalogo', $ml_dashboard['catalogo'] ? $ml_dashboard['catalogo'] : null, ['class' => 'form-control', 'id' => 'catalogo', 'placeholder' => 'Catalogo']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('libros', 'Libros') !!}                    
                    {!! Form::text('libros', $ml_dashboard['libros'] ? $ml_dashboard['libros'] : null, ['class' => 'form-control', 'id' => 'libros', 'placeholder' => 'Libros']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cines', 'Cines') !!}                    
                    {!! Form::text('cines', $ml_dashboard['cines'] ? $ml_dashboard['cines'] : null, ['class' => 'form-control', 'id' => 'cines', 'placeholder' => 'Cines']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('musica', 'Musica') !!}                    
                    {!! Form::text('musica', $ml_dashboard['musica'] ? $ml_dashboard['musica'] : null, ['class' => 'form-control', 'id' => 'musica', 'placeholder' => 'Musica']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('fotografia', 'Fotografia') !!}                    
                    {!! Form::text('fotografia', $ml_dashboard['fotografia'] ? $ml_dashboard['fotografia'] : null, ['class' => 'form-control', 'id' => 'fotografia', 'placeholder' => 'Fotografia']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('multimedia', 'Multimedia') !!}                    
                    {!! Form::text('multimedia', $ml_dashboard['multimedia'] ? $ml_dashboard['multimedia'] : null, ['class' => 'form-control', 'id' => 'multimedia', 'placeholder' => 'Multimedia']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('importar_rebeca', 'importar REBECA') !!}                    
                    {!! Form::text('importar_rebeca', $ml_dashboard['importar_rebeca'] ? $ml_dashboard['importar_rebeca'] : null, ['class' => 'form-control', 'id' => 'importar_rebeca', 'placeholder' => 'importar REBECA']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('importaciones_rebeca', 'importaciones REBECA') !!}                    
                    {!! Form::text('importaciones_rebeca', $ml_dashboard['importaciones_rebeca'] ? $ml_dashboard['importaciones_rebeca'] : null, ['class' => 'form-control', 'id' => 'importaciones_rebeca', 'placeholder' => 'importaciones REBECA']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mantenimiento', 'Mantenimiento') !!}                    
                    {!! Form::text('mantenimiento', $ml_dashboard['mantenimiento'] ? $ml_dashboard['mantenimiento'] : null, ['class' => 'form-control', 'id' => 'mantenimiento', 'placeholder' => 'Mantenimiento']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_cursos', 'Cursos') !!}                    
                    {!! Form::text('mant_cursos', $ml_dashboard['mant_cursos'] ? $ml_dashboard['mant_cursos'] : null, ['class' => 'form-control', 'id' => 'mant_cursos', 'placeholder' => 'Cursos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_maestros', 'Maestro de Referencias') !!}                    
                    {!! Form::text('mant_maestros', $ml_dashboard['mant_maestros'] ? $ml_dashboard['mant_maestros'] : null, ['class' => 'form-control', 'id' => 'mant_maestros', 'placeholder' => 'Maestro de Referencias']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_formatos', 'Formatos Graficos') !!}                    
                    {!! Form::text('mant_formatos', $ml_dashboard['mant_formatos'] ? $ml_dashboard['mant_formatos'] : null, ['class' => 'form-control', 'id' => 'mant_formatos', 'placeholder' => 'Formatos Graficos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_idiomas', 'Idiomas') !!}                    
                    {!! Form::text('mant_idiomas', $ml_dashboard['mant_idiomas'] ? $ml_dashboard['mant_idiomas'] : null, ['class' => 'form-control', 'id' => 'mant_idiomas', 'placeholder' => 'Idiomas']) !!}
                </div>
            </div>
            <div class="col-md-4">
            
                <div class="form-group">              
                    {!! Form::label('mant_public_period', 'Publicaciones Periodicas') !!}                    
                    {!! Form::text('mant_public_period', $ml_dashboard['mant_public_period'] ? $ml_dashboard['mant_public_period'] : null, ['class' => 'form-control', 'id' => 'mant_public_period', 'placeholder' => 'Publicaciones Periodicas']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_generos_lit', 'Generos Literarios') !!}                    
                    {!! Form::text('mant_generos_lit', $ml_dashboard['mant_generos_lit'] ? $ml_dashboard['mant_generos_lit'] : null, ['class' => 'form-control', 'id' => 'mant_generos_lit', 'placeholder' => 'Generos Literarios']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_generos_musicales', 'Generos Musicales') !!}                    
                    {!! Form::text('mant_generos_musicales', $ml_dashboard['mant_generos_musicales'] ? $ml_dashboard['mant_generos_musicales'] : null, ['class' => 'form-control', 'id' => 'mant_generos_musicales', 'placeholder' => 'Generos Musicales']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_generos_cinemato', 'Generos Cinematograficos') !!}                    
                    {!! Form::text('mant_generos_cinemato', $ml_dashboard['mant_generos_cinemato'] ? $ml_dashboard['mant_generos_cinemato'] : null, ['class' => 'form-control', 'id' => 'mant_generos_cinemato', 'placeholder' => 'Generos Cinematograficos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_personas_adecuadas', 'Personas Adecuadas') !!}                    
                    {!! Form::text('mant_personas_adecuadas', $ml_dashboard['mant_personas_adecuadas'] ? $ml_dashboard['mant_personas_adecuadas'] : null, ['class' => 'form-control', 'id' => 'mant_personas_adecuadas', 'placeholder' => 'Personas Adecuadas']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_materias', 'Materias') !!}                    
                    {!! Form::text('mant_materias', $ml_dashboard['mant_materias'] ? $ml_dashboard['mant_materias'] : null, ['class' => 'form-control', 'id' => 'mant_materias', 'placeholder' => 'Materias']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('mant_modelos_carta', 'Modelos de Carta') !!}                    
                    {!! Form::text('mant_modelos_carta', $ml_dashboard['mant_modelos_carta'] ? $ml_dashboard['mant_modelos_carta'] : null, ['class' => 'form-control', 'id' => 'mant_modelos_carta', 'placeholder' => 'Modelos de Carta']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('listados', 'Listados') !!}                    
                    {!! Form::text('listados', $ml_dashboard['listados'] ? $ml_dashboard['listados'] : null, ['class' => 'form-control', 'id' => 'listados', 'placeholder' => 'Listados']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('prestamos_por_fecha', 'Prestamos por Fecha') !!}                    
                    {!! Form::text('prestamos_por_fecha', $ml_dashboard['prestamos_por_fecha'] ? $ml_dashboard['prestamos_por_fecha'] : null, ['class' => 'form-control', 'id' => 'prestamos_por_fecha', 'placeholder' => 'Prestamos por Fecha']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('prestamos_por_aula', 'Prestamos por Aula') !!}                    
                    {!! Form::text('prestamos_por_aula', $ml_dashboard['prestamos_por_aula'] ? $ml_dashboard['prestamos_por_aula'] : null, ['class' => 'form-control', 'id' => 'prestamos_por_aula', 'placeholder' => 'Prestamos por Aula']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registros_db', 'Registros Base de Datos') !!}                    
                    {!! Form::text('registros_db', $ml_dashboard['registros_db'] ? $ml_dashboard['registros_db'] : null, ['class' => 'form-control', 'id' => 'registros_db', 'placeholder' => 'Registros Base de Datos']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('estadisticas', 'Estadisticas') !!}                    
                    {!! Form::text('estadisticas', $ml_dashboard['estadisticas'] ? $ml_dashboard['estadisticas'] : null, ['class' => 'form-control', 'id' => 'estadisticas', 'placeholder' => 'Estadisticas']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('gestion_multi_idioma', 'Gestion Multi-Idiomas') !!}                    
                    {!! Form::text('gestion_multi_idioma', $ml_dashboard['gestion_multi_idioma'] ? $ml_dashboard['gestion_multi_idioma'] : null, ['class' => 'form-control', 'id' => 'gestion_multi_idioma', 'placeholder' => 'Gestion Multi-Idiomas']) !!}
                </div>
            </div>
            </div>
        </div>       
    </div>    
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
            <div class="text-center">
                <h3 class="box-title">Cabecera y Pie</h3>                
            </div>
            </div>
            <div class="box-body">
            <div class="col-md-4">   
            <div class="form-group" >              
                    {!! Form::label('biblioteca', 'Biblioteca') !!}                    
                    {!! Form::text('biblioteca', $ml_dashboard['biblioteca'] ? $ml_dashboard['biblioteca'] : null, ['class' => 'form-control', 'id' => 'biblioteca', 'placeholder' => 'Biblioteca' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('iniciar_sesion', 'Iniciar Sesion') !!}                    
                    {!! Form::text('iniciar_sesion', $ml_dashboard['iniciar_sesion'] ? $ml_dashboard['iniciar_sesion'] : null, ['class' => 'form-control', 'id' => 'iniciar_sesion', 'placeholder' => 'Iniciar Sesion' ]) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">              
                    {!! Form::label('registrarse', 'Registrarse') !!}                  
                    {!! Form::text('registrarse', $ml_dashboard['registrarse'] ? $ml_dashboard['registrarse'] : null, ['class' => 'form-control', 'id' => 'registrarse', 'placeholder' => 'Registrarse']) !!}
                </div>
                <!-- pub periodica -->
                <div class="form-group">               
                    {!! Form::label('navegacion', 'Navegacion') !!}                  
                    {!! Form::text('navegacion', $ml_dashboard['navegacion'] ? $ml_dashboard['navegacion'] : null, ['class' => 'form-control', 'id' => 'navegacion', 'placeholder' => 'Navegacion']) !!}
                </div> 
                </div> 
                <div class="col-md-4">                                         
                <div class="form-group">
                    {!! Form::label('invitado', 'Invitado') !!} 
                    {!! Form::text('invitado', $ml_dashboard['invitado'] ? $ml_dashboard['invitado'] : null, ['class' => 'form-control', 'id' => 'invitado', 'placeholder' => 'Invitado']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('en_linea', 'En Linea') !!}                    
                    {!! Form::text('en_linea', $ml_dashboard['en_linea'] ? $ml_dashboard['en_linea'] : null, ['class' => 'form-control', 'id' => 'en_linea', 'placeholder' => 'En Linea']) !!}
                </div>
                </div> 
            </div>
        </div>       
    </div>  
    <!-- <div class="col-md-4">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <h3 class="box-title">Pie</h3>                
            </div>
            <div class="box-body">   
            <div class="form-group" >              
                    {!! Form::label('biblioteca', 'Biblioteca') !!}                    
                    {!! Form::text('biblioteca', $ml_dashboard['biblioteca'] ? $ml_dashboard['biblioteca'] : null, ['class' => 'form-control', 'id' => 'biblioteca', 'placeholder' => 'Biblioteca' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('iniciar_sesion', 'Iniciar Sesion') !!}                    
                    {!! Form::text('iniciar_sesion', $ml_dashboard['iniciar_sesion'] ? $ml_dashboard['iniciar_sesion'] : null, ['class' => 'form-control', 'id' => 'iniciar_sesion', 'placeholder' => 'Iniciar Sesion' ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registrarse', 'Registrarse') !!}                  
                    {!! Form::text('registrarse', $ml_dashboard['registrarse'] ? $ml_dashboard['registrarse'] : null, ['class' => 'form-control', 'id' => 'registrarse', 'placeholder' => 'Registrarse']) !!}
                </div>

                <div class="form-group">               
                    {!! Form::label('navegacion', 'Navegacion') !!}                  
                    {!! Form::text('navegacion', $ml_dashboard['navegacion'] ? $ml_dashboard['navegacion'] : null, ['class' => 'form-control', 'id' => 'navegacion', 'placeholder' => 'Navegacion']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('invitado', 'Invitado') !!} 
                    {!! Form::text('invitado', $ml_dashboard['invitado'] ? $ml_dashboard['invitado'] : null, ['class' => 'form-control', 'id' => 'invitado', 'placeholder' => 'Invitado']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('en_linea', 'En Linea') !!}                    
                    {!! Form::text('en_linea', $ml_dashboard['en_linea'] ? $ml_dashboard['en_linea'] : null, ['class' => 'form-control', 'id' => 'en_linea', 'placeholder' => 'En Linea']) !!}
                </div>
            </div>
        </div>       
    </div>   -->
    <div class="col-md-12">
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
            <div class="box-header with-border">
                <div class="text-center">  
                    <h3 class="box-title">Vista de Documentos</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">      
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
                <div class="text-center">  
                    <h4 class="box-title">Textos propios de un documento</h4>
                </div>
            </div>                   
            <div class="box-body">  
            <div class="col-md-4">  
                <div class="form-group">               
                    {!! Form::label('imagen_de_portada', 'Imagen de Portada') !!}                  
                    {!! Form::text('imagen_de_portada', $ml_show_doc['imagen_de_portada'] ? $ml_show_doc['imagen_de_portada'] : null, ['class' => 'form-control', 'id' => 'imagen_de_portada', 'placeholder' => 'Imagen de Portada']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('idioma', 'Idioma') !!} 
                    {!! Form::text('idioma', $ml_show_doc['idioma'] ? $ml_show_doc['idioma'] : null, ['class' => 'form-control', 'id' => 'idioma', 'placeholder' => 'Idioma']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('disponible_desde', 'Disponible desde') !!}                    
                    {!! Form::text('disponible_desde', $ml_show_doc['disponible_desde'] ? $ml_show_doc['disponible_desde'] : null, ['class' => 'form-control', 'id' => 'disponible_desde', 'placeholder' => 'Disponible desde']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('adecuado_para', 'Adecuado Para') !!}                    
                    {!! Form::text('adecuado_para', $ml_show_doc['adecuado_para'] ? $ml_show_doc['adecuado_para'] : null, ['class' => 'form-control', 'id' => 'adecuado_para', 'placeholder' => 'Adecuado Para']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('ubicacion', 'Ubicacion') !!}                    
                    {!! Form::text('ubicacion', $ml_show_doc['ubicacion'] ? $ml_show_doc['ubicacion'] : null, ['class' => 'form-control', 'id' => 'ubicacion', 'placeholder' => 'Ubicacion']) !!}
                </div> 
                <div class="form-group" >              
                    {!! Form::label('solicitar_prestamo', 'Solicitar Pestamo') !!}                    
                    {!! Form::text('solicitar_prestamo', $ml_show_doc['solicitar_prestamo'] ? $ml_show_doc['solicitar_prestamo'] : null, ['class' => 'form-control', 'id' => 'solicitar_prestamo', 'placeholder' => 'Solicitar Pestamo' ]) !!}
                </div>

                </div>

                <div class="col-md-4">                
                <div class="form-group" >              
                    {!! Form::label('valoracion', 'Valoracion') !!}                    
                    {!! Form::text('valoracion', $ml_show_doc['valoracion'] ? $ml_show_doc['valoracion'] : null, ['class' => 'form-control', 'id' => 'valoracion', 'placeholder' => 'Valoracion' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('anio', 'Año') !!}                    
                    {!! Form::text('anio', $ml_show_doc['anio'] ? $ml_show_doc['anio'] : null, ['class' => 'form-control', 'id' => 'anio', 'placeholder' => 'Año' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('subtipo_de_documento', 'Subtipo de Documento') !!}                    
                    {!! Form::text('subtipo_de_documento', $ml_show_doc['subtipo_de_documento'] ? $ml_show_doc['subtipo_de_documento'] : null, ['class' => 'form-control', 'id' => 'subtipo_de_documento', 'placeholder' => 'Subtipo de Documento' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('titulo', 'Titulo') !!}                    
                    {!! Form::text('titulo', $ml_show_doc['titulo'] ? $ml_show_doc['titulo'] : null, ['class' => 'form-control', 'id' => 'titulo', 'placeholder' => 'Titulo' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('autor', 'Autor') !!}                    
                    {!! Form::text('autor', $ml_show_doc['autor'] ? $ml_show_doc['autor'] : null, ['class' => 'form-control', 'id' => 'autor', 'placeholder' => 'Autor' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('sinopsis', 'Sinopsis') !!}                    
                    {!! Form::text('sinopsis', $ml_show_doc['sinopsis'] ? $ml_show_doc['sinopsis'] : null, ['class' => 'form-control', 'id' => 'sinopsis', 'placeholder' => 'Sinopsis' ]) !!}
                </div>

                </div>
                <div class="col-md-4">
                <div class="form-group" >              
                    {!! Form::label('titulo_original', 'Titulo Original') !!}                    
                    {!! Form::text('titulo_original', $ml_show_doc['titulo_original'] ? $ml_show_doc['titulo_original'] : null, ['class' => 'form-control', 'id' => 'titulo_original', 'placeholder' => 'Titulo Original' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('editorial', 'Editorial') !!}                    
                    {!! Form::text('editorial', $ml_show_doc['editorial'] ? $ml_show_doc['editorial'] : null, ['class' => 'form-control', 'id' => 'editorial', 'placeholder' => 'Editorial' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('nacionalidad', 'Nacionalidad') !!}                    
                    {!! Form::text('nacionalidad', $ml_show_doc['nacionalidad'] ? $ml_show_doc['nacionalidad'] : null, ['class' => 'form-control', 'id' => 'nacionalidad', 'placeholder' => 'Nacionalidad' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('genero', 'Genero') !!}                    
                    {!! Form::text('genero', $ml_show_doc['genero'] ? $ml_show_doc['genero'] : null, ['class' => 'form-control', 'id' => 'genero', 'placeholder' => 'Genero' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('duracion', 'Duracion') !!}                    
                    {!! Form::text('duracion', $ml_show_doc['duracion'] ? $ml_show_doc['duracion'] : null, ['class' => 'form-control', 'id' => 'duracion', 'placeholder' => 'Duracion' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('formato', 'Formato') !!}                    
                    {!! Form::text('formato', $ml_show_doc['formato'] ? $ml_show_doc['formato'] : null, ['class' => 'form-control', 'id' => 'formato', 'placeholder' => 'Formato' ]) !!}
                </div>
                
                </div>        
            <div>
        </div>
    </div>
    </div>
    </div>
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
                <div class="text-center">  
                    <h4 class="box-title">Textos propios de libros</h4>
                </div>
            </div>             
            <div class="box-body"> 
            <div class="col-md-4">
                <div class="form-group">              
                    {!! Form::label('tema_de_portada', 'Tema de Portada') !!}                  
                    {!! Form::text('tema_de_portada', $ml_show_book['tema_de_portada'] ? $ml_show_book['tema_de_portada'] : null, ['class' => 'form-control', 'id' => 'tema_de_portada', 'placeholder' => 'Tema de Portada']) !!}
                </div> 
                <div class="form-group" >              
                    {!! Form::label('sobre_el_documento', 'Sobre el Documento') !!}                    
                    {!! Form::text('sobre_el_documento', $ml_show_book['sobre_el_documento'] ? $ml_show_book['sobre_el_documento'] : null, ['class' => 'form-control', 'id' => 'sobre_el_documento', 'placeholder' => 'Sobre el Documento' ]) !!}
                </div>                 
                <div class="form-group">
                    {!! Form::label('subtitulo', 'Subtitulo') !!}                    
                    {!! Form::text('subtitulo', $ml_show_book['subtitulo'] ? $ml_show_book['subtitulo'] : null, ['class' => 'form-control', 'id' => 'subtitulo', 'placeholder' => 'Subtitulo']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('otros_autores', 'Otros Autores') !!}                    
                    {!! Form::text('otros_autores', $ml_show_book['otros_autores'] ? $ml_show_book['otros_autores'] : null, ['class' => 'form-control', 'id' => 'otros_autores', 'placeholder' => 'Otros Autores']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('publicado_en', 'Publicado En') !!}                    
                    {!! Form::text('publicado_en', $ml_show_book['publicado_en'] ? $ml_show_book['publicado_en'] : null, ['class' => 'form-control', 'id' => 'publicado_en', 'placeholder' => 'Publicado En']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('detalles_del_documento', 'Detalles del Documento') !!}                    
                    {!! Form::text('detalles_del_documento', $ml_show_book['detalles_del_documento'] ? $ml_show_book['detalles_del_documento'] : null, ['class' => 'form-control', 'id' => 'detalles_del_documento', 'placeholder' => 'Detalles del Documento']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('volumen', 'Volumen') !!}                    
                    {!! Form::text('volumen', $ml_show_book['volumen'] ? $ml_show_book['volumen'] : null, ['class' => 'form-control', 'id' => 'volumen', 'placeholder' => 'Volumen']) !!}
                </div>
                <div class="form-group"> 
                    {!! Form::label('numero_de_paginas', 'Numero de Paginas') !!}                    
                    {!! Form::text('numero_de_paginas', $ml_show_book['numero_de_paginas'] ? $ml_show_book['numero_de_paginas'] : null, ['class' => 'form-control', 'id' => 'numero_de_paginas', 'placeholder' => 'Numero de Paginas']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tamanio', 'Tamaño') !!}                    
                    {!! Form::text('tamanio', $ml_show_book['tamanio'] ? $ml_show_book['tamanio'] : null, ['class' => 'form-control', 'id' => 'tamanio', 'placeholder' => 'Tamaño']) !!}
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
                <div class="text-center">  
                    <h4 class="box-title">Textos propios de Cine</h4>
                </div>
            </div>
            <div class="box-body">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('dirigido_por', 'Dirigido Por') !!}                    
                    {!! Form::text('dirigido_por', $ml_show_movie['dirigido_por'] ? $ml_show_movie['dirigido_por'] : null, ['class' => 'form-control', 'id' => 'dirigido_por', 'placeholder' => 'Dirigido Por']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sobre_la_pelicula', 'Sobre la Pelicula') !!}                    
                    {!! Form::text('sobre_la_pelicula', $ml_show_movie['sobre_la_pelicula'] ? $ml_show_movie['sobre_la_pelicula'] : null, ['class' => 'form-control', 'id' => 'sobre_la_pelicula', 'placeholder' => 'Sobre la Pelicula']) !!}
                </div>
                   
                
                <div class="form-group">
                    {!! Form::label('reparto', 'Reparto') !!}                    
                    {!! Form::text('reparto', $ml_show_movie['reparto'] ? $ml_show_movie['reparto'] : null, ['class' => 'form-control', 'id' => 'reparto', 'placeholder' => 'Reparto']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('productora', 'Productora') !!}                    
                    {!! Form::text('productora', $ml_show_movie['productora'] ? $ml_show_movie['productora'] : null, ['class' => 'form-control', 'id' => 'productora', 'placeholder' => 'Productora']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('distribuidora', 'Distribuidora') !!}                    
                    {!! Form::text('distribuidora', $ml_show_movie['distribuidora'] ? $ml_show_movie['distribuidora'] : null, ['class' => 'form-control', 'id' => 'distribuidora', 'placeholder' => 'Distribuidora']) !!}
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('detalles_de_la_pelicula', 'Detalles de la Pelicula') !!}                    
                        {!! Form::text('detalles_de_la_pelicula', $ml_show_movie['detalles_de_la_pelicula'] ? $ml_show_movie['detalles_de_la_pelicula'] : null, ['class' => 'form-control', 'id' => 'detalles_de_la_pelicula', 'placeholder' => 'Detalles de la Pelicula']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fotografia', 'Fotografia') !!}                    
                        {!! Form::text('fotografia', $ml_show_movie['fotografia'] ? $ml_show_movie['fotografia'] : null, ['class' => 'form-control', 'id' => 'fotografia', 'placeholder' => 'Fotografia']) !!}
                    </div>
                </div>                
            </div>
        </div>       
    </div> 
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
                <div class="text-center">  
                    <h4 class="box-title">Textos propios de Musica</h4>
                </div>
            </div>
            <div class="box-body">
            <div class="col-md-4">   
                <div class="form-group">
                    {!! Form::label('titulo_de_la_obra', 'Titulo de la obra') !!}                    
                    {!! Form::text('titulo_de_la_obra', $ml_show_music['titulo_de_la_obra'] ? $ml_show_music['titulo_de_la_obra'] : null, ['class' => 'form-control', 'id' => 'titulo_de_la_obra', 'placeholder' => 'Titulo de la obra']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('director', 'Director') !!}                    
                    {!! Form::text('director', $ml_show_music['director'] ? $ml_show_music['director'] : null, ['class' => 'form-control', 'id' => 'director', 'placeholder' => 'Director']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sobre_la_musica', 'Sobre la Musica') !!}                    
                    {!! Form::text('sobre_la_musica', $ml_show_music['sobre_la_musica'] ? $ml_show_music['sobre_la_musica'] : null, ['class' => 'form-control', 'id' => 'sobre_la_musica', 'placeholder' => 'Sobre la Musica']) !!}
                </div>
                </div>
                <div class="col-md-4"> 
                <div class="form-group">
                    {!! Form::label('compositor', 'Compositor') !!}                    
                    {!! Form::text('compositor', $ml_show_music['compositor'] ? $ml_show_music['compositor'] : null, ['class' => 'form-control', 'id' => 'compositor', 'placeholder' => 'Compositor']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('orquesta', 'Orquesta') !!}                    
                    {!! Form::text('orquesta', $ml_show_music['orquesta'] ? $ml_show_music['orquesta'] : null, ['class' => 'form-control', 'id' => 'orquesta', 'placeholder' => 'Orquesta']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('editado_en', 'Editado en') !!}                    
                    {!! Form::text('editado_en', $ml_show_music['editado_en'] ? $ml_show_music['editado_en'] : null, ['class' => 'form-control', 'id' => 'editado_en', 'placeholder' => 'Editado en']) !!}
                </div>
                </div>
                <div class="col-md-4"> 
                <div class="form-group">
                    {!! Form::label('sello_discofrafico', 'Sello Discofrafico') !!}                    
                    {!! Form::text('sello_discofrafico', $ml_show_music['sello_discofrafico'] ? $ml_show_music['sello_discofrafico'] : null, ['class' => 'form-control', 'id' => 'sello_discofrafico', 'placeholder' => 'Sello Discofrafico']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('detalles_de_la_musica', 'Detalles de la Musica') !!}                    
                    {!! Form::text('detalles_de_la_musica', $ml_show_music['detalles_de_la_musica'] ? $ml_show_music['detalles_de_la_musica'] : null, ['class' => 'form-control', 'id' => 'detalles_de_la_musica', 'placeholder' => 'Detalles de la Musica']) !!}
                </div>
                </div> 
            </div>
        </div>       
    </div>   
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
                <div class="text-center">  
                    <h4 class="box-title">Textos propios de Fotografia</h4>
                </div>
            </div>
            <div class="box-body"> 
            <div class="col-md-4">  
                <div class="form-group">
                    {!! Form::label('detalles_de_la_fotografia', 'Detalles de la Fotografia') !!}                    
                    {!! Form::text('detalles_de_la_fotografia', $ml_show_fotografia['detalles_de_la_fotografia'] ? $ml_show_fotografia['detalles_de_la_fotografia'] : null, ['class' => 'form-control', 'id' => 'detalles_de_la_fotografia', 'placeholder' => 'Detalles de la Fotografia']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('notas', 'Notas') !!}                    
                    {!! Form::text('notas', $ml_show_fotografia['notas'] ? $ml_show_fotografia['notas'] : null, ['class' => 'form-control', 'id' => 'notas', 'placeholder' => 'Notas']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('observaciones', 'Observaciones') !!}                    
                    {!! Form::text('observaciones', $ml_show_fotografia['observaciones'] ? $ml_show_fotografia['observaciones'] : null, ['class' => 'form-control', 'id' => 'observaciones', 'placeholder' => 'Observaciones']) !!}
                </div>
                </div>
            </div>
        </div>       
    </div> 
    <div class="col-md-12">    
        <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
                <div class="text-center">  
                    <h4 class="box-title">Textos propios de Multimedia</h4>
                </div>
            </div>
            <div class="box-body"> 
            <div class="col-md-4">  
                <div class="form-group">
                    {!! Form::label('sobre_multimedia', 'Sobre Multimedia') !!}                    
                    {!! Form::text('sobre_multimedia', $ml_show_multimedia['sobre_multimedia'] ? $ml_show_multimedia['sobre_multimedia'] : null, ['class' => 'form-control', 'id' => 'sobre_multimedia', 'placeholder' => 'Sobre Multimedia']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('detalles_de_multimedia', 'Detalles de Multimedia') !!}                    
                    {!! Form::text('detalles_de_multimedia', $ml_show_multimedia['detalles_de_multimedia'] ? $ml_show_multimedia['detalles_de_multimedia'] : null, ['class' => 'form-control', 'id' => 'detalles_de_multimedia', 'placeholder' => 'Detalles de Multimedia']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('paginas', 'Paginas') !!}                    
                    {!! Form::text('paginas', $ml_show_multimedia['paginas'] ? $ml_show_multimedia['paginas'] : null, ['class' => 'form-control', 'id' => 'paginas', 'placeholder' => 'Paginas']) !!}
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('edicion', 'Edicion') !!}                    
                    {!! Form::text('edicion', $ml_show_multimedia['edicion'] ? $ml_show_multimedia['edicion'] : null, ['class' => 'form-control', 'id' => 'edicion', 'placeholder' => 'Edicion']) !!}
                </div>
                </div>
            </div>
        </div>       
    </div>   
    
    </div>
    </div>
    
    </div>
    </div>
    
{!! Form::close() !!}    
</div>





  