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
use App\Book_movement;
use App\Generate_subjects;
use App\Generate_reference;
use App\StatusDocument;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_show_doc;
use App\ml_show_multimedia;

class VMultimediaController extends Controller
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
        $idiomas    = ManyLenguages::all();
        $setting    = Setting::where('id', 1)->first();  

        return view('web.multimedias.index', [
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
      
        $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id)->where(function ($query) {
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

        return view('web.multimedias.show', compact('multimedia'), [
            'idioma_doc'        => $idioma_doc,
            'idioma_multimedia' => $idioma_multimedia,
            'disabled'          => $disabled,
            'label_copia_no_disponible' => $label_copia_no_disponible
        ]);
        // return view('web.multimedias.show', compact('multimedia'));
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
