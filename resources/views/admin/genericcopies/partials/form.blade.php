<div class="row">
{!! Form::model($copie, [
    'route' => $copie->exists ? ['admin.genericcopies.update', $copie->id] : 'admin.genericcopies.store',   
    'method' => $copie->exists ? 'PUT' : 'POST'
]) !!}

    @if (!$copie->exists)
        @php 
            $visible = "display:none"
        @endphp
    @else
        @php  
            $visible = ""
        @endphp
    @endif       

    <div class="col-md-12">
        <div class="box box-primary">
            <!-- <div class="box-header with-border">
                <h3 class="box-title">Area de Titulo</h3>
            </div> -->
            <div class="box-body">
                {{ csrf_field() }}
                {{ Form::hidden('id_docu', $id_doc) }} 
                <label for="sugerido">Numero Sugerido: {{ $sugerido }}</label>                             
                <div class="form-group" >              
                    {!! Form::label('registry_number', 'Numero de Registro') !!}                    
                    {!! Form::text('registry_number', null, ['class' => 'form-control', 'id' => 'registry_number', 'placeholder' => 'Numero de Registro' ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status_copy_id', 'Estado') !!}             
                    {!! Form::select('status_copy_id', $status, null, ['class' => 'form-control  select2', 'id' => 'status_copy_id', 'placeholder' => '', 'style' => 'width:100%;']) !!}
                </div>                         
            </div>
        </div>       
    </div>  
{!! Form::close() !!}    
</div>





  