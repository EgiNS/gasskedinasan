$(function () {
  var base_url = $(".base_url").data("baseurl");
  $(".tampilModalUbahRole").on("click", function () {
    const id = $(this).data("id");

    $("#newRoleModalLabel").html("Edit Role");
    $(".modal-footer button[type=submit]").html("Update");
    $(".modal-body form").attr("action", base_url + "admin/updaterole/" + id);

    $.ajax({
      url: base_url + "admin/getupdaterole",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#role").val(data.role);
      },
      error: function (request, status, error) {
        Swal.fire({
          icon: "error",
          html: request.responseText,
        });
      },
    });
  });

  $(".tampilModalUbahRole").on("click", function () {
    const id = $(this).data("id");

    $("#newRoleModalLabel").html("Edit Role");
    $(".modal-footer button[type=submit]").html("Update");
    $(".modal-body form").attr("action", base_url + "admin/updaterole/" + id);

    $.ajax({
      url: base_url + "admin/getupdaterole",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#role").val(data.role);
      },
      error: function (request, status, error) {
        Swal.fire({
          icon: "error",
          html: request.responseText,
        });
      },
    });
  });

  $(".add-new-role").on("click", function () {
    $("#newRoleModalLabel").html("Add New Role");
    $(".modal-footer button[type=submit]").html("Add");
    $(".modal-body form").attr("action", base_url + "admin/role");

    $("#role").val("");
  });

  $(".updateuserrole").on("click", function () {
    const id = $(this).data("id");
    $.ajax({
      url: base_url + "admin/getupdateuserrole",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#name").val(data.name);
        $("#email").val(data.email);
        $("#role_id").val(data.role_id);
      },
      error: function (request, status, error) {
        Swal.fire({
          icon: "error",
          html: request.responseText,
        });
      },
    });
  });
});
