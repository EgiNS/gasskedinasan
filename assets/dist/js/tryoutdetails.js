$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");
  var daftarTryoutBtn = $(".daftar-tryout");

  $(daftarTryoutBtn).on("click", function () {
    $(this).html('<span class="spinner-border spinner-border-sm"></span>');
  });

  $(".blink").on({
    mouseenter: function () {
      //stuff to do on mouse enter
      $(this).removeClass("blink");
    },
    mouseleave: function () {
      //stuff to do on mouse leave
      $(this).addClass("blink");
    },
  });

  $("#pay-success").click(function () {
    Swal.fire({
      icon: "error",
      html: "Anda sudah melakukan pendaftaran dan pembayaran pada tryout ini.",
    });
    daftarTryoutBtn.html("Daftar Tryout");
  });

  $(".more").click(function () {
    Swal.fire({
      icon: "info",
      html: "Silakan lakukan pendaftaran dengan menekan tombol <b>Daftar Tryout</b>.",
    });
  });

  $("#pay-failed").click(function () {
    Swal.fire({
      icon: "error",
      html: "Anda sudah melakukan pendaftaran sebelumnya. Silakan selesaikan pembayaran anda sebelum batas waktu berakhir.<br/><br/>Jika anda ingin mengubah metode pembayaran, silakan lakukan pembatalan transaksi pada menu <b>Payment List</b>.",
    });

    daftarTryoutBtn.html("Daftar Tryout");
  });

  $("#free-pay").click(function () {
    var tryout = $(this).data("tryout");
    var slug = $(this).data("slug");
    var email = $(this).data("email");
    $("#exampleModal").modal("hide");
    Swal.fire({
      title: "Apakah Anda Yakin",
      html: '<b>untuk melakukan pendaftaran <span style="color: red;">' + tryout + "</span> ?</b>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Daftar!",
    }).then((result) => {
      if (result.isConfirmed) {
        // document.location.href = base_url + url + key;
        $.ajax({
          url: base_url + "tryout/free/" + slug,
          type: "post",
          data: {
            email: email,
          },
          success: function () {
            daftarTryoutBtn.html("Daftar Tryout");
            console.log("success");
            window.location.reload();
          },
          error: function (request, status, error) {
            daftarTryoutBtn.html("Daftar Tryout");
            Swal.fire({
              icon: "error",
              html: request.responseText ? request.responseText : "Oops, something went wrong. Please try again later.",
            });
          },
        });
      }
    });

    daftarTryoutBtn.html("Daftar Tryout");
  });

  $("#pay-button").click(function (event) {
    event.preventDefault();
    $(this).attr("disabled", "disabled");
    var harga = $(this).data("harga");
    var tryout = $(this).data("tryout");
    var name = $(this).data("name");
    var email = $(this).data("email");
    var phone = $(this).data("phone");
    $.ajax({
      url: base_url + "midtrans/snap/token",
      cache: false,
      type: "POST",
      data: {
        harga: harga,
        tryout: tryout,
        name: name,
        email: email,
        phone: phone,
      },
      success: function (data) {
        //location = data;
        daftarTryoutBtn.html("Daftar Tryout");
        console.log("token = " + data);

        var resultType = document.getElementById("result-type");
        var resultData = document.getElementById("result-data");

        function changeResult(type, data) {
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          onSuccess: function (result) {
            changeResult("success", result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function (result) {
            changeResult("pending", result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function (result) {
            changeResult("error", result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
        });
      },
      error: function (request, status, error) {
        daftarTryoutBtn.html("Daftar Tryout");
        Swal.fire({
          icon: "error",
          html: request.responseText ? request.responseText : "Oops, something went wrong. Please try again later.",
        });
      },
    });
  });

  $("#manual-pay").click(function () {
    var tryout = $(this).data("tryout");
    var email = $(this).data("email");
    var slug = $(this).data("slug");
    Swal.fire({
      title: "Petunjuk",
      html:
        "Silakan lakukan pembayaran pada nomor berikut:<br/><b>OVO/DANA/SHOPEE PAY a.n. Gass Education</b><br/>" +
        "<span>0831-4043-4133</span><br/><br/>" +
        "<b>LINK AJA a.n. Ahmad Sovi Hidayat</b><br/>" +
        "<span>0831-4043-4133</span><br/><br/>" +
        "<b>BNI a.n. Ahmad Sovi Hidayat</b><br/>" +
        "<span>0899-777-084</span><br/><br/>" +
        "Jika anda sudah melakukan pembayaran, silakan lakukan konfirmasi ke CP dengan mengklik tombol berikut.<br/>" +
        "<a id='konfirmasi' data-email=" +
        email +
        " href=" +
        "https://wa.me/6283140434133?text=Nama%3A%20%0AEmail%3A%20%0AMetode%20Pembayaran%3A%20%0A%0ATry%20Out%3A%20" +
        slug +
        " target='_blank' class='btn btn-sm btn-primary'>konfirmasi</a>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Oke",
    });
    daftarTryoutBtn.html("Daftar Tryout");

    // $("#konfirmasi").click(() => {
    //   $.ajax({
    //     url: base_url + "tryout/pembayaranmanual",
    //     cache: false,
    //     type: "POST",
    //     data: {
    //       tryout: tryout,
    //       email: email,
    //       slug: slug
    //     },
    //   });
    // });
  });

  //   $(".copy").click(function () {
  //     console.log("asas");
  //     var text = $(this).data("no").select();
  //     if (navigator.clipboard) {
  //       navigator.clipboard.writeText(text).then(() => {
  //         $(this).html("copied!");
  //       });
  //     }
  //   });
});
