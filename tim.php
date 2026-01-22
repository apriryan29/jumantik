<?php
include 'admin/include/config.php';

$q_tim = mysqli_query($conn, "
    SELECT nama, jabatan, nomor, foto, link_ig, link_fb 
    FROM tb_tim 
    ORDER BY id_tim ASC
");
?>


<section id="team" class="team section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Tim Kami</h2>
  </div>

  <div class="container">
    <div class="row gy-4 justify-content-center">

      <?php if(mysqli_num_rows($q_tim) > 0): ?>
        <?php $delay = 100; ?>
        <?php while($t = mysqli_fetch_assoc($q_tim)): ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <div class="team-member">
              <div class="member-img">
                <img src="uploads/<?= htmlspecialchars($t['foto']) ?>" class="img-fluid" alt="<?= htmlspecialchars($t['nama']) ?>">
                <div class="social">
                  <?php if($t['link_fb']): ?><a href="<?= htmlspecialchars($t['link_fb']) ?>"><i class="bi bi-facebook"></i></a><?php endif; ?>
                  <?php if($t['link_ig']): ?><a href="<?= htmlspecialchars($t['link_ig']) ?>"><i class="bi bi-instagram"></i></a><?php endif; ?>
                  <?php if($t['nomor']): ?><a href="https://wa.me/<?= htmlspecialchars($t['nomor']) ?>" target="_blank"><i class="bi bi-whatsapp"></i></a><?php endif; ?>
                </div>
              </div>
              <div class="member-info">
                <h4><?= htmlspecialchars($t['nama']) ?></h4>
                <span><?= htmlspecialchars($t['jabatan']) ?></span>
              </div>
            </div>
          </div>
          <?php $delay += 100; ?>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p>Belum ada data tim.</p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

