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

            $('#copy_id').select2({
                placeholder: 'Selecciona un Numero de Copia',
                tags: false                 

            });

            var user_idSelect = $('#user_id');
            var nickname = $('#nickname');
            var name = $('#name');
            var surname = $('#surname');
            var email = $('#email');   
            var phone = $('#phone');
            var address = $('#address');
            var postcode = $('#postcode');
            var city = $('#city');         
            var province = $('#province');         
            var csrf_token = $('meta[name="csrf-token"]').attr('content');    
            console.log (user_idSelect);
            user_idSelect.on('change', function() {
                console.log ('la compañía ha cambiado');
                var id = $(this).val();
                console.log('id del Partner seleccionado: ' + id);
                obtenerDetalleDePartner(id)
               
            });
            
            function obtenerDetalleDePartner(id) {
                $.ajax({                    
                    url: '/admin/loanmanual/showPartner/' + id,
                    type: 'GET',
                    data: {            
                        '_token': csrf_token
                    },
                    dataType: 'json',
                    success: function (response) {
                        // acá podés loguear la respuesta del servidor
                        console.log(response);
                        // le pasás la data a la función que llena los otros inputs
                        llenarInputs(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle de la Compañía!');
                    }
                })
            }
           
            function llenarInputs(data) {                
                // nickname.val(data.nickname);
                // name.val(data.name);
                // surname.val(data.surname);
                // email.val(data.email);   
                // phone.val(data.phone);
                // address.val(data.address);
                // postcode.val(data.postcode);
                // city.val(data.city);         
                // province.val(data.province);        
                
                nickname.val(data.user.nickname);
                name.val(data.user.name);
                surname.val(data.user.surname);
                email.val(data.user.email);   
                phone.val(data.user.phone);
                address.val(data.user.address);
                postcode.val(data.user.postcode);
                city.val(data.user.city);         
                province.val(data.user.province);        
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
