@extends('layouts.app')

@section('content')
<section class="all-pages-content">
    <!-- <div class="container"> -->
        <div class="row">
        <div  id="recargar">
                <!-- <div class="col-xs-12"> -->
                    <h1 class="text-center wow pulse all-titles-pages">{{$ml_front_end->doc_mas_recientes}}</h1>
                 
                    <!-- <select name="filtro" id="filtro" class="form-control select2 text-center" onchange="filtrar()" style="width:200px; margin-left:10px;">
                                    <option value="2">Ultimos 2</option> 
                                    <option value="3">Ultimos 3</option>
                                    <option value="4">Ultimos 4</option>
                                    <option value="5">Ultimos 5</option>
                                </select> -->
                    {!! Form::select('filtro', ['5' => $ml_front_end->recientes_cinco, '10' => $ml_front_end->recientes_diez, '20' => $ml_front_end->recientes_veinte, '50' => $ml_front_end->recientes_cincuenta], $recientes, ['class' => 'form-control select2', 'id' => 'filtro','onchange' => 'filtrar()', 'style' => 'width:200px; margin-left:10px;']) !!}

                   <br>
                    <br>
                <!-- </div> -->
            @php
            $contadorRecientes = 0;
            @endphp
            @foreach($documentos as $doc)
            @php 
                    if($doc['photo'] == null){
                        $url=asset("images/doc-default.png");
                    }else{
                        if(file_exists("images/". $doc['photo'])){
                            $url=asset("images/". $doc['photo']);
                        }else{
                            $url=asset("images/doc-default.png");  
                        }    
                    }
            @endphp
            <div class="col-md-15">    
                <div class="box box-primary" style="border-top-color: {{ $setting->skin }};">        
                    <div class="box-body box-profile" style="word-wrap: break-word;">             
            
                        <img class="img-responsive img-rounded" 
                        src="{{ $url }}" alt="{{ $doc['title'] }}" style="border: 3px solid #d2d6de; width: 100%;">  
                    
                    @if ( strlen(trim($doc['title'])) > 25)
                    @php
                    $titulo = substr(trim($doc['title']), 0, 25)."..";
                    @endphp
                    @else
                    @php
                    $titulo = trim($doc['title']);
                    @endphp
                    @endif

                    @if ( strlen(trim($doc['synopsis'])) > 35)
                    @php
                    $sinopsis = substr(trim($doc['synopsis']), 0, 35)."..";
                    $sinopsis = strip_tags($sinopsis);
                    @endphp
                    @else
                    @php
                    $sinopsis = trim($doc['synopsis']);
                    $sinopsis = strip_tags($sinopsis);
                    @endphp
                    @endif
                      
                        <h3 class="text-center" style="height: 45px;">{{ $titulo }}</h3>
                     <p style="height: 45px;">{!! $sinopsis !!}</p>
                     @if($doc['document_types_id'] == 1)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 2)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 3)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 4)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($doc['document_types_id'] == 5)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                        
                        
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div> 
            </div>
            @php
            $contadorRecientes = $contadorRecientes + 1;
            @endphp
            @if($contadorRecientes == 5)
            <div class="col-md-15" style="width: 100%"> 
            </div>
            @php
            $contadorRecientes = 0;
            @endphp
            @endif 
            @endforeach	
        </div>
        </div>
        <hr>      
        <div class="row">
        <div  id="recargar_reservados">
            <!-- <div class="col-xs-12"> -->
                <h1 class="text-center wow pulse all-titles-pages">{{$ml_front_end->doc_mas_reservados}}</h1>
                {!! Form::select('filtro_reservados', ['5' => $ml_front_end->reservados_cinco, '10' => $ml_front_end->reservados_diez, '20' => $ml_front_end->reservados_veinte, '50' => $ml_front_end->reservados_cincuenta], $reservados, ['class' => 'form-control select2', 'id' => 'filtro_reservados','onchange' => 'filtrar_reservados()', 'style' => 'width:200px; margin-left:10px;']) !!}

                   <br>
                    <br>
            <!-- </div> -->
            @php
            $contadorReservados = 0;
            @endphp
            @foreach($CincoMasResevados  as $masreservados)
            @php
                    if($masreservados->photo == null){
                        $url_d=asset("images/doc-default.png");
                    }else{
                        if(file_exists("images/". $masreservados->photo)){
                            $url_d=asset("images/". $masreservados->photo);
                        }else{
                            $url_d=asset("images/doc-default.png");  
                        }    
                    }
            @endphp
            <div class="col-md-15">   
                <div class="box box-primary">        
                <!-- style="word-wrap: break-word;" profile-->
                    <div class="box-body box-profile" style="word-wrap: break-word;">            
            
                        <img class="img-responsive img-rounded" 
                        src="{{ $url_d }}" alt="{{ $masreservados->title }}" style="border: 3px solid #d2d6de; width: 100%;"> 
                    
                    @if ( strlen(trim($masreservados->title)) > 25)
                    @php
                    $titulo_d = substr(trim($masreservados->title), 0, 25)."..";
                    @endphp
                    @else
                    @php
                    $titulo_d = trim($masreservados->title);
                    @endphp
                    @endif

                    @if ( strlen(trim($masreservados->synopsis)) > 35)
                    @php
                    $sinopsis_d = substr(trim($masreservados->synopsis), 0, 35)."..";
                    $sinopsis_d = strip_tags($sinopsis_d);
                    @endphp
                    @else
                    @php
                    $sinopsis_d = trim($masreservados->synopsis);
                    $sinopsis_d = strip_tags($sinopsis_d);
                    @endphp
                    @endif
                      
                        <h3 class="text-center" style="height: 45px;">{{ $titulo_d }}</h3>
                     <p style="height: 45px;">{!! $sinopsis_d !!}</p>
                     @if($masreservados->document_types_id == 1)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 2)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 3)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 4)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                    @if($masreservados->document_types_id == 5)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $masreservados->id] ) }}" class="btn btn-danger">{{$ml_front_end->mas_info}}</a></p>
                    @endif
                        
                        
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div> 
            </div> 
            @php
            $contadorReservados = $contadorReservados + 1;
            @endphp
            @if($contadorReservados == 5)
            <div class="col-md-15" style="width: 100%"> 
            </div>
            @php
            $contadorReservados = 0;
            @endphp
            @endif          
            @endforeach	
        </div>
        </div>     
    <!-- </div> -->
</section>
@stop
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>


// $(document).ready(function(){//ACCION CUANDO CARGUE LA PAGINA

// var altura_arr2 = [];//CREAMOS UN ARREGLO VACIO
// $('.well2').each(function(){//RECORREMOS TODOS LOS CONTENEDORES DE LAS IMAGENES, DEBEN TENER LA MISMA CLASE
//   var altura = $(this).height(); //LES SACAMOS LA ALTURA
//   altura_arr2.push(altura);//METEMOS LA ALTURA AL ARREGLO
// });
// altura_arr2.sort(function(a, b){return b-a}); //ACOMODAMOS EL ARREGLO EN ORDEN DESCENDENTE
// $('.well2').each(function(){//RECORREMOS DE NUEVO LOS CONTENEDORES
//   $(this).css('height',altura_arr2[0]);//LES PONEMOS A TODOS LOS CONTENEDORES EL PRIMERO ELEMENTO DE ALTURA DEL ARREGLO, QUE ES EL MAS GRANDE.
// });

// });


        function filtrar() {
            valor_filtro = document.getElementById("filtro").value;
            console.log("ssssss: " + valor_filtro);
            $.ajax({                    
                url: '/web/filtrarhome/' + valor_filtro,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log("llego a succes: " + response.recientes);
                $("#recargar").load(" #recargar"); 
                // document.location.reload();    
                },
                error: function () { 
                    // console.log(error);
                    alert('Hubo un error obteniendo el detalle de la Compañía!');
                }
            })  
        }

        function filtrar_reservados() {
            valor_filtro_reservados = document.getElementById("filtro_reservados").value;
            console.log("ssssss: " + valor_filtro_reservados);
            $.ajax({                    
                url: '/web/filtrarhome_reservados/' + valor_filtro_reservados,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log("llego a succes: " + response.recientes);
                $("#recargar_reservados").load(" #recargar_reservados");
                },
                error: function () { 
                    // console.log(error);
                    alert('Hubo un error obteniendo el detalle de la Compañía!');
                }
            })
        }

            
</script>

<style type="text/css">
    .col-xs-15,
    .col-sm-15,
    .col-md-15,
    .col-lg-15 {
        position: relative;
        min-height: 1px;
        padding-right: 10px;
        padding-left: 10px;
    }
    .col-xs-15 {
    width: 20%;
    float: left;
}
@media (min-width: 768px) {
.col-sm-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 992px) {
    .col-md-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 1200px) {
    .col-lg-15 {
        width: 20%;
        float: left;
    }
}
</style>