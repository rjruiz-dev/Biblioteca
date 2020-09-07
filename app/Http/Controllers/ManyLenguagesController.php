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
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use App\Periodical_publication;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
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
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
        // dd($idioma->navegacion);
        return view('admin.manylenguages.index', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
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

        return view('admin.manylenguages.partials.form', [          
            'idioma'        => $idioma,
            'ml_dashboard'  => $ml_dashboard,
            'ml_document'   => $ml_document,
            'ml_movie'      => $ml_movie,

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
                $ml_dashboard->many_lenguages_id    = $idioma->id;               
                $ml_dashboard->save();              

                $ml_document                        = new Ml_document;
                $ml_document->cdu                   = $request->get('cdu');
                $ml_document->adecuacion            = $request->get('adecuacion');
                $ml_document->idioma                = $request->get('idioma');
                $ml_document->tipo_doc              = $request->get('tipo_doc');  
                $ml_document->subtipo_doc           = $request->get('subtipo_doc');
                $ml_document->creador               = $request->get('creador');  
                $ml_document->titulo                = $request->get('titulo');  
                $ml_document->titulo_original       = $request->get('titulo_original');  
                $ml_document->adquirido             = $request->get('adquirido');  
                $ml_document->siglas_autor          = $request->get('siglas_autor');  
                $ml_document->siglas_titulo         = $request->get('siglas_titulo');  
                $ml_document->valoracion            = $request->get('valoracion');                  
                $ml_document->desidherata           = $request->get('desidherata');  
                $ml_document->publicado             = $request->get('publicado');  
                $ml_document->hecho_por             = $request->get('hecho_por');  
                $ml_document->año                   = $request->get('año');  
                $ml_document->volumen               = $request->get('volumen');  
                $ml_document->cant_generica         = $request->get('cant_generica');  
                $ml_document->coleccion             = $request->get('coleccion');  
                $ml_document->ubicacion             = $request->get('ubicacion');  
                $ml_document->observacion           = $request->get('observacion');  
                $ml_document->nota                  = $request->get('nota');  
                $ml_document->sinopsis              = $request->get('sinopsis');  
                $ml_document->foto                  = $request->get('foto');                  
                $ml_document->many_lenguages_id     = $idioma->id;
                $ml_document->save();

                $ml_movie = new Ml_movie;
                $ml_movie->genero                   = $request->get('genero');
                $ml_movie->formato                  = $request->get('formato');
                $ml_movie->adaptacion               = $request->get('adaptacion');
                $ml_movie->fotografia_tipo          = $request->get('fotografia_tipo');  
                $ml_movie->subtitulo                = $request->get('subtitulo');
                $ml_movie->guion                    = $request->get('guion');  
                $ml_movie->contenido_especifico     = $request->get('contenido_especifico');  
                $ml_movie->premios                  = $request->get('premios');  
                $ml_movie->distribuidor             = $request->get('distribuidor');                            
                $ml_movie->many_lenguages_id        = $idioma->id;
                $ml_movie->save();

              

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
        
        return view('admin.manylenguages.partials.form', [          
            'idioma'        => $idioma,
            'ml_dashboard'  => $ml_dashboard,
            'ml_document'   => $ml_document,
            'ml_movie'      => $ml_movie,
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
                // $ml_dashboard->many_lenguages_id = $idioma->id;
                $ml_dashboard->save();


                $ml_document                        = Ml_document::where('many_lenguages_id', $idioma->id)->first();
                $ml_document->cdu                   = $request->get('cdu');
                $ml_document->adecuacion            = $request->get('adecuacion');
                $ml_document->idioma                = $request->get('idioma');
                $ml_document->tipo_doc              = $request->get('tipo_doc');  
                $ml_document->subtipo_doc           = $request->get('subtipo_doc');
                $ml_document->creador               = $request->get('creador');  
                $ml_document->titulo                = $request->get('titulo');  
                $ml_document->titulo_original       = $request->get('titulo_original');  
                $ml_document->adquirido             = $request->get('adquirido');  
                $ml_document->siglas_autor          = $request->get('siglas_autor');  
                $ml_document->siglas_titulo         = $request->get('siglas_titulo');  
                $ml_document->valoracion            = $request->get('valoracion');                  
                $ml_document->desidherata           = $request->get('desidherata');  
                $ml_document->publicado             = $request->get('publicado');  
                $ml_document->hecho_por             = $request->get('hecho_por');  
                $ml_document->año                   = $request->get('año');  
                $ml_document->volumen               = $request->get('volumen');  
                $ml_document->cant_generica         = $request->get('cant_generica');  
                $ml_document->coleccion             = $request->get('coleccion');  
                $ml_document->ubicacion             = $request->get('ubicacion');  
                $ml_document->observacion           = $request->get('observacion');  
                $ml_document->nota                  = $request->get('nota');  
                $ml_document->sinopsis              = $request->get('sinopsis'); 
                $ml_document->foto                  = $request->get('foto');   
                $ml_document->save();

                $ml_movie                           = Ml_movie::where('many_lenguages_id', $idioma->id)->first();
                $ml_movie->genero                   = $request->get('genero');
                $ml_movie->formato                  = $request->get('formato');
                $ml_movie->adaptacion               = $request->get('adaptacion');
                $ml_movie->fotografia_tipo          = $request->get('fotografia_tipo');  
                $ml_movie->subtitulo                = $request->get('subtitulo');
                $ml_movie->guion                    = $request->get('guion');  
                $ml_movie->contenido_especifico     = $request->get('contenido_especifico');  
                $ml_movie->premios                  = $request->get('premios');  
                $ml_movie->distribuidor             = $request->get('distribuidor'); 
                $ml_movie->save();
                
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
