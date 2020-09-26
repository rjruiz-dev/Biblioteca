<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Creator;
use App\Photography;
use App\Document_subtype;
use App\Adequacy;
use App\Adaptations;
use App\Lenguage;
use App\Document;
use App\Generate_subjects;
use App\Generate_reference;
use App\Generate_format;
use App\StatusDocument;
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

        return view('web.photographs.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting
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
        
        $photograph = Photography::with('document.creator', 'generate_format', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
        return view('web.photographs.show', compact('photograph'), [
            'idioma_doc' => $idioma_doc,
            'idioma_fotografia' => $idioma_fotografia
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

    public function dataTable()
    {   
        $photograph = Photography::with('document.creator', 'document.document_subtype', 'document.lenguage','generate_format','document.status_document') 
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
            ->rawColumns(['id_doc', 'generate_formats_id', 'document_subtypes_id', 'documents_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
