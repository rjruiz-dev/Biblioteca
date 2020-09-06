<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Adequacy;
use App\Generate_book;
use App\Lenguage;
use App\Document_generate_reference;
use App\User;
use App\Generate_music;
use App\Generate_film;
use App\Generate_format;
use App\Generate_subjects;
use App\Book_movement;
use App\Document;
use App\Generate_reference;
use App\InfoOfDataBase;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;

class InfoofdatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('admin.infoofdatabase.index');
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

    public function dataTable()
    {   
        $infoOfDataBase = InfoOfDataBase::all(); 
        

        $prestamos_vigentes = Book_movement::where(function ($query) {
                    $query->where('movement_types_id', '=', 1) // en prestamo
                          ->orWhere('movement_types_id', '=', 2); // en renovacion
                })
                ->where('active', 1)
                ->select(DB::raw('count(*) as count_of_prestamos_vigentes'))  
                ->first();

                $prestamos_historico = Book_movement::where('movement_types_id', 1)
                ->select(DB::raw('count(*) as count_of_prestamos_historico'))  
                ->first();

                $solicitudes_vigentes = Book_movement::where('movement_types_id', 7)
                ->where('active', 1)
                ->select(DB::raw('count(*) as count_of_solicitudes_vigentes'))  
                ->first();

                $solicitudes_historico = Book_movement::where('movement_types_id', 7)
                ->select(DB::raw('count(*) as count_of_solicitudes_historico'))  
                ->first();

                $adecuaciones = Adequacy::select(DB::raw('count(*) as count_of_adecuaciones'))  
                ->first();

                $materias = Generate_subjects::select(DB::raw('count(*) as count_of_materias'))  
                ->first();

                $referencias = Generate_reference::select(DB::raw('count(*) as count_of_referencias'))  
                ->first();

                $sinopsis = Document::where('synopsis', '<>', '')
                // where('synopsis', 7)
                ->select(DB::raw('count(*) as count_of_synopsis'))  
                ->first();

                $cursos = Course::select(DB::raw('count(*) as count_of_cursos'))  
                ->first();

                $formatos = Generate_format::select(DB::raw('count(*) as count_of_formatos'))  
                ->first();
                //aqui sumo los totales de los generos de los que supuestamente tiene genero
                // que son book, musica y cine(film).
                $generos_book = Generate_book::select(DB::raw('count(*) as count_of_book'))  
                ->first();

                $generos_music = Generate_music::select(DB::raw('count(*) as count_of_music'))  
                ->first();

                $generos_cine = Generate_film::select(DB::raw('count(*) as count_of_cine'))  
                ->first();
                $total_generos = $generos_book->count_of_book + $generos_music->count_of_music + $generos_cine->count_of_cine;

                $idiomas = Lenguage::select(DB::raw('count(*) as count_of_idiomas'))  
                ->first();

                $documentos = Document::select(DB::raw('count(*) as count_of_documentos'))  
                ->first();

                $socios_activos = User::where('status_id', 1)
                ->select(DB::raw('count(*) as count_of_socios_activos'))  
                ->first();

                // $referencias_en_documentos = Document::with('references')->select(DB::raw('count(*) as count_of_doc_reference'))  
                // ->first();
               
                
                $referencias_en_documentos_p = DB::select("SELECT count(*) as count_of_referencias_en_documentos FROM document_generate_reference");
                $referencias_en_documentos = $referencias_en_documentos_p[0];

                
                // dd($referencias_en_documentos);

                
     
        return dataTables::of($infoOfDataBase)
        
            ->addColumn('cantidades', function ($infoOfDataBase) use ($prestamos_vigentes, $prestamos_historico, 
            $solicitudes_vigentes, $solicitudes_historico, $adecuaciones, $materias, $referencias, $sinopsis,
             $cursos, $formatos, $total_generos, $idiomas, $documentos, $socios_activos,
             $referencias_en_documentos){
                    if($infoOfDataBase->numero == 1){
                        return $prestamos_vigentes->count_of_prestamos_vigentes;                           
                    }
                    if($infoOfDataBase->numero == 2){
                        return $prestamos_historico->count_of_prestamos_historico;                           
                    }
                    if($infoOfDataBase->numero == 3){
                        return $solicitudes_vigentes->count_of_solicitudes_vigentes;                           
                    }
                    if($infoOfDataBase->numero == 4){
                        return $solicitudes_historico->count_of_solicitudes_historico;                           
                    }
                    if($infoOfDataBase->numero == 5){
                        return $adecuaciones->count_of_adecuaciones;                           
                    }
                    if($infoOfDataBase->numero == 6){
                        return $materias->count_of_materias;                           
                    }
                    if($infoOfDataBase->numero == 7){
                        return $referencias->count_of_referencias;                           
                    }
                    if($infoOfDataBase->numero == 8){
                        return $sinopsis->count_of_synopsis;                           
                    }
                    if($infoOfDataBase->numero == 9){
                        return $cursos->count_of_cursos;                           
                    }
                    if($infoOfDataBase->numero == 10){
                        return $formatos->count_of_formatos;                           
                    }
                    if($infoOfDataBase->numero == 11){
                        return $total_generos;                           
                    }
                    if($infoOfDataBase->numero == 12){
                        return $idiomas->count_of_idiomas;                           
                    }
                    if($infoOfDataBase->numero == 13){
                        return $documentos->count_of_documentos;                           
                    }
                    if($infoOfDataBase->numero == 14){
                        return $socios_activos->count_of_socios_activos;                           
                    }
                    if($infoOfDataBase->numero == 15){
                        return $referencias_en_documentos->count_of_referencias_en_documentos;                           
                    }
                
            }) 
                        
                      
            ->addIndexColumn()   
            ->rawColumns(['cantidades']) 
            ->make(true);  
    }
}
