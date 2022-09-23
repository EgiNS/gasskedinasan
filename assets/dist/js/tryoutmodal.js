$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");

  $(".tampilModalUbahTryout").on("click", function () {
    const id = $(this).data("id");
    $("#newTryoutModalLabel").html("Edit Tryout");
    $(".modal-footer button[type=submit]").html("Update");
    $(".modal-body form").attr("action", base_url + "admin/updatetryout/" + id);
    $.ajax({
      url: base_url + "admin/getupdatetryout",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: (data) => {
        $("#tryout").val(data.name);
        $("#tryout").prop("disabled", true);
        tinymce.init({
          selector: "textarea",
          plugins: "autolink lists table lists",
          toolbar: "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
          toolbar_mode: "floating",
          tinycomments_mode: "embedded",
          tinycomments_author: "Author name",
          setup: (editor) => {
            editor.on("init", (e) => {
              editor.setContent(data.keterangan);
            });
          },
        });

        $("#tipe_tryout").prop("disabled", true);
        $("#lama_pengerjaan").val(data.lama_pengerjaan);

        $("#jumlah_soal").attr("disabled", true);
        $("#jumlah_soal").val(data.jumlah_soal);

        if (data.tipe_tryout == "SKD") {
          $("#tipe_tryout option[value=SKD]").prop("selected", true);
          if (data.paid == 1) {
            $("#berbayar").prop("checked", true);
            $("#harga").removeAttr("disabled");
            $("#harga").val(data.harga);
          } else {
            $("#berbayar").prop("checked", false);
            $("#harga").attr("disabled", true);
            $("#harga").val("");
          }
        } else if (data.tipe_tryout == "nonSKD") {
          $("#tipe_tryout option[value=nonSKD]").prop("selected", true);
          if (data.paid == 1) {
            $("#berbayar").prop("checked", true);
            $("#harga").removeAttr("disabled");
            $("#harga").val(data.harga);
          } else {
            $("#berbayar").prop("checked", false);
            $("#harga").attr("disabled", true);
            $("#harga").val("");
          }
        }
      },
    });
  });

  // $(".add-new-tryout").on("click", function () {
  //   $("#newTryoutModalLabel").html("Add New Tryout");
  //   $(".modal-footer button[type=submit]").html("Add");
  //   $(".modal-body form").attr("action", base_url + "admin/tryout");
  //   $("#tipe_tryout option[value=0]").prop("selected", true);
  //   $("#ket_tryout").html("");
  //   $(".jumlah_soal").hide();
  //   $("#jumlah_soal").val("");
  //   $("#lama_pengerjaan").val("");
  //   $("#jumlah_soal").prop("disabled", false);
  //   $("#berbayar").prop("checked", false);
  //   $("#harga").attr("disabled", true);
  //   $("#harga").val("");
  //   $("#tryout").prop("disabled", false);
  //   $("#tryout").val("");
  // });

  $(".jumlah_soal").hide();
  $("#tipe_tryout").change(function () {
    var tipe_tryout = $("#tipe_tryout").val();
    $(".jumlah_soal").show();
    $("#tipe_tryout").prop("disabled", false);

    if (tipe_tryout == "SKD") {
      $("#jumlah_soal").val("110");
      $("#lama_pengerjaan").attr("placeholder", "rekomendasi SKD: 100 menit");
      $("#jumlah_soal").prop("disabled", true);
    } else {
      $("#jumlah_soal").val("");
      $("#lama_pengerjaan").val("");
      $("#lama_pengerjaan").attr("placeholder", "Misal: 100");
      $("#jumlah_soal").prop("disabled", false);
    }
  });

  $("#berbayar").change(function () {
    const berbayar = $("#berbayar");
    if (berbayar.is(":checked")) {
      $("#harga").removeAttr("disabled");
    } else {
      $("#harga").attr("disabled", true);
    }
  });
});
