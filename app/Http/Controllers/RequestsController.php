<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Document;
use Carbon\Carbon;
use App\Document_type;
use App\Document_subtype;
use App\Book_movement;
use App\Copy;
use App\User;
use App\Course;
use Illuminate\Support\Facades\DB;
use DataTables;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.requests.index');
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

    public function desestimar($id, $bandera)
    {
        
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
        ->get();
      
        return dataTables::of($prestamos_solicitados)
            ->addColumn('tipo_movimiento', function ($prestamos_solicitados){
                return
                    '<i class="fa fa-user"></i>'.' '.$prestamos_solicitados->movement_type['description_movement']."<br>";            
            }) 
            ->addColumn('usuario_solicitante', function ($prestamos_solicitados){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$prestamos_solicitados->user['nickname'];              
            })
            ->addColumn('documento_solicitado', function ($prestamos_solicitados){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$prestamos_solicitados->copy->document['title'];               
            })             
            ->addColumn('tipo_solicitado', function ($prestamos_solicitados){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$prestamos_solicitados->copy->document->document_type['document_description'];               
            })             
            ->addColumn('sub_tipo_solicitado', function ($prestamos_solicitados){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$prestamos_solicitados->copy->document->document_subtype['subtype_name'];               
            })             
            ->addColumn('curso', function ($prestamos_solicitados){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$prestamos_solicitados->course['course_name'];               
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
