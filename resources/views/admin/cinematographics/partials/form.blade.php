<div class="row">
{!! Form::model($film, [
    'route' =>  $film->exists ? ['admin.cinematographics.update',  $film->id] : 'admin.cinematographics.store',   
    'method' => $film->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Géneros</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('genre_film', 'Género Cinematográfico') !!}
                {!! Form::text('genre_film', null, ['class' => 'form-control', 'id' => 'genre_film', 'placeholder' => 'Género Cinematográfico']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  