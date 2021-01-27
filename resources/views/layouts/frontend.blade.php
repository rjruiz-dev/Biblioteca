@extends('layouts.app')

@section('content')
<section class="all-pages-content">
    <!-- <div class="container"> -->
        <div class="row" id="recargar">
                <!-- <div class="col-xs-12"> -->
                    <h1 class="text-center wow pulse all-titles-pages">Documentos más recientes</h1>
                    <br>
                    <br>
                    <select id="filtro" class="form-control select2" onchange="yesnoCheck()">
                                    <option value="5">Ultimos 5</option> 
                                    <option value="10">Ultimos 10</option>
                                    <option value="20">Ultimos 20</option>
                                    <option value="50">Ultimos 50</option>
                                </select>
                   <br>
                    <br>
                <!-- </div> -->
            @php
            $contador = 0;
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
                    if($contador == 0){
                        $prueba = ' col-sm-offset-1';
                    }
                    @endphp
            <div class="col-md-15">   
                <div class="box box-primary">        
                    <div class="box-body box-profile" style="word-wrap: break-word;">            
            
                        <img class="img-responsive img-rounded" 
                        src="{{ $url }}" alt="{{ $doc['title'] }}" style="border: 3px solid #d2d6de;height: 280px;
    width: 100%;"> 
                    
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
                    $sinopsis = str_replace('<p>','', $sinopsis);
                    $sinopsis = str_replace('</p>','', $sinopsis);
                    @endphp
                    @else
                    @php
                    $sinopsis = trim($doc['synopsis']);
                    $sinopsis = str_replace('<p>','', $sinopsis);
                    $sinopsis = str_replace('</p>','', $sinopsis);
                    @endphp
                    @endif
                      
                        <h3 class="text-center" style="height: 45px;">{{ $titulo }}</h3>
                     <p style="height: 45px;">{!! $sinopsis !!}</p>
                     @if($doc['document_types_id'] == 1)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">Más información</a></p>
                    @endif
                    @if($doc['document_types_id'] == 2)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">Más información</a></p>
                    @endif
                    @if($doc['document_types_id'] == 3)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">Más información</a></p>
                    @endif
                    @if($doc['document_types_id'] == 4)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">Más información</a></p>
                    @endif
                    @if($doc['document_types_id'] == 5)
                    <p class="text-center"><a href="{{ route('libros.indexsolo', ['id' => $doc['id']]) }}" class="btn btn-danger">Más información</a></p>
                    @endif
                        
                        
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div> 
            </div>
            @php   
            $contador = $contador + 1; 
            @endphp 
            @endforeach	
        </div>
        <hr>      
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center wow pulse all-titles-pages">Los 5 más reservados</h1>
                <br><br><br>
            </div>
            @foreach($CincoMasResevados  as $d)
            <div class="col-xs-12">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object img-rounded" src="{{ asset('images/'.$d->photo) }}" alt="{{ $d->title }}"  width="300" height="380">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading all-titles-pages">{{ $d->title }}</h4>
                        @if ( ( trim($d->synopsis != NULL) ) && ( trim($d->synopsis != '') ) )
                        <p>{!! $d->synopsis !!}</p>
                        @endif 
                    </div>
                </div>
            </div>          
            @endforeach	
        </div>     
    <!-- </div> -->
</section>
@stop

<script>
$('#filtro').on('change', function() {
            var cantidad = $(this).val();
            $.ajax({                    
                url: '/web/filtrarhome/' + cantidad,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                $("#recargar").load(" #recargar");
                },
                error: function () { 
                    // console.log(error);
                    alert('Hubo un error obteniendo el detalle de la Compañía!');
                }
            })
        });
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