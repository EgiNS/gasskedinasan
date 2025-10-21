<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/dist/css/tryoutcard.css'); ?>">
<div class="container-fluid">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="solution_cards_box">
                <div class="owl-carousel">
                <?php foreach ($alljenis as $a) : ?>
                    <div class="solution_card">
                        <div class="hover_color_bubble"></div>
                        <div class="row align-items-center">
                            <div class="ml-2 so_top_icon">
                                <img src="<?= base_url('assets/img/tryout.svg'); ?>" alt="tryout.svg">
                            </div>
                            <div class="mx-2 solu_title">
                                <h3 class="font-weight-bold"><?= $a['title'] ?></h3>
                            </div>
                        </div>
                        <div class="solu_description fixed-bottom mb-5 ml-4">
                            <a href="<?= base_url('bimbel/kategori/') . $a['kat']; ?>"
                                class="read_more_btn text-decoration-none">Read more...</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php destroysession(); ?>