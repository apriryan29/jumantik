<?php
include 'admin/include/config.php';

// Ambil data kontak dari tb_tentang
$q_tentang = mysqli_query($conn, "SELECT * FROM tb_tentang LIMIT 1");
$tentang = mysqli_fetch_assoc($q_tentang);
?>

<footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-6 col-md-12 footer-about">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <?php echo '<img src="./assets/img/header.png" alt="logo jumantik">' ?>
        </a>

          <p>Layanan Juru Pemantau Jentik Desa Jingkang Kecamatan Ajibarang, Banyumas</p>
          <div class="social-links d-flex mt-4">
            <a href="<?= htmlspecialchars($tentang['link_ig'] ?? '#') ?>" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="<?= htmlspecialchars($tentang['link_tiktok'] ?? '#') ?>" target="_blank"><i class="bi bi-tiktok"></i></a>
            <a href="https://wa.me/<?= htmlspecialchars($tentang['nomor'] ?? '#') ?>" target="_blank"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6 footer-links">
          <h4>Tautan Bermanfaat</h4>
          <ul>
            <li><a href="#hero">Beranda</a></li>
            <li><a href="#about">Tentang Jumantik</a></li>
            <li><a href="#services">Galeri</a></li>
            <li><a href="#team">Tim Kami</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Info Kontak</h4>
          <p><?= htmlspecialchars($tentang['alamat']) ?></p>
          <p class="mt-4"><strong>Phone:</strong> <span><?= htmlspecialchars($tentang['nomor']) ?></span></p>
          <p><strong>Email:</strong> <span><?= htmlspecialchars($tentang['email']) ?></span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>©<strong class="px-1 sitename">2026</strong> <span>All System Created by <strong>KKN 017 UMP 2026</strong></span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>