$(document).ready(function () {
  const jumlahSoal = $("#jumlahsoal").data("jumlahsoal");

  // AGAR DUA MODAL DAPAT DIGUNAKAN PADA SATU KASUS DAN HANYA BERLAKU PADA BOOTSTRAP 4
  $.fn.modal.Constructor.prototype._enforceFocus = function () {};

  $("#addbobotsekaligus").on("click", function () {
    var awal = $("#awal").val();
    var akhir = $("#akhir").val();
    var bobotA = $("#bobotsekaligusA").val();
    var bobotB = $("#bobotsekaligusB").val();
    var bobotC = $("#bobotsekaligusC").val();
    var bobotD = $("#bobotsekaligusD").val();
    var bobotE = $("#bobotsekaligusE").val();

    if (awal == "") swalerror("Nomor awal wajib diisi.");
    else if (akhir == "") swalerror("Nomor akhir wajib diisi.");
    else if (awal < 1) swalerror("Nomor awal tidak boleh kurang dari 1.");
    else if (awal > jumlahSoal) swalerror("Nomor awal melebihi jumlah soal.");
    else if (akhir > jumlahSoal) swalerror("Nomor akhir melebihi jumlah soal.");
    else if (awal > akhir) swalerror("Nomor awal tidak boleh lebih dari nomor akhir.");
    else if (bobotA == "" || bobotB == "" || bobotC == "" || bobotD == "" || bobotE == "") swalerror("Lengkapi semua bobot terlebih dahulu.");
    else {
      const pilihan = ["A", "B", "C", "D", "E"];
      const bobot = [bobotA, bobotB, bobotC, bobotD, bobotE];

      for (let i = awal; i <= akhir; i++) {
        for (let j = 0; j < pilihan.length; j++) {
          $("#" + i + pilihan[j]).val(bobot[j]);
          $("#" + i + pilihan[j]).addClass("filled");
        }
      }
      $(".bobot-tiap-jawaban").each(function () {
        if ($(this).hasClass("filled")) {
          $(this).removeClass("border border-danger");
          $(this).addClass("border border-success");
        } else {
          $(this).removeClass("border border-success");
          $(this).addClass("border border-danger");
        }
      });
    }
  });

  function swalerror($message) {
    Swal.fire({
      icon: "error",
      html: $message,
    });
  }

  $(".updatebobot").on("click", function () {
    if ($("#kustombobottiapsoal").is(":checked"))
      if ($(".border-danger").length) swalerror("Lengkapi semua bobot terlebih dahulu.");
      else $("#formbobotnilai").submit();
    else {
      var bobotbenar = $("#bobotbenar").val();
      var bobotsalah = $("#bobotsalah").val();

      if (bobotbenar == "" || bobotsalah == "") swalerror("Lengkapi kedua bobot terlebih dahulu.");
      else $("#formbobotnilai").submit();
    }
  });

  $("#kustombobottiapsoal").change(function () {
    if ($("#kustombobottiapsoal").is(":checked")) {
      $(".bobotsemuasoal").addClass("d-none");
      $(".bobotsetiapsoal").removeClass("d-none");
    } else {
      $(".bobotsemuasoal").removeClass("d-none");
      $(".bobotsetiapsoal").addClass("d-none");
    }
  });

  if ($("#kustombobottiapsoal").is(":checked")) {
    $(".bobotsemuasoal").addClass("d-none");
    $(".bobotsetiapsoal").removeClass("d-none");
  } else {
    $(".bobotsemuasoal").removeClass("d-none");
    $(".bobotsetiapsoal").addClass("d-none");
  }

  $(".bobot-tiap-jawaban").each(function () {
    $(this).on("input", function () {
      if ($(this).val() == "") {
        $(this).removeClass("border border-success");
        $(this).addClass("border border-danger");
      } else {
        $(this).removeClass("border border-danger");
        $(this).addClass("border border-success");
      }
    });
  });

  $("#lock-bobot").on("click", function (e) {
    e.preventDefault(); //Mematikan href
        $("#bobotSoalModal").modal("hide");
    const admin_kode = $(this).data("kode");
    Swal.fire({
      title: "<b>Perhatian!</b>",
      icon: "info",
      html: "<b>Tidak disarankan untuk melakukan perubahan pada bobot nilai saat tryout sudah di-release dan sudah ada peserta yang mengerjakan.</b>",
      focusConfirm: false,
      confirmButtonText: "OK",
    }).then((result) => {
      if (result.isConfirmed) {
        kode();
      }
    });

    function kode() {
      Swal.fire({
        title: "Masukkan Kode",
        html: `<input type="text" id="kode" class="swal2-input" placeholder="Enter kode" autocomplete="off">`,
        confirmButtonText: "Enter",
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
          const kode = Swal.getPopup().querySelector("#kode").value;
          // const password = Swal.getPopup().querySelector('#password').value
          if (!kode) {
            Swal.showValidationMessage(`Silakan masukkan kode`);
          } else if (kode == admin_kode) {
            $("#lock-bobot").addClass("d-none");
            $(".unlock-bobot").removeClass("d-none");
            $("form button[type=button], input[type=number], input[type=checkbox]").removeAttr("disabled");
                    setTimeout(() => {
          $("#bobotSoalModal").modal("show");
        }, 200); 
          } else {
            Swal.showValidationMessage(`Kode salah`);
          }
          return { kode: kode };
        },
      });
    }
  });

  $(".unlock-bobot").on("click", function () {
    $("form button[type=button], input[type=number], input[type=checkbox]").attr("disabled", true);
    $("#lock-bobot").removeClass("d-none");
    $(".unlock-bobot").addClass("d-none");
  });
});
