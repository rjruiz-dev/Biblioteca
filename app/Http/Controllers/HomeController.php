<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use App\Copy;
use App\Document;
use App\Book;
use App\Music;
use App\Multimedia;
use App\Movie;
use App\Ml_registry;
use App\Photography;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use DataTables;
use Carbon\Carbon;
use App\Providers\UserWasCreated;
use App\Providers\Requests;
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
        $setting = Setting::where('id', 1)->first();
        $documentos = Document::with(['book','music','movie','multimedia','photography'])
                    ->orderBy('id', 'DESC')
                    ->take(3)
                    ->get();

        $CincoMasResevados =  DB::select('SELECT d.id, d.title, d.synopsis,d.photo, COUNT(d.id)                  
                                FROM book_movements bm                  
                                LEFT JOIN copies c ON bm.copies_id = c.id 
                                LEFT JOIN documents d ON c.documents_id = d.id
                                WHERE bm.movement_types_id = 7
                                GROUP BY d.id, d.title, d.synopsis, d.photo
                                ORDER BY COUNT(d.id) DESC LIMIT 5');

        return view('layouts.frontend', [
            'idioma'      => $idioma,
            'idiomas'     => $idiomas,
            'setting'     => $setting,
            'documentos'  => $documentos,
            'CincoMasResevados'  => $CincoMasResevados
        ]); 
    }


    public function cambiar(Request $request, $id)
    {
        $request->session()->put('idiomas', $id);
        // dd("llega"); 
    }

    public function create(Request $request)
    {
        $user = new User();
         
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_registry    = Ml_registry::where('many_lenguages_id', $idioma->id)->first();
                            
        return view('web.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'user'          => $user,
            'idioma'        => $idioma,
            'ml_registry'   => $ml_registry
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

                
                // $pass_obligatoria: se pone esta contraseña SOLO xq es obligatoria en la DB
                // si el user es aceptado como socio se reemplazara por otra.
                $pass_obligatoria = str_random(8);
              
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
                $user->password     = $pass_obligatoria;
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

                $mensaje = 1;
                
                // Enviamos el email
                Requests::dispatch($user, $mensaje);

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
        // dd($id);
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
                $user->birthdate    = Carbon::createFromFormat('d-m-Y', $request->get('birthdate'));    
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
