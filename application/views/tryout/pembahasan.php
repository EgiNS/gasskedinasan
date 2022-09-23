<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="row">
        <div class="col-lg">
            <?php if ($tryout['pembahasan']) : ?>
            <a href="#" id="pembahasan" class="btn btn-primary">Klik untuk melihat Pembahasan!</a>
            <iframe id="view_pembahasan" src="<?= base_url(); ?>/assets/file/<?= $tryout['pembahasan']; ?>" width="100%"
                height="750px"></iframe>
            <?php else : ?>
            <h3>Pembahasan Belum Tersedia</h3>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>

<?php destroysession(); ?>