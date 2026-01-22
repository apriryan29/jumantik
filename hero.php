<?php
include 'admin/include/config.php';

// Ambil 1 data video
$q_video = mysqli_query($conn, "SELECT * FROM tb_video LIMIT 1");
$video = mysqli_fetch_assoc($q_video);

// Jika belum ada data
$judul = $video['judul'] ?? '';
$link  = $video['link'] ?? '';
$desk  = $video['deskripsi'] ?? '';

// Ambil ID video YouTube
$video_id = '';
if ($link) {
    preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11})/', $link, $matches);
    $video_id = $matches[1] ?? '';
}
?>

    
    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/latar.png" alt="" data-aos="fade-in" class="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-out">
          <div class="col-xl-9 col-lg-9 text-center">
            <h1>Selamat Datang di <br>Sistem Informasi Jingkang Jumantik</h1>
            <p>Juru Pemantau Jentik Desa Jingkang Kecamatan Ajibarang Kabupaten Banyumas</p>
          </div>
        </div>
        <div class="text-center" data-aos="zoom-out" data-aos-delay="100">
          <a href="#call-to-action" class="btn-get-started">Konsultasi Disini !</a>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Alt Section -->
    <section id="about-alt" class="about-alt section">

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">

            <?php if ($video_id): ?>
              <img src="https://img.youtube.com/vi/<?= $video_id ?>/maxresdefault.jpg" class="img-fluid" alt="">
              <a href="<?= $link ?>" class="glightbox pulsating-play-btn"></a>
            <?php else: ?>
              <img src="assets/img/default-video.jpg" class="img-fluid" alt="">
            <?php endif; ?>

          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3><?= htmlspecialchars($judul) ?></h3>
            <p class="fst-italic">
              <?= nl2br(htmlspecialchars($desk)) ?>
            </p>
          </div>
        </div>

      </div>

    </section>
    <!-- /About Alt Section -->

