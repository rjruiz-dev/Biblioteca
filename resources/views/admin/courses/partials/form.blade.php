<div class="row">
{!! Form::model($course, [
    'route' =>  $course->exists ? ['admin.courses.update',  $course->id] : 'admin.courses.store',   
    'method' => $course->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cursos</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('course_name', 'Nombre del Curso') !!}
                {!! Form::text('course_name', null, ['class' => 'form-control', 'id' => 'course_name', 'placeholder' => 'Nombre del Curso']) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('group', 'Tiene Grupos') !!}&nbsp;
                <label>
                    &nbsp;{!! Form::radio('group', 'Si') !!}Si                                
                </label>
                <label>
                    &nbsp;{!! Form::radio('group', 'No') !!}No                                   
                </label>
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  