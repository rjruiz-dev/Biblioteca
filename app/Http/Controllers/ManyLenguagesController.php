<?php

namespace App\Http\Controllers;

use App\ManyLenguages;
use App\Ml_dashboard;
use App\Ml_document;
use App\Ml_movie;

use App\Ml_course;
use App\Swal_course;

use App\Ml_reference;
use App\Swal_reference;

use App\Ml_graphic_format;
use App\Swal_graphic_format;

use App\Ml_language;
use App\Swal_language;

use App\Ml_periodical_publication;
use App\Swal_periodical;

use App\Ml_literary_genre;
use App\Swal_literature;

use App\Ml_musical_genre;
use App\Ml_cinematographic_genre;
use App\Ml_adequacy;
use App\Ml_subjects;
use App\Ml_letter;
use App\Ml_loan_by_date;
use App\Ml_classroom_loan;
use App\Ml_database_record;
use App\Ml_statistic;
use App\Ml_library_profile;
use App\Ml_manual_loan;
use App\Ml_web_loan;
use App\Ml_loan_partner;
use App\Ml_loan_document;
use App\Ml_send_letter;
use App\Ml_partner;
use App\Ml_web_request;
use App\Ml_login;
use App\Ml_registry;
use App\Ml_password;
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
        $idioma         = ManyLenguages::findOrFail($id);  

        $ml_course      = Ml_course::where('many_lenguages_id', $idioma->id)->first();
        $swal_course    = Swal_course::where('many_lenguages_id', $idioma->id)->first();

        $ml_reference   = Ml_reference::where('many_lenguages_id', $idioma->id)->first();
        $swal_reference = Swal_reference::where('many_lenguages_id', $idioma->id)->first();
        
        $ml_fg          = Ml_graphic_format::where('many_lenguages_id', $idioma->id)->first();
        $swal_fg        = Swal_graphic_format::where('many_lenguages_id', $idioma->id)->first();
        
        $ml_lang        = Ml_language::where('many_lenguages_id', $idioma->id)->first();
        $swal_lang      = Swal_language::where('many_lenguages_id', $idioma->id)->first();

        $ml_pp          = Ml_periodical_publication::where('many_lenguages_id', $idioma->id)->first();
        $swal_pp        = Swal_periodical::where('many_lenguages_id', $idioma->id)->first();
        
        $ml_gl          = Ml_literary_genre::where('many_lenguages_id', $idioma->id)->first();
        $swal_gl        = Swal_literature::where('many_lenguages_id', $idioma->id)->first();
        
        $ml_gm          = Ml_musical_genre::where('many_lenguages_id', $idioma->id)->first();
        $ml_gc          = Ml_cinematographic_genre::where('many_lenguages_id', $idioma->id)->first();
        $ml_adequacy    = Ml_adequacy::where('many_lenguages_id', $idioma->id)->first();
        $ml_subject     = Ml_subjects::where('many_lenguages_id', $idioma->id)->first();
        $ml_letter      = Ml_letter::where('many_lenguages_id', $idioma->id)->first();
        
        return view('admin.manylenguages.maintenance.partials.form', [          
            'idioma'        => $idioma,
            
            'ml_course'     => $ml_course,
            'swal_course'   => $swal_course,

            'ml_reference'  => $ml_reference,
            'swal_reference'=> $swal_reference,

            'ml_fg'         => $ml_fg,
            'swal_fg'       => $swal_fg,

            'ml_lang'       => $ml_lang,
            'swal_lang'     => $swal_lang,
           
            'ml_pp'         => $ml_pp,
            'swal_pp'       => $swal_pp,

            'ml_gl'         => $ml_gl,
            'swal_gl'       => $swal_gl,

            'ml_gm'         => $ml_gm,
            'ml_gc'         => $ml_gc,
            'ml_adequacy'   => $ml_adequacy,
            'ml_subject'    => $ml_subject,
            'ml_letter'     => $ml_letter
        ]); 
    }

    public function edit_list($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_ld = Ml_loan_by_date::where('many_lenguages_id', $idioma->id)->first();
        $ml_lc = Ml_classroom_loan::where('many_lenguages_id', $idioma->id)->first();
        $ml_dr = Ml_database_record::where('many_lenguages_id', $idioma->id)->first();
      
        return view('admin.manylenguages.list.partials.form', [          
            'idioma'    => $idioma,
            'ml_ld'     => $ml_ld,
            'ml_lc'     => $ml_lc,
            'ml_dr'     => $ml_dr,
           
           
        ]); 
    }

    public function edit_statistic($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_statistic = Ml_statistic::where('many_lenguages_id', $idioma->id)->first();
              
        return view('admin.manylenguages.statistic.partials.form', [          
            'idioma'        => $idioma,           
            'ml_statistic'  => $ml_statistic          
           
        ]); 
    }

    public function edit_library_profile($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_library = Ml_library_profile::where('many_lenguages_id', $idioma->id)->first();
              
        return view('admin.manylenguages.setting_library.partials.form', [          
            'idioma'      => $idioma,           
            'ml_library'  => $ml_library          
           
        ]); 
    }

    public function edit_loan($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_ml = Ml_manual_loan::where('many_lenguages_id', $idioma->id)->first();
        $ml_wl = Ml_web_loan::where('many_lenguages_id', $idioma->id)->first();
              
        return view('admin.manylenguages.management.partials.form', [          
            'idioma' => $idioma,           
            'ml_ml'  => $ml_ml,
            'ml_wl'  => $ml_wl           
           
        ]); 
    }

    public function edit_loan_repayment($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_lp = Ml_loan_partner::where('many_lenguages_id', $idioma->id)->first();
        $ml_ld = Ml_loan_document::where('many_lenguages_id', $idioma->id)->first();
                     
        return view('admin.manylenguages.loan_repayment.partials.form', [          
            'idioma' => $idioma,           
            'ml_lp'  => $ml_lp,   
            'ml_ld'  => $ml_ld          
           
        ]); 
    }

    public function edit_send_letter($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_sl = Ml_send_letter::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.manylenguages.correspondence.partials.form', [          
            'idioma' => $idioma,           
            'ml_sl'  => $ml_sl        
           
        ]); 
    }

    public function edit_partner($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_partner = Ml_partner::where('many_lenguages_id', $idioma->id)->first();
        $ml_wr = Ml_web_request::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.manylenguages.partner.partials.form', [          
            'idioma' => $idioma,           
            'ml_partner'  => $ml_partner,  
            'ml_wr'  => $ml_wr        
           
        ]); 
    }

    public function edit_credentials($id)
    {
        $idioma = ManyLenguages::findOrFail($id);  

        $ml_login       = Ml_login::where('many_lenguages_id', $idioma->id)->first();
        $ml_registry    = Ml_registry::where('many_lenguages_id', $idioma->id)->first();
        $ml_password    = Ml_password::where('many_lenguages_id', $idioma->id)->first();
                                    
        return view('admin.manylenguages.credentials.partials.form', [          
            'idioma'        => $idioma,           
            'ml_login'      => $ml_login,
            'ml_registry'   => $ml_registry,
            'ml_password'   => $ml_password,

           
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

                // Swal cursos
                $swal_course                            = Swal_course::where('many_lenguages_id', $idioma->id)->first();
                $swal_course->swal_exito                = $request->get('swal_exito');     
                $swal_course->swal_info_exito           = $request->get('swal_info_exito');               
                $swal_course->swal_advertencia          = $request->get('swal_advertencia');  
                $swal_course->swal_info_advertencia     = $request->get('swal_info_advertencia');  
                $swal_course->swal_baja                 = $request->get('swal_baja');  
                $swal_course->swal_bajado               = $request->get('swal_bajado');  
                $swal_course->swal_reactivar            = $request->get('swal_reactivar');  
                $swal_course->swal_reactivado           = $request->get('swal_reactivado');  
                $swal_course->save();


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
                $ml_reference->cam_referencia           = $request->get('cam_referencia');                          
                $ml_reference->save();

                // Swal referencia
                $swal_reference                         = Swal_reference::where('many_lenguages_id', $idioma->id)->first();
                $swal_reference->swal_exito_ref         = $request->get('swal_exito_ref');     
                $swal_reference->swal_info_exito_ref    = $request->get('swal_info_exito_ref');
                $swal_reference->swal_eliminar_ref      = $request->get('swal_eliminar_ref');  
                $swal_reference->swal_info_eliminar_ref = $request->get('swal_info_eliminar_ref');                 
                $swal_reference->swal_advertencia_ref   = $request->get('swal_advertencia_ref');  
                $swal_reference->swal_info_advertencia_ref  = $request->get('swal_info_advertencia_ref');  
                $swal_reference->save();
                

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

                // Swal Formato grafico
                $swal_fg                                = Swal_graphic_format::where('many_lenguages_id', $idioma->id)->first();
                $swal_fg->swal_exito_gra                = $request->get('swal_exito_gra');     
                $swal_fg->swal_info_exito_gra           = $request->get('swal_info_exito_gra');
                $swal_fg->swal_eliminar_gra             = $request->get('swal_eliminar_gra');  
                $swal_fg->swal_info_eliminar_gra        = $request->get('swal_info_eliminar_gra');                 
                $swal_fg->swal_advertencia_gra          = $request->get('swal_advertencia_gra');  
                $swal_fg->swal_info_advertencia_gra     = $request->get('swal_info_advertencia_gra');  
                $swal_fg->save();

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

                // Swal Lenguaje
                $swal_lang                              = Swal_language::where('many_lenguages_id', $idioma->id)->first();
                $swal_lang->swal_exito_lan              = $request->get('swal_exito_lan');     
                $swal_lang->swal_info_exito_lan         = $request->get('swal_info_exito_lan');
                $swal_lang->swal_eliminar_lan           = $request->get('swal_eliminar_lan');  
                $swal_lang->swal_info_eliminar_lan      = $request->get('swal_info_eliminar_lan');                 
                $swal_lang->swal_advertencia_lan        = $request->get('swal_advertencia_lan');  
                $swal_lang->swal_info_advertencia_lan   = $request->get('swal_info_advertencia_lan');  
                $swal_lang->save();

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

                // Swal Publicacion Periodica
                $swal_pp                              = Swal_periodical::where('many_lenguages_id', $idioma->id)->first();
                $swal_pp->swal_exito_per              = $request->get('swal_exito_per');     
                $swal_pp->swal_info_exito_per         = $request->get('swal_info_exito_per');
                $swal_pp->swal_eliminar_per           = $request->get('swal_eliminar_per');  
                $swal_pp->swal_info_eliminar_per      = $request->get('swal_info_eliminar_per');                 
                $swal_pp->swal_advertencia_per        = $request->get('swal_advertencia_per');  
                $swal_pp->swal_info_advertencia_per   = $request->get('swal_info_advertencia_per');  
                $swal_pp->save();

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

                // Swal Genero Literario
                $swal_gl                              = Swal_literature::where('many_lenguages_id', $idioma->id)->first();
                $swal_gl->swal_exito_lit              = $request->get('swal_exito_lit');     
                $swal_gl->swal_info_exito_lit         = $request->get('swal_info_exito_lit');
                $swal_gl->swal_eliminar_lit           = $request->get('swal_eliminar_lit');  
                $swal_gl->swal_info_eliminar_lit      = $request->get('swal_info_eliminar_lit');                 
                $swal_gl->swal_advertencia_lit        = $request->get('swal_advertencia_lit');  
                $swal_gl->swal_info_advertencia_lit   = $request->get('swal_info_advertencia_lit');  
                $swal_gl->save();

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

    public function update_list(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo por fecha
                $ml_ld                          = Ml_loan_by_date::where('many_lenguages_id', $idioma->id)->first();
                $ml_ld->titulo_ld               = $request->get('titulo_ld');     
                $ml_ld->subtitulo_ld            = $request->get('subtitulo_ld');
                $ml_ld->fecha_desde_ld          = $request->get('fecha_desde_ld');     
                $ml_ld->fecha_hasta_ld          = $request->get('fecha_hasta_ld');
                $ml_ld->btn_crear_ld            = $request->get('btn_crear_ld');
                $ml_ld->dt_id_ld                = $request->get('dt_id_ld');  
                $ml_ld->dt_registro_ld          = $request->get('dt_registro_ld');
                $ml_ld->dt_titulo_ld            = $request->get('dt_titulo_ld');  
                $ml_ld->dt_tipodoc_ld           = $request->get('dt_tipodoc_ld');  
                $ml_ld->dt_subtipodoc_ld        = $request->get('dt_subtipodoc_ld');  
                $ml_ld->dt_nrosocio_ld          = $request->get('dt_nrosocio_ld');  
                $ml_ld->dt_nombre_ld            = $request->get('dt_nombre_ld');  
                $ml_ld->dt_fechaprestamo_ld     = $request->get('dt_fechaprestamo_ld');  
                $ml_ld->dt_fechadevolucion_ld   = $request->get('dt_fechadevolucion_ld');    
                $ml_ld->save();

                // Prestamo por aula
                $ml_lc                          = Ml_classroom_loan::where('many_lenguages_id', $idioma->id)->first();
                $ml_lc->titulo_lc              = $request->get('titulo_lc');     
                $ml_lc->subtitulo_lc            = $request->get('subtitulo_lc');
                $ml_lc->curso_lc                = $request->get('curso_lc');     
                $ml_lc->letra_lc                = $request->get('letra_lc');
                $ml_lc->turno_lc                = $request->get('turno_lc');
                $ml_lc->btn_crear_lc            = $request->get('btn_crear_lc');                
                $ml_lc->dt_registro_lc          = $request->get('dt_registro_lc');
                $ml_lc->dt_titulo_lc            = $request->get('dt_titulo_lc');  
                $ml_lc->dt_autor_lc             = $request->get('dt_autor_lc');
                $ml_lc->dt_tipodoc_lc           = $request->get('dt_tipodoc_lc');  
                $ml_lc->dt_subtipodoc_lc        = $request->get('dt_subtipodoc_lc');  
                $ml_lc->dt_nrosocio_lc          = $request->get('dt_nrosocio_lc');  
                $ml_lc->dt_socio_lc             = $request->get('dt_socio_lc');  
                $ml_lc->dt_curso_lc             = $request->get('dt_curso_lc');  
                $ml_lc->dt_fechaprestamo_lc     = $request->get('dt_fechaprestamo_lc');  
                $ml_lc->dt_fechadevolucion_lc   = $request->get('dt_fechadevolucion_lc');    
                $ml_lc->save();

                 // Registro base de datos
                 $ml_dr                         = Ml_database_record::where('many_lenguages_id', $idioma->id)->first();
                 $ml_dr->titulo_dr              = $request->get('titulo_dr');                      
                 $ml_dr->dt_id_dr               = $request->get('dt_id_dr');  
                 $ml_dr->dt_concepto_dr         = $request->get('dt_concepto_dr');  
                 $ml_dr->dt_registro_dr         = $request->get('dt_registro_dr');                   
                 $ml_dr->save();

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function update_statistic(Request $request, $id)
    {        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo por fecha
                $ml_statistic                   = Ml_statistic::where('many_lenguages_id', $idioma->id)->first();
                $ml_statistic->estadistica      = $request->get('estadistica');     
                $ml_statistic->mes_y_año        = $request->get('mes_y_año');
                $ml_statistic->ph_mes_y_año     = $request->get('ph_mes_y_año');     
                $ml_statistic->btn_buscar       = $request->get('btn_buscar');
                $ml_statistic->total            = $request->get('total');
                $ml_statistic->sub_socio        = $request->get('sub_socio');  
                $ml_statistic->sub_prestamo     = $request->get('sub_prestamo');
                $ml_statistic->sub_coleccion    = $request->get('sub_coleccion');  
                $ml_statistic->col_tipodesocio  = $request->get('col_tipodesocio');  
                $ml_statistic->col_alta         = $request->get('col_alta');  
                $ml_statistic->col_baja         = $request->get('col_baja');  
                $ml_statistic->col_prestamo     = $request->get('col_prestamo');  
                $ml_statistic->col_libro        = $request->get('col_libro');  
                $ml_statistic->col_cine         = $request->get('col_cine');
                $ml_statistic->col_musica       = $request->get('col_musica');  
                $ml_statistic->col_multimedia   = $request->get('col_multimedia');  
                $ml_statistic->col_fotografia   = $request->get('col_fotografia');  
                $ml_statistic->col_librodigital = $request->get('col_librodigital');  
                $ml_statistic->col_coleccion    = $request->get('col_coleccion');  
                $ml_statistic->infantil         = $request->get('infantil');    
                $ml_statistic->adulto           = $request->get('adulto');    
                $ml_statistic->incorporacion    = $request->get('incorporacion');    
                $ml_statistic->baja             = $request->get('baja');
                $ml_statistic->btn_guardar      = $request->get('btn_guardar');    
                $ml_statistic->save();              

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function update_library_profile(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo por fecha
                $ml_library                     = Ml_library_profile::where('many_lenguages_id', $idioma->id)->first();
                $ml_library->titulo             = $request->get('titulo');     
                $ml_library->logo               = $request->get('logo');
                $ml_library->perfil             = $request->get('perfil');     
                $ml_library->biblioteca         = $request->get('biblioteca');
                $ml_library->telefono           = $request->get('telefono');
                $ml_library->email              = $request->get('email');  
                $ml_library->idioma             = $request->get('idioma');
                $ml_library->select_logo        = $request->get('select_logo');  
                $ml_library->medidas_logo       = $request->get('medidas_logo');  
                $ml_library->direccion          = $request->get('direccion');  
                $ml_library->calle              = $request->get('calle');  
                $ml_library->codigo_postal      = $request->get('codigo_postal');  
                $ml_library->ciudad             = $request->get('ciudad');  
                $ml_library->provincia          = $request->get('provincia');
                $ml_library->pais               = $request->get('pais');  
                $ml_library->config_prestamo    = $request->get('config_prestamo');  
                $ml_library->cant_max_prestamo  = $request->get('cant_max_prestamo');  
                $ml_library->cant_max_dias      = $request->get('cant_max_dias');  
                $ml_library->tipo_multa         = $request->get('tipo_multa');    
                $ml_library->economica          = $request->get('economica');    
                $ml_library->sancion            = $request->get('sancion');    
                $ml_library->sancion_economica  = $request->get('sancion_economica');    
                $ml_library->dias_sancion       = $request->get('dias_sancion');    
                $ml_library->otros_detalles     = $request->get('otros_detalles');    
                $ml_library->edad_infantil      = $request->get('edad_infantil');    
                $ml_library->edad_adulto        = $request->get('edad_adulto');    
                $ml_library->select_color       = $request->get('select_color');    
                $ml_library->info_color         = $request->get('info_color');            
                $ml_library->select_color_fuente= $request->get('select_color_fuente');    
                $ml_library->info_color_fuente  = $request->get('info_color_fuente');    
                $ml_library->save();              

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }
    
    public function update_loan(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo manual
                $ml_ml                     = Ml_manual_loan::where('many_lenguages_id', $idioma->id)->first();
                $ml_ml->titulo_ml          = $request->get('titulo_ml');     
                $ml_ml->subtitulo_ml       = $request->get('subtitulo_ml');
                $ml_ml->dt_id_ml           = $request->get('dt_id_ml');     
                $ml_ml->dt_titulo_ml       = $request->get('dt_titulo_ml');
                $ml_ml->dt_tipo_ml         = $request->get('dt_tipo_ml');
                $ml_ml->dt_subtipo_ml      = $request->get('dt_subtipo_ml');  
                $ml_ml->dt_copias_ml       = $request->get('dt_copias_ml');
                $ml_ml->dt_acciones_ml     = $request->get('dt_acciones_ml');  
                $ml_ml->titulo_index       = $request->get('titulo_index');  
                $ml_ml->seccion_doc        = $request->get('seccion_doc');  
                $ml_ml->tipo_doc           = $request->get('tipo_doc');  
                $ml_ml->tipo_libro         = $request->get('tipo_libro');  
                $ml_ml->seccion_prestamo   = $request->get('seccion_prestamo');  
                $ml_ml->select_registro    = $request->get('select_registro');
                $ml_ml->ph_registro        = $request->get('ph_registro');  
                $ml_ml->select_usuario     = $request->get('select_usuario');  
                $ml_ml->ph_usuario         = $request->get('ph_usuario');  
                $ml_ml->nickname           = $request->get('nickname');  
                $ml_ml->apellido           = $request->get('apellido');    
                $ml_ml->email              = $request->get('email');    
                $ml_ml->cant_prestamos     = $request->get('cant_prestamos');    
                $ml_ml->select_curso       = $request->get('select_curso');    
                $ml_ml->ph_curso           = $request->get('ph_curso');    
                $ml_ml->select_grupo       = $request->get('select_grupo');    
                $ml_ml->ph_grupo           = $request->get('ph_grupo');    
                $ml_ml->select_turno       = $request->get('select_turno');    
                $ml_ml->ph_turno           = $request->get('ph_turno');    
                $ml_ml->fecha_prestamo     = $request->get('fecha_prestamo');   
                $ml_ml->save();              

                // Prestamo desde la web
                $ml_wl                     = Ml_web_loan::where('many_lenguages_id', $idioma->id)->first();
                $ml_wl->titulo_wl          = $request->get('titulo_wl');     
                $ml_wl->subtitulo_wl       = $request->get('subtitulo_wl');
                $ml_wl->dt_id_wl           = $request->get('dt_id_wl');     
                $ml_wl->dt_titulo_wl       = $request->get('dt_titulo_wl');
                $ml_wl->dt_documento_wl    = $request->get('dt_documento_wl');
                $ml_wl->dt_tipo_wl         = $request->get('dt_tipo_wl');
                $ml_wl->dt_subtipo_wl      = $request->get('dt_subtipo_wl');  
                $ml_wl->dt_curso_wl        = $request->get('dt_curso_wl');
                $ml_wl->dt_agregado_wl     = $request->get('dt_agregado_wl');                  
                $ml_wl->mod_titulo         = $request->get('mod_titulo');    
                $ml_wl->mod_tipo_doc       = $request->get('mod_tipo_doc');    
                $ml_wl->mod_subtipo_doc    = $request->get('mod_subtipo_doc');    
                $ml_wl->mod_socio          = $request->get('mod_socio');    
                $ml_wl->mod_fecha          = $request->get('mod_fecha');    
                $ml_wl->btn_aceptar        = $request->get('btn_aceptar');    
                $ml_wl->btn_rechazar       = $request->get('btn_rechazar');                  
                $ml_wl->save();              

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function update_loan_repayment(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo por socio
                $ml_lp                     = Ml_loan_partner::where('many_lenguages_id', $idioma->id)->first();
                $ml_lp->titulo_lp          = $request->get('titulo_lp');     
                $ml_lp->subtitulo_lp       = $request->get('subtitulo_lp');
                $ml_lp->dt_id_lp           = $request->get('dt_id_lp');     
                $ml_lp->dt_socio_lp        = $request->get('dt_socio_lp');
                $ml_lp->dt_nickname_lp     = $request->get('dt_nickname_lp');
                $ml_lp->dt_nombre_lp       = $request->get('dt_nombre_lp');  
                $ml_lp->dt_email_lp        = $request->get('dt_email_lp');
                $ml_lp->dt_estado_lp       = $request->get('dt_estado_lp');
                $ml_lp->dt_acciones_lp     = $request->get('dt_acciones_lp');  
                $ml_lp->titulo_index_lp    = $request->get('titulo_index_lp');  
                $ml_lp->seccion_socio      = $request->get('seccion_socio');  
                $ml_lp->genero             = $request->get('genero');  
                $ml_lp->fecha_nac          = $request->get('fecha_nac'); 
                $ml_lp->email              = $request->get('email');
                $ml_lp->telefono           = $request->get('telefono');
                $ml_lp->direccion          = $request->get('direccion');
                $ml_lp->cod_postal         = $request->get('cod_postal');
                $ml_lp->ciudad             = $request->get('ciudad');
                $ml_lp->provincia          = $request->get('provincia');                
                $ml_lp->seccion_prestamo   = $request->get('seccion_prestamo');  
                $ml_lp->num_copia          = $request->get('num_copia');
                $ml_lp->prestado_el        = $request->get('prestado_el');  
                $ml_lp->devolver_el        = $request->get('devolver_el');  
                $ml_lp->dias_retraso       = $request->get('dias_retraso');  
                $ml_lp->sancion            = $request->get('sancion');  
                $ml_lp->economica          = $request->get('economica');    
                $ml_lp->btn_devolver       = $request->get('btn_devolver');    
                $ml_lp->btn_renovar        = $request->get('btn_renovar');    
                $ml_lp->btn_cerrar         = $request->get('btn_cerrar');    
                $ml_lp->btn_si             = $request->get('btn_si');    
                $ml_lp->mod_titulo_lp      = $request->get('mod_titulo_lp');    
                $ml_lp->mod_subtitulo_lp   = $request->get('mod_subtitulo_lp');    
                $ml_lp->cam_devolver_lp    = $request->get('cam_devolver_lp');    
                $ml_lp->save();  

                // Prestamo por documento
                $ml_ld                     = Ml_loan_document::where('many_lenguages_id', $idioma->id)->first();
                $ml_ld->titulo_ld         = $request->get('titulo_ld');     
                $ml_ld->subtitulo_ld       = $request->get('subtitulo_ld');
                $ml_ld->dt_id_ld           = $request->get('dt_id_ld');     
                $ml_ld->dt_titulo_ld       = $request->get('dt_titulo_ld');
                $ml_ld->dt_tipo_ld         = $request->get('dt_tipo_ld');
                $ml_ld->dt_subtipo_ld      = $request->get('dt_subtipo_ld');  
                $ml_ld->dt_copias_ld       = $request->get('dt_copias_ld');
                $ml_ld->dt_acciones_ld     = $request->get('dt_acciones_ld');
        
                $ml_ld->titulo_index_ld    = $request->get('titulo_index_ld');  
                $ml_ld->seccion_doc        = $request->get('seccion_doc');  
                $ml_ld->tipo_doc           = $request->get('tipo_doc');  
                $ml_ld->tipo_libro         = $request->get('tipo_libro'); 

                $ml_ld->num_copia_ld       = $request->get('num_copia_ld');
                $ml_ld->estado             = $request->get('estado');
                $ml_ld->prestado_a         = $request->get('prestado_a');
                $ml_ld->prestado_ld        = $request->get('prestado_ld');
                $ml_ld->devolver_ld        = $request->get('devolver_ld');
                $ml_ld->dias_retraso_ld    = $request->get('dias_retraso_ld');                
                $ml_ld->sancion_ld         = $request->get('sancion_ld');  
                $ml_ld->economica_ld       = $request->get('economica_ld');
            
                $ml_ld->btn_devolver_ld    = $request->get('btn_devolver_ld');    
                $ml_ld->btn_renovar_ld     = $request->get('btn_renovar_ld');    
                $ml_ld->btn_cerrar_ld      = $request->get('btn_cerrar_ld');    
                $ml_ld->btn_si_ld          = $request->get('btn_si_ld');    
                $ml_ld->mod_titulo_ld      = $request->get('mod_titulo_ld');    
                $ml_ld->mod_subtitulo_ld   = $request->get('mod_subtitulo_ld');    
                $ml_ld->cam_devolver_ld    = $request->get('cam_devolver_ld');    
                $ml_ld->save();  

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function update_send_letter(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo por socio
                $ml_sl                          = Ml_send_letter::where('many_lenguages_id', $idioma->id)->first();
                $ml_sl->titulo                  = $request->get('titulo');     
                $ml_sl->subtitulo               = $request->get('subtitulo');
                $ml_sl->select_modelo           = $request->get('select_modelo');     
                $ml_sl->ph_modelo               = $request->get('ph_modelo');
                $ml_sl->fecha                   = $request->get('fecha');
                $ml_sl->select_enviar           = $request->get('select_enviar');  
                $ml_sl->ph_enviar               = $request->get('ph_enviar');                
                $ml_sl->check_informe           = $request->get('check_informe');  
                $ml_sl->btn_email               = $request->get('btn_email');                                   
                $ml_sl->save();  

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function update_partner(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Prestamo por socio
                $ml_partner                     = Ml_partner::where('many_lenguages_id', $idioma->id)->first();
                $ml_partner->titulo_ams         = $request->get('titulo_ams');
                $ml_partner->subtitulo_ams      = $request->get('subtitulo_ams');
                $ml_partner->dt_id_ams          = $request->get('dt_id_ams');
                $ml_partner->dt_usuario_ams     = $request->get('dt_usuario_ams'); 
                $ml_partner->dt_nickname_ams    = $request->get('dt_nickname_ams');
                $ml_partner->dt_perfil_ams      = $request->get('dt_perfil_ams');           
                $ml_partner->dt_nombre_ams      = $request->get('dt_nombre_ams');
                $ml_partner->dt_email_ams       = $request->get('dt_email_ams');
                $ml_partner->dt_estado_ams      = $request->get('dt_estado_ams');           
                $ml_partner->dt_agregado_ams    = $request->get('dt_agregado_ams');
                $ml_partner->dt_acciones_ams    = $request->get('dt_acciones_ams');
                // form
                $ml_partner->mod_titulo         = $request->get('mod_titulo');
                
                $ml_partner->seccion_perfil     = $request->get('seccion_perfil');  
                $ml_partner->mod_select_tipo    = $request->get('mod_select_tipo');
                $ml_partner->mod_check_biblio   = $request->get('mod_check_biblio');  
                $ml_partner->mod_check_socio    = $request->get('mod_check_socio');
                $ml_partner->mod_num_user       = $request->get('mod_num_user');  
                $ml_partner->mod_span_num       = $request->get('mod_span_num');
                $ml_partner->mod_nickname       = $request->get('mod_nickname'); 
                $ml_partner->mod_select_estado  = $request->get('mod_select_estado');  
                $ml_partner->mod_ph_estado      = $request->get('mod_ph_estado');
                $ml_partner->mod_imagen         = $request->get('mod_imagen');  
                $ml_partner->mod_email          = $request->get('mod_email');
                $ml_partner->mod_span_email     = $request->get('mod_span_email');             
            
                $ml_partner->seccion_personales = $request->get('seccion_personales');  
                $ml_partner->mod_nombre         = $request->get('mod_nombre');
                $ml_partner->mod_apellido       = $request->get('mod_apellido');  
                $ml_partner->mod_select_genero  = $request->get('mod_select_genero');
                $ml_partner->mod_ph_genero      = $request->get('mod_ph_genero');  
                $ml_partner->mod_fecha_nac      = $request->get('mod_fecha_nac');  
                $ml_partner->mod_pass           = $request->get('mod_pass');  
                $ml_partner->mod_span_pass      = $request->get('mod_span_pass');  
                $ml_partner->mod_repite_pass    = $request->get('mod_repite_pass');            

                $ml_partner->seccion_direccion  = $request->get('seccion_direccion');  
                $ml_partner->mod_telefono       = $request->get('mod_telefono');
                $ml_partner->mod_direccion      = $request->get('mod_direccion');  
                $ml_partner->mod_cod_postal     = $request->get('mod_cod_postal');
                $ml_partner->mod_ciudad         = $request->get('mod_ciudad');  
                $ml_partner->mod_select_provincia = $request->get('mod_select_provincia');
                $ml_partner->mod_ph_provincia   = $request->get('mod_ph_provincia');            
                    
                // show
                $ml_partner->mod_titulo_show    = $request->get('mod_titulo_show');
                $ml_partner->mod_usuario        = $request->get('mod_usuario');              
                $ml_partner->mod_estado         = $request->get('mod_estado');            
                $ml_partner->mod_info_direccion = $request->get('mod_info_direccion');  
                $ml_partner->mod_info_cod_postal= $request->get('mod_info_cod_postal');
                $ml_partner->mod_info_telefono  = $request->get('mod_info_telefono');
                
                // botones
                $ml_partner->btn_crear          = $request->get('btn_crear');     
                $ml_partner->btn_actualizar     = $request->get('btn_actualizar');       
                $ml_partner->btn_cerrar         = $request->get('btn_cerrar'); 
                $ml_partner->save(); 

                // Solicitud desde la web
                $ml_wr                          = Ml_web_request::where('many_lenguages_id', $idioma->id)->first();
                $ml_wr->titulo_wr               = $request->get('titulo_wr');
                $ml_wr->subtitulo_wr            = $request->get('subtitulo_wr');
                $ml_wr->dt_id_wr                = $request->get('dt_id_wr');
                $ml_wr->dt_nombre_wr            = $request->get('dt_nombre_wr');
                $ml_wr->dt_usuario_wr           = $request->get('dt_usuario_wr'); 
                $ml_wr->dt_email_wr             = $request->get('dt_email_wr');
                $ml_wr->dt_estado_wr            = $request->get('dt_estado_wr');           
                $ml_wr->dt_agregado_wr          = $request->get('dt_agregado_wr');
                $ml_wr->dt_acciones_wr          = $request->get('dt_acciones_wr');
                $ml_wr->save();                   

                DB::commit();               

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function update_credentials(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();                
                         
                $idioma                         = ManyLenguages::findOrFail($id);
                $idioma->lenguage_description   = $request->get('lenguage_description');             
                $idioma->save();
               
                // Iniciar sesion
                $ml_login                   = Ml_login::where('many_lenguages_id', $idioma->id)->first();
                $ml_login->pri_nombre_is    = $request->get('pri_nombre_is');
                $ml_login->seg_nombre_is    = $request->get('seg_nombre_is');
                $ml_login->login_is         = $request->get('login_is');
                $ml_login->login_msg_is     = $request->get('login_msg_is');
                $ml_login->email_is         = $request->get('email_is');
                $ml_login->contraseña_is    = $request->get('contraseña_is'); 
                $ml_login->link_pass_is     = $request->get('link_pass_is');
                $ml_login->btn_entrar_is    = $request->get('btn_entrar_is');
                $ml_login->save(); 

                 // Reestablecer contraseña
                 $ml_password                       = Ml_password::where('many_lenguages_id', $idioma->id)->first();
                 $ml_password->pri_nombre_rp        = $request->get('pri_nombre_rp');
                 $ml_password->seg_nombre_rp        = $request->get('seg_nombre_rp');
                 $ml_password->reset_rp             = $request->get('reset_rp');
                 $ml_password->reset_msg_rp         = $request->get('reset_msg_rp');
                 $ml_password->email_rp             = $request->get('email_rp');                
                 $ml_password->btn_reestablecer_rp  = $request->get('btn_reestablecer_rp');
                 $ml_password->save(); 
                
                // Solicitud de registro
                $ml_registry                   = Ml_registry::where('many_lenguages_id', $idioma->id)->first();
                $ml_registry->titulo_reg       = $request->get('titulo_reg');
                $ml_registry->info_reg         = $request->get('info_reg');
                $ml_registry->seccion          = $request->get('seccion');
                $ml_registry->nombre_reg       = $request->get('nombre_reg');
                $ml_registry->apellido_reg     = $request->get('apellido_reg');
                $ml_registry->nickname_reg     = $request->get('nickname_reg'); 
                $ml_registry->email_reg        = $request->get('email_reg');
                $ml_registry->fecha_nac_reg    = $request->get('fecha_nac_reg');
                $ml_registry->ph_fecha_nac_reg = $request->get('ph_fecha_nac_reg');
                // $ml_registry->btn_cerrar_reg   = $request->get('btn_cerrar_reg');
                // $ml_registry->btn_enviar_reg   = $request->get('btn_enviar_reg');
                $ml_registry->save(); 

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
                    'idiomas'               => $idiomas,                       
                    'url_edit'              => route('admin.manylenguages.edit', $idiomas->id),
                    'url_edit_maintenance'  => route('admin.manylenguages.edit_maintenance', $idiomas->id),                  
                    'url_edit_list'         => route('admin.manylenguages.edit_list', $idiomas->id),                    
                    'url_edit_statistic'    => route('admin.manylenguages.edit_statistic', $idiomas->id),                    
                    'url_library_profile'   => route('admin.manylenguages.edit_library_profile', $idiomas->id), 
                    'url_loan'              => route('admin.manylenguages.edit_loan', $idiomas->id),
                    'url_loan_repayment'    => route('admin.manylenguages.edit_loan_repayment', $idiomas->id),                    
                    'url_send_letter'       => route('admin.manylenguages.edit_send_letter', $idiomas->id),                    
                    'url_edit_partner'      => route('admin.manylenguages.edit_partner', $idiomas->id),
                    'url_edit_credentials'  => route('admin.manylenguages.edit_credentials', $idiomas->id),                                        
                    'url_destroy'           => route('admin.manylenguages.destroy', $idiomas->id),   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['label_estado', 'created_at', 'accion']) 
            ->make(true);  
    }
}
