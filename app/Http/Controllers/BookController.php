<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Movies;
use App\ml_cat_edit_book;
use App\ml_cat_list_book;
use App\ml_cat_sweetalert;
use App\Music;
use App\Multimedia;
use App\Book;
use App\Creator;
use App\Adequacy;
use App\Book_movement;
use App\Document;
use App\Lenguage;
use App\Periodicity;
use App\Generate_book;
use App\Document_type;
use App\Document_subtype;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use Illuminate\Http\Request;
use App\Periodical_publication;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SaveBookRequest;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_book;
use App\ml_abm_doc;
use App\ml_abm_book;
use App\ml_abm_book_otros;
use App\ml_abm_book_publ_period;
use App\ml_abm_book_lit;
use App\Ml_movie;
use App\Ml_document;
use App\Copy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request, $id)
    // {        
    //     if ($request->session()->has('idiomas')) {
    //         $existe = 1;
    //     }else{
    //         $request->session()->put('idiomas', 1);
    //         $existe = 0;
    //     }
    //     $session = session('idiomas');

    //     //cargo el idioma
    //     $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
    //     $idiomas    = ManyLenguages::all();
    //     $setting    = Setting::where('id', 1)->first();
    //     // $this->authorize('view', new Book); 

    //     return view('admin.books.index', [
    //         'idioma'    => $idioma,
    //         'idiomas'   => $idiomas,
    //         'setting'   => $setting,
    //         'id'       => $id,
 
    //         // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
    //         'references' => Generate_reference::pluck('reference_description', 'id'),
    //         'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
    //         'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
    //         'genders'       => Generate_book::pluck('genre_book', 'id')
    //         // replicar esto FIN 

    //     ]); 
        
    // }

    public function index(Request $request)
    {   
        
        $idd = 'none'; //con esto indico q no tiene q filtrar por un libto solo     
        
        
        if (!$request->session()->has('idiomas')) { //valida si existe la variable si no existe la crea 
            $request->session()->put('idiomas', 1); // 1 es el idioma español osea el por defecto.
        }
        $session = session('idiomas'); // id referencaindo al idioma.

        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas    = ManyLenguages::all();
        $setting    = Setting::where('id', 1)->first();
        // $this->authorize('view', new Book); 
        
        $idioma_cat_edit_book = ml_cat_edit_book::where('many_lenguages_id',$session)->first();
        
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        

        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
                
        // dd($idioma_cat_edit_book);
        return view('admin.books.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'idd'       => $idd,
            'idioma_cat_edit_book'       => $idioma_cat_edit_book,
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet,
             
            // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id')
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

        $idioma_cat_edit_book = ml_cat_edit_book::where('many_lenguages_id',$session)->first();
        //cargo el idioma
        
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        

        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas            = ManyLenguages::all();

        if($tipo != 'n'){ // cuando es n es porque se quiere editar pero ya se definio el tipo de doc

            $edicion_doc = Document::where('id', $idd)->first();  

            if($edicion_doc->document_types_id != $tipo){

                if($tipo == 3){ //si es cine
                    $new_book = new Book();
                    $new_book->documents_id = $edicion_doc->id;
                    $new_book->generate_books_id = 100;
                    // $new_book->second_author_id = 100;
                    // $new_book->third_author_id = 100;     
                }

                if($edicion_doc->document_types_id != 100){ // si es distinto de 100 tiene q borrar el q corresponda q tenia
                    
                    if($edicion_doc->document_types_id == 1){ //eliminacion musica
                        $edicion_music = Music::where('documents_id', '=', $edicion_doc->id)->delete();
                        // $edicion_music->destroy();
                    }
                    if($edicion_doc->document_types_id == 2){ //eliminacion libros
                        $edicion_movie = Movies::where('documents_id', '=', $edicion_doc->id)->delete();
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
                    // dd($datos_pendientes);
                    //------------------------------------------SIZE-----------------------------------------------------------------------------------------                
                    $size = null;
                    if (Str::contains($datos_pendientes,'Descripción física:')){
                        $size_ant_del_com = str_after($datos_pendientes, 'Descripción física:');
                        $arreglo_size_salto_linea = explode("\n", $size_ant_del_com);
                        $size_sin_del_com = reset($arreglo_size_salto_linea);
                        $size_del_fin = trim(str_after($size_sin_del_com, ' ; '));
                        //en este caso lo evaluo como un delimitador de comienzo pero dice fin xq total ya 
                        //corte el final con el salto de linea q preevi(?) antes-
                        // dd($size_del_fin); 
                        if($size_del_fin != ''){
                            $size = $size_del_fin;
                            $datos_pendientes = str_replace($size, '', $datos_pendientes);
                            $datos_pendientes = str_replace('Descripción física:', '', $datos_pendientes);
                            $datos_pendientes = str_replace(' ; ', '', $datos_pendientes);
                        }
                    }
                    // dd($size);
                    //------------------------------------------ISBN-----------------------------------------------------------------------------------------                
                    $isbn = null;
                    //    if (strpos($documento, 'ISBN:') !== false) {
                        if (Str::contains($datos_pendientes,'ISBN:')){
                                    $isbn_del_com = str_after($datos_pendientes, 'ISBN:');
                                    $arreglo_isbn_salto_linea = explode("\n", $isbn_del_com); 
                        $isbn = reset($arreglo_isbn_salto_linea);
                        $datos_pendientes = str_replace($isbn, '', $datos_pendientes);
                        $datos_pendientes = str_replace('ISBN:', '', $datos_pendientes);
                       }
                        // INSERT IN ISBN
                        //LISTO

                       //------------------------------------------EDICION-----------------------------------------------------------------------------------------                
                    $edition = null;
                    //    if (strpos($documento, 'edition:') !== false) {
                        if (Str::contains($datos_pendientes,'Edición:')){
                                    $edition_del_com = str_after($datos_pendientes, 'Edición:');
                                    $arreglo_edition_salto_linea = explode("\n", $edition_del_com); 
                        $edition = trim(reset($arreglo_edition_salto_linea));
                        $datos_pendientes = str_replace($edition, '', $datos_pendientes);
                        $datos_pendientes = str_replace('Edición:', '', $datos_pendientes);
                       }

                        $autor_del_com = null;
                        $subtitulo = null;
                        if (Str::contains($datos_pendientes,' / ')){
                            $subtitulo = trim(str_before($datos_pendientes, ' / '));
                            // dd("q onda: ".$subtitulo);
                            $datos_pendientes = str_replace($subtitulo,'', $datos_pendientes);

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
                            // ya que tengo la validacion de la / aprovecho y valido aca el subtitulo.  
                        }

                        // dd("aaaaaa: ".count($autores_linea_completa));
                    // dd($autores_linea_completa);
                    if(($autor_del_com != null) && (count($autores_linea_completa) > 0) ){
                        $num_aux = 0;
                        foreach($autores_linea_completa as $autoree){
                            if($num_aux == 0){
                                // $autoree = 'Nicklaus Kautzer';
                                // dd($autoree);                            
                                // $documentos = DB::select('SELECT c. FROM creators c LEFT JOIN documents d ON d.id = c.documents_id');
                                $creadores = Creator::where('creator_name', '=', $autoree)->first();
                                // dd($creadores);
                                if($creadores != null) 
                                {
                                    // dd('entro al iff');
                                    $edicion_doc->creators_id = $creadores->id;  
                                    $edicion_doc->let_author = Str::upper(substr($creadores->creator_name, 0, 3)); 
                                }else{
                                    // dd('entro al else');
                                   
                                    $autoree = str_replace('.','', $autoree);
                                    // dd($autoree);
                                    $creator = new Creator;
                                    $creator->creator_name  = $autoree;
                                    $creator->document_types_id = 3;
                                    $creator->save();
                                    $edicion_doc->creators_id = $creator->id;
                                    $edicion_doc->let_author = Str::upper(substr($creator->creator_name, 0, 3)); 
                                }
                            }
                            if($num_aux == 1){
                                // $autoree = 'Nicklaus Kautzer';
                                // dd($autoree);                            
                                // $documentos = DB::select('SELECT c. FROM creators c LEFT JOIN documents d ON d.id = c.documents_id');
                                $creadores = Creator::where('creator_name', '=', $autoree)->first();
                                // dd($creadores);
                                if($creadores != null) 
                                {
                                    // dd('entro al iff');
                                    $new_book->second_author_id = $creadores->id;  
                                }else{
                                    // dd('entro al else');
                                    $creator = new Creator;
                                    $creator->creator_name  = $autoree;
                                    $creator->document_types_id = 3;
                                    $creator->save();
                                    $new_book->second_author_id = $creator->id;
                                }  
                            }
                            if($num_aux == 2){
                                // $autoree = 'Nicklaus Kautzer';
                                // dd($autoree);                            
                                // $documentos = DB::select('SELECT c. FROM creators c LEFT JOIN documents d ON d.id = c.documents_id');
                                $creadores = Creator::where('creator_name', '=', $autoree)->first();
                                // dd($creadores);
                                if($creadores != null) 
                                {
                                    // dd('entro al iff');
                                    $new_book->third_author_id = $creadores->id;  
                                }else{
                                    // dd('entro al else');
                                    $creator = new Creator;
                                    $creator->creator_name  = $autoree;
                                    $creator->document_types_id = 3;
                                    $creator->save();
                                    $new_book->third_author_id = $creator->id;
                                }  
                            }
                            $num_aux = $num_aux + 1;
                        }
                    }

                    if($subtitulo != null){ //solo para libros  
                        $new_book->subtitle = $subtitulo;    
                    }
                    // dd($size);
                    if($size != null){ //solo para libros
                        // dd("hhh0".$size);
                    //  dd($new_book);   
                    $new_book->size = $size;    
                    }

                    if($edition != null){ //solo para libros
                        $new_book->edition = $edition;
                    }

                    // lo que quede lo guardo en notes. si es edicion pisa lo q estaba anterior si estaba con otro documento
                    $datos_pendientes = str_replace('.', '', $datos_pendientes);
                    $datos_pendientes = str_replace('Sinopsis:', '', $datos_pendientes);
                    $edicion_doc->note = trim($datos_pendientes);

                // }

                $edicion_doc->document_types_id = $tipo;
                $edicion_doc->save();
                $new_book->save();
            }
                
        }
        
        // $this->authorize('view', new Movies); 
        // dd($idd);
        return view('admin.books.index', [ 
            'idioma'            => $idioma,
            'idioma_document'   => $idioma_document,
            'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'setting'           => $setting,
            'idd'           => $idd,
            'idioma_cat_edit_book'       => $idioma_cat_edit_book,
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet, 
            
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id')
             // replicar esto FIN 
        ]); 
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

        $book = new Book();
        $document = new Document(); 
        
        // $this->authorize('create', $book);  
        
        $idioma_abm_doc = ml_abm_doc::where('many_lenguages_id',$session)->first();
        $idioma_abm_book = ml_abm_book::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_otros = ml_abm_book_otros::where('many_lenguages_id',$session)->first();
        // $idioma_abm_book_publ_period = ml_abm_book_publ_period::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_lit = ml_abm_book_lit::where('many_lenguages_id',$session)->first();
                
        $idioma_cat_edit_book = ml_cat_edit_book::where('many_lenguages_id',$session)->first();

        // dd($idioma_abm_doc->valoración);

        return view('admin.books.partials.form', [           
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'    => Generate_reference::all(),
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 3)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id')->toArray(),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'editions'      => Book::pluck('edition', 'edition'),         
            'periodicities' => Periodicity::pluck('periodicity_name', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'),  
            'book'          => $book,
            'document'      => $document,

            'idioma_abm_doc' => $idioma_abm_doc,
            'idioma_abm_book' => $idioma_abm_book,
            'idioma_abm_book' => $idioma_abm_book,
            // 'idioma_abm_book_publ_period' => $idioma_abm_book_publ_period,
            'idioma_abm_book_lit' => $idioma_abm_book_lit,
            'idioma_cat_edit_book' => $idioma_cat_edit_book            
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveBookRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // $this->authorize('create', new Book);
                
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $file_name_original = $file->getClientOriginalName();
                    $name_file_edit = str_replace(' ','-', $file_name_original);
                    $name = time().$name_file_edit;
                    $file->move(public_path().'/images/', $name);   
                }else{                
                    $name = 'doc-default.jpg';
                }  
                // Creamos el documento            
                $document = new Document;   
                $document->document_types_id        = 3; // 1 tipo de documento: musica.
                $document->document_subtypes_id     = $request->get('document_subtypes_id'); 
                $document->title            = $request->get('title');
                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));             
                $document->let_author       = $request->get('let_author');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->let_title        = $request->get('let_title');
                $document->assessment       = $request->get('assessment');  
                $document->photo            = $name;
                // dd($request->get('desidherata'));
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
                $document->volume           = $request->get('volume');
                $document->quantity_generic = $request->get('quantity_generic');
                $document->collection       = $request->get('collection');
                $document->location         = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->synopsis         = $request->input('synopsis');
              
                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id    = $request->get('creators_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name      = $request->get('creators_id');
                    $creator->document_types_id = 3;
                    $creator->save();
                    $document->creators_id = $creator->id;
                }
                
                // $document->photo            = $request->get('photo');
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->lenguages_id     = $request->get('lenguages_id');    
                // $document->generate_references_id     = $request->get('generate_references_id');            
                $document->document_types_id    = 3;
                $document->document_subtypes_id = $request->get('document_subtypes_id');
                $document->save();
                $document->syncReferences($request->get('references'));


                // Creamos el libro           
                $book = new Book;   
                $book->subtitle = $request->get('subtitle');
                
                                
                    if( is_numeric($request->get('second_author_id'))) 
                    {                
                        $book->second_author_id = $request->get('second_author_id');    

                    }else{

                        if( (trim($request->get('second_author_id')) != null)  && (trim($request->get('second_author_id')) != "") ){
                            
                            $creator = new Creator;
                            $creator->creator_name      = $request->get('second_author_id');
                            $creator->document_types_id = 2;
                            $creator->save();
                            $book->second_author_id     = $creator->id;
                        }
                    }
              
                if($request->get('document_subtypes_id') != 4){
                     
                    if( is_numeric($request->get('third_author_id'))) 
                    {                 
                        $book->third_author_id = $request->get('third_author_id');    

                    }else{ 
                        
                        if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){
                            $creator = new Creator;
                            $creator->creator_name      = $request->get('third_author_id');
                            $creator->document_types_id = 2;
                            $creator->save();
                            $book->third_author_id      = $creator->id;
                        }
                    }                    
                }
                
                $book->translator       = $request->get('translator');        
                $book->edition          = $request->get('edition');
                $book->size             = $request->get('size');  
                $book->isbn             = $request->get('isbn');               
                $book->generate_books_id= $request->get('generate_books_id');         
                $book->documents_id     = $document->id;
                $book->save();


                if($request->get('document_subtypes_id') == 4){ // si es PUBL PERIODICA
                    $periodical_publication = new Periodical_publication;   
                    $periodical_publication->volume_number_date      = $request->get('volume_number_date');
                    $periodical_publication->periodicities_id = $request->get('periodicities_id');
                    $periodical_publication->issn      = $request->get('issn');
                    $periodical_publication->books_id      = $book->id; //guardamos el id del libro
                    $periodical_publication->save();

                }

                $session = session('idiomas');
                $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
                
                DB::commit();
                
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
     * @param  \App\book  $book
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
        $idioma_book = ml_show_book::where('many_lenguages_id',$session)->first();
        

        $book = Book::with('document.creator', 'generate_book', 'document.adequacy', 'document.lenguage', 'document.subjects', 'document.document_subtype', 'periodical_publication','periodical_publication.periodicidad','second_author','third_author')->findOrFail($id);
     
        $id_docu = $book->documents_id;

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

        // dd($copies);
        if($copies_disponibles->count() > 0){
            // dd('habilitado');
            $disabled = '';
            $label_copia_no_disponible = '';
        }else{
            $disabled = 'disabled';
            // dd('NO habilitado');
            $label_copia_no_disponible = 'Documento Sin Copias Disponibles';
        }

        // $this->authorize('view', $book);

        return view('admin.books.show', compact('book'), [
            'idioma_doc'    => $idioma_doc,
            'idioma_book'   => $idioma_book,
            'disabled'      => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]); 

        // return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
         // $request->session()->put('idiomas', 2);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');
        
        $book = Book::with('document', 'generate_book', 'periodical_publication.periodicidad')->findOrFail($id);       
        $document = Document::findOrFail($book->documents_id);
        // dd("count let titulo: ".strlen($document->let_title));
        // $this->authorize('update', $book);
        $id_docum = $document->id;

        $idioma_abm_doc = ml_abm_doc::where('many_lenguages_id',$session)->first();
        $idioma_abm_book = ml_abm_book::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_otros = ml_abm_book_otros::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_publ_period = ml_abm_book_publ_period::where('many_lenguages_id',$session)->first();
        $idioma_abm_book_lit = ml_abm_book_lit::where('many_lenguages_id',$session)->first();
        
        $idioma_cat_edit_book = ml_cat_edit_book::where('many_lenguages_id',$session)->first();

        

        //     $verifi_copies = Book_movement::with('movement_type','copy.document.creator','user')
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

        //     return view('admin.books.partials.form_no_disp'); 

        // }else{
        return view('admin.books.partials.form', [          
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'    => Generate_reference::all(),
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 3)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id')->toArray(),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'editions'      => Book::pluck('edition', 'edition'), 
            'periodicities' => Periodicity::pluck('periodicity_name', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'), 
            'book'          => $book,
            'document'      => $document,

            'idioma_abm_doc'    => $idioma_abm_doc,
            'idioma_abm_book'   => $idioma_abm_book,
            'idioma_abm_book'   => $idioma_abm_book,
            'idioma_abm_book_publ_period' => $idioma_abm_book_publ_period,
            'idioma_abm_book_lit' => $idioma_abm_book_lit,
            'idioma_cat_edit_book' => $idioma_cat_edit_book    
          
        ]); 
    // }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(SaveBookRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $book = Book::findOrFail($id);                
                $document = Document::findOrFail($book->documents_id);
                
                // $this->authorize('update', $book); 
                // Actualizamos el documento   
                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id = $request->get('creators_id');    

                }else
                {
                    if($request->get('creators_id') != null){
                    $creator = new Creator;
                    $creator->creator_name  = $request->get('creators_id');
                    $creator->document_types_id = 3;
                    $creator->save();
                    $document->creators_id = $creator->id;
                    }
                }             
                $document->title            = $request->get('title');
                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));                    
                $document->let_author       = $request->get('let_author');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->let_title        = $request->get('let_title');
                $document->assessment       = $request->get('assessment');  
                
                if($request->get('status_documents_id') == 3){
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 1;   
                }else{
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 0; 
                }
                
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::createFromFormat('Y', $request->get('year'));
                $document->volume           = $request->get('volume');
                $document->quantity_generic = $request->get('quantity_generic');
                $document->collection       = $request->get('collection');
                $document->location         = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->synopsis         = $request->input('synopsis');
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->lenguages_id     = $request->get('lenguages_id');    
                $document->document_types_id    = 3;
                $subtypes_id = $document->document_subtypes_id;
                $document->document_subtypes_id = $request->get('document_subtypes_id'); 


                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $file_name_original = $file->getClientOriginalName();
                    $name_file_edit = str_replace(' ','-', $file_name_original);
                    $name = time().$name_file_edit;
                    $file->move(public_path().'/images/', $name);    
                } 
                $document->photo = $name; 
                $document->save();
                $document->syncReferences($request->get('references'));

                // Actualizamos el libro               
                $book->subtitle = $request->get('subtitle');
                
                
                        if( is_numeric($request->get('second_author_id'))) 
                        {                
                            $book->second_author_id = $request->get('second_author_id');    

                        }else{
                            
                                
                            if( (trim($request->get('second_author_id')) != null) && (trim($request->get('second_author_id')) != "") ){
                                $creator = new Creator;
                                $creator->creator_name      = $request->get('second_author_id');
                                $creator->document_types_id = 2;
                                $creator->save();
                                $book->second_author_id     = $creator->id;
                            }
                        }
                
               // $book->third_author    = $request->get('third_author');
                if($request->get('document_subtypes_id') != 4){// si es NO ES PUBL PERIODICA
                    
                    
                        if( is_numeric($request->get('third_author_id'))) 
                        {                
                            $book->third_author_id  = $request->get('third_author_id');    

                        }else{

                            if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){
                                $creator = new Creator;
                                $creator->creator_name = $request->get('third_author_id');
                                $creator->document_types_id = 2;
                                $creator->save();
                                $book->third_author_id = $creator->id;
                            }

                        }
                }
               
                $book->translator       = $request->get('translator');        
                $book->edition          = $request->get('edition');
                $book->size             = $request->get('size');  
                $book->isbn             = $request->get('isbn');               
                $book->generate_books_id= $request->get('generate_books_id'); 
                $book->documents_id     = $document->id;
                $book->save();

                if($request->get('document_subtypes_id') == 4){ // si es PUBL PERIODICA
                    $periodical_publication = Periodical_publication::where('books_id', $id)->first();
                    if($periodical_publication == null){
                        $periodical_publication  = new Periodical_publication;
                    }
                    
                    $periodical_publication->volume_number_date = $request->get('volume_number_date');
                    $periodical_publication->periodicities_id = $request->get('periodicities_id');
                    $periodical_publication->issn      = $request->get('issn');
                    $periodical_publication->books_id  = $book->id; //guardamos el id del libro
                    $periodical_publication->save();

                }
                $session = session('idiomas');
                $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
                // dd("ccc: ".$traduccionsweet->actualizacion_documento); 
                DB::commit();

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
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $book       = Book::findOrFail($id);
    //     $document   = Document::findOrFail($book->documents_id);    
    //     $book->delete(); 
    //     $document->delete();     
    // }

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
        $idioma_book = ml_show_book::where('many_lenguages_id',$session)->first();
        
    
        $book = Book::with('document.creator', 'generate_book', 'document.adequacy', 'document.lenguage', 'document.subjects', 'document.document_subtype','periodical_publication', 'periodical_publication.periodicidad')->findOrFail($id);
        $setting = Setting::where('id', 1)->first();
        $id_docu = $book->documents_id;

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
  
        $pdf = PDF::loadView('admin.books.exportPDF', compact('book'),[
            'idioma_doc'                => $idioma_doc,
            'idioma_book'               => $idioma_book,
            'disabled'                  => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible,
            'setting'                   => $setting
        ]);  
       
        return $pdf->download('libro.pdf');
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
            $delete_book = Book::where('documents_id', '=', $document->id)->delete();                   
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
        return response()->json(['mensaje_exito' => $traduccionsweet->mensaje_exito, 'resp_reactivar_documento' => $traduccionsweet->resp_reactivar_documento, 'resp_aceptar_documento' => $traduccionsweet->resp_aceptar_documento, 'id_doc' => $document->id]);

    }

    public function obtener2(Request $request)
    {

        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');
        
        $idioma_abm_book_publ_period = ml_abm_book_publ_period::where('many_lenguages_id',$session)->first();

        // dd($idioma_abm_book_publ_period);

     
        if($request->ajax())
        {
            // return response()->json(
            //     $partner->toArray(),
            //     $count->toArray()
            // );

            return $idioma_abm_book_publ_period->toJson();
            // return response()->json(array('partner'=>$partner,'count'=>$count,'limit'=>$maximo_dias_parce));

            // return $count->toJson();
          
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    
    }

    public function obtenersweet(Request $request, $id)
    {
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $respuesta = ml_cat_list_book::where('many_lenguages_id',$session)->first();    
       
        if($request->ajax())
        {
                return $respuesta->toJson();  
        }  
        return response()->json(['message' => 'recibimos el sdfsdfrequest pero no es ajax']);
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
        $respuesta = ml_cat_edit_book::where('many_lenguages_id',$session)->first();    
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

            $libros = Book::with('document.creator', 'document.document_subtype', 'document','document.references','document.lenguage','generate_book') 
            ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request, $indexsolo_mostrar)
            {
                $q->where('status_documents_id', '=', 1);
                
                // $q->where('status_documents_id', '<>', 100);
                
                if($subjects_mostrar){
                    $q->where('generate_subjects_id', '=', $request->get('subjects'));   
                }
                if($adaptations_mostrar){
                    $q->where('adequacies_id', '=', $request->get('adaptations'));   
                }
                // if($idd_mostrar){
                //     $q->where('id', '=', $idd);   
                // }
                if($indexsolo_mostrar){
                    $q->where('id', '=', $request->get('indexsolo'));  
                }else{
                    $q->where('status_documents_id', '<>', 100);    
                }
            })
            ->where(function($q) use($genders_mostrar, $request)
            {            
                if($genders_mostrar){
                    $q->where('generate_books_id', '=', $request->get('genders'));   
                } 
            })
   
            ->whereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })
            ->get();
        
        }else{

            $libros = Book::with('document.creator', 'document.document_subtype', 'document.references', 'document', 'document.lenguage','generate_book') 
            ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request, $indexsolo_mostrar)
            {        
                // $q->where('status_documents_id', '<>', 100);

                if($subjects_mostrar){
                    $q->where('generate_subjects_id', '=', $request->get('subjects'));   
                }
                if($adaptations_mostrar){
                    $q->where('adequacies_id', '=', $request->get('adaptations'));   
                } 
                if($indexsolo_mostrar){
                    $q->where('id', '=', $request->get('indexsolo'));   
                }else{
                    $q->where('status_documents_id', '<>', 100);    
                }
            })
            ->where(function($q) use($genders_mostrar, $request)
            {
                if($genders_mostrar){
                    $q->where('generate_books_id', '=', $request->get('genders'));   
                } 
            })
            ->WhereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })       
            ->get(); 

        }

        return dataTables::of($libros)
            ->addColumn('id_doc', function ($libros){
                return $libros->document['id']."<br>";            
            }) 
            ->addColumn('documents_id', function ($libros){
                return
                    '<i class="fa fa-book"></i>'.' '.$libros->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$libros->document->creator['creator_name']."<br>";         
            }) 
            ->addColumn('document_subtypes_id', function ($libros){

                return  $libros->document->document_subtype['subtype_name'];              
            }) 
            ->addColumn('photo', function ($libros){  
                if($libros->document['photo'] == null){
                    $url=asset("./images/doc-default.jpg");
                }else{
                    if(file_exists("./images/". $libros->document['photo'])){
                        $url=asset("./images/". $libros->document['photo']);
                    }else{
                        $url=asset("./images/doc-default.jpg");  
                    }
                     
                }              
    
                return '<img src='.$url.' style="width: 90px; margin-left: -25px; border: 3px solid #d2d6de; padding: 3px;" class="img-rounded" />';
                // return '<img src='.$url.' style="width: 90px; margin-left: -15px;" class="profile-user-img img-responsive img-circle" />';
                
                // return '<img class="profile-user-img img-responsive img-circle" src='.$url.' style="width: 85px; margin-left: -10px;" />';
                
            })
            ->addColumn('generate_books_id', function ($libros){
                if($libros->generate_book['genre_book'] == null){
                    return 'Sin Genero';
                }else{
                    return $libros->generate_book['genre_book'];              
                }
            })            
            ->addColumn('lenguages_id', function ($libros){ 
                if($libros->document->lenguage['leguage_description'] == null){
                    return 'Sin Lenguaje';
                }else{ 
                    return'<i class="fa  fa-globe"></i>'.' '.$libros->document->lenguage['leguage_description'];         
                } 
            }) 
            ->addColumn('status', function ($libros){

                return'<span class="'.$libros->document->status_document['color'].'">'.' '.$libros->document->status_document['name_status'].'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })           
            ->addColumn('created_at', function ($libros){
                return $libros->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($libros) use($idd_bis){
                return view('admin.books.partials._action', [
                    'libros'            => $libros,
                    'url_show'          => route('admin.books.show', $libros->id),                        
                    'url_edit'          => route('admin.books.edit', $libros->id),
                    'url_copy'          => route('books.copy', $libros->document->id),                              
                    'url_desidherata'   => route('books.desidherata', $libros->document->id),
                    'url_baja'          => route('books.baja', $libros->document->id),
                    'url_reactivar'     => route('books.reactivar', $libros->document->id),
                    'url_print'         => route('libro.pdf', $libros->id),
                    'idd' => $idd_bis 
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'documents_id','document_subtypes_id', 'photo', 'registry_number', 'generate_books_id',  'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
