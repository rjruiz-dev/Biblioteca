<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Copy;
use App\Statuscopy;
use App\Document;
use App\Book_movement;
use App\ml_cat_sweetalert;
use App\Movement_type;
use DataTables;
use App\Setting;
use App\Ml_dashboard;
use App\ManyLenguages;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveCopyRequest;
use Illuminate\Support\Arr;

class GenericCopiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
    }

    public function copies(Request $request,$id, $bandera)
    {
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas    = ManyLenguages::all();
        $document   = Document::with('document_type','document_subtype')->findOrFail($id);
    
        return view('admin.genericcopies.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'document'  => $document,
            'bandera' => $bandera
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

        
        $sugerido2 = Copy::select('registry_number')->orderBy('registry_number', 'DESC')->first();
        
        if($sugerido2 != null){
                // dd($sugerido2);
                $sugerido = $sugerido2->registry_number + 1;
                // dd($sugerido);
        }else{
            $sugerido = 1;
        }

        return view('admin.genericcopies.partials.form', [
            'status'    => Movement_type::where('view', 1)->orderBy('orden', 'DESC')->pluck('book_status_priv', 'id'),
            'id_doc'    => $id,
            'copie'     => $copy,
            'sugerido'  => $sugerido
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCopyRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                $error = false;
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
                 
                $error = true;
                $session = session('idiomas');
                $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();

                return response()->json(['data' => $error,'bandera' => 0, 'mensaje_exito' => $traduccionsweet->mensaje_exito, 'alta_copia' => $traduccionsweet->alta_copia]); // 0 = store

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

        $sugerido2 = Copy::select('registry_number')->orderBy('registry_number', 'DESC')->first();
        // dd($sugerido2);
        $sugerido = $sugerido2->registry_number + 1;
        // dd($sugerido);
        $status = Movement_type::where('view', 1)->orderBy('orden', 'DESC')->pluck('book_status_priv', 'id');

        $status_actual = Movement_type::where('id', $copies->status_copy_id)->where('view', 0)->first();
        if($status_actual != null){ // si encuentra movimientos q no se debe mostrar la user(los q tienen 0 en view)

            $status = Arr::add($status, $status_actual->id, $status_actual->description_movement);
            // dd($status);
        }

        return view('admin.genericcopies.partials.form', [
            'status'    => $status,
            'id_doc'    => $id,
            'copie'     => $copies,
            'sugerido'  => $sugerido
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCopyRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                $copy = Copy::findOrFail($id);
                $error = false;
                if($copy->status_copy_id != $request->get('status_copy_id')){ //si cambio el estado inserto movimiento sino no
                    
                    $movement_doc = Book_movement::where('copies_id', $id)->where('active', 1)->get();
                    // dd('cantidad: '.$movement_doc->count(). 'id copia: '.$copy->id); 
                    if($movement_doc->count() == 1){//si encuentra movimientos.
                        $error = true;
                        $cancelacion_por_baja = false;

                        foreach($movement_doc as $t){
                            $t->active = 0;
                            $t->save();
                            
                            if( ($t->movement_types_id == 1) || ($t->movement_types_id == 2) ){ // evaluo si esta en prestamo o en renovacion (osea en definitiva si aun esta prestado)
                                $cancelacion_por_baja = true; 
                            }
                        } 
                      

                    $new_movement = new Book_movement;
                    if($cancelacion_por_baja){ // si hay prestamos vigente, solo en este momento guardo con movimiento 10, q es baja forzada, sino siempre con el q corresponda(baja,mantenimiento,etc)
                    $new_movement->movement_types_id = 10; //baja frozada en prestamo vigente = 10   
                    $copy->status_copy_id = 10;
                    }else{
                        $copy->status_copy_id = $request->get('status_copy_id');
                    }
                    $new_movement->movement_types_id = $request->get('status_copy_id'); //RENOVACION (valores correspondientes a la base)
                    // $new_movement->users_id = 1; //referencia a usuario NO USUARIO
                    $new_movement->copies_id = $copy->id;
                    // $new_movement->courses_id = 1; //referencia a curso NO CURSO
                    $new_movement->active = 1;
                    $new_movement->save();

                    
                    }else{
                        // dd('entro aca');
                        $error = false; 
                    }
                
                }else{
                    //no cambio estado asi que puede hacer los cambios
                    $error = true;
                }

                if($error){
                $copy->registry_number = $request->get('registry_number');
                $copy->save();
                
                DB::commit();
                }

                $session = session('idiomas');
                $traduccionsweet = ml_cat_sweetalert::where('many_lenguages_id',$session)->first();
                return response()->json(['data' => $error,'bandera' => 1, 'mensaje_exito' => $traduccionsweet->mensaje_exito, 'actualizacion_copia' => $traduccionsweet->actualizacion_copia]); // 1 = update
                           
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
