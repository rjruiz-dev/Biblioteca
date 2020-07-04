<div class="row">
{!! Form::model($language, [
    'route' =>  $language->exists ? ['admin.languages.update',  $language->id] : 'admin.languages.store',   
    'method' => $language->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Idiomas</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('leguage_description', 'Idioma') !!}
                {!! Form::text('leguage_description', null, ['class' => 'form-control', 'id' => 'leguage_description', 'placeholder' => 'Idioma']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  