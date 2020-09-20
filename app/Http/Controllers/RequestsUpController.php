<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use DataTables;
use Carbon\Carbon;
use App\Providers\Requests;
use App\Providers\UserWasCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use lluminate\Http\RequestfilefileIlluminate\Http\UploadedFileSplFileInfo;
use Illuminate\Http\UploadedFile;
use App\Ml_dashboard;
use App\ManyLenguages;
use Spatie\Permission\Models\Role;

class RequestsUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $request->session()->put('idiomas', 2);
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
        return view('admin.requestsup.index', [
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
    public function edit($id) // EDIT DE USA PARA RECHAZAR
    {
      
    }

    public function rechazar($id) // EDIT DE USA PARA RECHAZAR
    {
        $user = User::findOrFail($id);
        $user->status_id = 2; // RECHAZADO VA AQUEDAR EN ESE ESTADO
        $user->save();

        $mensaje = 0;
        
        Requests::dispatch($user, $mensaje);
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
    public function destroy($id) // DESTROY SE USA PARA ACEPTAR
    {
        // $ultimo_membership = User::select('membership')->orderBy('membership', 'DESC')->first();
        // dd($sugerido2);
        // $siguente_membership = $ultimo_membership->membership + 1;
        $password = str_random(8);
        $user = User::findOrFail($id);
        // $user->membership = $siguente_membership;
        $user->status_id = 3; // ACEPTADO QUE ES IGUAL A ACTIVO 
        $user->password = $password;
        $user->save();

        $partnerRole = Role::where('id', 3)->first();

        $user->assignRole($partnerRole);

        // Enviamos el email
        $accion = "solicitud aceptada";
        UserWasCreated::dispatch($user, $password, $accion);
    }

    public function dataTable()
    {                    
        $usuarios = User::with('statu')
        ->where(function ($query) {
            $query->where('status_id', '=', 1)
                  ->orWhere('status_id', '=', 2);
        })      
        ->get();
      
        return dataTables::of($usuarios)
            ->addColumn('name', function ($usuarios){
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>";            
            }) 
            ->addColumn('email', function ($usuarios){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            })             
            ->addColumn('status_id', function ($usuarios){
                // return'<span class="'.$movie->document->status_document->color.'">'.' '.$movie->document->status_document->name_status.'</span>';
               
                // if($usuarios->statu['state_description'] == 'Inactivo'){    

                    return $usuarios->statu['color'].$usuarios->statu['state_description'].'</span>';
                // }
                // if ($usuarios->statu['state_description'] == 'Pendiente'){

                //     return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';

                // }else{

                //     return '<span class="label label-success sm">'.$usuarios->statu['state_description'].'</span>';
                // }              
            })    
            ->addColumn('created_at', function ($usuarios){
                return $usuarios->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($usuarios) {
                return view('admin.requestsup.partials._action', [
                    'usuarios' => $usuarios,                              
                    'url_destroy' => route('admin.requestsup.destroy', $usuarios->id),
                    'url_rechazar' => route('requestsup.rechazar', $usuarios->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['name', 'email', 'status_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
