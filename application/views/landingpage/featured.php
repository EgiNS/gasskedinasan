<style>
    .gk-bg-featured {
        background-color: #1F2A37;
    }

    .feature-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(2, 1fr); /* Laptop: 2 kolom */
        width: 100%;
    }

    .feature-card {
        background: white;
        color: #1F2A37;
        border-radius: 8px;
        padding: 16px;
        display: flex;
        gap: 16px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.08);
    }

    @media (max-width: 992px) {
        .featured-section {
            padding: 40px 20px !important;
        }
        .feature-grid {
            grid-template-columns: 1fr; /* Tablet & HP: 1 kolom */
        }
    }
</style>

<div class="container-fluid gk-bg-featured text-white d-flex flex-column justify-content-center align-items-center featured-section" style="padding: 80px 100px; gap: 24px;">
    <h3 style="font-size: 28px;" class="text-white">
        Program Unggulan Kami
    </h3>
    <p style="font-size: 20px; width: 80%; line-height: 1.6; margin-bottom: 52px;" class="text-center">
        Pilih cara belajar yang paling cocok untukmu. Semua program dirancang untuk mempersiapkan kamu menghadapi setiap tahap seleksi sekolah kedinasan dari SKD hingga psikotes dan wawancara.
    </p>
<div class="feature-grid">

    <div class="feature-card">
        <img src="assets/assets_lp/img/icon/writing.svg" alt="">
        <div>
            <h6 style="font-size: 18px;">Kelas Reguler Online</h6>
            <p style="font-size: 16px;">Belajar intensif setiap minggu bersama mentor melalui live class dan latihan soal interaktif.</p>
        </div>
    </div>

    <div class="feature-card">
        <img src="assets/assets_lp/img/icon/card-name.svg" alt="">
        <div>
            <h6 style="font-size: 18px;">Tryout Nasional Berbasis CAT</h6>
            <p style="font-size: 16px;">Sistem tryout dengan simulasi asli seperti seleksi sekolah kedinasan.</p>
        </div>
    </div>

    <div class="feature-card">
        <img src="assets/assets_lp/img/icon/location.svg" alt="">
        <div>
            <h6 style="font-size: 18px;">Kelas Premium (Privat)</h6>
            <p style="font-size: 16px;">Sesi eksklusif 1-on-1 bersama mentor untuk strategi dan pembahasan mendalam.</p>
        </div>
    </div>

    <div class="feature-card">
        <img src="assets/assets_lp/img/icon/star.svg" alt="">
        <div>
            <h6 style="font-size: 18px;">Bank Soal & Analisis Nilai</h6>
            <p style="font-size: 16px;">Ribuan soal terbaru beserta pembahasan dan analisis performa otomatis.</p>
        </div>
    </div>

</div>
</div>