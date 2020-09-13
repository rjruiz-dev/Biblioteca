<!-- @extends('layouts.app') -->

@section('header')    
    <h1>
       ESTADISTICAS
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Socios</li>
    </ol> 
@stop

@section('content')
<div class="row" id="recargar">
    <div  class="col-md-12"> 
            <!-- <div class="box box-primary">  -->
                    <!-- <div class="box-header with-border">
                        <h3 class="box-title">Socio:</h3>                
                    </div> -->
                    <!-- <div class="panel-body">     -->
    <div class="row">                                                    
        <div  class="col-md-6" style="margin-bottom:5px;">
          <div class="form-group">
            <label>Mes y Año</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>                      
              <input name="yearandmonth"
                      class="form-control pull-right"                                                       
                      value="{{ old('yearandmonth', null) }}"                            
                      type="text"
                      type="text"
                      id="yearandmonth"
                      placeholder= "Selecciona un Año">                       
              </div>                  
            </div>   
        </div>
        <div  class="col-md-6" style="margin-top:25px;margin-bottom:5px;">
            <button type="button" name="filter" id="filter" class="btn btn-info">Buscar</button>
        </div>
    </div>

    <div  class="col-md-12">
    </div>
                    
                    <!-- </div> -->
                                    

            <!-- </div> -->
        
    </div>
    <div  class="col-md-12"> 
            <div class="box box-primary"> 
            
                    <div class="box-header with-border">
                    <div  class="col-md-4"> 
                        <h2>Socios</h2>                
                    </div>
                    <div  class="col-md-6"> 
                                        
                    </div>
                    <div  class="col-md-2"> 
                    <h3 id="total_socios"></h3>           
                    </div>
                    </div>
             
             
                    <div class="panel-body">    
                                            <div class="row">
                                            <table class="table">
  <thead>
    <tr>
      
      <th scope="col">Tipo de Socios</th>
      <th scope="col">Altas</th>
      <th scope="col">Bajas</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td>Adultos</td>
      <td id="soc_adul_alta"></td>
      <td id="soc_adul_baja"></td>
    </tr>
    <tr>
     
      <td>Infantiles</td>
      <td id="soc_menor_alta"></td>
      <td id="soc_menor_baja"></td>
    </tr>

  </tbody>
</table>
                                         </div>

                    </div>
                                    

            </div>
        
    </div>
    <div  class="col-md-12"> 
            <div class="box box-primary"> 
            
                    <div class="box-header with-border">
                    <div  class="col-md-4"> 
                        <h2>Prestamos</h2>                
                    </div>
                    <div  class="col-md-6"> 
                                        
                    </div>
                    <div  class="col-md-2"> 
                               
                    </div>
                    </div>
             
             
                    <div class="panel-body">    
                                            <div class="row">
                                            <table class="table">
  <thead>
    <tr>
      
    <th scope="col">Prestamos</th>
      <th scope="col">Libros</th>
      <th scope="col">Cine </th>
      <th scope="col">Musica</th>
      <th scope="col">Fotografia</th>
      <th scope="col">Multimedia</th>
      <th scope="col">Libros Digitales</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td>Adultos</td>
      <td id="pres_adult_book"></td>
      <td id="pres_adult_cine"></td>
      <td id="pres_adult_music"></td>
      <td id="pres_adult_fotografia"></td>
      <td id="pres_adult_multimedia"></td>
      <td>-</td>
    </tr>
    <tr>
     
      <td>Infantiles</td>
      <td id="pres_infantil_book"></td>
      <td id="pres_infantil_cine"></td>
      <td id="pres_infantil_music"></td>
      <td id="pres_infantil_fotografia"></td>
      <td id="pres_infantil_multimedia"></td>
      <td>-</td>
    </tr>

  </tbody>
</table>
                                         </div>

                    </div>
                                    

            </div>
        
    </div>
    <div  class="col-md-12"> 
            <div class="box box-primary"> 
            
                    <div class="box-header with-border">
                    <div  class="col-md-4"> 
                        <h2>Colecciones</h2>                
                    </div>
                    <div  class="col-md-6"> 
                                        
                    </div>
                    <div  class="col-md-2"> 
                               
                    </div>
                    </div>
             
             
                    <div class="panel-body">    
                                            <div class="row">
                                            <table class="table">
  <thead>
    <tr>
    <th scope="col">Colecciones</th>
      <th scope="col">Libros</th>
      <th scope="col">Cine </th>
      <th scope="col">Musica</th>
      <th scope="col">Fotografia</th>
      <th scope="col">Multimedia</th>
      <th scope="col">Libros Digitales</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
      <td>Incorporaciones</td>
      <td id="col_libros"></td>
      <td id="col_cine"></td>
      <td id="col_music"></td>
      <td id="col_fotografia"></td>
      <td id="col_multimedia"></td>
      <td>-</td>
    </tr>
    <tr>
     
      <td>Dados de Baja</td>
      <td id="col_baja_book"></td>
      <td id="col_baja_cine"></td>
      <td id="col_baja_music"></td>
      <td id="col_baja_fotografia"></td>
      <td id="col_baja_multimedia"></td>
      <td>-</td>
    </tr>

  </tbody>
</table>
                                         </div>

                    </div>
                                    

            </div>
        
    </div>
       
</div>
@stop

@include('admin.fastprocess.partials._modal')
@stack('script')
@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">    
@endpush

@push('scripts')  
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script> 
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/fastprocess.js') }}"></script>
    
    <script>

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
var mesanio = mm +'-'+ yyyy;

// function diasEnUnMes(mes, año) {
// 	return new Date(año, mes, 0).getDate();
// }
//  console.log("cantidad de dias: "+ diasEnUnMes(01,2020));

buscar();

function buscar(param = mesanio){
      fecha_desde = '01-'+param;
      array_param = param.split('-');
      var mes_var = array_param[0];
      var anio_var = array_param[1];
    ultimo_dia_del_mes=new Date(anio_var, mes_var, 0).getDate();;
  
    fecha_hasta =  ultimo_dia_del_mes +'-'+ param;

    // console.log("fecha_desde:  " + fecha_desde);
    // console.log("fecha_hasta:  " + fecha_hasta);
        $.ajax({                    
                    url: '/admin/statistic/filtrar/' + fecha_desde + '/' + fecha_hasta,
                    type: 'GET',
                    // data: {            
                    //     '_token': csrf_token
                    // },
                    dataType: 'json',
                    success: function (response) {
                        // acá podés loguear la respuesta del servidor
                        console.log(response);
                        // le pasás la data a la función que llena los otros inputs
                        
                        llenarEstadisticas(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle de la Compañía!');
                    }
                })

    
}

function llenarEstadisticas(data) {    
                // console.log(data);
                $('#col_libros').text(data.col_libros.count_col_libros);
                $('#col_cine').text(data.col_cine.count_col_cine);
                $('#col_music').text(data.col_music.count_col_music);
                $('#col_fotografia').text(data.col_fotografia.count_col_fotografia);
                $('#col_multimedia').text(data.col_multimedia.count_col_multimedia);
                // console.log("aver:: "+data.col_baja_book.count_col_baja_book)
                $('#col_baja_book').text(data.col_baja_book.count_col_baja_book);
                $('#col_baja_cine').text(data.col_baja_cine.count_col_baja_cine);
                $('#col_baja_music').text(data.col_baja_music.count_col_baja_music);
                $('#col_baja_fotografia').text(data.col_baja_fotografia.count_col_baja_fotografia);
                $('#col_baja_multimedia').text(data.col_baja_multimedia.count_col_baja_multimedia);

                $('#pres_adult_book').text(data.pres_adult_book.count_pres_adult_book);
                $('#pres_adult_cine').text(data.pres_adult_cine.count_pres_adult_cine);
                $('#pres_adult_music').text(data.pres_adult_music.count_pres_adult_music);
                $('#pres_adult_fotografia').text(data.pres_adult_fotografia.count_pres_adult_fotografia);
                $('#pres_adult_multimedia').text(data.pres_adult_multimedia.count_pres_adult_multimedia);

                $('#pres_infantil_book').text(data.pres_infantil_book.count_pres_infantil_book);
                $('#pres_infantil_cine').text(data.pres_infantil_cine.count_pres_infantil_cine);
                $('#pres_infantil_music').text(data.pres_infantil_music.count_pres_infantil_music);
                $('#pres_infantil_fotografia').text(data.pres_infantil_fotografia.count_pres_infantil_fotografia);
                $('#pres_infantil_multimedia').text(data.pres_infantil_multimedia.count_pres_infantil_multimedia);

                $('#soc_adul_alta').text(data.soc_adul_alta.count_soc_adul_alta);
                $('#soc_menor_alta').text(data.soc_menor_alta.count_soc_menor_alta);
                $('#soc_adul_baja').text(data.soc_adul_baja.count_soc_adul_baja);
                $('#soc_menor_baja').text(data.soc_menor_baja.count_soc_menor_baja);

                $('#total_socios').text("Total: " + (data.soc_adul_alta.count_soc_adul_alta + 
                                        data.soc_menor_alta.count_soc_menor_alta +
                                        data.soc_adul_baja.count_soc_adul_baja +
                                        data.soc_menor_baja.count_soc_menor_baja));
                // $('#surname').text(data.partner.surname);  
                // $('#email').text(data.partner.email);  
                // $('#loan').text(data.count.count_of_prestamos);
                // console.log("prstamos: " + data.limit.loan_limit);
                // if(data.count.count_of_prestamos > data.limit.loan_limit){
                //     $("#modal-btn-save-prestar").prop('disabled', true); 
                // }else{
                //     $("#modal-btn-save-prestar").prop('disabled', false); 
                // }  
                      
            } 

$('#filter').click(function(){
    var mesyanio = $('#yearandmonth').val();

    if(mesyanio != ''){
      buscar(mesyanio);
    }else{
        buscar();
    }

});

// function buscar(id) {
//                 $.ajax({                    
//                     url: '/admin/loanmanual/showPartner/' + id,
//                     type: 'GET',
//                     data: {            
//                         '_token': csrf_token
//                     },
//                     dataType: 'json',
//                     success: function (response) {
//                         // acá podés loguear la respuesta del servidor
//                         console.log(response);
//                         // le pasás la data a la función que llena los otros inputs
//                         llenarInputs(response);
//                     },
//                     error: function () { 
//                         console.log(error);
//                         alert('Hubo un error obteniendo el detalle de la Compañía!');
//                     }
//                 })
//             }




        $("#yearandmonth").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
        });



    </script>
@endpush