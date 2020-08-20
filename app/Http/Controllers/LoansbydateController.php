<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book_movement;
use Carbon\Carbon;
use DataTables;

class LoansbydateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.loansbydate.index');
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
        //
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

    public function dataTable(Request $request)
    {   
        // dd($request->fecha_desde);
        if ($request->ajax()){
            // dd(->fecha_desde); 
            $prestamos = Book_movement::with('copy.document','user','course')
            // ->whereBetween('date_until', [$request->fecha_desde, $request->fecha_hasta] )
            ->get();
        
            return dataTables::of($prestamos)
            // ->addColumn('id_doc', function ($prestamos){
            //     return $prestamos->document['id']."<br>";            
            // })              
            // ->addColumn('documents_id', function ($prestamos){
            //     return
            //         '<i class="fa fa-video-camera"></i>'.' '.$prestamos->document['title']."<br>".
            //         '<i class="fa fa-user"></i>'.' '.$prestamos->document->creator->creator_name."<br>";         
            // }) 
            // ->addColumn('generate_films_id', function ($prestamos){
            //     if($prestamos->generate_prestamos->genre_film != null){
            //         return $prestamos->generate_prestamos->genre_film;
            //     }else{
            //         return 'Sin Genero';
            //     }             
            // }) 
            // ->addColumn('generate_formats_id', function ($prestamos){
            //     if($prestamos->generate_format->genre_format != null){
            //         return $prestamos->generate_format->genre_format;
            //     }else{
            //         return 'Sin Formato';
            //     }              
            // })  
            // ->addColumn('lenguages_id', function ($prestamos){
            //     if($prestamos->document->lenguage->leguage_description != null){
            //     return'<i class="fa  fa-globe"></i>'.' '.$prestamos->document->lenguage->leguage_description;         
            //     }else{
            //         return 'Sin Lenguaje';
            //     }
            //     })
            // ->addColumn('status', function ($prestamos){

            //     return'<span class="'.$prestamos->document->status_document->color.'">'.' '.$prestamos->document->status_document->name_status.'</span>';
            //     // return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';         
            // })            
            ->addColumn('created_at', function ($prestamos){
                return $prestamos->created_at->format('d-m-y');
            })                 
            
            // ->addColumn('accion', function ($prestamos) {
            //     // 'route' => $user->exists ? ['admin.users.update', $user->id] : 'admin.users.store',  
            //     return view('admin.prestamoss.partials._action', [
            //         'prestamos'             => $prestamos,
            //         'url_show'          => route('admin.prestamoss.show', $prestamos->id),                        
            //         'url_edit'          => route('admin.prestamoss.edit', $prestamos->id),  
            //         'url_copy'          => route('prestamoss.copy', $prestamos->document->id),                              
            //         'url_desidherata'   => route('prestamoss.desidherata', $prestamos->document->id),
            //         'url_baja'          => route('prestamoss.baja', $prestamos->document->id),
            //         'url_reactivar'     => route('prestamoss.reactivar', $prestamos->document->id),
            //         'url_print'         => route('cine.pdf', $prestamos->id)   
            //     ]);

            // })           
            ->addIndexColumn()   
            ->rawColumns(['created_at']) 
            ->make(true);  
        }
    }
}
