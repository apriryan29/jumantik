<?php
include 'admin/include/config.php';

$q_galeri = mysqli_query($conn, "
  SELECT judul, deskripsi, foto 
  FROM tb_galeri 
  ORDER BY id_galeri DESC
");

$q_tentang = mysqli_query($conn, "SELECT nomor FROM tb_tentang LIMIT 1");
$tentang = mysqli_fetch_assoc($q_tentang);
$no_wa = $tentang['nomor'];
?>


<!-- Services Section -->
<section id="services" class="services section light-background">

  <div class="container section-title" data-aos="fade-up">
    <h2>Galeri Kegiatan</h2>
  </div>

  <div class="container">
    <div class="row gy-4 justify-content-center">

      <?php if (mysqli_num_rows($q_galeri) > 0): ?>
        <?php $delay = 100; ?>
        <?php while ($g = mysqli_fetch_assoc($q_galeri)): ?>
          <div class="col-lg-4 col-md-6" data-aos="zoom-out" data-aos-delay="<?= $delay ?>">
            <div class="service-item position-relative h-100">
              
              <!-- Wrapper hanya untuk gambar -->
              <div class="image-wrapper">
                <img src="uploads/galeri/<?= htmlspecialchars($g['foto']) ?>"
                    class="card-img-top"
                    alt="<?= htmlspecialchars($g['judul']) ?>">
              </div>

              <!-- Judul dan deskripsi di luar image-wrapper -->
              <h3><?= htmlspecialchars($g['judul']) ?></h3>

              <p style="text-align: justify;">
                <?= nl2br(htmlspecialchars($g['deskripsi'])) ?>
              </p>

            </div>
          </div>
        <?php 
          $delay += 100;
        endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p>Belum ada dokumentasi kegiatan.</p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<!-- /Services Section -->


    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Mulai Konsultasi</h3>
              <p>Layanan Kami buka selama 25 Jam dalam sehari. Mulai konsultasikan permasalahan anda sebagai jalan keluar dari Jentik Nyamuk.</p>
              <a class="cta-btn" href="https://wa.me/<?= htmlspecialchars($no_wa) ?>" target="_blank">Kirim Pesan</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->


    <style>
      .image-wrapper {
        width: 100%;
        height: 250px; /* tinggi seragam untuk semua gambar */
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 15px; /* jarak ke judul */
      }

      .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
      }

      .image-wrapper img:hover {
        transform: scale(1.05);
      }
      </style>
