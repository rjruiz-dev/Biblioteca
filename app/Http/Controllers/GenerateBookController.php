<?php

namespace App\Http\Controllers;

use DataTables;
use App\Book;
use Carbon\Carbon;
use App\Setting;
use App\Generate_book;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveLiteratureRequest;

class GenerateBookController extends Controller
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

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();
    
        return view('admin.literatures.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting
            
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $literature = new Generate_book();      
                             
        return view('admin.literatures.partials.form', [           
            'literature'  => $literature
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLiteratureRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $literature = new Generate_book;  
                $literature->genre_book  = $request->get('genre_book');           
                $literature->save();

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
     * @param  \App\Generate_book  $generate_book
     * @return \Illuminate\Http\Response
     */
    public function show(Generate_book $generate_book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_book  $generate_book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $literature = Generate_book::findOrFail($id);
                             
        return view('admin.literatures.partials.form', [           
            'literature'  => $literature
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_book  $generate_book
     * @return \Illuminate\Http\Response
     */
    public function update(SaveLiteratureRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $literature = Generate_book::findOrFail($id);

                // Actualizamos el genero               
                $literature->genre_book  = $request->get('genre_book');          
                $literature->save();
                 
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
     * @param  \App\Generate_book  $generate_book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Book::where('generate_books_id', $id)->get();
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $literature = Generate_book::findOrFail($id);
            $literature->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);          
    }

    public function dataTable()
    {       
        $literarios = Generate_book::query()      
        ->get();
         
        return dataTables::of($literarios)
           
            ->addColumn('genre_book', function ($literarios){

                return'<i class="fa fa-check-square"></i>'.' '.$literarios->genre_book;         
            })            
            ->addColumn('created_at', function ($literarios){
                return $literarios->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($literarios) {
                return view('admin.literatures.partials._action', [
                    'literarios' => $literarios,

                    'url_edit' => route('admin.literatures.edit', $literarios->id),                              
                    'url_destroy' => route('admin.literatures.destroy', $literarios->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['genre_book', 'created_at', 'accion']) 
            ->make(true);  
    }
}
