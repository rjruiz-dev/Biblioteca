<div class="row">
{!! Form::model($periodical, [
    'route' =>  $periodical->exists ? ['admin.periodicals.update',  $periodical->id] : 'admin.periodicals.store',   
    'method' => $periodical->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Periodicidades</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('periodicity_name', 'Periodicidad') !!}
                {!! Form::text('periodicity_name', null, ['class' => 'form-control', 'id' => 'periodicity_name', 'placeholder' => 'Periodicidad']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  