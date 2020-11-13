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
use App\Book_movement;
use App\Generate_subjects;
use App\StatusDocument;
use App\Document_subtype;
use App\Photography_movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveMovieRequest;
use App\Ml_dashboard;
use App\Ml_document;
use App\Ml_movie;
use App\ml_abm_doc;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_movie;
use App\ml_abm_book;
use App\ml_abm_book_otros;
use App\ml_abm_book_publ_period;
use App\ml_abm_book_lit;
use App\Copy;
use Illuminate\Support\Facades\Auth; 

class MoviesController extends Controller
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
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas            = ManyLenguages::all();

        // $this->authorize('view', new Movies); 

        return view('admin.movies.index', [
            'idioma'            => $idioma,
            'idioma_document'   => $idioma_document,
            'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'setting'           => $setting,

             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'    => Generate_film::pluck('genre_film', 'id')
             // replicar esto FIN 
        ]); 
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
      
        // $this->authorize('create', $movie);            
                              
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
    public function store(SaveMovieRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // $this->authorize('create', new Movies);
                              
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
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));             
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

                if ($request->hasFile('photo')){          
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{                
                    $name = 'doc-default.jpg';
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
      
        $movie = Movies::with('document.creator', 'actors', 'photography_movie', 'generate_movie', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
        
        $id_docu = $movie->documents_id;

        $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id_docu)
        {
            $q->where('documents_id', '=', $id_docu)->where(function ($query) {
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

        
        // $this->authorize('view', $movie);

        return view('admin.movies.show', compact('movie'), [
            'idioma_doc'    => $idioma_doc,
            'idioma_movie'  => $idioma_movie,
            'disabled'      => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]);

        // return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    { 

        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $movie = Movies::with('document','document.subjects', 'document.references')->findOrFail($id);    
        $document = Document::findOrFail($movie->documents_id);   

        // $this->authorize('update', $movie);
        $id_docum = $document->id;

        $idioma_abm_doc = ml_abm_doc::where('many_lenguages_id',$session)->first();
        $idioma_abm_book = ml_abm_book::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_otros = ml_abm_book_otros::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_publ_period = ml_abm_book_publ_period::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_lit = ml_abm_book_lit::where('many_lenguages_id',$session)->first();
       
        // $verifi_copies = Book_movement::with('movement_type','copy.document.creator','user')
        // ->whereHas('copy', function($q) use ($id_docum)
        // {
        //     $q->where('documents_id', '=', $id_docum)->where(function ($query) {
        //         $query->where('status_copy_id', '=', 1)
        //               ->orWhere('status_copy_id', '=', 2)
        //               ->orWhere('status_copy_id', '=', 7);
        //     });
        // })
        // ->where('active', 1) 
        // ->where(function ($query) {
        //     $query->where('movement_types_id', '=', 1)
        //           ->orWhere('movement_types_id', '=', 2)
        //           ->orWhere('movement_types_id', '=', 7);
        // })    
        // ->get();

        // if($verifi_copies->count() > 0){

        //     return view('admin.movies.partials.form_no_disp'); 

        // }else{
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
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMovieRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $movie      = Movies::findOrFail($id);
                $document   = Document::findOrFail($movie->documents_id); 
                
                // $this->authorize('update', $movie);             
                
                $name = $movie->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                }else{
                    $name = 'doc-default.jpg';
                }    

                if( is_numeric($request->get('creators_id'))){                
                    $document->creators_id  = $request->get('creators_id');    
 
                }else{

                    $creator = new Creator;
                    $creator->creator_name         = $request->get('creators_id');
                    $creator->document_types_id    = 1;
                    $creator->save();
                    $document->creators_id         = $creator->id;

                }

                $document->title                = $request->get('title');  
                $document->original_title       = $request->get('original_title');                
                $document->acquired             = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));              
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

        // $this->authorize('delete', $document);

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

    public function exportPdf(Request $request, $id)
    {
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma_doc = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_movie = ml_show_movie::where('many_lenguages_id',$session)->first();
        
        $movie = Movies::with('document.creator', 'actors', 'generate_movie', 'document.adequacy', 'document.lenguage')->findOrFail($id);
        $setting = Setting::where('id', 1)->first();
        $id_docu = $movie->documents_id;         

        $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id_docu)
        {
            $q->where('documents_id', '=', $id_docu)->where(function ($query) {
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

       
        if($copies_disponibles->count() > 0){           
            $disabled = '';
            $label_copia_no_disponible = '';
        }else{
            $disabled = 'disabled';           
            $label_copia_no_disponible = 'Documento Sin Copias Disponibles';
        }

        $pdf = PDF::loadView('admin.movies.exportPDF', compact('movie'),[
            'idioma_doc'                => $idioma_doc,
            'idioma_movie'              => $idioma_movie,            
            'disabled'                  => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible,
            'setting'                   => $setting
        ]);  
     
        return $pdf->download('cine.pdf');
    }

    public function desidherata($id)
    {
        $document = Document::findOrFail($id);    

        $document->status_documents_id = 3;
        $document->desidherata = 1;    
        $document->save();

        $prestamos_en_cancelacion = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        })
        ->where('active', 1)
        ->where('movement_types_id', 9)  
        ->get();

        if($prestamos_en_cancelacion->count() > 0){//si encuentra actualmente copias en prestamo .

        foreach($prestamos_en_cancelacion as $prestam){
            $prestam->active = 0;
            // $prestam->save();
            
            $new_movement = new Book_movement;
            $new_movement->movement_types_id = 6;
            $new_movement->copies_id = $prestam->copies_id;
            $new_movement->active = 1;
            $new_movement->date = Carbon::now();  

            $copy = Copy::findOrFail($prestam->copies_id); //solo en este caso se setea la copia en 9, osea cancelacion por baja documento.sino al dar de baja un documento nunca se 
            // toca el estado de las copias cuando se da de baja el documento ya que siempre se valida que el doc este activo, solo en este caso q hay prestamos activos referenciados a una copia X
            $copy->status_copy_id = 6;
            $prestam->save();
            $new_movement->save(); 
            $copy->save();
        }
    }
    }
    

    public function baja($id)
    {
        $document = Document::findOrFail($id);

        $document->status_documents_id = 2;
        $document->desidherata = 0;   
        $document->save();

        $prestamos_vigentes_del_doc = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        })
        ->where('active', 1)
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
        })  
        ->get();

        if($prestamos_vigentes_del_doc->count() > 0){//si encuentra actualmente copias en prestamo .

        foreach($prestamos_vigentes_del_doc as $prestam){
            $prestam->active = 0;
            // $prestam->save();
            
            $new_movement = new Book_movement;
            $new_movement->movement_types_id = 9;
            $new_movement->users_id = $prestam->users_id;
            $new_movement->copies_id = $prestam->copies_id;
            $new_movement->active = 1;
            $new_movement->date = Carbon::now();  

            $copy = Copy::findOrFail($prestam->copies_id); //solo en este caso se setea la copia en 9, osea cancelacion por baja documento.sino al dar de baja un documento nunca se 
            // toca el estado de las copias cuando se da de baja el documento ya que siempre se valida que el doc este activo, solo en este caso q hay prestamos activos referenciados a una copia X
            $copy->status_copy_id = 9;
            $prestam->save();
            $new_movement->save();
            $copy->save();
        }
    }

    }

    public function copy($id)
    {        
        $document = Document::findOrFail($id);

        // if($document->status_documents_id == 2){
        //     return response()->json(['data' => 0]);      
        // }else{
            return response()->json(['data' => $document->id]); 
        // }  
    }

    public function reactivar($id)
    {
        $document = Document::findOrFail($id);
     
        // dd($document);
        $document->status_documents_id = 1;
        $document->desidherata = 0;   
        $document->save();

        $prestamos_en_cancelacion = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        })
        ->where('active', 1)
        ->where('movement_types_id', 9)  
        ->get();

        if($prestamos_en_cancelacion->count() > 0){//si encuentra actualmente copias en prestamo .

        foreach($prestamos_en_cancelacion as $prestam){
            $prestam->active = 0;
            // $prestam->save();
            
            $new_movement = new Book_movement;
            $new_movement->movement_types_id = 6;
            $new_movement->copies_id = $prestam->copies_id;
            $new_movement->active = 1;
            $new_movement->date = Carbon::now();  

            $copy = Copy::findOrFail($prestam->copies_id); //solo en este caso se setea la copia en 9, osea cancelacion por baja documento.sino al dar de baja un documento nunca se 
            // toca el estado de las copias cuando se da de baja el documento ya que siempre se valida que el doc este activo, solo en este caso q hay prestamos activos referenciados a una copia X
            $copy->status_copy_id = 6;
            $prestam->save();
            $new_movement->save(); 
            $copy->save();
        }
    }
    }
    

    public function dataTable(Request $request)
    {   
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

        if(Auth::user()->getRoleNames() == 'Partner'){
        $movie = Movies::with('document.creator','generate_movie','generate_format', 'document.lenguage', 'document.status_document') 
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
        // ->allowed()
        ->get();
        }else{
            $movie = Movies::with('document.creator','generate_movie','generate_format', 'document.lenguage', 'document.status_document') 
        ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request)
            {
                
                if($subjects_mostrar){
                    $q->where('generate_subjects_id', '=', $request->get('subjects'));   
                }
                if($adaptations_mostrar){
                    $q->where('adequacies_id', '=', $request->get('adaptations'));   
                }
            })
            ->where(function($q) use($genders_mostrar, $request)
            {            
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
        // ->allowed()
        ->get();
        }
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
                // 'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',  
                return view('admin.movies.partials._action', [
                    'movie'             => $movie,
                    'url_show'          => route('admin.movies.show', $movie->id),                        
                    'url_edit'          => route('admin.movies.edit', $movie->id),  
                    'url_copy'          => route('movies.copy', $movie->document->id),                              
                    'url_desidherata'   => route('movies.desidherata', $movie->document->id),
                    'url_baja'          => route('movies.baja', $movie->document->id),
                    'url_reactivar'     => route('movies.reactivar', $movie->document->id),
                    'url_print'         => route('cine.pdf', $movie->id)   
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc','documents_id', 'generate_films_id', 'photo', 'generate_formats_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }

}
