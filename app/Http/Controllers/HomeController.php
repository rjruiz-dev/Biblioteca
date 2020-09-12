<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use App\Ml_dashboard;
use App\ManyLenguages;
use DataTables;
use Carbon\Carbon;
use App\Providers\UserWasCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveRegistryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use lluminate\Http\RequestfilefileIlluminate\Http\UploadedFileSplFileInfo;
use Illuminate\Http\UploadedFile;

class HomeController extends Controller
{
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
        return view('layouts.dashboard', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
        ]); 
    }


    public function cambiar(Request $request, $id)
    {
        $request->session()->put('idiomas', $id);
        // dd("llega"); 
    }

    public function create()
    {
        $user = new User();      
                             
        return view('web.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'user'      => $user
        ]); 

    }

    public function store(Request $request)
    {
        // dd($request);
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                 // Validar el formulario
                $data = $request->validate([
                    // 'membership'    => 'required|numeric|min:000000|max:99999999|unique:users,membership',
                    'name'          => 'required|string|max:100',
                    'surname'       => 'required|string|max:100',
                    'nickname'      => 'required|string||min:3|max:50|unique:users,nickname',
                    'email'         => 'required|string|email|max:255|unique:users,email', 
                    'birthdate'     => 'required',  
                    // 'user_photo'    => 'nullable|image|mimes:jpeg,bmp,png,jpg', 
                    // 'status_id'     => 'required'       
                ]);

                // // Generar una contraseña
                // $data['password'] = str_random(8);
              
                // if ($request->hasFile('user_photo')) {               

                //     $file = $request->file('user_photo');
                //     $name = time().$file->getClientOriginalName();
                //     $file->move(public_path().'/images/', $name);   
                // }               
                // Creamos el usuario 
                $user = new User;   
                $user->name         = $request->get('name');
                $user->surname      = $request->get('surname');
                $user->nickname     = $request->get('nickname');
                $user->email        = $request->get('email');        
                // $user->password     = $request->get('password');
                // $user->gender       = $request->get('gender');  
                // $user->address      = $request->get('address');
                // $user->postcode     = $request->get('postcode');  
                // $user->city         = $request->get('city');
                // $user->province     = $request->get('province');
                // $user->phone        = $request->get('phone');   
                $user->birthdate    =  Carbon::createFromFormat('d-m-Y', $request->get('birthdate'));    
                // $user->membership   = $request->get('membership');   
                // $user->status_id    = $request->get('status_id');
                $user->status_id    = 1; // CAMBIAR NUMERO LUEGO DE CORRER SEEDERS Q HIZO FRANCO DE STATUS PARA Q APAREZCA EL STATUS "SOLICITUD" 
                // $user->user_photo   = $name;    
                $user->save();
                   
                // Enviamos el email
                // UserWasCreated::dispatch($user, $data['password']);
                // $bandera = 0;
                // return $bandera->toJson();

                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    public function edit($id)
    {
        $user = User::with('statu')->findOrFail($id);
                             
        return view('admin.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'user'      => $user
        ]);  
    }

    public function update(SaveRegistryRequest $request, $id)
    {
        dd($id);
        if ($request->ajax()){
            try {
                // Transacciones
                DB::beginTransaction();
                
                $user = User::with('statu')->findOrFail($id); 

                $name = $user->user_photo;                

                if ($request->hasFile('user_photo')) {               
                    $file = $request->file('user_photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);    
                } 

                // Actualizamos el usuario
                $user->name         = $request->get('name');
                $user->surname      = $request->get('surname');
                $user->nickname     = $request->get('nickname');
                $user->email        = $request->get('email');        
                $user->password     = $request->get('password');
                $user->gender       = $request->get('gender');  
                $user->address      = $request->get('address');
                $user->postcode     = $request->get('postcode'); 
                $user->city         = $request->get('city');
                $user->province     = $request->get('province');  
                $user->phone        = $request->get('phone');      
                $user->birthdate    = Carbon::createFromFormat('d/m/Y', $request->get('birthdate'));    
                $user->membership   = $request->get('membership');                  
                $user->status_id    = $request->get('status_id'); 
                $user->user_photo   = $name;
                $user->save();
                       
                DB::commit();
                $bandera = 1;
                return $bandera->toJson();
               
            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }         

    }
}
