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
      
        return view('web.movies.show', compact('movie'), [
            'idioma_doc' => $idioma_doc,
            'idioma_movie' => $idioma_movie 
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

    public function dataTable()
    {   
        $movie = Movies::with('document.creator','generate_movie','generate_format', 'document.lenguage', 'document.status_document') 
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
            ->rawColumns(['id_doc','documents_id', 'generate_films_id', 'generate_formats_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
