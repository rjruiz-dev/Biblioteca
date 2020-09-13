<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Generate_music;
use App\Music;
use App\Ml_dashboard;
use App\ManyLenguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveMusicalRequest;

class GenerateMusicController extends Controller
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
    
        return view('admin.musicals.index', [
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
        $musical = new Generate_music();      
                             
        return view('admin.musicals.partials.form', [           
            'musical'  => $musical
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMusicalRequest $request)
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
    public function edit($id)
    {
        $musical = Generate_music::findOrFail($id);
                             
        return view('admin.musicals.partials.form', [           
            'musical'  => $musical
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_music  $generate_music
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMusicalRequest $request, $id)
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
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $musical = Generate_music::findOrFail($id);
            $musical->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);          
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
