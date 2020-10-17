<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Creator;
use App\Photography;
use App\Document_subtype;
use App\Adequacy;
use App\Adaptations;
use App\Book_movement;
use App\Lenguage;
use App\Document;
use App\Generate_subjects;
use App\Generate_reference;
use App\Generate_format;
use App\StatusDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SavePhotographyRequest;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_fotografia;

class PhotographyController extends Controller
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

        // $this->authorize('view', new Photography); 

        return view('admin.photographs.index', [
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
        $photograph = new Photography();
        $document = new Document();    
        
        // $this->authorize('create', $photograph); 
                              
        return view('admin.photographs.partials.form', [
          
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),   
            'publications'  => Document::pluck('published', 'published'),        
            'references'    => Generate_reference::all(),   
            'formats'       => Generate_format::pluck('genre_format', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 5)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),           
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'photograph'    => $photograph,
            'document'      => $document
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePhotographyRequest $request)
    {
        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                // $this->authorize('create', new Photography);
                // Creamos el documento            
                $document = new Document;
                $document->document_types_id    = 5; // 3 tipo de documento: cine.
                $document->document_subtypes_id = $request->get('document_subtypes_id');                 
                $document->title                = $request->get('title');
            
                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id    = $request->get('creators_id');    
 
                 }else{
                     
                    $creator = new Creator;
                    $creator->creator_name      = $request->get('creators_id');
                    $creator->document_types_id = 1;
                    $creator->save();
                    $document->creators_id      = $creator->id;
                 }

                $document->original_title   = $request->get('original_title'); 
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));                                
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->generate_subjects_id     = $request->get('generate_subjects_id');  
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');            
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
                    $name = 'doc-default.png';
                }  
                $document->photo            = $name;
                $document->save();
                $document->syncReferences($request->get('references'));

                // insertamos en la tabla photograph
                
                $photograph = new Photography;
                $photograph->subtitle = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $photograph->second_author_id  = $request->get('second_author_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name         = $request->get('second_author_id');
                    $creator->document_types_id    = 2;
                    $creator->save();
                    $photograph->second_author_id  = $creator->id;
                }
                
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $photograph->third_author_id    = $request->get('third_author_id');    
 
                }else{
                    if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){         
                    $creator = new Creator;
                    $creator->creator_name = $request->get('third_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $photograph->third_author_id = $creator->id;
                    }
                }
                $photograph->producer       = $request->get('producer');
                $photograph->edition        = $request->get('edition');
                $photograph->generate_formats_id = $request->get('generate_formats_id');              
                $photograph->documents_id  = $document->id;//guardamos el id del documento                
                $photograph->save();
   
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
     * @param  \App\photography  $photography
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
      
        $id_docu = $photograph->documents_id;

        $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id_docu)
        {
            $q->where('documents_id', '=', $id_docu)->where(function ($query) {
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

        // $this->authorize('view', $photograph);

        return view('admin.photographs.show', compact('photograph'), [
            'idioma_doc'        => $idioma_doc,
            'idioma_fotografia' => $idioma_fotografia,
            'disabled'          => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]);

        // return view('admin.photographs.show', compact('photograph'));
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
        $document = Document::findOrFail($photograph->documents_id);    
             
        // $this->authorize('update', $photograph);
        $id_docum = $document->id;
        $verifi_copies = Book_movement::with('movement_type','copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id_docum)
        {
            $q->where('documents_id', '=', $id_docum)->where(function ($query) {
                $query->where('status_copy_id', '=', 1)
                      ->orWhere('status_copy_id', '=', 2)
                      ->orWhere('status_copy_id', '=', 7);
            });
        })
        ->where('active', 1) 
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2)
                  ->orWhere('movement_types_id', '=', 7);
        })    
        ->get();

        if($verifi_copies->count() > 0){

            return view('admin.photographs.partials.form_no_disp'); 

        }else{
                return view('admin.photographs.partials.form', [            
                    'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
                    'publications'  => Document::pluck('published', 'published'),          
                    'references'    => Generate_reference::all(),  
                    'formats'       => Generate_format::pluck('genre_format', 'id'),
                    'subtypes'      => Document_subtype::where('document_types_id', 5)->get()->pluck('subtype_name', 'id'),
                    'editorials'    => Document::pluck('made_by', 'made_by'),
                    'authors'       => Creator::pluck('creator_name', 'id'),
                    'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),          
                    'volumes'       => Document::pluck('volume', 'volume'),
                    'languages'     => Lenguage::pluck('leguage_description', 'id'),
                    'status_documents' => StatusDocument::pluck('name_status', 'id'), 
                    'photograph'    => $photograph,
                    'document'      => $document
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function update(SavePhotographyRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                $photograph = Photography::findOrFail($id);
                $document   = Document::findOrFail($photograph->documents_id);
                
                // $this->authorize('update', $photograph);

                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
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

                $document->original_title       = $request->get('original_title'); 
                $document->acquired             = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));               
                $document->adequacies_id        = $request->get('adequacies_id');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->let_author           = $request->get('let_author');
                $document->let_title            = $request->get('let_title');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->assessment           = $request->get('assessment'); 
                
                if($request->get('status_documents_id') == 3){
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 1;   
                }else{
                    $document->status_documents_id = $request->get('status_documents_id');
                    $document->desidherata = 0; 
                }
                
                $document->published            = $request->get('published');
                $document->made_by              = $request->get('made_by');
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
                }else{                
                    $name = 'doc-default.png';
                }  
                $document->photo = $name; 
                $document->save();
                $document->syncReferences($request->get('references'));

                 // insertamos en la tabla photograph
            
                $photograph->subtitle = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $photograph->second_author_id  = $request->get('second_author_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name         = $request->get('second_author_id');
                    $creator->document_types_id    = 2;
                    $creator->save();
                    $photograph->second_author_id  = $creator->id;
                }
                // $photograph->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $photograph->third_author_id = $request->get('third_author_id');    

                }else{
                    
                    if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){
    
                        $creator = new Creator;
                        $creator->creator_name         = $request->get('third_author_id');
                        $creator->document_types_id    = 2;
                        $creator->save();
                        $photograph->third_author_id   = $creator->id;
                    }
                }
                $photograph->producer              = $request->get('producer');
                $photograph->edition               = $request->get('edition');
                $photograph->generate_formats_id   = $request->get('generate_formats_id');               
                $photograph->documents_id          = $document->id;//guardamos el id del documento
                $photograph->save();
   
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
     * @param  \App\photography  $photography
     * @return \Illuminate\Http\Response
     */
    public function destroy(photography $photography)
    {
        //
    }

    
    public function exportPdf(Request $request, $id)
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
            

        $photograph = Photography::with('document.creator', 'generate_format', 'document.adequacy', 'document.lenguage', 'document.subjects')->first();

        $pdf = PDF::loadView('admin.photographs.show', compact('photograph'),[
            'idioma_doc' => $idioma_doc,
            'idioma_fotografia' => $idioma_fotografia
        ]);   
       
        return $pdf->download('fotografia.pdf'); 
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
        $document->status_documents_id = 1;
        $document->desidherata = 0;   
        $document->save();
    }

    public function dataTable()
    {   
        $photograph = Photography::with('document.creator', 'document.document_subtype', 'document.lenguage','generate_format','document.status_document') 
        // ->allowed()
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
                return view('admin.photographs.partials._action', [
                    'photograph'        => $photograph,
                    'url_show'          => route('admin.photographs.show', $photograph->id),                        
                    'url_edit'          => route('admin.photographs.edit', $photograph->id),                              
                    'url_copy'          => route('photographs.copy', $photograph->document->id),                              
                    'url_desidherata'   => route('photographs.desidherata', $photograph->document->id),
                    'url_baja'          => route('photographs.baja', $photograph->document->id),
                    'url_reactivar'     => route('photographs.reactivar', $photograph->document->id),
                    'url_print'         => route('fotografia.pdf', $photograph->id)   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'generate_formats_id', 'document_subtypes_id', 'documents_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
