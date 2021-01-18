<div class="row">
{!! Form::model($language, [
    'route' =>  $language->exists ? ['admin.languages.update',  $language->id] : 'admin.languages.store',   
    'method' => $language->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_lang->mod_subtitulo_lang }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('leguage_description', $ml_lang->cam_lang ) !!}
                {!! Form::text('leguage_description', null, ['class' => 'form-control', 'id' => 'leguage_description', 'placeholder' => $ml_lang->cam_lang ]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  