<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Movies;
use App\Actor;
use App\Creator;
use App\Adequacy;
use App\Generate_film;
use App\Generate_reference;
use App\Generate_format;
use App\Adaptation;
use App\Document;
use App\Lenguage;
use App\Generate_subjects;
use App\StatusDocument;
use App\Document_subtype;
use App\Photography_movie;
use App\Book_movement;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveMovieRequest;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_movie;

class VMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas    = ManyLenguages::all();
        $setting    = Setting::where('id', 1)->first();        

        return view('web.movies.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas,
            'setting'    => $setting,
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_film::pluck('genre_film', 'id')
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
         // $request->session()->put('idiomas', 2);
         if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma_doc = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_movie = ml_show_movie::where('many_lenguages_id',$session)->first();
        // dd($idioma_movie);
        $movie = Movies::with('document.creator', 'actors', 'photography_movie', 'generate_movie', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
        $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
        
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id)->where(function ($query) {
                $query->where('status_copy_id', '=', 3)
                      ->orWhere('status_copy_id', '=', 6);
            });
        })
        ->where('active', 1) 
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 3)
                  ->orWhere('movement_types_id', '=', 6);
        })    
        ->get();

        // dd($copies_disponibles);
        if($copies_disponibles->count() > 0){
            // dd('habilitado');
            $disabled = '';
            $label_copia_no_disponible = '';
        }else{
            $disabled = 'disabled';
            // dd('NO habilitado');
            $label_copia_no_disponible = 'Documento Sin Copias Disponibles';
        }

        return view('web.movies.show', compact('movie'), [
            'idioma_doc'    => $idioma_doc,
            'idioma_movie'  => $idioma_movie,
            'disabled'      => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]);
        
        // return view('web.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataTable(Request $request)
    {   
        
        // $movie = Movies::with('document.creator','generate_movie','generate_format', 'document.lenguage', 'document.status_document') 
        // ->whereHas('document', function($q)
        // {
        //     // $q->where(function ($query) {
        //     //     $query->where('status_documents_id', '=', 1);
        //     // });
        //     $q->where('status_documents_id', '=', 1);
        // })
        
        // ->get();

        if($request->get('subjects') != ''){
            $subjects_mostrar = true; 
        }else{
            $subjects_mostrar = false;      
        }

        if($request->get('adaptations') != ''){
            $adaptations_mostrar = true; 
        }else{
            $adaptations_mostrar = false;      
        }
    
        if($request->get('genders') != ''){
            $genders_mostrar = true; 
        }else{
            $genders_mostrar = false;      
        }

        if($request->get('references') != ''){
            $references_mostrar = true; 
        }else{
            $references_mostrar = false;      
        }
        
          // $movie = Movies::with('document.creator','generate_movie','generate_format', 'document.lenguage', 'document.status_document')
        $movie = Movies::with('document.creator', 'document', 'generate_movie', 'generate_format', 'document.references', 'document.status_document', 'document.lenguage') 
            ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request)
            {
                $q->where('status_documents_id', '=', 1);
            
                if($subjects_mostrar){
                    $q->where('generate_subjects_id', '=', $request->get('subjects'));   
                }
                if($adaptations_mostrar){
                    $q->where('adequacies_id', '=', $request->get('adaptations'));   
                } 
            })    
            ->where(function($q) use($genders_mostrar, $request)
            {
                // dd($genders_mostrar);
                if($genders_mostrar){
                    $q->where('generate_films_id', '=', $request->get('genders'));   
                } 
            })
            ->whereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })            
            ->get(); 
        
        return dataTables::of($movie)
            ->addColumn('id_doc', function ($movie){
                return $movie->document['id']."<br>";            
            })              
            ->addColumn('documents_id', function ($movie){
                return
                    '<i class="fa fa-video-camera"></i>'.' '.$movie->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$movie->document->creator->creator_name."<br>";         
            }) 
            ->addColumn('generate_films_id', function ($movie){
                if($movie->generate_movie->genre_film != null){
                    return $movie->generate_movie->genre_film;
                }else{
                    return 'Sin Genero';
                }             
            }) 
            ->addColumn('photo', function ($movie){                
                $url=asset("./images/". $movie->document->photo); 
                return '<img src='.$url.' border="0" width="80" height="80" class="img-rounded" align="center" />';
               
            }) 
            ->addColumn('generate_formats_id', function ($movie){
                if($movie->generate_format['genre_format'] != null){
                    return $movie->generate_format['genre_format'];
                }else{
                    return 'Sin Formato';
                }              
            })  
            ->addColumn('lenguages_id', function ($movie){
                if($movie->document->lenguage->leguage_description != null){
                return'<i class="fa  fa-globe"></i>'.' '.$movie->document->lenguage->leguage_description;         
                }else{
                    return 'Sin Lenguaje';
                }
                })
            ->addColumn('status', function ($movie){

                return'<span class="'.$movie->document->status_document->color.'">'.' '.$movie->document->status_document->name_status.'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })            
            ->addColumn('created_at', function ($movie){
                return $movie->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($movie) {             
                return view('web.movies.partials._action', [
                    'movie'             => $movie,
                    'url_show'          => route('web.cine.show', $movie->id),   
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc','documents_id', 'generate_films_id', 'photo', 'generate_formats_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
