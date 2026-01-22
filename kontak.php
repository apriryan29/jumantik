<?php
include 'admin/include/config.php';

// Ambil data kontak dari tb_tentang
$q_tentang = mysqli_query($conn, "SELECT alamat, nomor, email FROM tb_tentang LIMIT 1");
$tentang = mysqli_fetch_assoc($q_tentang);
?>


<!-- Contact Section -->
<section id="contact" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Alamat Layanan Jumantik</h2>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

    
      <!-- Kolom Map (KANAN) -->
      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        <iframe
          style="border:1; width: 100%; height: 100%; min-height: 270px;"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.169315555432!2d109.10454027504873!3d-7.446511792564562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6566b250fed5b5%3A0x505a062d166dd2df!2sBalai%20Desa%20Jingkang!5e0!3m2!1sid!2sid!4v1768896385817!5m2!1sid!2sid"
          frameborder="0"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

      <!-- Kolom Alamat & Kontak (KIRI) -->
      <div class="col-lg-4">

        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
          <i class="bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h3>Alamat</h3>
            <p><?= htmlspecialchars($tentang['alamat']) ?></p>
          </div>
        </div>

        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
          <i class="bi bi-telephone flex-shrink-0"></i>
          <div>
            <h3>Phone</h3>
            <p><?= htmlspecialchars($tentang['nomor']) ?></p>
          </div>
        </div>

        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
          <i class="bi bi-envelope flex-shrink-0"></i>
          <div>
            <h3>Email Kami</h3>
            <p><?= htmlspecialchars($tentang['email']) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
