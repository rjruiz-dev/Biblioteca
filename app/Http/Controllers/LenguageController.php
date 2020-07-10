<?php

namespace App\Http\Controllers;

use DataTables;
use App\Lenguage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveLenguageRequest;

class LenguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = new Lenguage();      
                             
        return view('admin.languages.partials.form', [           
            'language'      => $language
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
    public function edit($id)
    {
        $language = Lenguage::findOrFail($id);
                             
        return view('admin.languages.partials.form', [           
            'language'      => $language
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
        $document = Document::where('lenguages_id', $id)->get();
      
        if( $document->isEmpty())
        {  
            $bandera = 1;
            $language = Lenguage::findOrFail($id);        
            $language->delete();  


        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);  
      
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
