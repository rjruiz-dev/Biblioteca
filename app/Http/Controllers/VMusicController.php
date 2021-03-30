<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Music;
use App\Lenguage;
use App\Creator;
use App\planes;
use App\User;
use App\ml_cat_list_book;
use App\Culture;
use App\Popular;
use App\Adequacy;
use App\Document;
use App\Book_movement;
use App\Document_type;
use App\Generate_subjects;
use App\Generate_reference;
use App\Document_subtype;
use App\Generate_format;
use App\Generate_music;
use App\StatusDocument;
use App\ml_cat_sweetalert;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_music;

class VMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idf = 'none'; //con esto indico q no tiene q filtrar por un libto solo     
        
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
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

        $setting    = Setting::where('id', 1)->first();  

        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
        return view('web.music.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'   => $setting,
            'idf' => $idf,
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet,
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),    
            'genders'    => Generate_music::pluck('genre_music', 'id')
        ]);           
    }

    public function indexsolo(Request $request, $idf)
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

        $setting    = Setting::where('id', 1)->first();  

        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
        
        return view('web.music.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'   => $setting,
            'idf' => $idf,
            'ml_cat_list_book' => $ml_cat_list_book,
            'traduccionsweet' => $traduccionsweet,
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),    
            'genders'    => Generate_music::pluck('genre_music', 'id')
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
    $idioma_music = ml_show_music::where('many_lenguages_id',$session)->first();
    $setting    = Setting::where('id', 1)->first();
    $music = Music::with('document.creator', 'generate_music', 'generate_format','culture', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
    $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
    ->whereHas('copy', function($q) use ($id)
    {
        $q->where('documents_id', '=', $id)->where(function ($query) {
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


    return view('web.music.show', compact('music'), [
        'idioma_doc'    => $idioma_doc,
        'idioma_music'  => $idioma_music,
        'setting' => $setting,
        'disabled'      => $disabled,
        'label_copia_no_disponible' => $label_copia_no_disponible
    ]);
        // return view('web.music.show', compact('music'));
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

    public function dataTable(Request $request)
    {         
        // $musica = Music::with('document.creator', 'document.document_subtype','document','document.lenguage','generate_music', 'document.status_document') 
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
        if($request->get('indexsolo') != ''){
            $indexsolo_mostrar = true; 
        }else{
            $indexsolo_mostrar = false;      
        }
        // dd($references_mostrar);
                 
        $musica = Music::with('document.creator', 'document.document_subtype', 'document.references', 'document', 'document.lenguage','generate_music', 'document.status_document') 
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
                    $q->where('generate_musics_id', '=', $request->get('genders'));   
                } 
            })
            ->whereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })   
            // ->where(function($q) use($references_mostrar, $request)
            // {
            //     $q->whereHas('document.references', function($q) use($references_mostrar, $request)
            //     {
            //         if($references_mostrar){
            //             $q->where('generate_reference_id', '=', $request->get('references'));   
            //         }
            //     });
            // })         
            ->get(); 
    
        
        return dataTables::of($musica)
            ->addColumn('id_doc', function ($musica){
                return $musica->document['id']."<br>";            
            })               
            ->addColumn('documents_id', function ($musica){
                return
                    '<i class="fa fa-music"></i>'.' '.$musica->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$musica->document->creator->creator_name."<br>";         
            }) 
            ->addColumn('document_subtypes_id', function ($musica){

                return  $musica->document->document_subtype->subtype_name;              
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
    
                return '<img src='.$url.' style="width: 90px; margin-left: -25px; border: 3px solid #d2d6de; padding: 3px;" class="img-rounded" />';
                
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

                return'<span class="'.$musica->document->status_document->color.'">'.' '.$musica->document->status_document->name_status.'</span>';
              
            })              
            ->addColumn('created_at', function ($musica){
                return $musica->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($musica) {
                return view('web.music.partials._action', [
                    'musica'            => $musica,
                    'url_show'          => route('web.musica.show', $musica->id),                        
                   
                ]); 
            })           
            ->addIndexColumn()    
            ->rawColumns(['id_doc','registry_number', 'document_subtypes_id', 'photo', 'generate_musics_id', 'documents_id', 'lenguages_id','status','created_at', 'accion']) 
            ->make(true);  
    }
}
