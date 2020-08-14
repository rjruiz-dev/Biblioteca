<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Copy;
use App\Statuscopy;
use App\Document;
use App\Book_movement;
use App\Movement_type;
use DataTables;
use Illuminate\Support\Facades\DB;

class GenericCopiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    public function copies($id)
    {
        $document = Document::findOrFail($id);
        
        return view('admin.genericcopies.index', [
            'document'          => $document
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newcopies($id)
    {
        $copy = new Copy();

        return view('admin.genericcopies.partials.form', [
            'status'    => Movement_type::where('view', 1)->pluck('book_status_priv', 'id'),
            'id_doc'          => $id,
            'copie'          => $copy
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
                
                // Creamos el documento            
                $copy = new Copy;   
                      
                $copy->documents_id = $request->get('id_docu');
                $copy->status_copy_id = $request->get('status_copy_id');
                $copy->registry_number = $request->get('registry_number');
                $copy->save();

                $new_movement = new Book_movement;
                $new_movement->movement_types_id = 6; //Disponibilidad inicial            
                $new_movement->users_id = 1; //referencia a usuario NO USUARIO
                $new_movement->copies_id = $copy->id;
                $new_movement->courses_id = 1; //referencia a curso NO CURSO
                $new_movement->active = 1;
                $new_movement->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $copies = Copy::with('movement_type')->findOrFail($id);

        return view('admin.genericcopies.partials.form', [
            'status'    => Movement_type::where('view', 1)->pluck('book_status_priv', 'id'),
            'id_doc'          => $id,
            'copie'          => $copies
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
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                // Creamos el documento            
                $copy = Copy::findOrFail($id);  
                     
                // $copy->documents_id = $request->get('id_docu');

                if($copy->status_copy_id == $request->get('status_copy_id'))
                { 
                    //si cambio el estado inserto movimiento sino no        
                }else{
                    $new_movement = new Book_movement;
                    $new_movement->movement_types_id = $request->get('status_copy_id'); //RENOVACION (valores correspondientes a la base)
                    $new_movement->users_id = 1; //referencia a usuario NO USUARIO
                    $new_movement->copies_id = $copy->id;
                    $new_movement->courses_id = 1; //referencia a curso NO CURSO
                    $new_movement->active = 1;
                    $new_movement->save();
                }

                $copy->status_copy_id = $request->get('status_copy_id');
                $copy->registry_number = $request->get('registry_number');
                $copy->save();

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
        //
    }

    public function dataTable($id)
    {   
        $copies = Copy::with('movement_type', 'document')->where('documents_id', $id)->get();

        return dataTables::of($copies)
              
        ->addColumn('status', function ($copies){
            return $copies->movement_type->book_status_public;              
        }) 
        ->addColumn('created_at', function ($copies){
            return $copies->created_at->format('d-m-y');
        })         
        ->addColumn('accion', function ($copies) {
            return view('admin.genericcopies.partials._action', [
                'copies' => $copies,
                // 'url_show' => route('admin.genericcopies.show', $copies->id),                        
                'url_edit' => route('admin.genericcopies.edit', $copies->id),                              
                // 'url_destroy' => route('admin.genericcopies.destroy', $copies->id)
            ]);
        })           
        ->addIndexColumn()   
        ->rawColumns(['status','created_at', 'accion']) 
        ->make(true);  
    }

}
