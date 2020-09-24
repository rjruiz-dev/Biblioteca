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
                placeholder: 'Selecciona un subtipo de Documento',
                dropdownParent: $('#modal')                        
            });
            $('#periodicities_id').select2({
                placeholder: 'Selecciona una periodicidad',
                dropdownParent: $('#modal')
            });
             $('#lenguages_id').select2({
                placeholder: 'Selecciona un Idioma',
                dropdownParent: $('#modal')                                       
            });
             $('#adequacies_id').select2({
                placeholder: 'Selecciona una Adecuación', 
                dropdownParent: $('#modal')                       
            });
 
            $('#generate_books_id').select2({
                placeholder: 'Selecciona un Género',
                dropdownParent: $('#modal')                            
            });
             $('#generate_subjects_id').select2({
                placeholder: 'Selecciona Cdu',
                dropdownParent: $('#modal')                    
            });
           
            $('#creators_id').select2({
                placeholder: 'Seleccione o Ingrese Autor',
                tags: true,
                dropdownParent: $('#modal')             
            });

            $('#second_author_id').select2({
                placeholder: 'Seleccione o Ingrese Segundo Autor',
                tags: true,
                dropdownParent: $('#modal')             
            });

            $('#third_author_id').select2({
                placeholder: 'Seleccione o Ingrese Tercer Autor',
                tags: true, 
                dropdownParent: $('#modal')             
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
                // placeholder: 'Selecciona Lugar de Publicacíon',
                tags: true,
                dropdownParent: $('#modal')          
            });
            $('#made_by').select2({
                placeholder: 'Selecciona una Editorial',
                tags: true,
                dropdownParent: $('#modal')             
            });

            $('#year').datepicker({
                autoclose: true,             
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",                    
                language: 'es'
            });             
            $('#edition').select2({
                placeholder: 'Selecciona Número de Edición',
                tags: true,
                dropdownParent: $('#modal')             
            });
            $('#volume').select2({
                placeholder: 'Selecciona un Volúmen',              
                tags: true,
                dropdownParent: $('#modal')                               
            });

            $('#status_documents_id').select2({
                // placeholder: 'Selecciona un Volúmen',              
                tags: false,
                dropdownParent: $('#modal')                             
            });

            $('#references').select2({
                tags: false,
               
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

    // $avatarInput = $('#photo');

    // var formData  = new FormData();        
    //     formData.append('photo', $avatarInput[0].files[0]);
        

    var form = $('#modal-body form'),
        url = form.attr('action'),
        // method =  'POST' ;
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    // for(instance in CKEDITOR.instances)
    // {
    //     CKEDITOR.instances[instance].updateElement();
    // }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });


    $.ajax({
        url : url + '?' + form.serialize(),
        method: method,
        // data : formData, 
        cache: false,  
        processData: false,
        contentType: false,    
        success: function (response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();
                swal({
                    type : 'success',
                    title : '¡Éxito!',
                    text : '¡Se ha guardado los datos correctamente!'
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

$('body').on('click', '.btn-delete', function (event) { // nose usa pero se deja xq es dinamico y puede servir. Rodri salaminnn jajjaj
    event.preventDefault();
   
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

        console.log("url:sdfdsf " + url)

        if(title == 'Baja'){
            title_noti = 'dar de baja';
            title_noti_fin = 'dado de baja';
        }else{
            title_noti = 'reactivar';
            title_noti_fin = 'reactivado';
        }
    swal({
        
        title: '¿Seguro que quieres ' + title_noti + ' el lenguaje ?',
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
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Se ha el '+ title_noti_fin +' el lenguaje!'
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

// $('body').on('click', '.btn-delete', function (event) {
//     event.preventDefault();
   
//     var me = $(this),
//         url = me.attr('href'),
//         title = me.attr('title'),
//         csrf_token = $('meta[name="csrf-token"]').attr('content');

//     swal({
//         title: '¿Seguro que quieres eliminar a : ' + title + ' ?',
//         text: '¡No podrás revertir esto!',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Sí, bórralo!'
//     }).then((result) => {
//         if (result.value) {
//             $.ajax({
//                 url: url,
//                 type: "POST",
//                 data: {
//                     '_method': 'DELETE',
//                     '_token': csrf_token
//                 },
//                 success: function (response) {
//                     $('#datatable').DataTable().ajax.reload();
//                     swal({
//                         type: 'success',
//                         title: '¡Éxito!',
//                         text: '¡Los datos han sido eliminados!'
//                     });
//                 },
//                 error: function (xhr) {
//                     swal({
//                         type: 'error',
//                         title: 'Ups...',
//                         text: '¡Algo salió mal!'
//                     });
//                 }
//             });
//         }
//     });
// });

$('body').on('click', '.btn-copy', function (event) {
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
                success: function (response) {
                    var info = response.data;
                    console.log("asdas".info);
                    if(info == 0){
                        swal({
                            type: 'warning',
                            title: '¡Atencion! Este documento esta dado de baja',
                            text: 'Para ver sus copias, debe estar activo o en desidherata'
                        }); 
                    }else{
                        window.location="/admin/genericcopies/copies/" + info;
                    }
                    
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Ups...',
                        text: '¡Algo salió mal!'
                    });
                }
            });
        
});

$('body').on('click', '.btn-desidherata', function (event) {
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
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡El documento se ha puesto en desidherata!'
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

$('body').on('click', '.btn-baja', function (event) {
    event.preventDefault();
   
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
      
    swal({
        
        title: '¿Seguro que quieres dar de baja el documento ?',
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
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Se ha dado de baja el documento!'
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

$('body').on('click', '.btn-reactivar', function (event) {
    event.preventDefault();
   
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
      
    swal({
        
        title: '¿Seguro que quieres reactivar el documento ?',
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
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Se ha reactivado el documento!'
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

  
    // if (document.getElementById("document_subtypes_id").value == '4') { //si es publ periodica
     
    //     //FORM GROUP MOSTRAR
      
    //     document.getElementById("ls_tema").style.display = "block";
     

    // } else { //si NOO es publ periodica
        
       
    //      //FORM GROUP NO MOSTRAR
       
    //     document.getElementById("ls_tema").style.display = "none";
      
    // }

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



