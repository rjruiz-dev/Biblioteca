<?php

namespace App\Http\Controllers;


use DataTables;
use Carbon\Carbon;
use App\Importfromrebeca;
use App\Document;
use App\Document_type;
use App\Document_subtype;
use App\Setting;
use App\Ml_dashboard;
use App\Http\Controllers\MARC\File\MARC;
use App\ManyLenguages;
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
    public function index(Request $request)
    {
        // $request->session()->put('idiomas', 2);
        if ($request->session()->has('idiomas')) {
            $existe = 1;
        }else{
            $request->session()->put('idiomas', 1);
            $existe = 0;
        }
        $session = session('idiomas');

        //cargo el idioma
        $idioma     = Ml_dashboard::where('many_lenguages_id',$session)->first();
        $documentos = Setting::where('id', 1)->first();        
        $idiomas    = ManyLenguages::all();
<<<<<<< Updated upstream
                       
        return view('admin.importfromrebeca.index', [
            'idioma'    => $idioma, 
=======
       
        return view('admin.importfromrebeca.importar', [ 
            'idioma'    => $idioma,
>>>>>>> Stashed changes
            'idiomas'   => $idiomas,  
            'setting'   => $documentos,      
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
                


                    $file = $request->file('rebeca');



                                }
                                }
                            }
                            // dd($cantidad);
                           // //  for ($i = 1; $i <= $cantidad; $i++) {
                                    
                            // //     echo $i;

                           // //  }
                            // // $primera = str_after($contents, 'nam  ');
                            // // $segunda = str_before($primera, '13a');
                            // dd($segunda);
                            // $titulo = Str::between("00621nam", '006', 'nam');
                            // $documentos = new Setting(); 
                            // $documentos->library_name = $segunda;
                            // $documentos->save();
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
    public function update(Request $request, $id)
    {
        if ($request->ajax()){
          try {
            //  Transacciones
            DB::beginTransaction();

            $documentos = Setting::findOrFail($id);

            if ($request->hasFile('logo')) {               

                $file = $request->file('logo');
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);   
                $documentos->logo              = $name;
            }
            // else{
            //     $name = 'library-default.jpg';
            // }           
          
            $documentos->library_name      = $request->get('library_name');
            $documentos->library_email     = $request->get('library_email');
            $documentos->library_phone     = $request->get('library_phone');
            $documentos->language          = $request->get('language');
            $documentos->street            = $request->get('street');  
            $documentos->city              = $request->get('city');
            $documentos->province          = $request->get('province');  
            $documentos->city              = $request->get('city');
            $documentos->postal_code       = $request->get('postal_code');
            $documentos->country           = $request->get('country');  
            $documentos->loan_limit        = $request->get('loan_limit');    
            $documentos->loan_day          = $request->get('loan_day'); 
            $documentos->child_age         = $request->get('child_age');    
            $documentos->adult_age         = $request->get('adult_age');
            $documentos->skin              = $request->get('skin');
            $documentos->skin_footer       = $request->get('skin_footer');
            
            $documentos->fines_id = $request->get('group');

            $multa_eco = Fine::findOrFail(1); //cargo economica
            $multa_sus = Fine::findOrFail(2);//cargo suspension
            
            if($request->get('price_penalty') != null){
                $multa_eco->unit             = $request->get('price_penalty');
                $multa_eco->save();
            }

            if($request->get('days_penalty') != null){
            $multa_sus->unit             = $request->get('days_penalty');
            $multa_sus->save();
            }

            // $documentos->logo              = $name; 
              
            $documentos->save();
            
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
     * @param  \App\Importfromrebeca  $importfromrebeca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Importfromrebeca $importfromrebeca)
    {
        //
    }

    
    public function dataTable()
    {                    
        $documentos = Document::with('document_type', 'document_subtype')      
        ->get(); 
     
        return dataTables::of($documentos)
          ->addColumn('document_types_id', function ($documentos){
              if($documentos->document_type['document_description'] == null){
                  return 'Sin Tipo';
              }else{
                  return $documentos->document_type['document_description'];              
              }
          })  
          ->addColumn('document_subtypes_id', function ($documentos){
              if($documentos->document_subtype['subtype_name'] == null){
                  return 'Sin Subtipo';
              }else{
                  return $documentos->document_subtype['subtype_name'];              
              }
          })     
          ->addColumn('created_at', function ($documentos){
              return $documentos->created_at->format('d-m-y');
          })  
          ->addColumn('accion', function ($documentos) {
              return view('admin.importfromrebeca.partials._action', [
                  'documentos' => $documentos,                                 
                  'url_edit'      => route('admin.importfromrebeca.edit', $documentos->id),  
                  'url_baja'      => route('importfromrebeca.baja', $documentos->id),
                  'url_reactivar' => route('importfromrebeca.reactivar', $documentos->id),                            
                
              ]);
          })           
          ->addIndexColumn()   
          ->rawColumns(['document_types_id', 'document_subtypes_id', 'created_at', 'accion']) 
          ->make(true);           
    }
}
