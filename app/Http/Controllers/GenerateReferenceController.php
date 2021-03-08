<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Document;
use App\Ml_reference;
use App\Swal_reference;
use App\Generate_reference;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveReferenceRequest;

class GenerateReferenceController extends Controller
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

        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();       
        $ml_reference   = Ml_reference::where('many_lenguages_id', $idioma->id)->first();
        $swal_reference = Swal_reference::where('many_lenguages_id', $idioma->id)->first();
        $setting        = Setting::where('id', 1)->first();    
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.   
    
        return view('admin.references.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'ml_reference'    => $ml_reference,
            'swal_reference'  => $swal_reference
        ]);       
             
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $reference = new Generate_reference(); 
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_reference   = Ml_reference::where('many_lenguages_id', $idioma->id)->first();
                
        return view('admin.references.partials.form', [           
            'reference' => $reference,
            'idioma'    => $idioma,            
            'ml_reference'  => $ml_reference
        ]);  
      

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveReferenceRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $reference = new Generate_reference;  
                $reference->reference_description  = $request->get('reference_description');           
                $reference->save();

                DB::commit();

                $session = session('idiomas');
                $swal_reference = Swal_reference::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_ref'        => $swal_reference->swal_exito_ref,
                                            'swal_info_exito_ref'   => $swal_reference->swal_info_exito_ref                                      
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
     * @param  \App\Generate_reference  $generate_reference
     * @return \Illuminate\Http\Response
     */
    public function show(Generate_reference $generate_reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_reference  $generate_reference
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $reference = Generate_reference::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_reference   = Ml_reference::where('many_lenguages_id', $idioma->id)->first();
              
        return view('admin.references.partials.form', [           
            'reference' => $reference,
            'idioma'    => $idioma,            
            'ml_reference'  => $ml_reference
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_reference  $generate_reference
     * @return \Illuminate\Http\Response
     */
    public function update(SaveReferenceRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $reference = Generate_reference::findOrFail($id);

                // Actualizamos el genero               
                $reference->reference_description  = $request->get('reference_description');          
                $reference->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_reference = Swal_reference::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_ref'        => $swal_reference->swal_exito_ref,
                                            'swal_info_exito_ref'   => $swal_reference->swal_info_exito_ref                                    
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
     * @param  \App\Generate_reference  $generate_reference
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $var_reference = DB::select("SELECT * FROM document_generate_reference WHERE generate_reference = ".$id);
                // $referencias_en_documentos = $referencias_en_documentos_p[0];
        // dd()
        $session = session('idiomas');
        $swal_reference = Swal_reference::where('many_lenguages_id',$session)->first();
        
        $var_reference = Document::with('references')
        ->whereHas('references', function($q) use ($id)
        {
            $q->where('generate_reference_id', '=', $id);
        
        })
        // ->where('generate_references_id', $id)
        ->get();
      
        if($var_reference->isEmpty())
        {  
            $bandera = 1;
            $reference = Generate_reference::findOrFail($id);
            $reference->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_ref'            => $swal_reference->swal_exito_ref,
                                    'swal_eliminar_ref'         => $swal_reference->swal_eliminar_ref,
                                    'swal_info_eliminar_ref'    => $swal_reference->swal_info_eliminar_ref,   
                                    'swal_advertencia_ref'      => $swal_reference->swal_advertencia_ref,
                                    'swal_info_advertencia_ref' => $swal_reference->swal_info_advertencia_ref
                                ]);
    }

    public function dataTable()
    {       
        $referencias = Generate_reference::query()      
        ->get();
         
        return dataTables::of($referencias)
           
            ->addColumn('reference_description', function ($referencias){

                return'<i class="fa fa-check-square"></i>'.' '.$referencias->reference_description;         
            })            
            ->addColumn('created_at', function ($referencias){
                return $referencias->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($referencias) {
                return view('admin.references.partials._action', [
                    'referencias' => $referencias,

                    'url_edit' => route('admin.references.edit', $referencias->id),                              
                    'url_destroy' => route('admin.references.destroy', $referencias->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['reference_description', 'created_at', 'accion']) 
            ->make(true);  
    }
}
