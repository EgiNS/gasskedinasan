$(document).ready(function () {
  var cek_pilihan = $("#cek_pilihan").val();
  if (cek_pilihan == "1") {
    // SETIAP PILIHAN JAWABAN DALAM BENTUK TEKS
    $(".pilihan_text").show();
    $(".gbr_pilihan").hide();
  } else if (cek_pilihan == "2") {
    // SETIAP PILIHAN JAWABAN DALAM BENTUK GAMBAR
    $(".pilihan_text").hide();
    $(".gbr_pilihan").show();
  }

  const ceksoal = $("#cek_soal");

  if (ceksoal.is(":checked"))
    // SOAL DALAM BENTUK GAMBAR
    $(".gbr_soal").show();
  // SOAL DALAM BENTUK TEKS SAJA
  else $(".gbr_soal").hide();

  var cek_tipe = $("#tipe_soal").val();
  if (cek_tipe == "3") {
    // UNTUK TIPE SOAL TKP
    $(".nilai_tkp").show();
    $("#kunci_jawaban").hide();
  } else {
    // UNTUK TIPE SOAL TWK DAN TIU
    $(".nilai_tkp").hide();
    $("#kunci_jawaban").show();
  }

  const cekpembahasan = $("#cek_pembahasan");
  if (cekpembahasan.is(":checked")) {
    $(".gbr_pembahasan").show();
    $("#pembahasan_soal").attr("placeholder", "Tulis keterangan pembahasan soal...");
  } else {
    $(".gbr_pembahasan").hide();
    $("#pembahasan_soal").attr("placeholder", "Tulis pembahasan...");
  }

  $("#cek_kunci").on("click", function () {
    if ($("#cek_kunci").is(":checked")) $(".kunci_jawaban").addClass("d-none");
    else $(".kunci_jawaban").removeClass("d-none");
  });

  if ($("#cek_kunci").is(":checked")) $(".kunci_jawaban").addClass("d-none");
  else $(".kunci_jawaban").removeClass("d-none");
});

$("#cek_pilihan").change(function () {
  var cek_pilihan = $("#cek_pilihan").val();

  if (cek_pilihan == "1") {
    $(".pilihan_text").show();
    $(".gbr_pilihan").hide();
  } else if (cek_pilihan == "2") {
    $(".pilihan_text").hide();
    $(".gbr_pilihan").show();
  }
});

function soalcek() {
  const ceksoal = $("#cek_soal");
  if (ceksoal.is(":checked")) {
    $(".gbr_soal").show();
    // $('#text_soal').attr('placeholder', 'Tulis keterangan soal...');
    $("#text_soal").attr("placeholder", "Tulis keterangan soal...");
  } else {
    $(".gbr_soal").hide();
    $("#text_soal").attr("placeholder", "Tulis soal...");
  }
}

function pembahasancek() {
  const cekpembahasan = $("#cek_pembahasan");
  if (cekpembahasan.is(":checked")) {
    $(".gbr_pembahasan").show();
    $("#pembahasan_soal").attr("placeholder", "Tulis keterangan pembahasan soal...");
  } else {
    $(".gbr_pembahasan").hide();
    $("#pembahasan_soal").attr("placeholder", "Tulis pembahasan...");
  }
}

$("#tipe_soal").change(function () {
  var cek_tipe = $("#tipe_soal").val();
  if (cek_tipe == "3") {
    $(".nilai_tkp").show();
    $("#kunci_jawaban").hide();
  } else {
    $(".nilai_tkp").hide();
    $("#kunci_jawaban").show();
  }
});
