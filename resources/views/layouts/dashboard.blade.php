@extends('layouts.app')

@section('header')        
    <h1>
        Panel de Control 
        <small>Version 1.0 </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>        
    </ol> 
@stop

@section('content')
<div class="row">     
    <div class="col-md-3">         
        <div class="small-box bg-aqua">
            <div class="inner">
                @foreach($documentos as $documento)
                    <span class="info-box-text">                          
                        DOCUMENTOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $documento->documents }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Documentos registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>            
        </div>
    </div>
    <div class="col-md-3">         
        <div class="small-box bg-blue">
            <div class="inner">
                @foreach($prestamos as $prestamo)
                    <span class="info-box-text">                          
                        PRESTAMOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $prestamo->book_movements }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Prestamos registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-retweet"></i>
            </div>            
        </div>
    </div>
    <div class="col-md-3">         
        <div class="small-box bg-red">
            <div class="inner">
                @foreach($prestamos_vencidos as $vencido)
                    <span class="info-box-text">                          
                        PRESTAMOS VENCIDOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $vencido->book_movements }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vencidos registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-warning "></i>
            </div>            
        </div>
    </div>

    <div class="col-md-3">         
        <div class="small-box bg-green">
            <div class="inner">
                @foreach($socios as $socio)
                    <span class="info-box-text">                          
                        USUARIOS
                    </span>     
                    <h4>
                        <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                        {{ $socio->users }}
                        </font>
                        </font>
                    </h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Usuarios registrados</font></font></p>
                @endforeach	
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
           
        </div>
    </div>
</div> 
@stop