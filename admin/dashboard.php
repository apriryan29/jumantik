<?php
include 'include/config.php';
if(!isset($_SESSION['id_user'])){
    // jika belum login, arahkan ke login.php
    header('Location: login.php');
    exit;
}

// JUMLAH RW (jumlah baris / RW unik)
$q_rw = mysqli_query($conn,
    "SELECT COUNT(DISTINCT rw) AS total FROM tb_statistik"
);
$rw = mysqli_fetch_assoc($q_rw)['total'] ?? 0;

// TOTAL PATUH (JUMLAH VALUE KOLOM)
$q_patuh = mysqli_query($conn,
    "SELECT SUM(patuh) AS total FROM tb_statistik"
);
$patuh = mysqli_fetch_assoc($q_patuh)['total'] ?? 0;

// TOTAL TIDAK PATUH (JUMLAH VALUE KOLOM)
$q_tidak = mysqli_query($conn,
    "SELECT SUM(tidak_patuh) AS total FROM tb_statistik"
);
$tidak = mysqli_fetch_assoc($q_tidak)['total'] ?? 0;

// JUMLAH KELUARGA = TOTAL PATUH + TOTAL TIDAK PATUH
$keluarga = $patuh + $tidak;

// ==========================
// DATA UNTUK CHART
// ==========================
$q_chart = mysqli_query($conn,
    "SELECT rw, patuh, tidak_patuh FROM tb_statistik ORDER BY rw"
);

$label_rw = [];
$data_patuh = [];
$data_tidak = [];

while ($row = mysqli_fetch_assoc($q_chart)) {
    $label_rw[]  = 'RW ' . $row['rw'];
    $data_patuh[] = (int)$row['patuh'];
    $data_tidak[] = (int)$row['tidak_patuh'];
}

$label_rw   = json_encode($label_rw);
$data_patuh = json_encode($data_patuh);
$data_tidak = json_encode($data_tidak);
?>


 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Selamat Datang Admin! <br> di Sistem Informasi Jingkang Jumantik</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-body">
                  <h4 class="card-title text-black text-center">
                    Statistik Kepatuhan Jumantik
                  </h4>
                  <section id="chart-jumantik" class="about-alt section p-0">
                    <div class="container-fluid">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <canvas id="jumantikChart" height="120"></canvas>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Jumlah Keluarga</p>
                      <p class="fs-30 mb-2"><?= $keluarga ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Jumlah RW</p>
                      <p class="fs-30 mb-2"><?= $rw ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Patuh Jumantik</p>
                      <p class="fs-30 mb-2"><?= $patuh ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Tidak Patuh Jumantik</p>
                      <p class="fs-30 mb-2"><?= $tidak ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© 2026. All System Created by <strong>KKN 017 UMP 2026</strong></span>
          </div>
        </footer> 
        <!-- partial -->
      </div>


   <!-- Chart.js -->
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('jumantikChart').getContext('2d');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= $label_rw ?>,
      datasets: [
        {
          label: 'Patuh Jumantik',
          data: <?= $data_patuh ?>,
          borderColor: '#198754',
          backgroundColor: 'rgba(25, 135, 84, 0.2)',
          tension: 0.4,
          fill: true
        },
        {
          label: 'Tidak Patuh Jumantik',
          data: <?= $data_tidak ?>,
          borderColor: '#dc3545',
          backgroundColor: 'rgba(220, 53, 69, 0.2)',
          tension: 0.4,
          fill: true
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top'
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

