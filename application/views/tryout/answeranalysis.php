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

/* Saat dipilih */
.custom-control-input:checked + .custom-control-label {
  background-color: #22c55e; /* hijau utama */
  color: white;
  border-color: #16a34a; /* hijau sedikit lebih gelap */
  box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.3); /* efek glow hijau lembut */
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

  .nilai-wrapper {
  display: flex;
  gap: 0.75rem;
  flex-wrap: wrap;
}

.nilai-item {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 0.5rem 0.9rem;
  min-width: 65px;
  text-align: center;
  transition: all 0.2s ease;
}

.nilai-item:hover {
  background: #eef2ff; /* pastel ungu lembut */
  border-color: #c7d2fe;
  transform: translateY(-2px);
}

.huruf {
  display: block;
  font-weight: 600;
  color: #1e293b;
  font-size: 0.95rem;
}

.nilai {
  display: block;
  font-weight: 700;
  color: #2563eb;
  font-size: 1.1rem;
  margin-top: 0.2rem;
}
/* Responsive tweak */
@media (max-width: 992px) {
  #petaSoalPC {
    display: none;
  }

  #togglePetaSoal {
    display: block;
    width: 40%;
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

  .nilai-item {
    min-width: 44px;
    }
}
</style>
    <div class="pc-container" style="margin-right: 0 !important; margin-left:0;">
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
            <?php
            $i = 1;
            foreach ($soal_lengkap as $s) {
                $token[$i] = $s['token'];
                $i++;
            }

            $data = ['A', 'B', 'C', 'D', 'E'];

            $id = $soal['id'];
            if ($tryout['tipe_tryout'] == 'SKD')
                $pak_sol = $soal['tipe_soal'];

            $gambar_pembahasan = $soal['gambar_pembahasan'];
            $pembahasan = $soal['pembahasan'];
            ?>

            <button class="btn btn-outline-primary mb-2" id="togglePetaSoal">
              📘 Peta Soal
            </button>
                    <div class="col-12 mb-2" id="petaSoalMobile">
                        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                             <div class="text-center petasoal petasoal-vis">
                                 <table class="table">
                                     <tbody>
                                         <tr>
                                             <?php for ($i = 1; $i <= 98; $i++) : ?>
                                             <!-- Untuk Soal TWK dan DIU -->
                                             <?php if ($i <= 65) : ?>
                                             <!-- JAWABAN BENAR -->
                                             <?php if ($kunci_twk_tiu[$i] == $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php elseif ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php elseif ($kunci_twk_tiu[$i] != $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <!-- UNTUK SOAL TKP -->
                                             <?php else : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
         
                                             <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                                             <!-- UNTUK SOAL TKP -->
                                             <?php for ($i = 99; $i <= 110; $i++) : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
                                         </tr>
                                         <tr >
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-success mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Benar</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-danger mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Salah</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-light border border-dark mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Kosong</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-warning mb-1 ml-5" style="width: 30px;height: 30px;"></a> Soal TKP Terisi</td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                             <div class="text-center petasoal petasoal-vis">
                                 <table class="table">
                                     <tbody>
                                         <tr>
                                             <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
                                             <?php if ($i <= 98) : ?>
                                             <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                                             <!-- JAWABAN BENAR -->
                                             <?php if ($kunci_jawaban[$i] == $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php elseif ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php elseif ($kunci_jawaban[$i] != $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
         
                                             <?php else : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>
         
                                             <?php else : ?>
                                             <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                                             <?php for ($i = 99; $i <= $tryout['jumlah_soal']; $i++) : ?>
                                             <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                                             <!-- JAWABAN BENAR -->
                                             <?php if ($kunci_jawaban[$i] == $jawaban[$i]) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php elseif ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php elseif ($kunci_jawaban[$i] != $jawaban[$i]) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
         
                                             <?php else : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
                                         </tr>
                                         <?php if ($bobot_nilai_a[1] != null) : ?>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-warning mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Terisi</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-light border border-dark mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Kosong</td>
                                         </tr>
                                         <?php else : ?>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-success mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Benar</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-danger mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Salah</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-light border border-dark mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Kosong</td>
                                         </tr>
                                         <?php endif; ?>
                                     </tbody>
                                 </table>
                             </div>
                         <?php endif; ?>
                    </div>
          <!-- [ sample-page ] start -->
          <div class="col-sm-12 d-flex flex-column flex-lg-row-reverse">
                   <div class="col-lg-3">
                    <div id="petaSoalPC">
                        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                             <div class="text-center petasoal petasoal-vis">
                                 <table class="table">
                                     <tbody>
                                         <tr>
                                             <?php for ($i = 1; $i <= 98; $i++) : ?>
                                             <!-- Untuk Soal TWK dan DIU -->
                                             <?php if ($i <= 65) : ?>
                                             <!-- JAWABAN BENAR -->
                                             <?php if ($kunci_twk_tiu[$i] == $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php elseif ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php elseif ($kunci_twk_tiu[$i] != $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <!-- UNTUK SOAL TKP -->
                                             <?php else : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
         
                                             <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                                             <!-- UNTUK SOAL TKP -->
                                             <?php for ($i = 99; $i <= 110; $i++) : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
                                         </tr>
                                         <tr >
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-success mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Benar</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-danger mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Salah</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-light border border-dark mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Kosong</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-warning mb-1 ml-5" style="width: 30px;height: 30px;"></a> Soal TKP Terisi</td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                             <div class="text-center petasoal petasoal-vis">
                                 <table class="table">
                                     <tbody>
                                         <tr>
                                             <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
                                             <?php if ($i <= 98) : ?>
                                             <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                                             <!-- JAWABAN BENAR -->
                                             <?php if ($kunci_jawaban[$i] == $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php elseif ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php elseif ($kunci_jawaban[$i] != $jawaban[$i]) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
         
                                             <?php else : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 7 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>
         
                                             <?php else : ?>
                                             <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                                             <?php for ($i = 99; $i <= $tryout['jumlah_soal']; $i++) : ?>
                                             <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                                             <!-- JAWABAN BENAR -->
                                             <?php if ($kunci_jawaban[$i] == $jawaban[$i]) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php elseif ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php elseif ($kunci_jawaban[$i] != $jawaban[$i]) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
         
                                             <?php else : ?>
                                             <!-- JAWABAN KOSONG -->
                                             <?php if ($jawaban[$i] == null) : ?>
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php else : ?>
                                             <!-- JAWABAN TERISI -->
                                             <?php if ($i % 8 == 0) : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <br>
                                             <?php else : ?>
                                             <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                                                 href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                                                 data-id="<?= $i; ?>"><?= $i; ?></a>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
                                             <?php endif; ?>
                                             <?php endfor; ?>
                                         </tr>
                                         <?php if ($bobot_nilai_a[1] != null) : ?>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-warning mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Terisi</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-light border border-dark mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Kosong</td>
                                         </tr>
                                         <?php else : ?>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-success mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Benar</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-danger mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Salah</td>
                                         </tr>
                                         <tr class="text-left">
                                             <td class="text-left d-flex justify-content-start align-items-center flex-row gap-2"><a class="btn btn-light border border-dark mb-1 ml-5" style="width: 30px;height: 30px;"></a> Jawaban Kosong</td>
                                         </tr>
                                         <?php endif; ?>
                                     </tbody>
                                 </table>
                             </div>
                         <?php endif; ?>
                    </div>
                    </div>
                    <div class="col-lg-9 text-gray-800">
                        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                        <h1 class="h3 mb-4 text-gray-800">
                            <b><?= 'No ' . $soal['id'] . ' | ' . $tipe_soal[$soal['tipe_soal'] - 1]['name']; ?></b>
                        </h1>
                        <?php else: ?>
                        <h1 class="h3 mb-4 text-gray-800">
                            <b><?= 'No ' . $soal['id'] ?></b>
                        </h1>
                        <?php endif; ?>
                        <hr>
                        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                        <?php
                            if ($soal['gambar_soal']) : ?>
                        <div class="col-md-8">
                            <img src="<?= base_url('assets/img/soal/') . $soal['gambar_soal']; ?>" class="img-fluid rounded-start">
                        </div>
                        <hr>
                        <div class="soal-content">
                            <?= $soal['text_soal']; ?></div>
                        <?php else : ?>
                        <div class="soal-content">
                            <?= $soal['text_soal']; ?></div>
                        <?php endif; ?>
                        <hr>


                        <?php if ($soal['text_a']) :
                                $soal = [
                                    $soal['text_a'],
                                    $soal['text_b'],
                                    $soal['text_c'],
                                    $soal['text_d'],
                                    $soal['text_e']
                                ];

                            ?>

                        <?php for ($i = 0; $i <= 4; $i++) : ?>
                        <div class="custom-control custom-radio mb-3">
                            <?php if ($soal[$i]) : ?>
                            <?php if ($pak_sol != 3) : ?>
                            <?php if ($kunci_twk_tiu[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
                            <label for="jawaban_bener" class="custom-control-label"
                                style="font-weight: bold;"><?= $soal[$i]; ?></label>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label"
                                style="background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5; font-weight: bold;"><?= $soal[$i]; ?> <span class="badge text-bg-secondary rounded">Your
                                    Answer</span></label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
                            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?> <span
                                style="background-color: #fef9c3; color: #92400e; border-color: #fde68a; box-shadow: 0 0 0 3px rgba(253, 230, 138, 0.5);" class="badge text-bg-secondary rounded">Your
                                    Answer</span></label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
                            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?></label>
                            <?php endif; ?>

                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endfor; ?>

                        <?php if ($pak_sol == 3) : ?>
                        <br>
                            <p style="font-weight: bold; font-size: 1.1rem; margin-bottom: 0.5rem;">Nilai Setiap Jawaban :</p>
                            <div class="nilai-wrapper d-flex flex-wrap gap-2">
                            <div class="nilai-item">
                                <span class="huruf">A</span>
                                <span class="nilai"><?= $kunci_tkp_a[$id]; ?></span>
                            </div>
                            <div class="nilai-item">
                                <span class="huruf">B</span>
                                <span class="nilai"><?= $kunci_tkp_b[$id]; ?></span>
                            </div>
                            <div class="nilai-item">
                                <span class="huruf">C</span>
                                <span class="nilai"><?= $kunci_tkp_c[$id]; ?></span>
                            </div>
                            <div class="nilai-item">
                                <span class="huruf">D</span>
                                <span class="nilai"><?= $kunci_tkp_d[$id]; ?></span>
                            </div>
                            <div class="nilai-item">
                                <span class="huruf">E</span>
                                <span class="nilai"><?= $kunci_tkp_e[$id]; ?></span>
                            </div>
                            </div>
                        <?php endif; ?>

                        <?php else :
                                $soal = [
                                    $soal['gambar_a'],
                                    $soal['gambar_b'],
                                    $soal['gambar_c'],
                                    $soal['gambar_d'],
                                    $soal['gambar_e']
                                ];
                            ?>

                        <?php for ($i = 0; $i <= 4; $i++) : ?>
                        <div class="custom-control custom-radio mb-3">
                            <?php if ($soal[$i]) : ?>
                            <?php if ($pak_sol != 3) : ?>
                            <?php if ($kunci_twk_tiu[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
                            <label for="jawaban_bener" class="custom-control-label"> <span class="badge badge-success">Correct
                                    Answer</span>
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label" style="background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5; font-weight: bold;"><span
                                    class="badge text-bg-secondary rounded">Your
                                    Answer</span>
                                <br>
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label">
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
                            <label for="jawaban_tkp" class="custom-control-label"> <span style="background-color: #fef9c3; color: #92400e; border-color: #fde68a; box-shadow: 0 0 0 3px rgba(253, 230, 138, 0.5);" class="badge text-bg-secondary rounded">Your
                                    Answer</span>
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
                            <label for="jawaban_tkp" class="custom-control-label">
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endfor; ?>

                        <?php if ($pak_sol == 3) : ?>
                        <br>
                        <p style="font-weight: bold; font-size: 1.1rem; margin-bottom: 0.5rem;">Nilai Setiap Jawaban :</p>
                        <div class="nilai-wrapper d-flex flex-wrap gap-2">
                        <div class="nilai-item">
                            <span class="huruf">A</span>
                            <span class="nilai"><?= $kunci_tkp_a[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">B</span>
                            <span class="nilai"><?= $kunci_tkp_b[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">C</span>
                            <span class="nilai"><?= $kunci_tkp_c[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">D</span>
                            <span class="nilai"><?= $kunci_tkp_d[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">E</span>
                            <span class="nilai"><?= $kunci_tkp_e[$id]; ?></span>
                        </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                        <?php
                            if ($soal['gambar_soal']) : ?>
                        <div class="col-md-8">
                            <img src="<?= base_url('assets/img/soal/') . $soal['gambar_soal']; ?>" class="img-fluid rounded-start">
                        </div>
                        <hr>
                        <div class="soal-content">
                            <?= $soal['text_soal']; ?></div>
                        <?php else : ?>
                        <div class="soal-content">
                            <?= $soal['text_soal']; ?></div>
                        <?php endif; ?>
                        <hr>


                        <?php if ($soal['text_a']) :
                                $soal = [
                                    $soal['text_a'],
                                    $soal['text_b'],
                                    $soal['text_c'],
                                    $soal['text_d'],
                                    $soal['text_e']
                                ];

                            ?>

                        <?php for ($i = 0; $i <= 4; $i++) : ?>
                        <div class="custom-control custom-radio mb-3">
                            <?php if ($soal[$i]) : ?>
                            <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                            <?php if ($kunci_jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
                            <label for="jawaban_bener" class="custom-control-label"
                                style="font-weight: bold;"><?= $soal[$i]; ?></label>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label"
                                style="background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5; font-weight: bold;"><?= $soal[$i]; ?> <span class="badge text-bg-secondary rounded">Your
                                    Answer</span></label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
                            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?> <span
                                    style="background-color: #fef9c3; color: #92400e; border-color: #fde68a; box-shadow: 0 0 0 3px rgba(253, 230, 138, 0.5);" class="badge text-bg-secondary rounded">Your
                                    Answer</span></label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
                            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?></label>
                            <?php endif; ?>

                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endfor; ?>

                        <?php if ($bobot_nilai_a[1] != null) : ?>
                        <br>
                        <p style="font-weight: bold; font-size: 1.1rem; margin-bottom: 0.5rem;">Nilai Setiap Jawaban :</p>
                        <div class="nilai-wrapper d-flex flex-wrap gap-2">
                        <div class="nilai-item">
                            <span class="huruf">A</span>
                            <span class="nilai"><?= $bobot_nilai_a[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">B</span>
                            <span class="nilai"><?= $bobot_nilai_b[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">C</span>
                            <span class="nilai"><?= $bobot_nilai_c[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">D</span>
                            <span class="nilai"><?= $bobot_nilai_d[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">E</span>
                            <span class="nilai"><?= $bobot_nilai_e[$id]; ?></span>
                        </div>
                        </div>
                        <?php endif; ?>
                        <?php else :
                                $soal = [
                                    $soal['gambar_a'],
                                    $soal['gambar_b'],
                                    $soal['gambar_c'],
                                    $soal['gambar_d'],
                                    $soal['gambar_e']
                                ];
                            ?>

                        <?php for ($i = 0; $i <= 4; $i++) : ?>
                        <div class="custom-control custom-radio mb-3">
                            <?php if ($soal[$i]) : ?>
                            <?php if ($kunci_jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
                            <label for="jawaban_bener" class="custom-control-label"> <span class="badge badge-success">Correct
                                    Answer</span>
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label" style="background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5; font-weight: bold;"> <span
                                    class="badge text-bg-secondary rounded">Your
                                    Answer</span>
                                <br>
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                            <label for="jawaban_salah" class="custom-control-label">
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if ($jawaban[$id] == $data[$i]) : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
                            <label for="jawaban_tkp" class="custom-control-label"> <span style="background-color: #fef9c3; color: #92400e; border-color: #fde68a; box-shadow: 0 0 0 3px rgba(253, 230, 138, 0.5);" class="badge text-bg-secondary rounded">Your
                                    Answer</span>
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php else : ?>
                            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
                            <label for="jawaban_tkp" class="custom-control-label">
                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                </div>
                            </label>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endfor; ?>

                        <?php if ($bobot_nilai_a[1] != null) : ?>
                        <br>
                        <p style="font-weight: bold; font-size: 1.1rem; margin-bottom: 0.5rem;">Nilai Setiap Jawaban :</p>
                        <div class="nilai-wrapper d-flex flex-wrap gap-2">
                        <div class="nilai-item">
                            <span class="huruf">A</span>
                            <span class="nilai"><?= $bobot_nilai_a[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">B</span>
                            <span class="nilai"><?= $bobot_nilai_b[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">C</span>
                            <span class="nilai"><?= $bobot_nilai_c[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">D</span>
                            <span class="nilai"><?= $bobot_nilai_d[$id]; ?></span>
                        </div>
                        <div class="nilai-item">
                            <span class="huruf">E</span>
                            <span class="nilai"><?= $bobot_nilai_e[$id]; ?></span>
                        </div>
                        </div>
                        
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($gambar_pembahasan || $pembahasan) : ?>
                        <hr>
                        <label for="pembahasan_soal" style="font-weight: bold; font-size: 1.3em">Pembahasan :</label><br>
                        <?php endif; ?>
                        <?php if ($gambar_pembahasan) : ?>
                        <div class="col-md-8">
                            <img src="<?= base_url('assets/img/soal/') . $gambar_pembahasan; ?>" class="img-fluid rounded-start">
                        </div>
                        <br>
                        <?php endif; ?>
                        <?php if ($pembahasan) : ?>
                        <p class="" style="color: black; font-size: 125%; text-align: justify;"><?= $pembahasan; ?></p>
                        <?php endif; ?>

                        <div class="text-center my-4">
                            <?php if ($id == 1) : ?>
                            <a class="btn btn-primary"
                                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id + 1]); ?>"><i
                                    class="fas fa-chevron-right mx-2 kotak"></i></a>
                            <?php else : ?>
                            <?php if ($id == count($soal_lengkap)) : ?>
                            <a class="btn btn-primary"
                                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id - 1]); ?>"><i
                                    class="fas fa-chevron-left mx-2 kotak"></i></a>
                            <?php else : ?>
                            <a class="btn btn-primary"
                                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id - 1]); ?>"><i
                                    class="fas fa-chevron-left mx-2 kotak"></i></a>
                            <a class="btn btn-primary"
                                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id + 1]); ?>"><i
                                    class="fas fa-chevron-right mx-2 kotak"></i></a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

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