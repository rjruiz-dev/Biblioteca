<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\planes;
use App\Music;
use App\Document;
use App\Movies;
use App\Photography;
use App\Generate_format;
use App\Ml_graphic_format;
use App\Swal_graphic_format;
use App\Ml_dashboard;
use App\Setting;
use App\ManyLenguages;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveFormatRequest;

class GenerateFormatController extends Controller
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
        $ml_fg      = Ml_graphic_format::where('many_lenguages_id', $idioma->id)->first();
        $swal_fg    = Swal_graphic_format::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();
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
    
        return view('admin.formats.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'ml_fg'     => $ml_fg,
            'swal_fg'   => $swal_fg

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $format = new Generate_format();   
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 
        $setting = Setting::where('id', 1)->first();
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_fg      = Ml_graphic_format::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.formats.partials.form', [           
            'format'    => $format,
            'idioma'    => $idioma,   
            'setting' => $setting,         
            'ml_fg'     => $ml_fg
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFormatRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $format = new Generate_format;  
                $format->genre_format  = $request->get('genre_format');           
                $format->save();

                DB::commit();

                $session = session('idiomas');
                $swal_fg = Swal_graphic_format::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_gra'        => $swal_fg->swal_exito_gra,
                                            'swal_info_exito_gra'   => $swal_fg->swal_info_exito_gra                                      
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
     * @param  \App\Generate_format  $generate_format
     * @return \Illuminate\Http\Response
     */
    public function show(Generate_format $generate_format)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_format  $generate_format
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $format = Generate_format::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_fg      = Ml_graphic_format::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.formats.partials.form', [           
            'format'    => $format,
            'idioma'    => $idioma,            
            'setting' => $setting,
            'ml_fg'     => $ml_fg
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_format  $generate_format
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFormatRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $format = Generate_format::findOrFail($id);

                // Actualizamos el genero               
                $format->genre_format  = $request->get('genre_format');          
                $format->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_fg = Swal_graphic_format::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_gra'        => $swal_fg->swal_exito_gra,
                                            'swal_info_exito_gra'   => $swal_fg->swal_info_exito_gra                                     
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
     * @param  \App\Generate_format  $generate_format
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        $format_music       = Music::where('generate_formats_id', $id)->get();
        $format_movie       = Movies::where('generate_formats_id', $id)->get();
        $format_photography = Photography::where('generate_formats_id', $id)->get();
        $session            = session('idiomas');
        $swal_fg            = Swal_graphic_format::where('many_lenguages_id',$session)->first();

        if($format_music->isEmpty() && $format_movie->isEmpty() &&  $format_photography->isEmpty())        
        {  
            $bandera = 1;
            $format = Generate_format::findOrFail($id);
            $format->delete();

        }else{      

            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_gra'            => $swal_fg->swal_exito_gra,
                                    'swal_eliminar_gra'         => $swal_fg->swal_eliminar_gra,                                  
                                    'swal_info_eliminar_gra'    => $swal_fg->swal_info_eliminar_gra,   
                                    'swal_advertencia_gra'      => $swal_fg->swal_advertencia_gra,
                                    'swal_info_advertencia_gra' => $swal_fg->swal_info_advertencia_gra,                          
                                ]);  
    }

    public function dataTable()
    {       
        $formatos = Generate_format::query()      
        ->get();
         
        return dataTables::of($formatos)
           
            ->addColumn('genre_format', function ($formatos){

                return'<i class="fa fa-check-square"></i>'.' '.$formatos->genre_format;         
            })            
            ->addColumn('created_at', function ($formatos){
                return $formatos->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($formatos) {
                return view('admin.formats.partials._action', [
                    'formatos' => $formatos,

                    'url_edit' => route('admin.formats.edit', $formatos->id),                              
                    'url_destroy' => route('admin.formats.destroy', $formatos->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['genre_format', 'created_at', 'accion']) 
            ->make(true);  
    }
}
