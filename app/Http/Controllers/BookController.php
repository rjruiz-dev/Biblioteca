<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Book;
use App\Creator;
use App\Adequacy;
use App\Document;
use App\Lenguage;
use App\Periodicity;
use App\Generate_book;
use App\Document_type;
use App\Document_subtype;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use Illuminate\Http\Request;
use App\Periodical_publication;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveDocumentRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book();
        $document = new Document();       
                             
        return view('admin.books.partials.form', [           
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'        => Generate_reference::all(),
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 3)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id')->toArray(),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'editions'      => Book::pluck('edition', 'edition'),         
            'periodicities' => Periodicity::pluck('periodicity_name', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'book'          => $book,
            'document'          => $document
            
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
                $document->document_types_id        = 3; // 1 tipo de documento: musica.
                $document->document_subtypes_id     = $request->get('document_subtypes_id'); 
                $document->title            = $request->get('title');
                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));             
                $document->let_author       = $request->get('let_author');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
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
                $document->synopsis         = $request->input('synopsis');
              
                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id    = $request->get('creators_id');    

                }else{

                    $creator = new Creator;
                    $creator->creator_name      = $request->get('creators_id');
                    $creator->document_types_id = 3;
                    $creator->save();
                    $document->creators_id = $creator->id;
                }
                
                // $document->photo            = $request->get('photo');
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->lenguages_id     = $request->get('lenguages_id');    
                // $document->generate_references_id     = $request->get('generate_references_id');            
                $document->document_types_id    = 3;
                $document->document_subtypes_id = $request->get('document_subtypes_id');


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


                // Creamos el libro           
                $book = new Book;   
                $book->subtitle = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $book->second_author_id = $request->get('second_author_id');    

                }else{
                    $creator = new Creator;
                    $creator->creator_name      = $request->get('second_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $book->second_author_id     = $creator->id;
                }
               
                if($request->get('document_subtypes_id') != 4){
               if( is_numeric($request->get('third_author_id'))) 
                {                 
                    $book->third_author_id = $request->get('third_author_id');    

                }else{
                    
                    $creator = new Creator;
                    $creator->creator_name      = $request->get('third_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $book->third_author_id      = $creator->id;
                }
            }
                
                $book->translator       = $request->get('translator');        
                $book->edition          = $request->get('edition');
                $book->size             = $request->get('size');  
                $book->isbn             = $request->get('isbn');               
                $book->generate_books_id= $request->get('generate_books_id');         
                $book->documents_id     = $document->id;
                $book->save();


                if($request->get('document_subtypes_id') == 4){ // si es PUBL PERIODICA
                    $periodical_publication = new Periodical_publication;   
                    $periodical_publication->volume_number_date      = $request->get('volume_number_date');
                    $periodical_publication->periodicities_id = $request->get('periodicities_id');
                    $periodical_publication->issn      = $request->get('issn');
                    $periodical_publication->books_id      = $book->id; //guardamos el id del libro
                    $periodical_publication->save();

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
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with('document', 'generate_book', 'periodical_publication.periodicidad')->findOrFail($id);       
        $document = Document::findOrFail($book->documents_id);


        return view('admin.books.partials.form', [          
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'        => Generate_reference::all(),
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 3)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id')->toArray(),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'editions'      => Book::pluck('edition', 'edition'), 
            'periodicities' => Periodicity::pluck('periodicity_name', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'status_documents' => StatusDocument::pluck('name_status', 'id'), 
            'book'          => $book,
            'document'          => $document
            // 'periodical' => $periodical
        ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(SaveDocumentRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $book = Book::findOrFail($id);
                
                $document = Document::findOrFail($book->documents_id);
                // Actualizamos el documento   
                if( is_numeric($request->get('creators_id'))) 
                {                
                    $document->creators_id = $request->get('creators_id');    

                }else
                {
                    if($request->get('creators_id') != null){
                    $creator = new Creator;
                    $creator->creator_name  = $request->get('creators_id');
                    $creator->document_types_id = 3;
                    $creator->save();
                    $document->creators_id = $creator->id;
                    }
                }             
                $document->title            = $request->get('title');
                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));                    
                $document->let_author       = $request->get('let_author');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->let_title        = $request->get('let_title');
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
                $document->year             = Carbon::createFromFormat('Y', $request->get('year'));
                $document->volume           = $request->get('volume');
                $document->quantity_generic = $request->get('quantity_generic');
                $document->collection       = $request->get('collection');
                $document->location         = $request->get('location');
                $document->observation      = $request->get('observation');
                $document->note             = $request->get('note');
                $document->synopsis         = $request->input('synopsis');
                // $document->photo            = $request->get('photo');
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->lenguages_id     = $request->get('lenguages_id');     
                // $document->generate_references_id     = $request->get('generate_references_id');     
                $document->document_types_id    = 3;

                $subtypes_id = $document->document_subtypes_id;

                $document->document_subtypes_id = $request->get('document_subtypes_id'); 


                $name = $document->photo; 
                if ($request->hasFile('photo')) {               
                    $file = $request->file('photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                }
                $document->photo = $name; 


                $document->save();
                $document->syncReferences($request->get('references'));



                // Actualizamos el libro               
                $book->subtitle = $request->get('subtitle');
                if( is_numeric($request->get('second_author_id'))) 
                {                
                    $book->second_author_id = $request->get('second_author_id');    

                }else{
                    
                    if($request->get('second_author_id') != null){
                    $creator = new Creator;
                    $creator->creator_name      = $request->get('second_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $book->second_author_id     = $creator->id;
                    }
                }
               // $book->third_author    = $request->get('third_author');
               if($request->get('document_subtypes_id') != 4){// si es NO ES PUBL PERIODICA
               if( is_numeric($request->get('third_author_id'))) 
                {                
                    $book->third_author_id  = $request->get('third_author_id');    

                }else{

                    if($request->get('third_author_id') != null){
                    $creator = new Creator;
                    $creator->creator_name = $request->get('third_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $book->third_author_id = $creator->id;
                }

                }
            }
               
                $book->translator       = $request->get('translator');        
                $book->edition          = $request->get('edition');
                $book->size             = $request->get('size');  
                $book->isbn             = $request->get('isbn');               
                $book->generate_books_id= $request->get('generate_books_id'); 
                $book->documents_id     = $document->id;
                $book->save();

                if($request->get('document_subtypes_id') == 4){ // si es PUBL PERIODICA
                    $periodical_publication = Periodical_publication::where('books_id', $id)->first();
                    if($periodical_publication == null){
                        $periodical_publication  = new Periodical_publication;
                    }
                    
                    $periodical_publication->volume_number_date = $request->get('volume_number_date');
                    $periodical_publication->periodicities_id = $request->get('periodicities_id');
                    $periodical_publication->issn      = $request->get('issn');
                    $periodical_publication->books_id  = $book->id; //guardamos el id del libro
                    $periodical_publication->save();

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
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $book       = Book::findOrFail($id);
    //     $document   = Document::findOrFail($book->documents_id);    
    //     $book->delete(); 
    //     $document->delete();     
    // }

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
        $libros = Book::with('document.creator', 'document.document_subtype', 'document.lenguage','generate_book') 
        // ->allowed()
        ->get();
        // dd($libros);       
        return dataTables::of($libros)
        ->addColumn('id_doc', function ($libros){
            return $libros->document['id']."<br>";            
        }) 
            ->addColumn('registry_number', function ($libros){
                return $libros->document['registry_number']."<br>";            
            }) 
            ->addColumn('document_subtypes_id', function ($libros){

                return  $libros->document->document_subtype->subtype_name;              
            }) 
            ->addColumn('generate_books_id', function ($libros){
                if($libros->generate_book['genre_book'] == null){
                    return 'Sin Genero';
                }else{
                    return $libros->generate_book['genre_book'];              
                }
            }) 
            ->addColumn('documents_id', function ($libros){
                return
                    '<i class="fa fa-book"></i>'.' '.$libros->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$libros->document->creator->creator_name."<br>";         
            }) 
            ->addColumn('lenguages_id', function ($libros){ 
                if($libros->document->lenguage->leguage_description == null){
                    return 'Sin Lenguaje';
                }else{ 
                    return'<i class="fa  fa-globe"></i>'.' '.$libros->document->lenguage->leguage_description;         
                } 
            }) 
            ->addColumn('status', function ($libros){

                return'<span class="'.$libros->document->status_document->color.'">'.' '.$libros->document->status_document->name_status.'</span>';
                // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            })           
            ->addColumn('created_at', function ($libros){
                return $libros->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($libros) {
                return view('admin.books.partials._action', [
                    'libros' => $libros,
                    'url_show' => route('admin.books.show', $libros->id),                        
                    'url_edit' => route('admin.books.edit', $libros->id),
                    'url_copy' => route('books.copy', $libros->document->id),                              
                    'url_desidherata' => route('books.desidherata', $libros->document->id),
                    'url_baja' => route('books.baja', $libros->document->id),
                    'url_reactivar' => route('books.reactivar', $libros->document->id)
                    ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'document_subtypes_id', 'registry_number', 'generate_books_id', 'documents_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
