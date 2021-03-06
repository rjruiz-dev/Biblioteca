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

            $('#document_subtypes_id').select2({
                dropdownParent: $("#fg_document_subtypes_id"),
                placeholder: 'Selecciona un subtipo de Documento'
            });

            $('#status_documents_id').select2({
                dropdownParent: $("#fg_status_documents_id"),
                tags: false
            });

            $('#sound').select2({
                dropdownParent: $("#fg_sound"),
                placeholder: 'Seleccione una Fotografia',
                tags: true
            });

            $("#creators_id").select2({
                dropdownParent: $("#fg_creators_id"),
                placeholder: 'Seleccione o Ingrese Autor',
                tags: true
            });

            $("#generate_subjects_id").select2({
                dropdownParent: $("#fg_generate_subjects_id"),
                placeholder: 'Selecciona Cdu'
            });

            $('#acquired').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                language: 'es'
            });

            $('#adequacies_id').select2({
                dropdownParent: $("#fg_adequacies_id"),
                placeholder: 'Selecciona una Adecuación'
            });

            $('#generate_formats_id').select2({
                dropdownParent: $("#fg_generate_formats_id"),
                placeholder: 'Seleccione un Formato'
            });

            $('#generate_musics_id').select2({
                dropdownParent: $("#fg_generate_musics_id"),
                placeholder: 'Selecciona un Género'
            });

            $('#year').datepicker({
                autoclose: true,
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                language: 'es'
            });
            $('#published').select2({
                dropdownParent: $("#fg_published"),
                placeholder: 'Selecciona Lugar de Publicación',
                tags: true

            });
            $('#volume').select2({
                dropdownParent: $("#fg_volume"),
                placeholder: 'Selecciona un Volúmen',
                tags: true
            });
            $('#lenguages_id').select2({
                dropdownParent: $("#fg_lenguages_id"),
                placeholder: 'Selecciona un Idioma'
            });

            $('#references').select2({
                dropdownParent: $("#fg_references"),
                tags: true
            });
            $('#made_by').select2({
                dropdownParent: $("#fg_made_by"),
                placeholder: 'Selecciona una Editorial',
                tags: true
            });

            CKEDITOR.replace('synopsis');
            CKEDITOR.config.height = 190;

            // if (document.getElementById("document_subtypes_id").value == 2) { // si es popular
            //     //PLACEHOLDERS SOLOS
            //     document.getElementById("title").placeholder = 'Titulo';
            //     //PLACEHOLDERS DE SELECT



            //     document.getElementById("l_title").innerHTML = 'Titulo';
            //     document.getElementById("l_creators_id").innerHTML = 'Artista';

            //     document.getElementById("din_album_title").style.display = "none";
            //     document.getElementById("din_director").style.display = "none";
            //     document.getElementById("din_orchestra").style.display = "none";
            //     document.getElementById("din_soloist").style.display = "none";

            //     document.getElementById("din_subtitle").style.display = "block";
            //     document.getElementById("din_other_artists").style.display = "block";
            //     document.getElementById("din_music_populars").style.display = "block";
            //     document.getElementById("din_original_title").style.display = "block";
            // } else { // si es culta
            //     //PLACEHOLDERS SOLOS
            //     document.getElementById("title").placeholder = 'Titulo de la Obra';
            //     //PLACEHOLDERS DE SELECT


            //     document.getElementById("l_title").innerHTML = 'Titulo de la obra';
            //     document.getElementById("l_creators_id").innerHTML = 'Compositor';

            //     document.getElementById("din_album_title").style.display = "block";
            //     document.getElementById("din_director").style.display = "block";
            //     document.getElementById("din_orchestra").style.display = "block";
            //     document.getElementById("din_soloist").style.display = "block";

            //     document.getElementById("din_subtitle").style.display = "none";
            //     document.getElementById("din_other_artists").style.display = "none";
            //     document.getElementById("din_music_populars").style.display = "none";
            //     document.getElementById("din_original_title").style.display = "none";
            // }

            yesnoCheck();
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


    // console.log("aaaa: " + valor);
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

function obtenercamposdinamicos(accion) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/admin/musics/obtener/' + accion, //este 1 se pasa para q ande el metodo 
        type: 'GET',
        data: {
            '_token': csrf_token
        },
        dataType: 'json',
        success: function(response) {
            // console.log("accion que viene: " + accion);

            if (accion == 1) { // culta    
                //PLACEHOLDERS SOLOS
                document.getElementById("title").placeholder = response.ph_cuerpo_titulo_de_la_obra;
                //PLACEHOLDERS DE SELECT
                $('#creators_id').select2({
                    placeholder: response.ph_cuerpo_compositor,
                    tags: true,
                });

                document.getElementById("l_title").innerHTML = response.cuerpo_titulo_de_la_obra;
                document.getElementById("l_creators_id").innerHTML = response.cuerpo_compositor;

            }

            if (accion == 2) { //popular
                //PLACEHOLDERS SOLOS
                document.getElementById("title").placeholder = response.ph_cuerpo_titulo;
                //PLACEHOLDERS DE SELECT
                $('#creators_id').select2({
                    placeholder: response.ph_cuerpo_artista,
                    tags: true,
                });
                document.getElementById("l_title").innerHTML = response.cuerpo_titulo;
                document.getElementById("l_creators_id").innerHTML = response.cuerpo_artista;
            }

        },
        error: function() {
            // console.log(error);
            alert('Hubo un error obteniendo los datos de la traduccion');
        }
    })
}

function obtenercamposestaticos(accion) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/admin/musics/obtener/' + accion, //este 1 se pasa para q ande el metodo 
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

                $('#document_subtypes_id').select2({
                    dropdownParent: $("#fg_document_subtypes_id"),
                    placeholder: response.ph_cuerpo_tipo_de_musica
                });
                $('#adequacies_id').select2({
                    dropdownParent: $("#fg_adequacies_id"),
                    placeholder: response.ph_cuerpo_adecuado_para
                });
                $('#generate_musics_id').select2({
                    dropdownParent: $("#fg_generate_musics_id"),
                    placeholder: response.ph_cuerpo_genero
                });
                $("#generate_subjects_id").select2({
                    dropdownParent: $("#fg_generate_subjects_id"),
                    placeholder: response.ph_cuerpo_cdu
                });
                $('#published').select2({
                    dropdownParent: $("#fg_published"),
                    placeholder: response.ph_cuerpo_editado_en
                });
                $('#made_by').select2({
                    dropdownParent: $("#fg_made_by"),
                    placeholder: response.ph_cuerpo_sello_discografico,
                    tags: true
                });
                $('#sound').select2({
                    dropdownParent: $("#fg_sound"),
                    placeholder: response.ph_cuerpo_fotografia,
                    tags: true
                });
                $('#volume').select2({
                    dropdownParent: $("#fg_volume"),
                    placeholder: response.ph_cuerpo_volumenes,
                    tags: true
                });
                $('#generate_formats_id').select2({
                    dropdownParent: $("#fg_generate_formats_id"),
                    placeholder: response.ph_cuerpo_formato,
                });
                $('#lenguages_id').select2({
                    dropdownParent: $("#fg_lenguages_id"),
                    placeholder: response.ph_cuerpo_idioma,
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

function yesnoCheck() {
    if (document.getElementById("document_subtypes_id").value == 2) { // si es popular
        // document.getElementById("popular").style.display = "block";
        // document.getElementById("culta").style.display = "none";

        obtenercamposdinamicos(2);
        // //PLACEHOLDERS SOLOS
        // document.getElementById("title").placeholder = 'Titulo';
        // //PLACEHOLDERS DE SELECT
        // $('#creators_id').select2({
        //     placeholder: 'Selecciona o Ingresa un Artista',
        //     tags: true,

        // });
        // document.getElementById("l_title").innerHTML = 'Titulo';
        // document.getElementById("l_creators_id").innerHTML = 'Artista';


        document.getElementById("din_album_title").style.display = "none";
        document.getElementById("din_director").style.display = "none";
        document.getElementById("din_orchestra").style.display = "none";
        document.getElementById("din_soloist").style.display = "none";

        document.getElementById("din_subtitle").style.display = "block";
        document.getElementById("din_other_artists").style.display = "block";
        document.getElementById("din_music_populars").style.display = "block";
        document.getElementById("din_original_title").style.display = "block";

    } else { // si es culta

        obtenercamposdinamicos(1);
        // document.getElementById("culta").style.display = "block";
        // document.getElementById("popular").style.display = "none";

        // //PLACEHOLDERS SOLOS
        // document.getElementById("title").placeholder = 'Titulo de la Obra';
        // //PLACEHOLDERS DE SELECT
        // $('#creators_id').select2({
        //     placeholder: 'Selecciona o Ingresa un Compositor',
        //     tags: true,
        // });

        // document.getElementById("l_title").innerHTML = 'Titulo de la obra';
        // document.getElementById("l_creators_id").innerHTML = 'Compositor';



        document.getElementById("din_album_title").style.display = "block";
        document.getElementById("din_director").style.display = "block";
        document.getElementById("din_orchestra").style.display = "block";
        document.getElementById("din_soloist").style.display = "block";

        document.getElementById("din_subtitle").style.display = "none";
        document.getElementById("din_other_artists").style.display = "none";
        document.getElementById("din_music_populars").style.display = "none";
        document.getElementById("din_original_title").style.display = "none";
    }
}