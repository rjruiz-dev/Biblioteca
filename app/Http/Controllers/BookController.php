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
                             
        return view('admin.books.partials.form', [           
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'    => Generate_reference::pluck('reference_description', 'id'),
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 3)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id')->toArray(),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'editions'      => Book::pluck('edition', 'id'),         
            'periodicities' => Periodicity::pluck('periodicity_name', 'id'),
            'volumes'       => Document::pluck('volume', 'volume'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'book'          => $book
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
                $document->registry_number  = $request->get('registry_number');
                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));             
                $document->let_author       = $request->get('let_author');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->let_title        = $request->get('let_title');
                $document->assessment       = $request->get('assessment');  
                $document->desidherata      = $request->get('desidherata');
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
                
                $document->photo            = $request->get('photo');
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->lenguages_id     = $request->get('lenguages_id');    
                $document->generate_references_id     = $request->get('generate_references_id');            
                $document->document_types_id    = 3;
                $document->document_subtypes_id = $request->get('document_subtypes_id');
                $document->save();

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
                
                $book->translator       = $request->get('translator');        
                $book->edition          = $request->get('edition');
                $book->size             = $request->get('size');  
                $book->isbn             = $request->get('isbn');               
                $book->generate_books_id= $request->get('generate_books_id');         
                $book->documents_id     = $document->id;
                $book->save();

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
      
        return view('admin.books.partials.form', [          
            'subjects'      => Generate_subjects::orderBy('id','ASC')->get()->pluck('name_and_cdu', 'id'),
            'references'    => Generate_reference::pluck('reference_description', 'id'),
            'documents'     => Document_type::pluck( 'document_description', 'id'),
            'subtypes'      => Document_subtype::where('document_types_id', 3)->get()->pluck('subtype_name', 'id'),
            'authors'       => Creator::pluck('creator_name', 'id')->toArray(),
            'adaptations'   => Adequacy::pluck('adequacy_description', 'id'),
            'genders'       => Generate_book::pluck('genre_book', 'id'),
            'publications'  => Document::pluck('published', 'published'),
            'editorials'    => Document::pluck('made_by', 'made_by'),
            'editions'      => Book::pluck('edition', 'id'),
            'periodicities' => Periodicity::pluck('periodicity_name', 'id'),
            'volumes'       => Document::pluck('volume', 'id'),
            'languages'     => Lenguage::pluck('leguage_description', 'id'),
            'book'          => $book
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
                    $creator = new Creator;
                    $creator->creator_name  = $request->get('creators_id');
                    $creator->document_types_id = 3;
                    $creator->save();
                    $document->creators_id = $creator->id;
                }             
                $document->title            = $request->get('title');
                $document->registry_number  = $request->get('registry_number');
                $document->original_title   = $request->get('original_title');
                $document->acquired         = Carbon::createFromFormat('d/m/Y', $request->get('acquired'));                    
                $document->let_author       = $request->get('let_author');
                $document->generate_subjects_id = $request->get('generate_subjects_id');  
                $document->let_title        = $request->get('let_title');
                $document->assessment       = $request->get('assessment');  
                $document->desidherata      = $request->get('desidherata');
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
                $document->photo            = $request->get('photo');
                $document->adequacies_id    = $request->get('adequacies_id');
                $document->lenguages_id     = $request->get('lenguages_id');     
                $document->generate_references_id     = $request->get('generate_references_id');     
                $document->document_types_id    = 3;
                $document->document_subtypes_id = $request->get('document_subtypes_id'); 
                $document->save();



                // Actualizamos el libro               
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
               // $book->third_author    = $request->get('third_author');
               if( is_numeric($request->get('third_author_id'))) 
                {                
                    $book->third_author_id  = $request->get('third_author_id');    

                }else{
                    
                    $creator = new Creator;
                    $creator->creator_name = $request->get('third_author_id');
                    $creator->document_types_id = 2;
                    $creator->save();
                    $book->third_author_id = $creator->id;
                }
               
                $book->translator       = $request->get('translator');        
                $book->edition          = $request->get('edition');
                $book->size             = $request->get('size');  
                $book->isbn             = $request->get('isbn');               
                $book->generate_books_id= $request->get('generate_books_id'); 
                $book->documents_id     = $document->id;
                $book->save();
                 
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
    public function destroy($id)
    {
        $book       = Book::findOrFail($id);
        $document   = Document::findOrFail($book->documents_id);    
        $book->delete(); 
        $document->delete();     
    }

    public function dataTable()
    {   
        $libros = Book::with('document.creator', 'document.document_subtype', 'document.lenguage','generate_book') 
        // ->allowed()
        ->get();
        // dd($libros);       
        return dataTables::of($libros)
            ->addColumn('registry_number', function ($libros){
                return $libros->document['registry_number']."<br>";            
            }) 
            ->addColumn('document_subtypes_id', function ($libros){

                return  $libros->document->document_subtype->subtype_name;              
            }) 
            ->addColumn('generate_books_id', function ($libros){
                return $libros->generate_book['genre_book'];              
            }) 
            ->addColumn('documents_id', function ($libros){
                return
                    '<i class="fa fa-book"></i>'.' '.$libros->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$libros->document->creator->creator_name."<br>";         
            }) 
            ->addColumn('lenguages_id', function ($libros){

                return'<i class="fa  fa-globe"></i>'.' '.$libros->document->lenguage->leguage_description;         
            })            
            ->addColumn('created_at', function ($libros){
                return $libros->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($libros) {
                return view('admin.books.partials._action', [
                    'libros' => $libros,
                    'url_show' => route('admin.books.show', $libros->id),                        
                    'url_edit' => route('admin.books.edit', $libros->id),                              
                    'url_destroy' => route('admin.books.destroy', $libros->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['document_subtypes_id', 'registry_number', 'generate_books_id', 'documents_id', 'lenguages_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
