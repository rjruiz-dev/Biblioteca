<?php

namespace App\Http\Controllers;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\ml_panel_admin;
use App\User;
use Carbon\Carbon;
use App\Document;
use App\Book_movement;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

        $session        = session('idiomas');
        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_panel_admin = ml_panel_admin::where('many_lenguages_id',$session)->first();
        $idiomas        = ManyLenguages::all();
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
        
        
        return view('layouts.dashboard', [
            'idioma'        => $idioma,
            'idiomas'       => $idiomas,
            'setting'       => $setting,
            'documentos'    => $documentos,
            'prestamos'     => $prestamos,
            'prestamos_vencidos' => $prestamos_vencidos,
            'socios'        => $socios,
            'ml_panel_admin' => $ml_panel_admin
           
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
}
