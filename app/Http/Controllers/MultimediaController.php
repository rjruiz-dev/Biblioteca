<?php

namespace App\Http\Controllers;

use App\Multimedia;
use App\Creator;
use App\Formats;
use App\Document_subtype;
use App\Adequacy;
use App\Generate_multimedia;
use App\Lenguage;
use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.multimedias.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $multimedia = new Multimedia();      
                              
        return view('admin.multimedias.partials.form', [
            // 'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            'genders' => Generate_multimedia::pluck('genre_multimedia', 'id'),
            // 'publications' => Document::pluck('published', 'published'),
            
            //  'second_authors' => Multimedia::pluck('second_author', 'second_author'),
            //  'third_authors' => Multimedia::pluck('third_author', 'third_author'),

             'formats' => Formats::pluck('format_name', 'id'),
            // // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'multimedia'      => $multimedia
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
                $document->document_types_id    = 2; // 2 tipo de documento: multimedia.
                $document->document_subtypes_id = 0; // 0 sub-tipo de documento: no tiene. 
                $document->title            = $request->get('title');
                
                // $document->creators_id = $request->get('creators_id');

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

                 $document->original_title    = $request->get('original_title');

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
                $document->volume           = $request->get('volume');
                $document->quantity_generic  = $request->get('quantity_generic'); 
                $document->collection      = $request->get('collection');
                $document->location      = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');

                $document->save();

                 // insertamos en la tabla multimedia
                
                $multimedia = new Multimedia; 
                $multimedia->subtitle = $request->get('subtitle');
                // $multimedia->second_author         = $request->get('second_author');
                if( is_numeric($request->get('second_author_id'))) 
                 {                
                     $multimedia->second_author_id    = $request->get('second_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('second_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $multimedia->second_author_id = $creator->id;
                 }
                // $multimedia->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                 {                
                     $multimedia->third_author_id    = $request->get('third_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('third_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $multimedia->third_author_id = $creator->id;
                 }
                 
                $multimedia->translator     = $request->get('translator');
                $multimedia->isbn     = $request->get('isbn');
                $multimedia->edition     = $request->get('edition');
                $multimedia->size         = $request->get('size');
             
                $multimedia->documents_id = $document->id;//guardamos el id del documento
                
                $multimedia->save();
   
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
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function show(multimedia $multimedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $multimedia = new Multimedia();  
        $multimedia = Multimedia::with('document')->findOrFail($id);    
                              
        return view('admin.multimedias.partials.form', [
            // 'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            'genders' => Generate_multimedia::pluck('genre_multimedia', 'id'),
            // 'publications' => Document::pluck('published', 'published'),
            
            //  'second_authors' => Multimedia::pluck('second_author', 'second_author'),
            //  'third_authors' => Multimedia::pluck('third_author', 'third_author'),

             'formats' => Formats::pluck('format_name', 'id'),
            // // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'multimedia'      => $multimedia
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                $multimedia = Multimedia::findOrFail($id);
                $document = Document::findOrFail($multimedia->documents_id);
                
                $document->title            = $request->get('title');
                
                // $document->creators_id = $request->get('creators_id');

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

                 $document->original_title    = $request->get('original_title');

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
                $document->volume           = $request->get('volume');
                $document->quantity_generic  = $request->get('quantity_generic'); 
                $document->collection      = $request->get('collection');
                $document->location      = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');

                $document->save();

                 // insertamos en la tabla multimedia

                $multimedia->subtitle = $request->get('subtitle');
                // $multimedia->second_author         = $request->get('second_author');
                if( is_numeric($request->get('second_author_id'))) 
                 {                
                     $multimedia->second_author_id    = $request->get('second_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('second_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $multimedia->second_author_id = $creator->id;
                 }
                // $multimedia->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                 {                
                     $multimedia->third_author_id    = $request->get('third_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('third_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $multimedia->third_author_id = $creator->id;
                 }
                 
                $multimedia->translator     = $request->get('translator');
                $multimedia->isbn     = $request->get('isbn');
                $multimedia->edition     = $request->get('edition');
                $multimedia->size         = $request->get('size');
             
                $multimedia->documents_id = $document->id;//guardamos el id del documento
                
                $multimedia->save();
   
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
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(multimedia $multimedia)
    {
        //
    }

    public function dataTable()
    {   
        $multimedia = Multimedia::with('document.creator') 
        // ->allowed()
        ->get();
        // dd($multimedia);       
        return dataTables::of($multimedia)
            // ->addColumn('registry_number', function ($multimedia){
            //     return
            //         '<i class="fa fa-user"></i>'.' '.$multimedia->registry_number."<br>";            
            // }) 
            // ->addColumn('formats_id', function ($multimedia){

            //     return  $multimedia->format['format_name'];              
            // })  
            ->addColumn('documents_id', function ($multimedia){
                return
                    '<i class="fa fa-music"></i>'.' '.$multimedia->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$multimedia->document->creator->creator_name."<br>";         
            }) 
            // ->addColumn('lenguages_id', function ($multimedia){

            //     return'<i class="fa  fa-globe"></i>'.' '.$multimedia->document->lenguage->leguage_description;         
            // })            
            ->addColumn('created_at', function ($multimedia){
                return $multimedia->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($multimedia) {
                return view('admin.multimedias.partials._action', [
                    'multimedia' => $multimedia,
                    'url_show' => route('admin.multimedias.show', $multimedia->id),                        
                    'url_edit' => route('admin.multimedias.edit', $multimedia->id),                              
                    'url_destroy' => route('admin.multimedias.destroy', $multimedia->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['documents_id','formats_id', 'created_at', 'accion']) 
            ->make(true);  
    }

}
