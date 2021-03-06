$('#modal-btn-save-prestar').click(function(event) {
    event.preventDefault();

    var form = $('#form_prestamo form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');


    $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function(response) {
            var info = response.bandera;
            var info2 = response.id;
            var error = response.error;
            console.log(response);
            var mensaje_exito_prestar = response.mensaje_exito_prestar;
            var noti_prestamo_exitoso = response.noti_prestamo_exitoso;

            console.log("id" + info2);
            console.log("ALGO" + info);
            form.trigger('reset');
            // $('#modal').modal('hide');
            // $('#datatable').DataTable().ajax.reload(null, false);
            if (error == 0) {
                if (info == 1) {
                    swal({
                        type: 'success',
                        title: mensaje_exito_prestar,
                        text: noti_prestamo_exitoso,
                    }).then(function() {
                        // window.location = "../";
                        window.location = "/admin/loanmanual/";
                    });
                }
                if (info == 0) {
                    swal({
                        type: 'success',
                        title: mensaje_exito_prestar,
                        text: noti_prestamo_exitoso,
                    }).then(function() {
                        window.location = "/admin/fastprocess/edit2/" + info2;
                    });
                }
                if (info == 3) {
                    swal({
                        type: 'success',
                        title: mensaje_exito_prestar,
                        text: noti_prestamo_exitoso,
                    }).then(function() {
                        window.location = "/admin/requests/";
                    });
                }
            } else {
                swal({
                    type: 'error',
                    title: '¡Error!',
                    text: '¡Hay mas de 1 movimiento con el id copia pasado y con active en 1. Revisar!!'
                });
            }
        },
        error: function(xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function(key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
});

if ($("#bandera").val() == 3) {

    var id_usuario_traido = $('#users_id').val();
    // alert(id_usuario_traido);
    obtenerDetalleDePartner(id_usuario_traido);
}
// $('#copies_id').select2({
//     // placeholder: 'Selecciona un Numero de Copia',
//     tags: false                 

// });

// $('#users_id').select2({
//     placeholder: 'Selecciona un Socio',
//     tags: false                 

// });

// $('#course_id').select2({
//     placeholder: 'Selecciona un Curso',
//     tags: false                 

// });

// $('#grupo').select2({
//     placeholder: 'Selecciona un Grupo',
//     tags: false                 

// });

// $('#turno').select2({
//     placeholder: 'Selecciona un Grupo',
//     tags: false                 

// });



$("#modal-btn-save-prestar").prop('disabled', true); //desabilito primero el boton prestar

var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

$('#acquired').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd-mm-yyyy',
    language: 'es',
    startDate: today,
    endDate: 0,
    autoclose: true
});

var user_idSelect = $('#users_id');
var user_photo = $('#user_photo');
// var photo = $('[name="photo"]');           
var nickname = $('#nickname');
var surname = $('#surname');
var email = $('#email');
var loan = $('#loan');
var csrf_token = $('meta[name="csrf-token"]').attr('content');
console.log(user_idSelect);
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
        success: function(response) {
            // acá podés loguear la respuesta del servidor
            console.log(response);
            // le pasás la data a la función que llena los otros inputs
            llenarInputs(response);
        },
        error: function() {
            console.log(error);
            alert('Hubo un error obteniendo el detalle de la Compañía!');
        }
    })
}


function llenarInputs(data) {         
    img_url = '/images/'+ data.partner.user_photo;       
    $("#user_photo").attr("src",img_url);
    $('#nickname').text(data.partner.name);  
    $('#surname').text(data.partner.surname);  
    $('#email').text(data.partner.email);    
    $('#loan').text(data.count.count_of_prestamos);
    // console.log("prstamos: " + data.limit.loan_limit);
    if(data.count.count_of_prestamos > data.limit.loan_limit){
        $("#modal-btn-save-prestar").prop('disabled', true); 
    }else{
        $("#modal-btn-save-prestar").prop('disabled', false); 
    }                      
}
