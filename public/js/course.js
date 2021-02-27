$('body').on('click', '.modal-show', function(event) {
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
        success: function(response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function(event) {
    event.preventDefault();

    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function(response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload(null, false);

            var swal_exito = response.swal_exito;
            var swal_info_exito = response.swal_info_exito;

            swal({
                type: 'success',
                title: swal_exito,
                text: swal_info_exito
            });
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

$('body').on('click', '.btn-delete', function(event) { // nose usa pero se deja xq es dinamico y puede servir. Rodri salaminnn jajjaj
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    if (title == 'Baja') {
        baja_rechazar = $('#swal_baja').val();

    } else {
        baja_rechazar = $('#swal_reactivar').val();
    }

    swal({

        title: baja_rechazar,
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        // confirmButtonText: swal_btn_br
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function(response) {
                    var info = response.data;

                    var swal_exito = response.swal_exito;
                    var bajado_reactivado = response.bajado_reactivado;
                    var swal_advertencia = response.swal_advertencia;
                    var swal_info_advertencia = response.swal_info_advertencia;


                    if (info == 1) {
                        $('#datatable').DataTable().ajax.reload(null, false);
                        swal({
                            type: 'success',
                            title: swal_exito,
                            text: bajado_reactivado
                        });
                    } else {
                        swal({
                            type: 'warning',
                            title: swal_advertencia,
                            text: swal_info_advertencia
                        });
                    }
                },
                error: function(xhr) {
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


$('body').on('click', '.btn-deleteCourse', function(event) {
    event.preventDefault();
    console.log('entro ');

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal_eliminar_lan = $('#swal_eliminar_lan').val();

    swal({
        title: '¿Seguro que quieres eliminar este curso ?_',
        // title: swal_eliminar_lan,
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        // confirmButtonText: 'Sí, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function(response) {
                    $('#datatable').DataTable().ajax.reload(null, false);

                    var info = response.data;
                    // var swal_exito_lan = response.swal_exito_lan;
                    // var swal_info_eliminar_lan = response.swal_info_eliminar_lan;
                    // var swal_advertencia_lan = response.swal_advertencia_lan;
                    // var swal_info_advertencia_lan = response.swal_info_advertencia_lan;

                    if (info == 1) {
                        swal({
                            type: 'success',
                            // title: swal_exito_lan,
                            // text: swal_info_eliminar_lan
                            title: 'Exito_',
                            text: '¡El curso ha sido eliminado!_'
                        });

                    } else {
                        swal({
                            type: 'warning',
                            // title: swal_advertencia_lan,
                            // text: swal_info_advertencia_lan
                            title: '¡Advertencia!_ ',
                            text: '¡No puede eliminar este curso, ya que esta en uno o mas prestamos vigente!_'
                        });
                    }
                },
                error: function(xhr) {
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