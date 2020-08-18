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
use App\Http\Requests\SaveDocumentRequest;

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
        $document = new Document();            
                              
        return view('admin.movies.partials.form', [           
            'subtypes'          => Document_subtype::pluck('subtype_name', 'id'),
            'authors'           => Creator::pluck('creator_name', 'id'),
            'adaptations'       => Adequacy::pluck('adequacy_description', 'id'),
            'genders'           => Generate_film::pluck('genre_film', 'id'),
            'subjects'          => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'publications'      => Document::pluck('published', 'published'),      
            'actors'            => Actor::all(),
            'references'        => Generate_reference::all(),                                 
            'distributors'      => Movies::pluck('distributor', 'distributor'),
            'editorials'        => Document::pluck('made_by', 'made_by'),
            'adaptations_bis'   => Adaptation::pluck('adaptation_name', 'id'),
            'photographs'       => Photography_movie::pluck('photography_movies_name', 'id'),
            'formats'           => Generate_format::pluck('genre_format', 'id'),
            'volumes'           => Document::pluck('volume', 'volume'),
            'languages'         => Lenguage::pluck('leguage_description', 'id'),
            'status_documents'  => StatusDocument::pluck('name_status', 'id'), 
            'movie'             => $movie,
            'document'          => $document
           
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveDocumentRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                // Creamos el documento            
                $document = new Document;
                $document->document_types_id    = 2; // 3 tipo de documento: cine.
                $document->document_subtypes_id = 9; // 9 sub-tipo de documento: no tiene. 
                $document->title                = $request->get('title');

                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id = $request->get('creators_id');    
 
                }else{
                     
                    $creator = new Creator;
                    $creator->creator_name         = $request->get('creators_id');
                    $creator->document_types_id    = 1;
                    $creator->save();
                    $document->creators_id = $creator->id;
                }

                $document->original_title   = $request->get('original_title');                 
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));             
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->assessment       = $request->get('assessment'); 
            
                if($request->get('desidherata') == null){

                    $document->desidherata = 0;
                    $document->status_documents_id = 1;

                }else{

                    $document->desidherata = 1;
                    $document->status_documents_id = 3;
                }
                 
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::createFromFormat('Y', $request->get('year'));
                $document->quantity_generic = $request->get('quantity_generic'); 
                $document->location         = $request->get('location');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');              
                $document->collection       = $request->get('collection'); 
                $document->synopsis         = $request->get('synopsis'); 

                if ($request->hasFile('photo')) {               

                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{
                    $name = null; // se asigno null pero se le podria ingresar una imagen por defecto si no carga nada 
                }  

                $document->photo            = $name;

                $document->save();
                $document->syncReferences($request->get('references'));

                // insertamos en la tabla multimedia                
                $movie = new Movies; 
                $movie->generate_formats_id     = $request->get('generate_formats_id');
                $movie->generate_films_id       = $request->get('generate_films_id');
                $movie->adaptations_id          = $request->get('adaptations_id');
                $movie->photography_movies_id   = $request->get('photography_movies_id');                 
                $movie->subtitle                = $request->get('subtitle');               
                $movie->script                  = $request->get('script');
                $movie->specific_content        = $request->get('specific_content');
                $movie->awards                  = $request->get('awards');
                $movie->distributor             = $request->get('distributor');             
                $movie->documents_id            = $document->id;//guardamos el id del documento 
                $movie->save();
                $movie->syncActors($request->get('actors'));
               
                DB::commit();

                return response()->json(['data' => $document->id, 'bandera' => 1]);

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
    public function show($id)
    {
        $movie = Movies::with('document.creator', 'actors', 'photography_movie', 'generate_movie', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movies::with('document','document.subjects', 'document.references')->findOrFail($id);    
        $document = Document::findOrFail($movie->documents_id);   
     
        return view('admin.movies.partials.form', [
           
            'subtypes'          => Document_subtype::pluck('subtype_name', 'id'),
            'authors'           => Creator::pluck('creator_name', 'id'),
            'adaptations'       => Adequacy::pluck('adequacy_description', 'id'),
            'genders'           => Generate_film::pluck('genre_film', 'id'), 
            'subjects'          => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'publications'      => Document::pluck('published', 'published'),
            'actors'            => Actor::all(),  
            'references'        => Generate_reference::all(),                      
            'distributors'      => Movies::pluck('distributor', 'distributor'),
            'editorials'        => Document::pluck('made_by', 'made_by'),
            'adaptations_bis'   => Adaptation::pluck('adaptation_name', 'id'),
            'photographs'       => Photography_movie::pluck('photography_movies_name', 'id'), 
            'formats'           => Generate_format::pluck('genre_format', 'id'),
            'volumes'           => Document::pluck('volume', 'volume'),
            'languages'         => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'movie'             => $movie,
            'document'          => $document
           
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(SaveDocumentRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $movie      = Movies::findOrFail($id);
                $document   = Document::findOrFail($movie->documents_id);    
                
                $name = $movie->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                } 

                $document->title  = $request->get('title');           

                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id  = $request->get('creators_id');    
 
                }else{

                    $creator = new Creator;
                    $creator->creator_name         = $request->get('creators_id');
                    $creator->document_types_id    = 1;
                    $creator->save();
                    $document->creators_id         = $creator->id;

                 }

                $document->original_title       = $request->get('original_title');                
                $document->acquired             = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));              
                $document->adequacies_id        = $request->get('adequacies_id');
                $document->let_author           = $request->get('let_author');
                $document->let_title            = $request->get('let_title');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->assessment           = $request->get('assessment');
                
                if($request->get('status_documents_id') == 3){
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 1;   
                }else{
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 0; 
                }
          
                $document->published            = $request->get('published');
                $document->made_by              = $request->get('made_by');
                $document->year                 = Carbon::createFromFormat('Y', $request->get('year'));
                $document->quantity_generic     = $request->get('quantity_generic'); 
                $document->location             = $request->get('location');
                $document->note                 = $request->get('note');
                $document->lenguages_id         = $request->get('lenguages_id');
                $document->collection           = $request->get('collection'); 
                $document->synopsis             = $request->get('synopsis'); 

 
                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                }
                $document->photo = $name; 

                $document->save();
                $document->syncReferences($request->get('references'));

                // insertamos en la tabla movies
                $movie->generate_formats_id     = $request->get('generate_formats_id');
                $movie->generate_films_id       = $request->get('generate_films_id');
                $movie->adaptations_id          = $request->get('adaptations_id');
                $movie->photography_movies_id   = $request->get('photography_movies_id'); 
                $movie->subtitle                = $request->get('subtitle');              
                $movie->script                  = $request->get('script');
                $movie->specific_content        = $request->get('specific_content');
                $movie->awards                  = $request->get('awards');
                $movie->distributor             = $request->get('distributor');
                $movie->documents_id            = $document->id;//guardamos el id del documento                
                $movie->save();
                $movie->syncActors($request->get('actors'));
   
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
    public function destroy($id) //se deja pero no se usa xq en algun futuro puede servir ok ? rodri salamin jajaj
    {
        $document = Document::findOrFail($id);

        if($document->status_documents_id == 1){ //si esta activo lo doy de baja
            $document->status_documents_id = 2;
            $document->desidherata = 0;
            $document->save();   
        }else{
            if($document->status_documents_id == 2){ //si esta en baja lo doy de alta
                $document->status_documents_id = 1;
                $document->desidherata = 0;
                $document->save();   
            }
        }
    }

    public function exportPdf()
    {
        $movie = Movies::with('document.creator', 'actors', 'generate_movie', 'document.adequacy', 'document.lenguage')->first();

        $pdf = PDF::loadView('admin.movies.show', compact('movie'));  
       
        return $pdf->download('cine.pdf');
    }
    public function desidherata($id)
    {
        $document = Document::findOrFail($id);
        $document->status_documents_id = 3;
        $document->desidherata = 1;    
        $document->save();
    }
    

    public function baja($id)
    {
        $document = Document::findOrFail($id);
        $document->status_documents_id = 2;
        $document->desidherata = 0;   
        $document->save();
    }

    public function copy($id)
    {
        
        $document = Document::findOrFail($id);
        if($document->status_documents_id == 2){
            return response()->json(['data' => 0]);      
        }else{
            return response()->json(['data' => $document->id]); 
        }  
    }

    public function reactivar($id)
    {
        $document = Document::findOrFail($id);
        // dd($document);
        $document->status_documents_id = 1;
        $document->desidherata = 0;   
        $document->save();
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
            ->addColumn('registry_number', function ($movie){
                return $movie->document['registry_number']."<br>";            
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
                if($movie->generate_format->genre_format != null){
                    return $movie->generate_format->genre_format;
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
                // 'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',  
                return view('admin.movies.partials._action', [
                    'movie' => $movie,
                    'url_show'      => route('admin.movies.show', $movie->id),                        
                    'url_edit'      => route('admin.movies.edit', $movie->id),  
                    'url_copy'          => route('movies.copy', $movie->document->id),                              
                    'url_desidherata' => route('movies.desidherata', $movie->document->id),
                    'url_baja' => route('movies.baja', $movie->document->id),
                    'url_reactivar' => route('movies.reactivar', $movie->document->id),
                    'url_print'     => route('cine.pdf', $movie->id)   
                     ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc','registry_number','documents_id', 'generate_films_id', 'generate_formats_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }

}
