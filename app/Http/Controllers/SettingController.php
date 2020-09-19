<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Ml_dashboard;
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

        return view('admin.setting.index', [
            'idioma'     => $idioma,
            'idiomas'    => $idiomas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = new Setting();
                             
        return view('admin.setting.index', [   
            'setting'   => $setting
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

                if ($request->hasFile('logo')) {               

                    $file = $request->file('logo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{
                    $name = 'library-default.jpg';
                }               
             
                $setting = new Setting;   
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
                $setting->color             = $request->get('color');
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
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
                             
        return view('admin.setting.index', [         
            'setting'      => $setting
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
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
