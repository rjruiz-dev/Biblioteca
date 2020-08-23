<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Book_movement;
use App\InfoOfDataBase;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;

class InfoofdatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('admin.infoofdatabase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataTable()
    {   
        $infoOfDataBase = InfoOfDataBase::all(); 
        

        $prestamos_vigentes = Book_movement::where(function ($query) {
                    $query->where('movement_types_id', '=', 1) // en prestamo
                          ->orWhere('movement_types_id', '=', 2); // en renovacion
                })
                ->where('active', 1)
                ->select(DB::raw('count(*) as count_of_prestamos_vigentes'))  
                ->first();

                $prestamos_historico = Book_movement::where('movement_types_id', 1)
                ->select(DB::raw('count(*) as count_of_prestamos_historico'))  
                ->first();

                $solicitudes_vigentes = Book_movement::where('movement_types_id', 7)
                ->where('active', 1)
                ->select(DB::raw('count(*) as count_of_solicitudes_vigentes'))  
                ->first();

                $solicitudes_historico = Book_movement::where('movement_types_id', 7)
                ->select(DB::raw('count(*) as count_of_solicitudes_historico'))  
                ->first();
     
        return dataTables::of($infoOfDataBase)
        
            ->addColumn('cantidades', function ($infoOfDataBase) use ($prestamos_vigentes, $prestamos_historico, $solicitudes_vigentes, $solicitudes_historico){
                    if($infoOfDataBase->numero == 1){
                        return $prestamos_vigentes->count_of_prestamos_vigentes;                           
                    }
                    if($infoOfDataBase->numero == 2){
                        return $prestamos_historico->count_of_prestamos_historico;                           
                    }
                    if($infoOfDataBase->numero == 3){
                        return $solicitudes_vigentes->count_of_solicitudes_vigentes;                           
                    }
                    if($infoOfDataBase->numero == 4){
                        return $solicitudes_historico->count_of_solicitudes_historico;                           
                    }
                    
                
            }) 
                        
                      
            ->addIndexColumn()   
            ->rawColumns(['cantidades']) 
            ->make(true);  
    }
}
