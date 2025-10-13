<div class="pc-container">
<div class="pc-content">
     <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

                  <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Pendaftar</h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/pendaftar'); ?>">Paket TO</a></li>
                  <li class="breadcrumb-item" aria-current="page">Pendaftar</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
     <div class="row">
                <div class="col-lg-12 col-md-10 col-sm-10">
                    <table class="table nowrap table-striped projects" id="tabelwoi">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Waktu Pendaftaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ($pendaftar as $p) : ?>
                                <tr>
                                           <td><?= $i + 1; ?></td>
                                            <td><?= $p->username ?></td>
                                                <td><?= $p->created_at ?></td>
                                                <td><?= $p->status ?></td>
 

                                </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 

</div>
</div>



<?php destroysession(); ?>