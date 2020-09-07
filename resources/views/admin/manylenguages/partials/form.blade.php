<div class="row">
{!! Form::open([
    'route' => $idioma->exists ? ['admin.manylenguages.update', $idioma->id] : 'admin.manylenguages.store',   
    'method' => $idioma->exists ? 'PUT' : 'POST'
]) !!}

{{ csrf_field() }}

    @if (!$idioma->exists)
        @php 
        $visible_status_doc = "display:none";
            $visible_desidherata = "";
        @endphp
    @else
        @php  
        $visible_status_doc = "";
            $visible_desidherata = "display:none";
        @endphp
    @endif       

    
    <div class="col-md-6">
    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Idioma</h3>
            </div>
            
            <div class="box-body">
                <div class="form-group" >                               
                    {!! Form::text('idioma', $idioma['lenguage_description'] ? $idioma['lenguage_description'] : null, ['class' => 'form-control', 'id' => 'idioma', 'placeholder' => 'Nombre del Idioma' ]) !!}
                </div>
            </div>
        </div> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Menu Lateral </h3>
            </div>
            <div class="box-body">
            <div class="form-group">              
                    {!! Form::label('inicio', 'Inicio') !!}                    
                    {!! Form::text('inicio', $ml_dashboard['inicio'] ? $ml_dashboard['inicio'] : null, ['class' => 'form-control', 'id' => 'inicio', 'placeholder' => 'Inicio']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('libros', 'Libros') !!}                    
                    {!! Form::text('libros', $ml_dashboard['libros'] ? $ml_dashboard['libros'] : null, ['class' => 'form-control', 'id' => 'libros', 'placeholder' => 'Libros']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('cines', 'Cines') !!}                    
                    {!! Form::text('cines', $ml_dashboard['cines'] ? $ml_dashboard['cines'] : null, ['class' => 'form-control', 'id' => 'cines', 'placeholder' => 'Cines']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('musica', 'Musica') !!}                    
                    {!! Form::text('musica', $ml_dashboard['musica'] ? $ml_dashboard['musica'] : null, ['class' => 'form-control', 'id' => 'musica', 'placeholder' => 'Musica']) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('fotografia', 'Fotografia') !!}                    
                    {!! Form::text('fotografia', $ml_dashboard['fotografia'] ? $ml_dashboard['fotografia'] : null, ['class' => 'form-control', 'id' => 'fotografia', 'placeholder' => 'Fotografia']) !!}
                </div> 
                <div class="form-group">              
                    {!! Form::label('multimedia', 'Multimedia') !!}                    
                    {!! Form::text('multimedia', $ml_dashboard['multimedia'] ? $ml_dashboard['multimedia'] : null, ['class' => 'form-control', 'id' => 'multimedia', 'placeholder' => 'Multimedia']) !!}
                </div>

            </div>
        </div>       
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Menu Superior y Pie</h3>                
            </div>
            <div class="box-body">   
            <div class="form-group" >              
                    {!! Form::label('biblioteca', 'Biblioteca') !!}                    
                    {!! Form::text('biblioteca', $ml_dashboard['biblioteca'] ? $ml_dashboard['biblioteca'] : null, ['class' => 'form-control', 'id' => 'biblioteca', 'placeholder' => 'Biblioteca' ]) !!}
                </div>
                <div class="form-group" >              
                    {!! Form::label('iniciar_sesion', 'Iniciar Sesion') !!}                    
                    {!! Form::text('iniciar_sesion', $ml_dashboard['iniciar_sesion'] ? $ml_dashboard['iniciar_sesion'] : null, ['class' => 'form-control', 'id' => 'iniciar_sesion', 'placeholder' => 'Iniciar Sesion' ]) !!}
                </div>
                <div class="form-group">              
                    {!! Form::label('registrarse', 'Registrarse') !!}                  
                    {!! Form::text('registrarse', $ml_dashboard['registrarse'] ? $ml_dashboard['registrarse'] : null, ['class' => 'form-control', 'id' => 'registrarse', 'placeholder' => 'Registrarse']) !!}
                </div>
                <!-- pub periodica -->
                <div class="form-group">               
                    {!! Form::label('navegacion', 'Navegacion') !!}                  
                    {!! Form::text('navegacion', $ml_dashboard['navegacion'] ? $ml_dashboard['navegacion'] : null, ['class' => 'form-control', 'id' => 'navegacion', 'placeholder' => 'Navegacion']) !!}
                </div>                                           
                <div class="form-group">
                    {!! Form::label('invitado', 'Invitado') !!} 
                    {!! Form::text('invitado', $ml_dashboard['invitado'] ? $ml_dashboard['invitado'] : null, ['class' => 'form-control', 'id' => 'invitado', 'placeholder' => 'Invitado']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('en_linea', 'En Linea') !!}                    
                    {!! Form::text('en_linea', $ml_dashboard['en_linea'] ? $ml_dashboard['en_linea'] : null, ['class' => 'form-control', 'id' => 'en_linea', 'placeholder' => 'En Linea']) !!}
                </div>
            

            </div>
        </div>       
    </div>    
{!! Form::close() !!}    
</div>





  