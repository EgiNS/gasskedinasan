<footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col-sm-6 my-1">
            <p class="m-0">
              Berry &#9829; crafted by Team
              <a href="https://themeforest.net/user/codedthemes" target="_blank">CodedThemes</a>
            </p>
          </div>
          <div class="col-sm-6 ms-auto my-1">
            <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">
              <li class="list-inline-item"><a href="../index.html">Home</a></li>
              <li class="list-inline-item"><a href="https://codedthemes.gitbook.io/berry-bootstrap/" target="_blank">Documentation</a></li>
              <li class="list-inline-item"><a href="https://codedthemes.support-hub.io/" target="_blank">Support</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript-->
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables2/dataTables.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables2/dataTables.bootstrap5.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>


<!-- Custom scripts for all pages-->
<!-- METHOD LATEST_VERSION() UNTUK DESTROY COOKIE JAVASCRIPT SEHINGGA SELALU UPDATE PADA HALAMAN WEB SETIAP PERUBAHAN FILE JAVASCRIPT - METHOD TERDAPAT PADA HELPER -->
<script src="<?= latest_version(base_url('assets/dist/js/generatenewtoken.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/menumodal.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/pembahasan.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/pengerjaantryout.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/rolechangeaccess.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/rolemodal.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/setjawabandanparadata.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/submenumodal.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/tambahdaneditsoal.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/tryoutmodal.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/settings.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/tryoutdetails.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/mytryout.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/addbobotsekaligus.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/deletetryout.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/tinymcesetcontent.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/chart-pie-persentasestatus.js')); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/kode.js')); ?>"></script>

<!-- SWEET ALERT -->
<script src="<?= base_url('assets/swal/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/scriptswal.js')); ?>"></script>

<script>
$(document).ready(function() {
    var submitButton = $("button[type=submit], .submit");

    $(submitButton).on('click', function() {
        $(this).html('<span class="spinner-border spinner-border-sm"></span>');
    })

    $('.owl-carousel').owlCarousel({
        stagePadding: 30,
        // loop: true,
        margin: 20,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1,
                nav: true,
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            }
        }
    })
});
</script>
<script>
  if ($.fn.DataTable.isDataTable('#tabelwoi')) {
  $('#tabelwoi').DataTable().destroy();
}
$('#tabelwoi').DataTable({

    "lengthMenu": [
        [25, 50, 75, -1],
        [25, 50, 75, "All"]
    ],
    columnDefs: [{
        targets: [0],
        orderData: [0, 1]
    }, {
        targets: [1],
        orderData: [1, 0]
    }, {
        targets: [3],
        orderData: [3, 0]
    }],
    "scrollX": true
});
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>

 <!-- Required Js -->
<script src="<?= base_url('assets/js/plugins/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/simplebar.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/icon/custom-font.js'); ?>"></script>
<script src="<?= base_url('assets/js/script.js'); ?>"></script>
<script src="<?= base_url('assets/js/theme.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/feather.min.js'); ?>"></script>


<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>

   <?php if (isset($page_scripts)) : ?>
      <?php foreach ($page_scripts as $script) : ?>
        <script>
          <?= $script; ?>
        </script>
      <?php endforeach; ?>
    <?php endif; ?>
<script>
  layout_change('light');
</script>
   
<script>
  font_change('Roboto');
</script>
 
<script>
  change_box_container('false');
</script>
 
<script>
  layout_caption_change('true');
</script>
   
<script>
  layout_rtl_change('false');
</script>
 
<script>
  preset_change('preset-1');
</script>



    <!-- [Page Specific JS] start -->
    <!-- Apex Chart -->
<script src="<?= base_url('assets/js/plugins/apexcharts.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard-default.js'); ?>"></script>
    <!-- [Page Specific JS] end -->
  </body>
  <!-- [Body] end -->
</html>
