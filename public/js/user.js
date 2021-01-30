$('body').on('click', '.modal-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').removeClass('hide')
    .text(me.hasClass('edit') ? 'Actualizar' : 'Crear');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
            
            $('#gender').select2({
                dropdownParent: $("#fg_gender"),
                placeholder: 'Selecciona un Género',
                tags: true      
            });

            $('#status_id').select2({
                dropdownParent: $("#fg_status_id"),
                placeholder: 'Selecciona un Estado'                       
            });

            $('#province').select2({
                dropdownParent: $("#fg_province"),
                placeholder: 'Selecciona o Ingresa una Provincia',
                tags: true                     
            });

            $('#birthdate').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: 'dd-mm-yyyy',                       
                language: 'es'
            });   
                   
        }
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function (event) {
    event.preventDefault();

    $avatarInput = $('#user_photo');

    var formData  = new FormData();        
        formData.append('user_photo', $avatarInput[0].files[0]);
        
    var form = $('#modal-body form'), 
        url = form.attr('action'),
        method =  'POST' ;
        // method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    
    $.ajax({
        url : url + '?' + form.serialize(),
        method: method,
        data : formData, 
        cache: false,  
        processData: false,
        contentType: false,
        success: function (response) {

            var mensaje_exito = response.mensaje_exito;
            var noti_alta_socio = response.noti_alta_socio;

            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();
            $("#image").load(" #image");  

            swal({
                type : 'success',
                title : mensaje_exito,
                text : noti_alta_socio
            });
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
});

$('body').on('click', '.btn-btn-edit-user', function (event) {

    $('#dpassword_confirmation, #dpassword').css('display', 'inline');    

});

// $('body').on('click', '.btn-delete', function (event) {
//     event.preventDefault();
   
//     var me = $(this),
//         url = me.attr('href'),
//         title = me.attr('title'),
//         csrf_token = $('meta[name="csrf-token"]').attr('content');

//     swal({
//         title: '¿Seguro que quieres eliminar a : ' + title + ' ?',
//         text: '¡No podrás revertir esto!',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Sí, bórralo!'
//     }).then((result) => {
//         if (result.value) {
//             $.ajax({
//                 url: url,
//                 type: "POST",
//                 data: {
//                     '_method': 'DELETE',
//                     '_token': csrf_token
//                 },
//                 success: function (response) {
//                     $('#datatable').DataTable().ajax.reload();
//                     swal({
//                         type: 'success',
//                         title: '¡Éxito!',
//                         text: '¡Los datos han sido eliminados!'
//                     });
//                 },
//                 error: function (xhr) {
//                     swal({
//                         type: 'error',
//                         title: 'Ups...',
//                         text: '¡Algo salió mal!'
//                     });
//                 }
//             });
//         }
//     });
// });

$('body').on('click', '.btn-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').addClass('hide');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

$('body').on('click', '.btn-delete', function (event) { // nose usa pero se deja xq es dinamico y puede servir. Rodri salaminnn jajjaj
    event.preventDefault();
   
    var me = $(this),
        url = me.attr('href'),
        valor = me.attr('value'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

        console.log("url:sdfdsf " + url)

        if(valor == 'Baja'){
            title_noti = $('#preg_baja_socio').val();
        }else{
            title_noti = $('#preg_reactivar_socio').val();
        }
    swal({
        
        title: title_noti,
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        // confirmButtonText: 'Sí!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {

                    var mensaje_exito = response.mensaje_exito;
                    var alta_baja = response.alta_baja;

                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: mensaje_exito,
                        text: alta_baja
                    }); 
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Ups...',
                        text: '¡Algo salió mal!'
                    });
                }
            });
        }
    });
});


