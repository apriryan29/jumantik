<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include'head.php' ?>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
     <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="../index.php"><img src="../assets/img/header.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../index.php"><img src="../assets/img/icon.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Pencarian disini" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <i class="icon-head menu-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="icon-columns menu-icon"></i>
                Data Jumantik
              </a>
              <a class="dropdown-item" onclick="confirmLogout()">
                <i class="ti-shift-right btn-icon-prepend"></i>
                Keluar
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admintentang.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Tentang Kami</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mitra" aria-expanded="false" aria-controls="mitra">
              <i class="icon-briefcase menu-icon"></i>
              <span class="menu-title">Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mitra">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="tim.php">Data Tim</a></li>
                <li class="nav-item"> <a class="nav-link" href="statistik.php">Statistik</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="galeri.php">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Dokumentasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="video.php">
              <i class="icon-star menu-icon"></i>
              <span class="menu-title">Link Video Edukasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="icon-plus menu-icon"></i>
              <span class="menu-title">Pengguna</span>
            </a>
          </li>
        </ul>
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-outline-secondary btn-icon-text" onclick="confirmLogout()">
                <i class="ti-shift-right btn-icon-prepend"></i>                                                    
                Keluar
            </button>
        </div>
      </nav>

  
<script>
function confirmLogout() {
    if (confirm("Apakah Anda yakin ingin keluar?")) {
        window.location.href = "logout.php";
    }
}
</script>