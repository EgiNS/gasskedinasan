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
        <?php if ($tryout) : ?>
        <?php for ($i = 0; $i < ceil(count($tryout) / 3); $i++) : ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="solution_cards_box">
                <div class="owl-carousel">
                    <?php for ($j = $i * 3; $j < $i * 3 + 3; $j++) : ?>
                    <?php if (!empty($tryout[$j])) : ?>
                    <div class="solution_card">
                        <div class="hover_color_bubble"></div>
                        <div class="row align-items-center">
                            <div class="ml-2 so_top_icon">
                                <img src="<?= base_url('assets/img/tryout.svg'); ?>" alt="tryout.svg">
                            </div>
                            <div class="mx-2 solu_title">
                                <h3 class="font-weight-bold"
                                    style="<?= ($tryout[$j]['hidden'] == 1 ? 'color: red;' : ''); ?>">
                                    <?= $tryout[$j]['name']; ?></h3>
                            </div>
                        </div>
                        <div>
                            <p><?= $tryout[$j]['keterangan']; ?></p>
                        </div>
                        <div class="solu_description fixed-bottom mb-5 ml-4">
                            <a href="<?= base_url('bimbel/detailtryout/') . $tryout[$j]['slug']; ?>"
                                class="read_more_btn text-decoration-none">Read more...</a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <?php endfor; ?>
        <?php else : ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="h2 mb-4 text-gray-800">Belum ada tryout yang tersedia</h2>
        </div>
        <?php endif; ?>
    </div>
</div>
</div>

<?php destroysession(); ?>