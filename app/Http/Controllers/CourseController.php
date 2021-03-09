<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Course;
use App\Document;
use App\Setting;
use App\Ml_course;
use App\Ml_dashboard;
use App\ManyLenguages;
use App\Swal_course;
use App\Book;
use App\Book_movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveCourseRequest;

class CourseController extends Controller
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

        $idioma         = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $ml_course      = Ml_course::where('many_lenguages_id', $idioma->id)->first();
        $swal_course    = Swal_course::where('many_lenguages_id',$session)->first();
        $setting        = Setting::where('id', 1)->first();
        $idiomas = ManyLenguages::where('baja', 0)->get(); // cargo todo el listado de idiomas habilitados.
     
        return view('admin.courses.index', [
            'idioma'    => $idioma,
            'idiomas'   => $idiomas,
            'setting'   => $setting,  
            'ml_course' => $ml_course,
            'swal_course' => $swal_course
        ]);         
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = new Course();
        
        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_course  = Ml_course::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.courses.partials.form', [           
            'course'  => $course,
            'setting' => $setting,
            'idioma'    => $idioma,            
            'ml_course' => $ml_course

        ]);  
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCourseRequest $request)
    {
        
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                // Creamos el genero           
                $course = new Course;  
                $course->course_name  = $request->get('course_name'); 
                $course->group        = $request->get('group');  
                $course->baja         = 0;                    
                $course->save();

                DB::commit();

                $session = session('idiomas');
                $swal_course = Swal_course::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito'        => $swal_course->swal_exito,
                                            'swal_info_exito'   => $swal_course->swal_info_exito                                      
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
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {       
        $course = Course::findOrFail($id);

        if (!$request->session()->has('idiomas')) { 
            
            $request->session()->put('idiomas', 1);
        }

        $session = session('idiomas'); 

        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();  
        $ml_course  = Ml_course::where('many_lenguages_id', $idioma->id)->first();
        $setting = Setting::where('id', 1)->first();

        return view('admin.courses.partials.form', [           
            'course'    => $course,
            'setting' => $setting,
            'idioma'    => $idioma,            
            'ml_course' => $ml_course         
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCourseRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                            
                $course = Course::findOrFail($id);

                // Actualizamos el genero               
                $course->course_name  = $request->get('course_name');  
                $course->group        = $request->get('group');                 
                $course->save();
                 
                DB::commit();

                $session = session('idiomas');
                $swal_course = Swal_course::where('many_lenguages_id',$session)->first();
                return response()->json([   
                                            'swal_exito'        => $swal_course->swal_exito,
                                            'swal_info_exito'   => $swal_course->swal_info_exito
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
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $session = session('idiomas');
        $swal_course = Swal_course::where('many_lenguages_id',$session)->first();


        if($course->baja == 0){ // si esta activo evaluo si se puede dar de baja
            $genre = Book_movement::where('courses_id', $id)->where('active', 1)->get();
            
            
            
            if($genre->isEmpty())
            {  
                $bajado_reactivado = $swal_course->swal_bajado;
                $bandera = 1;
                
                $course->baja = 1; // lo pongo en baja
                $course->save();
                // $course->delete();

            }else{          
                $bandera = 0; // si es 0 no se puede dar de baja xq hay prestamos vigentes          
            }
        }else{  // si esta en baja directamente lo doy de alta 
                $bajado_reactivado = $swal_course->swal_reactivado;
                $bandera = 1; // si retorno 1 es xq se pudo o dar de baja o reactivar
                $course->baja = 0; // lo pongo en alta
                $course->save();
        }

         
      
        return response()->json([
                                    'data' => $bandera,                                
    
                                    'swal_exito'        => $swal_course->swal_exito,
                                    'bajado_reactivado' => $bajado_reactivado,                                  
    
                                    'swal_advertencia'      => $swal_course->swal_advertencia,
                                    'swal_info_advertencia' => $swal_course->swal_info_advertencia,
    
                                ]);              
    }

    public function deleteCourse($id)
    {       
        $document       = Book_movement::where('courses_id', $id)->where('active', 1)->get();
        $session        = session('idiomas');
        $swal_course    = Swal_course::where('many_lenguages_id',$session)->first();

      
        if( $document->isEmpty())
        {  
            $bandera = 1;
            $course = Course::findOrFail($id);  
            $course->baja = 3; // eliminado logicamente
            $course->save();      


        }else{          
            $bandera = 0;            
        }
        return response()->json([
                                    'data' => $bandera,
                                    'swal_exito'            => $swal_course->swal_exito,
                                    'swal_eliminar'         => $swal_course->swal_eliminar,
                                    'swal_info_eliminar'    => $swal_course->swal_info_eliminar,   
                                    'swal_advertencia'      => $swal_course->swal_advertencia,
                                    'swal_info_advertencia' => $swal_course->swal_info_advertencia
                                ]);  
      
    }

    public function dataTable()
    {       
        $cursos = Course::where('baja', '<>', 3)->get();
         
        return dataTables::of($cursos)
           
            ->addColumn('course_name', function ($cursos){

                return'<i class="fa fa-check-square"></i>'.' '.$cursos->course_name;         
            })  
            ->addColumn('group', function ($cursos){

                return'<i class="fa fa-check-square"></i>'.' '.$cursos->group;         
            })              
            ->addColumn('created_at', function ($cursos){
                return $cursos->created_at->format('d-m-y');
            })
            ->addColumn('estado', function ($cursos){
                if($cursos->baja == 0){
                    return '<span class="label label-success sm">Activo</span>';
                }else{
                    return '<span class="label label-danger sm">Inactivo</span>';
                    
                }
            })                 
            
            ->addColumn('accion', function ($cursos) {
                return view('admin.courses.partials._action', [
                    'cursos' => $cursos,

                    'url_edit'          => route('admin.courses.edit', $cursos->id),                              
                    'url_destroy'       => route('admin.courses.destroy', $cursos->id),
                    'url_deleteCourse'  => route('admin.courses.deleteCourse', $cursos->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['course_name', 'group', 'created_at', 'estado', 'accion']) 
            ->make(true);  
    }
}
