<div class="row">
{!! Form::model($letter, [
    'route' =>  $letter->exists ? ['admin.letters.update',  $letter->id] : 'admin.letters.store',   
    'method' => $letter->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Modelo de Carta</h3>
        </div>
        <div class="box-body">
            {{ csrf_field() }}
            <div class="form-group">
                {!! Form::label('title', 'Título de la Carta') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Titulo de la Carta']) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('body', 'Contenido de la Carta') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body', 'placeholder' => 'Ingresa el contenido completo de la carta']) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('excerpt', 'Despedida') !!}
                {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'id' => 'excerpt', 'placeholder' => 'Ingresa parrafo final de la carta']) !!}                                      
            </div>
           
        </div>
    </div>
{!! Form::close() !!}    
</div>







  