<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Document;
use App\Generate_subjects;
use Illuminate\Http\Request;
use App\planes;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Setting;
use App\User;
use App\Ml_subjects;
use App\Swal_subject;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveSubjectRequest;

class GenerateSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_subject = Ml_subjects::where('many_lenguages_id', $idioma->id)->first();
        $swal_subject = Swal_subject::where('many_lenguages_id', $idioma->id)->first();
        $setting    = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
    
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

        return view('admin.subjects.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,
            'advertencia' => $advertencia,
            'plan' => $plan,
            'ml_subject'   => $ml_subject,
            'swal_subject' => $swal_subject
            
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subject = new Generate_subjects();  
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_subject = Ml_subjects::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();
                             
        return view('admin.subjects.partials.form', [           
            'subject'       => $subject,
            'idioma'        => $idioma,
            'setting' => $setting,
            'ml_subject'    => $ml_subject

        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSubjectRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $subject = new Generate_subjects;  
                $subject->subject_name  = $request->get('subject_name');
                $subject->cdu  = $request->get('cdu');           
                $subject->save();

                DB::commit();

                $session = session('idiomas');
                $swal_subject = Swal_subject::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_sub'        => $swal_subject->swal_exito_sub,
                                            'swal_info_exito_sub'   => $swal_subject->swal_info_exito_sub                                      
                                        ]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Generate_subjects  $generate_subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Generate_subjects $generate_subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Generate_subjects  $generate_subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $subject = Generate_subjects::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 
        $setting = Setting::where('id', 1)->first();

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_subject = Ml_subjects::where('many_lenguages_id', $idioma->id)->first();
                             
        return view('admin.subjects.partials.form', [           
            'subject'  => $subject,
            'idioma'        => $idioma,
            'setting' => $setting,
            'ml_subject'    => $ml_subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Generate_subjects  $generate_subjects
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSubjectRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $subject = Generate_subjects::findOrFail($id);

                // Actualizamos el genero               
                $subject->subject_name  = $request->get('subject_name');
                $subject->cdu  = $request->get('cdu');                     
                $subject->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_subject = Swal_subject::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito_sub'        => $swal_subject->swal_exito_sub,
                                            'swal_info_exito_sub'   => $swal_subject->swal_info_exito_sub                                      
                                        ]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Generate_subjects  $generate_subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $var_subject = Document::where('generate_subjects_id', $id)->get();
        $session = session('idiomas');
        $swal_subject = Swal_subject::where('many_lenguages_id',$session)->first();
      
        if($var_subject->isEmpty())
        {  
            $bandera = 1;
            $subject = Generate_subjects::findOrFail($id);
            $subject->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito_sub'            => $swal_subject->swal_exito_sub,
                                    'swal_eliminar_sub'         => $swal_subject->swal_eliminar_sub,
                                    'swal_info_eliminar_sub'    => $swal_subject->swal_info_eliminar_sub,       
                                    'swal_advertencia_sub'      => $swal_subject->swal_advertencia_sub,
                                    'swal_info_advertencia_sub' => $swal_subject->swal_info_advertencia_sub,
                                ]);
    }

    public function dataTable()
    {       
        $materias = Generate_subjects::query()      
        ->get();
         
        return dataTables::of($materias)
           
            ->addColumn('subject_name', function ($materias){

                return'<i class="fa fa-check-square"></i>'.' '.$materias->subject_name;         
            })
            ->addColumn('cdu', function ($materias){

                return'<i class="fa fa-check-square"></i>'.' '.$materias->cdu;         
            })            
            ->addColumn('created_at', function ($materias){
                return $materias->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($materias) {
                return view('admin.subjects.partials._action', [
                    'materias' => $materias,

                    'url_edit' => route('admin.subjects.edit', $materias->id),                              
                    'url_destroy' => route('admin.subjects.destroy', $materias->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['subject_name','cdu', 'created_at', 'accion']) 
            ->make(true);  
    }
}
