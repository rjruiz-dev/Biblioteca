<div class="row">
{!! Form::model($musical, [
    'route' =>  $musical->exists ? ['admin.musicals.update',  $musical->id] : 'admin.musicals.store',   
    'method' => $musical->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_gm->mod_subtitulo_gm }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_music', $ml_gm->mod_subtitulo_gm ) !!}
                {!! Form::text('genre_music', null, ['class' => 'form-control', 'id' => 'genre_music', 'placeholder' =>  $ml_gm->mod_subtitulo_gm ]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  