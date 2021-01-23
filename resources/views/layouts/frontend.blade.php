@extends('layouts.app')

@section('content')
<section class="all-pages-content">
    <!-- <div class="container"> -->
        <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center wow pulse all-titles-pages">Documentos más recientes</h1>
                    <br><br><br>
                </div>
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
            <div class="col-md-3">   
                <div class="box box-primary">        
                    <div class="box-body box-profile">            
                        <img class="img-responsive img-rounded center-box-content" 
                        src="{{ $url }}" alt="{{ $doc['title'] }}" style="border: 3px solid #d2d6de;"> 
                            
                        <h3 class="text-center all-titles-pages">{{ $doc['title'] }}</h3>
                    @if ( ( trim($doc['synopsis'] != NULL) ) && ( trim($doc['synopsis'] != '') ) )
                    <p>{!! $doc['synopsis'] !!}</p>
                    @endif 
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