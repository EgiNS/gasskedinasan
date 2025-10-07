$(function () {
  // Set the date we're counting down to
  var base_url = $(".base_url").data("baseurl");
  var tryout = $("#tryout").data("tryout");

  // HANYA BERLAKU PADA HALAMAN PENGERJAAN SOAL TRYOUT
  if ($(".timer").length) {
    var waktu = $("#time").data("waktu");
    var countDownDate = new Date(waktu).getTime();

    var x = setInterval(function () {
      now_php = $("#now").data("waktu");

      var now = new Date(now_php).getTime();

      var distance = countDownDate - now;

      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementsByClassName("timer")[0].innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

      // LAKUKAN RELOAD PADA CLASS WAKTU SEKARANG UNTUK MENGHINDARI USER MENGUBAH ZONA WAKTU
      $(".now").load(location.href + " .now");

      if (distance < 0) {
        clearInterval(x);
        document.getElementsByClassName("timer")[0].innerHTML = "Waktu Habis";
        $.ajax({
          url: base_url + "exam/setselesai/" + tryout,
          type: "post",
          data: {
            selesai: "sudah",
          },
          success: function () {
            window.location.replace(base_url + "tryout/mytryout");
          },
        });
      }
      // SETIAP 1000 MILISECONDS ATAU SETIAP DETIK
    }, 1000);
  }

  $(".kerjakan").on("click", function (e) {
    e.preventDefault(); //Mematikan href
    const slug = $(this).data("slug");
    console.log("kerja")
    validasi(slug);
    // const user_token = $(this).data("token");
    // const slug = $(this).data("slug");
    // token();
    // function token() {
    //   Swal.fire({
    //     title: "Masukkan Token",
    //     html: `<input type="text" id="token" class="swal2-input" placeholder="Enter Token" autocomplete="off">`,
    //     confirmButtonText: "Enter",
    //     showCancelButton: true,
    //     focusConfirm: false,
    //     preConfirm: () => {
    //       const token = Swal.getPopup().querySelector("#token").value;
    //       // const password = Swal.getPopup().querySelector('#password').value
    //       if (!token) {
    //         Swal.showValidationMessage(`Silakan masukkan token`);
    //       } else if (token == user_token) {
    //         validasi(slug);
    //       } else {
    //         Swal.showValidationMessage(`Token salah`);
    //       }
    //       return { token: token };
    //     },
    //   });
    //   // .then((result) => {
    //   //   if(result.value.token == tryout_token) {
    //   //     validasi();
    //   //   } else {
    //   //     token();
    //   //     Swal.showValidationMessage(`Token salah`);
    //   //   }
    //   // })
    // }

    function validasi(slug) {
      Swal.fire({
        title: "Apakah Anda Yakin",
        html: "<b>untuk mengerjakan Tryout sekarang ?</b>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Kerjakan!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: base_url + "exam/setkerjakan/" + slug,
            type: "post",
            success: function () {
              document.location.href = base_url + "exam/question" + "?tryout=" + slug;
            },
          });
        }
      });
    }
  });

  $(".selesai").on("click", function (e) {
    const tryout = $(this).data("tryout");
    const kosong = $(".btn-danger").length;
    if (document.getElementById("ragu-ragu").innerHTML != "Ragu-Ragu") {
      ragu_ragu = $(".btn-warning").length;
    } else {
      ragu_ragu = $(".btn-warning").length - 1;
    }
    // const ragu_ragu = $('.btn-warning').length - 1;

    if (kosong == 0 && ragu_ragu == 0) var pesan = "";
    else if (kosong == 0) var pesan = '<b style="color: red;">Masih ada ' + ragu_ragu + " soal ragu-ragu</b>";
    else if (ragu_ragu == 0) var pesan = '<b style="color: red;">Masih ada ' + kosong + " soal belum dijawab</b>";
    else var pesan = '<b style="color: red;">Masih ada ' + kosong + " soal belum dijawab dan " + ragu_ragu + " ragu-ragu</b>";

    e.preventDefault();
    Swal.fire({
      title: "Apakah Anda Yakin",
      html: "<b>untuk menyelesaikan Tryout sekarang ?</b><br>" + pesan,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Selesai!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: base_url + "exam/setselesai/" + tryout,
          type: "post",
          data: {
            selesai: "sudah",
          },
          success: function () {
            window.location.replace(base_url + "tryout/mytryout");
          },
        });
      }
    });
  });
});

// TOGGLE PETA SOAL PADA MOBILE VIEW
const hamburgerMenu = document.querySelector(".hamburger");
const menuIsActive = () => {
  hamburgerMenu.classList.toggle("active");
  if ($(".hamburger").hasClass("active")) {
    $(".petasoal").removeClass("petasoal-vis");
    $(".petasoal").removeAttr("style");
  } else {
    $(".petasoal").css("visibility", "hidden");
    $(".petasoal").css("clear", "both");
    $(".petasoal").css("float", "left");
    $(".petasoal").css("display", "none");
  }
};
if (hamburgerMenu) {
  hamburgerMenu.addEventListener("click", menuIsActive);
}
