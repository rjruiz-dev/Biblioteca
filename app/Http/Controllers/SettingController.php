<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Ml_dashboard;
use App\Fine;
use App\ManyLenguages;
use App\Ml_library_profile;
use App\planes;
use App\Document;
use App\Swal_setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
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
        $planes_listado = planes::pluck('nombre_plan', 'id'); 
            
        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_library     = Ml_library_profile::where('many_lenguages_id', $idioma->id)->first();
        $swal_library   = Swal_setting::where('many_lenguages_id', $idioma->id)->first();
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

        $multas = Fine::all(); //obtengo las 2 multas. solo esta la econimica y la suspension de prestamos
        // dd($multas);
        $multa_economica = $multas[0];
        $multa_suspension = $multas[1];
        // dd($multa_economica);
        return view('admin.setting.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'    => $setting,
            'planes_listado' => $planes_listado,
            'ml_library'        => $ml_library,
            'swal_library'      => $swal_library,
            'multa_economica'   => $multa_economica,
            'multa_suspension'  => $multa_suspension
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {       
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $setting = Setting::findOrFail($id);

                if ($request->hasFile('logo')) {               

                    $file = $request->file('logo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                    $setting->logo              = $name;
                }
                // else{
                //     $name = 'library-default.jpg';
                // }           
              
                $setting->library_name      = $request->get('library_name');
                $setting->library_email     = $request->get('library_email');
                $setting->library_phone     = $request->get('library_phone');
                $setting->language          = $request->get('language');
                $setting->street            = $request->get('street');  
                $setting->city              = $request->get('city');
                $setting->province          = $request->get('province');  
                $setting->city              = $request->get('city');
                $setting->postal_code       = $request->get('postal_code');
                $setting->country           = $request->get('country');  
                $setting->loan_limit        = $request->get('loan_limit');    
                $setting->loan_day          = $request->get('loan_day'); 
                $setting->child_age         = $request->get('child_age');    
                $setting->adult_age         = $request->get('adult_age');
                $setting->skin              = $request->get('skin');
                $setting->skin_footer       = $request->get('skin_footer');
        
                $setting->id_plan       = $request->get('id_plan');
                
                
                $setting->fines_id = $request->get('group');

                $multa_eco = Fine::findOrFail(1); //cargo economica
                $multa_sus = Fine::findOrFail(2);//cargo suspension
                
                if($request->get('price_penalty') != null){
                    $multa_eco->unit             = $request->get('price_penalty');
                    $multa_eco->save();
                }
 
                if($request->get('days_penalty') != null){
                $multa_sus->unit             = $request->get('days_penalty');
                $multa_sus->save();
                }

                // $setting->logo              = $name; 
                  
                $setting->save();
                
                DB::commit();

                $session = session('idiomas');
                $swal_library = Swal_setting::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_set'        => $swal_library->swal_exito_set,
                                            'swal_info_exito_set'   => $swal_library->swal_info_exito_set                                      
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
