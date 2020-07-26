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

class LoanManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.loanmanual.index');
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
        $documento = Document::with('document_type','document_subtype','creator')
        ->findOrFail($id); 
        
        $copies = Copy::where('documents_id', $documento->id)->get()->pluck('id', 'id');
        
        $users = User::where('status_id', 3)->get()->pluck('name', 'id');

        $courses = Course::all()->pluck('course_name', 'id');

        
        // dd($copies);

        return view('admin.loanmanual.prestar', [
            'documento'          => $documento,
            'copies'          => $copies,
            'users'          => $users,
            'courses'          => $courses,
            // 'groups'          => $groups,
            // 'turnos'          => $turnos
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
                return view('admin.loanmanual.partials._action', [
                    'documentos' => $documentos,
                                            
                    'url_edit' => route('admin.loanmanual.edit', $documentos->id),                              
                    
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['tipo_documento', 'sub_tipo_documento', 'created_at', 'accion']) 
            ->make(true);  
    }
}
