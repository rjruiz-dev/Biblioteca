<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Copy;
use App\User;
use App\Course;
use DataTables;
use App\planes;
use App\Providers\LibraryReport;
use App\ml_cat_sweetalert;
use App\Document;
use Carbon\Carbon;
use App\Ml_web_loan;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Document_type;
use App\Book_movement;
use App\Document_subtype;
use App\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
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

        $Ml_web_loan     = Ml_web_loan::where('many_lenguages_id',$session)->first();
        
        return view('admin.requests.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'   => $setting,
            'Ml_web_loan' => $Ml_web_loan
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
        $session = session('idiomas');
        $prestamo_solicitado = Book_movement::with('movement_type','user','copy.document.document_type','copy.document.document_subtype','course')->findOrFail($id);       
        $Ml_web_loan     = Ml_web_loan::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first(); 
        return view('admin.requests.show', [          
            'prestamo_solicitado'          => $prestamo_solicitado,
            'Ml_web_loan' => $Ml_web_loan,
            'setting' => $setting
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    public function desestimar($id)
    {
                DB::beginTransaction();
                
                // $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->first();
                $movement_doc = Book_movement::where('copies_id', $id)->where('active', 1)->get();
                $error = 1; // error en 1 es error Si osea HAY ERROR
                if($movement_doc->count() == 1){
                    
                    $copy = Copy::findOrFail($id);
                    $copy->status_copy_id = 8;
                    $copy->save(); 

                    foreach($movement_doc as $t){
                        $t->active = 0;
                        $t->save();

                        $new_movement = new Book_movement;

                        $new_movement->users_id = $t->users_id; 
                    } 

                    $new_movement->movement_types_id = 8; //PRESTAMO
            
                    $new_movement->copies_id = $id;
                   
                    $new_movement->active = 1; 
            
                    $new_movement->save();
            
            
                    DB::commit();

                    $error = 0; // error en 0 es error NO osea NO hay ERROR

                    //envio del mail.
                    
                    }else{ 
                        $error = 1; // error en 1 es error Si osea HAY ERROR
                    } 
                    $session = session('idiomas');
                    $Ml_web_loan = Ml_web_loan::where('many_lenguages_id',$session)->first();
                    return response()->json(['error' => $error, 'mensaje_exito' => $Ml_web_loan->mensaje_exito, 'resp_rechazar_solicitud' => $Ml_web_loan->resp_rechazar_solicitud]);

                    // return response()->json(['error' => $error]); 
    }


    public function solicitud($id)
    {   
        //recibimos como parametro id de documento
                
        
        DB::beginTransaction();
        
        $session = session('idiomas');
        $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
         
                $error = 1; // error en 1 es error Si osea HAY ERROR
                $copy = Copy::where('documents_id', $id)->where(function ($query) {
                    $query->where('status_copy_id', '=', 3)
                          ->orWhere('status_copy_id', '=', 6)
                          ->orWhere('status_copy_id', '=', 8);
                })
                ->first();
                if($copy){
                // $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->first();
                $movement_doc = Book_movement::where('copies_id', $copy->id)->where('active', 1)->get();
                if($movement_doc->count() == 1){
                    // dd($copy);
                    $copy->status_copy_id = 7; //SOLICITUD
                    $copy->save(); 

                    foreach($movement_doc as $t){
                        $t->active = 0;
                        $t->save();

                        $new_movement = new Book_movement;

                        // $new_movement->users_id = $t->users_id;

                        $new_movement->users_id = Auth::user()->id; 
                    } 

                    $new_movement->movement_types_id = 7; //SOLICITUD
            
                    $new_movement->copies_id = $copy->id;
                   
                    $new_movement->active = 1; 
            
                    $new_movement->save();
            
                    // envia informe de solicitud de prestamo al bibliotecario
                    $bibliotecario = User::whereHas('roles', function ($query) {
                        $query->where('name', 'Librarian');
                    })->first();
                    if($bibliotecario == null){ //si no hay bibliotecario lo manda al admin.
                        $bibliotecario = User::whereHas('roles', function ($query) {
                            $query->where('name', 'Admin');
                        })->first();
                    }
                    // $bibliotecario  = User::where('id', 1)->first();
                    $user = $bibliotecario;                
                    $msj = 'El Socio  ' . $new_movement->user['name'] . ',' . $new_movement->user['surname'] . '  con número de socio: ' . $new_movement->user['membership'] . '  ha solicitado el prestamo, del ejemplar  ' .  '<b>' . $copy->document->title . '</b>';
                    $subject = 'Informe solicitud de prestamos';
                    LibraryReport::dispatch($user, $msj, $subject);

                    DB::commit();

                    $error = 0; // error en 0 es error NO osea NO hay ERROR
                    }else{ 
                        $error = 1; // error en 1 es error Si osea HAY ERROR
                    }
                }else{
                    $error = 2; // error 2 = error xq no existe copias de ese doc
                } 

                    return response()->json(['error' => $error,'mensaje_exito' => $traduccionsweet->mensaje_exito,'resp_solicitar_documento' => $traduccionsweet->resp_solicitar_documento]); 
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
        $session = session('idiomas');          
        $Ml_web_loan     = Ml_web_loan::where('many_lenguages_id',$session)->first();
              
        $prestamos_solicitados = Book_movement::with('movement_type','user','copy.document.document_type','copy.document.document_subtype','course')       
        ->where('movement_types_id', '=', 7)
        ->where('active', '=', 1)
        ->get();
      
        return dataTables::of($prestamos_solicitados)
            ->addColumn('tipo_movimiento', function ($prestamos_solicitados){   
                return $prestamos_solicitados->movement_type['description_movement']."<br>";            
            }) 
            ->addColumn('usuario_solicitante', function ($prestamos_solicitados){              
                return 
                '<i class="fa fa-user"></i>'.' '.$prestamos_solicitados->user['nickname']."<br>".         
                '<i class="fa fa-check"></i>'.' '.$prestamos_solicitados->user['membership'];     
            })
            ->addColumn('documento_solicitado', function ($prestamos_solicitados){
                return $prestamos_solicitados->copy->document['title'];               
            })             
            ->addColumn('tipo_solicitado', function ($prestamos_solicitados){
                return $prestamos_solicitados->copy->document->document_type['document_description'];               
            })             
            ->addColumn('sub_tipo_solicitado', function ($prestamos_solicitados){
                return $prestamos_solicitados->copy->document->document_subtype['subtype_name'];               
            })             
            ->addColumn('curso', function ($prestamos_solicitados){
                if( $prestamos_solicitados->course['course_name'] != null){
                    return $prestamos_solicitados->course['course_name'];
                }else{
                    return 'Sin Curso Asignado';
                }
            })  
            ->addColumn('created_at', function ($prestamos_solicitados){
                return $prestamos_solicitados->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($prestamos_solicitados) use($Ml_web_loan) {
                return view('admin.requests.partials._action', [
                    'prestamos_solicitados' => $prestamos_solicitados,
                    'url_show' => route('admin.requests.show', $prestamos_solicitados->id),        
                    'Ml_web_loan' => $Ml_web_loan
                    ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['tipo_movimiento', 'usuario_solicitante', 'tipo_solicitado', 'sub_tipo_solicitado', 'documento_solicitado', 'curso', 'created_at', 'accion']) 
            ->make(true);  
    }
}
