<?php
include 'include/config.php';

// ================= PROSES TAMBAH =================
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_pengguna']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // simpan plaintext

    mysqli_query($conn, "INSERT INTO user (nama_pengguna, username, password) VALUES ('$nama','$username','$password')");
    echo "<script>alert('Data berhasil disimpan');window.location='user.php';</script>";
}

// ================= PROSES UPDATE =================
if(isset($_POST['update'])){
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_pengguna']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // plaintext

    if(!empty($password)){
        // update termasuk password baru
        mysqli_query($conn, "UPDATE user SET nama_pengguna='$nama', username='$username', password='$password' WHERE id_user=$id");
    } else {
        // update tanpa mengganti password
        mysqli_query($conn, "UPDATE user SET nama_pengguna='$nama', username='$username' WHERE id_user=$id");
    }
    echo "<script>alert('Data berhasil diperbarui');window.location='user.php';</script>";
}

// ================= PROSES HAPUS =================
if(isset($_GET['hapus'])){
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM user WHERE id_user=$id");
    echo "<script>alert('Data berhasil dihapus');window.location='user.php';</script>";
}

// ================= AMBIL DATA UNTUK TABEL =================
$data = mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC");

// ================= AMBIL DATA UNTUK EDIT =================
$edit = null;
if(isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    $q = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id");
    $edit = mysqli_fetch_assoc($q);
}
?>

<?php include 'include/header.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">

    <!-- ================= FORM TAMBAH / EDIT ================= -->
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?= $edit ? 'Edit' : 'Tambah' ?> Pengguna</h4>
            <p class="card-description">Formulir Pengguna Sistem</p>

            <form method="POST">
              <input type="hidden" name="id" value="<?= $edit['id_user'] ?? '' ?>">

              <div class="form-group">
                <label>Nama Pengguna Sistem</label>
                <input type="text" class="form-control" name="nama_pengguna"
                  value="<?= $edit['nama_pengguna'] ?? '' ?>" placeholder="Masukkan Nama Pengguna Sistem" required>
              </div>

              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username"
                  value="<?= $edit['username'] ?? '' ?>" placeholder="Masukkan Username" required>
              </div>

              <div class="form-group">
                <label>Kata Sandi</label>
                <input type="text" class="form-control" name="password"
                  value="" placeholder="Masukkan Kata Sandi" <?= $edit ? '' : 'required' ?>>
                <?php if($edit): ?>
                  <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password</small>
                <?php endif; ?>
              </div>

              <?php if($edit): ?>
                <button type="submit" name="update" class="btn btn-warning mr-2">
                  <i class="bi bi-pencil-square"></i> Perbarui
                </button>
                <a href="user.php" class="btn btn-light">Batal</a>
              <?php else: ?>
                <button type="submit" name="simpan" class="btn btn-primary mr-2">
                  <i class="bi bi-person-plus"></i> Simpan
                </button>
                <button type="reset" class="btn btn-light">Batal</button>
              <?php endif; ?>
            </form>

          </div>
        </div>
      </div>
    </div>

    <!-- ================= TABEL PENGGUNA ================= -->
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data Pengguna Sistem</h4>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($r = mysqli_fetch_assoc($data)): ?>
                  <tr>
                    <td><?= htmlspecialchars($r['nama_pengguna']) ?></td>
                    <td><?= htmlspecialchars($r['username']) ?></td>
                    <td><?= str_repeat('*', strlen($r['password'])) ?></td>
                    <td>
                      <a href="user.php?edit=<?= $r['id_user'] ?>" class="btn btn-sm btn-warning">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="user.php?hapus=<?= $r['id_user'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="ti-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include 'include/footer.php'; ?>

  
    <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted">© 2026. All System Created by <strong>KKN 017 UMP 2026</strong></span>
    </div>
  </footer>
  </div>
</div>