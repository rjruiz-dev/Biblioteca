<?php

namespace App\Http\Controllers;

use App\User;
use App\Fine;
use App\Statu;
use App\planes;
use App\Ml_loan_partner;
use App\Ml_loan_document;
use App\Copy;
use DataTables;
use App\Document;
use Carbon\Carbon;
use App\Setting;
use App\ml_fines;
use App\Book_movement;
use App\Document_type;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Document_subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FastPartnerProcessController extends Controller
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

        $Ml_loan_partner     = Ml_loan_partner::where('many_lenguages_id',$session)->first();
        $Ml_loan_document     = Ml_loan_document::where('many_lenguages_id',$session)->first();
        
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

        // dd($idioma->navegacion);
        return view('admin.fastprocess.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'Ml_loan_partner' => $Ml_loan_partner,
            'Ml_loan_document' => $Ml_loan_document
        ]);         
    }

    public function index2(Request $request)
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

        $Ml_loan_document     = Ml_loan_document::where('many_lenguages_id',$session)->first();
        
        
        return view('admin.fastprocess.index2', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'   => $setting,
            'Ml_loan_document' => $Ml_loan_document
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
    public function store(Request $request, $count)
    {        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $movement = new Book_movement;
                
                for ($i = 1; $i <= $count; $i++)
                {
                    $request->$i = $request->get('$i');
                }        
                $document->save();          

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
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

    public function vista_devo_reno($id, $bandera, $fecha)
    {   
        // $setting    = Setting::where('id', 1)->first(); 
        $setting = Setting::select('loan_day')->first();    
        $dias_de_prestamo = $setting->loan_day;
        return view('admin.fastprocess.partials.form', [         
            'id'        => $id,
            'bandera'   => $bandera,
            'fecha'     => $fecha,
            'setting'   => $setting,
            'dias_de_prestamo'   => $dias_de_prestamo
        ]); 
    }

    public function grabar(Request $request)
    {
        if ($request->ajax()){
            try {
                // dd($request->get('id'));
                //  Transacciones
                DB::beginTransaction();
                $error = 1; //error en 1 es error SI
                $movement_doc = Book_movement::where('copies_id', $request->get('id'))->where('active', 1)->get();
                // $movement_doc = Book_movement::findOrFail($request->get('id'));
                // dd($movement_doc->count());
                if($movement_doc->count() == 1){

                    $copy = Copy::findOrFail($request->get('id'));

                    $new_movement = new Book_movement;

                    foreach($movement_doc as $t){
                        $t->active = 0;
                        $new_movement->users_id = $t->users_id; 
                        $new_movement->copies_id = $t->copies_id;
                        $t->save();
                    }
                //hago un update de al movimiento anterior para indicar que ya NO SERA EL ULTIMO MOVIMIENTO
                //DE ESE DOCUMENTO. ESTO SIRVE PARA MOSTRAR BASICAMENTE EL ESTADO ACTUAL DEL DOCUMENTO.

                 //CREO UN NUEVO MOVIMIENTO EN ESTA TABLA PARA INDICAR QUE SE DEVOLVIO EL MISMO EN ESTE CASO.
                
        
                if($request->get('bandera') == 1)
                {
                    $new_movement->movement_types_id = 3; //DEVOLUCION (valores correspondientes a la base)
                    $copy->status_copy_id = 3;
                    $renodev = 3;
            
                }else{
                    $new_movement->movement_types_id = 2; //RENOVACION (valores correspondientes a la base)
                    $new_movement->date_until = Carbon::createFromFormat('d-m-Y', $request->get('acquired'));   
                    $copy->status_copy_id = 2;
                    $renodev = 2;
                }

                
                $new_movement->courses_id = 1; //le pongo 1 xq ni idea si va o no
                $new_movement->date = Carbon::now();
                $new_movement->active = 1; 
                
                $copy->save(); 
                $new_movement->save();
                
                $error = 0; //error en 0 es error NO

                DB::commit();
            }else{
                $error = 1; //error en 1 es error SI
                $renodev = 0; // le mando 0 pera que no rompa las bolas pero no sirve para nada
            }
            
                $session = session('idiomas');
                $Ml_loan_generica = Ml_loan_document::where('many_lenguages_id',$session)->first();
                return response()->json(['renodev' => $renodev,'error' => $error, 'mensaje_exito_ld' => $Ml_loan_generica->mensaje_exito_ld, 'noti_devolucion_ld' => $Ml_loan_generica->noti_devolucion_ld, 'noti_renovacion_ld' => $Ml_loan_generica->noti_renovacion_ld]);

            // return response()->json(array('renodev' => $renodev,'error' => $error));
                
                } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            } 
        } 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
        $traduccion_multa     = ml_fines::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        $setting    = Setting::where('id', 1)->first(); 
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

        $setting    = Setting::where('id', 1)->first();

        $Ml_loan_partner     = Ml_loan_partner::where('many_lenguages_id',$session)->first();
        
        $Ml_loan_document     = Ml_loan_document::where('many_lenguages_id',$session)->first();
                 
        $user = User::findOrFail($id); //datos del socio 
        
        $docs_of_user = Book_movement::with('movement_type', 'copy', 'copy.document.creator')
        ->whereHas('copy', function($q)
        {
            $q->where(function ($query) {
                $query->where('status_copy_id', '=', 1)
                      ->orWhere('status_copy_id', '=', 2);
            });
        })
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
        })
        ->where('active', 1) 
        ->where('users_id', $id)->get();

        $setting_fines_id = Setting::select('fines_id')->first();
     
        $multa = Fine::where('id', $setting_fines_id->fines_id)->first();
    
        return view('admin.fastprocess.prestamo', [
            'user'          => $user,
            'docs_of_user'  => $docs_of_user,
            'idioma'        => $idioma,
            'idiomas'       => $idiomas,
            'setting'       => $setting,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'multa'         => $multa,
            'traduccion_multa' => $traduccion_multa,
            'Ml_loan_partner' => $Ml_loan_partner,
            'Ml_loan_document' =>  $Ml_loan_document  
        ]);
    }

    
    public function edit2(Request $request, $id)
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

        $setting    = Setting::where('id', 1)->first();
        $traduccion_multa     = ml_fines::where('many_lenguages_id',$session)->first();
        
        $Ml_loan_document     = Ml_loan_document::where('many_lenguages_id',$session)->first();
        

        $documento = Document::with('document_type','document_subtype','creator')
        ->findOrFail($id); 
        
        $copies_prestadas = Book_movement::with('movement_type','copy', 'copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id)->where(function ($query) {
                $query->where('status_copy_id', '=', 1)
                      ->orWhere('status_copy_id', '=', 2);
            });
        
        })
        ->where('active', 1)
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
        })   
        ->get();
    //    dd($copies_prestadas);
        // traemos todas las copias prestadas actualmente. se incluyen las que estan en PRESTAMOS como en 
     // RENOVACION. osea tipo movimiento 1 y 2 en tabla tipos de movimientos.

     $copies_disponibles = Book_movement::with('movement_type','copy.document.creator','user')
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id)->where(function ($query) {
                $query->where('status_copy_id', '=', 3)
                      ->orWhere('status_copy_id', '=', 6);
            });
        
        })
        ->where('active', 1) 
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 3)
                  ->orWhere('movement_types_id', '=', 6);
        })    
        ->get();
        // traemos todas las copias prestadas actualmente. se incluyen las que estan en DEVOLUCION como en 
     // DISPONIBILIDAD. osea tipo movimiento 3 y 6 en tabla tipos de movimientos.

     $copies_solicitadas = Book_movement::with('movement_type','copy.document.creator','user')
     ->whereHas('copy', function($q) use ($id)
     {
         $q->where('documents_id', '=', $id)->where('status_copy_id', '=', 7);
     
     })
     ->where('active', 1) 
     ->where('movement_types_id', '=', 7)    
     ->get();

     $copies_mantenimiento = Book_movement::with('movement_type','copy.document.creator','user')
     ->whereHas('copy', function($q) use ($id)
     {
         $q->where('documents_id', '=', $id)->where('status_copy_id', '=', 5);
     
     })
     ->where('active', 1) 
     ->where('movement_types_id', '=', 5)    
     ->get();

     $copies_baja = Book_movement::with('movement_type','copy.document.creator','user')
     ->whereHas('copy', function($q) use ($id)
     {
         $q->where('documents_id', '=', $id)->where('status_copy_id', '=', 4);
     
     })
     ->where('active', 1) 
     ->where('movement_types_id', '=', 4)    
     ->get();

     $setting_fines_id = Setting::select('fines_id')->first();
     
     $multa = Fine::where('id', $setting_fines_id->fines_id)->first();

    //  dd($copies_prestadas);

        return view('admin.fastprocess.prestamo2', [
            'documento'             => $documento,
            'copies_prestadas'      => $copies_prestadas,
            'copies_disponibles'    => $copies_disponibles,
            'copies_solicitadas'    => $copies_solicitadas,
            'copies_mantenimiento'  => $copies_mantenimiento,
            'copies_baja'           => $copies_baja,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'idioma'                => $idioma,
            'idiomas'               => $idiomas,
            'multa'                 => $multa,
            'setting'               => $setting,
            'traduccion_multa' => $traduccion_multa,
            'Ml_loan_document' => $Ml_loan_document
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
        $usuarios = DB::select('SELECT u.id, u.membership, u.nickname, u.name, u.email, s.state_description 
                                FROM book_movements bm 
                                LEFT JOIN users u ON bm.users_id = u.id 
                                LEFT JOIN status s ON u.status_id = s.id
                                WHERE ( bm.movement_types_id = 1 OR bm.movement_types_id = 2 )
                                AND bm.active = 1
                                AND bm.users_id IS NOT NULL
                                GROUP BY u.id, u.membership, u.nickname, u.name, u.email, s.state_description');

        // $usuarios = Book_movement::with('user','user.statu')
        // ->groupBy('type', 'import_year')
        // ->where('active', 1)   
        // ->get();

        // $usuarios = User::with('statu')->where('status_id', 3)      
        // ->allowed()
        // ->get();
      
        return dataTables::of($usuarios)
            // ->addColumn('membership', function ($usuarios){
            //     if($usuarios->membership == null){
            //         return 'Sin Núm. de socio';
            //     }else{
            //         return '<i class="fa fa-check"></i>'.' '.$usuarios->membership;           
            //     }
            // }) 
            // ->addColumn('nickname', function ($usuarios){
            //     return $usuarios->nickname;      
                         
            // }) 
            // ->addColumn('name', function ($usuarios){
            //     return
            //         '<i class="fa fa-user"></i>'.' '.$usuarios->name;
                                        
            // }) 
            // ->addColumn('email', function ($usuarios){
            //     return                    
            //         '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            // })             
            ->addColumn('status_id', function ($usuarios){

                if($usuarios->state_description == 'Inactivo'){    

                    return '<span class="label label-danger sm">'.$usuarios->state_description.'</span>';
                }
                if ($usuarios->state_description == 'Pendiente'){

                    return '<span class="label label-warning sm">'.$usuarios->state_description.'</span>';

                }else{

                    return '<span class="label label-success sm">'.$usuarios->state_description.'</span>';
                }              
            })    
            // ->addColumn('created_at', function ($usuarios){
            //     return $usuarios->created_at->format('d-m-y');
            // })                 
            
            ->addColumn('accion', function ($usuarios) {
                return view('admin.fastprocess.partials._action', [
                    'usuarios' => $usuarios,
                                            
                    'url_edit' => route('admin.fastprocess.edit', $usuarios->id),                              
                    
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['status_id',  'accion'])  
            ->make(true);  
    }

    
    public function dataTable2()
    {                    
        // $documentos = Document::with('document_type','document_subtype')       
        // // ->allowed()
        // ->get();
        $documentos = DB::select('SELECT d.id, d.title, dt.document_description, ds.subtype_name, count(c.id) as copias 
                                FROM book_movements bm 
                                LEFT JOIN copies c ON bm.copies_id = c.id
                                LEFT JOIN documents d ON c.documents_id = d.id
                                LEFT JOIN document_types dt ON d.document_types_id = dt.id 
                                LEFT JOIN document_subtypes ds ON d.document_subtypes_id = ds.id 
                                WHERE ( bm.movement_types_id = 1 OR bm.movement_types_id = 2 )
                                AND bm.active = 1
                                GROUP BY d.id, d.title, dt.document_description, ds.subtype_name');


        //  $documentos = DB::select('SELECT d.id, d.title, dt.document_description, ds.subtype_name, count(c.id) as copias 
        //                 FROM copies c 
        //                 LEFT JOIN documents d ON d.id = c.documents_id 
        //                 LEFT JOIN document_types dt ON d.document_types_id = dt.id 
        //                 LEFT JOIN document_subtypes ds ON d.document_subtypes_id = ds.id 
        //                 WHERE c.status_copy_id = 3 
        //                 OR c.status_copy_id = 6
        //                 OR c.status_copy_id = 1
        //                 OR c.status_copy_id = 2
        //                 GROUP BY d.id, d.title, dt.document_description, ds.subtype_name');
      
        return dataTables::of($documentos)
            // ->addColumn('tipo_documento', function ($documentos){
            //     return $documentos->document_type['document_description']."<br>";            
            // }) 
            // ->addColumn('sub_tipo_documento', function ($documentos){
            //     return $documentos->document_subtype['subtype_name'];              
            // })             
         
            // ->addColumn('created_at', function ($documentos){
            //     return $documentos->created_at->format('d-m-y');
            // })                 
            
            ->addColumn('accion', function ($documentos) {
                return view('admin.fastprocess.partials._action2', [
                    'documentos' => $documentos,
                                            
                    'url_edit' => route('fastprocess.edit2', $documentos->id),                              
                    
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['accion']) 
            ->make(true);  
    }
}

