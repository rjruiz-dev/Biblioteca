$('body').on('click', '.modal-show', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');
    console.log('rodrigo');
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
            $('#datatable').DataTable().ajax.reload();

            var id_new_doc = response.data;
            var bandera = response.bandera;

            console.log("id: " + id_new_doc);
            console.log("bandera: " + bandera);

            if (bandera == 1) {
                swal({
                    type: 'success',
                    title: '¡Éxito!',
                    text: '¡Se han guardado el documento! Ahora debe registrar las copias del mismo',
                }).then(function() {
                    window.location = "../admin/genericcopies/copies/" + id_new_doc;
                });
            } else {
                swal({
                    type: 'success',
                    title: '¡Éxito!',
                    text: '¡Se ha actualizado el documento!'
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

    swal({
        title: '¿Seguro que desea solicitar este documento ?',
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Solicitar!'
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
                    $('#modal').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    if (info == 0) {
                        swal({
                            type: 'success',
                            title: '¡Éxito!',
                            text: '¡El documento ha sido solicitado!'
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
                window.location = "/admin/genericcopies/copies/" + info;
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
    swal({

        title: '¿Seguro que quieres poner en desidherata el documento ?',
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí!'
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
                        text: '¡El documento se ha puesto en desidherata!'
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
        muestra = 'rechazar';
    } else {
        muestra = 'dar de baja';
    }

    swal({

        title: '¿Seguro que quieres ' + muestra + ' el documento ?',
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí!'
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
                        text: '¡Se ha dado de baja el documento!'
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
        muestra = 'aceptar';
    } else {
        muestra = 'reactivar';
    }

    swal({

        title: '¿Seguro que quieres ' + muestra + ' el documento ?',
        // text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí!'
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
                        text: '¡Se ha reactivado el documento!'
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
            obtenercamposdinamicos(2); //otros
            //CAMBIO DE LABEL
            // document.getElementById("l_generate_books_id").innerHTML = 'Otros';
        } else {
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

            if (accion == 1) { // publicacion periodica                   
                document.getElementById("l_subtitle").innerHTML = response.tema_de_portada;
                $('#subtitle').attr('placeholder', response.tema_de_portada);
            }

            if (accion == 2) { //otros
                document.getElementById("l_generate_books_id").innerHTML = 'Otros';
                $('#generate_books_id').select2({
                    placeholder: 'Otros',
                    // placeholder: response.plh_otros,
                });
            }

            if (accion == 3) { //literatura 
                document.getElementById("l_generate_books_id").innerHTML = 'Genero';
                $('#generate_books_id').select2({
                    placeholder: 'Genero',
                    // placeholder: response.plh_genero,
                });
            }
            if (accion == 4) { // NO PUBLICACION PERIODICA(OTROS O LITERATURA)
                document.getElementById("l_subtitle").innerHTML = response.subtítulo;
                $('#subtitle').attr('placeholder', response.subtítulo);
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
        url: '/admin/books/obtener/' + accion, //este 1 se pasa para q ande el metodo 
        type: 'GET',
        data: {
            '_token': csrf_token
        },
        dataType: 'json',
        success: function(response) {

            if (accion == 5) { // AQUI VA TODO LO Q SEA ESTATICO DE LA PANTALLA 
                document.getElementById("l_subtitle").innerHTML = response.subtítulo;
                $('#subtitle').attr('placeholder', response.subtítulo);
            }

        },
        error: function() {
            // console.log(error);
            alert('Hubo un error obteniendo los datos de la traduccion');
        }
    })
}