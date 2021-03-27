<?php

namespace App\Http\Controllers;


use DataTables;
use Carbon\Carbon;
use App\Adequacy;
use App\Book;
use App\planes;
use App\Ml_dashboard;
use App\Document;
use App\Setting;
use App\ManyLenguages;
use App\User;
use App\Ml_adequacy;
use App\Swal_adequacy;
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
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma      = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_adequacy = Ml_adequacy::where('many_lenguages_id', $idioma->id)->first();
        $swal_adequacy  = Swal_adequacy::where('many_lenguages_id', $idioma->id)->first();
        $setting        = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        
        $c_documentos     = Document::selectRaw('count(*) documents')->first();       
        $c_socios         = User::selectRaw('count(*) users')->first();    
        $advertencia = "";
        $plan_actual = planes::where('id', $setting->id_plan)->first();
        if($plan_actual == null){
            $plan_actual = planes::where('id', 1)->first();
        }
        $plan = $plan_actual->nombre_plan;
        if($plan_actual->id == 999){ // 999 es el plan premium
        if( ($c_documentos >= $plan_actual->cantidad_documentos ) || ($c_socios >= $plan_actual->cantidad_socios ) ){
            $advertencia = "Por favor actualice a una versión superior, esta llegando al limite de su capacidad";
        
        }
        }

        return view('admin.adequacies.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas, // REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba).
            'setting'   => $setting,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'ml_adequacy'   => $ml_adequacy,
            'swal_adequacy' => $swal_adequacy
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $adequacy = new Adequacy();     
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma      = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_adequacy = Ml_adequacy::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();
                             
        return view('admin.adequacies.partials.form', [           
            'adequacy'      => $adequacy,
            'idioma'        => $idioma,
            'setting' => $setting,
            'ml_adequacy'   => $ml_adequacy
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

                $session = session('idiomas');
                $swal_adequacy  = Swal_adequacy::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_ade'        => $swal_adequacy->swal_exito_ade,
                                            'swal_info_exito_ade'   => $swal_adequacy->swal_info_exito_ade                                      
                                        ]);

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
    public function edit(Request $request, $id)
    {
        $adequacy  = Adequacy::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma      = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_adequacy = Ml_adequacy::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.adequacies.partials.form', [           
            'adequacy'      =>  $adequacy,
            'setting' => $setting,
            'idioma'        => $idioma,
            'ml_adequacy'   => $ml_adequacy 
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

                $session = session('idiomas');
                $swal_adequacy  = Swal_adequacy::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_ade'        => $swal_adequacy->swal_exito_ade,
                                            'swal_info_exito_ade'   => $swal_adequacy->swal_info_exito_ade                                      
                                        ]);

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
        $session = session('idiomas');
        $swal_adequacy  = Swal_adequacy::where('many_lenguages_id',$session)->first();
      
        if( $document->isEmpty())
        {  
            $bandera = 1;
            $adequacy = Adequacy::findOrFail($id);
            $adequacy->delete();


        }else{          
            $bandera = 0;            
        }
        return response()->json([   
                                    'data' => $bandera,
                                    'swal_exito_ade'            => $swal_adequacy->swal_exito_ade,
                                    'swal_eliminar_ade'         => $swal_adequacy->swal_eliminar_ade,
                                    'swal_info_eliminar_ade'    => $swal_adequacy->swal_info_eliminar_ade,       
                                    'swal_advertencia_ade'      => $swal_adequacy->swal_advertencia_ade,
                                    'swal_info_advertencia_ade' => $swal_adequacy->swal_info_advertencia_ade,
                                ]); 
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
