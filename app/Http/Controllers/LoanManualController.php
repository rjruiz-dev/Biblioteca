<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Document;
use Carbon\Carbon;
use App\planes;
use App\Document_type;
use App\Document_subtype;
use App\Book_movement;
use App\Copy;
use App\Ml_web_loan;
use App\Ml_manual_loan;
use App\Setting;
use App\User;
use App\Course;
use App\Ml_dashboard;
use App\ManyLenguages;
use Illuminate\Support\Facades\DB;
use DataTables;

class LoanManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first(); 
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.

        $c_documentos     = Document::selectRaw('count(*) documents')->first();       
        $c_socios         = User::selectRaw('count(*) users')->first();    
        $advertencia = "";
        $plan_actual = planes::where('id', $setting->id_plan)->first();
        if($plan_actual == null){
            $plan_actual = planes::where('id', 1)->first();
        }
        $plan = $plan_actual->nombre_plan;
        if($plan_actual->id == 999){ // 999 es el plan premium
        if( ($c_documentos >= $plan_actual->cantidad_documentos ) || ($c_socios >= $plan_actual->cantidad_socios ) ){
            $advertencia = "Por favor actualice a una versión superior, esta llegando al limite de su capacidad";
        
        }
        }

        $Ml_manual_loan     = Ml_manual_loan::where('many_lenguages_id',$session)->first();
       
        // dd($idioma->navegacion);
        return view('admin.loanmanual.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan, 
            'setting'   => $setting,
            'Ml_manual_loan' => $Ml_manual_loan
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

    public function showPartner(Request $request, $id)
    {
        $partner = User::findOrFail($id)->toArray();
     
        $count = Book_movement::where('users_id', $id) //FILTRAR POR EL USUARIO ESE 
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
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

    public function abm_prestamo(Request $request, $id, $bandera, $n_mov)
    {
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        
        $c_documentos     = Document::selectRaw('count(*) documents')->first();       
        $c_socios         = User::selectRaw('count(*) users')->first();    
        $advertencia = "";
        $setting    = Setting::where('id', 1)->first(); 
        $plan_actual = planes::where('id', $setting->id_plan)->first();
        if($plan_actual == null){
            $plan_actual = planes::where('id', 1)->first();
        }
        $plan = $plan_actual->nombre_plan;
        if($plan_actual->id == 999){ // 999 es el plan premium
        if( ($c_documentos >= $plan_actual->cantidad_documentos ) || ($c_socios >= $plan_actual->cantidad_socios ) ){
            $advertencia = "Por favor actualice a una versión superior, esta llegando al limite de su capacidad";
        
        }
        }

        $setting    = Setting::where('id', 1)->first(); 
        // dd($idioma->navegacion);
        
        $Ml_manual_loan     = Ml_manual_loan::where('many_lenguages_id',$session)->first();
       

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
        // aca tenia seteado el 1 deberia de variar revisar por las dudas.
        $users = User::where('status_id', 3)->get()->pluck('nickname', 'id');
        
        $courses = Course::where('baja', 0)->pluck('course_name', 'id');

        $hasta_prestamo_parce = Setting::select('loan_day')->first();
        $hastaprestamo = $hasta_prestamo_parce->loan_day;
        //seguir desde aca el hilo para ver si tiene una bandera para enviar el mail sabiendo q todo
        //parte de una solicitud. hay una bandera q al menos al front se pasa y tmb se pasa prestamo
        //solicitado.
        return view('admin.loanmanual.prestar', [
            'idioma'        => $idioma,
            'idiomas'       => $idiomas,
            'documento'     => $documento,
            'copies'        => $copies,
            'users'         => $users,       
            'advertencia' => $advertencia,
            'plan' => $plan,      
            'courses'       => $courses,
            'hastaprestamo' => $hastaprestamo,
            'bandera'       => $bandera,
            'setting'       => $setting,
            'prestamo_solicitado'   => $prestamo_solicitado, 
            'n_mov'                 => $n_mov,
            'Ml_manual_loan' => $Ml_manual_loan
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
                    
                    $hora_declarada = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));
                    // $hora_declarada = $request->get('acquired');
                    $hora_modificada = date_time_set($hora_declarada, 23, 59, 59);
                    $new_movement->date_until = $hora_modificada; 
                    $new_movement->active = 1; 
            
                    $new_movement->save();
            
            
                    DB::commit();

                    $error = 0; // error en 0 es error NO osea NO hay ERROR
                    }else{ 
                        $error = 1; // error en 1 es error Si osea HAY ERROR

                    }

                    $session = session('idiomas');
                    $Ml_manual_loan = Ml_manual_loan::where('many_lenguages_id',$session)->first();
                    return response()->json(['bandera' => $request->get('bandera'),'id' => $id,'error' => $error, 'mensaje_exito_prestar' => $Ml_manual_loan->mensaje_exito_prestar, 'noti_prestamo_exitoso' => $Ml_manual_loan->noti_prestamo_exitoso]);


                    // return response()->json(array('bandera' => $request->get('bandera'),'id' => $id,'error' => $error));
                
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
        // $documentos = Copy::with('document','document.document_type','document.document_subtype')       
        // ->groupBy('documents_id')
        // ->get();

        // $copies = Copy::where('documents_id', $documento->id)->first();

       $documentos = DB::select('SELECT d.id, d.title, dt.document_description, ds.subtype_name, count(c.id) as copias 
                        FROM copies c 
                        LEFT JOIN documents d ON d.id = c.documents_id 
                        LEFT JOIN document_types dt ON d.document_types_id = dt.id 
                        LEFT JOIN document_subtypes ds ON d.document_subtypes_id = ds.id 
                        WHERE c.status_copy_id = 3 OR c.status_copy_id = 6
                        GROUP BY d.id, d.title, dt.document_description, ds.subtype_name');
      
        return dataTables::of($documentos)
            // ->addColumn('id_doc', function ($documentos) {
            //     return $documentos->document['id']."<br>";            
            // })
            // ->addColumn('titulo', function ($documentos) {
            //     return $documentos->document['title']."<br>";            
            // })
            // ->addColumn('tipo_documento', function ($documentos) {
            //     return $documentos->document->document_type['document_description']."<br>";            
            // }) 
            // ->addColumn('sub_tipo_documento', function ($documentos){
            //     return $documentos->document->document_subtype['subtype_name'];              
            // })             
         
            // ->addColumn('created_at', function ($documentos){
            //     return $documentos->created_at->format('d-m-y');
            // })                 
            
            ->addColumn('accion', function ($documentos) {
                return view('admin.loanmanual.partials._action', [
                    'documentos' => $documentos,
                                             
                    'url_edit' => route('loanmanual.abm_prestamo', ['id' =>  $documentos->id, 'bandera' =>  1 , 'n_mov' =>  0 ]),        
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['accion']) 
            ->make(true);  
    }
}
