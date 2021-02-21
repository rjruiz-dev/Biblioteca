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


            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
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
            form.trigger('reset');
            $('#modal').modal('hide');
            // $('#datatable').DataTable().ajax.reload(null, false);

            swal({
                type: 'success',
                title: '¡Éxito!',
                text: '¡Se han guardado los datos!'
            });
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


// $('#modal-btn-save').click(function (event) {
//     event.preventDefault();

//     var form = $('#modal-body form'), 
//         url = form.attr('action'),     
//         method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

//     form.find('.help-block').remove();
//     form.find('.form-group').removeClass('has-error');

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//     });

//     $.ajax({
//         url : url + '?' + form.serialize(),
//         method: method,
//         data : formData, 
//         cache: false,  
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             form.trigger('reset');
//             $('#modal').modal('hide');
//             $('#datatable').DataTable().ajax.reload(null, false);

//             swal({
//                 type : 'success',
//                 title : '¡Éxito!',
//                 text : '¡Se han guardado los datos!'
//             });
//         },
//         error : function (xhr) {
//             var res = xhr.responseJSON;
//             if ($.isEmptyObject(res) == false) {
//                 $.each(res.errors, function (key, value) {
//                     $('#' + key)
//                         .closest('.form-group')
//                         .addClass('has-error')
//                         .append('<span class="help-block"><strong>' + value + '</strong></span>');
//                 });
//             }
//         }
//     })
// });