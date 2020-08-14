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

            $('#lenguages_id').select2({
                placeholder: 'Selecciona un Idioma',
                                 
            });

            $('#generate_references_id').select2({
                placeholder: 'Selecciona o Ingrese un Referencia',
               
            });

            $('#generate_subjects_id').select2({
                placeholder: 'Selecciona Cdu',
                                        
            });

            $('#photography_movies_id').select2({
                placeholder: 'Seleccione o Ingrese un Tipo de Fotografia',                  
            });

            $('#generate_formats_id').select2({
                placeholder: 'Seleccione un Formato',
                             
            });

            $('#generate_films_id').select2({
                placeholder: 'Seleccione un Género',
                    
            });

            $('#actors').select2({
                tags: true
            });

            $('#references').select2({
                tags: false,
               
            });
            
            $('#distributor').select2({
                placeholder: 'Seleccione o Ingrese una Distribuidora',
                tags: true,               
            }); 

            $('#status_documents_id').select2({
                // placeholder: 'Seleccione o Ingrese una Distribuidora',
                tags: false,               
            });

            $('#adequacies_id').select2({
                placeholder: 'Selecciona una Adecuación',                        
            });

            $('#adaptations_id').select2({
                placeholder: 'Tiene adaptacion ?',
                tags: false,               
            });
            $('#published').select2({
                placeholder: 'Selecciona Nacionalidad',
                tags: true,               
            });
            $('#made_by').select2({
                placeholder: 'Selecciona una Productora',
                tags: true,               
            });
            $('#document_subtypes_id').select2({
                placeholder: 'Selecciona un subtipo de Documento',
                tags: true,               
            });
            $('#creators_id').select2({
                placeholder: 'Seleccione o Ingrese un Director',
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
        }
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function (event) {
    event.preventDefault();

    $avatarInput = $('#photo');

    var formData  = new FormData();        
        formData.append('photo', $avatarInput[0].files[0]);
        

    var form = $('#modal-body form'),
        url = form.attr('action'),
        method =  'POST' ;
        // method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    for(instance in CKEDITOR.instances)
    {
        CKEDITOR.instances[instance].updateElement();
    }

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
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();

            var id_new_doc = response.data;
            var bandera = response.bandera;

            console.log("id: " + id_new_doc);
            console.log("bandera: " + bandera);
            if (bandera == 1){
                swal({
                    type : 'success',
                    title : '¡Éxito!',
                    text : '¡Se han guardado el documento! Ahora debe registrar las copias del mismo',
                }).then(function() {
                    window.location = "../admin/genericcopies/copies/" + id_new_doc;
                });
            }else{
                swal({
                    type : 'success',
                    title : '¡Éxito!',
                    text : '¡Se ha actualizado el documento!'
                });
            }
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
    if (document.getElementById("document_subtypes_id").value == 3) {
        document.getElementById("popular").style.display = "block";
        document.getElementById("culta").style.display = "none";
    } else {
        document.getElementById("culta").style.display = "block";
        document.getElementById("popular").style.display = "none";
    }
}
