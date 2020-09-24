<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Course;
use App\Ml_dashboard;
use App\ManyLenguages;
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
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        $idioma = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $idiomas = ManyLenguages::all();
       
        return view('admin.courses.index', [
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
        $course = new Course();      
                             
        return view('admin.courses.partials.form', [           
            'course'  => $course
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
                $course->save();

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
    public function edit($id)
    {
        $course = Course::findOrFail($id);
                             
        return view('admin.courses.partials.form', [           
            'course'  => $course
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
        $genre = Book_movement::where('courses_id', $id)->where('active', 1)->get();
      
        if($genre->isEmpty())
        {  
            $bandera = 1;
            $course = Course::findOrFail($id);
            $course->baja = 1; // lo pongo en baja
            $course->save();
            // $course->delete();

        }else{          
            $bandera = 0;            
        }
        return response()->json(['data' => $bandera]);  
    }

    public function dataTable()
    {       
        $cursos = Course::query()      
        ->get();
         
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
                    return 'Activo';
                }else{
                    return 'Baja';
                }
            })                 
            
            ->addColumn('accion', function ($cursos) {
                return view('admin.courses.partials._action', [
                    'cursos' => $cursos,

                    'url_edit' => route('admin.courses.edit', $cursos->id),                              
                    'url_destroy' => route('admin.courses.destroy', $cursos->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['course_name', 'group', 'created_at', 'accion']) 
            ->make(true);  
    }
}
