<?php

namespace App\Http\Controllers;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\planes;
use App\ml_panel_admin;
use App\User;
use Carbon\Carbon;
use App\Document;
use App\Book_movement;
use DataTables;
use App\ml_front_end;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user() != null && ((Auth::user()->getRoleNames() == 'Admin') || (Auth::user()->getRoleNames() == 'Librarian'))){


        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }

        $session        = session('idiomas');
        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_panel_admin = ml_panel_admin::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        $setting        = Setting::where('id', 1)->first();
        $documentos     = Document::selectRaw('count(*) documents')->get();
        $prestamos      = Book_movement::selectRaw('count(*) book_movements')                           
                            ->where('movement_types_id', 1) 
                            ->get();  
        $prestamos_vencidos = Book_movement::selectRaw('count(*) book_movements')  
        ->where(function ($query) {
            $query->where('movement_types_id', 1)
                    ->orWhere('movement_types_id', 2);
            })
            ->where('active', 1)
            ->where('date_until','<', Carbon::now()) 
            ->get();

        $socios         = User::selectRaw('count(*) users')->get();
        
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

        return view('layouts.dashboard', [
            'idioma'        => $idioma,
            'idiomas'       => $idiomas,// REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba).
            'setting'       => $setting,
            'documentos'    => $documentos,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'prestamos'     => $prestamos,
            'prestamos_vencidos' => $prestamos_vencidos,
            'socios'        => $socios,
            'ml_panel_admin' => $ml_panel_admin
           
        ]);

        }else{

        // $request->session()->put('idiomas', 2);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        // $request->session()->put('idiomas', 2);
        if (!$request->session()->has('recientes')) {
            $request->session()->put('recientes', 5);
        }
        $recientes = session('recientes');

        if (!$request->session()->has('reservados')) {
            $request->session()->put('reservados', 5);
        }
        $reservados = session('reservados');
        
        // dd("recientes: ".$recientes);
        //cargo el idioma
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_front_end = ml_front_end::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        $setting        = Setting::where('id', 1)->first();
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
        
        $setting = Setting::where('id', 1)->first();
        $ml_panel_admin = ml_panel_admin::where('many_lenguages_id',$session)->first();
        $documentos = Document::with(['book','music','movie','multimedia','photography'])->where('status_documents_id', '=', 1)
                    ->orderBy('id', 'DESC')
                    ->take($recientes)
                    ->get();

        $CincoMasResevados =  DB::select('SELECT d.id, d.title, d.document_types_id, d.synopsis,d.photo, COUNT(d.id)                  
                                FROM book_movements bm                  
                                LEFT JOIN copies c ON bm.copies_id = c.id 
                                LEFT JOIN documents d ON c.documents_id = d.id
                                WHERE bm.movement_types_id = 7
                                GROUP BY d.id, d.title, d.document_types_id, d.synopsis, d.photo
                                ORDER BY COUNT(d.id) DESC LIMIT '.$reservados);

        return view('layouts.dashboard', [
            'idioma'      => $idioma,
            'idiomas'     => $idiomas,
            'setting'     => $setting,
            'documentos'  => $documentos,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'recientes'  => $recientes,
            'reservados'  => $reservados,
            'ml_panel_admin' => $ml_panel_admin,
            'CincoMasResevados'  => $CincoMasResevados,
            'ml_front_end' => $ml_front_end
        ]);
        } 
    
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
        $usuarios =  DB::select('SELECT bm.id, u.name, u.user_photo, u.email, d.title, bm.date_until, c.registry_number,
                    (select count(bm2.id) from book_movements bm2 
                    WHERE ( bm2.movement_types_id = 1 
                    OR bm2.movement_types_id = 2)
                    AND bm2.active = 1 
                    AND bm2.users_id = bm.users_id 
                    GROUP BY bm2.users_id) as cantidad 
                    FROM book_movements bm 
                    LEFT JOIN users u ON bm.users_id = u.id 
                    LEFT JOIN copies c ON bm.copies_id = c.id 
                    LEFT JOIN documents d ON c.documents_id = d.id 
                    WHERE ( bm.movement_types_id = 1 OR bm.movement_types_id = 2) 
                    AND bm.active = 1 
                    -- AND bm.date_until > NOW()                  
                    ORDER BY bm.id DESC LIMIT 5');

        return dataTables::of($usuarios)
                 
            ->addColumn('user_photo', function ($usuarios){
                $url=asset("/images/$usuarios->user_photo"); 
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
            })
            ->addColumn('name', function ($usuarios){                               
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>"; 
                    '<i class="fa fa-user"></i>'.' '.$usuarios->email."<br>";             
            }) 
            ->addColumn('email', function ($usuarios){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            }) 
            ->addColumn('title', function ($usuarios){
                if($usuarios->date_until <= Carbon::now()){    

                    return '<span class="label label-danger sm">'.$usuarios->title.'</span>';
                }else{

                    return '<span class="label label-success sm">'.$usuarios->title.'</span>';
                }      
            })
            ->addColumn('registry_number', function ($usuarios){
                return $usuarios->registry_number;
            })                 
            ->addColumn('date_until', function ($usuarios){
                return $usuarios->date_until;
            })  
            ->addColumn('prestamos', function ($usuarios){
                return $usuarios->cantidad;
            })   
            
            
            ->addIndexColumn()   
            ->rawColumns(['user_photo', 'name', 'email', 'title', 'registry_number','date_until', 'prestamos']) 
            ->make(true);  
    }

    public function dataTable2()
    {                    
        $usuarios =  DB::select('SELECT bm.id, u.name, u.user_photo, u.email, d.title, bm.date_until, c.registry_number,
                    (select count(bm2.id) from book_movements bm2 
                    WHERE ( bm2.movement_types_id = 1 
                    OR bm2.movement_types_id = 2)
                    AND bm2.active = 1 
                    AND bm2.users_id = bm.users_id 
                    GROUP BY bm2.users_id) as cantidad 
                    FROM book_movements bm 
                    LEFT JOIN users u ON bm.users_id = u.id 
                    LEFT JOIN copies c ON bm.copies_id = c.id 
                    LEFT JOIN documents d ON c.documents_id = d.id 
                    WHERE ( bm.movement_types_id = 1 OR bm.movement_types_id = 2) 
                    AND bm.active = 1 
                    AND bm.date_until < NOW()                  
                    ORDER BY bm.id DESC LIMIT 5');

        return dataTables::of($usuarios)
                 
            ->addColumn('user_photo', function ($usuarios){
                $url=asset("/images/$usuarios->user_photo"); 
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
            })
            ->addColumn('name', function ($usuarios){                               
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>"; 
                    '<i class="fa fa-user"></i>'.' '.$usuarios->email."<br>";             
            }) 
            ->addColumn('email', function ($usuarios){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            }) 
            ->addColumn('title', function ($usuarios){            

                    return '<span class="label label-danger sm">'.$usuarios->title.'</span>';
                 
            })
            ->addColumn('registry_number', function ($usuarios){
                return $usuarios->registry_number;
            })                 
            ->addColumn('date_until', function ($usuarios){
                return $usuarios->date_until;
            })  
            ->addColumn('prestamos', function ($usuarios){
                return $usuarios->cantidad;
            })   
            
            
            ->addIndexColumn()   
            ->rawColumns(['user_photo', 'name', 'email', 'title', 'registry_number','date_until', 'prestamos']) 
            ->make(true);  
    }

    public function dataTable3()
    {     
        $id_usuario = Auth::user()->id;
        // $id_usuario = 99999999;
        // dd("id_usuario: ".$id_usuario);
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
        ->where('users_id', $id_usuario)
        ->get();
    
        return dataTables::of($docs_of_user) 
            ->addColumn('title', function ($docs_of_user){            

                    return '<span class="label label-danger sm">'.$docs_of_user->copy->document['title'].'</span>';
                 
            })
            ->addColumn('type_document', function ($docs_of_user){
                return $docs_of_user->copy->document->document_type['document_description'];
            })   
            ->addIndexColumn()   
            ->rawColumns(['title', 'type_document']) 
            ->make(true);  
    }
}
