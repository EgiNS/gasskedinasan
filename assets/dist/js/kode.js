$(document).ready(function () {
  $("#lock-role").on("click", function (e) {
    e.preventDefault(); //Mematikan href
    const admin_kode = $(this).data("kode");
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
          $("#lock-role").addClass("d-none");
          $(".unlock-role").removeClass("d-none");
          $("#update-user-role, #role_id").removeAttr("disabled");
        } else {
          Swal.showValidationMessage(`Kode salah`);
        }
        return { kode: kode };
      },
    });
  });

  $(".unlock-role").on("click", function () {
    $("#update-user-role, #role_id").attr("disabled", true);
    $("#lock-role").removeClass("d-none");
    $(".unlock-role").addClass("d-none");
  });
});
