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
                       
        return view('admin.importfromrebeca.index', [
            'idioma'    => $idioma, 
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
                

                if ($request->hasFile('rebeca')) {               

                    $file = $request->file('rebeca');
                    // $name = time().$file->getClientOriginalName();
                    // $file->move(public_path().'/rebeca/', $name); 



                                            
                            require 'MARC/File/MARC.php';

                            include ("opciones.php");
                            include ("config.php");
                            include ("secure.php");
                            include ("kphpl.php");
                            include ("cabecera.inc");


                            function limpiar_marc($str,$first_caracter="",$last_caracter="",$mas_caracter=""){

                            $str=str_replace("[a]:","",$str);
                            $str=str_replace("[b]:","",$str);
                            $str=str_replace("[c]:","",$str);
                            $str=trim($str);

                            if($first_caracter!="")
                            {

                                $first = $str[0];

                                if($first==trim($first_caracter))
                                {
                                $str=ltrim($str, $first_caracter);
                                }
                            }

                            if($last_caracter!="")
                            {

                                $last = substr($str, -1);

                                if($last==trim($last_caracter))
                                {
                                $str=substr($str, 0, -1);
                                }
                            }


                            if($mas_caracter!="")
                            {

                                $str= str_replace(trim($mas_caracter),"",$str);
                            }

                            return utf8_encode($str);
                            }

                            $x = 0;

//throw new Exception('Mensaje desde unaFuncion().');
    // Retrieve a set of MARC records
    $bibrecords = new MARC($file, MARC::SOURCE_FILE);

    // Iterate through the retrieved records
    while ($record = $bibrecords->next()) {


      if($x>0)break;
          
        // Print the leader
        // $record->getLeader();

        $subjects = $record->getFields();


  

        if ($subjects) {


            $titleField_isbn = $record->getField('20', true);

              if($titleField_isbn!="")
              {
                $titleField_isbn = limpiar_marc($titleField_isbn->getSubfield('a'));
              }


            $titleField_editorial_source = $record->getField('260', true);

            if($titleField_editorial_source!="")
              {
                $titleField_pubicadoen = limpiar_marc($titleField_editorial_source->getSubfield('a'),"",":");
                $titleField_editorial = limpiar_marc($titleField_editorial_source->getSubfield('b'),"",",");
                $titleField_anho = limpiar_marc($titleField_editorial_source->getSubfield('c'),"",".","D.L.");
              }
            

            $titleField_pagina_source = $record->getField('300', true);

            if($titleField_pagina_source!="")
              {
                $titleField_pagina = limpiar_marc($titleField_pagina_source->getSubfield('a'));
                $titleField_tamanho = limpiar_marc($titleField_pagina_source->getSubfield('c'));
              }


            

             $titleField_titulo_source = $record->getField('245', true);

              if($titleField_titulo_source!="")
              {


                 $titleField_titulo = limpiar_marc($titleField_titulo_source->getSubfield('a'),"","/");
                 $titleField_subtitulo = limpiar_marc($titleField_titulo_source->getSubfield('b'),":","/");
                 $titleFeild_titulo_short = strtolower (substr( $titleField_titulo, 0, 3));

                 

              }



             $titleField_autor = $record->getField('100', true);

             if($titleField_autor!="")
            {
                $titleField_autor = limpiar_marc($titleField_autor->getSubfield('a'),"","(");
                $titleFeild_autor_short = strtoupper(substr( $titleField_autor, 0, 3));

            }


              $titleField_cdu = $record->getField('080', true);

            if($titleField_cdu!="")
            {
              $titleField_cdu = limpiar_marc($titleField_cdu->getSubfield('a'));

            }


              

              $titleField_edicion = $record->getField('250', true);

              if($titleField_edicion!="")
              {
                $titleField_edicion = limpiar_marc($titleField_edicion->getSubfield('a'),"",".");
              }


              $titleField_notas = $record->getField('500', true);

              if($titleField_notas!="")
              {
                $titleField_notas = limpiar_marc($titleField_notas->getSubfield('a'));
              }

              $titleField_contenido = $record->getField('520', true);

              if($titleField_contenido!="")
              {
                $titleField_contenido = limpiar_marc($titleField_contenido->getSubfield('a'));
              }



              $titleField_referenciauno = $record->getField('650', true);
              if($titleField_referenciauno!="")
              {
                $titleField_referenciauno = limpiar_marc($titleField_referenciauno->getSubfield('a'));
              }



              $titleField_referenciados = $record->getField('710', true);

              if($titleField_referenciados!="")
              {
                $titleField_referenciados = limpiar_marc($titleField_referenciados->getSubfield('a'));
              }


              $titleField_adquirido = date("d-m-Y");
              $titleField_volumen   = "1 v";
            }
        }
          // dd($titleField_titulo);                                   
                    
                    // $fp = fopen(asset('rebeca/'.$name), "r");
                    //         $unica_linea = fgets($fp);
                    
                    // // $contents1 = mb_convert_encoding(File::get(public_path().'/rebeca/'.$name), 'UTF-8');
                    
                    // $contents = utf8_encode($contents1);
                    // $contents = File::get(public_path().'/rebeca/'.$name);
                    
                    // // $contents = preg_replace('/[[:cntrl:]]/', '', $contents1);
                    
                    //  dd($contents);
                          // //   $cantidad = substr_count($contents, 'nam  ', 0);
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
