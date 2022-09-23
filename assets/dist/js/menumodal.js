$(function () {
    var base_url = $('.base_url').data('baseurl');
    
    $('.tampilModalUbahMenu').on('click', function () {
        const id = $(this).data('id');

        $('#newMenuModalLabel').html('Edit Menu');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal-body form').attr('action', base_url + 'menu/updatemenu/' + id);

        $.ajax({
            url: base_url + 'menu/getupdatemenu',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#menu').val(data.menu);
            },
            error: function(request, status, error) {
                Swal.fire({
                    icon: 'error',
                    html: request.responseText
                });
            }
        });
    });

    $('.add-new-menu').on('click', function () {

        $('#newMenuModalLabel').html('Add New Menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', base_url + 'menu');

        $('#menu').val('');
    });
});