<div class="row">      
    {!!  Form::open(['route' => 'fastprocess.grabar'])  !!}
    
    @if ($bandera == 1)
        @php 
            $mensaje = "Devuelto en ";
            $mensaje2 = "Fecha de Devolución ";
            $var_acquired = Form::hidden('acquired', Carbon\Carbon::now()->format('d-m-Y') );
            $visible = 'disabled';
            $fecha_hasta = Carbon\Carbon::now()->format('d-m-Y');
        @endphp
    @else
        @php  
            $mensaje = "Renovado hasta ";
            $mensaje2 = "Fecha de Renovación ";
            $var_acquired = '';
            $visible = '';
            $fecha_hasta = Carbon\Carbon::parse($fecha)->addDays($dias_de_prestamo)->format('d-m-Y');
        @endphp
    @endif
  
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $mensaje2 }}</h3>
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
                            <input name="acquired" {{ $visible }}
                                class="form-control pull-right"                                                       
                                value="{{ old('acquired', $fecha_hasta) }}"                            
                                type="text"
                                id="acquired"
                                placeholder= "Selecciona una Fecha">                       
                       </div>
                       {!! $var_acquired !!}                  
                   </div>                
               </div>
        </div>       
    </div>
    {!! Form::close() !!}   
</div>
  
  
  
  





  