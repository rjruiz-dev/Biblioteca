<?php

namespace App\Http\Controllers;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\User;
use Carbon\Carbon;
use App\Document;
use App\Book_movement;
use Illuminate\Http\Request;

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
            'socios'        => $socios
           
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
        $usuarios = User::with('statu')->where(function ($query) {
            $query->where('status_id', '=', 3)
                  ->orWhere('status_id', '=', 4);
        })     
        ->get();
      
        return dataTables::of($usuarios)
            ->addColumn('membership', function ($usuarios){
                if($usuarios->membership == null){
                    return 'No tiene número de socio';
                }else{
                    return  '<i class="fa fa-checñ"></i>'.' '.$usuarios->membership."<br>";              
                }
            }) 
          
          
            ->addColumn('user_photo', function ($usuarios){
                $url=asset("/images/$usuarios->user_photo"); 
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
            })
            ->addColumn('name', function ($usuarios){                               
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>"; 
                    '<i class="fa fa-user"></i>'.' '.$usuarios->nickname."<br>";             
            }) 
            ->addColumn('email', function ($usuarios){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            })             
            // ->addColumn('status_id', function ($usuarios){

            //     if($usuarios->statu['state_description'] == 'Inactivo'){    

            //         return '<span class="label label-danger sm">'.$usuarios->statu['state_description'].'</span>';
            //     }
            //     if ($usuarios->statu['state_description'] == 'Pendiente'){

            //         return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';

            //     }else{

            //         return '<span class="label label-success sm">'.$usuarios->statu['state_description'].'</span>';
            //     }              
            // })    
            ->addColumn('created_at', function ($usuarios){
                return $usuarios->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($usuarios) {
                return view('admin.users.partials._action', [
                    'usuarios' => $usuarios,
                    'url_show' => route('admin.users.show', $usuarios->id),                        
                    'url_edit' => route('admin.users.edit', $usuarios->id),                              
                    'url_destroy' => route('admin.users.destroy', $usuarios->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['membership', 'user_photo', 'name', 'email', 'created_at', 'accion']) 
            ->make(true);  
    }
}
