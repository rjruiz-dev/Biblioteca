<div class="row">
{!! Form::model($reference, [
    'route' =>  $reference->exists ? ['admin.references.update',  $reference->id] : 'admin.references.store',   
    'method' => $reference->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Maestro de Referencia</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('reference_description', 'Referencia') !!}
                {!! Form::text('reference_description', null, ['class' => 'form-control', 'id' => 'reference_description', 'placeholder' => 'Referencia']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  