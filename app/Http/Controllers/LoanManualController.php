<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Document;
use Carbon\Carbon;
use App\Document_type;
use App\Document_subtype;
use App\Book_movement;
use App\Copy;
use App\User;
use App\Course;
use Illuminate\Support\Facades\DB;
use DataTables;

class LoanManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.loanmanual.index');
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

    public function showPartner(Request $request, $id)
    {
        $partner = User::findOrFail($id)->toArray();

        $count = Book_movement::where('users_id', $id) //FILTRAR POR EL USUARIO ESE 
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 3)
                  ->orWhere('movement_types_id', '=', 6);
        })->where('active', 1)
        ->select(DB::raw('count(*) as count_of_prestamos'))
        ->get()->first()
        ->toArray();

        // dd($count);       
     
        if($request->ajax())
        {
            // return response()->json(
            //     $partner->toArray(),
            //     $count->toArray()
            // );
            // return $partner->toJson();
            return response()->json(array('partner'=>$partner,'count'=>$count));
            // return $count->toJson();
          
        }  

        return response()->json(['message' => 'recibimos el request pero no es ajax']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
 
    //     $documento = Document::with('document_type','document_subtype','creator')->findOrFail($id); 
                
    //     $copies = Copy::where('documents_id', $documento->id)
    //     ->where(function ($query) {
    //         $query->where('status_copy_id', '=', 3)
    //               ->orWhere('status_copy_id', '=', 6);
    //     })
    //     ->get()
    //     ->pluck('registry_number', 'id');

    //     // dd($copies);
        
    //     $users = User::where('status_id', 1)->get()->pluck('name', 'id');
    //     // $partners = User::where('status_id', 1)->get();
    //     // $partner = User::findOrFail($id);
    //     // $users = Book_movement::with('user')->where('users_id', $partner->id)
    //     // ->where(function ($query) {
    //     //     $query->where('status_id', '=', 1);
                 
    //     // })
    //     // ->get()
    //     // ->pluck('name', 'id');
    //     // dd($users);
        
    //     $courses = Course::all()->pluck('course_name', 'id');

    //     return view('admin.loanmanual.prestar', [
    //         'documento'     => $documento,
    //         'copies'        => $copies,
    //         'users'         => $users,
    //         // 'partners'      => $partners,
    //         'courses'       => $courses,
    //         // 'bandera'          => $bandera,
    //         // 'turnos'          => $turnos
    //     ]);    
    // }

    public function abm_prestamo($id, $bandera, $n_mov)
    {
        if($n_mov != 0){
        $prestamo_solicitado = Book_movement::with('movement_type','user','copy.document.document_type','copy.document.document_subtype','course')->findOrFail($n_mov);       
        }else{
            $prestamo_solicitado = null;  
        }

        
        $documento = Document::with('document_type','document_subtype','creator')->findOrFail($id); 
                
        $copies = Copy::where('documents_id', $documento->id)
        ->where(function ($query) {
            $query->where('status_copy_id', '=', 3)
                  ->orWhere('status_copy_id', '=', 6);
        })
        ->get()
        ->pluck('registry_number', 'id');

        // dd($copies);
        
        $users = User::where('status_id', 1)->get()->pluck('name', 'id');
        // $partners = User::where('status_id', 1)->get();
        // $partner = User::findOrFail($id);
        // $users = Book_movement::with('user')->where('users_id', $partner->id)
        // ->where(function ($query) {
        //     $query->where('status_id', '=', 1);
                 
        // })
        // ->get()
        // ->pluck('name', 'id');
        // dd($users);
        
        $courses = Course::all()->pluck('course_name', 'id');

        return view('admin.loanmanual.prestar', [
            'documento'     => $documento,
            'copies'        => $copies,
            'users'         => $users,
            // 'partners'      => $partners,
            'courses'       => $courses,
            'bandera'          => $bandera,
            'prestamo_solicitado' => $prestamo_solicitado, 
            'n_mov'          => $n_mov
        ]);    
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
        if ($request->ajax()){
            try {
            
                //  Transacciones
                DB::beginTransaction();
                $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->first();
                // dd($movement_doc);
                if($movement_doc){//si encuentra movimientos.
                    $movement_doc->active = 0; 
                }
                //hago un update de al movimiento anterior para indicar que ya NO SERA EL ULTIMO MOVIMIENTO
                //DE ESE DOCUMENTO. ESTO SIRVE PARA MOSTRAR BASICAMENTE EL ESTADO ACTUAL DEL DOCUMENTO.

                 //CREO UN NUEVO MOVIMIENTO EN ESTA TABLA PARA INDICAR QUE SE DEVOLVIO EL MISMO EN ESTE CASO.
                $new_movement = new Book_movement;
        
                
                    $new_movement->movement_types_id = 1; //DEVOLUCION
                

                $new_movement->users_id = $request->get('users_id');
                $new_movement->copies_id = $request->get('copies_id');
                $new_movement->courses_id = $request->get('course_id');
                $new_movement->grupo = $request->get('grupo');
                $new_movement->turno = $request->get('turno'); 
                $new_movement->active = 1; //LO PONGO EN ACTIVO PARA SEÑALAR
                
                $new_movement->save();
                
                if($movement_doc){
                    $movement_doc->save();
                    }
                DB::commit();

                // return response()->json(['bandera' => $request->get('bandera')]);
                return response()->json(array('bandera' => $request->get('bandera'),'id' => $id));
                // array('partner'=>$partner,'count'=>$count)
                } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            } 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($request->ajax()){
            try {
            
                //  Transacciones
                DB::beginTransaction();
                $movement_doc = Book_movement::findOrFail($request->get('id'));
                $movement_doc->active = 0;
                //hago un update de al movimiento anterior para indicar que ya NO SERA EL ULTIMO MOVIMIENTO
                //DE ESE DOCUMENTO. ESTO SIRVE PARA MOSTRAR BASICAMENTE EL ESTADO ACTUAL DEL DOCUMENTO.

                 //CREO UN NUEVO MOVIMIENTO EN ESTA TABLA PARA INDICAR QUE SE DEVOLVIO EL MISMO EN ESTE CASO.
                $new_movement = new Book_movement;
        
                if($request->get('bandera') == '1')
                {
                    $new_movement->movement_types_id = 3; //DEVOLUCION (valores correspondientes a la base)
                }else{
                    $new_movement->movement_types_id = 2; //RENOVACION (valores correspondientes a la base)
                }

                $new_movement->users_id = $movement_doc->users_id;
                $new_movement->copies_id = $movement_doc->copies_id;
                $new_movement->courses_id = 1; //le pongo 1 xq ni idea si va o no
                $new_movement->active = 1;
                $movement_doc->save();
                $new_movement->save();

                DB::commit();

                } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            } 
        }
    }

    public function dataTable()
    {                    
        $documentos = Document::with('document_type','document_subtype')       
        // ->allowed()
        ->get();
      
        return dataTables::of($documentos)
            ->addColumn('tipo_documento', function ($documentos){
                return
                    '<i class="fa fa-user"></i>'.' '.$documentos->document_type['document_description']."<br>";            
            }) 
            ->addColumn('sub_tipo_documento', function ($documentos){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$documentos->document_subtype['subtype_name'];              
            })             
         
            ->addColumn('created_at', function ($documentos){
                return $documentos->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($documentos) {
                return view('admin.loanmanual.partials._action', [
                    'documentos' => $documentos,
                                             
                    'url_edit' => route('loanmanual.abm_prestamo', ['id' =>  $documentos->id, 'bandera' =>  1 , 'n_mov' =>  0 ]),        
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['tipo_documento', 'sub_tipo_documento', 'created_at', 'accion']) 
            ->make(true);  
    }
}
