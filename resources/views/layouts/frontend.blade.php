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
        </div><!--End first row -->
        <hr>
        <!-- <hr style="margin:90px 0px;"> -->
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center wow pulse all-titles-pages">Los 5 más reservados</h1>
                <br><br><br>
            </div>
            <div class="col-xs-12">
                <div class="media">
                    <a class="pull-left" href="#">
                    <img class="media-object img-rounded" src="{{ asset('images/'.$doc['photo']) }}" alt="{{ $doc['title'] }}">
                    </a>
                    <div class="media-body">
                    <h4 class="media-heading all-titles-pages">{{ $doc['title'] }}</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero dolorum, neque modi deleniti officiis asperiores et nulla aperiam! Nobis tempore molestiae aliquam eligendi expedita natus non mollitia ipsa dolor repudiandae.
                    </p>
                    </div>
                </div>
               
            </div>
        </div><!--End second row -->
        <!-- <hr style="margin:90px 0px;"> -->
     
    </div><!--End container -->
</section>
@stop