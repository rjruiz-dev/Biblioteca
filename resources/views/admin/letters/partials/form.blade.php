<div class="row">
{!! Form::model($letter, [
    'route' =>  $letter->exists ? ['admin.letters.update',  $letter->id] : 'admin.letters.store',   
    'method' => $letter->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_letter->mod_subtitulo_letter }}</h3>
        </div>
        <div class="box-body">
            {{ csrf_field() }}
            <div class="form-group">
                {!! Form::label('title', $ml_letter->cam_titulo_letter ) !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => $ml_letter->cam_titulo_letter]) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('body', $ml_letter->cam_cuerpo_letter) !!}
                {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body', 'placeholder' => $ml_letter->cam_cuerpo_letter]) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('excerpt', $ml_letter->cam_despedida_letter) !!}
                {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'id' => 'excerpt', 'placeholder' => $ml_letter->cam_despedida_letter]) !!}                                      
            </div>
           
        </div>
    </div>
{!! Form::close() !!}    
</div>







  