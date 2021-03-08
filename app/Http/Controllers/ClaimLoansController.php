<?php

namespace App\Http\Controllers;

use App\Generate_letter;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Providers\ClaimLoan;
use App\Providers\ReportClaimLoan;
use App\Book_movement;
use App\Ml_send_letter;
use App\Copy;
use App\User;
use App\Document;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use Illuminate\Support\Facades\DB;

class ClaimLoansController extends Controller
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
      
        $ml_sl                          = Ml_send_letter::where('many_lenguages_id', $session)->first();
                
        return view('admin.claimloans.prestamo', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,     
            'setting'   => $setting, 
            'ml_sl' => $ml_sl,
            'model_types' => Generate_letter::pluck('title', 'id') 
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

    public function filtarPorFecha($fecha)
    {
         
         $fecha_hasta = Carbon::createFromFormat('d-m-Y', $fecha);
        
         $prestamos = Book_movement::with('user', 'copy.document')
         ->where('date_until','<', $fecha_hasta)
         ->where(function ($query) {
             $query->where('movement_types_id', '=', 1)
                   ->orWhere('movement_types_id', '=', 2);
         })
         ->where('active', 1)               
         ->get();

        //  DB::raw( 'items_alias.*' )
        //  ->pluck('nickname', 'id');

        //  dd($prestamos);

        //  ->pluck('subtype_name', 'id')

          return $prestamos->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if ($request->ajax()){

            
                // dd($request);
                // Cargamos el modelo que eligio      
                // dd($model_types);
                $modelo = Generate_letter::where('id', $request->get('model_types'))->first();
                // dd($modelo);
                // Cargamos el socio o los socios          
                $send_to = $request->get('send_to');

                $informe = $request->get('informe');

                // dd($request->get('hasta'));
                if($send_to > 0){ // ELIGIO UNO EN PARTICULAR
                    
                    $user = User::where('id', $send_to)->first();

                    $fecha_hasta = Carbon::createFromFormat('d-m-Y', $request->get('hasta'));

                    $prestamos = Book_movement::with('user', 'copy.document','copy.document')
                    ->where('date_until','<', $fecha_hasta)
                    ->where('users_id','=', $send_to)
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)               
                    ->get();

                    // foreach($prestamos as $prestamos){ 

                    //      ClaimLoan::dispatch($prestamos);  
                    // }
                        // Enviamos el email
                        // $prestamos = User::get()->toArray();
                        // $prestamos = "asdasda";
                        ClaimLoan::dispatch($user, $prestamos, $modelo);  
                    

                }else{ // ELIGIO TODOS
                    $fecha_hasta = Carbon::createFromFormat('d-m-Y', $request->get('hasta'));
        
                    $movs_cn_usuarios = Book_movement::with('user') //OBTENGO SOLO LOS USUARIOS Q DEBEN
                    ->where('date_until','<', $fecha_hasta)
                    ->where(function ($query) {
                        $query->where('movement_types_id', '=', 1)
                              ->orWhere('movement_types_id', '=', 2);
                    })
                    ->where('active', 1)
                    ->select('users_id')
                    ->distinct()               
                    ->get();

                    
                    // dd($prestamos_todos);  

                    foreach($movs_cn_usuarios as $mov_usuario){

                                $user = User::where('id', $mov_usuario->user->id)->first();

                            $fecha_hasta = Carbon::createFromFormat('d-m-Y', $request->get('hasta'));

                            $prestamos = Book_movement::with('user', 'copy.document','copy.document')
                            ->where('date_until','<', $fecha_hasta)
                            ->where('users_id','=', $mov_usuario->user->id)
                            ->where(function ($query) {
                                $query->where('movement_types_id', '=', 1)
                                    ->orWhere('movement_types_id', '=', 2);
                            })
                            ->where('active', 1)               
                            ->get();
                            // dd($prestamos);
                            // foreach($prestamos as $prestamos){ 

                            //      ClaimLoan::dispatch($prestamos);  
                            // }
                                // Enviamos el email
                                // $prestamos = User::get()->toArray();
                                // $prestamos = "asdasda";
                                ClaimLoan::dispatch($user, $prestamos, $modelo);
                                
                                
                         
                    }

                 
                }
                if($informe != null){
                    $user = User::where('id', 1)->first();  

                    ReportClaimLoan::dispatch($user, $prestamos);
                }
                $session = session('idiomas');
                $Ml_send_letter = Ml_send_letter::where('many_lenguages_id',$session)->first();
                return response()->json(['mensaje_exito' => $Ml_send_letter->mensaje_exito, 'noti_envio_mails' => $Ml_send_letter->noti_envio_mails]);

                
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
}
