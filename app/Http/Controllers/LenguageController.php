<?php

namespace App\Http\Controllers;

use DataTables;
use App\Lenguage;
use App\Document;
use Carbon\Carbon;
use App\Ml_language;
use App\Swal_language;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveLenguageRequest;

class LenguageController extends Controller
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

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_lang    = Ml_language::where('many_lenguages_id', $idioma->id)->first();
        $swal_lang  = Swal_language::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();        
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
      
        return view('admin.languages.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'ml_lang'   => $ml_lang,
            'swal_lang' => $swal_lang
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $language = new Lenguage();     
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_lang    = Ml_language::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.languages.partials.form', [           
            'language'  => $language,
            'setting' => $setting,
            'idioma'    => $idioma,            
            'ml_lang'   => $ml_lang
        ]);          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLenguageRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el idioma           
                $language = new Lenguage;   
                $language->leguage_description  = $request->get('leguage_description');           
                $language->save();

                DB::commit();

                $session = session('idiomas');
                $swal_lang  = Swal_language::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_lan'        => $swal_lang->swal_exito_lan,
                                            'swal_info_exito_lan'   => $swal_lang->swal_info_exito_lan                                      
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
     * @param  \App\Lenguage  $lenguage
     * @return \Illuminate\Http\Response
     */
    public function show(Lenguage $lenguage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lenguage  $lenguage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $language = Lenguage::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_lang    = Ml_language::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.languages.partials.form', [           
            'language'  => $language,
            'setting' => $setting,
            'idioma'    => $idioma,
            'ml_lang'   => $ml_lang
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lenguage  $lenguage
     * @return \Illuminate\Http\Response
     */
    public function update(SaveLenguageRequest $request, $id)
    {
        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $language = Lenguage::findOrFail($id);

                // Actualizamos el idioma               
                $language->leguage_description  = $request->get('leguage_description');           
                $language->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_lang  = Swal_language::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_lan'        => $swal_lang->swal_exito_lan,
                                            'swal_info_exito_lan'   => $swal_lang->swal_info_exito_lan                                      
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
     * @param  \App\Lenguage  $lenguage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document   = Document::where('lenguages_id', $id)->get();
        $session    = session('idiomas');
        $swal_lang  = Swal_language::where('many_lenguages_id',$session)->first();
      
        if( $document->isEmpty())
        {  
            $bandera = 1;
            $language = Lenguage::findOrFail($id);        
            $language->delete();  


        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_lan'            => $swal_lang->swal_exito_lan,
                                    'swal_eliminar_lan'         => $swal_lang->swal_eliminar_lan,
                                    'swal_info_eliminar_lan'    => $swal_lang->swal_info_eliminar_lan,   
                                    'swal_advertencia_lan'      => $swal_lang->swal_advertencia_lan,
                                    'swal_info_advertencia_lan' => $swal_lang->swal_info_advertencia_lan
                                ]);  
      
    }

    public function dataTable()
    {       
        $lenguajes = Lenguage::query()      
        ->get();
         
        return dataTables::of($lenguajes)
           
            ->addColumn('leguage_description', function ($lenguajes){

                return'<i class="fa fa-check-square"></i>'.' '.$lenguajes->leguage_description;         
            })            
            ->addColumn('created_at', function ($lenguajes){
                return $lenguajes->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($lenguajes) {
                return view('admin.languages.partials._action', [
                    'lenguajes' => $lenguajes,

                    'url_edit' => route('admin.languages.edit', $lenguajes->id),                              
                    'url_destroy' => route('admin.languages.destroy', $lenguajes->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['leguage_description', 'created_at', 'accion']) 
            ->make(true);  
    }
}
