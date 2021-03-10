<div class="row">
{!! Form::model($course, [
    'route' =>  $course->exists ? ['admin.courses.update',  $course->id] : 'admin.courses.store',   
    'method' => $course->exists ? 'PUT' : 'POST'
]) !!}

<div class="col-md-12">
    <div class="box box-primary" style="border-color: {{ $setting->skin }};">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $ml_course->mod_subtitulo_curso }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('course_name', $ml_course->cam_nombre_curso ) !!}
                {!! Form::text('course_name', null, ['class' => 'form-control', 'id' => 'course_name', 'placeholder' => $ml_course->cam_nombre_curso ]) !!}                                      
            </div>
            <div class="form-group">
                {!! Form::label('group',  $ml_course->cam_grupo ) !!}&nbsp;
                <label>
                    &nbsp;{!! Form::radio('group', 'Si') !!}{{ $ml_course->cam_grupo_si }}                                
                </label>
                <label>
                    &nbsp;{!! Form::radio('group', 'No') !!}{{ $ml_course->cam_grupo_no }}                               
                </label>
            </div>
        </div>
    </div>
{!! Form::close() !!}    
</div>







  