<div class="row">
{!! Form::model($literature, [
    'route' =>  $literature->exists ? ['admin.literatures.update',  $literature->id] : 'admin.literatures.store',   
    'method' => $literature->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_gl->mod_subtitulo_gl }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_book', $ml_gl->mod_subtitulo_gl ) !!}
                {!! Form::text('genre_book', null, ['class' => 'form-control', 'id' => 'genre_book', 'placeholder' => $ml_gl->mod_subtitulo_gl ]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  