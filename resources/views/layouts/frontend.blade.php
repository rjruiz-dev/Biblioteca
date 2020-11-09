@extends('layouts.app')

@section('content')
<section class="all-pages-content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center wow pulse all-titles-pages">Documentos más recientes</h1>
                <br><br><br>
            </div>
            @foreach($documentos as $doc)
            <div class="col-xs-12 col-sm-4">           
                <div>
                    <img  src="{{ asset('images/'.$doc['photo']) }}" alt="{{ $doc['title'] }}"  class="img-responsive img-circle center-box-content">
                    <h3 class="text-center all-titles-pages">{{ $doc['title'] }}</h3>
                    @if ( ( trim($doc['synopsis'] != NULL) ) && ( trim($doc['synopsis'] != '') ) )
                    <p>{!! $doc['synopsis'] !!}</p>
                    @endif 
                 
                    <p class="text-center"><a href="{{ route('libros.index2', ['id' => $doc['id']]) }}" class="btn btn-danger">Más información</a></p>
                </div>
                <hr class="visible-xs">
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
    </div>
</section>
@stop