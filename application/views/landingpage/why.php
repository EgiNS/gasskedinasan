<style>
/* container utama */
.why-bg {
    padding: 0px 100px;
  gap: 2rem;
  /* beri min-height supaya selalu ada ruang saat zoom */
  min-height: 420px;
  box-sizing: border-box;
      background-image: 
        linear-gradient(270deg, #EBF5FF 0%, #233876 50%),
        url("assets/assets_lp/img/gass/Why_Image.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-blend-mode: multiply;
}

/* kiri */
.why-left {
  width: 50%;
  padding: 40px 0px;
}
.why-title {
  font-size: 52px;
  margin-bottom: 28px;
  line-height: 1.05;
  color: white;
}
.why-desc {
  font-size: 20px;
  line-height: 1.6;
  margin-bottom: 24px;
}
.why-list {
  font-size: 20px;
  list-style: none;
  padding-left: 0;
  margin-top: 8px;
  line-height: 1.8;
}

/* kanan - pembungkus relatif agar gambar absolut berada di dalamnya */
.why-right {
  width: 50%;
  position: relative;         /* penting untuk positioning absolut gambar */
  display: flex;
  align-items: stretch;
  justify-content: center;
  padding: 20px;
  padding-bottom: 0px;
  padding-left: 0;
  box-sizing: border-box;
}

/* wrapper gambar untuk menjaga ukuran & overflow */
.why-image-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 320px;          /* fallback minimal tinggi gambar area */
  display: block;
}

/* gambar ditempatkan absolut di dasar wrapper */
.why-image {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  max-width: 85%;             /* lebar relatif, sesuaikan */
  width: auto;
  /* batasi tinggi agar tidak melebihi kontainer saat zoom */
  max-height: calc(100% - 10px);
  object-fit: contain;
  display: block;
  user-select: none;
  pointer-events: none;
}

/* RESPONSIVE */
@media (max-width: 992px) {
  .why-bg { padding: 25px; min-height: 480px; flex-direction: column; }
  .why-right {display: none;}
  .why-left, .why-right { width: 100%; }
  .why-title { font-size: 36px; width: 100%; margin-bottom: 18px; }
  .why-image { max-width: 60%; max-height: 280px; }
}

@media (max-width: 576px) {
  .why-title { font-size: 28px; }
  .why-desc, .why-list { font-size: 16px; }
  .why-image { max-width: 80%; max-height: 240px; }
}

</style>

<div class="container-fluid why-bg d-flex justify-content-center align-items-stretch overflow-hidden">
  <div class="why-left text-white">
    <h1 class="why-title">Kenapa Harus <br> Gass Education?</h1>
    <p class="why-desc">
      Gass Education adalah platform bimbingan belajar khusus sekolah kedinasan yang telah membantu ribuan pelajar di seluruh Indonesia mewujudkan mimpinya masuk perguruan tinggi kedinasan.  Kami menyediakan sistem belajar interaktif dengan mentor ahli, materi terkini sesuai kisi-kisi resmi, serta komunitas belajar yang solid agar kamu tidak merasa belajar sendirian.
    </p>

    <ul class="why-list">
      <li>🎯 Materi sesuai kisi-kisi seleksi resmi</li>
      <li>🧠 Mentor profesional dan alumni sekolah kedinasan</li>
      <li>📈 Progress belajar terpantau otomatis</li>
      <li>🤝 Grup diskusi dan dukungan komunitas aktif</li>
    </ul>
  </div>

  <div class="why-right">
    <div class="why-image-wrapper">
      <img src="assets/assets_lp/img/gass/why_people.png" alt="Foto Orang" class="why-image">
    </div>
  </div>
</div>
