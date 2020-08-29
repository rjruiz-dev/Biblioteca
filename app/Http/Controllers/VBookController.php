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
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SaveBookRequest;

class VBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index');
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
    public function show($id)
    {
        $book = Book::with('document.creator', 'generate_book', 'document.adequacy', 'document.lenguage', 'document.subjects', 'document.document_subtype', 'periodical_publication','periodical_publication.periodicidad')->findOrFail($id);
     
        return view('admin.books.show', compact('book'));
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
        $libros = Book::with('document.creator', 'document.document_subtype', 'document.lenguage','generate_book') 
        // ->allowed()
        ->get();
        // dd($libros);       
        return dataTables::of($libros)
            ->addColumn('id_doc', function ($libros){
                return $libros->document['id']."<br>";            
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
                return view('books.partials._action', [
                    'libros'            => $libros,
                    'url_show'          => route('books.show', $libros->id),                        
                   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'document_subtypes_id', 'registry_number', 'generate_books_id', 'documents_id', 'lenguages_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}