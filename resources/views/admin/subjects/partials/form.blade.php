<div class="row">
{!! Form::model($subject, [
    'route' =>  $subject->exists ? ['admin.subjects.update',  $subject->id] : 'admin.subjects.store',   
    'method' => $subject->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Materias</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('subject_name', 'Materia') !!}
                {!! Form::text('subject_name', null, ['class' => 'form-control', 'id' => 'subject_name', 'placeholder' => 'Materia']) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('cdu', 'Cdu') !!}
                {!! Form::text('cdu', null, ['class' => 'form-control', 'id' => 'cdu', 'placeholder' => 'Cdu']) !!}                                      
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  