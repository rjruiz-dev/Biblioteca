<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Music;
use App\ml_cat_edit_music;
use App\Movies;
use App\Lenguage;
use App\Ml_movie;
use App\Creator;
use App\Culture;
use App\Popular;
use App\Adequacy;
use App\Document;
use App\Book_movement;
use App\Document_type;
use App\Ml_dashboard;
use App\Ml_document;
use App\Generate_subjects;
use App\Generate_reference;
use App\Document_subtype;
use App\Generate_format;
use App\Generate_music;
use App\StatusDocument;
use App\ManyLenguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SaveMusicalRequest;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_music;
use App\Copy;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
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

        $idioma_cat_edit_music = ml_cat_edit_music::where('many_lenguages_id',$session)->first();
        
        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();

        // $this->authorize('view', new Music);

        return view('admin.music.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'idd' => $idd,
            'idioma_cat_edit_music'       => $idioma_cat_edit_music,
  
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'       => Generate_music::pluck('genre_music', 'id')
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

        $idioma_cat_edit_music = ml_cat_edit_music::where('many_lenguages_id',$session)->first();
        //cargo el idioma
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas            = ManyLenguages::all();

        if($tipo != 'n'){ // cuando es n es porque se quiere editar pero ya se definio el tipo de doc

            $edicion_doc = Document::where('id', $idd)->first();  

            if($edicion_doc->document_types_id != $tipo){

                if($tipo == 1){ //si es cine
                    $new_music = new Music();
                    $new_music->documents_id = $edicion_doc->id;
                    $new_music->generate_musics_id = 100;
                    $new_music->generate_formats_id = 100;     
                }

                if($edicion_doc->document_types_id != 100){ // si es distinto de 100 tiene q borrar el q corresponda q tenia
                    
                    if($edicion_doc->document_types_id == 2){ //eliminacion libros
                        $edicion_movie = Movies::where('documents_id', '=', $edicion_doc->id)->delete();
                        // $edicion_book->destroy();
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
                    // lo que quede lo guardo en notes. si es edicion pisa lo q estaba anterior si estaba con otro documento
                    $edicion_doc->note = trim($datos_pendientes);

                // }

                $edicion_doc->document_types_id = $tipo;
                $edicion_doc->save();
                $new_music->save();

                
            }
                
        }
        
        // $this->authorize('view', new Movies); 
        // dd($idd);
        return view('admin.music.index', [
            'idioma'            => $idioma,
            'idioma_document'   => $idioma_document,
            'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'setting'           => $setting,
            'idd'           => $idd,
            'idioma_cat_edit_music'       => $idioma_cat_edit_music,
  
            
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'       => Generate_music::pluck('genre_music', 'id')
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
        
        $music = new Music();    
        $document = new Document();  

        $idioma_cat_edit_music = ml_cat_edit_music::where('many_lenguages_id',$session)->first();
        
        // $this->authorize('create', $music);     
                              
        return view('admin.music.partials.form', [
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 1)->get()->pluck('subtype_name', 'id'),
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id'),            
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'references'    => Generate_reference::all(),            
            'genders'       => Generate_music::pluck('genre_music', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'sounds'        => Music::pluck('sound', 'sound'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'formats'       => Generate_format::pluck('genre_format', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'),
            'music'         => $music,
            'document'      => $document,
            'idioma_cat_edit_music'       => $idioma_cat_edit_music,
  
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMusicalRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // $this->authorize('create', new Music);
                              
                // Creamos el documento            
                $document = new Document;              
                $document->document_types_id        = 1; // 1 tipo de documento: musica.
                $document->document_subtypes_id     = $request->get('document_subtypes_id'); 
                $document->title                    = $request->get('title');                
                $document->acquired                 = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));              
                $document->adequacies_id            = $request->get('adequacies_id');
                $document->let_author               = $request->get('let_author');
                $document->let_title                = $request->get('let_title');
                $document->generate_subjects_id     = $request->get('generate_subjects_id');  
                $document->assessment               = $request->get('assessment'); 
                
                // dd($request->get('desidherata'));
                if($request->get('desidherata') == null){
                    $document->desidherata = 0;
                    $document->status_documents_id = 1;

                }else{
                    $document->desidherata = 1;
                    $document->status_documents_id = 3;
                }
                
                $document->published                = $request->get('published');
                $document->made_by                  = $request->get('made_by');
                $document->year                     = Carbon::createFromFormat('Y', $request->get('year'));
                $document->volume                   = $request->get('volume');
                $document->quantity_generic         = $request->get('quantity_generic');
                $document->location                 = $request->get('location');
                $document->observation              = $request->get('observation');
                $document->note                     = $request->get('note');
                $document->lenguages_id             = $request->get('lenguages_id');          
                // $document->photo                    = $request->get('photo');
                $document->collection               = $request->get('collection'); 
                $document->synopsis                 = $request->synopsis;

                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id = $request->get('creators_id');    
 
                }else{
                    if($request->get('creators_id') != null){
                    $creator = new Creator;
                    $creator->creator_name         = $request->get('creators_id');
                    $creator->document_types_id    = 1;
                    $creator->save();
                    $document->creators_id         = $creator->id;
                 }
                }


                if ($request->hasFile('photo')) {               

                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{                
                    $name = 'doc-default.jpg';
                }  

                $document->photo            = $name;
                $document->save();
                $document->syncReferences($request->get('references'));

                $music = new Music;   
                $music->producer                = $request->get('producer');
                $music->generate_musics_id      = $request->get('generate_musics_id');
                $music->sound                   = $request->get('sound');
                $music->generate_formats_id     = $request->get('generate_formats_id');             
                $music->documents_id            = $document->id;//guardamos el id del documento                
                $music->save();
                

                // evaluamos si se eligio culta o popular y en base a eso insertamos en la 
                //respectiva tabla

                if($request->get('document_subtypes_id') == 2){ // si es popular
                    $popular = new Popular;   
                    $popular->subtitle      = $request->get('subtitle');
                    $popular->other_artists = $request->get('other_artists');
                    $popular->music_populars      = $request->get('music_populars');
                    $popular->original_title      = $request->get('original_title');
                    $popular->music_id      = $music->id; //guardamos el id del libro
                    $popular->save();

                }else{         
                    $culture = new Culture;   
                    $culture->album_title   = $request->get('album_title');
                    $culture->soloist       = $request->get('soloist');
                    $culture->orchestra     = $request->get('orchestra');                    
                    $culture->director      = $request->get('director');      
                    $culture->music_id      = $music->id; //guardamos el id del libro
                    $culture->save();
                }
                 
                DB::commit();

                return response()->json(['data' => $document->id, 'bandera' => 1]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }  
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
        $respuesta = ml_cat_edit_music::where('many_lenguages_id',$session)->first();    
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
     * Display the specified resource.
     *
     * @param  \App\Music  $music
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
        $idioma_music = ml_show_music::where('many_lenguages_id',$session)->first();
        // dd($idioma_music);

        $music = Music::with('document.creator', 'generate_music', 'generate_format','culture', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
        $id_docu = $music->documents_id;

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

        // $this->authorize('view', $music);

        return view('admin.music.show', compact('music'), [
            'idioma_doc'    => $idioma_doc,
            'idioma_music'  => $idioma_music,
            'disabled'      => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]);

        // return view('admin.music.show', compact('music'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Music  $music
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
        
        $musics = Music::with('document', 'generate_music')->findOrFail($id);
        $document = Document::findOrFail($musics->documents_id);   
          
        $idioma_cat_edit_music = ml_cat_edit_music::where('many_lenguages_id',$session)->first();
        
        // $this->authorize('update', $music);
        // $id_docum = $document->id;
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

        //     return view('admin.music.partials.form_no_disp'); 

        // }else{
                return view('admin.music.partials.form', [
                    'documents'     => Document_type::pluck( 'document_description', 'id'),
                    'references'    => Generate_reference::all(),            
                    'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
                    'formats'       => Generate_format::pluck('genre_format', 'id'),
                    'subtypes'      => Document_subtype::where('document_types_id', 1)->get()->pluck('subtype_name', 'id'),
                    'authors'       => Creator::pluck('creator_name', 'id'),            
                    'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
                    'editorials'    => Document::pluck('made_by', 'made_by'),
                    'volumes'       => Document::pluck('volume', 'volume'),
                    'genders'       => Generate_music::pluck('genre_music', 'id'),
                    'publications'  => Document::pluck('published', 'published'),
                    'sounds'        => Music::pluck('sound', 'sound'),        
                    'languages'     => Lenguage::pluck('leguage_description', 'id'),
                    'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'),
                    'music'         => $musics,
                    'document'      => $document,
                    'idioma_cat_edit_music'       => $idioma_cat_edit_music,
                ]);
        // } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMusicalRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction(); 

                $music = Music::findOrFail($id);
                $document = Document::findOrFail($music->documents_id);
                
                // $this->authorize('update', $music);             
                // Actualizamos el documento
                $subtypes_id = $document->document_subtypes_id;

                $document->document_subtypes_id     = $request->get('document_subtypes_id'); 
                $document->title                    = $request->get('title');
                $document->acquired                 = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));              
                $document->adequacies_id            = $request->get('adequacies_id');
                $document->let_author               = $request->get('let_author');
                $document->let_title                = $request->get('let_title');
                $document->generate_subjects_id     = $request->get('generate_subjects_id');  
                $document->assessment               = $request->get('assessment'); 
                
                if($request->get('status_documents_id') == 3){
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 1;   
                }else{
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 0; 
                }

                $document->published                = $request->get('published');
                $document->made_by                  = $request->get('made_by');
                $document->year                     = Carbon::createFromFormat('Y', $request->get('year'));
                $document->volume                   = $request->get('volume');
                $document->quantity_generic         = $request->get('quantity_generic');
                $document->location                 = $request->get('location');
                $document->observation              = $request->get('observation');
                $document->note                     = $request->get('note');
                $document->lenguages_id             = $request->get('lenguages_id');            
                // $document->photo                    = $request->get('photo');
                $document->collection               = $request->get('collection'); 
                $document->synopsis                 = $request->get('synopsis');
                
                // $document->creators_id         = $request->get('creators_id');

                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id  = $request->get('creators_id');    

                }else{

                    if($request->get('creators_id') != null){   
                    $creator = new Creator;
                    $creator->creator_name      = $request->get('creators_id');
                    $creator->document_types_id = 1;
                    $creator->save();
                    $document->creators_id      = $creator->id;
                    }
                }


                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                }else{                
                    $name = 'doc-default.jpg';
                }  
                $document->photo = $name;
                $document->save();
                $document->syncReferences($request->get('references'));

                 // actualizamos en la tabla musica  
                $music->producer            = $request->get('producer');
                $music->generate_formats_id = $request->get('generate_formats_id');
                $music->generate_musics_id  = $request->get('generate_musics_id');
                $music->sound               = $request->get('sound');                            
                $music->documents_id        = $document->id;//guardamos el id del documento                
                $music->save();

                // evaluamos si se eligio culta o popular y en base a eso insertamos en la 
                //respectiva tabla

                if($request->get('document_subtypes_id') == 2){ // si es popular 
                    // lo busco x si en algun momento fue popular y sobre escribo esos datos,
                    // si nunca lo fue arroja null y valido eso y creo un registro nuevo.
                    $popular = Popular::where('music_id', $id)->first();
                    if($popular == null){
                        $popular  = new Popular;
                    }
                    
                    $popular->subtitle      = $request->get('subtitle');


                        if( is_numeric($request->get('other_artists'))) 
                        {                
                        $popular->other_artists  = $request->get('other_artists');    

                        }else{

                        if($request->get('other_artists') != null){   
                        $creator = new Creator;
                        $creator->creator_name      = $request->get('other_artists');
                        $creator->document_types_id = 1;
                        $creator->save();
                        $popular->other_artists  = $creator->id;
                        }
                        }

                        $popular->music_populars      = $request->get('music_populars');
                        $popular->original_title      = $request->get('original_title');
                        $popular->music_id      = $music->id; //guardamos el id del libro
                        $popular->save();
                    
                }else{ // si es culta   

                    $culture = Culture::where('music_id', $id)->first();
                    if($culture == null){
                        $culture  = new Culture;
                    }
                        $culture->album_title   = $request->get('album_title');  
                        $culture->soloist       = $request->get('soloist');
                        $culture->orchestra     = $request->get('orchestra');                  
                        $culture->director      = $request->get('director');        
                        $culture->music_id      = $music->id; //guardamos el id del libro
                        $culture->save();
                }
                 
                DB::commit();

                return response()->json(['data' => $document->id, 'bandera' => 0]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        //
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
        $idioma_music = ml_show_music::where('many_lenguages_id',$session)->first();
    
        $music = Music::with('document.creator', 'generate_music', 'generate_format','culture', 'document.adequacy', 'document.lenguage', 'document.subjects')->first();

        $setting = Setting::where('id', 1)->first();
        $id_docu = $music->documents_id;

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
  
        $pdf = PDF::loadView('admin.music.exportPDF', compact('music'),[
            'idioma_doc'                => $idioma_doc,
            'idioma_music'              => $idioma_music, 
            'disabled'                  => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible,
            'setting'                   => $setting
        ]); 
       
        return $pdf->download('musica.pdf');
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

        // S : obviamnete se importo desde rebecca y aun no se aprobo, asi q si es rechazado se elimina
        // N : en algun momento fue aprobado entonces cuando se de de baja no lo va a eliminar.
        if($document->status_rebecca == 'S'){    
            $delete_docu = Document::where('id', '=', $document->id)->delete();
            $delete_music = Music::where('documents_id', '=', $document->id)->delete();                   
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
        $musica = Music::with('document.creator', 'document.document_subtype','document','document.lenguage','generate_music', 'document.status_document') 
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
                    $q->where('generate_musics_id', '=', $request->get('genders'));   
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
            $musica = Music::with('document.creator', 'document.document_subtype','document','document.lenguage','generate_music', 'document.status_document') 
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
                    $q->where('generate_musics_id', '=', $request->get('genders'));   
                } 
            })
            ->whereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })
        ->get();
        }
       
        return dataTables::of($musica)
            ->addColumn('id_doc', function ($musica){
                return $musica->document['id']."<br>";            
            })
            ->addColumn('documents_id', function ($musica){
                return
                    '<i class="fa fa-music"></i>'.' '.$musica->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$musica->document->creator['creator_name']."<br>";         
            })                      
            ->addColumn('document_subtypes_id', function ($musica){

                return  $musica->document->document_subtype['subtype_name'];              
            }) 
            ->addColumn('photo', function ($musica){                
                if($musica->document['photo'] == null){
                    $url=asset("./images/doc-default.jpg");
                }else{
                    if(file_exists("./images/". $musica->document['photo'])){
                        $url=asset("./images/". $musica->document['photo']);
                    }else{
                        $url=asset("./images/doc-default.jpg");  
                    }
                     
                }
                return '<img src='.$url.' border="0" width="80" height="80" class="img-rounded" align="center" />';
               
            })
            ->addColumn('generate_musics_id', function ($musica){
                if($musica->generate_music['genre_music'] == null){
                    return 'Sin Genero';
                }else{
                    return $musica->generate_music['genre_music']; 
                }                 
            })           
            ->addColumn('lenguages_id', function ($musica){
                if($musica->document->lenguage['leguage_description'] == null){
                    return 'Sin Lenguaje';
                }else{
                    return'<i class="fa  fa-globe"></i>'.' '.$musica->document->lenguage['leguage_description'];         
                }
            })
            ->addColumn('status', function ($musica){

                return'<span class="'.$musica->document->status_document['color'].'">'.' '.$musica->document->status_document['name_status'].'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })              
            ->addColumn('created_at', function ($musica){
                return $musica->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($musica) use($idd_bis) {
                return view('admin.music.partials._action', [
                    'musica'            => $musica,
                    'url_show'          => route('admin.music.show', $musica->id),                        
                    'url_edit'          => route('admin.music.edit', $musica->id),                              
                    'url_copy'          => route('music.copy', $musica->document->id),                              
                    'url_desidherata'   => route('music.desidherata', $musica->document->id),
                    'url_baja'          => route('music.baja', $musica->document->id),
                    'url_reactivar'     => route('music.reactivar', $musica->document->id),
                    'url_print'         => route('musica.pdf', $musica->id),
                    'idd' => $idd_bis 
                ]); 
            })           
            ->addIndexColumn()    
            ->rawColumns(['id_doc','registry_number', 'document_subtypes_id', 'photo', 'generate_musics_id', 'documents_id', 'lenguages_id','status','created_at', 'accion']) 
            ->make(true);  
    }
}
