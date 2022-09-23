$(function () {
    var base_url = $('.base_url').data('baseurl');

    $('.access-menu').on('click', function() {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: base_url + 'admin/menuchangeaccess',
        type: 'post',
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function() {
            document.location.href = base_url+ 'admin/roleaccess/' + roleId;
        },
        error: function(request, status, error) {
            Swal.fire({
                icon: 'error',
                html: request.responseText
            });
        }
    });
});

$('.access-sub-menu').on('click', function() {
    const roleId = $(this).data('role');
    const subMenuId = $(this).data('submenu');
    const menuId = $(this).data('menu');

    $.ajax({
        url: base_url + 'admin/submenuchangeaccess',
        type: 'post',
        data: {
            roleId: roleId,
            menuId: menuId,
            subMenuId: subMenuId
        },
        success: function() {
            document.location.href = base_url+ 'admin/roleaccess/' + roleId;
        },
        error: function(request, status, error) {
            Swal.fire({
                icon: 'error',
                html: request.responseText
            });
        }
    });
});
});