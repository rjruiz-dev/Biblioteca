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

            $('#loan').css('display', 'none');

            $('#lenguages_id').select2({
                dropdownParent: $("#fg_lenguages_id"),
                placeholder: 'Selecciona un Idioma'
            });

            $("#generate_subjects_id").select2({
                dropdownParent: $("#fg_generate_subjects_id"),
                placeholder: 'Selecciona Cdu'
            });

            $('#photography_movies_id').select2({
                dropdownParent: $("#fg_photography_movies_id"),
                placeholder: 'Seleccione o Ingrese un Tipo de Fotografia',
                tags: true
            });

            $('#generate_formats_id').select2({
                dropdownParent: $("#fg_generate_formats_id"),
                placeholder: 'Seleccione un Formato'
            });

            $('#generate_films_id').select2({
                dropdownParent: $("#fg_generate_films_id"),
                placeholder: 'Seleccione un Género',
                tags: true
            });

            $('#actors').select2({
                dropdownParent: $("#fg_actors"),
                tags: true
            });
            $('#references').select2({
                dropdownParent: $("#fg_references"),
                tags: true
            });

            $('#distributor').select2({
                dropdownParent: $("#fg_distributor"),
                placeholder: 'Seleccione o Ingrese una Distribuidora',
                tags: true
            });

            $('#status_documents_id').select2({
                dropdownParent: $("#fg_status_documents_id"),
                tags: false
            });

            $('#adequacies_id').select2({
                dropdownParent: $("#fg_adequacies_id"),
                placeholder: 'Selecciona una Adecuación'
            });

            $('#adaptations_id').select2({
                dropdownParent: $("#fg_adaptations_id"),
                placeholder: 'Tiene adaptacion ?',
                tags: false
            });
            $('#published').select2({
                dropdownParent: $("#fg_published"),
                placeholder: 'Selecciona Lugar de Publicación',
                tags: true

            });
            $('#made_by').select2({
                dropdownParent: $("#fg_made_by"),
                placeholder: 'Selecciona una Editorial',
                tags: true
            });
            $('#document_subtypes_id').select2({
                dropdownParent: $("#fg_document_subtypes_id"),
                placeholder: 'Selecciona un subtipo de Documento'
            });
            $("#creators_id").select2({
                dropdownParent: $("#fg_creators_id"),
                placeholder: 'Seleccione o Ingrese Autor',
                tags: true
            });

            $('#acquired').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                language: 'es'
            });



            $('#year').datepicker({
                autoclose: true,
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                language: 'es'
            });

            CKEDITOR.replace('synopsis');
            CKEDITOR.config.height = 190;

            obtenercamposestaticos(5);
        }
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function(event) {
    event.preventDefault();

    $avatarInput = $('#photo');

    var formData = new FormData();
    formData.append('photo', $avatarInput[0].files[0]);


    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = 'POST';
    // method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });


    $.ajax({
        url: url + '?' + form.serialize(),
        method: method,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload(null, false);

            var id_new_doc = response.data;
            var bandera = response.bandera;

            var mensaje_exito = response.mensaje_exito;
            var actualizacion_documento = response.actualizacion_documento;
            var alta_documento = response.alta_documento;


            console.log("id: " + id_new_doc);
            console.log("bandera: " + bandera);
            if (bandera == 1) {
                swal({
                    type: 'success',
                    title: mensaje_exito,
                    text: alta_documento,
                }).then(function() {
                    window.location = "../admin/genericcopies/copies/" + id_new_doc + "/c";
                });
            } else {
                swal({
                    type: 'success',
                    title: mensaje_exito,
                    text: actualizacion_documento
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

$('body').on('click', '.btn-solicitud', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    preg_solicitar_documento = $('#preg_solicitar_documento').val();

    swal({
        title: preg_solicitar_documento,
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        // confirmButtonText: 'Sí, Solicitar!'
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
                    var info = response.error;
                    var mensaje_exito = response.mensaje_exito;
                    var resp_solicitar_documento = response.resp_solicitar_documento;

                    $('#modal').modal('hide');
                    $('#datatable').DataTable().ajax.reload(null, false);
                    if (info == 0) {
                        swal({
                            type: 'success',
                            title: mensaje_exito,
                            text: resp_solicitar_documento
                        });
                    }
                    if (info == 1) {
                        swal({
                            type: 'error',
                            title: '¡Error!',
                            text: '¡Hay mas de 1 movimiento con el id copia pasado y con active en 1. Revisar!!'
                        });
                    }
                    if (info == 2) {
                        swal({
                            type: 'error',
                            title: '¡Error!',
                            text: '¡No existe copias disponibles de este documento. Revisar!!'
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

    console.log("url:sdfdsf " + url)

    if (title == 'Baja') {
        title_noti = 'dar de baja';
        title_noti_fin = 'dado de baja';
    } else {
        title_noti = 'reactivar';
        title_noti_fin = 'reactivado';
    }
    swal({

        title: '¿Seguro que quieres ' + title_noti + ' el documento ?',
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
                success: function(response) {
                    $('#datatable').DataTable().ajax.reload(null, false);
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Se ha el ' + title_noti_fin + ' el documento!'
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

$('body').on('click', '.btn-copy', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: url,
        type: "POST",
        data: {
            '_method': 'DELETE',
            '_token': csrf_token
        },
        success: function(response) {
            var info = response.data;
            console.log("asdas".info);
            if (info == 0) {
                swal({
                    type: 'warning',
                    title: '¡Atencion! Este documento esta dado de baja',
                    text: 'Para ver sus copias, debe estar activo o en desidherata'
                });
            } else {
                window.location = "/admin/genericcopies/copies/" + info + "/c";
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

});

$('body').on('click', '.btn-desidherata', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    console.log("url: " + url)
    desidherata = $('#preg_desidherata_documento').val();

    swal({

        title: desidherata,
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
                success: function(response) {

                    var mensaje_exito = response.mensaje_exito;
                    var resp_desidherata_documento = response.resp_desidherata_documento;

                    $('#datatable').DataTable().ajax.reload(null, false);
                    swal({
                        type: 'success',
                        title: mensaje_exito,
                        text: resp_desidherata_documento
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

$('body').on('click', '.btn-baja', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        valor = me.attr('value'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    // console.log("aaaa: " + valor);
    if (valor == 'rechazar') {
        baja_rechazar = $('#preg_rechazar_documento').val();
    } else {
        baja_rechazar = $('#preg_baja_documento').val();
    }
    swal({

        title: baja_rechazar,
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
                success: function(response) {

                    var mensaje_exito = response.mensaje_exito;
                    var baja_rechazar = response.baja_rechazar;

                    $('#datatable').DataTable().ajax.reload(null, false);
                    swal({
                        type: 'success',
                        title: mensaje_exito,
                        text: baja_rechazar
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

$('body').on('click', '.btn-reactivar', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        valor = me.attr('value'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    if (valor == 'aceptar') {
        reactivar_aceptar = $('#preg_aceptar_documento').val();
    } else {
        reactivar_aceptar = $('#preg_reactivar_documento').val();
    }
    swal({
        title: reactivar_aceptar,
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
                success: function(response) {

                    var mensaje_exito = response.mensaje_exito;
                    var resp_reactivar_documento = response.resp_reactivar_documento;

                    $('#datatable').DataTable().ajax.reload(null, false);
                    swal({
                        type: 'success',
                        title: mensaje_exito,
                        text: resp_reactivar_documento
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

// function yesnoCheck() {
//     if (document.getElementById("document_subtypes_id").value == 3) {
//         document.getElementById("popular").style.display = "block";
//         document.getElementById("culta").style.display = "none";
//     } else {
//         document.getElementById("culta").style.display = "block";
//         document.getElementById("popular").style.display = "none";
//     }
// }

function obtenercamposestaticos(accion) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/admin/movies/obtener/' + accion, //este 1 se pasa para q ande el metodo 
        type: 'GET',
        data: {
            '_token': csrf_token
        },
        dataType: 'json',
        success: function(response) {

            if (accion == 5) {

                // AQUI VA TODO LO Q SEA ESTATICO DE LA PANTALLA 
                // console.log("uiuiuiui" + accion);
                // document.getElementById("l_subtitle").innerHTML = response.subtítulo;
                // $('#subtitle').attr('placeholder', response.subtítulo);

                $("#creators_id").select2({
                    dropdownParent: $("#fg_creators_id"),
                    placeholder: response.ph_cuerpo_director,
                    tags: true
                });
                $('#adaptations_id').select2({
                    dropdownParent: $("#fg_adaptations_id"),
                    placeholder: response.ph_cuerpo_adaptacion,
                    tags: false
                });
                $('#adequacies_id').select2({
                    dropdownParent: $("#fg_adequacies_id"),
                    placeholder: response.ph_cuerpo_adecuado_para
                });
                $('#generate_films_id').select2({
                    dropdownParent: $("#fg_generate_films_id"),
                    placeholder: response.ph_cuerpo_genero,
                    tags: true
                });
                $("#generate_subjects_id").select2({
                    dropdownParent: $("#fg_generate_subjects_id"),
                    placeholder: response.ph_cuerpo_cdu
                });
                $('#status_documents_id').select2({
                    dropdownParent: $("#fg_status_documents_id"),
                    dropdownParent: response.ph_cuerpo_estado
                });
                $('#published').select2({
                    dropdownParent: $("#fg_published"),
                    placeholder: response.ph_cuerpo_nacionalidad,
                    tags: true
                });
                $('#made_by').select2({
                    dropdownParent: $("#fg_made_by"),
                    placeholder: response.ph_cuerpo_productora,
                    tags: true
                });
                $('#photography_movies_id').select2({
                    dropdownParent: $("#fg_photography_movies_id"),
                    placeholder: response.ph_cuerpo_fotografia,
                    tags: true
                });
                $('#generate_formats_id').select2({
                    dropdownParent: $("#fg_generate_formats_id"),
                    placeholder: response.ph_cuerpo_formato
                });
                $('#distributor').select2({
                    dropdownParent: $("#fg_distributor"),
                    placeholder: response.ph_cuerpo_distribuidora,
                    tags: true
                });
                $('#lenguages_id').select2({
                    dropdownParent: $("#fg_lenguages_id"),
                    placeholder: response.ph_cuerpo_idioma
                });
                // $('#modal-btn-save')
                document.getElementById("modal-btn-save").innerText = response.compl_btn_guardar;
            }

        },
        error: function() {
            // console.log(error);
            alert('Hubo un error obteniendo los datos de la traduccion');
        }
    })
}