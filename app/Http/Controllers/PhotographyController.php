<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Creator;
use App\planes;
use App\ml_cat_sweetalert;
use App\ml_cat_edit_fotografia;
use App\ml_cat_list_book;
use App\Photography;
use App\Document_subtype;
use App\Adequacy;
use App\Adaptations;
use App\Book_movement;
use App\Lenguage;
use App\Document;
use App\Generate_subjects;
use App\Generate_reference;
use App\Generate_format;
use App\StatusDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SavePhotographyRequest;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\User;
use App\ml_show_fotografia;
use App\Copy;
use Illuminate\Support\Facades\Auth;

class PhotographyController extends Controller
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
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        
        $c_documentos     = Document::selectRaw('count(*) documents')->first();       
        $c_socios         = User::selectRaw('count(*) users')->first();    
        $advertencia = "";
        $plan_actual = planes::where('id', $setting->id_plan)->first();
        if($plan_actual == null){
            $plan_actual = planes::where('id', 1)->first();
        }
        $plan = $plan_actual->nombre_plan;
        if($plan_actual->id == 999){ // 999 es el plan premium
        if( ($c_documentos >= $plan_actual->cantidad_documentos ) || ($c_socios >= $plan_actual->cantidad_socios ) ){
            $advertencia = "Por favor actualice a una versión superior, esta llegando al limite de su capacidad";
        
        }
        }
        // $this->authorize('view', new Photography); 
        $idioma_cat_edit_fotografia = ml_cat_edit_fotografia::where('many_lenguages_id',$session)->first();
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
        return view('admin.photographs.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'idd'       => $idd,
            'idioma_cat_edit_fotografia' => $idioma_cat_edit_fotografia, 
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet,
            
            // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_format::pluck('genre_format', 'id')
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
        $respuesta = ml_cat_edit_fotografia::where('many_lenguages_id',$session)->first();    
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

        $idioma_cat_edit_fotografia = ml_cat_edit_fotografia::where('many_lenguages_id',$session)->first();
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
        //cargo el idioma
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        // $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        // $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.

        $c_documentos     = Document::selectRaw('count(*) documents')->first();       
        $c_socios         = User::selectRaw('count(*) users')->first();    
        $advertencia = "";
        $plan_actual = planes::where('id', $setting->id_plan)->first();
        if($plan_actual == null){
            $plan_actual = planes::where('id', 1)->first();
        }
        $plan = $plan_actual->nombre_plan;
        if($plan_actual->id == 999){ // 999 es el plan premium
        if( ($c_documentos >= $plan_actual->cantidad_documentos ) || ($c_socios >= $plan_actual->cantidad_socios ) ){
            $advertencia = "Por favor actualice a una versión superior, esta llegando al limite de su capacidad";
        
        }
        }

        if($tipo != 'n'){ // cuando es n es porque se quiere editar pero ya se definio el tipo de doc

            $edicion_doc = Document::where('id', $idd)->first();  

            if($edicion_doc->document_types_id != $tipo){

                if($tipo == 5){ //si es cine
                    $new_photo = new Photography();
                    $new_photo->documents_id = $edicion_doc->id;
                    $new_photo->generate_formats_id = 100;
                    $new_photo->second_author_id = 100;
                    $new_photo->third_author_id = 100;     
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
                        if($edicion_doc->document_types_id == 3){ //eliminacion libros
                            $edicion_book = Book::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_book->destroy();
                        }
                        if($edicion_doc->document_types_id == 4){ //eliminacion multimedia
                            $edicion_multimedia = Multimedia::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_multimedia->destroy();    
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
                $new_photo->save();

            }
                
        }
        
        // $this->authorize('view', new Movies); 
        // dd($idd);
        return view('admin.photographs.index', [
            'idioma'            => $idioma,
            'idioma_document'   => $idioma_document,
            'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'           => $setting,
            'idd'           => $idd,
            'idioma_cat_edit_fotografia' => $idioma_cat_edit_fotografia,
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet,
                
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_format::pluck('genre_format', 'id')
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
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $photograph = new Photography();
        $document = new Document();   
        
        $idioma_cat_edit_fotografia = ml_cat_edit_fotografia::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        // $this->authorize('create', $photograph); 
                              
        return view('admin.photographs.partials.form', [
          
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),   
            'publications'  => Document::pluck('published', 'published'),        
            'references'    => Generate_reference::all(),   
            'formats'       => Generate_format::pluck('genre_format', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 5)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),           
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'), 
            'photograph'    => $photograph,
            'document'      => $document,
            'setting' => $setting,
            'idioma_cat_edit_fotografia' => $idioma_cat_edit_fotografia
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePhotographyRequest $request)
    {
        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                // $this->authorize('create', new Photography);
                // Creamos el documento            
                $document = new Document;
                $document->document_types_id    = 5; // 3 tipo de documento: cine.
                $document->document_subtypes_id = $request->get('document_subtypes_id');                 
                $document->title                = $request->get('title');
            
                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id    = $request->get('creators_id');    
 
                 }else{
                     
                    $creator = new Creator;
                    $creator->creator_name      = $request->get('creators_id');
                    $creator->document_types_id = 1;
                    $creator->save();
                    $document->creators_id      = $creator->id;
                 }

                $document->original_title   = $request->get('original_title'); 
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));                                
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->generate_subjects_id     = $request->get('generate_subjects_id');  
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');            
                $document->assessment       = $request->get('assessment'); 
                
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
                $document->lenguages_id     = $request->get('lenguages_id');           
                // $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis'); 
                
                
                if ($request->hasFile('photo')) {               
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

                // insertamos en la tabla photograph
                
                $photograph = new Photography;
                $photograph->subtitle = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $photograph->second_author_id  = $request->get('second_author_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name         = $request->get('second_author_id');
                    $creator->document_types_id    = 2;
                    $creator->save();
                    $photograph->second_author_id  = $creator->id;
                }
                
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $photograph->third_author_id    = $request->get('third_author_id');    
 
                }else{
                    if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){         
                    $creator = new Creator;
                    $creator->creator_name = $request->get('third_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $photograph->third_author_id = $creator->id;
                    }
                }
                $photograph->producer       = $request->get('producer');
                $photograph->edition        = $request->get('edition');
                $photograph->generate_formats_id = $request->get('generate_formats_id');              
                $photograph->documents_id  = $document->id;//guardamos el id del documento                
                $photograph->save();
                
               
                
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
     * @param  \App\photography  $photography
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
        $idioma_fotografia = ml_show_fotografia::where('many_lenguages_id',$session)->first();
        
        $photograph = Photography::with('document.creator', 'generate_format', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
        $setting    = Setting::where('id', 1)->first();
        $id_docu = $photograph->documents_id;

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

        // $this->authorize('view', $photograph);

        return view('admin.photographs.show', compact('photograph'), [
            'idioma_doc'        => $idioma_doc,
            'idioma_fotografia' => $idioma_fotografia,
            'disabled'          => $disabled,
            'setting' => $setting,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]);

        // return view('admin.photographs.show', compact('photograph'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\photography  $photography
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

        $photograph = Photography::with('document')->findOrFail($id);   
        $document = Document::findOrFail($photograph->documents_id);    
             
        $idioma_cat_edit_fotografia = ml_cat_edit_fotografia::where('many_lenguages_id',$session)->first();

        $setting    = Setting::where('id', 1)->first();
        // $this->authorize('update', $photograph);
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

        //     return view('admin.photographs.partials.form_no_disp'); 

        // }else{ 
                return view('admin.photographs.partials.form', [            
                    'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
                    'publications'  => Document::pluck('published', 'published'),          
                    'references'    => Generate_reference::all(),  
                    'formats'       => Generate_format::pluck('genre_format', 'id'),
                    'subtypes'      => Document_subtype::where('document_types_id', 5)->get()->pluck('subtype_name', 'id'),
                    'editorials'    => Document::pluck('made_by', 'made_by'),
                    'authors'       => Creator::pluck('creator_name', 'id'),
                    'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),          
                    'volumes'       => Document::pluck('volume', 'volume'),
                    'languages'     => Lenguage::pluck('leguage_description', 'id'),
                    'status_documents' => StatusDocument::where('view_public', 'S')->pluck('name_status', 'id'), 
                    'photograph'    => $photograph,
                    'document'      => $document,
                    'setting' => $setting,
                    'idioma_cat_edit_fotografia' => $idioma_cat_edit_fotografia
                ]);
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function update(SavePhotographyRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                $photograph = Photography::findOrFail($id);
                $document   = Document::findOrFail($photograph->documents_id);
                
                // $this->authorize('update', $photograph);

                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
                $document->title                = $request->get('title');
                
                // $document->creators_id = $request->get('creators_id');

                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id = $request->get('creators_id');    

                }else{
                    
                    $creator = new Creator;
                    $creator->creator_name         = $request->get('creators_id');
                    $creator->document_types_id    = 1;
                    $creator->save();
                    $document->creators_id         = $creator->id;
                }

                $document->original_title       = $request->get('original_title'); 
                $document->acquired             = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));               
                $document->adequacies_id        = $request->get('adequacies_id');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
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
                $document->volume               = $request->get('volume'); 
                $document->quantity_generic     = $request->get('quantity_generic'); 
                $document->collection           = $request->get('collection'); 
                $document->location             = $request->get('location');
                $document->observation          = $request->get('observation');
                $document->note                 = $request->get('note');
                $document->lenguages_id         = $request->get('lenguages_id');          
                // $document->photo                = $request->get('photo');
                $document->synopsis             = $request->get('synopsis');


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

                 // insertamos en la tabla photograph
            
                $photograph->subtitle = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $photograph->second_author_id  = $request->get('second_author_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name         = $request->get('second_author_id');
                    $creator->document_types_id    = 2;
                    $creator->save();
                    $photograph->second_author_id  = $creator->id;
                }
                // $photograph->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $photograph->third_author_id = $request->get('third_author_id');    

                }else{
                    
                    if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){
    
                        $creator = new Creator;
                        $creator->creator_name         = $request->get('third_author_id');
                        $creator->document_types_id    = 2;
                        $creator->save();
                        $photograph->third_author_id   = $creator->id;
                    }
                }
                $photograph->producer              = $request->get('producer');
                $photograph->edition               = $request->get('edition');
                $photograph->generate_formats_id   = $request->get('generate_formats_id');               
                $photograph->documents_id          = $document->id;//guardamos el id del documento
                $photograph->save();                
    
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
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function destroy(photography $photography)
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
        $idioma_fotografia = ml_show_fotografia::where('many_lenguages_id',$session)->first();
        $photograph = Photography::with('document.creator', 'generate_format', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
        $setting = Setting::where('id', 1)->first();
        $id_docu = $photograph->documents_id;

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
  
        $pdf = PDF::loadView('admin.photographs.exportPDF', compact('photograph'),[
            'idioma_doc'                => $idioma_doc,
            'idioma_fotografia'         => $idioma_fotografia,
            'disabled'                  => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible, 
            'setting'                   => $setting
        ]);   
    
       
        return $pdf->download('fotografia.pdf'); 
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
            $delete_photo = Photography::where('documents_id', '=', $document->id)->delete();                   
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

        $photograph = Photography::with('document.creator', 'document.document_subtype', 'document', 'document.lenguage','generate_format','document.status_document') 
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
                    $q->where('generate_formats_id', '=', $request->get('genders'));   
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
            $photograph = Photography::with('document.creator', 'document.document_subtype', 'document', 'document.lenguage','generate_format','document.status_document') 
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
                    $q->where('generate_formats_id', '=', $request->get('genders'));   
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
       
        return dataTables::of($photograph)
            ->addColumn('id_doc', function ($photograph){
                return $photograph->document['id']."<br>";            
            }) 
            ->addColumn('documents_id', function ($photograph){
                return
                    '<i class="fa fa-music"></i>'.' '.$photograph->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$photograph->document->creator['creator_name']."<br>";         
            })
            ->addColumn('document_subtypes_id', function ($photograph){

                return  $photograph->document->document_subtype['subtype_name'];              
            })      
            ->addColumn('photo', function ($photograph){  
                if($photograph->document['photo'] == null){
                    $url=asset("./images/doc-default.jpg");
                }else{
                    if(file_exists("./images/". $photograph->document['photo'])){
                        $url=asset("./images/". $photograph->document['photo']);
                    }else{
                        $url=asset("./images/doc-default.jpg");  
                    }
                     
                }              
    
                return '<img src='.$url.' style="width: 90px; margin-left: -25px; border: 3px solid #d2d6de; padding: 3px;" class="img-rounded" />';
                
            })      
            ->addColumn('generate_formats_id', function ($photograph){
                if($photograph->generate_format['genre_format'] == null){
                    return 'Sin Formato';
                }else{
                return  $photograph->generate_format['genre_format'];              
                }
            })              
            ->addColumn('status', function ($photograph){

                return'<span class="'.$photograph->document->status_document['color'].'">'.' '.$photograph->document->status_document['name_status'].'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })   
            ->addColumn('created_at', function ($photograph){
                return $photograph->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($photograph) use($idd_bis) {
                return view('admin.photographs.partials._action', [
                    'photograph'        => $photograph,
                    'url_show'          => route('admin.photographs.show', $photograph->id),                        
                    'url_edit'          => route('admin.photographs.edit', $photograph->id),                              
                    'url_copy'          => route('photographs.copy', $photograph->document->id),                              
                    'url_desidherata'   => route('photographs.desidherata', $photograph->document->id),
                    'url_baja'          => route('photographs.baja', $photograph->document->id),
                    'url_reactivar'     => route('photographs.reactivar', $photograph->document->id),
                    'url_print'         => route('fotografia.pdf', $photograph->id),
                    'idd' => $idd_bis  
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'generate_formats_id', 'photo', 'document_subtypes_id', 'documents_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
