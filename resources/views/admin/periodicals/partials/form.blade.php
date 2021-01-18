<div class="row">
{!! Form::model($periodical, [
    'route' =>  $periodical->exists ? ['admin.periodicals.update',  $periodical->id] : 'admin.periodicals.store',   
    'method' => $periodical->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_pp->mod_subtitulo_publ }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('periodicity_name', $ml_pp->cam_publ ) !!}
                {!! Form::text('periodicity_name', null, ['class' => 'form-control', 'id' => 'periodicity_name', 'placeholder' => $ml_pp->cam_publ ]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  