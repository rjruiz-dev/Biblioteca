<div class="row">
{!! Form::model($adequacy, [
    'route' =>  $adequacy->exists ? ['admin.adequacies.update',  $adequacy->id] : 'admin.adequacies.store',   
    'method' => $adequacy->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Personas Adecuadas</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('adequacy_description', 'Adecuación') !!}
                {!! Form::text('adequacy_description', null, ['class' => 'form-control', 'id' => 'adequacy_description', 'placeholder' => 'Adecuación']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  