<?php

namespace App\Http\Controllers;

use App\Generate_letter;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book_movement;
use App\Copy;
use App\Document;
use Illuminate\Support\Facades\DB;

class ClaimLoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.claimloans.prestamo', [
            'model_types' => Generate_letter::pluck('title', 'id') 
        ]);
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

    public function filtarPorFecha($fecha)
    {
         
         $fecha_hasta = Carbon::createFromFormat('d-m-Y', $fecha);
        
         $prestamos = Book_movement::with('user', 'copy.document')
         ->where('date_until','<', $fecha_hasta)
         ->where(function ($query) {
             $query->where('movement_types_id', '=', 1)
                   ->orWhere('movement_types_id', '=', 2);
         })
         ->where('active', 1)               
         ->get();

        //  DB::raw( 'items_alias.*' )
        //  ->pluck('nickname', 'id');

        //  dd($prestamos);

        //  ->pluck('subtype_name', 'id')

          return $prestamos->toJson();
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
}
