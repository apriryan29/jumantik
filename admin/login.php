<?php 
session_start();
include 'include/head.php';
include 'include/config.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // QUERY sesuai tabel user milikmu
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        // password TIDAK di-hash (sesuai struktur tabel kamu)
        if ($password == $data['password']) {

            // Simpan session
            $_SESSION['id_user']  = $data['id_user'];
            $_SESSION['username'] = $data['username'];

            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 shadow rounded">

              <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?= $error; ?></div>
              <?php } ?>

              <div class="brand-logo">
                <a href="../index.php">
                  <img src="../assets/img/header.png" alt="logo">
                </a>
              </div>

              <h4>Selamat Datang!</h4>
              <h6 class="font-weight-light">Silakan Login untuk melanjutkan</h6>

              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                </div>

                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                </div>

                <div class="mt-3">
                  <button type="submit" name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    Masuk
                  </button>
                </div>

                <div class="my-2 d-flex justify-content-end align-items-end">
                  <a href="#" class="auth-link text-black">Lupa Kata Sandi?</a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
