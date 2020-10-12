<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Ml_dashboard;
use App\Fine;
use App\ManyLenguages;
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
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
        $setting = Setting::where('id', 1)->first();
          
        $multas = Fine::all(); //obtengo las 2 multas. solo esta la econimica y la suspension de prestamos
        // dd($multas);
        $multa_economica = $multas[0];
        $multa_suspension = $multas[1];
        // dd($multa_economica);
        return view('admin.setting.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas,
            'setting'    => $setting,
            'multa_economica'    => $multa_economica,
            'multa_suspension'    => $multa_suspension
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
                }else{
                    $name = 'library-default.jpg';
                }           
              
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
                $setting->child_age         = $request->get('child_age');    
                $setting->adult_age         = $request->get('adult_age');
                $setting->skin              = $request->get('skin');
                $setting->skin_footer       = $request->get('skin_footer');
                
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

                $setting->logo              = $name; 
                  
                $setting->save();
                
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
