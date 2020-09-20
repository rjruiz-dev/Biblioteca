<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Music;
use App\Lenguage;
use App\Creator;
use App\Culture;
use App\Popular;
use App\Adequacy;
use App\Document;
use App\Document_type;
use App\Generate_subjects;
use App\Generate_reference;
use App\Document_subtype;
use App\Generate_format;
use App\Generate_music;
use App\StatusDocument;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;

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
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();

        return view('web.music.index', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
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
    
    $music = Music::with('document.creator', 'generate_music', 'generate_format','culture', 'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
    return view('web.music.show', compact('music'), [
        'idioma_doc' => $idioma_doc,
        'idioma_music' => $idioma_music
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

    public function dataTable()
    {   
        $musica = Music::with('document.creator', 'document.document_subtype','document.lenguage','generate_music', 'document.status_document') 
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
            ->addColumn('generate_musics_id', function ($musica){
                if($musica->generate_music['genre_music'] == null){
                    return 'Sin Genero';
                }else{
                    return $musica->generate_music['genre_music']; 
                }                 
            }) 
            ->addColumn('lenguages_id', function ($musica){
                if($musica->document->lenguage->leguage_description == null){
                    return 'Sin Lenguaje';
                }else{
                    return'<i class="fa  fa-globe"></i>'.' '.$musica->document->lenguage->leguage_description;         
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
            ->rawColumns(['id_doc','registry_number', 'document_subtypes_id', 'generate_musics_id', 'documents_id', 'lenguages_id','status','created_at', 'accion']) 
            ->make(true);  
    }
}
