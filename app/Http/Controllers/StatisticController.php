<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Book_movement;
use App\User_movement;
use App\User;
use App\Ml_dashboard;
use App\ManyLenguages;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
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
        
        $users = User::all();
        foreach($users as $user){
            // $dif = Carbon\Carbon::parse($docs_of_use->date_until)->diffInDays(Carbon\Carbon::now()); 
                       
        $user = User::findOrFail($user->id);
        
        $edad_calculada = Carbon::parse($user->birthdate)->diffInYears(Carbon::now());
        // dd($edad_calculada);
        if($user->edad != $edad_calculada){
                $user->edad = $edad_calculada;
                $user->save();
            }
        }

        return view('admin.statistic.index', [
            'idioma'      => $idioma,
            'idiomas'      => $idiomas
        ]);         
      
    }


    public function filtrar($fecha_d, $fecha_h)
    {
        // dd($fecha);
        $fecha_de = Carbon::createFromFormat('d-m-Y', $fecha_d); 
        $fecha_ha = Carbon::createFromFormat('d-m-Y', $fecha_h); 
        // dd($fecha_de);
        // dd($fecha_ha);
        // $partner = User::findOrFail($id)->toArray();
        $edad_config = 14;

        $soc_adul_alta = User_movement::with('user') //FILTRAR POR EL USUARIO ESE 
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        ->where('actions_id', 3)
        -> whereBetween ('created_at', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_soc_adul_alta'))->first();

        $soc_menor_alta = User_movement::with('user') //FILTRAR POR EL USUARIO ESE 
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        ->where('actions_id', 3)
        -> whereBetween ('created_at', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_soc_menor_alta'))->first();

        $soc_adul_baja = User_movement::with('user') //FILTRAR POR EL USUARIO ESE 
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        ->where('actions_id', 4)
        -> whereBetween ('created_at', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_soc_adul_baja'))->first();

        
        $soc_menor_baja = User_movement::with('user') //FILTRAR POR EL USUARIO ESE 
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        ->where('actions_id', 3)
        -> whereBetween ('created_at', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_soc_menor_baja'))->first();

        // dd($soc_adul_alta);
        $col_libros = Book_movement::with('copy.document')->where('movement_types_id', 6) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 3);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_libros'))->first();

        // dd($soc_adul_alta);
        $col_cine = Book_movement::with('copy.document')->where('movement_types_id', 6) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 2);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_cine'))->first();


        $col_music = Book_movement::with('copy.document')->where('movement_types_id', 6) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 1);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_music'))->first();

        $col_fotografia = Book_movement::with('copy.document')->where('movement_types_id', 6) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 5);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_fotografia'))->first();

        $col_multimedia = Book_movement::with('copy.document')->where('movement_types_id', 6) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 4);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_multimedia'))->first();

        $col_baja_multimedia = Book_movement::with('copy.document')->where('movement_types_id', 4) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 4);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_baja_multimedia'))->first();

        $col_baja_fotografia = Book_movement::with('copy.document')->where('movement_types_id', 4) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 5);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_baja_fotografia'))->first();

        $col_baja_book = Book_movement::with('copy.document')->where('movement_types_id', 4) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 3);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_baja_book'))->first();
        // dd($col_baja_book->count_col_baja_book);
        $col_baja_cine = Book_movement::with('copy.document')->where('movement_types_id', 4) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 2);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_baja_cine'))->first();

        $col_baja_music = Book_movement::with('copy.document')->where('movement_types_id', 4) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 1);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_col_baja_music'))->first();

        $pres_adult_book = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 3);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_adult_book'))->first();

        $pres_adult_cine = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 2);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_adult_cine'))->first();
        // dd($pres_adult_cine->count_pres_adult_cine);
        $pres_adult_music = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 1);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_adult_music'))->first();

        $pres_adult_fotografia = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 5);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_adult_fotografia'))->first();

        $pres_adult_multimedia = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 4);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '>=', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_adult_multimedia'))->first();

        //-------------------------------------------------------------------------------------------------------------------------
        $pres_infantil_book = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 3);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_infantil_book'))->first();

        $pres_infantil_cine = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 2);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_infantil_cine'))->first();
        // dd($pres_infantil_cine->count_pres_infantil_cine);
        $pres_infantil_music = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 1);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_infantil_music'))->first();

        $pres_infantil_fotografia = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 5);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_infantil_fotografia'))->first();

        $pres_infantil_multimedia = Book_movement::with('copy.document','user')->where('movement_types_id', 1) //6 = disponiblidad inicial
        ->whereHas('copy.document', function($q)
        {
            $q->where('document_types_id', '=', 4);
        
        })
        ->whereHas('user', function($q) use ($edad_config)
        {
            $q->where('edad', '<', $edad_config);
        
        })
        -> whereBetween ('date', [$fecha_de, $fecha_ha])
        ->select(DB::raw('count(*) as count_pres_infantil_multimedia'))->first();
        //------------------------------------------------------------------------------------------------------------------------

        
        // dd($col_libros->count_col_libros);
        // $maximo_dias_parce = Setting::select('loan_limit')->first();
        // $maximo_dias = $maximo_dias_parce->loan_limit;

        // dd($maximo_dias);       

     
        // if($request->ajax())
        // {
            // return response()->json(
            //     $partner->toArray(),
            //     $count->toArray()
            // );
             //envio esto solo provisoriamente    
            // return $partner->toJson();
            // return response()->json('col_libros'=>$col_libros);
            return response()->json(array('col_libros'=>$col_libros,'col_cine'=>$col_cine,
            'soc_adul_alta'=>$soc_adul_alta,'soc_menor_alta'=>$soc_menor_alta,
            'soc_adul_baja'=>$soc_adul_baja,'soc_menor_baja'=>$soc_menor_baja,'col_music'=>$col_music,
            'col_fotografia'=>$col_fotografia,'col_multimedia'=>$col_multimedia,
            'col_baja_multimedia'=>$col_baja_multimedia,'col_baja_fotografia'=>$col_baja_fotografia,
            'col_baja_book'=>$col_baja_book,'col_baja_cine'=>$col_baja_cine,'col_baja_music'=>$col_baja_music,
            'pres_adult_book'=>$pres_adult_book,'pres_adult_cine'=>$pres_adult_cine,
            'pres_adult_music'=>$pres_adult_music,'pres_adult_fotografia'=>$pres_adult_fotografia,'pres_adult_multimedia'=>$pres_adult_multimedia,
            'pres_infantil_book'=>$pres_infantil_book,'pres_infantil_cine'=>$pres_infantil_cine,
            'pres_infantil_music'=>$pres_infantil_music,'pres_infantil_fotografia'=>$pres_infantil_fotografia,'pres_infantil_multimedia'=>$pres_infantil_multimedia));


            // return $count->toJson();
          
        // }  

        // return response()->json(['message' => 'recibimos el request pero no es ajax']);
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
}
