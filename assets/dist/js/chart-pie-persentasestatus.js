if ($("#dashboard").length) {
  // Set new default font family and font color to mimic Bootstrap's default styling
  (Chart.defaults.global.defaultFontFamily = "Nunito"), '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#858796";

  var belumMemulai;
  var proses;
  var selesai;

  $(document).ready(function () {
    chart();
    var base_url = $(".base_url").data("baseurl");
    $(".pie-chart").on("click", function () {
      var tryout = $(this).data("tryout");
      var slug = $(this).data("slug");
      $(".toggle-tryout-button").html(tryout);

      $.ajax({
        url: base_url + "admin/getpersentasestatus",
        type: "post",
        data: {
          slug: slug,
        },
        dataType: "json",
        success: (data) => {
          if (data.status == 0) {
            Swal.fire({
              icon: "error",
              title: "Oops, something went wrong.",
              html: "Belum ada peserta yang mendaftar pada tryout ini.",
            });
          } else {
            belumMemulai = data[0].belum_memulai;
            proses = data[0].proses;
            selesai = data[0].selesai;
            chart();
          }
        },
        error: function (request, status, error) {
          Swal.fire({
            icon: "error",
            html: request.responseText ? request.responseText : "Oops, something went wrong. Please try again later.",
          });
        },
      });
    });
  });

  if (persentasesu[0] != null) {
    belumMemulai = persentasesu[0].belum_memulai;
    proses = persentasesu[0].proses;
    selesai = persentasesu[0].selesai;
  } else {
    belumMemulai = 0;
    proses = 0;
    selesai = 0;
  }

  function chart() {
    var ctx = document.getElementById("chart-pie-peserta");
    var myPieChart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["Belum Memulai", "Proses", "Selesai"],
        datasets: [
          {
            data: [belumMemulai, proses, selesai],
            // data: [33.33, 33.33, 33.33],
            backgroundColor: ["#e74a3b", "#f6c23e", "#1cc88a"],
            hoverBackgroundColor: ["#e70a2f", "#f6e23e", "#1ce88a"],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false,
        },
        cutoutPercentage: 80,
      },
    });
  }
}
