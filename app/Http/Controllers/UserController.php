<?php

namespace App\Http\Controllers;

use App\User;
use App\Statu;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Providers\UserWasCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserRequest;

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
    public function store(SaveUserRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

               
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
                $user->user_photo   = $request->file('user_photo')->store('public');  
                $user->birthdate    = Carbon::parse($request->get('birthdate'));                      
                $user->status_id    = $request->get('status_id');                  
               

                // if ($request->hasFile('user_photo'))
                // {
                //     $user->user_photo = $request->file('user_photo')->store('public');
                // }
                //  dd($user);
                $user->save();

                // Enviamos el email
                // UserWasCreated::dispatch($user, $data['password']);
                //$user->update($request->validated()); 
    
                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
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
        if ($request->ajax()){
            try {
                // Transacciones
                DB::beginTransaction();
                
                $user = User::with('statu')->findOrFail($id); 
                
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
                $user->user_photo   = $request->get('user_photo');  
                $user->birthdate    = Carbon::parse($request->get('birthdate'));                      
                $user->status_id    = $request->get('status_id'); 
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
