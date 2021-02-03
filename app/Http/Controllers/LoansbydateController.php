<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book_movement;
use Carbon\Carbon;
use DataTables;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Ml_loan_by_date;
use App\Setting;

class LoansbydateController extends Controller
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
        $ml_ld      = Ml_loan_by_date::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();

        return view('admin.loansbydate.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'ml_ld'     => $ml_ld
        ]);         
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

    public function dataTable(Request $request)
    {   
        // dd($request->fecha_desde);
            // $from = '2020-09-01';
            // $to = '2022-02-10';
            if($request->get('fecha_desde') == '' && $request->get('fecha_hasta') == ''){
            
            
                $prestamos = Book_movement::with('copy.document','user','copy.document.document_type','course', 'copy.document')              
                ->where(function ($query) {
                    $query->where('movement_types_id', '=', 1)
                          ->orWhere('movement_types_id', '=', 2);
                })
                ->where('active', 1)  
                ->get();

            }else{
                if($request->get('fecha_desde') != '' && $request->get('fecha_hasta') != ''){
                    if($request->get('fecha_desde') == $request->get('fecha_hasta')){
                        // tomo desde o hasta no importa xq en teoria son iguales
                        $misma = Carbon::createFromFormat('d/m/Y', $request->get('fecha_desde'));
        
                        $prestamos = Book_movement::with('copy.document','user','course', 'copy.document', 'copy.document.document_type')
                        ->whereDate('date_until', $misma)
                        ->where(function ($query) {
                            $query->where('movement_types_id', '=', 1)
                                  ->orWhere('movement_types_id', '=', 2);
                        })
                        ->where('active', 1)                
                        ->get();
        
                    }else{
                        $from = Carbon::createFromFormat('d/m/Y', $request->get('fecha_desde'));
                        $to = Carbon::createFromFormat('d/m/Y', $request->get('fecha_hasta'));
                    
                        $prestamos = Book_movement::with('copy.document','user','course', 'copy.document', 'copy.document.document_type')
                        // ->whereBetween('date_until', [$request->get('fecha_desde'), $request->get('fecha_desde')])
                        // ->whereBetween('date_until', []) 
                        -> whereBetween ('date_until', [$from, $to])
                        ->where(function ($query) {
                            $query->where('movement_types_id', '=', 1)
                                  ->orWhere('movement_types_id', '=', 2);
                        })
                        ->where('active', 1)                 
                        ->get();
                    }
                }else{
                    if($request->get('fecha_desde') != '' && $request->get('fecha_hasta') == ''){
                        $fecha_desde = Carbon::createFromFormat('d/m/Y', $request->get('fecha_desde'));
        
                        $prestamos = Book_movement::with('copy.document','user','course', 'copy.document', 'copy.document.document_type')
                        // ->whereDate('date_until', $fecha_desde)
                        ->where('date_until', '>=', $fecha_desde)
                        ->where(function ($query) {
                            $query->where('movement_types_id', '=', 1)
                                  ->orWhere('movement_types_id', '=', 2);
                        })
                        ->where('active', 1)                
                        ->get();
                    }

                    if($request->get('fecha_desde') == '' && $request->get('fecha_hasta') != ''){
                        $fecha_hasta = Carbon::createFromFormat('d/m/Y', $request->get('fecha_hasta'));
        
                        $prestamos = Book_movement::with('copy.document','user','course', 'copy.document', 'copy.document.document_type')
                        // ->whereDate('date_until', $fecha_desde)
                        ->where('date_until', '<=', $fecha_hasta)
                        ->where(function ($query) {
                            $query->where('movement_types_id', '=', 1)
                                  ->orWhere('movement_types_id', '=', 2);
                        })
                        ->where('active', 1)                
                        ->get();
                    }

                }
                
            }
            

        
            return dataTables::of($prestamos)

            ->addColumn('registry_number', function ($prestamos){
                return $prestamos->copy->registry_number;            
            })
            ->addColumn('tipo_movimiento', function ($prestamos){
                return $prestamos->movement_type['description_movement'];            
            })
            ->addColumn('documento', function ($prestamos){
                return $prestamos->copy->document['title'];            
            })
            ->addColumn('tipo', function ($prestamos){
                return $prestamos->copy->document->document_type['document_description'];               
            })
            ->addColumn('subtipo', function ($prestamos){
                return $prestamos->copy->document->document_subtype['subtype_name'];               
            }) 
            ->addColumn('membership', function ($prestamos){
                return $prestamos->user['membership'];               
            })
            ->addColumn('usuario', function ($prestamos){
                return $prestamos->user['name'];               
            })
            // ->addColumn('curso', function ($prestamos){
            //     return $prestamos->course['course_name'];               
            // })                          
            ->addColumn('created_at', function ($prestamos){
                return $prestamos->created_at->format('d-m-y');
            })                 
            
            // ->addColumn('accion', function ($prestamos) {
            //     // 'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',  
            //     return view('admin.prestamoss.partials._action', [
            //         'prestamos'             => $prestamos,
            //         'url_show'          => route('admin.prestamoss.show', $prestamos->id),                        
            //         'url_edit'          => route('admin.prestamoss.edit', $prestamos->id),  
            //         'url_copy'          => route('prestamoss.copy', $prestamos->document->id),                              
            //         'url_desidherata'   => route('prestamoss.desidherata', $prestamos->document->id),
            //         'url_baja'          => route('prestamoss.baja', $prestamos->document->id),
            //         'url_reactivar'     => route('prestamoss.reactivar', $prestamos->document->id),
            //         'url_print'         => route('cine.pdf', $prestamos->id)   
            //     ]);

            // })           
            ->addIndexColumn()   
            ->rawColumns(['registry_number', 'documento', 'tipo', 'subtipo','membership', 'usuario','tipo_movimiento']) 
            ->make(true);  
        
    }
}
