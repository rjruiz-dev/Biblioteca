<?php

namespace App\Http\Controllers;


use DataTables;
use Carbon\Carbon;
use App\Adequacy;
use App\Book;
use App\Ml_dashboard;
use App\Document;
use App\Setting;
use App\ManyLenguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveAdequacyRequest;

class AdequacyController extends Controller
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

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();
    
        return view('admin.adequacies.index', [
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
        $adequacy = new Adequacy();      
                             
        return view('admin.adequacies.partials.form', [           
            'adequacy'  => $adequacy
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveAdequacyRequest $request)
    {
         if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $adequacy = new Adequacy;  
                $adequacy->adequacy_description  = $request->get('adequacy_description');           
                $adequacy->save();

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
     * @param  \App\adequacy  $adequacy
     * @return \Illuminate\Http\Response
     */
    public function show(adequacy $adequacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\adequacy  $adequacy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $adequacy  = Adequacy::findOrFail($id);
                             
        return view('admin.adequacies.partials.form', [           
            'adequacy'  =>  $adequacy 
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\adequacy  $adequacy
     * @return \Illuminate\Http\Response
     */
    public function update(SaveAdequacyRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $adequacy = Adequacy::findOrFail($id);

                // Actualizamos el genero               
                $adequacy->adequacy_description  = $request->get('adequacy_description');           
                $adequacy->save();
                 
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
     * @param  \App\adequacy  $adequacy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $document = Document::where('adequacies_id', $id)->get();
      
        if( $document->isEmpty())
        {  
            $bandera = 1;
            $adequacy = Adequacy::findOrFail($id);
            $adequacy->delete();


        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]); 
    }

    public function dataTable()
    {       
        $adecuaciones = Adequacy::query()      
        ->get();
         
        return dataTables::of($adecuaciones)
           
            ->addColumn('adequacy_description', function ($adecuaciones){

                return'<i class="fa fa-check-square"></i>'.' '.$adecuaciones->adequacy_description;         
            })            
            ->addColumn('created_at', function ($adecuaciones){
                return $adecuaciones->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($adecuaciones) {
                return view('admin.adequacies.partials._action', [
                    'adecuaciones' => $adecuaciones,

                    'url_edit' => route('admin.adequacies.edit', $adecuaciones->id),                              
                    'url_destroy' => route('admin.adequacies.destroy', $adecuaciones->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['adequacy_description', 'created_at', 'accion']) 
            ->make(true);  
    }
}
