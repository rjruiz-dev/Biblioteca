<?php

namespace App\Http\Controllers;

use DataTables;
use App\Book;
use Carbon\Carbon;
use App\Setting;
use App\Generate_book;
use App\Ml_literary_genre;
use App\Swal_literature;
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
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_gl      = Ml_literary_genre::where('many_lenguages_id', $idioma->id)->first();
        $swal_gl    = Swal_literature::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
    
        return view('admin.literatures.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'ml_gl'     => $ml_gl,
            'swal_gl'   => $swal_gl
            
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $literature = new Generate_book(); 
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_gl      = Ml_literary_genre::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.literatures.partials.form', [           
            'literature'    => $literature,
            'setting' => $setting,
            'idioma'        => $idioma,
            'ml_gl'         => $ml_gl
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

                $session = session('idiomas');
                $swal_gl = Swal_literature::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_lit'        => $swal_gl->swal_exito_lit,
                                            'swal_info_exito_lit'   => $swal_gl->swal_info_exito_lit                                      
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
    public function edit(Request $request, $id)
    {
        $literature = Generate_book::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_gl      = Ml_literary_genre::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.literatures.partials.form', [           
            'literature' => $literature,
            'setting' => $setting,
            'idioma'     => $idioma,
            'ml_gl'      => $ml_gl
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
                
                $session = session('idiomas');
                $swal_gl = Swal_literature::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_lit'        => $swal_gl->swal_exito_lit,
                                            'swal_info_exito_lit'   => $swal_gl->swal_info_exito_lit                                      
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
     * @param  \App\Generate_book  $generate_book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Book::where('generate_books_id', $id)->get();
        $session = session('idiomas');
        $swal_gl = Swal_literature::where('many_lenguages_id',$session)->first();
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $literature = Generate_book::findOrFail($id);
            $literature->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_lit'            => $swal_gl->swal_exito_lit,
                                    'swal_eliminar_lit'         => $swal_gl->swal_eliminar_lit,
                                    'swal_info_eliminar_lit'    => $swal_gl->swal_info_eliminar_lit,       
                                    'swal_advertencia_lit'      => $swal_gl->swal_advertencia_lit,
                                    'swal_info_advertencia_lit' => $swal_gl->swal_info_advertencia_lit,
                                ]);          
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
