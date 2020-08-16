<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Multimedia;
use App\Creator;
use App\Document_subtype;
use App\Adequacy;
use App\Lenguage;
use App\Document;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveDocumentRequest;

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
        $document = new Document();              
                              
        return view('admin.multimedias.partials.form', [   
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'    => Generate_reference::all(), 
            'subtypes'      => Document_subtype::pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id'),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),            
            'volumes'       => Document::pluck('volume', 'volume'),
            'publications'  => Document::pluck('published', 'published'),      
            'editions'      => Multimedia::pluck('edition', 'id'),         
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'multimedia'    => $multimedia,
            'document'      => $document               
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveDocumentRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                // Creamos el documento            
                $document = new Document;
                $document->document_types_id    = 4; // 4 tipo de documento: multimedia.
                $document->document_subtypes_id = 9; // 0 sub-tipo de documento: no tiene. 
                $document->title                = $request->get('title');
                
                // $document->creators_id = $request->get('creators_id');

                if( is_numeric($request->get('creators_id'))) 
                 {                
                     $document->creators_id = $request->get('creators_id');    
 
                 }else{
                     
                    $creator = new Creator;
                     $creator->creator_name         = $request->get('creators_id');
                     $creator->document_types_id    = 1;
                     $creator->save();
                     $document->creators_id         = $creator->id;
                 }

                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));           
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->registry_number  = $request->get('registry_number');
                $document->generate_subjects_id = $request->get('generate_subjects_id'); 
                $document->assessment       = $request->get('assessment'); 
                
                // dd($request->get('desidherata'));
                if($request->get('desidherata') == null){
                    $document->desidherata = 0;
                    $document->status_documents_id = 1;

                }else{
                    $document->desidherata = 1;
                    $document->status_documents_id = 3;
                }
                
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year             = Carbon::createFromFormat('Y', $request->get('year'));
                $document->volume           = $request->get('volume');
                $document->quantity_generic = $request->get('quantity_generic'); 
                $document->collection       = $request->get('collection');
                $document->location         = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->lenguages_id     = $request->get('lenguages_id');             
                // $document->photo            = $request->get('photo');
                $document->synopsis         = $request->get('synopsis');

                if ($request->hasFile('photo')) {               

                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{
                    $name = null; // se asigno null pero se le podria ingresar una imagen por defecto si no carga nada 
                }  

                $document->photo            = $name;

                $document->save();
                $document->syncReferences($request->get('references'));

                 // insertamos en la tabla multimedia
                
                $multimedia = new Multimedia; 
                $multimedia->subtitle = $request->get('subtitle');
                // $multimedia->second_author         = $request->get('second_author');
                if( is_numeric($request->get('second_author_id'))) 
                 {                
                     $multimedia->second_author_id  = $request->get('second_author_id');    
 
                 }else{

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
 
                }else{
                    $creator = new Creator;
                    $creator->creator_name = $request->get('third_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $multimedia->third_author_id = $creator->id;
                }
                 
                $multimedia->translator = $request->get('translator');
                $multimedia->isbn       = $request->get('isbn');
                $multimedia->edition    = $request->get('edition');
                $multimedia->size       = $request->get('size');             
                $multimedia->documents_id = $document->id;//guardamos el id del documento               
                $multimedia->save();
   
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
        $document   = Document::findOrFail($multimedia->documents_id);      
                              
        return view('admin.multimedias.partials.form', [
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'    => Generate_reference::all(),     
            'subtypes'      => Document_subtype::pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id'),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),            
            'editions'      => Multimedia::pluck('edition', 'id'),         
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'multimedia'    => $multimedia,
            'document'      => $document
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(SaveDocumentRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                $multimedia = Multimedia::findOrFail($id);
                $document   = Document::findOrFail($multimedia->documents_id);
                
                $document->title = $request->get('title');
              
                if( is_numeric($request->get('creators_id'))) 
                 {                
                     $document->creators_id    = $request->get('creators_id');    
 
                 }else{
                     
                    $creator = new Creator;
                    $creator->creator_name = $request->get('creators_id');
                    $creator->document_types_id = 1;
                    $creator->save();
                    $document->creators_id = $creator->id;
                 }

                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));                 
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->registry_number  = $request->get('registry_number');
                $document->generate_subjects_id     = $request->get('generate_subjects_id');  
                $document->assessment       = $request->get('assessment'); 
                
                if($request->get('status_documents_id') == 3){
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 1;   
                }else{
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 0; 
                }
                
                $document->published        = $request->get('published');
                $document->made_by          = $request->get('made_by');
                $document->year                 = Carbon::createFromFormat('Y', $request->get('year'));
                $document->volume               = $request->get('volume');
                $document->quantity_generic     = $request->get('quantity_generic'); 
                $document->collection           = $request->get('collection');
                $document->location             = $request->get('location');
                $document->observation          = $request->get('observation');
                $document->note                 = $request->get('note');
                $document->lenguages_id         = $request->get('lenguages_id');              
                // $document->photo                = $request->get('photo');
                $document->synopsis             = $request->get('synopsis');

                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                }
                $document->photo = $name;

                $document->save();
                $document->syncReferences($request->get('references'));

                 // insertamos en la tabla multimedia
                $multimedia->subtitle = $request->get('subtitle');
                // $multimedia->second_author         = $request->get('second_author');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $multimedia->second_author_id = $request->get('second_author_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name      = $request->get('second_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $multimedia->second_author_id = $creator->id;
                }
                // $multimedia->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $multimedia->third_author_id = $request->get('third_author_id');    

                }else{
                    
                     $creator = new Creator;
                     $creator->creator_name       = $request->get('third_author_id');
                     $creator->document_types_id  = 2;
                     $creator->save();
                     $multimedia->third_author_id = $creator->id;
                 }
                 
                $multimedia->translator     = $request->get('translator');
                $multimedia->isbn           = $request->get('isbn');
                $multimedia->edition        = $request->get('edition');
                $multimedia->size           = $request->get('size');             
                $multimedia->documents_id   = $document->id;//guardamos el id del documento                
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

    public function reactivar($id)
    {
        $document = Document::findOrFail($id);
        // dd($document);
        $document->status_documents_id = 1;
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

    public function dataTable()
    {   
        $multimedia = Multimedia::with('document.creator', 'document.status_document') 
        // ->allowed()
        ->get();
         
        return dataTables::of($multimedia)
            ->addColumn('id_doc', function ($multimedia){
            return $multimedia->document['id']."<br>";            
            }) 
            ->addColumn('registry_number', function ($libros){
                return $libros->document['registry_number']."<br>";            
            })             
            ->addColumn('documents_id', function ($multimedia){
                return
                    '<i class="fa fa-music"></i>'.' '.$multimedia->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$multimedia->document->creator->creator_name."<br>";         
            })
            ->addColumn('status', function ($multimedia){

                return'<span class="'.$multimedia->document->status_document->color.'">'.' '.$multimedia->document->status_document->name_status.'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })                       
            ->addColumn('created_at', function ($multimedia){
                return $multimedia->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($multimedia) {
                return view('admin.multimedias.partials._action', [
                    'multimedia' => $multimedia,
                    'url_show' => route('admin.multimedias.show', $multimedia->id),                        
                    'url_edit' => route('admin.multimedias.edit', $multimedia->id),                              
                    'url_copy' => route('multimedias.copy', $multimedia->document->id),                              
                    'url_desidherata' => route('multimedias.desidherata', $multimedia->document->id),
                    'url_baja' => route('multimedias.baja', $multimedia->document->id),
                    'url_reactivar' => route('multimedias.reactivar', $multimedia->document->id)
                    ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc','registry_number','documents_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
