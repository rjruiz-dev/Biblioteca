<?php

namespace App\Http\Controllers;

use App\ManyLenguages;
use App\Ml_dashboard;
use DataTables;
use Illuminate\Http\Request;
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
use App\Periodical_publication;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\SaveBookRequest;

class ManyLenguagesController extends Controller
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
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
        // dd($idioma->navegacion);
        return view('admin.manylenguages.index', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idioma = new ManyLenguages; 

        $ml_dashboard = new Ml_dashboard;

        return view('admin.manylenguages.partials.form', [          
            'idioma'      => $idioma,
            'ml_dashboard'    => $ml_dashboard,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                // Creamos el documento            
                $idioma = new ManyLenguages;
                $idioma->lenguage_description = $request->get('idioma');
                $idioma->baja = 0;
                $idioma->save();
                
                $ml_dashboard = new Ml_dashboard;
                $ml_dashboard->inicio            = $request->get('inicio');
                $ml_dashboard->libros   = $request->get('libros');
                $ml_dashboard->cines       = $request->get('cines');
                $ml_dashboard->musica = $request->get('musica');  
                $ml_dashboard->fotografia        = $request->get('fotografia');
                $ml_dashboard->multimedia       = $request->get('multimedia');  
                $ml_dashboard->biblioteca       = $request->get('biblioteca');  
                $ml_dashboard->iniciar_sesion       = $request->get('iniciar_sesion');  
                $ml_dashboard->registrarse       = $request->get('registrarse');  
                $ml_dashboard->navegacion       = $request->get('navegacion');  
                $ml_dashboard->invitado       = $request->get('invitado');  
                $ml_dashboard->en_linea       = $request->get('en_linea');  
                
                $ml_dashboard->many_lenguages_id = $idioma->id;
                $ml_dashboard->save();

                DB::commit();

                // return response()->json(['data' => $document->id, 'bandera' => 1]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function show(ManyLenguages $manyLenguages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idioma = ManyLenguages::findOrFail($id); 

        $ml_dashboard = Ml_dashboard::where('many_lenguages_id', $idioma->id)->first();

        return view('admin.manylenguages.partials.form', [          
            'idioma'      => $idioma,
            'ml_dashboard'    => $ml_dashboard,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                // Creamos el documento            
                $idioma = ManyLenguages::findOrFail($id);

                $idioma->lenguage_description = $request->get('idioma');
                $idioma->save();
                
                $ml_dashboard = Ml_dashboard::where('many_lenguages_id', $idioma->id)->first();

                $ml_dashboard->inicio            = $request->get('inicio');
                $ml_dashboard->libros   = $request->get('libros');
                $ml_dashboard->cines       = $request->get('cines');
                $ml_dashboard->musica = $request->get('musica');  
                $ml_dashboard->fotografia        = $request->get('fotografia');
                $ml_dashboard->multimedia       = $request->get('multimedia');  
                $ml_dashboard->biblioteca       = $request->get('biblioteca');  
                $ml_dashboard->iniciar_sesion       = $request->get('iniciar_sesion');  
                $ml_dashboard->registrarse       = $request->get('registrarse');  
                $ml_dashboard->navegacion       = $request->get('navegacion');  
                $ml_dashboard->invitado       = $request->get('invitado');  
                $ml_dashboard->en_linea       = $request->get('en_linea');  
                
                // $ml_dashboard->many_lenguages_id = $idioma->id;
                $ml_dashboard->save();
                
                DB::commit();

                // return response()->json(['data' => $document->id, 'bandera' => 1]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idioma = ManyLenguages::findOrFail($id);

        if($idioma->baja == 1){ //si esta en baja lo activo
            $idioma->baja = 0;
            $idioma->save();   
        }else{
            if($idioma->baja == 0){ //si esta activo lo bajo
                $idioma->baja = 1;
                $idioma->save();   
            }
        }
    }

    public function dataTable()
    {   
        $idiomas = ManyLenguages::get();
        // dd($idiomas);       
        return dataTables::of($idiomas)

            ->addColumn('created_at', function ($idiomas){
                return $idiomas->created_at->format('d-m-y');
            })   
            
            ->addColumn('label_estado', function ($idiomas){
                if($idiomas['baja'] == 0){
                    return '<span class="label label-success sm">Activo</span>';    
                }else{
                    return '<span class="label label-danger sm">Baja</span>';
                }
               })
            
            ->addColumn('accion', function ($idiomas) {
                return view('admin.manylenguages.partials._action', [
                    'idiomas'            => $idiomas,                       
                    'url_edit'          => route('admin.manylenguages.edit', $idiomas->id),
                    'url_destroy'          => route('admin.manylenguages.destroy', $idiomas->id),   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['label_estado', 'created_at', 'accion']) 
            ->make(true);  
    }
}
