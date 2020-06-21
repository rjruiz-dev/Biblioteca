<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    public function dataTable()
    {                    
        $documentos = Document::with('document_type','creators') 
        if($documentos->document_types_id == 'Inactivo'){    

            return '<span class="label label-danger sm">'.$documentos->statu['state_description'].'</span>';
        }      
        // ->allowed()
        ->get();
      
        return dataTables::of($documentos)
            ->addColumn('document_types_id', function ($documentos){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$documentos->document_types['document_description'];              
            })   
            ->addColumn('title', function ($documentos){
                return
                    '<i class="fa fa-user"></i>'.' '.$documentos->title."<br>";            
            }) 
            ->addColumn('registry_number', function ($documentos){
                return
                    '<i class="fa fa-user"></i>'.' '.$documentos->registry_number."<br>";            
            }) 
            ->addColumn('creators_id', function ($documentos){
                return
                    '<i class="fa fa-user"></i>'.' '.$documentos->creators['creator_name']."<br>";            
            }) 
                     
            ->addColumn('status_id', function ($documentos){

                if($documentos->statu['state_description'] == 'Inactivo'){    

                    return '<span class="label label-danger sm">'.$documentos->statu['state_description'].'</span>';
                }
                if ($documentos->statu['state_description'] == 'Pendiente'){

                    return '<span class="label label-warning sm">'.$documentos->statu['state_description'].'</span>';

                }else{

                    return '<span class="label label-success sm">'.$documentos->statu['state_description'].'</span>';
                }              
            })    
            ->addColumn('created_at', function ($documentos){
                return $documentos->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($documentos) {
                return view('admin.users.partials._action', [
                    'usuarios' => $documentos,
                    'url_show' => route('admin.users.show', $documentos->id),                        
                    'url_edit' => route('admin.users.edit', $documentos->id),                              
                    'url_destroy' => route('admin.users.destroy', $documentos->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['name', 'email', 'status_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
