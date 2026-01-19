    <div class="pc-container">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10"><?= $title ?></h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <?= breadcumb($breadcrumb_item); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <?= form_open_multipart('user/editprofile'); ?>

                <div class="form-group row mb-2">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $user->email; ?>"
                            readonly>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="name" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user->name; ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="no_wa" class="col-sm-2 col-form-label">WhatsApp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_wa" name="no_wa" value="<?= $user->no_wa; ?>"
                            autocomplete="off" placeholder="Contoh: 628xxx">
                        <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row mb-2">
                  <?php $kedinasan = [
                    "Politeknik Keuangan Negara STAN (PKN STAN)",
                    "Institut Pemerintahan Dalam Negeri (IPDN)",
                    "Politeknik Statistika STIS",
                    "Sekolah Tinggi Intelijen Negara (STIN)",                   
                    "Politeknik Siber dan Sandi Negara (Poltek SSN)",
                    "Sekolah Tinggi Meteorologi Klimatologi dan Geofisika (STMKG)",
                    "Politeknik Pengayoman Indonesia (Poltekpin)",
                    "Sekolah Tinggi Ilmu Pelayaran (STIP)",
                    "Politeknik Transportasi Darat Indonesia (PTDI-STTD)",
                    "CPNS Umum"
                  ]; ?>
                    <label for="kedinasan_tujuan" class="col-sm-2 col-form-label">Kedinasan Tujuan</label>
                    <div class="col-sm-10">
                    <select class="form-select col-sm-10" name="kedinasan_tujuan" id="kedinasan_tujuan">
                      <?php foreach($kedinasan as $kd) : ?>
                        <option value="<?= $kd; ?>" <?= (isset($user->kedinasan_tujuan) && $user->kedinasan_tujuan == $kd) ? 'selected' : ''; ?>><?= $kd; ?></option>
                      <?php endforeach; ?>
                      
                    </select>
                    </div>
                    <!-- <div class="col-sm-10">
                        <input type="text" class="form-control" id="kedinasan_tujuan" name="kedinasan_tujuan" 
                            value="<?= isset($user->kedinasan_tujuan) ? $user->kedinasan_tujuan : ''; ?>"
                            autocomplete="off" placeholder="Contoh: Kementerian Keuangan">
                        <?= form_error('kedinasan_tujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div> -->
                </div>

                <div class="form-group row mb-2">
                    <div class="col-sm-2">Picture</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $user->image ?>" class="img-thumbnail">

                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <input type="file" class="custom-file-input form-control" id="image" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

                </form>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <?php destroysession(); ?>