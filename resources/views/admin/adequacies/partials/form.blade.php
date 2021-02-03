<div class="row">
{!! Form::model($adequacy, [
    'route' =>  $adequacy->exists ? ['admin.adequacies.update',  $adequacy->id] : 'admin.adequacies.store',   
    'method' => $adequacy->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_adequacy->mod_subtitulo_adequacy }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('adequacy_description', $ml_adequacy->cam_adequacy ) !!}
                {!! Form::text('adequacy_description', null, ['class' => 'form-control', 'id' => 'adequacy_description', 'placeholder' => $ml_adequacy->cam_adequacy]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  