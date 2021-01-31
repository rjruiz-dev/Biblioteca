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
            $('#datatable').DataTable().ajax.reload();

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


$('body').on('click', '.btn-delete2', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: '¿Seguro que quieres eliminar a : ' + title + ' ?',
        text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, bórralo!'
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
                    $('#datatable').DataTable().ajax.reload();
                    var info = response.data;
                    if (info == 1) {
                        swal({
                            type: 'success',
                            title: '¡Éxito!',
                            text: '¡El formato ha sido eliminado!'
                        });

                    } else {
                        swal({
                            type: 'warning',
                            title: '¡Advertencia!',
                            text: '¡No puede eliminar este formato, esta siendo utilizado por uno o mas Documentos!'
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

$('body').on('click', '.btn-delete', function(event) { // nose usa pero se deja xq es dinamico y puede servir. Rodri salaminnn jajjaj
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    // console.log("url:sdfdsf " + url)

    if (title == 'Baja') {
        title_noti = 'dar de baja';
        title_noti_fin = 'dado de baja';
    } else {
        title_noti = 'reactivar';
        title_noti_fin = 'reactivado';
    }

    swal({

        title: swal_br + title_noti + ' el curso?',
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: swal_btn_br
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

                    var swal_br = response.swal_br;
                    var swal_btn_br = response.swal_btn_br;
                    var swal_info_br = response.swal_info_br;

                    var swal_advertencia = response.swal_advertencia;
                    var swal_info_advertencia = response.swal_info_advertencia;


                    if (info == 1) {
                        $('#datatable').DataTable().ajax.reload();
                        swal({
                            type: 'success',
                            title: swal_exito,
                            text: swal_info_br + title_noti_fin + ' el Curso!'
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