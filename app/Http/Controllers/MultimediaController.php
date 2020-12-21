<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DataTables;
use App\Multimedia;
use App\Movies;
use App\Creator;
use App\Document_subtype;
use App\Adequacy;
use App\Lenguage;
use App\Document;
use App\Book_movement;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SaveMultimediaRequest;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_multimedia;
use App\Copy;
use App\Ml_document;
use App\Ml_movie;
use Illuminate\Support\Facades\Auth;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idd = 'none'; //con esto indico q no tiene q filtrar por un cine solo
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

        // $this->authorize('view', new Multimedia);

        return view('admin.multimedias.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'    => Multimedia::pluck('gender', 'gender')
             // replicar esto FIN 
 
        ]);
    }

    public function indexsolo(Request $request, $idd, $tipo)
    {         
    //   dd($tipo);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');


        //cargo el idioma
        $idioma             = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_document    = Ml_document::where('many_lenguages_id',$session)->first();
        $idioma_movie       = Ml_movie::where('many_lenguages_id',$session)->first();
        $setting            = Setting::where('id', 1)->first();
        $idiomas            = ManyLenguages::all();

        if($tipo != 'n'){ // cuando es n es porque se quiere editar pero ya se definio el tipo de doc

            $edicion_doc = Document::where('id', $idd)->first();  

            if($edicion_doc->document_types_id != $tipo){

                if($tipo == 4){ //si es cine
                    $new_multimedia = new Multimedia();
                    $new_multimedia->documents_id = $edicion_doc->id;
                    $new_multimedia->second_author_id = 100;
                    $new_multimedia->third_author_id = 100;     
                }

                if($edicion_doc->document_types_id != 100){ // si es distinto de 100 tiene q borrar el q corresponda q tenia
                    
                        if($edicion_doc->document_types_id == 1){ //eliminacion musica
                            $edicion_music = Music::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_music->destroy();
                        }
                        if($edicion_doc->document_types_id == 3){ //eliminacion libros
                            $edicion_book = Book::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_book->destroy();
                        }
                        if($edicion_doc->document_types_id == 2){ //eliminacion libros
                            $edicion_movie = Movies::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_book->destroy();
                        }
                        if($edicion_doc->document_types_id == 5){ //eliminacion fotografia
                            $edicion_fotografia = Photography::where('documents_id', '=', $edicion_doc->id)->delete();
                            // $edicion_fotografia->destroy();        
                        }
                }
                // else{ 
                    // aqui hay que levantar los datos q quedaron pendientes en notas por el hecho de q apuntan a ser de uan tabla la cual se define cuando se elige que subtipo es.
                    $datos_pendientes = $edicion_doc->temprebecca;
                    $edicion_doc->note = trim($datos_pendientes);

                // }

                $edicion_doc->document_types_id = $tipo;
                $edicion_doc->save();
                $new_multimedia->save();
            }
                
        }
        
        // $this->authorize('view', new Movies); 
        // dd($idd);
        return view('admin.multimedias.index', [
            'idioma'            => $idioma,
            'idioma_document'   => $idioma_document,
            'idioma_movie'      => $idioma_movie,
            'idiomas'           => $idiomas,
            'setting'           => $setting,
            'idd'           => $idd,
            
             // replicar esto INICIO (arriba vas a tener q importar los "use" que correspondan)
             'references' => Generate_reference::pluck('reference_description', 'id'),
             'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'), 
             'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
             'genders'    => Multimedia::pluck('gender', 'gender')
             // replicar esto FIN 
        ]); 
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
        
        // $this->authorize('create', $multimedia); 
                              
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
    public function store(SaveMultimediaRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                // $this->authorize('create', new Multimedia);
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
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));           
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');               
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
                $document->synopsis         = $request->get('synopsis');

                if ($request->hasFile('photo')) {               

                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{                
                    $name = 'doc-default.jpg';
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
                    if( (trim($request->get('second_author_id')) != null) && (trim($request->get('second_author_id')) != "") ){
                            
                            $creator = new Creator;
                            $creator->creator_name = $request->get('second_author_id');
                            $creator->document_types_id = 2;
                            $creator->save();
                            $multimedia->second_author_id = $creator->id;
                    }
                }
                // $multimedia->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $multimedia->third_author_id    = $request->get('third_author_id');    
 
                }else{
                    if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){     
                        $creator = new Creator;
                        $creator->creator_name = $request->get('third_author_id');
                        $creator->document_types_id = 2;
                        $creator->save();
                        $multimedia->third_author_id = $creator->id;
                    }
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
      
        $id_docu = $multimedia->documents_id;

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
        
        // $this->authorize('view', $multimedia);

        return view('admin.multimedias.show', compact('multimedia'), [
            'idioma_doc'        => $idioma_doc,
            'idioma_multimedia' => $idioma_multimedia,
            'disabled'          => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]);
        
        // return view('admin.multimedias.show', compact('multimedia'));
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
                 
        // $this->authorize('update', $multimedia);
        $id_docum = $document->id;
        // $verifi_copies = Book_movement::with('movement_type','copy.document.creator','user')
        // ->whereHas('copy', function($q) use ($id_docum)
        // {
        //     $q->where('documents_id', '=', $id_docum)->where(function ($query) {
        //         $query->where('status_copy_id', '=', 1)
        //               ->orWhere('status_copy_id', '=', 2)
        //               ->orWhere('status_copy_id', '=', 7);
        //     });
        // })
        // ->where('active', 1) 
        // ->where(function ($query) {
        //     $query->where('movement_types_id', '=', 1)
        //           ->orWhere('movement_types_id', '=', 2)
        //           ->orWhere('movement_types_id', '=', 7);
        // })    
        // ->get();

        // if($verifi_copies->count() > 0){

        //     return view('admin.multimedias.partials.form_no_disp'); 

        // }else{
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
        // }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMultimediaRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                              
                $multimedia = Multimedia::findOrFail($id);
                $document   = Document::findOrFail($multimedia->documents_id);
                
                // $this->authorize('update', $multimedia);  

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
                $document->acquired         = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));                 
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->let_author       = $request->get('let_author');
                $document->let_title        = $request->get('let_title');
                $document->generate_subjects_id     = $request->get('generate_subjects_id');  
                $document->assessment       = $request->get('assessment'); 
                
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
                $document->synopsis             = $request->get('synopsis');

                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                }else{                
                    $name = 'doc-default.jpg';
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
                    
                    if( (trim($request->get('second_author_id')) != null) && (trim($request->get('second_author_id')) != "") ){    
                        $creator = new Creator;
                        $creator->creator_name      = $request->get('second_author_id');
                        $creator->document_types_id = 2;
                        $creator->save();
                        $multimedia->second_author_id = $creator->id;
                    }
                }
                // $multimedia->third_author    = $request->get('third_author');
                if( is_numeric($request->get('third_author_id'))) 
                {                
                    $multimedia->third_author_id = $request->get('third_author_id');    

                }else{
                    if( (trim($request->get('third_author_id')) != null)  && (trim($request->get('third_author_id')) != "") ){     
                        $creator = new Creator;
                        $creator->creator_name       = $request->get('third_author_id');
                        $creator->document_types_id  = 2;
                        $creator->save();
                        $multimedia->third_author_id = $creator->id;
                    }
                }
                 
                $multimedia->translator     = $request->get('translator');
                $multimedia->isbn           = $request->get('isbn');
                $multimedia->edition        = $request->get('edition');
                $multimedia->size           = $request->get('size');             
                $multimedia->documents_id   = $document->id;//guardamos el id del documento                
                $multimedia->save();
   
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
     * @param  \App\multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(multimedia $multimedia)
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
        $idioma_multimedia = ml_show_multimedia::where('many_lenguages_id',$session)->first();
        $multimedia = Multimedia::with('document.creator',  'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
        $setting = Setting::where('id', 1)->first();
        $id_docu = $multimedia->documents_id;

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
        
        if($copies_disponibles->count() > 0){          
            $disabled = '';
            $label_copia_no_disponible = '';
        }else{
            $disabled = 'disabled';         
            $label_copia_no_disponible = 'Documento Sin Copias Disponibles';
        }
        $pdf = PDF::loadView('admin.multimedias.exportPDF', compact('multimedia'),[
            'idioma_doc'                => $idioma_doc,
            'idioma_multimedia'         => $idioma_multimedia, 
            'disabled'                  => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible,
            'setting'                   => $setting
        ]);  
    
        return $pdf->download('multimedia.pdf');
    }
    
    public function desidherata($id)
    {
        $document = Document::findOrFail($id);
        $document->status_documents_id = 3;
        $document->desidherata = 1;    
        $document->save();

        

        $prestamos_en_cancelacion = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        })
        ->where('active', 1)
        ->where('movement_types_id', 9)  
        ->get();

        if($prestamos_en_cancelacion->count() > 0){//si encuentra actualmente copias en prestamo .

        foreach($prestamos_en_cancelacion as $prestam){
            $prestam->active = 0;
            // $prestam->save();
            
            $new_movement = new Book_movement;
            $new_movement->movement_types_id = 6;
            $new_movement->copies_id = $prestam->copies_id;
            $new_movement->active = 1;
            $new_movement->date = Carbon::now();  

            $copy = Copy::findOrFail($prestam->copies_id); //solo en este caso se setea la copia en 9, osea cancelacion por baja documento.sino al dar de baja un documento nunca se 
            // toca el estado de las copias cuando se da de baja el documento ya que siempre se valida que el doc este activo, solo en este caso q hay prestamos activos referenciados a una copia X
            $copy->status_copy_id = 6;
            $prestam->save();
            $new_movement->save(); 
            $copy->save();
        }
    }

    }
    

    public function baja($id)
    {
        $document = Document::findOrFail($id);
        
        // S : obviamnete se importo desde rebecca y aun no se aprobo, asi q si es rechazado se elimina
        // N : en algun momento fue aprobado entonces cuando se de de baja no lo va a eliminar.
        if($document->status_rebecca == 'S'){    
            $delete_docu = Document::where('id', '=', $document->id)->delete();
            $delete_multimedia = Multimedia::where('documents_id', '=', $document->id)->delete();                   
        }else{
        
        $document->status_documents_id = 2;
        $document->desidherata = 0;   
        $document->save();

        $prestamos_vigentes_del_doc = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        })
        ->where('active', 1)
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
        })  
        ->get();

        if($prestamos_vigentes_del_doc->count() > 0){//si encuentra actualmente copias en prestamo .

        foreach($prestamos_vigentes_del_doc as $prestam){
            $prestam->active = 0;
            // $prestam->save();
            
            $new_movement = new Book_movement;
            $new_movement->movement_types_id = 9;
            $new_movement->users_id = $prestam->users_id;
            $new_movement->copies_id = $prestam->copies_id;
            $new_movement->active = 1;
            $new_movement->date = Carbon::now();  

            $copy = Copy::findOrFail($prestam->copies_id); //solo en este caso se setea la copia en 9, osea cancelacion por baja documento.sino al dar de baja un documento nunca se 
            // toca el estado de las copias cuando se da de baja el documento ya que siempre se valida que el doc este activo, solo en este caso q hay prestamos activos referenciados a una copia X
            $copy->status_copy_id = 9;
            $prestam->save();
            $new_movement->save();
            $copy->save();
        }
    }
    }
    }

    public function reactivar($id)
    {
        $document = Document::findOrFail($id);
        // dd($document);
        $document->status_documents_id = 1;
        $document->desidherata = 0; 
        $document->status_rebecca = 'N';  
        $document->save();

        
        $prestamos_en_cancelacion = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        })
        ->where('active', 1)
        ->where('movement_types_id', 9)  
        ->get();

        if($prestamos_en_cancelacion->count() > 0){//si encuentra actualmente copias en prestamo .

        foreach($prestamos_en_cancelacion as $prestam){
            $prestam->active = 0;
            // $prestam->save();
            
            $new_movement = new Book_movement;
            $new_movement->movement_types_id = 6;
            $new_movement->copies_id = $prestam->copies_id;
            $new_movement->active = 1;
            $new_movement->date = Carbon::now();  

            $copy = Copy::findOrFail($prestam->copies_id); //solo en este caso se setea la copia en 9, osea cancelacion por baja documento.sino al dar de baja un documento nunca se 
            // toca el estado de las copias cuando se da de baja el documento ya que siempre se valida que el doc este activo, solo en este caso q hay prestamos activos referenciados a una copia X
            $copy->status_copy_id = 6;
            $prestam->save();
            $new_movement->save(); 
            $copy->save();
        }
    }

    }

    public function copy($id)
    {
        
        $document = Document::findOrFail($id);
        // if($document->status_documents_id == 2){
        //     return response()->json(['data' => 0]);      
        // }else{
            return response()->json(['data' => $document->id]); 
        // }  
    }

    public function dataTable(Request $request)
    {   
        $idd_bis = 'none';
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
        //  dd($request->get('indexsolo')); 
         if($request->get('indexsolo') != ''){
            // dd('entro');
            $indexsolo_mostrar = true;
            $idd_bis = $request->get('indexsolo');  
        }else{
            // dd('NO entro');
            $indexsolo_mostrar = false;      
        }
        // dd($indexsolo_mostrar);
        // dd($idd_bis);

        if(Auth::user()->getRoleNames() == 'Partner'){
        $multimedia = Multimedia::with('document.creator', 'document', 'document.status_document') 
        ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request, $references_mostrar, $indexsolo_mostrar)
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
        // ->allowed()
        ->get();
        }else{
            $multimedia = Multimedia::with('document.creator', 'document', 'document.status_document') 
            ->whereHas('document', function($q) use($subjects_mostrar, $adaptations_mostrar, $request, $references_mostrar, $indexsolo_mostrar)
                {
                    
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
            // ->allowed()
            ->get();        
        }
         
        return dataTables::of($multimedia)
            ->addColumn('id_doc', function ($multimedia){
            return $multimedia->document['id']."<br>";            
            })                        
            ->addColumn('documents_id', function ($multimedia){
                return
                    '<i class="fa fa-music"></i>'.' '.$multimedia->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$multimedia->document->creator['creator_name']."<br>";         
            })
            ->addColumn('photo', function ($multimedia){                
                $url=asset("./images/". $multimedia->document['photo']); 
                return '<img src='.$url.' border="0" width="80" height="80" class="img-rounded" align="center" />';
               
            })
            ->addColumn('status', function ($multimedia){

                return'<span class="'.$multimedia->document->status_document['color'].'">'.' '.$multimedia->document->status_document['name_status'].'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })                       
            ->addColumn('created_at', function ($multimedia){
                return $multimedia->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($multimedia) use($idd_bis) {
                return view('admin.multimedias.partials._action', [
                    'multimedia'        => $multimedia,
                    'url_show'          => route('admin.multimedias.show', $multimedia->id),                        
                    'url_edit'          => route('admin.multimedias.edit', $multimedia->id),                              
                    'url_copy'          => route('multimedias.copy', $multimedia->document->id),                              
                    'url_desidherata'   => route('multimedias.desidherata', $multimedia->document->id),
                    'url_baja'          => route('multimedias.baja', $multimedia->document->id),
                    'url_reactivar'     => route('multimedias.reactivar', $multimedia->document->id),
                    'url_print'         => route('multimedia.pdf', $multimedia->id),   
                    'idd' => $idd_bis
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'documents_id', 'photo', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
