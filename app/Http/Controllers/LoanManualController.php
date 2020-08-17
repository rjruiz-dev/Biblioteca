<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Document;
use Carbon\Carbon;
use App\Document_type;
use App\Document_subtype;
use App\Book_movement;
use App\Copy;
use App\Setting;
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

        $maximo_dias_parce = Setting::select('loan_limit')->first();
        // $maximo_dias = $maximo_dias_parce->loan_limit;

        // dd($maximo_dias);       

     
        if($request->ajax())
        {
            // return response()->json(
            //     $partner->toArray(),
            //     $count->toArray()
            // );

            // return $partner->toJson();
            return response()->json(array('partner'=>$partner,'count'=>$count,'limit'=>$maximo_dias_parce));

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
        if($n_mov != 0){ // si se pasa n_mov con NO 0 es xq carga una solicitud
        $prestamo_solicitado = Book_movement::with('movement_type','user','copy.document.document_type','copy.document.document_subtype','course')->findOrFail($n_mov);       
        }else{
            $prestamo_solicitado = null;  
        }

        
        $documento = Document::with('document_type','document_subtype','creator')->findOrFail($id); 
        
        if($n_mov != 0){ // si se pasa n_mov con NO 0 es xq carga una solicitud y tiene que cargar solo una copia

            $copies = Copy::where('documents_id', $documento->id)
            ->where('status_copy_id', '=', 7)
            ->first() 
            // se le pone first para que si o si cargue una sola copia y no explote la pantalla y 
            //muestre al menos el template de prestamos para luego en tal caso mostrar el error 
            //cuando se de boton "Prestar"
            ->pluck('registry_number', 'id');

         }else{// sino que cargue el listado de copias disponibles y devueltas(osea tmb disponibles).
            
        $copies = Copy::where('documents_id', $documento->id)
        ->where(function ($query) {
            $query->where('status_copy_id', '=', 3)
                  ->orWhere('status_copy_id', '=', 6);
        })
        ->get()
        ->pluck('registry_number', 'id');
    }
        
        $users = User::where('status_id', 1)->get()->pluck('name', 'id');
        
        $courses = Course::all()->pluck('course_name', 'id');

        $hasta_prestamo_parce = Setting::select('loan_day')->first();
        $hastaprestamo = $hasta_prestamo_parce->loan_day;

        return view('admin.loanmanual.prestar', [
            'documento'     => $documento,
            'copies'        => $copies,
            'users'         => $users,
            // 'partners'      => $partners,
            'courses'       => $courses,
            'hastaprestamo'       => $hastaprestamo,
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
    {       // el id que es el id del documento se pasa solo para direccionar a ese documento si se accede a esta vista
            // desde la pantalla prestamos y devoluciones.
        if ($request->ajax()){
            try {

                DB::beginTransaction();
                
                
                // $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->first();
                $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->get();
                $error = 1; // error en 1 es error Si osea HAY ERROR
                if($movement_doc->count() == 1){
                    
                    $copy = Copy::findOrFail($request->get('copies_id'));
                    $copy->status_copy_id = 1;
                    $copy->save(); 

                    foreach($movement_doc as $t){
                        $t->active = 0;
                        $t->save(); 
                    } 

                    $new_movement = new Book_movement;
                    $new_movement->movement_types_id = 1; //PRESTAMO
            
                    $new_movement->users_id = $request->get('users_id');
                    $new_movement->copies_id = $request->get('copies_id');
                    $new_movement->courses_id = $request->get('course_id');
                    $new_movement->grupo = $request->get('grupo');
                    $new_movement->turno = $request->get('turno');
                    $new_movement->date = Carbon::now();            
                    $new_movement->date_until = Carbon::createFromFormat('d/m/Y', $request->get('acquired')); 
                    $new_movement->active = 1; 
            
                    $new_movement->save();
            
            
                    DB::commit();

                    $error = 0; // error en 0 es error NO osea NO hay ERROR
                    }else{ 
                        $error = 1; // error en 1 es error Si osea HAY ERROR

                    }

                    return response()->json(array('bandera' => $request->get('bandera'),'id' => $id,'error' => $error));
                
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
