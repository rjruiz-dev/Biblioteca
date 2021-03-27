<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use App\User_movement;
use App\planes;
use DataTables;
use App\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Providers\UserWasCreated;
use App\Providers\LibraryReport;
use App\Providers\Requests;
use App\Providers\LoanClamin;
use App\Ml_partner;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use lluminate\Http\RequestfilefileIlluminate\Http\UploadedFileSplFileInfo;
use Illuminate\Http\UploadedFile;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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

        $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();
        
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

        return view('admin.users.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'setting'   => $setting,
            'Ml_partner' => $Ml_partner
        ]); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user = new User(); 
        $sugerido = User::select('membership')->orderBy('membership', 'DESC')->first();  
        
        if($sugerido != null){                   
            $num_socio = $sugerido->membership + 1;           
        }else{
            $num_socio = 1;            
        }

        $rol_lib = false;
        $rol_part = true; // para que arranque en socios

        $session = session('idiomas');
        $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
          
        return view('admin.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::where('view_alta',1)->pluck('state_description', 'id'),   
            'setting' => $setting,
            'num_socio' => $num_socio,        
            'user'      => $user,
            'rol_lib'      => $rol_lib,
            'rol_part'      => $rol_part,
            'Ml_partner' => $Ml_partner
        ]);  
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
            try {
                //  Transacciones
                DB::beginTransaction();

                 // Validar el formulario
                $data = $request->validate([
                  
                    'membership'    => 'required|numeric|digits_between:1,8|unique:users,membership',
                    'name'          => 'required|string|max:100',
                    'nickname'      => 'required|string||min:3|max:50|unique:users,nickname',
                    'email'         => 'required|string|email|max:255|unique:users,email',                     
                    'status_id'     => 'required', 
                    'birthdate'     => 'required'       
                ]);

                // Generar una contraseña
                $data['password'] = str_random(8);
            
                if ($request->hasFile('user_photo')) {               

                    $file = $request->file('user_photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }else{
                    $name = 'user-default.jpg';
                }               
                // Creamos el usuario 
                $user = new User;   
                $user->name         = $request->get('name');
                $user->surname      = $request->get('surname');
                $user->nickname     = $request->get('nickname');
                $user->email        = $request->get('email');        
                $user->password     = $data['password'];
                $user->gender       = $request->get('gender');  
                $user->address      = $request->get('address');
                $user->postcode     = $request->get('postcode');  
                $user->city         = $request->get('city');
                $user->province     = $request->get('province');
                $user->phone        = $request->get('phone');   
                $user->birthdate    =  Carbon::createFromFormat('d-m-Y', $request->get('birthdate'));    
                $user->membership   = $request->get('membership');
                 
                $mov_user = new User_movement();
                $mov_user->actions_id = $request->get('status_id');
                $mov_user->usuario_aud = 'USER AUD';
                $user->status_id    = $request->get('status_id');

                $user->user_photo   = $name;    
                $user->save();

                $mov_user->users_id = $user->id;
                $mov_user->save();
                $nuevo_usuario = $user;

              
      
                $mensaje = 1;
                   
                if($request->get('group') == 'Partner'){ //socio
                     // Enviamos el email
                    if($request->get('status_id') == 1){  //si esta pendiente

                        Requests::dispatch($user, $mensaje);
                        

                        // $bibliotecario = User::whereHas('roles', function ($query) {
                        //     $query->where('name', 'Librarian');
                        // })->get();
                    
                        $bibliotecario  = User::where('id', 1)->first();
                        $user = $bibliotecario;
                        $msj = 'El Socio' . $nuevo_usuario->name . ',' . $nuevo_usuario->surnamename.  'ha sido cargado, pero se encuentra en estado pendiente a ser aprobado';
                        $subject = 'Informe';
                        LibraryReport::dispatch($user, $msj, $subject);


                    }else{
                        $partnerRole = Role::where('id', 3)->first();
                        
                        
                        $user->assignRole($partnerRole);
                        $accion = 'alta de socio';
                        UserWasCreated::dispatch($user, $data['password'], $accion);

                        $bibliotecario  = User::where('id', 1)->first();
                        $user = $bibliotecario;
                        $msj = 'El Socio' . $nuevo_usuario->name . ',' . $nuevo_usuario->surnamename.  'ha sido aprobado como nuevo socio';
                        $subject = 'Informe';
                        LibraryReport::dispatch($user, $msj, $subject);
                    }
                }else{
                    $librarianRole = Role::where('id', 2)->first();

                    
                    $user->assignRole($librarianRole);
                    $accion = 'bibliotecario';
                    UserWasCreated::dispatch($user, $data['password'], $accion);

                }
               
                DB::commit();

                $session = session('idiomas');
                $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();
                return response()->json(['mensaje_exito' => $Ml_partner->mensaje_exito, 'noti_alta_socio' => $Ml_partner->noti_alta_socio]);


            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    // public function photo(Request $request)
    // {
    //     $this->validate(request(),[
    //         // jpg, png, bmp, gif, o svg            
    //         'photo' => 'required|image|max:2048' 
    //     ]);

    //     $photo = request()->file('user_photo')->store('public');

    //     User::create([
    //         'user_photo' => Storage::url($photo)
            
    //     ]);     
    
    // }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$request->session()->has('idiomas')) { //valida si existe la variable si no existe la crea 
            $request->session()->put('idiomas', 1); // 1 es el idioma español osea el por defecto.
        }
        $session = session('idiomas'); // id referencaindo al idioma.

        $user = User::with('statu')->findOrFail($id);
        $setting    = Setting::where('id', 1)->first();
        $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();
        
        return view('admin.users.show', compact('user'),[
            'Ml_partner' => $Ml_partner,
            'setting' => $setting
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (!$request->session()->has('idiomas')) { //valida si existe la variable si no existe la crea 
            $request->session()->put('idiomas', 1); // 1 es el idioma español osea el por defecto.
        }
        $session = session('idiomas'); // id referencaindo al idioma.
        
        $user = User::with('statu')->findOrFail($id);
        $sugerido = User::select('membership')->orderBy('membership', 'DESC')->first();    
        $num_socio = $sugerido->membership + 1;

        $rol_lib = false;
        $rol_part = false;
        if($user->getRoleNames() == 'Librarian'){
            $rol_lib = true;
        }

        if($user->getRoleNames() == 'Partner'){
            $rol_part = true;
        }

        $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();
        
        $setting    = Setting::where('id', 1)->first();

        return view('admin.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::where('view_edit',1)->pluck('state_description', 'id'),           
            'setting' => $setting,
            'num_socio' => $num_socio,          
            'user'      => $user,
            'rol_lib'   => $rol_lib,
            'rol_part'  => $rol_part,
            'Ml_partner' => $Ml_partner
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, $id)
    {
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
                // else{
                //     $name = 'user-default.jpg';
                // }        


                // Actualizamos el usuario
                $user->name         = $request->get('name'); 
                $user->surname      = $request->get('surname');
                $user->nickname     = $request->get('nickname');
                $user->email        = $request->get('email');

                if( (trim( $request->get('password') ) != '') && ( trim( $request->get('password') ) != null ) ){
                    $user->password     = $request->get('password');
                }

                $user->gender       = $request->get('gender');  
                $user->address      = $request->get('address');
                $user->postcode     = $request->get('postcode'); 
                $user->city         = $request->get('city');
                $user->province     = $request->get('province');  
                $user->phone        = $request->get('phone');      
                $user->birthdate    =  Carbon::createFromFormat('d-m-Y', $request->get('birthdate'));    
                $user->membership   = $request->get('membership');

               

                //    $mov_user = new User_movement();
                //    $mov_user->actions_id = $request->get('status_id');
                //    $mov_user->users_id = $user->id;
                //    $mov_user->usuario_aud = 'USER AUD';
                //    $mov_user->save();

                
                if($user->getRoleNames() != $request->get('group')){ // si cambia edita el rol
                    
                    $user->roles()->detach(); // elimino todos los roles q tenga ese user
                    
                    if($request->get('group') == 'Partner'){

                        $partnerRole = Role::where('id', 3)->first();
                        $user->assignRole($partnerRole);

                    }else{

                        $librarianRole = Role::where('id', 2)->first();
                        $user->assignRole($librarianRole);

                    }
                }

                if($user->status_id != $request->get('status_id'))
                {
                    if($user->status_id == 3){ //si esta activo lo doy de baja
                        $user->status_id = 4;
                        $user->save();
                    }else{
                        $user->status_id = 3;
                        $user->save();
                    }
                }
                // $user->status_id    = $status; 
                $user->user_photo   = $name;
                $user->save();               

                DB::commit();

                $session = session('idiomas');
                $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();
                return response()->json(['mensaje_exito' => $Ml_partner->mensaje_exito, 'noti_alta_socio' => $Ml_partner->noti_alta_socio]);

            
            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }         

    }

    public function edit_profile($id)
    {
        $user = User::with('statu')->findOrFail($id);
        $sugerido = User::select('membership')->orderBy('membership', 'DESC')->first();    
        $num_socio = $sugerido->membership + 1;
        $setting    = Setting::where('id', 1)->first();

        return view('admin.users.partials.form_profile', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),           
            'setting' => $setting,
            'num_socio' => $num_socio ,     
            'user'      => $user
        ]);  
    }

    public function update_profile(Request $request, $id)
    {
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
                    $user->user_photo   = $name;   
                }// solo guarda la foto si recibe una foto cargada desde la edicion sino no hace nada
                // y no toca la que esta en la base ni la modifica.
                // else{
                //     $name = 'user-default.jpg';
                // }        

                // Actualizamos el usuario
                $user->name         = $request->get('name');
                $user->surname      = $request->get('surname');
                $user->nickname     = $request->get('nickname');
                $user->email        = $request->get('email');  
                
                // dd($user);
               
                if( (trim( $request->get('password') ) != '') && ( trim( $request->get('password') ) != null ) ){
                    $user->password     = $request->get('password');
                }
                
                $user->gender       = $request->get('gender');  
                $user->address      = $request->get('address');
                $user->postcode     = $request->get('postcode'); 
                $user->city         = $request->get('city');
                $user->province     = $request->get('province');  
                $user->phone        = $request->get('phone');      
                $user->birthdate    = Carbon::createFromFormat('d-m-Y', $request->get('birthdate'));    
                $user->membership   = $request->get('membership');
                $user->user_photo   = $name;
                $user->save();
                       
                DB::commit();
               
            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $user = User::with('statu')->findOrFail($id);        
    //     $user->delete();                
    // }

    public function destroy($id) //se deja pero no se usa xq en algun futuro puede servir ok ? rodri salamin jajaj
    {
        $user = User::findOrFail($id);

        $session = session('idiomas');
        $Ml_partner     = Ml_partner::where('many_lenguages_id',$session)->first();

        if($user->status_id == 3){ //si esta activo lo doy de baja
            $user->status_id = 4;
            $user->save();
            $mov_user = new User_movement();
                   $mov_user->actions_id = 4;
                   $mov_user->users_id = $user->id;
                   $mov_user->usuario_aud = 'USER AUD';
                   $mov_user->save();  
                   $alta_baja =  $Ml_partner->resp_baja_socio;
        }else{
            if($user->status_id == 4){ //si esta en baja lo doy de alta
                $user->status_id = 3;
                $user->save();  
                $mov_user = new User_movement();
                   $mov_user->actions_id = 3;
                   $mov_user->users_id = $user->id;
                   $mov_user->usuario_aud = 'USER AUD';
                   $mov_user->save();  
            }
            $alta_baja = $Ml_partner->resp_reactivar_socio;
        }

        return response()->json(['mensaje_exito' => $Ml_partner->mensaje_exito, 'alta_baja' => $alta_baja]);

    }

    public function dataTable()
    {                    
        $usuarios = User::with('statu')->where(function ($query) {
            $query->where('status_id', '=', 3)
                  ->orWhere('status_id', '=', 4);
        })       
        // ->allowed()
        ->get();
      
        return dataTables::of($usuarios)
            ->addColumn('membership', function ($usuarios){
                if($usuarios->membership == null){
                    return 'No tiene número de socio';
                }else{
                    return  '<i class="fa fa-checñ"></i>'.' '.$usuarios->membership."<br>";              
                }
            }) 
            ->addColumn('nickname', function ($usuarios){               
                return $usuarios->nickname."<br>";        
            }) 
          
            ->addColumn('user_photo', function ($usuarios){
                if($usuarios['user_photo'] == null){
                    $url=asset("./images/user-default.jpg");
                }else{
                    if(file_exists("./images/". $usuarios['user_photo'])){
                        $url=asset("./images/". $usuarios['user_photo']);
                    }else{
                        $url=asset("./images/user-default.jpg");  
                    }
                     
                }
                // $url=asset("/images/$usuarios->user_photo"); 
                return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
            })
            ->addColumn('name', function ($usuarios){
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>";            
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
            ->rawColumns(['membership', 'nickname', 'user_photo', 'name', 'email', 'status_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
