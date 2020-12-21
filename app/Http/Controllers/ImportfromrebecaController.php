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
use Illuminate\Support\Str;

class ImportfromrebecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importar(Request $request)
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
                       
        return view('admin.importfromrebeca.importar', [ 
            'idioma'    => $idioma, 
            'idiomas'   => $idiomas,  
            'setting'   => $documentos,      
            'types'     => Document_type::pluck( 'document_description', 'id')
        ]);     
          
    }

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
                
                
                
                

        if ($request->hasFile('rebeca')) { // verifico si hay un archivo subido.               

            // lo guardo en carpeta rebeca para luego poder leerlo.
            $file = $request->file('rebeca');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/rebeca/', $name);                                 
            
            // $fp = fopen(asset('rebeca/'.$name), "r");
            //         $unica_linea = fgets($fp);
            // dd($unica_linea);
            // esto de arriba tiraba error asi que descartado.                   
            
            //  $contents = mb_convert_encoding(File::get(public_path().'/rebeca/'.$name), 'UTF-8');
            // eso te trae el archivo con los identificadores de salto de linea y todo pero no lee bien 
            // los acentos y esas cosas y les pone ?. no serviria de mucho. lo que si no te pone la b
            // al principio como el de abajo q si o si para sacarla tenes q encodearlo.

                $contents = File::get(public_path().'/rebeca/'.$name);
                //esta linea de arriba lo UNICO  que hace es leer el archivo TXT.
                $contents = utf8_encode($contents); 
                // la primer linea de este bloque te lee tal cual el archivo pero te agrega un "b" arriba
                // que no se sabe a q sera. encodeandolo con la 2da linea lo saca y el resto del archivo
                // a simple vista es el mismo asi que como para sacar esa "b" se encodea con la 2da linea

            // $contents = preg_replace('/[[:cntrl:]]/', '', $contents);
            // esto te saca los indefiticadores de saltos de linea espacios, etc. y te deja el archivo todo
            // seguido y los unicos saltos de linea q se hacen es por el salto de linea propio q tiene el
            // espacio donde se muestran en este caso que lo vemos en el inspector de google.

            //  dd($contents);
                
            $separador = "-------------------------------------------------------------------------------";

                $documentos = explode($separador, $contents);
            //  dd($documentos);
            
            
                    foreach($documentos as $documento){
                    // -----------------------------TITULO--------------------------------------
                    // dd($documento);    
                    $titulo = null;
                        if (Str::contains($documento,'Título:')){    
                            $titulo_del_com = str_after($documento, 'Título:');
                                    $titulo_del_fin = trim(str_before($titulo_del_com, ' / '));
                                    if($titulo_del_fin != ''){
                                        $titulo = $titulo_del_fin;
                                        $documento = str_replace($titulo,'', $documento);
                                        $documento = str_replace('Título:','', $documento);
                                    
                                    }
                                    // LISTOOOOO POSTAAA
                        }
                                //  dd("prueba titulo: ".$titulo);
                    // ----------------1-------------AUTORES-------------------------------------- 
                                    $autor_del_com = null;
                                if (Str::contains($documento,' / ')){
                                    $autor_del_com = str_after($documento, ' / ');
                                    $arreglo_autor_salto_linea = explode("\n", $autor_del_com);
                                    $autores_linea_completa = reset($arreglo_autor_salto_linea);
                                    // dd("yyyy: ".$autores_linea_completa);
                                    // a "Y" no se le hace un remplace xq si o si tiene q ir entre espacios, sino 
                                    //se toma como palabra comun de otra palabra.
                                    $autores_linea_completa = str_replace(',',' , ', $autores_linea_completa);
                                    $autores_linea_completa = str_replace(';',' ; ', $autores_linea_completa);
                                    // dd("qqqqq: ".$autores_linea_completa);
                                    // $documento = str_replace($autores_linea_completa,'', $documento);                                   
                                    $autores_linea_completa = preg_split('/ (,|;|y) /', $autores_linea_completa);
                                    // LISTOOOOO POSTAAA
                                    // dd($autores_linea_completa);
                                }
                        //  LISTO
                        // -----------------------------EDITORIAL-------------------------------------- 
                        $editorial = null;
                        if (Str::contains($documento,'Editorial:')){
                                    $editorial_del_com = str_after($documento, 'Editorial:');
                                    $arreglo_editorial_salto_linea = explode("\n", $editorial_del_com);
                                //  dd($arreglo_editorial_salto_linea);

                                    // dd(reset($arreglo_editorial_salto_linea)); 
                                if(trim(reset($arreglo_editorial_salto_linea) != '')){
                                $editorial = trim(reset($arreglo_editorial_salto_linea));
                                $documento = str_replace($editorial, '', $documento);                                   
                                $documento = str_replace('Editorial:', '', $documento);                                   
                                //LISTO POSTAAAAA
                                }
                        }
                        //  LISTO
                        // -----------------------------DESCRIP FISICA BOOK-------------------------------------- 
                        $quantity = null;
                        if (Str::contains($documento,'Descripción física:')){
                                    $quantity_del_com = str_after($documento, 'Descripción física:');
                                    $arreglo_quantity_salto_linea = explode("\n", $quantity_del_com); 
                                    $quantity_del_fin = trim(str_before(reset($arreglo_quantity_salto_linea), ' ; '));
                                    if($quantity_del_fin != ''){
                                    $quantity = $quantity_del_fin;
                                    $documento = str_replace($quantity, '', $documento);
                                // dd("kkk: ".$quantity);  
                                // LISTO POSTAAAA
                                }

                                // $size  = null;    
                                // $aux_size  =  trim(str_after(reset($arreglo_quantity_salto_linea), ' ; '));
                                //         if($aux_size != ''){
                                //             $size = $aux_size;
                                //             $documento = str_replace($size, '', $documento);
                                //             // dd("aassss: ".$size);
                                //             // LISTO POSTAAAA                  
                                //         }
                                
                                // $documento = str_replace('Descripción física:', '', $documento);
                        }       
                        // -----------------------------DESCRIP FISICA CINE-------------------------------------- 
                    //    $quantity_cine = null;
                    //               $quantity_cine_del_com = str_after($documento, 'Descripción física:');
                    //               $arreglo_quantity_cine_salto_linea = explode("\n", $quantity_cine_del_com); 
                    //               $quantity_cine_del_fin = str_before(reset($arreglo_quantity_cine_salto_linea), ',');
                    //    $quantity_cine = $quantity_cine_del_fin;       
                        //REEVER
                        //------------------------------------------NOTAS-----------------------------------------------------------------------------------------
                        $notas = null;
                                    //DIRECTAMENTE QUEDO EN ESTAS 2 LINEA DE CODIGO PORQUE SIEMPRE SE CUMPLE QUE 
                                    //HAY UNA LINEA VACIA ENTRE LA TERMINACION DE LA NOTA Y LOS DELIMITADORES 
                                    //SIGUENTES.
                                //   if (strpos($documento, 'Notas:') !== false) {
                                    if (Str::contains($documento,'Notas:')){
                                        $notas_del_com = str_after($documento, 'Notas:');
                                        $notas_del_fin = trim(str_before($notas_del_com,"\t\n"));
                                            if($notas_del_fin != ''){
                                                // $notas = $notas_del_fin;
                                                //LISTO POSTAAA 
                                                
                                            if (Str::contains($notas_del_fin, 'Sinopsis:')) {
                                            $notas_aux = str_replace('Sinopsis:', '', $notas_del_fin);
                                            $notas = $notas_aux;
                                            }
                                            else{
                                                $notas = $notas_del_fin;
                                            }
                                            $documento = str_replace($notas, '', $documento);
                                            $documento = str_replace('Notas:', '', $documento);
                                    } 
                                  }
                                    //-----LOGICA NO UTILIZADA PERO DE DEJA POR SI SE NECESITA PARA OTRO DELIMITADOR                                  
                                //   $notas_del_com = str_after($documento, 'Notas:');
                                //   $arreglo_notas_salto_linea = explode("\n", $notas_del_com); 
                                //   $entrar = true;
                                //   foreach($arreglo_notas_salto_linea as $arre){
                                //     if($entrar){
                                //             if(substr($arre,-2, 1) == '.'){
                                //                 $entrar = false;  
                                //                 $notas_del_fin_obt = $arre;
                                //             }
                                //         }
                                //     }
                                    // if($entrar){ // SI ENTRA ACA ES PORQUE NO ENCONTRO PUNTO Y APARTE Y DIRECTAMENTE TOMO LA PRIMER LINEA DE NOTAS
                                    //     $notas_cn_sinopsis = reset($arreglo_notas_salto_linea);
                                    // }else{
                                    //     $notas_resto = str_before($notas_del_com, $notas_del_fin_obt);
                                    //     $notas_cn_sinopsis = $notas_resto.$notas_del_fin_obt;
                                    // }
                                    // $notas = str_replace('Sinopsis:', '', $notas_cn_sinopsis);
                                    // dd($notas);

                                    // INSERT IN SINOPSIS
                    //LISTO
                    //------------------------------------------MATERIAS(REFERENCIAS)-----------------------------------------------------------------------------------------
                    // if (strpos($documento, 'Materias:') !== false) {
                        $materias_del_com = null;
                        if (Str::contains($documento,'Materias:')){
                        $materias_del_com = str_after($documento, 'Materias:');
                        $materias_del_fin = str_before($materias_del_com,"\t\r\n");
                        // dd($materias_del_fin);
                        $documento = str_replace($materias_del_fin, '', $documento);
                        $documento = str_replace('Materias:', '', $documento);
                        $arreglo_materias_salto_linea = explode("\n", $materias_del_fin);
                    }
                    // INSERT IN REFERENCIAS
                    //LISTO
                    //------------------------------------------ISBN-----------------------------------------------------------------------------------------                
                        $isbn = null;
                    //    if (strpos($documento, 'ISBN:') !== false) {
                        if (Str::contains($documento,'ISBN:')){
                                    $isbn_del_com = str_after($documento, 'ISBN:');
                                    $arreglo_isbn_salto_linea = explode("\n", $isbn_del_com); 
                        $isbn = reset($arreglo_isbn_salto_linea);
                        $documento = str_replace($isbn, '', $documento);
                        $documento = str_replace('ISBN:', '', $documento);
                       }
                        // INSERT IN ISBN
                        //LISTO                  
                        //------------------------------------------CDU-----------------------------------------------------------------------------------------                
                        $cdu = null;
                    //   if (strpos($documento, 'ISBN:') !== false) {
                        if (Str::contains($documento,'CDU:')){    
                        $cdu_del_com = str_after($documento, 'CDU:');
                        $arreglo_cdu_salto_linea = explode("\n", $cdu_del_com); 
                        $cdu = reset($arreglo_cdu_salto_linea);
                        $documento = str_replace($cdu, '', $documento);
                        $documento = str_replace('CDU:', '', $documento);
                      }
                        //LISTO
                        //CONSULTAR DONDE MIERDA SE INSERTARIA EN TAL CASO DE Q SE LEVANTE YA Q LO ESTAMSO PREVIENDO SOLAMENTE                  
                        //-----------------------------------------------------------------------------------------------------------------------------------                
                                        
                        // if(trim($isbn) != null && trim($isbn) != ''){

                        // }

                        

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

                    //DESDE ESTE PUNTO SE COMIENZA A INSERTAR LOS DATOS QUE SE PUDIERON LEVANTAR 
                    //A LA TABLA DOCUMENTOS.
                    
                    $new_document = new Document(); 
                    $new_document->document_types_id = 100;
                    $new_document->status_documents_id = 100;
                    $new_document->generate_subjects_id = 100;
                    $new_document->document_subtypes_id = 100;
                    // dd("asdasd".$titulo);
                    if($titulo != null){
                        $new_document->title = $titulo;
                    }

                    
                    if($notas != null){
                        $new_document->synopsis = $notas;
                    }
                    //aqui guadro los datos q no se identificaron como documento y quedan para siempre ahi en ese campo
                    // si algun dia se les canta cambiar el tipo de documento y entonces ya consultan ahi.
                    if(trim($documento) != ''){ 
                        $new_document->temprebecca = $documento;
                    }
                    
                    
                    
                    
                    if($quantity != null){
                        $new_document->quantity_generic = $quantity;
                    }

                    // if($size != null){ //solo para libros
                    // $new_document->quantity_generic = $size;    
                    // }

                    // if($isbn != null){ //solo para libros
                    //     $new_document->isbn = $isbn;
                    // }
                    
                    // if($cdu != null){ //se prevee pero no esta en rebecca aun seria para documentos cuando salga
                    // $cdu;
                    // }

                    // dd($new_document);
                    $new_document->status_documents_id = 100;
                    $new_document->origen = 'REBECCA';
                    $new_document->status_rebecca = 'S';
                    $new_document->save();
                
                            // solo para cine osea movie
                            // if(($autor_del_com != null) && (count($autores_linea_completa) > 0) ){
                            //     foreach($autores_linea_completa as $arre_autores){
                            //         $new_document->syncActors($autores_linea_completa);
                            //     //     //inserto las materias que esten delimitadas por saltos de linea en la DB.
                            //     //     //primero las guardo y dsp las voy asociando al documento q se va a guardar
                            //     // }
                            //     }
                            // }

                            if(($materias_del_com != null) && count($arreglo_materias_salto_linea) > 0){
                                // foreach($arreglo_materias_salto_linea as $arre_materias){
                                //     //inserto las materias que esten delimitadas por saltos de linea en la DB.
                                //     $new_materias = new Generate_subjects();
                                //     $new_materias->subject_name = $arre_materias;
                                //     $new_materias->save();
                                //     //primero las guardo y dsp las voy asociando al documento q se va a guardar

                                //     //NOTA ULTIMA: SOLO SE INSERTA XQ SE ENCONTRO Q GUARDA MAS DE UN DATO Y EL CAMPO
                                //     //ES UN SELECT COMUN DE UNA SOLA OPCION Y NO UN SELECT MULTIPLE COMO A LO MEJOR 
                                //     //DEBERIA SER EN BASE A Q CASI SIEMPRE HA
                                $new_document->syncReferences($arreglo_materias_salto_linea);
                                
                                // } 
                            }
                    }           
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
    public function edit($id)
    {
        // dd("ssdfsdfsf");
        //
    }

    public function edicion($id)
    {
        //queda vacio
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
        $documentos = Document::with('document_type', 'document_subtype')->where('origen', 'REBECCA')      
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
                //   'url_edit'      => route('admin.importfromrebeca.edit', $documentos->id),
                //   'url_edicion'      => route('importfromrebeca.edicion', $documentos->id),  
              ]);
          })           
          ->addIndexColumn()   
          ->rawColumns(['document_types_id', 'document_subtypes_id', 'created_at', 'accion']) 
          ->make(true);           
    }
}
