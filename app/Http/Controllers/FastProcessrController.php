<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Document;
use DataTables;

class FastProcessController extends Controller
{
    public function index_user()
    {
        return view('admin.fastprocess.index_user');
    }

    public function index_doc()
    {
        return view('admin.fastprocess.index_doc');
    }

    public function dataTableUser()
    {                    
        $usuarios = User::with('statu')       
        // ->allowed()
        ->get();
      
        return dataTables::of($usuarios)
            ->addColumn('name', function ($usuarios){
                return
                    '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>";            
            }) 
            ->addColumn('email', function ($usuarios){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$usuarios->email;              
            })             
            ->addColumn('status_id', function ($usuarios){

                if($usuarios->statu['state_description'] == 'Inactivo'){    

                    return '<span class="label label-danger sm">'.$usuarios->statu['state_description'].'</span>';
                }
                if ($usuarios->statu['state_description'] == 'Pendiente'){

                    return '<span class="label label-warning sm">'.$usuarios->statu['state_description'].'</span>';

                }else{

                    return '<span class="label label-success sm">'.$usuarios->statu['state_description'].'</span>';
                }              
            })    
            ->addColumn('created_at', function ($usuarios){
                return $usuarios->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($usuarios) {
                return view('admin.users.partials._action', [
                    'usuarios' => $usuarios,
                    'url_show' => route('admin.users.show', $usuarios->id),                        
                    'url_edit' => route('admin.users.edit', $usuarios->id),                              
                    'url_destroy' => route('admin.users.destroy', $usuarios->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['name', 'email', 'status_id', 'created_at', 'accion']) 
            ->make(true);  
    }

    public function dataTableDoc()
    {                    
        $documentos = Document::with('document_type','creators')          
        // ->allowed()
        ->get();
        // dd($documentos);       
        return dataTables::of($documentos)
            ->addColumn('document_types_id', function ($documentos){
                return                    
                    '<i class="fa fa-envelope"></i>'.' '.$documentos->document_type['document_description'];              
            })   
            ->addColumn('title', function ($documentos){
                return
                    '<i class="fa fa-user"></i>'.' '.$documentos->title."<br>";            
            }) 
            // ->addColumn('registry_number', function ($documentos){
            //     return
            //         '<i class="fa fa-user"></i>'.' '.$documentos->registry_number."<br>";            
            // }) 
            ->addColumn('creators_id', function ($documentos){
                return 
                    '<i class="fa fa-user"></i>'.' '.$documentos->creators->creator_name."<br>";     
                             
            }) 
            
            ->addColumn('created_at', function ($documentos){
                return $documentos->created_at->format('d-m-y');
            })                 
            
            ->addColumn('accion', function ($documentos) {
                return view('admin.documents.partials._action', [
                    'documentos' => $documentos,
                    'url_show' => route('admin.documents.show', $documentos->id),                        
                    'url_edit' => route('admin.documents.edit', $documentos->id),                              
                    'url_destroy' => route('admin.documents.destroy', $documentos->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['document_types_id', 'title', 'creators_id', 'created_at', 'accion']) 
            ->make(true);  
    }
}
