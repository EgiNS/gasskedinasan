<!-- Footer -->
<?php $company = company(); ?>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?= $company['name'] . ' ' . date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables2/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables2/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables2/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables2/responsive.bootstrap4.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
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

<!-- SB-ADMIN-2 -->
<script src="<?= latest_version(base_url('assets/js/sb-admin-2.js')); ?>"></script>

<!-- SWEET ALERT -->
<script src="<?= base_url('assets/swal/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= latest_version(base_url('assets/dist/js/scriptswal.js')); ?>"></script>

<script src="<?= base_url('assets/vendor/owl-carousel/dist/owl.carousel.min.js'); ?>"></script>
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

</body>

</html>