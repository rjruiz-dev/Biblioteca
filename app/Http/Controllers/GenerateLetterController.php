<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Generate_letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveLetterRequest;

class GenerateLetterController extends Controller
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

        //cargo el idioma
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();

        return view('admin.letters.index', [
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
        $letter = new Generate_letter();  
                             
        return view('admin.letters.partials.form', [           
            'letter'  => $letter
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLetterRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos la carta           
                $letter = new Generate_letter;  
                $letter->title  = $request->get('title'); 
                $letter->body   = $request->input('body'); 
                $letter->excerpt   = $request->input('excerpt');           
                $letter->save();

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
     * @param  \App\Generate_letter  $generate_letter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_letter  $generate_letter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $letter = Generate_letter::findOrFail($id);
                             
        return view('admin.letters.partials.form', [           
            'letter'  => $letter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_letter  $generate_letter
     * @return \Illuminate\Http\Response
     */
    public function update(SaveLetterRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $letter = Generate_letter::findOrFail($id);

                // Actualizamos la carta               
                $letter->title   = $request->get('title');  
                $letter->body    = $request->input('body'); 
                $letter->excerpt = $request->input('excerpt');             
                $letter->save();
                 
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
     * @param  \App\Generate_letter  $generate_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Generate_letter::where('letters_id', $id)->get();
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $letter = Generate_letter::findOrFail($id);
            $letter->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);  
    }

    public function dataTable()
    {
        $cartas = Generate_letter::query()      
        ->get();
         
        return dataTables::of($cartas)
           
            ->addColumn('title', function ($cartas){

                return'<i class="fa fa-check-square"></i>'.' '.$cartas->title;         
            })  
            ->addColumn('body', function ($cartas){

                return'<i class="fa fa-check-square"></i>'.' '.$cartas->body;         
            }) 
            ->addColumn('excerpt', function ($cartas){

                return'<i class="fa fa-check-square"></i>'.' '.$cartas->excerpt;         
            })              
            ->addColumn('created_at', function ($cartas){
                return $cartas->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($cartas) {
                return view('admin.letters.partials._action', [
                    'cartas' => $cartas,

                    'url_edit' => route('admin.letters.edit', $cartas->id),                              
                    'url_destroy' => route('admin.letters.destroy', $cartas->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['title', 'body','excerpt', 'created_at', 'accion']) 
            ->make(true);  
    }
}
