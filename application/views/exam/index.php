    <style>
/* === General Layout === */
body {
  background-color: #f8fafc;
  /* font-family: "Poppins", sans-serif; */
  color: #2d3748;
}

.pc-sidebar {
    width: 0;
    display: none;
}

/* Soal utama */
.text-gray-800 {
  background: #fff;
  border-radius: 1rem;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

/* Nomor Soal Panel */
.petasoal {
  margin-left: 1.2rem;
  background: #fff;
  border-radius: 1rem;
  padding: 1rem;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* 👉 ini bikin semua kotak di tengah */
  gap: 0.3rem; /* jarak antar kotak */
}

.petasoal a {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.25s ease;
  box-shadow: 0 2px 4px rgba(0,0,0,0.08);
}

.petasoal a:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* Warna tombol nomor */
.btn-danger {
  background-color: #f87171 !important;
  border: none;
}

.btn-success {
  background-color: #34d399 !important;
  border: none;
}

.btn-warning {
  background-color: #fbbf24 !important;
  border: none;
}

.btn-primary {
  background-color: #3b82f6 !important;
  border: none;
}

/* Tombol navigasi */
.btn.btn-primary i {
  font-size: 1.25rem;
}

.btn.btn-primary:hover {
  opacity: 0.9;
  transform: translateY(-2px);
  transition: 0.2s;
}

/* Sembunyikan input radio */
.custom-control-input {
  display: none;
}

/* Desain label menjadi kotak interaktif */
.custom-control-label {
  display: block;
  font-size: 1rem;
  color: #374151;
  padding: 0.9rem 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 0.75rem;
  background-color: #fff;
  transition: all 0.25s ease;
  cursor: pointer;
  position: relative;
}

/* Efek hover */
.custom-control-label:hover {
  border-color: #93c5fd;
  background-color: #f0f9ff;
}

/* Saat dipilih */
.custom-control-input:checked + .custom-control-label {
  background-color: #3b82f6;
  color: white;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
}

/* Huruf A, B, C di awal pilihan */
.custom-control-label .huruf {
  font-weight: 600;
  display: inline-block;
  width: 1.5rem;
}

/* Responsif & rapih */
.custom-control {
  margin-bottom: 0.75rem;
}


/* Tombol aksi bawah soal */
#kosong, #ragu-ragu {
  border-radius: 8px;
  font-weight: 600;
}

#ragu-ragu.btn-warning {
  background-color: #facc15 !important;
  color: #111827 !important;
}

/* === TIMER === */
.timer {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 1rem;
  margin-right: 0;
  margin-left: 1.2rem;
  margin-top: 0rem;
  width: 95%;
  border: none;
  border-radius: 12px;
  font-size: 1.25rem;
  font-weight: 600;
  padding: 1rem;
  /* padding-left: 0.75rem;
  padding-right: 0; */
  background: linear-gradient(90deg, #3b82f6, #2563eb);
  color: #fff;
  box-shadow: 0 4px 15px rgba(59,130,246,0.3);
  transition: all 0.25s ease;
}

.timer:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(59,130,246,0.4);
}

.timer .spinner-grow {
  margin-right: 8px;
}

/* Gambar soal */
.img-fluid.rounded-start {
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.soal-content p {
  margin-bottom: 1rem;
  line-height: 1.5;
  text-align: justify;
  font-size: 1.2em;
  font-weight: 500;
}

.soal-content ul {
  margin-left: 1.5rem;
  list-style-type: disc;
}

.soal-content b,
.soal-content strong {
  color: #1d4ed8; /* biru */
}

#togglePetaSoal {
    display: none;
}

  #petaSoalMobile {
    display: none;
  }

/* Responsive tweak */
@media (max-width: 992px) {
  #petaSoalPC {
    display: none;
  }

  #togglePetaSoal {
    display: block;
    width: 30%;
    margin-left: 1rem;
}

  .text-gray-800 {
    padding: 1.25rem;
  }

  .timer {
    margin-left: 0;
    width: 100%;
    margin-top: 1rem;
  }

  .petasoal {
    margin-left: 0;
    margin-top: 0.5rem;
  }
}
</style>


    <div class="pc-container" style="margin-right: 0 !important; margin-left:0;">
    <?= $this->session->flashdata('flash'); ?>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $waktu = strtotime('+ ' . $tryout['lama_pengerjaan'] . ' minute', $jawaban['waktu_mulai']);
    $now = time();
    ?>

    <input type="text" id="id" value="<?= $this->session->flashdata('nomor'); ?>" hidden>
    <input type="hidden" id="time" data-waktu="<?= date('F d, Y H:i:s', $waktu); ?>">
    <input type="hidden" id="exam-start" data-start="<?= date('Y-m-d H:i:s', $jawaban['waktu_mulai']) ?>">
    <input type="hidden" id="exam-duration" data-duration="<?= $tryout['lama_pengerjaan'] * 60 ?>">
    <input type="hidden" id="user_id" data-userid="<?= $user->id; ?>">
    <input type="hidden" id="jumlahsoal" data-id="<?= count($soal_lengkap); ?>">
    <input type="hidden" id="tryout" data-tryout="<?= $tryout['slug']; ?>">
      <div class="pc-content">

        <!-- [ Main Content ] start -->
        <div class="row pb-4">
          <!-- [ sample-page ] start -->
          <button class="btn btn-outline-primary" id="togglePetaSoal">
              📘 Peta Soal
          </button>
            <div class="col-12" id="petaSoalMobile">
                <?php
                $i = 1;
                foreach ($soal_lengkap as $s) {
                    $token[$i] = $s['token'];
                    $i++;
                }
                ?>
                <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                <div class="text-center petasoal petasoal-vis">
                    <?php for ($i = 1; $i <= 98; $i++) : ?>
                    <?php if ($i % 6 == 0) : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endfor; ?>

                    <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                    <?php for ($i = 99; $i <= 110; $i++) : ?>
                    <?php if ($i % 6 == 0) : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                <div class="text-center petasoal petasoal-vis">
                    <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
                    <?php if ($i <= 98) : ?>
                    <?php if ($i % 6 == 0) : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                    <?php for ($i = 99; $i <= $tryout['jumlah_soal']; $i++) : ?>
                    <?php if ($i % 6 == 0) : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if ($ragu_ragu[$i] == 'R') : ?>
                    <a class="btn btn-warning btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <?php if ($jawaban[$i] == null) : ?>
                    <a class="btn btn-danger btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 kotak"
                        href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
          <div class="col-sm-12 d-flex flex-column flex-lg-row-reverse">
            <div class="col-lg-3" >
                <?php
                $i = 1;
                foreach ($soal_lengkap as $s) {
                    $token[$i] = $s['token'];
                    $i++;
                }
                ?>
                <div class="">
                    <!-- <h1 class="timer"></h1> -->
                    <button class="btn btn-lg btn-primary timer" disabled>
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading...
                    </button>
                </div>
                <div id="petaSoalPC">
                    <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                    <div class="text-center petasoal petasoal-vis">
                        <?php for ($i = 1; $i <= 98; $i++) : ?>
                        <?php if ($i % 6 == 0) : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endfor; ?>
    
                        <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                        <?php for ($i = 99; $i <= 110; $i++) : ?>
                        <?php if ($i % 6 == 0) : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                    <div class="text-center petasoal petasoal-vis">
                        <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
                        <?php if ($i <= 98) : ?>
                        <?php if ($i % 6 == 0) : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
    
                        <?php else : ?>
                        <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                        <?php for ($i = 99; $i <= $tryout['jumlah_soal']; $i++) : ?>
                        <?php if ($i % 6 == 0) : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if ($ragu_ragu[$i] == 'R') : ?>
                        <a class="btn btn-warning btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <?php if ($jawaban[$i] == null) : ?>
                        <a class="btn btn-danger btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                        <a class="btn btn-success btn-sm mb-1 kotak"
                            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
                            data-id="<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endfor; ?>
                        <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-9 text-gray-800">
                <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                <h1 class="h3 mb-4 text-gray-800">
                    <b><?= 'No ' . $soal['id'] . ' | ' . $tipe_soal[$soal['tipe_soal'] - 1]['name']; ?></b>
                </h1>
                <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                <h1 class="h3 mb-4 text-gray-800">
                    <b><?= 'No ' . $soal['id']; ?></b>
                </h1>
                <?php endif; ?>
                <?php if ($soal['id'] == count($soal_lengkap)) : ?>
                <a href="#" class="btn btn-primary text-right selesai"
                    data-tryout="<?= $this->input->get('tryout'); ?>">Selesaikan tryout</a>
                <?php endif; ?>
                <hr>
                <?php if ($soal['gambar_soal']) : ?>
                <div class="col-md-8">
                    <img src="<?= base_url('assets/img/soal/') . $soal['gambar_soal']; ?>" class="img-fluid rounded-start">
                </div>
                <hr>
                <div class="soal-content">
                    <?= $soal['text_soal']; ?></div>
                <?php else : ?>
                <div class="soal-content">
                    <?= $soal['text_soal']; ?></div>
                <?php endif;

                $data = ['A', 'B', 'C', 'D', 'E'];
                ?>

                <?php if ($soal['text_a']) :
                    $pilihan = [
                        $soal['text_a'],
                        $soal['text_b'],
                        $soal['text_c'],
                        $soal['text_d'],
                        $soal['text_e']
                    ];
                ?>
                <hr>

                <?php for ($i = 0; $i <= 4; $i++) : ?>
                <div class="custom-control custom-radio mb-3">
                    <?php if ($pilihan[$i]) : ?>
                    <?php if (isset($jawaban[$soal['id']])) : ?>
                    <?php if ($jawaban[$soal['id']] == $data[$i]) : ?>
                    <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                        data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan" checked>
                    <label for="<?= $data[$i]; ?>" class="custom-control-label"><?= $data[$i] . '. ' . $pilihan[$i] ?></label>
                    <?php else : ?>
                    <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                        data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
                    <label for="<?= $data[$i]; ?>" class="custom-control-label"><?= $data[$i] . '. ' . $pilihan[$i] ?></label>
                    <?php endif; ?>
                    <?php else : ?>
                    <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                        data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
                    <label for="<?= $data[$i]; ?>" class="custom-control-label"><?= $data[$i] . '. ' . $pilihan[$i] ?></label>

                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php endfor; ?>



                <?php else :
                    $pilihan = [
                        $soal['gambar_a'],
                        $soal['gambar_b'],
                        $soal['gambar_c'],
                        $soal['gambar_d'],
                        $soal['gambar_e']
                    ];


                ?>


                <?php for ($i = 0; $i <= 4; $i++) : ?>
                <div class="col-md-5">
                    <div class="custom-control custom-radio mb-3">
                        <?php if ($pilihan[$i]) : ?>
                        <?php if (isset($jawaban[$soal['id']])) : ?>
                        <?php if ($jawaban[$soal['id']] == $data[$i]) : ?>
                        <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                            data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan" checked>
                        <label for="<?= $data[$i]; ?>" class="custom-control-label"><img
                                src="<?= base_url('assets/img/soal/') . $pilihan[$i]; ?>"
                                class="img-fluid rounded-start"></label>
                        <?php else : ?>
                        <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                            data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
                        <label for="<?= $data[$i]; ?>" class="custom-control-label"><img
                                src="<?= base_url('assets/img/soal/') . $pilihan[$i]; ?>"
                                class="img-fluid rounded-start"></label>
                        <?php endif; ?>
                        <?php else : ?>
                        <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                            data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
                        <label for="<?= $data[$i]; ?>" class="custom-control-label"><img
                                src="<?= base_url('assets/img/soal/') . $pilihan[$i]; ?>"
                                class="img-fluid rounded-start"></label>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endfor; ?>
                <?php endif; ?>
                <button type="button" id="kosong" data-nomor="<?= $soal['id']; ?>" class="btn btn-primary mt-3">Kosongkan
                    Jawaban</button>
                <?php if ($ragu_ragu[$soal['id']] == 'R') : ?>
                <button type="button" id="ragu-ragu" data-nomor="<?= $soal['id']; ?>" class="btn btn-light mt-3">Yakin</button>
                <?php else : ?>
                <?php if (!$ragu_ragu[$soal['id']] || $ragu_ragu[$soal['id']] == 'Y') : ?>
                <button type="button" id="ragu-ragu" data-nomor="<?= $soal['id']; ?>"
                    class="btn btn-warning mt-3">Ragu-Ragu</button>
                <?php endif; ?>
                <?php endif; ?>


                <br>
                <br>
                <br>


                <div class="text-center">
                    <?php if ($soal['id'] == 1) : ?>
                    <a class="btn btn-primary"
                        href="<?= base_url('exam/question/') . ($token[$soal['id'] + 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                            class="fas fa-chevron-right mx-2 kotak"></i></a>
                    <?php else : ?>
                    <?php if ($soal['id'] == count($soal_lengkap)) : ?>
                    <a class="btn btn-primary"
                        href="<?= base_url('exam/question/') . ($token[$soal['id'] - 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                            class="fas fa-chevron-left mx-2 kotak"></i></a>
                    <?php else : ?>
                    <a class="btn btn-primary"
                        href="<?= base_url('exam/question/') . ($token[$soal['id'] - 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                            class="fas fa-chevron-left mx-2 kotak"></i></a>
                    <a class="btn btn-primary"
                        href="<?= base_url('exam/question/') . ($token[$soal['id'] + 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                            class="fas fa-chevron-right mx-2 kotak"></i></a>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <br>
                <br>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <script>
    // Inject server time sekali saja saat page load
    var SERVER_LOAD_TIME = <?= time() * 1000 ?>;
    var CLIENT_LOAD_TIME = Date.now();
    var TIME_OFFSET = SERVER_LOAD_TIME - CLIENT_LOAD_TIME;
    </script>
    <?php
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }
    ?>

    <script>
document.addEventListener('DOMContentLoaded', function() {
  const toggleBtn = document.getElementById('togglePetaSoal');
  const petaSoal = document.getElementById('petaSoalMobile');

  toggleBtn.addEventListener('click', function() {
    if (petaSoal.style.display === 'none' || petaSoal.style.display === '') {
      petaSoal.style.display = 'block';
      toggleBtn.textContent = '❌ Tutup';
    } else {
      petaSoal.style.display = 'none';
      toggleBtn.textContent = '📘 Peta Soal';
    }
  });
});
</script>