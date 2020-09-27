<?php

namespace App\Http\Controllers;

use App\ManyLenguages;
use App\Ml_dashboard;
use App\Ml_document;
use App\Ml_movie;
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
                    'idiomas'            => $idiomas,                       
                    'url_edit'          => route('admin.manylenguages.edit', $idiomas->id),
                    'url_destroy'          => route('admin.manylenguages.destroy', $idiomas->id),   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['label_estado', 'created_at', 'accion']) 
            ->make(true);  
    }
}
