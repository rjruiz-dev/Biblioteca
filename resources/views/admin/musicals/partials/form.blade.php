<div class="row">
{!! Form::model($musical, [
    'route' =>  $musical->exists ? ['admin.musicals.update',  $musical->id] : 'admin.musicals.store',   
    'method' => $musical->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Géneros</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_music', 'Género Musical') !!}
                {!! Form::text('genre_music', null, ['class' => 'form-control', 'id' => 'genre_music', 'placeholder' => 'Géneros Musical']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  