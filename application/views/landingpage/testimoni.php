<style>
    .gk-text-grey{
        color: #6B7280;
    }
    .testimonial-grid {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(5, 1fr); /* Desktop: 5 kolom */
    }

    .testimonial-card {
        border-radius: 8px;
        padding: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: #fff;
    }

    .testimonial-img {
        width: 100%;
        height: 210px;
        object-fit: cover;
        object-position: center;
        border-radius: 8px;
    }

    /* Tablet */
    @media (max-width: 992px) {
        .testimoni-section {
            padding: 40px 20px !important;
        }
        .testimonial-grid {
            grid-template-columns: repeat(2, 1fr); /* jadi 2 kolom */
        }
    }

    /* HP */
    @media (max-width: 576px) {
        .testimonial-grid {
            grid-template-columns: 1fr; /* jadi 1 kolom */
        }
        .testimonial-card {
            text-align: center;
        }
    }
</style>
<div class="container-fluid overflow-hidden testimoni-section" style="padding: 50px 100px;">
    <h3 class="text-dark text-center" style="font-size: 36px; margin-bottom: 20px;">Cerita Sukses dari Mereka yang Sudah Lolos</h3>
    <p class="text-center text-dark" style="font-size: 18px; margin-bottom: 60px;"> Ribuan pelajar sudah berhasil menembus sekolah kedinasan berkat bimbingan di Gass Education. Berikut kisah inspiratif mereka.</p>
    
    <div class="testimonial-grid">

        <div class="testimonial-card">
            <img class="testimonial-img" src="assets/assets_lp/img/gass/reza.jpg" alt="">
            <p class="text-dark mt-2" style="font-weight: bold; font-size:22px;">Reza</p>
            <p class="gk-text-grey" style="font-size: 18px;">STIS 2024</p>
            <p class="gk-text-grey" style="font-size: 18px;">Latihannya mirip banget sama ujian asli! Gass Education bikin aku percaya diri waktu tes SKD.</p>
        </div>

        <div class="testimonial-card">
            <img class="testimonial-img" src="assets/assets_lp/img/gass/nadya.jpg" alt="">
            <p class="text-dark mt-2" style="font-weight: bold; font-size:22px;">Nadya</p>
            <p class="gk-text-grey" style="font-size: 18px;">STAN 2024</p>
            <p class="gk-text-grey" style="font-size: 18px;">Mentornya seru dan sabar banget. Penjelasannya bikin rumus yang susah jadi gampang.</p>
        </div>

        <div class="testimonial-card">
            <img class="testimonial-img" src="assets/assets_lp/img/gass/bima.jpg" alt="">
            <p class="text-dark mt-2" style="font-weight: bold; font-size:22px;">Bima</p>
            <p class="gk-text-grey" style="font-size: 18px;">IPDN 2023</p>
            <p class="gk-text-grey" style="font-size: 18px;">Tryout-nya beneran real. Aku bisa tahu ranking nasional dan fokus perbaiki kelemahan.</p>
        </div>

        <div class="testimonial-card">
            <img class="testimonial-img" src="assets/assets_lp/img/gass/sarah.jpg" alt="">
            <p class="text-dark mt-2" style="font-weight: bold; font-size:22px;">Sarah</p>
            <p class="gk-text-grey" style="font-size: 18px;">STIN 2024</p>
            <p class="gk-text-grey" style="font-size: 18px;">Pembelajarannya interaktif banget. Grup diskusi juga aktif, bikin semangat terus.</p>
        </div>

        <div class="testimonial-card">
            <img class="testimonial-img" src="assets/assets_lp/img/gass/reza.jpg" alt="">
            <p class="text-dark mt-2" style="font-weight: bold; font-size:22px;">Reza</p>
            <p class="gk-text-grey" style="font-size: 18px;">STIS 2024</p>
            <p class="gk-text-grey" style="font-size: 18px;">Latihannya mirip banget sama ujian asli! Gass Education bikin aku percaya diri waktu tes SKD.</p>
        </div>

    </div>
</div>