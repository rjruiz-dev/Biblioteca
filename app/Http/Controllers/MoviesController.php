<?php

namespace App\Http\Controllers;

use App\Movies;
use App\Creator;
use App\Formats;
use App\Document_subtype;
use App\Adequacy;
use App\Generate_movie;
use App\Adaptations;
use App\Lenguage;
use App\Document;
use App\photography_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.movies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $movie = new Movies();      
                              
        return view('admin.movies.partials.form', [
            // 'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            'genders' => Generate_movie::pluck('genre_movie', 'id'),
            'distributions' => Movies::pluck('distribution', 'distribution'),
            'adaptations_bis' => Adaptations::pluck('adaptation_name', 'id'),
            'photographs' => photography_movies::pluck('photography_movies_name', 'id'),
            
            //  'second_authors' => Multimedia::pluck('second_author', 'second_author'),
            //  'third_authors' => Multimedia::pluck('third_author', 'third_author'),

             'formats' => Formats::pluck('format_name', 'id'),
            // // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'movie'      => $movie
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
                $document = new Document;
                $document->document_types_id    = 3; // 3 tipo de documento: cine.
                $document->document_subtypes_id = 9; // 9 sub-tipo de documento: no tiene. 
                $document->title            = $request->get('title');
                
                // $document->creators_id = $request->get('creators_id');

                if( is_numeric($request->get('creators_id'))) 
                 {                
                     $document->creators_id    = $request->get('creators_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('creators_id');
                     $creator->document_types_id = 1;
                     $creator->save();
                     $document->creators_id = $creator->id;
                 }
                 $document->original_title    = $request->get('original_title'); 
                $document->acquired         = Carbon::parse($request->get('acquired'));        
                $document->drop             = Carbon::parse($request->get('drop')); 
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->cdu              = $request->get('cdu');  
                $document->assessment       = $request->get('assessment'); 
                $document->desidherata      = $request->get('desidherata'); 
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::parse($request->get('year'));
                $document->quantity_generic  = $request->get('quantity_generic'); 
                $document->location      = $request->get('location');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');
 
                $document->save();

                 // insertamos en la tabla multimedia
                
                $movie = new Movies; 

                $movie->formats_id     = $request->get('formats_id');
                $movie->generate_movies_id     = $request->get('generate_movies_id');
                $movie->adaptations_id = $request->get('adaptations_id');
                $movie->photography_movies_id     = $request->get('photography_movies_id'); 
                
                $movie->subtitle = $request->get('subtitle');
                $movie->distribution = $request->get('distribution');
                $movie->script = $request->get('script');
                $movie->specific_content = $request->get('specific_content');
                $movie->awards     = $request->get('awards');
                $movie->distributor     = $request->get('distributor');
                
             
                $movie->documents_id = $document->id;//guardamos el id del documento
                
                $movie->save();
   
                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function show(movies $movies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          
        $movie = Movies::with('document')->findOrFail($id);        
                              
        return view('admin.movies.partials.form', [
            // 'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            'genders' => Generate_movie::pluck('genre_movie', 'id'),
            'distributions' => Movies::pluck('distribution', 'distribution'),
            'adaptations_bis' => Adaptations::pluck('adaptation_name', 'id'),
            'photographs' => photography_movies::pluck('photography_movies_name', 'id'),
            
            //  'second_authors' => Multimedia::pluck('second_author', 'second_author'),
            //  'third_authors' => Multimedia::pluck('third_author', 'third_author'),

             'formats' => Formats::pluck('format_name', 'id'),
            // // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'movie'      => $movie
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                
                $movie = Movies::findOrFail($id);
                $document = Document::findOrFail($movie->documents_id);
                
                
                $document->title            = $request->get('title');
                
                // $document->creators_id = $request->get('creators_id');

                if( is_numeric($request->get('creators_id'))) 
                 {                
                     $document->creators_id    = $request->get('creators_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('creators_id');
                     $creator->document_types_id = 1;
                     $creator->save();
                     $document->creators_id = $creator->id;
                 }
                 $document->original_title    = $request->get('original_title'); 
                $document->acquired         = Carbon::parse($request->get('acquired'));        
                $document->drop             = Carbon::parse($request->get('drop')); 
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->cdu              = $request->get('cdu');  
                $document->assessment       = $request->get('assessment'); 
                $document->desidherata      = $request->get('desidherata'); 
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::parse($request->get('year'));
                $document->quantity_generic  = $request->get('quantity_generic'); 
                $document->location      = $request->get('location');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');
 
                $document->save();

                 // insertamos en la tabla movies

                $movie->formats_id     = $request->get('formats_id');
                $movie->generate_movies_id     = $request->get('generate_movies_id');
                $movie->adaptations_id = $request->get('adaptations_id');
                $movie->photography_movies_id     = $request->get('photography_movies_id'); 
                
                $movie->subtitle = $request->get('subtitle');
                $movie->distribution = $request->get('distribution');
                $movie->script = $request->get('script');
                $movie->specific_content = $request->get('specific_content');
                $movie->awards     = $request->get('awards');
                $movie->distributor     = $request->get('distributor');
                
             
                $movie->documents_id = $document->id;//guardamos el id del documento
                
                $movie->save();
   
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
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy(movies $movies)
    {
        //
    }

    public function dataTable()
    {   
        $movie = Movies::with('document.creator','format') 
        // ->allowed()
        ->get();
        // dd($movie);       
        return dataTables::of($movie)
            // ->addColumn('registry_number', function ($movie){
            //     return
            //         '<i class="fa fa-user"></i>'.' '.$movie->registry_number."<br>";            
            // }) 
            ->addColumn('formats_id', function ($movie){

                return  $movie->format->format_name;              
            })  
            ->addColumn('documents_id', function ($movie){
                return
                    '<i class="fa fa-music"></i>'.' '.$movie->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$movie->document->creator->creator_name."<br>";         
            }) 
            // ->addColumn('lenguages_id', function ($movie){

            //     return'<i class="fa  fa-globe"></i>'.' '.$movie->document->lenguage->leguage_description;         
            // })            
            ->addColumn('created_at', function ($movie){
                return $movie->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($movie) {
                return view('admin.movies.partials._action', [
                    'movie' => $movie,
                    'url_show' => route('admin.movies.show', $movie->id),                        
                    'url_edit' => route('admin.movies.edit', $movie->id),                              
                    'url_destroy' => route('admin.movies.destroy', $movie->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['documents_id','formats_id', 'created_at', 'accion']) 
            ->make(true);  
    }

}
