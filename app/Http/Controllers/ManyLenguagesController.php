<?php

namespace App\Http\Controllers;

use App\ManyLenguages;
use Illuminate\Http\Request;

class ManyLenguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function show(ManyLenguages $manyLenguages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function edit(ManyLenguages $manyLenguages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManyLenguages $manyLenguages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManyLenguages  $manyLenguages
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManyLenguages $manyLenguages)
    {
        //
    }

    public function dataTable()
    {   
        $idiomas = ManyLenguages::get();
        // dd($idiomas);       
        return dataTables::of($idiomas)

            ->addColumn('created_at', function ($idiomas){
                return $idiomas->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($idiomas) {
                return view('admin.manylenguages.partials._action', [
                    'idiomas'            => $idiomas,
                    'url_show'          => route('admin.manylenguages.show', $idiomas->id),                        
                    'url_edit'          => route('admin.manylenguages.edit', $idiomas->id),
                    'url_baja'          => route('manylenguages.baja', $idiomas->id),
                    'url_reactivar'     => route('manylenguages.reactivar', $idiomas->id),   
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['created_at', 'accion']) 
            ->make(true);  
    }
}
