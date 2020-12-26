<?php

namespace App\Http\Controllers;

use App\ManyLenguages;
use App\Ml_dashboard;
use App\Ml_document;
use App\Ml_movie;
use App\Ml_course;
use App\Ml_reference;
use App\Ml_graphic_format;
use App\Ml_language;
use App\Ml_periodical_publication;
use App\Ml_literary_genre;
use App\Ml_musical_genre;
use App\Ml_cinematographic_genre;
use App\Ml_adequacy;
use App\Ml_subjects;
use App\Ml_letter;
use DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book;
use App\Creator;
use App\Adequacy;
use App\Document;
use App\Lenguage;
use App\Periodicity;
use App\Generate_book;
use App\Document_type;
use App\Document_subtype;

use App\ml_show_doc;
use App\ml_show_book;
use App\ml_show_movie;
use App\ml_show_music;
use App\ml_show_fotografia;
use App\ml_show_multimedia;

use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use App\Periodical_publication;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Setting;
use App\Http\Requests\SaveBookRequest;

class ManyLenguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request->session()->put('idiomas', 2);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();
        
        return view('admin.manylenguages.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idioma = new ManyLenguages; 
        $ml_dashboard = new Ml_dashboard;
        $ml_document = new Ml_document;
        $ml_movie = new Ml_movie;

        $ml_show_doc = new ml_show_doc;
        $ml_show_book = new ml_show_book;
        $ml_show_movie = new ml_show_movie;
        $ml_show_music = new ml_show_music;
        $ml_show_fotografia = new ml_show_fotografia;
        $ml_show_multimedia = new ml_show_multimedia;

        return view('admin.manylenguages.partials.form', [          
            'idioma'        => $idioma,
            'ml_dashboard'  => $ml_dashboard,
             'ml_document'   => $ml_document,
            'ml_movie'      => $ml_movie,

            'ml_show_doc' => $ml_show_doc,
            'ml_show_book' => $ml_show_book,
            'ml_show_movie' => $ml_show_movie,
            'ml_show_music' => $ml_show_music,
            'ml_show_fotografia' => $ml_show_fotografia,
            'ml_show_multimedia' => $ml_show_multimedia,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                // Creamos el documento            
                $idioma                             = new ManyLenguages;
                $idioma->lenguage_description       = $request->get('lenguage_description');
                $idioma->baja                       = 0;
                $idioma->save();
                
                $ml_dashboard                       = new Ml_dashboard;
                $ml_dashboard->inicio               = $request->get('inicio');
                $ml_dashboard->libros               = $request->get('libros');
                $ml_dashboard->cines                = $request->get('cines');
                $ml_dashboard->musica               = $request->get('musica');  
                $ml_dashboard->fotografia           = $request->get('fotografia');
                $ml_dashboard->multimedia           = $request->get('multimedia');  
                $ml_dashboard->biblioteca           = $request->get('biblioteca');  
                $ml_dashboard->iniciar_sesion       = $request->get('iniciar_sesion');  
                $ml_dashboard->registrarse          = $request->get('registrarse');  
                $ml_dashboard->navegacion           = $request->get('navegacion');  
                $ml_dashboard->invitado             = $request->get('invitado');  
                $ml_dashboard->en_linea             = $request->get('en_linea');                  
                
                $ml_dashboard->gestion             = $request->get('gestion');                  
                $ml_dashboard->prestamos_web       = $request->get('prestamos_web');                  
                $ml_dashboard->prestamos_manuales  = $request->get('prestamos_manuales');                  
                $ml_dashboard->prest_y_dev         = $request->get('prest_y_dev');                  
                $ml_dashboard->pyd_por_socio       = $request->get('pyd_por_socio');                  
                $ml_dashboard->pyd_por_doc         = $request->get('pyd_por_doc');                  
                $ml_dashboard->correspondencia     = $request->get('correspondencia');                  
                $ml_dashboard->reclamar_prestamos  = $request->get('reclamar_prestamos');                  
                $ml_dashboard->socios              = $request->get('socios');                  
                $ml_dashboard->socios_alta_manual  = $request->get('socios_alta_manual');                  
                $ml_dashboard->socios_solicitudes  = $request->get('socios_solicitudes');                  
                $ml_dashboard->catalogo            = $request->get('catalogo');                  
                $ml_dashboard->importar_rebeca     = $request->get('importar_rebeca');                  
                $ml_dashboard->mantenimiento       = $request->get('mantenimiento');                  
                $ml_dashboard->mant_cursos         = $request->get('mant_cursos');                  
                $ml_dashboard->mant_maestros       = $request->get('mant_maestros');                  
                $ml_dashboard->mant_formatos       = $request->get('mant_formatos');                  
                $ml_dashboard->mant_idiomas        = $request->get('mant_idiomas');                  
                $ml_dashboard->mant_public_period  = $request->get('mant_public_period');                  
                $ml_dashboard->mant_generos_lit    = $request->get('mant_generos_lit');                  
                $ml_dashboard->mant_generos_musicales = $request->get('mant_generos_musicales');                  
                $ml_dashboard->mant_generos_cinemato  = $request->get('mant_generos_cinemato');                  
                $ml_dashboard->mant_personas_adecuadas = $request->get('mant_personas_adecuadas');                  
                $ml_dashboard->mant_materias           = $request->get('mant_materias');                  
                $ml_dashboard->mant_modelos_carta      = $request->get('mant_modelos_carta');                  
                $ml_dashboard->listados                = $request->get('listados');                  
                $ml_dashboard->prestamos_por_fecha     = $request->get('prestamos_por_fecha');                  
                $ml_dashboard->prestamos_por_aula      = $request->get('prestamos_por_aula');                  
                $ml_dashboard->registros_db            = $request->get('registros_db');                  
                $ml_dashboard->estadisticas            = $request->get('estadisticas');                  
                $ml_dashboard->gestion_multi_idioma    = $request->get('gestion_multi_idioma');
                $ml_dashboard->many_lenguages_id       = $idioma->id;               
                $ml_dashboard->save();
                
                $ml_show_doc                       = new ml_show_doc;
                $ml_show_doc->many_lenguages_id    = $idioma->id;
                 
                $ml_show_doc->imagen_de_portada    = $request->get('imagen_de_portada');
                $ml_show_doc->idioma               = $request->get('idioma');
                $ml_show_doc->disponible_desde     = $request->get('disponible_desde');
                $ml_show_doc->adecuado_para        = $request->get('adecuado_para');
                $ml_show_doc->ubicacion            = $request->get('ubicacion');
                $ml_show_doc->solicitar_prestamo   = $request->get('solicitar_prestamo');
                $ml_show_doc->valoracion           = $request->get('valoracion');
                $ml_show_doc->anio                 = $request->get('anio');
                $ml_show_doc->subtipo_de_documento = $request->get('subtipo_de_documento');
                $ml_show_doc->titulo               = $request->get('titulo');
                $ml_show_doc->autor                = $request->get('autor');
                $ml_show_doc->sinopsis             = $request->get('sinopsis');
                $ml_show_doc->titulo_original      = $request->get('titulo_original');
                $ml_show_doc->editorial            = $request->get('editorial');
                $ml_show_doc->nacionalidad         = $request->get('nacionalidad');
                $ml_show_doc->genero               = $request->get('genero');
                $ml_show_doc->duracion             = $request->get('duracion');
                $ml_show_doc->formato              = $request->get('formato');
                $ml_show_doc->save();


                $ml_show_book                      = new ml_show_book;
                 $ml_show_book->many_lenguages_id  = $idioma->id;
                 
                $ml_show_book->tema_de_portada     = $request->get('tema_de_portada');
                $ml_show_book->sobre_el_documento  = $request->get('sobre_el_documento');
                $ml_show_book->subtitulo           = $request->get('subtitulo');
                $ml_show_book->otros_autores       = $request->get('otros_autores');
                $ml_show_book->publicado_en        = $request->get('publicado_en');
                $ml_show_book->detalles_del_documento = $request->get('detalles_del_documento');
                $ml_show_book->volumen                = $request->get('volumen');
                $ml_show_book->numero_de_paginas      = $request->get('numero_de_paginas');
                $ml_show_book->tamanio                = $request->get('tamanio');
                $ml_show_book->save();

                $ml_show_movie                       = new ml_show_movie;
                $ml_show_movie->many_lenguages_id    = $idioma->id;
                 
                $ml_show_movie->dirigido_por         = $request->get('dirigido_por');
                $ml_show_movie->sobre_la_pelicula    = $request->get('sobre_la_pelicula');
                $ml_show_movie->reparto              = $request->get('reparto');
                $ml_show_movie->productora           = $request->get('productora');
                $ml_show_movie->distribuidora        = $request->get('distribuidora');
                $ml_show_movie->detalles_de_la_pelicula  = $request->get('detalles_de_la_pelicula');
                $ml_show_movie->fotografia               = $request->get('fotografia');
                $ml_show_movie->save();

                $ml_show_music                       = new ml_show_music;
                $ml_show_music->many_lenguages_id    = $idioma->id;
                 
                $ml_show_music->titulo_de_la_obra    = $request->get('titulo_de_la_obra');
                $ml_show_music->director             = $request->get('director');
                $ml_show_music->sobre_la_musica      = $request->get('sobre_la_musica');
                $ml_show_music->compositor           = $request->get('compositor');
                $ml_show_music->orquesta             = $request->get('orquesta');
                $ml_show_music->editado_en           = $request->get('editado_en');
                $ml_show_music->sello_discofrafico   = $request->get('sello_discofrafico');
                $ml_show_music->detalles_de_la_musica = $request->get('detalles_de_la_musica');
                $ml_show_music->save();

                $ml_show_fotografia                       = new ml_show_fotografia;
                $ml_show_fotografia->many_lenguages_id    = $idioma->id;
                 
                $ml_show_fotografia->detalles_de_la_fotografia  = $request->get('detalles_de_la_fotografia');
                $ml_show_fotografia->notas                      = $request->get('notas');
                $ml_show_fotografia->observaciones              = $request->get('observaciones');
                $ml_show_fotografia->save();

                $ml_show_multimedia                       = new ml_show_multimedia;
                $ml_show_multimedia->many_lenguages_id    = $idioma->id;
                 
                $ml_show_multimedia->sobre_multimedia   = $request->get('sobre_multimedia');
                $ml_show_multimedia->detalles_de_multimedia = $request->get('detalles_de_multimedia');
                $ml_show_multimedia->paginas                = $request->get('paginas');
                $ml_show_multimedia->volumen                = $request->get('volumen');
                $ml_show_multimedia->edicion                = $request->get('edicion');
                $ml_show_multimedia->save();

                // $ml_document                        = new Ml_document;
                // $ml_document->cdu                   = $request->get('cdu');
                // $ml_document->adecuacion            = $request->get('adecuacion');
                // $ml_document->idioma                = $request->get('idioma');
                // $ml_document->tipo_doc              = $request->get('tipo_doc');  
                // $ml_document->subtipo_doc           = $request->get('subtipo_doc');
                // $ml_document->creador               = $request->get('creador');  
                // $ml_document->titulo                = $request->get('titulo');  
                // $ml_document->titulo_original       = $request->get('titulo_original');  
                // $ml_document->adquirido             = $request->get('adquirido');  
                // $ml_document->siglas_autor          = $request->get('siglas_autor');  
                // $ml_document->siglas_titulo         = $request->get('siglas_titulo');  
                // $ml_document->valoracion            = $request->get('valoracion');                  
                // $ml_document->desidherata           = $request->get('desidherata');  
                // $ml_document->publicado             = $request->get('publicado');  
                // $ml_document->hecho_por             = $request->get('hecho_por');  
                // $ml_document->año                   = $request->get('año');  
                // $ml_document->volumen               = $request->get('volumen');  
                // $ml_document->cant_generica         = $request->get('cant_generica');  
                // $ml_document->coleccion             = $request->get('coleccion');  
                // $ml_document->ubicacion             = $request->get('ubicacion');  
                // $ml_document->observacion           = $request->get('observacion');  
                // $ml_document->nota                  = $request->get('nota');  
                // $ml_document->sinopsis              = $request->get('sinopsis');  
                // $ml_document->foto                  = $request->get('foto');                  
                // $ml_document->many_lenguages_id     = $idioma->id;
                // $ml_document->save();

                // $ml_movie = new Ml_movie;
                // $ml_movie->genero                   = $request->get('genero');
                // $ml_movie->formato                  = $request->get('formato');
                // $ml_movie->adaptacion               = $request->get('adaptacion');
                // $ml_movie->fotografia_tipo          = $request->get('fotografia_tipo');  
                // $ml_movie->subtitulo                = $request->get('subtitulo');
                // $ml_movie->guion                    = $request->get('guion');  
                // $ml_movie->contenido_especifico     = $request->get('contenido_especifico');  
                // $ml_movie->premios                  = $request->get('premios');  
                // $ml_movie->distribuidor             = $request->get('distribuidor');                            
                // $ml_movie->many_lenguages_id        = $idioma->id;
                // $ml_movie->save();

              

                DB::commit();

                // return response()->json(['data' => $document->id, 'bandera' => 1]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function show(ManyLenguages $manyLenguages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idioma = ManyLenguages::findOrFail($id); 
        $ml_dashboard = Ml_dashboard::where('many_lenguages_id', $idioma->id)->first();
        $ml_document = Ml_document::where('many_lenguages_id', $idioma->id)->first();
        $ml_movie = Ml_movie::where('many_lenguages_id', $idioma->id)->first();

        $ml_show_doc = ml_show_doc::where('many_lenguages_id', $idioma->id)->first();
        $ml_show_book = ml_show_book::where('many_lenguages_id', $idioma->id)->first();
        $ml_show_movie = ml_show_movie::where('many_lenguages_id', $idioma->id)->first();
        $ml_show_music = ml_show_music::where('many_lenguages_id', $idioma->id)->first();
        $ml_show_fotografia = ml_show_fotografia::where('many_lenguages_id', $idioma->id)->first();
        $ml_show_multimedia = ml_show_multimedia::where('many_lenguages_id', $idioma->id)->first();
        
        return view('admin.manylenguages.partials.form', [          
            'idioma'        => $idioma,
            'ml_dashboard'  => $ml_dashboard,
            'ml_document'   => $ml_document,
            'ml_movie'      => $ml_movie,

            'ml_show_doc' => $ml_show_doc,
            'ml_show_book' => $ml_show_book,
            'ml_show_movie' => $ml_show_movie,
            'ml_show_music' => $ml_show_music,
            'ml_show_fotografia' => $ml_show_fotografia,
            'ml_show_multimedia' => $ml_show_multimedia,
        ]); 
    }

    public function edit_maintenance($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_course = Ml_course::where('many_lenguages_id', $idioma->id)->first();
        $ml_reference = Ml_reference::where('many_lenguages_id', $idioma->id)->first();
        $ml_fg = Ml_graphic_format::where('many_lenguages_id', $idioma->id)->first();
        $ml_lang = Ml_language::where('many_lenguages_id', $idioma->id)->first();
        $ml_pp = Ml_periodical_publication::where('many_lenguages_id', $idioma->id)->first();
        $ml_gl = Ml_literary_genre::where('many_lenguages_id', $idioma->id)->first();
        $ml_gm = Ml_musical_genre::where('many_lenguages_id', $idioma->id)->first();
        $ml_gc = Ml_cinematographic_genre::where('many_lenguages_id', $idioma->id)->first();
        $ml_adequacy = Ml_adequacy::where('many_lenguages_id', $idioma->id)->first();
        $ml_subject = Ml_subjects::where('many_lenguages_id', $idioma->id)->first();
        $ml_letter = Ml_letter::where('many_lenguages_id', $idioma->id)->first();
        
        return view('admin.manylenguages.maintenance.partials.form', [          
            'idioma'        => $idioma,
            'ml_course'     => $ml_course,
            'ml_reference'  => $ml_reference,
            'ml_fg'         => $ml_fg,
            'ml_lang'       => $ml_lang,
            'ml_pp'         => $ml_pp,
            'ml_gl'         => $ml_gl,
            'ml_gm'         => $ml_gm,
            'ml_gc'         => $ml_gc,
            'ml_adequacy'   => $ml_adequacy,
            'ml_subject'    => $ml_subject,
            'ml_letter'     => $ml_letter
        ]); 
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                // Creamos el documento            
                $idioma                             = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description       = $request->get('lenguage_description');
                // $idioma->baja                       = 0;
                $idioma->save();
                
                $ml_dashboard                       = Ml_dashboard::where('many_lenguages_id', $idioma->id)->first();
                $ml_dashboard->inicio               = $request->get('inicio');
                $ml_dashboard->libros               = $request->get('libros');
                $ml_dashboard->cines                = $request->get('cines');
                $ml_dashboard->musica               = $request->get('musica');  
                $ml_dashboard->fotografia           = $request->get('fotografia');
                $ml_dashboard->multimedia           = $request->get('multimedia');  
                $ml_dashboard->biblioteca           = $request->get('biblioteca');  
                $ml_dashboard->iniciar_sesion       = $request->get('iniciar_sesion');  
                $ml_dashboard->registrarse          = $request->get('registrarse');  
                $ml_dashboard->navegacion           = $request->get('navegacion');  
                $ml_dashboard->invitado             = $request->get('invitado');  
                $ml_dashboard->en_linea             = $request->get('en_linea');                  
                
                $ml_dashboard->gestion             = $request->get('gestion');                  
                $ml_dashboard->prestamos_web             = $request->get('prestamos_web');                  
                $ml_dashboard->prestamos_manuales             = $request->get('prestamos_manuales');                  
                $ml_dashboard->prest_y_dev             = $request->get('prest_y_dev');                  
                $ml_dashboard->pyd_por_socio             = $request->get('pyd_por_socio');                  
                $ml_dashboard->pyd_por_doc             = $request->get('pyd_por_doc');                  
                $ml_dashboard->correspondencia             = $request->get('correspondencia');                  
                $ml_dashboard->reclamar_prestamos             = $request->get('reclamar_prestamos');                  
                $ml_dashboard->socios             = $request->get('socios');                  
                $ml_dashboard->socios_alta_manual             = $request->get('socios_alta_manual');                  
                $ml_dashboard->socios_solicitudes             = $request->get('socios_solicitudes');                  
                $ml_dashboard->catalogo             = $request->get('catalogo');                  
                $ml_dashboard->importar_rebeca             = $request->get('importar_rebeca');                  
                $ml_dashboard->mantenimiento             = $request->get('mantenimiento');                  
                $ml_dashboard->mant_cursos             = $request->get('mant_cursos');                  
                $ml_dashboard->mant_maestros             = $request->get('mant_maestros');                  
                $ml_dashboard->mant_formatos             = $request->get('mant_formatos');                  
                $ml_dashboard->mant_idiomas             = $request->get('mant_idiomas');                  
                $ml_dashboard->mant_public_period             = $request->get('mant_public_period');                  
                $ml_dashboard->mant_generos_lit             = $request->get('mant_generos_lit');                  
                $ml_dashboard->mant_generos_musicales             = $request->get('mant_generos_musicales');                  
                $ml_dashboard->mant_generos_cinemato             = $request->get('mant_generos_cinemato');                  
                $ml_dashboard->mant_personas_adecuadas             = $request->get('mant_personas_adecuadas');                  
                $ml_dashboard->mant_materias             = $request->get('mant_materias');                  
                $ml_dashboard->mant_modelos_carta             = $request->get('mant_modelos_carta');                  
                $ml_dashboard->listados             = $request->get('listados');                  
                $ml_dashboard->prestamos_por_fecha             = $request->get('prestamos_por_fecha');                  
                $ml_dashboard->prestamos_por_aula             = $request->get('prestamos_por_aula');                  
                $ml_dashboard->registros_db             = $request->get('registros_db');                  
                $ml_dashboard->estadisticas             = $request->get('estadisticas');                  
                $ml_dashboard->gestion_multi_idioma             = $request->get('gestion_multi_idioma');

                // $ml_dashboard->many_lenguages_id = $idioma->id;
                $ml_dashboard->save();

                $ml_show_doc                       = ml_show_doc::where('many_lenguages_id', $idioma->id)->first();
                $ml_show_doc->many_lenguages_id    = $idioma->id;
                
               $ml_show_doc->imagen_de_portada               = $request->get('imagen_de_portada');
               $ml_show_doc->idioma               = $request->get('idioma');
               $ml_show_doc->disponible_desde               = $request->get('disponible_desde');
               $ml_show_doc->adecuado_para               = $request->get('adecuado_para');
               $ml_show_doc->ubicacion               = $request->get('ubicacion');
               $ml_show_doc->solicitar_prestamo               = $request->get('solicitar_prestamo');
               $ml_show_doc->valoracion               = $request->get('valoracion');
               $ml_show_doc->anio               = $request->get('anio');
               $ml_show_doc->subtipo_de_documento               = $request->get('subtipo_de_documento');
               $ml_show_doc->titulo               = $request->get('titulo');
               $ml_show_doc->autor               = $request->get('autor');
               $ml_show_doc->sinopsis               = $request->get('sinopsis');
               $ml_show_doc->titulo_original               = $request->get('titulo_original');
               $ml_show_doc->editorial               = $request->get('editorial');
               $ml_show_doc->nacionalidad               = $request->get('nacionalidad');
               $ml_show_doc->genero               = $request->get('genero');
               $ml_show_doc->duracion               = $request->get('duracion');
               $ml_show_doc->formato               = $request->get('formato');
               $ml_show_doc->save();


               $ml_show_book                       = ml_show_book::where('many_lenguages_id', $idioma->id)->first();
                $ml_show_book->many_lenguages_id    = $idioma->id;
                
               $ml_show_book->tema_de_portada               = $request->get('tema_de_portada');
               $ml_show_book->sobre_el_documento               = $request->get('sobre_el_documento');
               $ml_show_book->subtitulo               = $request->get('subtitulo');
               $ml_show_book->otros_autores               = $request->get('otros_autores');
               $ml_show_book->publicado_en               = $request->get('publicado_en');
               $ml_show_book->detalles_del_documento               = $request->get('detalles_del_documento');
               $ml_show_book->volumen               = $request->get('volumen');
               $ml_show_book->numero_de_paginas               = $request->get('numero_de_paginas');
               $ml_show_book->tamanio               = $request->get('tamanio');
               $ml_show_book->save();

               $ml_show_movie                       = ml_show_movie::where('many_lenguages_id', $idioma->id)->first();
               $ml_show_movie->many_lenguages_id    = $idioma->id;
                
               $ml_show_movie->dirigido_por               = $request->get('dirigido_por');
               $ml_show_movie->sobre_la_pelicula               = $request->get('sobre_la_pelicula');
               $ml_show_movie->reparto               = $request->get('reparto');
               $ml_show_movie->productora               = $request->get('productora');
               $ml_show_movie->distribuidora               = $request->get('distribuidora');
               $ml_show_movie->detalles_de_la_pelicula               = $request->get('detalles_de_la_pelicula');
               $ml_show_movie->fotografia               = $request->get('fotografia');
               $ml_show_movie->save();

               $ml_show_music                       = ml_show_music::where('many_lenguages_id', $idioma->id)->first();
               $ml_show_music->many_lenguages_id    = $idioma->id;
                
               $ml_show_music->titulo_de_la_obra               = $request->get('titulo_de_la_obra');
               $ml_show_music->director               = $request->get('director');
               $ml_show_music->sobre_la_musica               = $request->get('sobre_la_musica');
               $ml_show_music->compositor               = $request->get('compositor');
               $ml_show_music->orquesta               = $request->get('orquesta');
               $ml_show_music->editado_en               = $request->get('editado_en');
               $ml_show_music->sello_discofrafico               = $request->get('sello_discofrafico');
               $ml_show_music->detalles_de_la_musica               = $request->get('detalles_de_la_musica');
               $ml_show_music->save();

               $ml_show_fotografia                       = ml_show_fotografia::where('many_lenguages_id', $idioma->id)->first();
               $ml_show_fotografia->many_lenguages_id    = $idioma->id;
                
               $ml_show_fotografia->detalles_de_la_fotografia               = $request->get('detalles_de_la_fotografia');
               $ml_show_fotografia->notas               = $request->get('notas');
               $ml_show_fotografia->observaciones               = $request->get('observaciones');
               $ml_show_fotografia->save();

               $ml_show_multimedia                       = ml_show_multimedia::where('many_lenguages_id', $idioma->id)->first();
               $ml_show_multimedia->many_lenguages_id    = $idioma->id;
                
               $ml_show_multimedia->sobre_multimedia               = $request->get('sobre_multimedia');
               $ml_show_multimedia->detalles_de_multimedia               = $request->get('detalles_de_multimedia');
               $ml_show_multimedia->paginas               = $request->get('paginas');
               $ml_show_multimedia->volumen               = $request->get('volumen');
               $ml_show_multimedia->edicion               = $request->get('edicion');
               $ml_show_multimedia->save();


                // $ml_document                        = Ml_document::where('many_lenguages_id', $idioma->id)->first();
                // $ml_document->cdu                   = $request->get('cdu');
                // $ml_document->adecuacion            = $request->get('adecuacion');
                // $ml_document->idioma                = $request->get('idioma');
                // $ml_document->tipo_doc              = $request->get('tipo_doc');  
                // $ml_document->subtipo_doc           = $request->get('subtipo_doc');
                // $ml_document->creador               = $request->get('creador');  
                // $ml_document->titulo                = $request->get('titulo');  
                // $ml_document->titulo_original       = $request->get('titulo_original');  
                // $ml_document->adquirido             = $request->get('adquirido');  
                // $ml_document->siglas_autor          = $request->get('siglas_autor');  
                // $ml_document->siglas_titulo         = $request->get('siglas_titulo');  
                // $ml_document->valoracion            = $request->get('valoracion');                  
                // $ml_document->desidherata           = $request->get('desidherata');  
                // $ml_document->publicado             = $request->get('publicado');  
                // $ml_document->hecho_por             = $request->get('hecho_por');  
                // $ml_document->año                   = $request->get('año');  
                // $ml_document->volumen               = $request->get('volumen');  
                // $ml_document->cant_generica         = $request->get('cant_generica');  
                // $ml_document->coleccion             = $request->get('coleccion');  
                // $ml_document->ubicacion             = $request->get('ubicacion');  
                // $ml_document->observacion           = $request->get('observacion');  
                // $ml_document->nota                  = $request->get('nota');  
                // $ml_document->sinopsis              = $request->get('sinopsis'); 
                // $ml_document->foto                  = $request->get('foto');   
                // $ml_document->save();

                // $ml_movie                           = Ml_movie::where('many_lenguages_id', $idioma->id)->first();
                // $ml_movie->genero                   = $request->get('genero');
                // $ml_movie->formato                  = $request->get('formato');
                // $ml_movie->adaptacion               = $request->get('adaptacion');
                // $ml_movie->fotografia_tipo          = $request->get('fotografia_tipo');  
                // $ml_movie->subtitulo                = $request->get('subtitulo');
                // $ml_movie->guion                    = $request->get('guion');  
                // $ml_movie->contenido_especifico     = $request->get('contenido_especifico');  
                // $ml_movie->premios                  = $request->get('premios');  
                // $ml_movie->distribuidor             = $request->get('distribuidor'); 
                // $ml_movie->save(); 
                
                DB::commit();

                // return response()->json(['data' => $document->id, 'bandera' => 1]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }
// unificar el guardado
    public function update_maintenance(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                                 = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description           = $request->get('lenguage_description');             
                $idioma->save();
               
                // Cursos
                $ml_course                              = Ml_course::where('many_lenguages_id', $idioma->id)->first();
                $ml_course->titulo_curso                = $request->get('titulo_curso');     
                $ml_course->subtitulo_curso             = $request->get('subtitulo_curso');
                $ml_course->btn_crear_curso             = $request->get('btn_crear_curso');
                $ml_course->dt_id_curso                 = $request->get('dt_id_curso');  
                $ml_course->dt_curso                    = $request->get('dt_curso');
                $ml_course->dt_grupo                    = $request->get('dt_grupo');  
                $ml_course->dt_agregado_curso           = $request->get('dt_agregado_curso');  
                $ml_course->dt_estado                   = $request->get('dt_estado');  
                $ml_course->dt_acciones_curso           = $request->get('dt_acciones_curso');  
                $ml_course->mod_titulo_curso            = $request->get('mod_titulo_curso');  
                $ml_course->mod_subtitulo_curso         = $request->get('mod_subtitulo_curso');  
                $ml_course->cam_nombre_curso            = $request->get('cam_nombre_curso');    
                $ml_course->cam_grupo                   = $request->get('cam_grupo');                  
                $ml_course->cam_grupo_si                = $request->get('cam_grupo_si');    
                $ml_course->cam_grupo_no                = $request->get('cam_grupo_no');               
                $ml_course->save();

                // Maestros de Referencia
                $ml_reference                           = Ml_reference::where('many_lenguages_id', $idioma->id)->first();
                $ml_reference->titulo_ref               = $request->get('titulo_ref');     
                $ml_reference->subtitulo_ref            = $request->get('subtitulo_ref');
                $ml_reference->btn_crear_ref            = $request->get('btn_crear_ref');
                $ml_reference->dt_id_ref                = $request->get('dt_id_ref');  
                $ml_reference->dt_referencia            = $request->get('dt_referencia');               
                $ml_reference->dt_agregado_ref          = $request->get('dt_agregado_ref');                 
                $ml_reference->dt_acciones_ref          = $request->get('dt_acciones_ref');  
                $ml_reference->mod_titulo_ref           = $request->get('mod_titulo_ref');  
                $ml_reference->mod_subtitulo_ref        = $request->get('mod_subtitulo_ref');  
                $ml_reference->cam_formato              = $request->get('cam_formato');                          
                $ml_reference->save();

                // Formato Grafico
                $ml_fg                                  = Ml_graphic_format::where('many_lenguages_id', $idioma->id)->first();
                $ml_fg->titulo_fg                       = $request->get('titulo_fg');     
                $ml_fg->subtitulo_fg                    = $request->get('subtitulo_fg');
                $ml_fg->btn_crear_fg                    = $request->get('btn_crear_fg');
                $ml_fg->dt_id_fg                        = $request->get('dt_id_fg');  
                $ml_fg->dt_fg                           = $request->get('dt_fg');               
                $ml_fg->dt_agregado_fg                  = $request->get('dt_agregado_fg');                 
                $ml_fg->dt_acciones_fg                  = $request->get('dt_acciones_fg');  
                $ml_fg->mod_titulo_fg                   = $request->get('mod_titulo_fg');  
                $ml_fg->mod_subtitulo_fg                = $request->get('mod_subtitulo_fg');  
                $ml_fg->cam_fg                          = $request->get('cam_fg');                          
                $ml_fg->save();

                // Lenguaje
                $ml_lang                                = Ml_language::where('many_lenguages_id', $idioma->id)->first();
                $ml_lang->titulo_lang                   = $request->get('titulo_lang');     
                $ml_lang->subtitulo_lang                = $request->get('subtitulo_lang');
                $ml_lang->btn_crear_lang                = $request->get('btn_crear_lang');
                $ml_lang->dt_id_lang                    = $request->get('dt_id_lang');  
                $ml_lang->dt_lang                       = $request->get('dt_lang');               
                $ml_lang->dt_agregado_lang              = $request->get('dt_agregado_lang');                 
                $ml_lang->dt_acciones_lang              = $request->get('dt_acciones_lang');  
                $ml_lang->mod_titulo_lang               = $request->get('mod_titulo_lang');  
                $ml_lang->mod_subtitulo_lang            = $request->get('mod_subtitulo_lang');  
                $ml_lang->cam_lang                      = $request->get('cam_lang');                          
                $ml_lang->save();

                // Publicacion Periodica
                $ml_pp                                = Ml_periodical_publication::where('many_lenguages_id', $idioma->id)->first();
                $ml_pp->titulo_publ                   = $request->get('titulo_publ');     
                $ml_pp->subtitulo_publ                = $request->get('subtitulo_publ');
                $ml_pp->btn_crear_publ                = $request->get('btn_crear_publ');
                $ml_pp->dt_id_publ                    = $request->get('dt_id_publ');  
                $ml_pp->dt_publ                       = $request->get('dt_publ');               
                $ml_pp->dt_agregado_publ              = $request->get('dt_agregado_publ');                 
                $ml_pp->dt_acciones_publ              = $request->get('dt_acciones_publ');  
                $ml_pp->mod_titulo_publ               = $request->get('mod_titulo_publ');  
                $ml_pp->mod_subtitulo_publ            = $request->get('mod_subtitulo_publ');  
                $ml_pp->cam_publ                      = $request->get('cam_publ');                          
                $ml_pp->save();

                // Genero Literario
                $ml_gl                                = Ml_literary_genre::where('many_lenguages_id', $idioma->id)->first();
                $ml_gl->titulo_gl                     = $request->get('titulo_gl');     
                $ml_gl->subtitulo_gl                  = $request->get('subtitulo_gl');
                $ml_gl->btn_crear_gl                  = $request->get('btn_crear_gl');
                $ml_gl->dt_id_gl                      = $request->get('dt_id_gl');  
                $ml_gl->dt_gl                         = $request->get('dt_gl');               
                $ml_gl->dt_agregado_gl                = $request->get('dt_agregado_gl');                 
                $ml_gl->dt_acciones_gl                = $request->get('dt_acciones_gl');  
                $ml_gl->mod_titulo_gl                 = $request->get('mod_titulo_gl');  
                $ml_gl->mod_subtitulo_gl              = $request->get('mod_subtitulo_gl');  
                $ml_gl->cam_gl                        = $request->get('cam_gl');                          
                $ml_gl->save();

                // Genero Musical
                $ml_gm                                = Ml_musical_genre::where('many_lenguages_id', $idioma->id)->first();
                $ml_gm->titulo_gm                     = $request->get('titulo_gm');     
                $ml_gm->subtitulo_gm                  = $request->get('subtitulo_gm');
                $ml_gm->btn_crear_gm                  = $request->get('btn_crear_gm');
                $ml_gm->dt_id_gm                      = $request->get('dt_id_gm');  
                $ml_gm->dt_gm                         = $request->get('dt_gm');               
                $ml_gm->dt_agregado_gm                = $request->get('dt_agregado_gm');                 
                $ml_gm->dt_acciones_gm                = $request->get('dt_acciones_gm');  
                $ml_gm->mod_titulo_gm                 = $request->get('mod_titulo_gm');  
                $ml_gm->mod_subtitulo_gm              = $request->get('mod_subtitulo_gm');  
                $ml_gm->cam_gm                        = $request->get('cam_gm');                          
                $ml_gm->save();

                // Genero Cinematografico
                $ml_gc                                = Ml_cinematographic_genre::where('many_lenguages_id', $idioma->id)->first();
                $ml_gc->titulo_gc                     = $request->get('titulo_gc');     
                $ml_gc->subtitulo_gc                  = $request->get('subtitulo_gc');
                $ml_gc->btn_crear_gc                  = $request->get('btn_crear_gc');
                $ml_gc->dt_id_gc                      = $request->get('dt_id_gc');  
                $ml_gc->dt_gc                         = $request->get('dt_gc');               
                $ml_gc->dt_agregado_gc                = $request->get('dt_agregado_gc');                 
                $ml_gc->dt_acciones_gc                = $request->get('dt_acciones_gc');  
                $ml_gc->mod_titulo_gc                 = $request->get('mod_titulo_gc');  
                $ml_gc->mod_subtitulo_gc              = $request->get('mod_subtitulo_gc');  
                $ml_gc->cam_gc                        = $request->get('cam_gc');                          
                $ml_gc->save();

                // Genero Adecuaciones
                $ml_adequacy                          = Ml_adequacy::where('many_lenguages_id', $idioma->id)->first();
                $ml_adequacy->titulo_adequacy         = $request->get('titulo_adequacy');     
                $ml_adequacy->subtitulo_adequacy      = $request->get('subtitulo_adequacy');
                $ml_adequacy->btn_crear_adequacy      = $request->get('btn_crear_adequacy');
                $ml_adequacy->dt_id_adequacy          = $request->get('dt_id_adequacy');  
                $ml_adequacy->dt_adequacy             = $request->get('dt_adequacy');               
                $ml_adequacy->dt_agregado_adequacy    = $request->get('dt_agregado_adequacy');                 
                $ml_adequacy->dt_acciones_adequacy    = $request->get('dt_acciones_adequacy');  
                $ml_adequacy->mod_titulo_adequacy     = $request->get('mod_titulo_adequacy');  
                $ml_adequacy->mod_subtitulo_adequacy  = $request->get('mod_subtitulo_adequacy');  
                $ml_adequacy->cam_adequacy            = $request->get('cam_adequacy');                          
                $ml_adequacy->save();

                // Genero Materias
                $ml_subject                           = Ml_subjects::where('many_lenguages_id', $idioma->id)->first();
                $ml_subject->titulo_subject           = $request->get('titulo_subject');     
                $ml_subject->subtitulo_subject        = $request->get('subtitulo_subject');
                $ml_subject->btn_crear_subject        = $request->get('btn_crear_subject');
                $ml_subject->dt_id_subject            = $request->get('dt_id_subject');  
                $ml_subject->dt_subject               = $request->get('dt_subject');             
                $ml_subject->dt_cdu_subject           = $request->get('dt_cdu_subject');               
                $ml_subject->dt_agregado_subject      = $request->get('dt_agregado_subject');                 
                $ml_subject->dt_acciones_subject      = $request->get('dt_acciones_subject');  
                $ml_subject->mod_titulo_subject       = $request->get('mod_titulo_subject');  
                $ml_subject->mod_subtitulo_subject    = $request->get('mod_subtitulo_subject');  
                $ml_subject->cam_subject              = $request->get('cam_subject'); 
                $ml_subject->cam_cdu_subject          = $request->get('cam_cdu_subject');                          
                $ml_subject->save();     

                // Genero Cartas
                $ml_letter                            = Ml_letter::where('many_lenguages_id', $idioma->id)->first();
                $ml_letter->titulo_letter             = $request->get('titulo_letter');     
                $ml_letter->subtitulo_letter          = $request->get('subtitulo_letter');
                $ml_letter->btn_crear_letter          = $request->get('btn_crear_letter');
                $ml_letter->dt_id_letter              = $request->get('dt_id_letter');  
                $ml_letter->dt_titulo_letter          = $request->get('dt_titulo_letter');             
                $ml_letter->dt_cuerpo_letter          = $request->get('dt_cuerpo_letter');   
                $ml_letter->dt_despedida_letter       = $request->get('dt_despedida_letter');                           
                $ml_letter->dt_agregado_letter        = $request->get('dt_agregado_letter');                 
                $ml_letter->dt_acciones_letter        = $request->get('dt_acciones_letter');  
                $ml_letter->mod_titulo_letter         = $request->get('mod_titulo_letter');  
                $ml_letter->mod_subtitulo_letter      = $request->get('mod_subtitulo_letter');  
                $ml_letter->cam_titulo_letter         = $request->get('cam_titulo_letter'); 
                $ml_letter->cam_cuerpo_letter         = $request->get('cam_cuerpo_letter');   
                $ml_letter->cam_despedida_letter      = $request->get('cam_despedida_letter'); 
                $ml_letter->save();

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idioma = ManyLenguages::findOrFail($id);

        if($idioma->baja == 1){ //si esta en baja lo activo
            $idioma->baja = 0;
            $idioma->save();   
        }else{
            if($idioma->baja == 0){ //si esta activo lo bajo
                $idioma->baja = 1;
                $idioma->save();   
            }
        }
    }

    public function dataTable()
    {   
        $idiomas = ManyLenguages::get();
        // dd($idiomas);       
        return dataTables::of($idiomas)

            ->addColumn('created_at', function ($idiomas){
                return $idiomas->created_at->format('d-m-y');
            })   
            
            ->addColumn('label_estado', function ($idiomas){
                if($idiomas['baja'] == 0){
                    return '<span class="label label-success sm">Activo</span>';    
                }else{
                    return '<span class="label label-danger sm">Baja</span>';
                }
               })
            
            ->addColumn('accion', function ($idiomas) {
                return view('admin.manylenguages.partials._action', [
                    'idiomas'           => $idiomas,                       
                    'url_edit'          => route('admin.manylenguages.edit', $idiomas->id),
                    'url_edit_maintenance'   => route('admin.manylenguages.edit_maintenance', $idiomas->id),                    
                    'url_destroy'       => route('admin.manylenguages.destroy', $idiomas->id),   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['label_estado', 'created_at', 'accion']) 
            ->make(true);  
    }
}
