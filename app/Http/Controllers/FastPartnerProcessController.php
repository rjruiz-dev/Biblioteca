<?php

namespace App\Http\Controllers;

use App\User;
use App\Statu;
use App\Copy;
use DataTables;
use App\Document;
use Carbon\Carbon;
use App\Setting;
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

        //cargo el idioma
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
        // dd($idioma->navegacion);
        return view('admin.fastprocess.index', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
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
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
        // dd($idioma->navegacion);
        return view('admin.fastprocess.index2', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
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
        $setting = Setting::select('loan_day')->first();
        $dias_de_prestamo = $setting->loan_day;
        return view('admin.fastprocess.partials.form', [         
            'id'        => $id,
            'bandera'   => $bandera,
            'fecha'   => $fecha,
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
            return response()->json(array('renodev' => $renodev,'error' => $error));
                
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
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
                 
        $user = User::findOrFail($id); //datos del socio 
        
        $docs_of_user = Book_movement::with('movement_type','copy.document.creator')
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
        })
        ->where('active', 1) 
        ->where('users_id', $id)->get();
     
        return view('admin.fastprocess.prestamo', [
            'user'          => $user,
            'docs_of_user'  => $docs_of_user,
            'idioma'        => $idioma,
            'idiomas'       => $idiomas
       
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
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();

        $documento = Document::with('document_type','document_subtype','creator')
        ->findOrFail($id); 
        
        $copies_prestadas = Book_movement::with('movement_type','copy.document.creator','user')
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

        return view('admin.fastprocess.prestamo2', [
            'documento'             => $documento,
            'copies_prestadas'      => $copies_prestadas,
            'copies_disponibles'    => $copies_disponibles,
            'copies_solicitadas'    => $copies_solicitadas,
            'copies_mantenimiento'  => $copies_mantenimiento,
            'copies_baja'           => $copies_baja,
            'idioma'                => $idioma,
            'idiomas'               => $idiomas
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
        $usuarios = User::with('statu')->where('status_id', 1)      
        // ->allowed()
        ->get();
      
        return dataTables::of($usuarios)
            ->addColumn('membership', function ($usuarios){
                if($usuarios->membership == null){
                    return 'Sin Núm. de socio';
                }else{
                    return '<i class="fa fa-check"></i>'.' '.$usuarios->membership;           
                }
            }) 
            ->addColumn('nickname', function ($usuarios){
                return $usuarios->nickname;      
                         
            }) 
            ->addColumn('name', function ($usuarios){
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name;
                                        
            }) 
            ->addColumn('email', function ($usuarios){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            })             
            ->addColumn('status_id', function ($usuarios){

                if($usuarios->statu['state_description'] == 'Inactivo'){    

                    return '<span class="label label-danger sm">'.$usuarios->statu['state_description'].'</span>';
                }
                if ($usuarios->statu['state_description'] == 'Pendiente'){

                    return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';

                }else{

                    return '<span class="label label-success sm">'.$usuarios->statu['state_description'].'</span>';
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
            ->rawColumns(['membership', 'nickname', 'name', 'email', 'status_id',  'accion']) 
            ->make(true);  
    }

    
    public function dataTable2()
    {                    
        // $documentos = Document::with('document_type','document_subtype')       
        // // ->allowed()
        // ->get();

         $documentos = DB::select('SELECT d.id, d.title, dt.document_description, ds.subtype_name, count(c.id) as copias 
                        FROM copies c 
                        LEFT JOIN documents d ON d.id = c.documents_id 
                        LEFT JOIN document_types dt ON d.document_types_id = dt.id 
                        LEFT JOIN document_subtypes ds ON d.document_subtypes_id = ds.id 
                        WHERE c.status_copy_id = 3 OR c.status_copy_id = 6
                        GROUP BY d.id, d.title, dt.document_description, ds.subtype_name');
      
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

