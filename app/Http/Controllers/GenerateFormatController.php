<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Music;
use App\Movies;
use App\Photography;
use App\Generate_format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveFormatRequest;

class GenerateFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.formats.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $format = new Generate_format();      
                             
        return view('admin.formats.partials.form', [           
            'format'  => $format
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
    public function edit($id)
    {
        $format = Generate_format::findOrFail($id);
                             
        return view('admin.formats.partials.form', [           
            'format'  => $format
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
        $format_music = Music::where('generate_formats_id', $id)->get();
        $format_movie = Movies::where('generate_formats_id', $id)->get();
        $format_photography = Photography::where('generate_formats_id', $id)->get();

        if($format_music->isEmpty() && $format_movie->isEmpty() &&  $format_photography->isEmpty())        
        {  
            $bandera = 1;
            $format = Generate_format::findOrFail($id);
            $format->delete();

        }else{      

            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);  
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
