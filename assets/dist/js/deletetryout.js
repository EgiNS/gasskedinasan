$(document).ready(function () {
  $(".btn-delete-tryout").on("click", function (e) {
    var base_url = $(".base_url").data("baseurl");

    e.preventDefault(); //Mematikan href
    const admin_kode = $(this).data("kode");
    const id = $(this).data("id");
    Swal.fire({
      title: "<b>Perhatian!</b>",
      icon: "info",
      html: "<b>Hal ini sangat tidak disarankan karena akan menghapus seluruh data soal, jawaban, dan peserta tryout. Jika anda menginginkan agar peserta tidak dapat melakukan pendaftaran dan melihat tryout ini lagi, silakan lakukan HIDE dan PULL Tryout pada menu Change Status.</b>",
      focusConfirm: false,
      confirmButtonText: "Tetap Ingin Hapus!",
      showCancelButton: true,
    }).then((result) => {
      if (result.isConfirmed) kode();
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
            $.ajax({
              url: base_url + "admin/hapustryout",
              data: {
                id: id,
              },
              type: "post",
              success: function () {
                $(".btn-delete-tryout").html('<span class="spinner-border spinner-border-sm"></span>');
                document.location.href = base_url + "admin/tryout";
              },
              // JIKA URL GAGAL DIEKSEKUSI
              error: function (request, status, error) {
                Swal.fire({
                  icon: "error",
                  html: request.responseText,
                });
              },
            });
          } else {
            Swal.showValidationMessage(`Kode salah`);
          }
          return { kode: kode };
        },
      });
    }
  });
});
