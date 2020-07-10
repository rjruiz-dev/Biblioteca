<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Generate_film;
use App\Movies;
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
    public function index()
    {
        return view('admin.cinematographics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $film = new Generate_film();      
                             
        return view('admin.cinematographics.partials.form', [           
            'film'  => $film
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
    public function edit($id)
    {
        $film = Generate_film::findOrFail($id);
                             
        return view('admin.cinematographics.partials.form', [           
            'film'  => $film
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
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $film = Generate_film::findOrFail($id);
            $film->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);  
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
