<div class="row">
{!! Form::model($format, [
    'route' =>  $format->exists ? ['admin.formats.update',  $format->id] : 'admin.formats.store',   
    'method' => $format->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Formatos</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_format', 'Formato Gráfico') !!}
                {!! Form::text('genre_format', null, ['class' => 'form-control', 'id' => 'genre_format', 'placeholder' => 'Formato Gráfico']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  