<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Creator;
use App\Photography;
use App\ml_cat_list_book;
use App\Document_subtype;
use App\Adequacy;
use App\Adaptations;
use App\Lenguage;
use App\Document;
use App\Generate_subjects;
use App\Generate_reference;
use App\Generate_format;
use App\StatusDocument;
use App\Book_movement;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_fotografia;


class VPhotographyController extends Controller
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
        $setting    = Setting::where('id', 1)->first();  
         // de esta forma cargo el idioma. en la variable esta el unico registro
         $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        return view('web.photographs.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas,
            'setting'    => $setting,
            'idf' => $idf,
            'ml_cat_list_book' => $ml_cat_list_book,
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_format::pluck('genre_format', 'id')
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
        $setting    = Setting::where('id', 1)->first();  
         // de esta forma cargo el idioma. en la variable esta el unico registro
         $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        return view('web.photographs.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas,
            'setting'    => $setting,
            'idf' => $idf,
            'ml_cat_list_book' => $ml_cat_list_book,
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Generate_format::pluck('genre_format', 'id')
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
        $idioma_fotografia = ml_show_fotografia::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $photograph = Photography::with('document.creator', 'generate_format', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
          
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

        return view('web.photographs.show', compact('photograph'), [
            'idioma_doc'        => $idioma_doc,
            'idioma_fotografia' => $idioma_fotografia,
            'disabled'          => $disabled,
            'setting' => $setting,
            'label_copia_no_disponible' => $label_copia_no_disponible
        ]);
 
        // return view('web.photographs.show', compact('photograph'));
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
        // $photograph = Photography::with('document.creator', 'document.document_subtype', 'document', 'document.lenguage','generate_format','document.status_document') 
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
        
        // $photograph = Photography::with('document.creator', 'document.document_subtype', 'document', 'document.lenguage','generate_format','document.status_document') 
        $photograph = Photography::with('document.creator', 'document.document_subtype', 'document.references', 'document', 'document.lenguage','generate_format','document.status_document') 
            ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request,$indexsolo_mostrar)
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
                    $q->where('generate_formats_id', '=', $request->get('genders'));   
                } 
            })
            ->whereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })            
            ->get(); 
       
        return dataTables::of($photograph)
            ->addColumn('id_doc', function ($photograph){
                return $photograph->document['id']."<br>";            
            }) 
            ->addColumn('documents_id', function ($photograph){
                return
                    '<i class="fa fa-music"></i>'.' '.$photograph->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$photograph->document->creator->creator_name."<br>";         
            }) 
            ->addColumn('document_subtypes_id', function ($photograph){

                return  $photograph->document->document_subtype->subtype_name;              
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

                return'<span class="'.$photograph->document->status_document->color.'">'.' '.$photograph->document->status_document->name_status.'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })   
            ->addColumn('created_at', function ($photograph){
                return $photograph->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($photograph) {
                return view('web.photographs.partials._action', [
                    'photograph'        => $photograph,
                    'url_show'          => route('web.fotografias.show', $photograph->id),                 
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'generate_formats_id', 'document_subtypes_id', 'photo', 'documents_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
