<div class="row">
{!! Form::model($subject, [
    'route' =>  $subject->exists ? ['admin.subjects.update',  $subject->id] : 'admin.subjects.store',   
    'method' => $subject->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_subject->mod_subtitulo_subject }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('subject_name', $ml_subject->cam_subject) !!}
                {!! Form::text('subject_name', null, ['class' => 'form-control', 'id' => 'subject_name', 'placeholder' => $ml_subject->cam_subject]) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('cdu', $ml_subject->cam_cdu_subject) !!}
                {!! Form::text('cdu', null, ['class' => 'form-control', 'id' => 'cdu', 'placeholder' => $ml_subject->cam_cdu_subject]) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  