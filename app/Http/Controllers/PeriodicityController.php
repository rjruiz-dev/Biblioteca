<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Periodical_publication;
use App\Periodicity;
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
    public function index()
    {
        return view('admin.periodicals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodical = new Periodicity();      
                             
        return view('admin.periodicals.partials.form', [           
            'periodical'  => $periodical
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
    public function edit($id)
    {
        $periodical = Periodicity::findOrFail($id);
                                  
        return view('admin.periodicals.partials.form', [           
            'periodical'  => $periodical
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
      
        if($publication->isEmpty())
        {  
            $bandera = 1;
            $periodical = Periodicity::findOrFail($id);
            $periodical->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);
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
