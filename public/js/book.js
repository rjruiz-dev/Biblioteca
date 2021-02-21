$('body').on('click', '.modal-show', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');
    // console.log('rodrigo');
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

            $('#periodicities_id').select2({
                dropdownParent: $("#din_periodicities_id"),
                placeholder: 'Selecciona una periodicidad'
            });

            $('#lenguages_id').select2({
                dropdownParent: $("#fg_lenguages_id"),
                placeholder: 'Selecciona un Idioma'
            });

            $('#adequacies_id').select2({
                dropdownParent: $("#fg_adequacies_id"),
                placeholder: 'Selecciona una Adecuación'
            });


            $('#generate_books_id').select2({
                dropdownParent: $("#din_generate_books_id"),
                placeholder: 'Selecciona un Género'
            });

            $("#generate_subjects_id").select2({
                dropdownParent: $("#fg_generate_subjects_id"),
                placeholder: 'Selecciona Cdu'
            });

            $("#creators_id").select2({
                dropdownParent: $("#fg_creators_id"),
                placeholder: 'Seleccione o Ingrese Autor',
                tags: true
            });

            $("#second_author_id").select2({
                dropdownParent: $("#fg_second_author_id"),
                placeholder: 'Seleccione o Ingrese Segundo Autor',
                tags: true,
            });

            $("#third_author_id").select2({
                dropdownParent: $("#din_third_author_id"),
                placeholder: 'Seleccione o Ingrese Tercer Autor',
                tags: true,
            });

            $('#acquired').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                language: 'es'
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

            $('#year').datepicker({
                autoclose: true,
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                language: 'es'
            });

            $('#edition').select2({
                dropdownParent: $("#fg_edition"),
                placeholder: 'Selecciona Número de Edición',
                tags: true
            });

            $('#volume').select2({
                dropdownParent: $("#fg_volume"),
                placeholder: 'Selecciona un Volúmen',
                tags: true
            });

            $('#status_documents_id').select2({
                dropdownParent: $("#fg_status_documents_id"),
                tags: false
            });

            $('#references').select2({
                dropdownParent: $("#fg_references"),
                // tokenSeparators: [','],            
                tags: true
            });


            CKEDITOR.replace('synopsis');
            CKEDITOR.config.height = 190;


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
            // console.log("aaaa:" + actualizacion_documento);

            // console.log("id: " + id_new_doc);
            // console.log("bandera: " + bandera);

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
    // console.log("url: " + url)
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
                    $('#datatable').DataTable().ajax.reload(null, false);

                    var mensaje_exito = response.mensaje_exito;
                    var resp_desidherata_documento = response.resp_desidherata_documento;

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
                    if (valor != 'rechazar') {
                        swal({
                            type: 'success',
                            title: mensaje_exito,
                            text: baja_rechazar
                        });
                    } else {
                        swal({
                            type: 'success',
                            title: mensaje_exito,
                            text: baja_rechazar
                        }).then(function() {
                            window.location = "/admin/importfromrebeca";
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
                    var resp_aceptar_documento = response.resp_aceptar_documento;
                    var resp_reactivar_documento = response.resp_reactivar_documento;
                    var id_doc = response.id_doc;

                    $('#datatable').DataTable().ajax.reload(null, false);
                    if (valor != 'aceptar') {
                        swal({
                            type: 'success',
                            title: mensaje_exito,
                            text: resp_reactivar_documento
                        });
                    } else {
                        swal({
                            type: 'success',
                            title: mensaje_exito,
                            text: resp_aceptar_documento
                        }).then(function() {
                            // window.location = "/admin/importfromrebeca";
                            window.location = "/admin/genericcopies/copies/" + id_doc + "/i";
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


    // if (document.getElementById("document_subtypes_id").value == '4') { //si es publ periodica

    //     //FORM GROUP MOSTRAR

    //     document.getElementById("ls_tema").style.display = "block";


    // } else { //si NOO es publ periodica


    //      //FORM GROUP NO MOSTRAR

    //     document.getElementById("ls_tema").style.display = "none";

    // }

    $('#modal').modal('show');
});

if ($("#bande").val() != null) {
    alert("asdadasdad");
}

function yesnoCheck() {

    if (document.getElementById("document_subtypes_id").value == 4) { //si es publ periodica
        console.log("publ periodica");
        obtenercamposdinamicos(1); //publ periodica

        //CAMBIO DE LABEL
        // document.getElementById("l_subtitle").innerHTML = 'Tema de Portada';
        // document.getElementById("l_generate_books_id").innerHTML = 'Genero';
        //FORM GROUP MOSTRAR
        document.getElementById("din_volume_number_date").style.display = "block";
        document.getElementById("din_periodicities_id").style.display = "block";
        document.getElementById("din_issn").style.display = "block";
        //FORM GROUP NO MOSTRAR
        document.getElementById("din_isbn").style.display = "none";
        document.getElementById("din_generate_books_id").style.display = "none";
        document.getElementById("din_third_author_id").style.display = "none";

    } else { //si NOO es publ periodica

        if (document.getElementById("document_subtypes_id").value == 3) { //si es OTROS   
            console.log("otros");
            obtenercamposdinamicos(2); //otros
            //CAMBIO DE LABEL
            // document.getElementById("l_generate_books_id").innerHTML = 'Otros';
        } else {
            console.log("literatura");
            obtenercamposdinamicos(3); //literatura 
            // document.getElementById("l_generate_books_id").innerHTML = 'Genero'; 
        }
        obtenercamposdinamicos(4); // NO PUBLICACION PERIODICA(OTROS O LITERATURA) 
        //CAMBIO DE LABEL
        // document.getElementById("l_subtitle").innerHTML = 'Subtítulo';
        //FORM GROUP NO MOSTRAR
        document.getElementById("din_volume_number_date").style.display = "none";
        document.getElementById("din_periodicities_id").style.display = "none";
        document.getElementById("din_issn").style.display = "none";
        //FORM GROUP MOSTRAR
        document.getElementById("din_isbn").style.display = "block";
        document.getElementById("din_generate_books_id").style.display = "block";
        document.getElementById("din_third_author_id").style.display = "block";
    }

}

function obtenercamposdinamicos(accion) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/admin/books/obtener/' + accion, //este 1 se pasa para q ande el metodo 
        type: 'GET',
        data: {
            '_token': csrf_token
        },
        dataType: 'json',
        success: function(response) {
            // console.log("accion que viene: " + accion);

            if (accion == 1) { // publicacion periodica                   
                document.getElementById("l_subtitle").innerHTML = response.cuerpo_tema_portada;
                $('#subtitle').attr('placeholder', response.ph_cuerpo_tema_portada);
            }

            if (accion == 2) { //otros
                document.getElementById("l_generate_books_id").innerHTML = response.cuerpo_otros;
                $('#generate_books_id').select2({
                    placeholder: response.ph_cuerpo_otros,
                    // placeholder: response.plh_otros,
                });
            }

            if (accion == 3) { //literatura 
                document.getElementById("l_generate_books_id").innerHTML = response.cuerpo_genero;
                $('#generate_books_id').select2({
                    placeholder: response.ph_cuerpo_genero,
                    // placeholder: response.plh_genero,
                });
            }
            if (accion == 4) { // NO PUBLICACION PERIODICA(OTROS O LITERATURA)
                document.getElementById("l_subtitle").innerHTML = response.cuerpo_subtitulo;
                $('#subtitle').attr('placeholder', response.ph_cuerpo_subtitulo);
            }

        },
        error: function() {
            // console.log(error);
            alert('Hubo un error obteniendo los datos de la traduccion');
        }
    })
}
// obtenercamposestaticos(5);


function obtenercamposestaticos(accion) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/admin/books/obtener/' + accion, //este 1 se pasa para q ande el metodo 
        type: 'GET',
        data: {
            '_token': csrf_token
        },
        dataType: 'json',
        success: function(response) {

            if (accion == 5) { // AQUI VA TODO LO Q SEA ESTATICO DE LA PANTALLA 
                // console.log("uiuiuiui" + accion);
                // document.getElementById("l_subtitle").innerHTML = response.subtítulo;
                // $('#subtitle').attr('placeholder', response.subtítulo);
                $('#document_subtypes_id').select2({
                    placeholder: response.ph_cuerpo_tipo_de_libro,
                });
                $("#creators_id").select2({
                    placeholder: response.ph_cuerpo_autor,
                });
                $("#second_author_id").select2({
                    placeholder: response.ph_cuerpo_segundo_autor,
                });
                $("#third_author_id").select2({
                    placeholder: response.ph_cuerpo_tercer_autor,
                });
                $('#adequacies_id').select2({
                    placeholder: response.ph_cuerpo_adecuado_para,
                });
                $('#periodicities_id').select2({
                    placeholder: response.ph_cuerpo_periodicidad,
                });
                $("#generate_subjects_id").select2({
                    placeholder: response.ph_cuerpo_cdu,
                });
                $('#published').select2({
                    placeholder: response.ph_cuerpo_publicado_en,
                });
                $('#made_by').select2({
                    placeholder: response.ph_cuerpo_editorial,
                });
                $('#edition').select2({
                    placeholder: response.ph_cuerpo_edicion,
                });
                $('#volume').select2({
                    placeholder: response.ph_cuerpo_volumenes,
                });
                $('#lenguages_id').select2({
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