<?php

namespace App\Http\Controllers;

use App\User;
use App\Statu;
use DataTables;
use App\Document;
use Carbon\Carbon;
use App\Book_movement;
use App\Document_type;
use App\Document_subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FastPartnerProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fastprocess.index');
    }

    public function index2()
    {
        return view('admin.fastprocess.index2');
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
    public function store(Request $request, $count)
    {        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $movement = new Book_movement;
                
                for ($i = 1; $i <= $count; $i++)
                {
                    $request->$i = $request->get('$i');
                }        
                $document->save();          

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
        //
    }

    public function vista_devo_reno($id, $bandera)
    {
        return view('admin.fastprocess.partials.form', [         
            'id'        => $id,
            'bandera'   => $bandera
        ]); 
    }

    public function grabar(Request $request)
    {
        if ($request->ajax()){
            try {
            
                //  Transacciones
                DB::beginTransaction();
                $movement_doc = Book_movement::findOrFail($request->get('id'));
                $movement_doc->active = 0;
                //hago un update de al movimiento anterior para indicar que ya NO SERA EL ULTIMO MOVIMIENTO
                //DE ESE DOCUMENTO. ESTO SIRVE PARA MOSTRAR BASICAMENTE EL ESTADO ACTUAL DEL DOCUMENTO.

                 //CREO UN NUEVO MOVIMIENTO EN ESTA TABLA PARA INDICAR QUE SE DEVOLVIO EL MISMO EN ESTE CASO.
                $new_movement = new Book_movement;
        
                if($request->get('bandera') == '1')
                {
                    $new_movement->movement_types_id = 3; //DEVOLUCION (valores correspondientes a la base)
                }else{
                    $new_movement->movement_types_id = 2; //RENOVACION (valores correspondientes a la base)
                }

                $new_movement->users_id = $movement_doc->users_id;
                $new_movement->copies_id = $movement_doc->copies_id;
                $new_movement->courses_id = 1; //le pongo 1 xq ni idea si va o no
                $new_movement->active = 1;
                $movement_doc->save();
                $new_movement->save();

                DB::commit();

                } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            } 
        } 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); //datos del socio 
        
        $docs_of_user = Book_movement::with('movement_type','copy.document.creator')
        ->where(function ($query) {
            $query->where('movement_types_id', '=', 1)
                  ->orWhere('movement_types_id', '=', 2);
        })
        ->where('active', 1) 
        ->where('users_id', $id)->get();
     
        return view('admin.fastprocess.prestamo', [
            'user'          => $user,
            'docs_of_user'  => $docs_of_user
       
        ]);
    }

    
    public function edit2($id)
    {
        $documento = Document::with('document_type','document_subtype','creator')
        ->findOrFail($id); 
        
        $copies = Book_movement::with('movement_type','user')
        ->whereHas('copy', function($q) use ($id)
        {
            $q->where('documents_id', '=', $id);
        
        })
        ->where('active', 1)
        ->get();

        // dd($copies);

        return view('admin.fastprocess.prestamo2', [
            'documento'          => $documento,
            'copies'          => $copies
        ]);    
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
        $usuarios = User::with('statu')->where('status_id', 1)      
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
                return view('admin.fastprocess.partials._action', [
                    'usuarios' => $usuarios,
                                            
                    'url_edit' => route('admin.fastprocess.edit', $usuarios->id),                              
                    
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['name', 'email', 'status_id', 'created_at', 'accion']) 
            ->make(true);  
    }

    
    public function dataTable2()
    {                    
        $documentos = Document::with('document_type','document_subtype')       
        // ->allowed()
        ->get();
      
        return dataTables::of($documentos)
            ->addColumn('tipo_documento', function ($documentos){
                return
                    '<i class="fa fa-user"></i>'.' '.$documentos->document_type['document_description']."<br>";            
            }) 
            ->addColumn('sub_tipo_documento', function ($documentos){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$documentos->document_subtype['subtype_name'];              
            })             
         
            ->addColumn('created_at', function ($documentos){
                return $documentos->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($documentos) {
                return view('admin.fastprocess.partials._action2', [
                    'documentos' => $documentos,
                                            
                    'url_edit' => route('fastprocess.edit2', $documentos->id),                              
                    
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['tipo_documento', 'sub_tipo_documento', 'created_at', 'accion']) 
            ->make(true);  
    }
}

