<?php

namespace App\Http\Controllers;

use App\User;
use App\Statu;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'gender'    => User::pluck('gender', 'gender'),
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
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();               

                // Validar el formulario
                $data = $request->validate([
                    'name'      => 'required|string|max:255',
                    'surname'   => 'required|string|max:255',
                    'email'     => 'required|string|email|max:255|unique:users',                  
                    // 'password'  => 'required|string|min:6|confirmed',
                ]);
                    
                // Generar una contraseña
                $data['password'] = str_random(8);
    
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
                $user->phone        = $request->get('phone');
                $user->user_photo   = $request->get('user_photo');  
                $user->birthdate    = Carbon::parse($request->get('birthdate'));                      
                $user->status_id    = $request->get('status_id');           
                $user->save();

                // $user = User::create($data);

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request,  User $user)
    {
        if ($request->ajax()){
            try {
                // Transacciones
                DB::beginTransaction();  
                
                // Actualizamos el usuario
                $user->update($request->validated()); 
                         
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
                
            ->addColumn('status_id', function ($usuarios){
                return $usuarios->statu['state_description'];
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
            ->rawColumns(['status_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
