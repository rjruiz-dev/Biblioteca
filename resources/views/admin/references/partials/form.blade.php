<div class="row">
{!! Form::model($reference, [
    'route' =>  $reference->exists ? ['admin.references.update',  $reference->id] : 'admin.references.store',   
    'method' => $reference->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_reference->mod_subtitulo_ref }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('reference_description', $ml_reference->cam_referencia ) !!}
                {!! Form::text('reference_description', null, ['class' => 'form-control', 'id' => 'reference_description', 'placeholder' =>  $ml_reference->cam_referencia ]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  