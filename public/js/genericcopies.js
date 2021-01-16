$('body').on('click', '.modal-show-e', function(event) {
    event.preventDefault();
    // console.log("sdfsdf");
    swal({
        type: 'error',
        title: '¡Accion Denegada!',
        text: '¡No se puede editar esta copia porque la misma se encuentra prestada!'
    });
});


$('body').on('click', '.modal-show', function(event) {
    event.preventDefault();
    console.log("sdfsdf");
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

            $('#lenguages_id').select2({
                placeholder: 'Selecciona un Idioma',
                dropdownParent: $('#modal')
            });

            $('#generate_references_id').select2({
                placeholder: 'Selecciona o Ingrese un Referencia',
                dropdownParent: $('#modal')
            });

            $('#generate_subjects_id').select2({
                placeholder: 'Selecciona Cdu',
                dropdownParent: $('#modal')
            });

            $('#photography_movies_id').select2({
                placeholder: 'Seleccione o Ingrese un Tipo de Fotografia',
                dropdownParent: $('#modal')
            });

            $('#generate_formats_id').select2({
                placeholder: 'Seleccione un Formato',
                dropdownParent: $('#modal')
            });

            $('#generate_films_id').select2({
                placeholder: 'Seleccione un Género',
                dropdownParent: $('#modal')
            });

            $('#actors').select2({
                tags: true,
                dropdownParent: $('#modal')
            });

            $('#references').select2({
                tags: false,

            });

            $('#distributor').select2({
                placeholder: 'Seleccione o Ingrese una Distribuidora',
                dropdownParent: $('#modal'),
                tags: true
            });

            $('#adequacies_id').select2({
                placeholder: 'Selecciona una Adecuación',
                dropdownParent: $('#modal')
            });

            $('#adaptations_id').select2({
                placeholder: 'Tiene adaptacion ?',
                dropdownParent: $('#modal'),
                tags: false
            });
            $('#published').select2({
                placeholder: 'Selecciona Nacionalidad',
                dropdownParent: $('#modal'),
                tags: true,
            });
            $('#made_by').select2({
                placeholder: 'Selecciona una Productora',
                dropdownParent: $('#modal'),
                tags: true,
            });
            $('#status_copy_id').select2({
                placeholder: 'Selecciona un estado para la copia',
                dropdownParent: $('#modal'),
                tags: false,
            });

            $('#creators_id').select2({
                placeholder: 'Seleccione o Ingrese un Director',
                dropdownParent: $('#modal'),
                tags: true,
            });

            $('#acquired').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                language: 'es'
            });

            $('#generate_films_id').select2({
                placeholder: 'Selecciona un Género',
                dropdownParent: $('#modal')
            });

            $('#year').datepicker({
                autoclose: true,
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                language: 'es'
            });

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
            var data = response.data;
            var bandera = response.bandera;
            var mensaje_exito = response.mensaje_exito;
            var actualizacion_copia = response.actualizacion_copia;
            var alta_copia = response.alta_copia;
            
            
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();
            if (bandera == 0) { // si es store 
                if (data == true) {
                    swal({
                        type: 'success',
                        title: mensaje_exito,
                        text: alta_copia
                    });
                } else {
                    swal({
                        type: 'error',
                        title: '¡Error!',
                        text: '¡Error al guardar los datos!'
                    });
                }

            } else { // si es update
                if (data == true) {
                    swal({
                        type: 'success',
                        title: mensaje_exito,
                        text: actualizacion_copia
                    });
                } else {
                    swal({
                        type: 'error',
                        title: '¡Error!',
                        text: '¡Hay mas de 1 movimiento con el id copia pasado y con active en 1. Revisar!!'
                    });
                }

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

$('body').on('click', '.btn-btn-edit-user', function(event) {

    $('#dpassword_confirmation, #dpassword').css('display', 'inline');

});

$('body').on('click', '.btn-delete', function(event) {
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
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Los datos han sido eliminados!'
                    });
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

$('body').on('click', '.btn-show', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').addClass('hide');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

function yesnoCheck() {
    if (document.getElementById("document_subtypes_id").value == 3) {
        document.getElementById("popular").style.display = "block";
        document.getElementById("culta").style.display = "none";
    } else {
        document.getElementById("culta").style.display = "block";
        document.getElementById("popular").style.display = "none";
    }
}