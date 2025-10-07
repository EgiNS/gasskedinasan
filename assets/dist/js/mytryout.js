$(document).ready(function () {
  $(".notrelease").click(function () {
    Swal.fire({
      icon: "error",
      html: "Admistrator belum melakukan release pada tryout ini. Silakan hubungi administrator untuk informasi lebih lanjut",
    });
  });
});
