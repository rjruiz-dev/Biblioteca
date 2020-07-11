<?php

namespace App\Http\Controllers;

use DataTables;
use App\Music;
use App\Culture;
use App\Popular;
use App\Lenguage;
use App\Formats;
use App\Creator;
use App\Adequacy;
use App\Document;
use App\Document_type;
use App\Document_subtype;
use App\Generate_musics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.music.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $music = new Music();      
                              
        return view('admin.music.partials.form', [
            'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            'genders' => Generate_musics::pluck('genre_music', 'id'),
            'publications' => Document::pluck('published', 'published'),
             'sounds' => Music::pluck('sound', 'sound'),
             'formats' => Formats::pluck('format_name', 'id'),
            // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'music'      => $music
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                // Creamos el documento            
                $document = new Document;
                // $document->document_types_id    = $request->get('document_types_id');
                $document->document_types_id    = 1; // 1 tipo de documento: musica.
                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
                $document->title            = $request->get('title');
                $document->acquired         = Carbon::parse($request->get('acquired'));        
                $document->drop             = Carbon::parse($request->get('drop'));        
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->cdu              = $request->get('cdu');  
                $document->assessment       = $request->get('assessment'); 
                $document->desidherata      = $request->get('desidherata'); 
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::parse($request->get('year'));
                $document->volumes           = $request->get('volumes');
                $document->quantity_generic  = $request->get('quantity_generic');
                $document->location         = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis = $request->synopsis;

                // $document->creators_id         = $request->get('creators_id');

                 if( is_numeric($request->get('creators_id'))) 
                 {                
                     $document->creators_id    = $request->get('creators_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('creators_id');
                     $creator->document_types_id = 1;
                     $creator->save();
                     $document->creators_id = $creator->id;
                 }


                $document->save();

                 // insertamos en la tabla musica
                
                $music = new Music;   
                $music->producer         = $request->get('producer');
                $music->generate_musics_id    = $request->get('generate_musics_id');
                $music->sound     = $request->get('sound');
                $music->formats_id       = $request->get('formats_id');        
                
                $music->documents_id = $document->id;//guardamos el id del documento
                
                $music->save();

                // evaluamos si se eligio culta o popular y en base a eso insertamos en la 
                //respectiva tabla

                if($request->get('document_subtypes_id') == 3){ // si es popular
                    $popular = new Popular;   
                $popular->subtitle      = $request->get('subtitle');
                $popular->other_artists    = $request->get('other_artists');
                $popular->director     = $request->get('music_populars');

                $popular->music_id = $music->id; //guardamos el id del libro

                $popular->save();

                }else{         
                $culture = new Culture;   
                $culture->album_title      = $request->get('album_title');
                // $culture->composer    = $request->get('composer');
                $culture->director     = $request->get('director');
                $culture->orchestra       = $request->get('orchestra');        
                $culture->soloist          = $request->get('soloist');

                $culture->music_id = $music->id; //guardamos el id del libro

                $culture->save();
                }
                 
                DB::commit();

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
    public function show(Music $music)
    {
        //
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
                               
        return view('admin.music.partials.form', [
            'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            'genders' => Generate_musics::pluck('genre_music', 'id'),
            'publications' => Document::pluck('published', 'published'),
            'sounds' => Music::pluck('sound', 'sound'),
            'formats' => Formats::pluck('format_name', 'id'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'music'      => $musics
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction(); 

                $music = Music::findOrFail($id);
                $document = Document::findOrFail($music->documents_id);
                // Actualizamos el documento
                // $document->document_types_id    = $request->get('document_types_id');
                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
                $document->title            = $request->get('title');
                $document->acquired         = Carbon::parse($request->get('acquired'));        
                $document->drop             = Carbon::parse($request->get('drop'));        
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->cdu              = $request->get('cdu');  
                $document->assessment       = $request->get('assessment'); 
                $document->desidherata      = $request->get('desidherata'); 
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::parse($request->get('year'));
                $document->volumes           = $request->get('volumes');
                $document->quantity_generic  = $request->get('quantity_generic');
                $document->location         = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');
                
                // $document->creators_id         = $request->get('creators_id');

                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id    = $request->get('creators_id');    

                }else
                {
                    $creator = new Creator;
                    $creator->creator_name = $request->get('creators_id');
                    $creator->document_types_id = 1;
                    $creator->save();
                    $document->creators_id = $creator->id;
                }

                $document->save();

                 // actualizamos en la tabla musica  
                $music->producer         = $request->get('producer');
                $music->generate_musics_id    = $request->get('generate_musics_id');
                $music->sound     = $request->get('sound');
                $music->formats_id       = $request->get('formats_id');        
                
                $music->documents_id = $document->id;//guardamos el id del documento
                
                $music->save();

                // evaluamos si se eligio culta o popular y en base a eso insertamos en la 
                //respectiva tabla

                if($request->get('document_subtypes_id') == 3){ // si es popular 
                // $popular = Popular::findOrFail($id); 
                $popular = Popular::where('id', $id)->first();
                if(!is_null($popular)) {
                $popular->subtitle      = $request->get('subtitle');
                $popular->other_artists    = $request->get('other_artists');
                $popular->director     = $request->get('music_populars');

                $popular->music_id = $music->id; //guardamos el id del libro

                $popular->save();
                }
                }else{ // si es culta        
                // $culture = Culture::findOrFail($id); 
                $culture = Culture::where('id', $id)->first();
                if(!is_null($culture)) {
                $culture->album_title     = $request->get('album_title');
                // $culture->composer    = $request->get('composer');
                $culture->director     = $request->get('director');
                $culture->orchestra       = $request->get('orchestra');        
                $culture->soloist          = $request->get('soloist');

                $culture->music_id = $music->id; //guardamos el id del libro

                $culture->save();
                }
                }
                 
                DB::commit();

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

    public function dataTable()
    {   
        $musica = Music::with('document.creator', 'document.document_subtype','generate_music') 
        // ->allowed()
        ->get();
        // dd($musica);       
        return dataTables::of($musica)
            // ->addColumn('registry_number', function ($musica){
            //     return
            //         '<i class="fa fa-user"></i>'.' '.$musica->registry_number."<br>";            
            // }) 
            ->addColumn('document_subtypes_id', function ($musica){

                return  $musica->document->document_subtype->subtype_name;              
            }) 
            ->addColumn('generate_musics_id', function ($musica){
                return $musica->generate_music['genre_music'];              
            }) 
            ->addColumn('documents_id', function ($musica){
                return
                    '<i class="fa fa-music"></i>'.' '.$musica->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$musica->document->creator->creator_name."<br>";         
            }) 
            // ->addColumn('lenguages_id', function ($musica){

            //     return'<i class="fa  fa-globe"></i>'.' '.$musica->document->lenguage->leguage_description;         
            // })            
            ->addColumn('created_at', function ($musica){
                return $musica->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($musica) {
                return view('admin.music.partials._action', [
                    'musica' => $musica,
                    'url_show' => route('admin.music.show', $musica->id),                        
                    'url_edit' => route('admin.music.edit', $musica->id),                              
                    'url_destroy' => route('admin.music.destroy', $musica->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['document_subtypes_id', 'generate_musics_id', 'documents_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
