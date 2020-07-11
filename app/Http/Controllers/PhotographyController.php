<?php

namespace App\Http\Controllers;

use App\Photography;
use App\Creator;
use App\Formats;
use App\Document_subtype;
use App\Adequacy;
use App\Generate_movie;
use App\Adaptations;
use App\Lenguage;
use App\Document;
use App\photography_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;

class PhotographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.photographs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $photograph = new Photography();      
                              
        return view('admin.photographs.partials.form', [
            // 'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            // 'genders' => Generate_photograph::pluck('genre_photograph', 'id'),
            // 'distributions' => photographs::pluck('distribution', 'distribution'),
            // 'adaptations_bis' => Adaptations::pluck('adaptation_name', 'id'),
            // 'photographs' => photography_photographs::pluck('photography_photographs_name', 'id'),
            
            //  'second_authors' => Multimedia::pluck('second_author', 'second_author'),
            //  'third_authors' => Multimedia::pluck('third_author', 'third_author'),

             'formats' => Formats::pluck('format_name', 'id'),
            // // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'photograph'      => $photograph
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
                $document->document_types_id    = 5; // 3 tipo de documento: cine.
                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
                 
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
                $document->volume  = $request->get('volume'); 
                $document->quantity_generic  = $request->get('quantity_generic'); 
                $document->collection  = $request->get('collection'); 
                $document->location      = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');
                 
                $document->save();

                 // insertamos en la tabla photograph
                
                $photograph = new Photography;
                $photograph->subtitle            = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                 {                
                     $photograph->second_author_id    = $request->get('second_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('second_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $photograph->second_author_id = $creator->id;
                 }
                // $photograph->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                 {                
                     $photograph->third_author_id    = $request->get('third_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('third_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $photograph->third_author_id = $creator->id;
                 }
                 $photograph->producer     = $request->get('producer');
                 $photograph->edition     = $request->get('edition');
                 $photograph->formats_id     = $request->get('formats_id'); 
                
                $photograph->documents_id = $document->id;//guardamos el id del documento
                
                $photograph->save();
   
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
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function show(photography $photography)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $photograph = Photography::with('document')->findOrFail($id);     
                              
        return view('admin.photographs.partials.form', [
            // 'documents' => Document_type::pluck( 'document_description', 'id'),
            'subtypes'  => Document_subtype::pluck('subtype_name', 'id'),
            'authors'   => Creator::pluck('creator_name', 'id'),
            'adaptations' => Adequacy::pluck('adequacy_description', 'id'),
            // 'genders' => Generate_photograph::pluck('genre_photograph', 'id'),
            // 'distributions' => photographs::pluck('distribution', 'distribution'),
            // 'adaptations_bis' => Adaptations::pluck('adaptation_name', 'id'),
            // 'photographs' => photography_photographs::pluck('photography_photographs_name', 'id'),
            
            //  'second_authors' => Multimedia::pluck('second_author', 'second_author'),
            //  'third_authors' => Multimedia::pluck('third_author', 'third_author'),

             'formats' => Formats::pluck('format_name', 'id'),
            // // 'editions' => Music::pluck('edition', 'id'),
            'volumes' => Document::pluck('volume', 'volume'),
            'languages' => Lenguage::pluck('leguage_description', 'id'),
            'photograph'      => $photograph
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                $photograph = Photography::findOrFail($id);
                $document = Document::findOrFail($photograph->documents_id);
                
                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
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
                $document->volume  = $request->get('volume'); 
                $document->quantity_generic  = $request->get('quantity_generic'); 
                $document->collection  = $request->get('collection'); 
                $document->location      = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');
                $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');
                 
                $document->save();

                 // insertamos en la tabla photograph
            
                $photograph->subtitle            = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                 {                
                     $photograph->second_author_id    = $request->get('second_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('second_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $photograph->second_author_id = $creator->id;
                 }
                // $photograph->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                 {                
                     $photograph->third_author_id    = $request->get('third_author_id');    
 
                 }else
                 {
                     $creator = new Creator;
                     $creator->creator_name = $request->get('third_author_id');
                     $creator->document_types_id = 2;
                     $creator->save();
                     $photograph->third_author_id = $creator->id;
                 }
                 $photograph->producer     = $request->get('producer');
                 $photograph->edition     = $request->get('edition');
                 $photograph->formats_id     = $request->get('formats_id'); 
                
                $photograph->documents_id = $document->id;//guardamos el id del documento
                
                $photograph->save();
   
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
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function destroy(photography $photography)
    {
        //
    }

    public function dataTable()
    {   
        $photograph = Photography::with('document.creator','format') 
        // ->allowed()
        ->get();
        // dd($photograph);       
        return dataTables::of($photograph)
            // ->addColumn('registry_number', function ($photograph){
            //     return
            //         '<i class="fa fa-user"></i>'.' '.$photograph->registry_number."<br>";            
            // }) 
            ->addColumn('formats_id', function ($photograph){

                return  $photograph->format->format_name;              
            })  
            ->addColumn('documents_id', function ($photograph){
                return
                    '<i class="fa fa-music"></i>'.' '.$photograph->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$photograph->document->creator->creator_name."<br>";         
            }) 
            // ->addColumn('lenguages_id', function ($photograph){

            //     return'<i class="fa  fa-globe"></i>'.' '.$photograph->document->lenguage->leguage_description;         
            // })            
            ->addColumn('created_at', function ($photograph){
                return $photograph->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($photograph) {
                return view('admin.photographs.partials._action', [
                    'photograph' => $photograph,
                    'url_show' => route('admin.photographs.show', $photograph->id),                        
                    'url_edit' => route('admin.photographs.edit', $photograph->id),                              
                    'url_destroy' => route('admin.photographs.destroy', $photograph->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['documents_id','formats_id', 'created_at', 'accion']) 
            ->make(true);  
    }

}
