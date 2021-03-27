<?php

namespace App\Http\Controllers;

use DataTables;
use App\planes;
use Carbon\Carbon;
use App\Document;
use App\Generate_film;
use App\Movies;
use App\Setting;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Ml_cinematographic_genre;
use App\User;
use App\Swal_cinematographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveFilmRequest;

class GenerateFilmController extends Controller
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
        $ml_gc      = Ml_cinematographic_genre::where('many_lenguages_id', $idioma->id)->first();
        $swal_gc    = Swal_cinematographic::where('many_lenguages_id', $idioma->id)->first();
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

        return view('admin.cinematographics.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'   => $setting,
            'ml_gc'     => $ml_gc,
            'swal_gc'   => $swal_gc

        ]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $film = new Generate_film();     
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 
        $setting = Setting::where('id', 1)->first();
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_gc      = Ml_cinematographic_genre::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.cinematographics.partials.form', [           
            'film'      => $film,
            'setting' => $setting,
            'idioma'    => $idioma,
            'ml_gc'     => $ml_gc
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFilmRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $film = new Generate_film;  
                $film->genre_film  = $request->get('genre_film');           
                $film->save();

                DB::commit();

                $session = session('idiomas');
                $swal_gc = Swal_cinematographic::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_cin'        => $swal_gc->swal_exito_cin,
                                            'swal_info_exito_cin'   => $swal_gc->swal_info_exito_cin                                      
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
     * @param  \App\Generate_film  $generate_film
     * @return \Illuminate\Http\Response
     */
    public function show(Generate_film $generate_film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_film  $generate_film
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $film = Generate_film::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 
        $setting = Setting::where('id', 1)->first();
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_gc      = Ml_cinematographic_genre::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.cinematographics.partials.form', [           
            'film'      => $film,
            'setting' => $setting,
            'idioma'    => $idioma,
            'ml_gc'     => $ml_gc
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_film  $generate_film
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFilmRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $film = Generate_film::findOrFail($id);

                // Actualizamos el genero               
                $film->genre_film  = $request->get('genre_film');          
                $film->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_gc = Swal_cinematographic::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_cin'        => $swal_gc->swal_exito_cin,
                                            'swal_info_exito_cin'   => $swal_gc->swal_info_exito_cin                                      
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
     * @param  \App\Generate_film  $generate_film
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Movies::where('generate_films_id', $id)->get();
        $session = session('idiomas');
        $swal_gc = Swal_cinematographic::where('many_lenguages_id',$session)->first();
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $film = Generate_film::findOrFail($id);
            $film->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_cin'            => $swal_gc->swal_exito_cin,
                                    'swal_eliminar_cin'         => $swal_gc->swal_eliminar_cin,
                                    'swal_info_eliminar_cin'    => $swal_gc->swal_info_eliminar_cin,       
                                    'swal_advertencia_cin'      => $swal_gc->swal_advertencia_cin,
                                    'swal_info_advertencia_cin' => $swal_gc->swal_info_advertencia_cin,
                                ]);  
    }

    public function dataTable()
    {       
        $cinematograficos = Generate_film::query()      
        ->get();
         
        return dataTables::of($cinematograficos)
           
            ->addColumn('genre_film', function ($cinematograficos){

                return'<i class="fa fa-check-square"></i>'.' '.$cinematograficos->genre_film;         
            })            
            ->addColumn('created_at', function ($cinematograficos){
                return $cinematograficos->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($cinematograficos) {
                return view('admin.cinematographics.partials._action', [
                    'cinematograficos' => $cinematograficos,

                    'url_edit' => route('admin.cinematographics.edit', $cinematograficos->id),                              
                    'url_destroy' => route('admin.cinematographics.destroy', $cinematograficos->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['genre_film', 'created_at', 'accion']) 
            ->make(true);  
    }
}
