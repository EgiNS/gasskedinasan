$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");

  $(".tampilModalUbahSubMenu").on("click", function () {
    const id = $(this).data("id");

    $("#newSubMenuModalLabel").html("Edit Sub Menu");
    $(".modal-footer button[type=submit]").html("Update");
    $(".modal-body form").attr("action", base_url + "menu/updatesubmenu/" + id);
    $("#menu_id").attr("disabled", true);
    $("#url").attr("disabled", true);

    $.ajax({
      url: base_url + "menu/getupdatesubmenu",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        // console.table(id);
        $("#title").val(data.title);
        $("#menu_id").val(data.menu_id);
        $("#url").val(data.url);
        $("#icon").val(data.icon);
        if (data.is_active == 1) $("#is_active").prop("checked", true);
        else $("#is_active").prop("checked", false);
      },
      error: function (request, status, error) {
        Swal.fire({
          icon: "error",
          html: request.responseText,
        });
      },
    });
  });

  $(".add-new-sub-menu").on("click", function () {
    $("#newSubMenuModalLabel").html("Add New Sub Menu");
    $(".modal-footer button[type=submit]").html("Add");
    $(".modal-body form").attr("action", base_url + "menu/submenu");
    $("#menu_id").removeAttr("disabled", true);
    $("#url").removeAttr("disabled", true);

    $("#title").val("");
    $("#menu_id").val("");
    $("#url").val("");
    $("#icon").val("");
    $("#is_active").prop("checked", true);
  });
});
