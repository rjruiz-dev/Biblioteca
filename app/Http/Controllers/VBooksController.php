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
use App\Book_movement;
use Illuminate\Http\Request;
use App\Periodical_publication;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_book;

class VBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request->session()->put('idiomas', 2);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idioma_doc     = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_book    = ml_show_book::where('many_lenguages_id',$session)->first();
        $setting        = Setting::where('id', 1)->first();        
        $idiomas        = ManyLenguages::all();

        return view('web.books.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas,
            'idioma_doc' => $idioma_doc,
            'idioma_book'=> $idioma_book,
            'setting'    => $setting
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

        //cargo el idioma
        $idioma_doc = ml_show_doc::where('many_lenguages_id',$session)->first();
        $idioma_book = ml_show_book::where('many_lenguages_id',$session)->first();
        
        $book = Book::with('document.creator', 'generate_book', 'document.adequacy', 'document.lenguage', 'document.subjects', 'document.document_subtype', 'periodical_publication','periodical_publication.periodicidad','second_author','third_author')->findOrFail($id);

        $id_docu = $book->documents_id;

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

        return view('web.books.show', compact('book'), [
            'idioma_doc'    => $idioma_doc,
            'idioma_book'   => $idioma_book,
            'disabled'      => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible 
        ]); 

        // $book = Book::with('document.creator', 'generate_book', 'document.adequacy', 'document.lenguage', 'document.subjects', 'document.document_subtype', 'periodical_publication','periodical_publication.periodicidad')->findOrFail($id);
         
        // return view('web.books.show', compact('book'));
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
        // $libros = Book::with('document.creator', 'document.document_subtype', 'document.lenguage','generate_book') 
        // ->get();
        
        $libros = Book::with('document.creator', 'document.document_subtype', 'document','document.lenguage','generate_book') 
        ->whereHas('document', function($q)
        {
            // $q->where(function ($query) {
            //     $query->where('status_documents_id', '=', 1);
            // });
            $q->where('status_documents_id', '=', 1);
        })
        // ->allowed()
        ->get();

        return dataTables::of($libros)
            ->addColumn('id_doc', function ($libros){
                return $libros->document['id']."<br>";            
            }) 
            ->addColumn('documents_id', function ($libros){
                return
                    '<i class="fa fa-book"></i>'.' '.$libros->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$libros->document->creator->creator_name."<br>";         
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
                return view('web.books.partials._action', [
                    'libros'            => $libros,
                    'url_show'          => route('web.libros.show', $libros->id),                        
                   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'document_subtypes_id', 'registry_number', 'generate_books_id', 'documents_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
