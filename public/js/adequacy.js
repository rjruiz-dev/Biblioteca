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
            $("#adequacy_description").focus();
        }
    });

    $('#modal').modal('show');
});

$('#modal').keypress(function(event) {
    if ($("#modal").hasClass('in') && (event.keycode == 13 || event.which == 13)) {
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

                var swal_exito_ade = response.swal_exito_ade;
                var swal_info_exito_ade = response.swal_info_exito_ade;

                swal({
                    type: 'success',
                    title: swal_exito_ade,
                    text: swal_info_exito_ade
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
    }
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

            var swal_exito_ade = response.swal_exito_ade;
            var swal_info_exito_ade = response.swal_info_exito_ade;

            swal({
                type: 'success',
                title: swal_exito_ade,
                text: swal_info_exito_ade
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


$('body').on('click', '.btn-delete', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal_eliminar_ade = $('#swal_eliminar_ade').val();


    swal({
        title: swal_eliminar_ade,
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
                    var swal_exito_ade = response.swal_exito_ade;
                    var swal_info_eliminar_ade = response.swal_info_eliminar_ade;
                    var swal_advertencia_ade = response.swal_advertencia_ade;
                    var swal_info_advertencia_ade = response.swal_info_advertencia_ade;

                    if (info == 1) {
                        swal({
                            type: 'success',
                            title: swal_exito_ade,
                            text: swal_info_eliminar_ade
                        });

                    } else {
                        swal({
                            type: 'warning',
                            title: swal_advertencia_ade,
                            text: swal_info_advertencia_ade
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