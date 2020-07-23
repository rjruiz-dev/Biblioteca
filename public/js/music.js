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
                placeholder: 'Selecciona un Subtipo',                  
            });

            $('#sound').select2({
                placeholder: 'Selecciona un Sonido',
                tags: true,               
            });
         
            $('#creators_id').select2({
                placeholder: 'Selecciona un Compositor',
                tags: true,               
            });

            $('#generate_subjects_id').select2({
                placeholder: 'Selecciona Referencia',
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
            $('#adequacies_id').select2({
                placeholder: 'Selecciona una Adecuación'               
            });
            $('#generate_formats_id').select2({
                placeholder: 'Selecciona un Formato'           
            });
            $('#generate_musics_id').select2({
                placeholder: 'Selecciona un Género'
            });
            $('#year').datepicker({
                autoclose: true,
                todayHighlight: true,  
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",                    
                language: 'es'
            });             
            $('#published').select2({
                placeholder: 'Selecciona Lugar de Edición',
                tags: true,               
            });
            $('#volume').select2({
                placeholder: 'Selecciona un Volúmen',              
                tags: true,                                 
            });
            $('#lenguages_id').select2({
                placeholder: 'Selecciona un Idioma'                                    
            });
             $('#generate_references_id').select2({
                placeholder: 'Selecciona una  o mas referencias'                                    
            });
            $('#made_by').select2({
                placeholder: 'Ingresar el Sello Discografico',
                tags: true,               
            });

            CKEDITOR.replace('synopsis');
            CKEDITOR.config.height = 190;  

            document.getElementById("culta").style.display = "block";
            document.getElementById("popular").style.display = "none";
            document.getElementById("l_title").innerHTML = 'Titulo de la obra';        
            document.getElementById("l_creators_id").innerHTML = 'Compositor';                
             
        }
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function (event) {
    event.preventDefault();

    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    for(instance in CKEDITOR.instances)
    {
        CKEDITOR.instances[instance].updateElement();
    }

    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();

            swal({
                type : 'success',
                title : '¡Éxito!',
                text : '¡Se han guardado los datos!'
            });
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

$('body').on('click', '.btn-btn-edit-user', function (event) {

    $('#dpassword_confirmation, #dpassword').css('display', 'inline');   

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
    if (document.getElementById("document_subtypes_id").value == 2) { // si es popular
        document.getElementById("popular").style.display = "block";
        document.getElementById("culta").style.display = "none";
        document.getElementById("l_title").innerHTML = 'Titulo';
        document.getElementById("l_creators_id").innerHTML = 'Artista';
    } else { // si es culta
        document.getElementById("culta").style.display = "block";
        document.getElementById("popular").style.display = "none";
        document.getElementById("l_title").innerHTML = 'Titulo de la obra';        
        document.getElementById("l_creators_id").innerHTML = 'Compositor';
    }
}
