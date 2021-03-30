<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use App\Copy;
use App\Document;
use App\planes;
use App\Book;
use App\Music;
use App\Multimedia;
use App\Movie;
use App\Ml_registry;
use App\Photography;
use App\ml_front_end;
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
        // REQUERIDO MULTI-IDIOMA - INICIO
        if (!$request->session()->has('idiomas')) { // evaluo si existe esa variable de sesion. sino existe
            $request->session()->put('idiomas', 1); // la creo y le seteo por defecto el idioma 1 predeterminado(español).
        }
        $session = session('idiomas'); // asigno la variable de session a otra variable a la cual consulto siempre que necesite el idioma.
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        $setting = Setting::where('id', 1)->first();
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
        // REQUERIDO MULTI-IDIOMA - FIN
        
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
        // dd($ml_front_end);
        $setting = Setting::where('id', 1)->first();
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

        return view('layouts.frontend', [
            'idiomas'     => $idiomas, // REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba).
            'idioma'      => $idioma,
            'setting'     => $setting,
            'documentos'  => $documentos,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'recientes'  => $recientes,
            'reservados'  => $reservados,
            'CincoMasResevados'  => $CincoMasResevados,
            'ml_front_end' => $ml_front_end
        ]); 
    }

    public function filtrarhome(Request $request, $cantidad)
    {
        $request->session()->put('recientes', $cantidad);
        // dd("llega"); 
        return response()->json(['recientes' => session('recientes')]);
     
    }

    public function filtrarhome_reservados(Request $request, $cantidad)
    {
        $request->session()->put('reservados', $cantidad);
        // dd("llega"); 
        return response()->json(['reservados' => session('reservados')]);
     
    }

    // REQUERIDO MULTI-IDIOMAS INICIO
    public function cambiar(Request $request, $id)
    {
        // dd("river de la b");
        $request->session()->put('idiomas', $id);  // METODO PARA SETEAR EL NUEVO IDIOMA EN LA VARIABLE DE SESSION.

    }
    // REQUERIDO MULTI-IDIOMAS FIN

    public function create(Request $request)
    {
        $user = new User();
         
        // REQUERIDO MULTI-IDIOMA - INICIO
        if (!$request->session()->has('idiomas')) { // evaluo si existe esa variable de sesion. sino existe
            $request->session()->put('idiomas', 1); // la creo y le seteo por defecto el idioma 1 predeterminado(español).
        }
        $session = session('idiomas'); // asigno la variable de session a otra variable a la cual consulto siempre que necesite el idioma.
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
        $setting = Setting::where('id', 1)->first();
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
        // REQUERIDO MULTI-IDIOMA - FIN 

        $idioma         = Ml_dashboard::where('many_lenguages_id', $session)->first();  
        $ml_registry    = Ml_registry::where('many_lenguages_id', $session)->first();

        $setting = Setting::where('id', 1)->first();
                            
        return view('web.users.partials.form', [
            'idiomas'     => $idiomas, // REQUERIDO MULTI-IDIOMA - variable que carga el idioma en la lista de arriba). 
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'user'          => $user,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting' => $setting,
            'idioma'        => $idioma,
            'ml_registry'   => $ml_registry,
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
                $user->user_photo        = 'user-default.jpg';   
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
        $setting = Setting::where('id', 1)->first();
                             
        return view('admin.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'setting' => $setting,
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
