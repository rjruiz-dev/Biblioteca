<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Providers\UserWasCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use lluminate\Http\RequestfilefileIlluminate\Http\UploadedFileSplFileInfo;
use Illuminate\Http\UploadedFile;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user = new User();      
                             
        return view('admin.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'user'      => $user
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

        // if ($request->ajax()){
            // try {
            //     //  Transacciones
            //     DB::beginTransaction();

                 // Validar el formulario
                 $data = $request->validate([
                    'membership'    => 'required|numeric|min:000000|max:99999999|unique:users,membership',
                    'name'          => 'required|string|max:100',
                    'nickname'      => 'required|string||min:3|max:50|unique:users,nickname',
                    'email'         => 'required|string|email|max:255|unique:users,email',  
                    'user_photo'    => 'nullable|image|mimes:jpeg,bmp,png,jpg', 
                    'status_id'     => 'required'                

                ]);

                // Generar una contraseña
                $data['password'] = str_random(8);

                // dd($request->hasFile('user_photo'));
                if ($request->hasFile('user_photo')) {               

                    $file = $request->file('user_photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);   
                }               
                    // Creamos el usuario            

                    $user = new User;   
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
                    $user->birthdate    =  Carbon::createFromFormat('d/m/Y', $request->get('birthdate'));    
                    $user->membership   = $request->get('membership');   
                    $user->status_id    = $request->get('status_id'); 
                    $user->user_photo   = $name;           

                    $user->save();
                    // dd($user);
                

                // Enviamos el email
                // UserWasCreated::dispatch($user, $data['password']);
                // $user->update($request->validated()); 

             
               
            //     DB::commit();

            // } catch (Exception $e) {
            //     // anula la transacion
            //     DB::rollBack();
            // }
        

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
    public function show($id)
    {
        $user = User::with('statu')->findOrFail($id);
      
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, $id)
    {
        // if ($request->ajax()){
        //     try {
        //         // Transacciones
        //         DB::beginTransaction();
                
                $user = User::with('statu')->findOrFail($id); 
               
                $name = $user->user_photo;
                

                if ($request->hasFile('user_photo')) {               
                    $file = $request->file('user_photo');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);                     
                    // $user->save(); 
                } 

           
            

                // if ($request->hasFile('user_photo')) {               
                // $file = $request->file('user_photo')->store('public');      
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
                       
                // DB::commit();
                // }else{

                //     return 'no se recibio nada';
                // }

        //     } catch (Exception $e) {
        //         // anula la transacion
        //         DB::rollBack();
        //     }
        // }         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('statu')->findOrFail($id);        
        $user->delete();                
    }

    public function dataTable()
    {                    
        $usuarios = User::with('statu')       
        // ->allowed()
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
            ->rawColumns(['name', 'email', 'status_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
