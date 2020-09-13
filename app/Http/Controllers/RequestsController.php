<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Copy;
use App\User;
use App\Course;
use DataTables;
use App\Document;
use Carbon\Carbon;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Document_type;
use App\Book_movement;
use App\Document_subtype;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
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
        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
        
        return view('admin.requests.index', [
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
        $prestamo_solicitado = Book_movement::with('movement_type','user','copy.document.document_type','copy.document.document_subtype','course')->findOrFail($id);       
      
        return view('admin.requests.show', [          
            'prestamo_solicitado'          => $prestamo_solicitado
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    public function desestimar($id)
    {
                DB::beginTransaction();
                
                // $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->first();
                $movement_doc = Book_movement::where('copies_id', $id)->where('active', 1)->get();
                $error = 1; // error en 1 es error Si osea HAY ERROR
                if($movement_doc->count() == 1){
                    
                    $copy = Copy::findOrFail($id);
                    $copy->status_copy_id = 8;
                    $copy->save(); 

                    foreach($movement_doc as $t){
                        $t->active = 0;
                        $t->save();

                        $new_movement = new Book_movement;

                        $new_movement->users_id = $t->users_id; 
                    } 

                    $new_movement->movement_types_id = 8; //PRESTAMO
            
                    $new_movement->copies_id = $id;
                   
                    $new_movement->active = 1; 
            
                    $new_movement->save();
            
            
                    DB::commit();

                    $error = 0; // error en 0 es error NO osea NO hay ERROR
                    }else{ 
                        $error = 1; // error en 1 es error Si osea HAY ERROR
                    } 

                    return response()->json(['error' => $error]); 
    }


    public function solicitud($id)
    {           //recibimos como parametro id de documento
                DB::beginTransaction();
                
                $error = 1; // error en 1 es error Si osea HAY ERROR
                $copy = Copy::where('documents_id', $id)->where(function ($query) {
                    $query->where('status_copy_id', '=', 3)
                          ->orWhere('status_copy_id', '=', 6)
                          ->orWhere('status_copy_id', '=', 8);
                })
                ->first();
                if($copy){
                // $movement_doc = Book_movement::where('copies_id', $request->get('copies_id'))->where('active', 1)->first();
                $movement_doc = Book_movement::where('copies_id', $copy->id)->where('active', 1)->get();
                if($movement_doc->count() == 1){
                    // dd($copy);
                    $copy->status_copy_id = 7; //SOLICITUD
                    $copy->save(); 

                    foreach($movement_doc as $t){
                        $t->active = 0;
                        $t->save();

                        $new_movement = new Book_movement;

                        $new_movement->users_id = $t->users_id; 
                    } 

                    $new_movement->movement_types_id = 7; //SOLICITUD
            
                    $new_movement->copies_id = $copy->id;
                   
                    $new_movement->active = 1; 
            
                    $new_movement->save();
            
            
                    DB::commit();

                    $error = 0; // error en 0 es error NO osea NO hay ERROR
                    }else{ 
                        $error = 1; // error en 1 es error Si osea HAY ERROR
                    }
                }else{
                    $error = 2; // error 2 = error xq no existe copias de ese doc
                } 

                    return response()->json(['error' => $error]); 
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
        $prestamos_solicitados = Book_movement::with('movement_type','user','copy.document.document_type','copy.document.document_subtype','course')       
        ->where('movement_types_id', '=', 7)
        ->where('active', '=', 1)
        ->get();
      
        return dataTables::of($prestamos_solicitados)
            ->addColumn('tipo_movimiento', function ($prestamos_solicitados){   
                return $prestamos_solicitados->movement_type['description_movement']."<br>";            
            }) 
            ->addColumn('usuario_solicitante', function ($prestamos_solicitados){              
                return 
                '<i class="fa fa-user"></i>'.' '.$prestamos_solicitados->user['nickname']."<br>".         
                '<i class="fa fa-check"></i>'.' '.$prestamos_solicitados->user['membership'];     
            })
            ->addColumn('documento_solicitado', function ($prestamos_solicitados){
                return $prestamos_solicitados->copy->document['title'];               
            })             
            ->addColumn('tipo_solicitado', function ($prestamos_solicitados){
                return $prestamos_solicitados->copy->document->document_type['document_description'];               
            })             
            ->addColumn('sub_tipo_solicitado', function ($prestamos_solicitados){
                return $prestamos_solicitados->copy->document->document_subtype['subtype_name'];               
            })             
            ->addColumn('curso', function ($prestamos_solicitados){
                if( $prestamos_solicitados->course['course_name'] != null){
                    return $prestamos_solicitados->course['course_name'];
                }else{
                    return 'Sin Curso Asignado';
                }
            })  
            ->addColumn('created_at', function ($prestamos_solicitados){
                return $prestamos_solicitados->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($prestamos_solicitados) {
                return view('admin.requests.partials._action', [
                    'prestamos_solicitados' => $prestamos_solicitados,
                    'url_show' => route('admin.requests.show', $prestamos_solicitados->id),        
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['tipo_movimiento', 'usuario_solicitante', 'tipo_solicitado', 'sub_tipo_solicitado', 'documento_solicitado', 'curso', 'created_at', 'accion']) 
            ->make(true);  
    }
}
