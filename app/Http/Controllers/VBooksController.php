<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Book;
use App\Creator;
use App\ml_cat_list_book;
use App\Adequacy;
use App\planes;
use App\User;
use App\Document;
use App\Lenguage;
use App\Periodicity;
use App\Generate_book;
use App\Document_type;
use App\Document_subtype;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use App\Book_movement;
use Illuminate\Http\Request;
use App\Periodical_publication;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_book;
use Illuminate\Support\Facades\Auth;

class VBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsolo(Request $request, $idf)
    {
    // REQUERIDO MULTI-IDIOMA - INICIO
    if (!$request->session()->has('idiomas')) { // evaluo si existe esa variable de sesion. sino existe
    $request->session()->put('idiomas', 1); // la creo y le seteo por defecto el idioma 1 predeterminado(español).
    }
    $session = session('idiomas'); // asigno la variable de session a otra variable a la cual consulto siempre que necesite el idioma.
    $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
    $setting = Setting::where('id', 1)->first();
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
    // REQUERIDO MULTI-IDIOMA - FIN

        //cargo el idioma
        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_doc     = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_book    = ml_show_book::where('many_lenguages_id',$session)->first();
        $setting        = Setting::where('id', 1)->first();        
        
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        

        return view('web.books.index', [
            'idiomas'     => $idiomas, // REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba).
            'idioma'     => $idioma,
            'idioma_doc' => $idioma_doc,
            'idioma_book'=> $idioma_book,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'    => $setting,
            'idf' => $idf,
            'ml_cat_list_book' => $ml_cat_list_book,
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_book::pluck('genre_book', 'id')
        ]); 
    }


    public function index(Request $request)
    {
        $idf = 'none'; //con esto indico q no tiene q filtrar por un libto solo     
        
        // REQUERIDO MULTI-IDIOMA - INICIO
        if (!$request->session()->has('idiomas')) { // evaluo si existe esa variable de sesion. sino existe
        $request->session()->put('idiomas', 1); // la creo y le seteo por defecto el idioma 1 predeterminado(español).
        }
        $session = session('idiomas'); // asigno la variable de session a otra variable a la cual consulto siempre que necesite el idioma.
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        $setting = Setting::where('id', 1)->first();
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
        // REQUERIDO MULTI-IDIOMA - FIN

        //cargo el idioma
        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_doc     = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_book    = ml_show_book::where('many_lenguages_id',$session)->first();
        $setting        = Setting::where('id', 1)->first();        
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        

        return view('web.books.index', [
            'idiomas'     => $idiomas, // REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba).
            'idioma'     => $idioma,
            'idioma_doc' => $idioma_doc,
            'idioma_book'=> $idioma_book,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'    => $setting,
            'idf' => $idf,   
            'ml_cat_list_book' => $ml_cat_list_book,         
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_book::pluck('genre_book', 'id')
             
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
         // REQUERIDO MULTI-IDIOMA - INICIO
        if (!$request->session()->has('idiomas')) { // evaluo si existe esa variable de sesion. sino existe
            $request->session()->put('idiomas', 1); // la creo y le seteo por defecto el idioma 1 predeterminado(español).
            }
            $session = session('idiomas'); // asigno la variable de session a otra variable a la cual consulto siempre que necesite el idioma.
            $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
            $setting = Setting::where('id', 1)->first();
            
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
            // REQUERIDO MULTI-IDIOMA - FIN

        //cargo el idioma
        $idioma_doc = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_book = ml_show_book::where('many_lenguages_id',$session)->first();
        
        $setting    = Setting::where('id', 1)->first();
        
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

        return view('web.books.show', compact('book'), [
            'idiomas'     => $idiomas, // REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba).
            'idioma_doc'    => $idioma_doc,
            'idioma_book'   => $idioma_book,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'disabled'      => $disabled,
            'setting' => $setting,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]); 

        // $book = Book::with('document.creator', 'generate_book', 'document.adequacy', 'document.lenguage', 'document.subjects', 'document.document_subtype', 'periodical_publication','periodical_publication.periodicidad')->findOrFail($id);
         
        // return view('web.books.show', compact('book'));
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

    // REQUERIDO MULTI-IDIOMAS INICIO
    public function cambiar(Request $request, $id)
    {
        $request->session()->put('idiomas', $id);  // METODO PARA SETEAR EL NUEVO IDIOMA EN LA VARIABLE DE SESSION.
         
    }
    // REQUERIDO MULTI-IDIOMAS FIN
    
    public function dataTable(Request $request)
    {   
        // $libros = Book::with('document.creator', 'document.document_subtype', 'document','document.lenguage','generate_book') 
        // ->whereHas('document', function($q)
        // {
           
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
         // dd($request->get('indexsolo')); 
         if($request->get('indexsolo') != ''){
            $indexsolo_mostrar = true; 
        }else{
            $indexsolo_mostrar = false;      
        }
        
        $libros = Book::with('document.creator', 'document.document_subtype', 'document.references', 'document', 'document.lenguage','generate_book') 
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
                // dd($genders_mostrar);
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
    

        return dataTables::of($libros)
            ->addColumn('id_doc', function ($libros){
                return $libros->document['id']."<br>";            
            }) 
            ->addColumn('documents_id', function ($libros){
                return
                    '<i class="fa fa-book"></i>'.' '.$libros->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$libros->document->creator->creator_name."<br>";         
            })             
            ->addColumn('document_subtypes_id', function ($libros){

                return  $libros->document->document_subtype->subtype_name;              
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

                return'<span class="'.$libros->document->status_document->color.'">'.' '.$libros->document->status_document->name_status.'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })           
            ->addColumn('created_at', function ($libros){
                return $libros->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($libros) {
                return view('web.books.partials._action', [
                    'libros'            => $libros,
                    'url_show'          => route('web.libros.show', $libros->id),                        
                   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'document_subtypes_id', 'photo', 'registry_number', 'generate_books_id', 'documents_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
