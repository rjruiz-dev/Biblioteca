<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Periodical_publication;
use App\Ml_periodical_publication;
use App\Swal_periodical;
use App\Periodicity;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SavePeriodicityRequest;

class PeriodicityController extends Controller
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
        $ml_pp      = Ml_periodical_publication::where('many_lenguages_id', $idioma->id)->first();
        $swal_pp    = Swal_periodical::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
            
        return view('admin.periodicals.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'ml_pp'     => $ml_pp,
            'swal_pp'   => $swal_pp
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $periodical = new Periodicity();     
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_pp      = Ml_periodical_publication::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.periodicals.partials.form', [           
            'periodical'=> $periodical,
            'idioma'    => $idioma,
            'ml_pp'     => $ml_pp

        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePeriodicityRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos la periodicidad           
                $periodical = new Periodicity;   
                $periodical->periodicity_name  = $request->get('periodicity_name');           
                $periodical->save();

                DB::commit();

                $session = session('idiomas');
                $swal_pp = Swal_periodical::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_per'        => $swal_pp->swal_exito_per,
                                            'swal_info_exito_per'   => $swal_pp->swal_info_exito_per                                      
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
     * @param  \App\Periodicity  $periodicity
     * @return \Illuminate\Http\Response
     */
    public function show(Periodicity $periodicity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periodicity  $periodicity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $periodical = Periodicity::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_pp      = Ml_periodical_publication::where('many_lenguages_id', $idioma->id)->first();
                                  
        return view('admin.periodicals.partials.form', [           
            'periodical'    => $periodical,
            'idioma'        => $idioma,
            'ml_pp'         => $ml_pp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodicity  $periodicity
     * @return \Illuminate\Http\Response
     */
    public function update(SavePeriodicityRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $periodical = Periodicity::findOrFail($id);

                // Actualizamos el genero               
                $periodical->periodicity_name  = $request->get('periodicity_name');                
                $periodical->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_pp = Swal_periodical::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_per'        => $swal_pp->swal_exito_per,
                                            'swal_info_exito_per'   => $swal_pp->swal_info_exito_per                                      
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
     * @param  \App\Periodicity  $periodicity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publication = Periodical_publication::where('periodicities_id', $id)->get();
        $session = session('idiomas');
        $swal_pp = Swal_periodical::where('many_lenguages_id',$session)->first();

        if($publication->isEmpty())
        {  
            $bandera = 1;
            $periodical = Periodicity::findOrFail($id);
            $periodical->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_per'            => $swal_pp->swal_exito_per,
                                    'swal_eliminar_per'         => $swal_pp->swal_eliminar_per,
                                    'swal_info_eliminar_per'    => $swal_pp->swal_info_eliminar_per,   
                                    'swal_advertencia_per'      => $swal_pp->swal_advertencia_per,
                                    'swal_info_advertencia_per' => $swal_pp->swal_info_advertencia_per
                                ]);
    }

    public function dataTable()
    {       
        $periodicidades = Periodicity::query()      
        ->get();
         
        return dataTables::of($periodicidades)
           
            ->addColumn('periodicity_name', function ($periodicidades){

                return'<i class="fa fa-check-square"></i>'.' '.$periodicidades->periodicity_name;         
            })            
            ->addColumn('created_at', function ($periodicidades){
                return $periodicidades->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($periodicidades) {
                return view('admin.periodicals.partials._action', [
                    'periodicidades' => $periodicidades,

                    'url_edit' => route('admin.periodicals.edit', $periodicidades->id),                              
                    'url_destroy' => route('admin.periodicals.destroy', $periodicidades->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['periodicity_name', 'created_at', 'accion']) 
            ->make(true);  
    }
}
