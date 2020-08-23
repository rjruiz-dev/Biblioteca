<?php

namespace App\Http\Controllers;

use App\Importfromrebeca;
use App\Document_type;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class ImportfromrebecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.importfromrebeca.importar', [
            'types'     => Document_type::pluck( 'document_description', 'id')
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();
                
                
                $document_types_id     = $request->get('document_types_id'); 
                

                if ($request->hasFile('rebeca')) {               

                    $file = $request->file('rebeca');
                    $name = time().$file->getClientOriginalName();
                    $file->move(public_path().'/rebeca/', $name); 
                    
                    
                    // $fp = fopen(asset('rebeca/'.$name), "r");
                    //         $unica_linea = fgets($fp);
                    $contents1 = mb_convert_encoding(File::get(public_path().'/rebeca/'.$name), 'UTF-8');
                    // $contents = utf8_encode($contents1);
                    // $contents = File::get(public_path().'/rebeca/'.$name);
                    $contents = preg_replace('/[[:cntrl:]]/', '', $contents1);
                            //  dd($contents);
                            $cantidad = substr_count($contents, 'nam  ', 0);
                            // dd($cantidad);
                            for ($i = 1; $i <= $cantidad; $i++) {
                                    
                                echo $i;

                            }
                            $primera = str_after($contents, 'nam  ');
                            $segunda = str_before($primera, '13a');
                            // dd($segunda);
                            // $titulo = Str::between("00621nam", '006', 'nam');
                            // $setting = new Setting(); 
                            // $setting->library_name = $segunda;
                            // $setting->save();
                            // dd($titulo);
 
                    // fclose($fp);

                }else{
                // si no sube el archivo entra aca . mandar msj de errorr   
                }  


                
                DB::commit();

                // return response()->json(['titulo' => $titulo]);

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Importfromrebeca  $importfromrebeca
     * @return \Illuminate\Http\Response
     */
    public function show(Importfromrebeca $importfromrebeca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Importfromrebeca  $importfromrebeca
     * @return \Illuminate\Http\Response
     */
    public function edit(Importfromrebeca $importfromrebeca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Importfromrebeca  $importfromrebeca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Importfromrebeca $importfromrebeca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Importfromrebeca  $importfromrebeca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Importfromrebeca $importfromrebeca)
    {
        //
    }
}
