<div class="row">
{!! Form::model($film, [
    'route' =>  $film->exists ? ['admin.cinematographics.update',  $film->id] : 'admin.cinematographics.store',   
    'method' => $film->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_gc->mod_subtitulo_gc }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_film', $ml_gc->cam_gc) !!}
                {!! Form::text('genre_film', null, ['class' => 'form-control', 'id' => 'genre_film', 'placeholder' => $ml_gc->cam_gc]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  