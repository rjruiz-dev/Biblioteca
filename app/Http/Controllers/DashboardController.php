<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function partner()
    {   
        $anio = [date('Y')];
      
                
                $usuarios = User::selectRaw('year(created_at) year')
                ->selectRaw('count(*) users')  
                ->groupBy('year')    
                ->whereYear('created_at',$anio)              
                ->get();
       

        return  view('layouts.dashboard', compact('usuarios, anio'));
    }   
}
