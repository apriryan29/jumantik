<?php
include 'admin/include/config.php';

/* =======================
   DATA TENTANG KAMI
======================= */
$q_tentang = mysqli_query($conn, "SELECT deskripsi FROM tb_tentang LIMIT 1");
$tentang = mysqli_fetch_assoc($q_tentang);
$isi_tentang = $tentang['deskripsi'] ?? '';

/* =======================
   DATA STATISTIK ANGKA
======================= */
// Jumlah RW
$q_rw = mysqli_query($conn, "SELECT COUNT(DISTINCT rw) AS total FROM tb_statistik");
$rw = mysqli_fetch_assoc($q_rw)['total'] ?? 0;

// Total Patuh
$q_patuh = mysqli_query($conn, "SELECT SUM(patuh) AS total FROM tb_statistik");
$patuh = mysqli_fetch_assoc($q_patuh)['total'] ?? 0;

// Total Tidak Patuh
$q_tidak = mysqli_query($conn, "SELECT SUM(tidak_patuh) AS total FROM tb_statistik");
$tidak = mysqli_fetch_assoc($q_tidak)['total'] ?? 0;

// Total Keluarga
$keluarga = $patuh + $tidak;

/* =======================
   DATA CHART
======================= */
$q_chart = mysqli_query($conn, "SELECT rw, patuh, tidak_patuh FROM tb_statistik ORDER BY rw");

$label_rw = [];
$data_patuh = [];
$data_tidak = [];

while ($row = mysqli_fetch_assoc($q_chart)) {
    $label_rw[]   = 'RW ' . $row['rw'];
    $data_patuh[] = (int)$row['patuh'];
    $data_tidak[] = (int)$row['tidak_patuh'];
}
?>

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami<br></h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
            <p style="text-align: justify;">
              <?= nl2br(htmlspecialchars($isi_tentang)) ?>
            </p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $keluarga ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Total Keluarga</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $tidak ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Tidak Patuh Jumantik</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $patuh ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Patuh Jumantik</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?= $rw ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Jumlah RW</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- About Alt Section -->
    <section id="chart-jumantik" class="about-alt section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
          <h2>Statistik Kepatuhan Jumantik</h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-12">
            <canvas id="jumantikChart" height="120"></canvas>
          </div>
        </div>

      </div>

    </section><!-- /About Alt Section -->


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('jumantikChart').getContext('2d');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($label_rw) ?>,
    datasets: [
      {
        label: 'Patuh Jumantik',
        data: <?= json_encode($data_patuh) ?>,
        borderColor: '#198754',
        backgroundColor: 'rgba(25,135,84,0.2)',
        tension: 0.4,
        fill: true
      },
      {
        label: 'Tidak Patuh Jumantik',
        data: <?= json_encode($data_tidak) ?>,
        borderColor: '#dc3545',
        backgroundColor: 'rgba(220,53,69,0.2)',
        tension: 0.4,
        fill: true
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'top' }
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Jumlah KK'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Wilayah RW'
        }
      }
    }
  }
});
</script>