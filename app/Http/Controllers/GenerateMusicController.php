<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Generate_music;
use App\Music;
use App\Setting;
use App\Ml_dashboard;
use App\Ml_musical_genre;
use App\Swal_musical;
use App\ManyLenguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveMusicRequest;

class GenerateMusicController extends Controller
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
        $ml_gm      = Ml_musical_genre::where('many_lenguages_id', $idioma->id)->first();
        $swal_gm    = Swal_musical::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
    
        return view('admin.musicals.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'ml_gm'     => $ml_gm,
            'swal_gm'   => $swal_gm
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $musical = new Generate_music(); 
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_gm      = Ml_musical_genre::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.musicals.partials.form', [           
            'musical'  => $musical,
            'idioma'    => $idioma,
            'ml_gm'     => $ml_gm
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMusicRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $musical = new Generate_music;  
                $musical->genre_music  = $request->get('genre_music');           
                $musical->save();

                DB::commit();

                $session = session('idiomas');
                $swal_gm = Swal_musical::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_mus'        => $swal_gm->swal_exito_mus,
                                            'swal_info_exito_mus'   => $swal_gm->swal_info_exito_mus                                      
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
     * @param  \App\Generate_music  $generate_music
     * @return \Illuminate\Http\Response
     */
    public function show(Generate_music $generate_music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_music  $generate_music
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $musical = Generate_music::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_gm      = Ml_musical_genre::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.musicals.partials.form', [           
            'musical'  => $musical,
            'idioma'    => $idioma,
            'ml_gm'     => $ml_gm
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_music  $generate_music
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMusicRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $musical = Generate_music::findOrFail($id);

                // Actualizamos el genero               
                $musical->genre_music  = $request->get('genre_music');          
                $musical->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_gm = Swal_musical::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_mus'        => $swal_gm->swal_exito_mus,
                                            'swal_info_exito_mus'   => $swal_gm->swal_info_exito_mus                                      
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
     * @param  \App\Generate_music  $generate_music
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Music::where('generate_musics_id', $id)->get();
        $session = session('idiomas');
        $swal_gm = Swal_musical::where('many_lenguages_id',$session)->first();
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $musical = Generate_music::findOrFail($id);
            $musical->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data'                      => $bandera,
                                    'swal_exito_mus'            => $swal_gm->swal_exito_mus,
                                    'swal_eliminar_mus'         => $swal_gm->swal_eliminar_mus,
                                    'swal_info_eliminar_mus'    => $swal_gm->swal_info_eliminar_mus,       
                                    'swal_advertencia_mus'      => $swal_gm->swal_advertencia_mus,
                                    'swal_info_advertencia_mus' => $swal_gm->swal_info_advertencia_mus,
                                ]);          
    }

    public function dataTable()
    {       
        $musicales = Generate_music::query()      
        ->get();
         
        return dataTables::of($musicales)
           
            ->addColumn('genre_music', function ($musicales){

                return'<i class="fa fa-check-square"></i>'.' '.$musicales->genre_music;         
            })            
            ->addColumn('created_at', function ($musicales){
                return $musicales->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($musicales) {
                return view('admin.musicals.partials._action', [
                    'musicales' => $musicales,

                    'url_edit' => route('admin.musicals.edit', $musicales->id),                              
                    'url_destroy' => route('admin.musicals.destroy', $musicales->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['genre_music', 'created_at', 'accion']) 
            ->make(true);  
    }
}
