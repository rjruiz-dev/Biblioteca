<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       DOCUMENTOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Documentos</li>
    </ol> 
@stop

@section('content')

<div class="row" id="recargar">     
    <div class="col-md-6">    
        <div class="box box-primary"> 
            <div class="box-header with-border">
                <h3 class="box-title">Documento: <b>{{ $documento->id }}</h3>                
            </div>       
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $documento->title}}">

                <h3 class="profile-username text-center">{{ $documento->title }}</h3>
                
                <p class="text-muted text-center">{{ $documento->creator->creator_name }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Tipo de Documento: </b> <a class="pull-right">{{ $documento->document_type->document_description }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tipo de {{ $documento->document_type->document_description }} </b> <a class="pull-right">{{ $documento->document_subtype->subtype_name }}</a>
                    </li>                                        
                </ul>                        
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos del prestamo</h3>                
            </div>
            <div class="box-body">          
                <ul class="list-group list-group-unbordered">               
                    {!! Form::model($documento, ['route' => ['admin.loanmanual.update',  $documento->id],'method' => 'PUT']) !!}
                    <li class="list-group-item">
                        <b></b>
                        <div class="row"  style="margin: 5px;"> 
                            <div class="form-group">
                                {!! Form::label('copy_id', 'Número de Registro') !!}
                                {!! Form::select('copy_id', $copies, null, ['class' => 'form-control select2', 'placeholder' => '', 'id' => 'copy_id']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Usuario') !!}
                               
                                {!! Form::select('user_id', $users, null, ['class' => 'form-control select2', 'id' => 'user_id', 'placeholder' => 'Elija el Socio']) !!}
                            </div>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">                               
                                    <b>Nickname</b> <a class="pull-right" id="nickname"></a> 
                                </li>                                   
                                <li class="list-group-item">
                                    <b>Apellido</b> <a class="pull-right" id="surname"></a>  
                                </li>                                 
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right" id="email"></a>
                                </li>  
                                <li class="list-group-item">
                                    <b>Prestamo actuales</b> <a class="pull-right" id="loan"></a>
                                </li>                              
                            </ul>

                            <!-- <div class="form-group">                            
                               {!! Form::label('nickname', 'Nickname', ['id' => 'nickname']) !!} 
                            </div>                         
                            <div class="form-group"> 
                                {!! Form::label('surname', 'Surname', ['id' => 'surname']) !!}                                
                            </div>
                            <div class="form-group">   
                                {!! Form::label('email', 'Email', ['id' => 'email']) !!}                              
                            </div> -->
                           
                            <div class="form-group">
                                {!! Form::label('course_id', 'Curso') !!}
                                {!! Form::select('course_id', $courses, null, ['class' => 'form-control select2', 'id' => 'course_id', 'placeholder' => 'Elija el Curso']) !!}
                            </div>
                            <div class="form-group">
                                <label>Grupo</label>
                                <select name="select" style="width:100%;">
                                    <option value="A">A</option> 
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label>Turno</label>
                                <select name="select" style="width:100%;">
                                    <option value="Dia">Dia</option> 
                                    <option value="Noche">Noche</option>
                                    <option value="Tarde">Tarde</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fecha de Devolución: </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>                      
                                    <input name="acquired"
                                        class="form-control pull-right"                                                       
                                        value="{{ old('acquired', Carbon\Carbon::now()->format('d/m/Y')) }}"                            
                                        type="text"
                                        id="acquired"
                                        placeholder= "Selecciona una Fecha de Devolución">                       
                                </div>                  
                            </div>                
                        </div>                        
                    </li> 
                    <div class="modal-footer" id="modal-footer">                  
                        <button type="submit" class="btn btn-primary" id="modal-btn-save">Prestar</button>
                    </div>     
                    {!! Form::close() !!}                                                   
                </ul>  
            </div>  
        </div>       
    </div>   
</div>  
@stop




@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">       
@endpush
 

@push('scripts')   
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script> 
    <!-- <script src="{{ asset('js/prestar.js') }}"></script>   -->
    <script>

            $('#copy_id').select2({
                placeholder: 'Selecciona un Numero de Copia',
                tags: false                 

            });

            $('#user_id').select2({
                placeholder: 'Selecciona un Socio',
                tags: false                 

            });

            var user_idSelect = $('#user_id');
            var nickname = $('#nickname');           
            var surname = $('#surname');
            var email = $('#email');   
            // var phone = $('#phone');
            // var address = $('#address');
            // var postcode = $('#postcode');
            // var city = $('#city');         
            // var province = $('#province');    
            var loan = $('#loan');         
            var csrf_token = $('meta[name="csrf-token"]').attr('content');    
            console.log (user_idSelect);
            user_idSelect.on('change', function() {
                // console.log ('la compañía ha cambiado');
                var id = $(this).val();
                // console.log('id del Partner seleccionado: ' + id);
                obtenerDetalleDePartner(id)
               
            });
            
            function obtenerDetalleDePartner(id) {
                $.ajax({                    
                    url: '/admin/loanmanual/showPartner/' + id,
                    type: 'GET',
                    data: {            
                        '_token': csrf_token
                    },
                    dataType: 'json',
                    success: function (response) {
                        // acá podés loguear la respuesta del servidor
                        console.log(response);
                        // le pasás la data a la función que llena los otros inputs
                        llenarInputs(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle de la Compañía!');
                    }
                })
            }
           
            function llenarInputs(data) {    
                // console.log(data);
                $('#nickname').text(data.partner.nickname);  
                $('#surname').text(data.partner.surname);  
                $('#email').text(data.partner.email);  
                $('#loan').text(data.count.count_of_prestamos);   
                // document.getElementById('#nickname').innerHTML = data.nickname;  
                // document.getElementById('#surname').innerHTML = data.surname;         
                // document.getElementById('#email').innerHTML = data.email;  
                // nickname.val(data.nickname);             
                // surname.val(data.surname);
                // email.val(data.email);   
                // phone.val(data.phone);
                // address.val(data.address);
                // postcode.val(data.postcode);
                // city.val(data.city);         
                // province.val(data.province);        
                
                // nickname.val(data.user.nickname);
                // name.val(data.user.name);
                // surname.val(data.user.surname);
                // email.val(data.user.email);   
                // phone.val(data.user.phone);
                // address.val(data.user.address);
                // postcode.val(data.user.postcode);
                // city.val(data.user.city);         
                // province.val(data.user.province);        
            } 
       
   
</script>
@endpush