<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Movies;
use App\Actor;
use App\ml_cat_sweetalert;
use App\ml_cat_edit_movie;
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
use App\ml_cat_list_book;
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
use App\Music;
use App\Book;
use App\Multimedia;
use App\Photography;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {         
        $idd = 'none'; //con esto indico q no tiene q filtrar por un cine solo
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        // $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        // $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.

        $idioma_cat_edit_movie = ml_cat_edit_movie::where('many_lenguages_id',$session)->first();
        
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
         
        // $this->authorize('view', new Movies); 

        return view('admin.movies.index', [
            'idioma'            => $idioma,
            // 'idioma_document'   => $idioma_document,
            // 'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'setting'           => $setting,
            'idd' => $idd, 
            'idioma_cat_edit_movie'       => $idioma_cat_edit_movie,   
            'ml_cat_list_book' => $ml_cat_list_book, 
            'traduccionsweet' =>  $traduccionsweet,
            // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'    => Generate_film::pluck('genre_film', 'id')
             // replicar esto FIN 
        ]); 
    }

    public function indexsolo(Request $request, $idd, $tipo)
    {         
    //   dd($tipo);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma_cat_edit_movie = ml_cat_edit_movie::where('many_lenguages_id',$session)->first();
        
         // de esta forma cargo el idioma. en la variable esta el unico registro
         $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
         $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
         //cargo el idioma
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        // $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        // $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        

        if($tipo != 'n'){ // cuando es n es porque se quiere editar pero ya se definio el tipo de doc

            $edicion_doc = Document::where('id', $idd)->first();  

            if($edicion_doc->document_types_id != $tipo){

                if($tipo == 2){ //si es cine
                    $new_movie = new Movies();
                    $new_movie->documents_id = $edicion_doc->id;
                    $new_movie->generate_films_id = 100;     
                }

                if($edicion_doc->document_types_id != 100){ // si es distinto de 100 tiene q borrar el q corresponda q tenia
                    
                        if($edicion_doc->document_types_id == 1){ //eliminacion musica
                            $edicion_music = Music::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_music->destroy();
                        }
                        if($edicion_doc->document_types_id == 3){ //eliminacion libros
                            $edicion_book = Book::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_book->destroy();
                        }
                        if($edicion_doc->document_types_id == 4){ //eliminacion multimedia
                            $edicion_multimedia = Multimedia::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_multimedia->destroy();    
                        }
                        if($edicion_doc->document_types_id == 5){ //eliminacion fotografia
                            $edicion_fotografia = Photography::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_fotografia->destroy();        
                        }
                }
                // else{ 
                    // aqui hay que levantar los datos q quedaron pendientes en notas por el hecho de q apuntan a ser de uan tabla la cual se define cuando se elige que subtipo es.
                    $datos_pendientes = $edicion_doc->temprebecca;

                    $autor_del_com = null;
                    if (Str::contains($datos_pendientes,' / ')){
                        $autor_del_com = str_after($datos_pendientes, ' / ');
                        $arreglo_autor_salto_linea = explode("\n", $autor_del_com);
                        $autores_linea_completa = reset($arreglo_autor_salto_linea);
                        $datos_pendientes = str_replace($autores_linea_completa,'', $datos_pendientes);
                        $datos_pendientes = str_replace(' / ','', $datos_pendientes);
                        $datos_pendientes = str_replace(' ; ', '', $datos_pendientes);
                        // dd("yyyy: ".$autores_linea_completa);
                        // a "Y" no se le hace un remplace xq si o si tiene q ir entre espacios, sino 
                        //se toma como palabra comun de otra palabra.
                        $autores_linea_completa = str_replace(',',' , ', $autores_linea_completa);
                        $autores_linea_completa = str_replace(';',' ; ', $autores_linea_completa);
                        // dd("qqqqq: ".$autores_linea_completa);                                   
                        $autores_linea_completa = preg_split('/ (,|;|y) /', $autores_linea_completa);
                        // LISTOOOOO POSTAAA
                        // dd($autores_linea_completa);
                    }
                    // lo que quede lo guardo en notes. si es edicion pisa lo q estaba anterior si estaba con otro documento
                    $edicion_doc->note = trim($datos_pendientes);

                // }

                $edicion_doc->document_types_id = $tipo;
                $edicion_doc->save();
                $new_movie->save();

                if(($autor_del_com != null) && (count($autores_linea_completa) > 0) ){
                    // dd($autores_linea_completa);
                    $new_movie->syncActors($autores_linea_completa);
                }
            }
                
        }
        
        // $this->authorize('view', new Movies); 
        // dd($idd);
        return view('admin.movies.index', [
            'idioma'            => $idioma,
            'idioma_document'   => $idioma_document,
            'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'setting'           => $setting,
            'idd'           => $idd,
            'idioma_cat_edit_movie'       => $idioma_cat_edit_movie,
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet,
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'    => Generate_film::pluck('genre_film', 'id')
             // replicar esto FIN 
        ]); 
    }

    public function obtener(Request $request, $id)
    {
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        // dd($id);
        // if($id == 1){
        // $respuesta = ml_abm_book_publ_period::where('many_lenguages_id',$session)->first();
        $respuesta = ml_cat_edit_movie::where('many_lenguages_id',$session)->first();    
        // }
        // if($id == 2){
        // // $respuesta = ml_abm_book_otros::where('many_lenguages_id',$session)->first();
        // $respuesta = ml_cat_edit_book::where('many_lenguages_id',$session)->first();    
        // }
        // if($id == 3){
        // // $respuesta = ml_abm_book_lit::where('many_lenguages_id',$session)->first();
        // $respuesta = ml_cat_edit_book::where('many_lenguages_id',$session)->first();    
        // }

        // // if($id == 4){
        // // // $respuesta = ml_abm_doc::where('many_lenguages_id',$session)->first();
        // // $respuesta = ml_cat_edit_book::where('many_lenguages_id',$session)->first();    
        // // // dd($respuesta);
        // // }

        // if($id == 4){
        // // $respuesta = ml_abm_doc::where('many_lenguages_id',$session)->first();
        // // dd($respuesta);
        // $respuesta = ml_cat_edit_book::where('many_lenguages_id',$session)->first();    
        // }

        // if($id == 5){
        //     $respuesta = ml_cat_edit_book::where('many_lenguages_id',$session)->first();

        // }


     
        if($request->ajax())
        {
            // return response()->json(
            //     $partner->toArray(),
            //     $count->toArray()
            // );
 
            // return $respuesta->toJson();
            
            // if($id == 5){
            //  return response()->json(array('respuesta_doc'=>$respuesta_doc,'respuesta_book'=>$respuesta_book));

            // }else{
                return $respuesta->toJson();
            // }
            // return response()->json(array('partner'=>$partner,'count'=>$count,'limit'=>$maximo_dias_parce));

            // return $count->toJson();
          
        }  
      
        return response()->json(['message' => 'recibimos el sdfsdfrequest pero no es ajax']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         // $request->session()->put('idiomas', 2);
         if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $movie = new Movies(); 
        $document = new Document();      
      
        // $this->authorize('create', $movie);    
        
        $idioma_cat_edit_movie = ml_cat_edit_movie::where('many_lenguages_id',$session)->first();

        $setting = Setting::where('id', 1)->first();

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
            'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'),  
            'movie'             => $movie,
            'document'          => $document,
            'idioma_cat_edit_movie' => $idioma_cat_edit_movie,
             'setting' =>  $setting
           
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
                    $file_name_original = $file->getClientOriginalName();
                    $name_file_edit = str_replace(' ','-', $file_name_original);
                    $name = time().$name_file_edit;
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

                $session = session('idiomas');
                $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
                return response()->json(['data' => $document->id, 'bandera' => 1, 'mensaje_exito' => $traduccionsweet->mensaje_exito, 'alta_documento' => $traduccionsweet->alta_documento]);

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
            'setting' => $setting,
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
       
        $idioma_cat_edit_movie = ml_cat_edit_movie::where('many_lenguages_id',$session)->first();
        $setting = Setting::where('id', 1)->first();

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
                    'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'),   
                    'movie'             => $movie,
                    'document'          => $document,
                    'idioma_cat_edit_movie' => $idioma_cat_edit_movie,
                    'setting' => $setting
                
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
                
                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $file_name_original = $file->getClientOriginalName();
                    $name_file_edit = str_replace(' ','-', $file_name_original);
                    $name = time().$name_file_edit;
                    $file->move(public_path().'/images/', $name);    
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
                // dd($request->get('actors'));
                $movie->syncActors($request->get('actors'));               
    
                DB::commit();

                $session = session('idiomas');
                $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
                return response()->json(['data' => $document->id, 'bandera' => 0, 'mensaje_exito' => $traduccionsweet->mensaje_exito, 'actualizacion_documento' => $traduccionsweet->actualizacion_documento]);

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
    $session = session('idiomas');
    $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
    return response()->json(['mensaje_exito' => $traduccionsweet->mensaje_exito, 'resp_desidherata_documento' => $traduccionsweet->resp_desidherata_documento]);
    
    }
    

    public function baja($id)
    {
        $document = Document::findOrFail($id);

        $session = session('idiomas');
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
        // S : obviamnete se importo desde rebecca y aun no se aprobo, asi q si es rechazado se elimina
        // N : en algun momento fue aprobado entonces cuando se de de baja no lo va a eliminar.
        if($document->status_rebecca == 'S'){    
            $delete_docu = Document::where('id', '=', $document->id)->delete();
            $delete_music = Movies::where('documents_id', '=', $document->id)->delete();                   
            $baja_rechazar = $traduccionsweet->resp_rechazar_documento;
        }else{

        
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
    $baja_rechazar = $traduccionsweet->resp_baja_documento;
    }
    return response()->json(['mensaje_exito' => $traduccionsweet->mensaje_exito, 'baja_rechazar' => $baja_rechazar]);
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
        $document->status_rebecca = 'N';
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
        $session = session('idiomas');
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        return response()->json(['mensaje_exito' => $traduccionsweet->mensaje_exito, 'resp_reactivar_documento' => $traduccionsweet->resp_reactivar_documento, 'resp_aceptar_documento' => $traduccionsweet->resp_aceptar_documento]);

    }
    

    public function dataTable(Request $request)
    {   
        $idd_bis = 'none';
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
        // dd($request->get('indexsolo')); 
        if($request->get('indexsolo') != ''){
            $indexsolo_mostrar = true;
            $idd_bis = $request->get('indexsolo');  
        }else{
            $indexsolo_mostrar = false;      
        }
        // dd($idd_bis);

        if(Auth::user()->getRoleNames() == 'Partner'){
        $movie = Movies::with('document.creator','generate_movie','generate_format', 'document.lenguage', 'document.status_document') 
        ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request, $indexsolo_mostrar)
            {
                $q->where('status_documents_id', '=', 1);            
                
                if($subjects_mostrar){
                    $q->where('generate_subjects_id', '=', $request->get('subjects'));   
                }
                if($adaptations_mostrar){
                    $q->where('adequacies_id', '=', $request->get('adaptations'));   
                }
                if($indexsolo_mostrar){
                    $q->where('id', '=', $request->get('indexsolo'));  
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
        ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request, $indexsolo_mostrar)
            {
                
                if($subjects_mostrar){
                    $q->where('generate_subjects_id', '=', $request->get('subjects'));   
                }
                if($adaptations_mostrar){
                    $q->where('adequacies_id', '=', $request->get('adaptations'));   
                }
                if($indexsolo_mostrar){
                    $q->where('id', '=', $request->get('indexsolo'));   
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
                    '<i class="fa fa-user"></i>'.' '.$movie->document->creator['creator_name']."<br>";         
            }) 
            ->addColumn('generate_films_id', function ($movie){
                if($movie->generate_movie['genre_film'] != null){
                    return $movie->generate_movie['genre_film'];
                }else{
                    return 'Sin Genero';
                }             
            })
            ->addColumn('photo', function ($movie){  
                if($movie->document['photo'] == null){
                    $url=asset("./images/doc-default.jpg");
                }else{
                    if(file_exists("./images/". $movie->document['photo'])){
                        $url=asset("./images/". $movie->document['photo']);
                    }else{
                        $url=asset("./images/doc-default.jpg");  
                    }
                     
                }              
    
                return '<img src='.$url.' style="width: 90px; margin-left: -25px; border: 3px solid #d2d6de; padding: 3px;" class="img-rounded" />';
                
            }) 
            ->addColumn('generate_formats_id', function ($movie){
                if($movie->generate_format['genre_format'] != null){
                    return $movie->generate_format['genre_format'];
                }else{
                    return 'Sin Formato';
                }              
            })  
            ->addColumn('lenguages_id', function ($movie){
                if($movie->document->lenguage['leguage_description'] != null){
                return'<i class="fa  fa-globe"></i>'.' '.$movie->document->lenguage['leguage_description'];         
                }else{
                    return 'Sin Lenguaje';
                }
                })
            ->addColumn('status', function ($movie){

                return'<span class="'.$movie->document->status_document['color'].'">'.' '.$movie->document->status_document['name_status'].'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })            
            ->addColumn('created_at', function ($movie){
                return $movie->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($movie) use($idd_bis) {
                // 'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',  
            //    dd($idd_bis);
                return view('admin.movies.partials._action', [
                    'movie'             => $movie,
                    'url_show'          => route('admin.movies.show', $movie->id),                        
                    'url_edit'          => route('admin.movies.edit', $movie->id),  
                    'url_copy'          => route('movies.copy', $movie->document->id),                              
                    'url_desidherata'   => route('movies.desidherata', $movie->document->id),
                    'url_baja'          => route('movies.baja', $movie->document->id),
                    'url_reactivar'     => route('movies.reactivar', $movie->document->id),
                    'url_print'         => route('cine.pdf', $movie->id),
                    'idd' => $idd_bis  
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc','documents_id', 'generate_films_id', 'photo', 'generate_formats_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            // ->rawColumns(['id_doc','documents_id', 'generate_films_id']) 
            ->make(true);  
    }

}
