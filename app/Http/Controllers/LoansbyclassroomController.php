<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Book_movement;
use Carbon\Carbon;
use DataTables;

class LoansbyclassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Course::pluck('course_name', 'id');
        
        return view('admin.loansbyclassroom.index', [
            'cursos'     => $cursos,
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
            if($request->get('curso') == '' && $request->get('letra') == '' && $request->get('turno') == ''){
            
            
                $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                ->where(function ($query) {
                    $query->where('movement_types_id', '=', 1)
                          ->orWhere('movement_types_id', '=', 2);
                })
                ->where('active', 1)  
                ->get();

            }else{
                if($request->get('curso') != '' && $request->get('letra') != '' && $request->get('turno') != ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    ->where('courses_id', $request->get('curso'))
                    ->where('grupo', $request->get('letra'))
                    ->where('turno', $request->get('turno'))  
                    ->get();
                }
                // para todos 

                //solo NO curso
                if($request->get('curso') == '' && $request->get('letra') != '' && $request->get('turno') != ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    // ->where('courses_id', $request->get('curso'))
                    ->where('grupo', $request->get('letra'))
                    ->where('turno', $request->get('turno'))  
                    ->get();
                }
                //solo NO letra
                if($request->get('curso') != '' && $request->get('letra') == '' && $request->get('turno') != ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    ->where('courses_id', $request->get('curso'))
                    // ->where('grupo', $request->get('letra'))
                    ->where('turno', $request->get('turno'))  
                    ->get();
                }
                //solo NO turno
                if($request->get('curso') != '' && $request->get('letra') != '' && $request->get('turno') == ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    ->where('courses_id', $request->get('curso'))
                    ->where('grupo', $request->get('letra'))
                    // ->where('turno', $request->get('turno'))  
                    ->get();
                }
                 //solo curso
                if($request->get('curso') != '' && $request->get('letra') == '' && $request->get('turno') == ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    ->where('courses_id', $request->get('curso'))
                    // ->where('grupo', $request->get('letra'))
                    // ->where('turno', $request->get('turno'))  
                    ->get();
                }
                //solo letra
                if($request->get('curso') == '' && $request->get('letra') != '' && $request->get('turno') == ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    // ->where('courses_id', $request->get('curso'))
                    ->where('grupo', $request->get('letra'))
                    // ->where('turno', $request->get('turno'))  
                    ->get();
                }
                //solo turno
                if($request->get('curso') == '' && $request->get('letra') == '' && $request->get('turno') != ''){
                    $prestamos = Book_movement::with('copy.document.creator','user','copy.document.document_type','course', 'copy.document')              
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    // ->where('courses_id', $request->get('curso'))
                    // ->where('grupo', $request->get('letra'))
                    ->where('turno', $request->get('turno'))  
                    ->get();
                }






                // if($request->get('curso') != '' && $request->get('letra') != '' && $request->get('letra') != ''){


                //     if($request->get('fecha_desde') == $request->get('fecha_hasta')){
                //         // tomo desde o hasta no importa xq en teoria son iguales
                //         $misma = Carbon::createFromFormat('d/m/Y', $request->get('fecha_desde'));
        
                //         $prestamos = Book_movement::with('copy.document.creator','user','course', 'copy.document.creator', 'copy.document.document_type')
                //         ->whereDate('date_until', $misma)
                //         ->where(function ($query) {
                //             $query->where('movement_types_id', '=', 1)
                //                   ->orWhere('movement_types_id', '=', 2);
                //         })
                //         ->where('active', 1)                
                //         ->get();
        
                //     }else{
                //         $from = Carbon::createFromFormat('d/m/Y', $request->get('fecha_desde'));
                //         $to = Carbon::createFromFormat('d/m/Y', $request->get('fecha_hasta'));
                    
                //         $prestamos = Book_movement::with('copy.document.creator','user','course', 'copy.document', 'copy.document.document_type')
                //         // ->whereBetween('date_until', [$request->get('fecha_desde'), $request->get('fecha_desde')])
                //         // ->whereBetween('date_until', []) 
                //         -> whereBetween ('date_until', [$from, $to])
                //         ->where(function ($query) {
                //             $query->where('movement_types_id', '=', 1)
                //                   ->orWhere('movement_types_id', '=', 2);
                //         })
                //         ->where('active', 1)                 
                //         ->get();
                //     }
                // }else{
                //     if($request->get('fecha_desde') != '' && $request->get('fecha_hasta') == ''){
                //         $fecha_desde = Carbon::createFromFormat('d/m/Y', $request->get('fecha_desde'));
        
                //         $prestamos = Book_movement::with('copy.document','user','course', 'copy.document', 'copy.document.document_type')
                //         // ->whereDate('date_until', $fecha_desde)
                //         ->where('date_until', '>=', $fecha_desde)
                //         ->where(function ($query) {
                //             $query->where('movement_types_id', '=', 1)
                //                   ->orWhere('movement_types_id', '=', 2);
                //         })
                //         ->where('active', 1)                
                //         ->get();
                //     }

                //     if($request->get('fecha_desde') == '' && $request->get('fecha_hasta') != ''){
                //         $fecha_hasta = Carbon::createFromFormat('d/m/Y', $request->get('fecha_hasta'));
        
                //         $prestamos = Book_movement::with('copy.document','user','course', 'copy.document', 'copy.document.document_type')
                //         // ->whereDate('date_until', $fecha_desde)
                //         ->where('date_until', '<=', $fecha_hasta)
                //         ->where(function ($query) {
                //             $query->where('movement_types_id', '=', 1)
                //                   ->orWhere('movement_types_id', '=', 2);
                //         })
                //         ->where('active', 1)                
                //         ->get();
                //     }

                // }
                
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
            ->addColumn('creador', function ($prestamos){
                return $prestamos->copy->document->creator['creator_name'];            
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
            ->addColumn('curso', function ($prestamos){
                return $prestamos->course['course_name'];               
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
            ->rawColumns(['registry_number', 'documento', 'tipo','creador', 'subtipo','membership', 'usuario','curso']) 
            ->make(true);  
        
    }
}
