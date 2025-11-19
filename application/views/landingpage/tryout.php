<div class="container-fluid text-dark" style="padding: 50px 100px;">
    <div class="d-flex mb-5 flex-row-reverse align-items-center">
    <div style="width: 40%;" class="">
     <h1 style="font-size: 40px;" class="mb-3 text-end">
            Tryout
        </h1>
        <p style="font-size: 18px; line-height: 1.6;" class="text-end">Simulasikan ujian dengan sistem seperti aslinya. Dapatkan skor real-time, pembahasan lengkap, dan ranking nasional untuk mengukur sejauh mana kesiapanmu.</p>
    </div>
       <div class="d-flex" style="width: 60%;">
    <div class="d-flex flex-column align-items-start w-50" style="gap: 12px; padding: 20px; margin-right: 20px;">
        <img src="assets/assets_lp/img/icon/monitor-cog.svg" alt="" class="d-inline-block">
        <p style="font-size: 18px; font-weight: bold;">SKD</p>
    </div>
    <div class="d-flex flex-column align-items-start w-50" style="gap: 12px; padding: 20px; margin-right: 20px;">
        <img src="assets/assets_lp/img/icon/monitor-cog.svg" alt="" class="d-inline-block">
        <p style="font-size: 18px; font-weight: bold;">Matematika Khusus</p>
    </div>
       </div>
    </div>
    <?php if($show): ?>
        <div class="d-flex justify-content-start align-items-center">
            <div class="w-50">
                    <img class="w-75" src="<?= base_url('assets/img/' . $tryout["gambar"]); ?>" alt="Banner">
            </div>
            <div class="w-50">
                <h3 class="text-blue mb-3" style="font-size: 20px;">
                    <?= $tryout['name'] ?>
                </h3>
                <!-- <p style="font-size: 32px; font-weight: bold;" class="mb-5">
                    Sikat TO MTK STIS Secepat Kilat !!!
                </p>
                <ul style="list-style-type: none; padding: 0; gap: 12px; font-size: 18px;" class="mb-4 d-flex flex-column">
                    <li>✅ Total 6 paket TO MATEMATIKA STIS</li>
                    <li>✅ Fast Scoring dan Ranking Nasional</li>
                    <li>✅ Soal berdasarkan tes asli</li>
                    <li>✅ Bisa dikerjakan lewat media apapun </li>
                    <li>✅ Answer Analysis dan Pembahasan PDF </li>
                    <li>✅ Bisa Dikerjakan Berkali-kali</li>
                    <li>✅ Bonus: Rekaman Zoom 4 Live Class dan Grup Belajar </li>
                </ul> -->
                <div style="list-style-type: none; padding: 0; gap: 12px; font-size: 18px;" class="keterangan-wrapper mb-4 d-flex flex-column">
                    <?= $show->keterangan ?>
                </div>
                <button class="btn btn-blue" style="padding: 16px 28px; font-size: 16px;">Daftar Sekarang <span><i class="fas fa-arrow-right"></i></span></button>
            </div>
        </div>
    <?php endif; ?>
</div>