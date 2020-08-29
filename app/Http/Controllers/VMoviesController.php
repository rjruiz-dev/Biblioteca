<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveMovieRequest;

class VMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index');
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
    public function show($id)
    {
      
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
        // ->allowed()
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
             
                return view('movies.partials._action', [
                    'movie'             => $movie,
                    'url_show'          => route('vmovies/vshow', $movie->id),                          
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc','documents_id', 'generate_films_id', 'generate_formats_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
