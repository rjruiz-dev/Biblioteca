<div class="row">
{!! Form::model($format, [
    'route' =>  $format->exists ? ['admin.formats.update',  $format->id] : 'admin.formats.store',   
    'method' => $format->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_fg->mod_subtitulo_fg }}Formatos</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_format', {{ $ml_fg->cam_fg }}) !!}
                {!! Form::text('genre_format', null, ['class' => 'form-control', 'id' => 'genre_format', 'placeholder' => {{ $ml_fg->cam_fg }}]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  