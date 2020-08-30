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

class VMultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.multimedias.index'); 
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
        $multimedia = Multimedia::with('document.creator',  'document.adequacy', 'document.lenguage', 'document.subjects')->findOrFail($id);
      
        return view('web.multimedias.show', compact('multimedia'));
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
        $multimedia = Multimedia::with('document.creator', 'document.status_document')
        ->get();
         
        return dataTables::of($multimedia)
            ->addColumn('id_doc', function ($multimedia){
            return $multimedia->document['id']."<br>";            
            })                        
            ->addColumn('documents_id', function ($multimedia){
                return
                    '<i class="fa fa-music"></i>'.' '.$multimedia->document['title']."<br>".
                    '<i class="fa fa-user"></i>'.' '.$multimedia->document->creator->creator_name."<br>";         
            })
            ->addColumn('status', function ($multimedia){

                return'<span class="'.$multimedia->document->status_document->color.'">'.' '.$multimedia->document->status_document->name_status.'</span>';
                   
            })                       
            ->addColumn('created_at', function ($multimedia){
                return $multimedia->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($multimedia) {
                return view('web.multimedias.partials._action', [
                    'multimedia'        => $multimedia,
                    'url_show'          => route('web.multimedia.show', $multimedia->id),                        
                  
                ]);

            })           
            ->addIndexColumn()   
            ->rawColumns(['id_doc', 'documents_id', 'status', 'created_at', 'accion']) 
            ->make(true);  
    }
}
