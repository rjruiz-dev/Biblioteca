<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Multimedia;
use App\Creator;
use App\Document_subtype;
use App\Adequacy;
use App\ml_cat_list_book;
use App\Lenguage;
use App\Document;
use App\Book_movement;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_multimedia;

class VMultimediaController extends Controller
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
        $idiomas    = ManyLenguages::all();
        $setting    = Setting::where('id', 1)->first();  
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        return view('web.multimedias.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'idf' => $idf,
            'ml_cat_list_book' => $ml_cat_list_book, 
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Multimedia::pluck('gender', 'gender')
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
        $idiomas    = ManyLenguages::all();
        $setting    = Setting::where('id', 1)->first();  
        // de esta forma cargo el idioma. en la variable esta el unico registro
        $ml_cat_list_book = ml_cat_list_book::where('many_lenguages_id',$session)->first();
        
        return view('web.multimedias.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'idf' => $idf, 
            'ml_cat_list_book' => $ml_cat_list_book, 
            'references' => Generate_reference::pluck('reference_description', 'id'),
            'subjects'   => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
            'adaptations'=> Adequacy::pluck('adequacy_description', 'id'),
            'genders'    => Multimedia::pluck('gender', 'gender')
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
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma_doc = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_multimedia = ml_show_multimedia::where('many_lenguages_id',$session)->first();
        
        $multimedia = Multimedia::with('document.creator',  'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
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

        return view('web.multimedias.show', compact('multimedia'), [
            'idioma_doc'        => $idioma_doc,
            'idioma_multimedia' => $idioma_multimedia,
            'disabled'          => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible
        ]);
        // return view('web.multimedias.show', compact('multimedia'));
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
        
        // $multimedia = Multimedia::with('document.creator', 'document', 'document.status_document') 
        // ->whereHas('document', function($q)
        // {
        //     // $q->where(function ($query) {
        //     //     $query->where('status_documents_id', '=', 1);
        //     // });
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
         
        $multimedia = Multimedia::with('document.creator', 'document.document_subtype', 'document.references', 'document', 'document.lenguage', 'document.status_document') 
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
                    $q->where('gender', '=', $request->get('genders'));   
                } 
            })
            ->whereHas( $references_mostrar ? 'document.references' : 'document' , function($q) use($references_mostrar, $request)
            {
                if($references_mostrar){
                    $q->where('generate_reference_id', '=', $request->get('references'));   
                }
            })            
            ->get();
        
        return dataTables::of($multimedia)
            ->addColumn('id_doc', function ($multimedia){
            return $multimedia->document['id']."<br>";            
            })                        
            ->addColumn('documents_id', function ($multimedia){
                return
                    '<i class="fa fa-music"></i>'.' '.$multimedia->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$multimedia->document->creator->creator_name."<br>";         
            })
            ->addColumn('photo', function ($multimedia){                
                if($multimedia->document['photo'] == null){
                    $url=asset("./images/doc-default.jpg");
                }else{
                    if(file_exists("./images/". $multimedia->document['photo'])){
                        $url=asset("./images/". $multimedia->document['photo']);
                    }else{
                        $url=asset("./images/doc-default.jpg");  
                    }
                     
                }
                return '<img src='.$url.' border="0" width="80" height="80" class="img-rounded" align="center" />';
               
            })
            ->addColumn('status', function ($multimedia){

                return'<span class="'.$multimedia->document->status_document->color.'">'.' '.$multimedia->document->status_document->name_status.'</span>';
                   
            })                       
            ->addColumn('created_at', function ($multimedia){
                return $multimedia->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($multimedia) {
                return view('web.multimedias.partials._action', [
                    'multimedia'        => $multimedia,
                    'url_show'          => route('web.multimedia.show', $multimedia->id),                        
                  
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'documents_id', 'photo', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
