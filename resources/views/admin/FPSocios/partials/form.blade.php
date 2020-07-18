
<div class="row">
      
    {!!  Form::open(['route' => 'FPSocios.grabar'])  !!}
    
    @if ($bandera == 1)
        @php 
            $mensaje = "Devuelto en "
        @endphp
    @else
        @php  
        $mensaje = "Renovado hasta "
        @endphp
    @endif

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <h3 class="box-title">Area de Titulo</h3> -->
            </div>
            <div class="box-body">
            {!! Form::hidden('bandera', $bandera) !!}
            {!! Form::hidden('id', $id) !!}
            
            <div class="form-group">
                    <label>{{ $mensaje }} la fecha: </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="acquired"
                            class="form-control pull-right"                                                       
                            value="{{ old('acquired', Carbon\Carbon::now()->format('m/d/Y')) }}"                            
                            type="text"
                            id="acquired"
                            placeholder= "Selecciona una Fecha">                       
                    </div>                  
                </div>
                
            </div>
        </div>       
    </div>
    {!! Form::close() !!}   
</div>







  