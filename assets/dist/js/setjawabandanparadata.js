$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");
  var tryout = $("#tryout").data("tryout");

  $(".input").on("click", function () {
    var pilihan = $(this).data("pilihan");
    var nomor = $(this).data("nomor");
    var user_id = $("#user_id").data("userid");
    $.ajax({
      url: base_url + "exam/setinput/" + tryout,
      type: "post",
      data: {
        pilihan: pilihan,
        nomor: nomor,
        user_id: user_id,
      },
    });
  });

  $("#kosong").on("click", function () {
    $('input[name="pilihan"]').prop("checked", false);
    var nomor = $(this).data("nomor");
    var user_id = $("#user_id").data("userid");

    $.ajax({
      url: base_url + "exam/setinput/" + tryout,
      type: "post",
      data: {
        pilihan: null,
        nomor: nomor,
        ket: "K",
        user_id: user_id,
      },
    });
  });

  $("#ragu-ragu").on("click", function () {
    var nomor = $(this).data("nomor");
    if (document.getElementById("ragu-ragu").innerHTML == "Ragu-Ragu") {
      $("#ragu-ragu").html("Yakin");
      $("#ragu-ragu").removeClass("btn btn-warning mt-3");
      $("#ragu-ragu").addClass("btn btn-light mt-3");
      var user_id = $("#user_id").data("userid");
      $.ajax({
        url: base_url + "exam/setinput/" + tryout,
        type: "post",
        data: {
          nomor: nomor,
          ket: "R",
          user_id: user_id,
        },
      });
    } else {
      $("#ragu-ragu").html("Ragu-Ragu");
      $("#ragu-ragu").removeClass("btn btn-light mt-3");
      $("#ragu-ragu").addClass("btn btn-warning mt-3");
      var user_id = $("#user_id").data("userid");
      $.ajax({
        url: base_url + "exam/setinput/" + tryout,
        type: "post",
        data: {
          nomor: nomor,
          ket: "Y",
          user_id: user_id,
        },
      });
    }
  });
});
