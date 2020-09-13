<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Document;
use App\Generate_subjects;
use Illuminate\Http\Request;
use App\Ml_dashboard;
use App\ManyLenguages;
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
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
    
        return view('admin.subjects.index', [
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
        $subject = new Generate_subjects();      
                             
        return view('admin.subjects.partials.form', [           
            'subject'  => $subject
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
    public function edit($id)
    {
        $subject = Generate_subjects::findOrFail($id);
                             
        return view('admin.subjects.partials.form', [           
            'subject'  => $subject
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
      
        if($var_subject->isEmpty())
        {  
            $bandera = 1;
            $subject = Generate_subjects::findOrFail($id);
            $subject->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);
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
