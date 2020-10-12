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
use App\Ml_dashboard;
use App\ManyLenguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SaveMusicalRequest;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_music;

class MusicController extends Controller
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
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();

        $this->authorize('view', new Music);

        return view('admin.music.index', [
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
        $music = new Music();    
        $document = new Document();      

        $this->authorize('create', $music);     
                              
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
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'music'         => $music,
            'document'      => $document
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

                $this->authorize('create', new Music);
                              
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
                    $name = 'doc-default.png';
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
      
        $this->authorize('view', $music);

        return view('admin.music.show', compact('music'), [
            'idioma_doc' => $idioma_doc,
            'idioma_music' => $idioma_music
        ]);

        // return view('admin.music.show', compact('music'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $musics = Music::with('document', 'generate_music')->findOrFail($id);
        $document = Document::findOrFail($musics->documents_id);   
                      
        $this->authorize('update', $music);

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
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'music'         => $musics,
            'document'      => $document
        ]); 
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
                
                $this->authorize('update', $music);             
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
                    $name = 'doc-default.png';
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

        $pdf = PDF::loadView('admin.music.show', compact('music'),[
            'idioma_doc' => $idioma_doc,
            'idioma_music' => $idioma_music 
        ]);  
       
        return $pdf->download('musica.pdf');
    }
    public function desidherata($id)
    {
        $document = Document::findOrFail($id);
        $document->status_documents_id = 3;
        $document->desidherata = 1;    
        $document->save();
    }
    

    public function baja($id)
    {
        $document = Document::findOrFail($id);
        $document->status_documents_id = 2;
        $document->desidherata = 0;   
        $document->save();
    }

    public function copy($id)
    {
        
        $document = Document::findOrFail($id);
        if($document->status_documents_id == 2){
            return response()->json(['data' => 0]);      
        }else{
            return response()->json(['data' => $document->id]); 
        }  
    }

    public function reactivar($id)
    {
        $document = Document::findOrFail($id);
        // dd($document);
        $document->status_documents_id = 1;
        $document->desidherata = 0;   
        $document->save();
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
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })              
            ->addColumn('created_at', function ($musica){
                return $musica->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($musica) {
                return view('admin.music.partials._action', [
                    'musica'            => $musica,
                    'url_show'          => route('admin.music.show', $musica->id),                        
                    'url_edit'          => route('admin.music.edit', $musica->id),                              
                    'url_copy'          => route('music.copy', $musica->document->id),                              
                    'url_desidherata'   => route('music.desidherata', $musica->document->id),
                    'url_baja'          => route('music.baja', $musica->document->id),
                    'url_reactivar'     => route('music.reactivar', $musica->document->id),
                    'url_print'         => route('musica.pdf', $musica->id) 
                ]); 
            })           
            ->addIndexColumn()    
            ->rawColumns(['id_doc','registry_number', 'document_subtypes_id', 'generate_musics_id', 'documents_id', 'lenguages_id','status','created_at', 'accion']) 
            ->make(true);  
    }
}
