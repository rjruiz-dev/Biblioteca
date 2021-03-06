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

            $('#document_subtypes_id').select2({
                placeholder: 'Selecciona un subtipo de Documento'                       
            });
            $('#periodicities_id').select2({
                placeholder: 'Selecciona una periodicidad'                                             
            });
            $('#lenguages_id').select2({
                placeholder: 'Selecciona un Idioma'                                       
            });
            $('#adequacies_id').select2({
                placeholder: 'Selecciona una Adecuación',                        
            });

            $('#generate_books_id').select2({
                placeholder: 'Selecciona un Género',                            
            });
            $('#generate_subjects_id').select2({
                placeholder: 'Selecciona Cdu'                    
            });
          
            $('#creators_id').select2({
                placeholder: 'Seleccione o Ingrese Autor',
                tags: true,               
            });

            $('#second_author_id').select2({
                placeholder: 'Seleccione o Ingrese Segundo Autor',
                tags: true,               
            });

            $('#third_author_id').select2({
                placeholder: 'Seleccione o Ingrese Tercer Autor',
                tags: true,               
            });

            $('#acquired').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: 'dd/mm/yyyy',                 
                language: 'es'
            });  

            $('#drop').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: 'dd/mm/yyyy',                
                language: 'es'
            }); 
            $('#published').select2({
                placeholder: 'Selecciona Lugar de Publicacíon',
                tags: true,               
            });
            $('#made_by').select2({
                placeholder: 'Selecciona una Editorial',
                tags: true,               
            });

            $('#year').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",                    
                language: 'es'
            });             
            $('#edition').select2({
                placeholder: 'Selecciona Número de Edición',
                tags: true,               
            });
            $('#volume').select2({
                placeholder: 'Selecciona un Volúmen',              
                tags: true,                                 
            });

            CKEDITOR.replace('synopsis');
            CKEDITOR.config.height = 190;

            if (document.getElementById("document_subtypes_id").value == 4) { //si es publ periodica
                //CAMBIO DE LABEL
                document.getElementById("l_subtitle").innerHTML = 'Tema de Portada';
                document.getElementById("l_generate_books_id").innerHTML = 'Genero';
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
                //CAMBIO DE LABEL
                document.getElementById("l_generate_books_id").innerHTML = 'Otros';
                }else{
                document.getElementById("l_generate_books_id").innerHTML = 'Genero';     
                }

                //CAMBIO DE LABEL
                document.getElementById("l_subtitle").innerHTML = 'Subtítulo';
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
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function (event) {
    event.preventDefault();

    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    for(instance in CKEDITOR.instances)
    {
        CKEDITOR.instances[instance].updateElement();
    }

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();
            $('#modal2').modal('show');

            // swal({
            //     type : 'success',
            //     title : '¡Éxito!',
            //     text : '¡Se han guardado los datos!'
            // });
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

$('body').on('click', '.btn-delete', function (event) {
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
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Los datos han sido eliminados!'
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


function yesnoCheck() {
    if (document.getElementById("document_subtypes_id").value == 4) { //si es publ periodica
        //CAMBIO DE LABEL
        document.getElementById("l_subtitle").innerHTML = 'Tema de Portada';
        document.getElementById("l_generate_books_id").innerHTML = 'Genero';
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
        //CAMBIO DE LABEL
        document.getElementById("l_generate_books_id").innerHTML = 'Otros';
        }else{
        document.getElementById("l_generate_books_id").innerHTML = 'Genero';     
        }

        //CAMBIO DE LABEL
        document.getElementById("l_subtitle").innerHTML = 'Subtítulo';
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



