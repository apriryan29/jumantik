<?php
include 'include/config.php';

/* ================= HAPUS DATA ================= */
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($conn, "DELETE FROM tb_statistik WHERE id_statistik='$id'");
  echo "<script>alert('Data berhasil dihapus');location='statistik.php';</script>";
}

/* ================= SIMPAN DATA ================= */
if (isset($_POST['simpan'])) {
  $rw          = $_POST['rw'];
  $patuh       = $_POST['patuh'];
  $tidak_patuh = $_POST['tidak_patuh'];

  mysqli_query($conn, "
    INSERT INTO tb_statistik (rw, patuh, tidak_patuh)
    VALUES ('$rw','$patuh','$tidak_patuh')
  ");

  echo "<script>alert('Data berhasil disimpan');location='statistik.php';</script>";
}

/* ================= UPDATE DATA ================= */
if (isset($_POST['update'])) {
  $id          = $_POST['id'];
  $rw          = $_POST['rw'];
  $patuh       = $_POST['patuh'];
  $tidak_patuh = $_POST['tidak_patuh'];

  mysqli_query($conn, "
    UPDATE tb_statistik SET
      rw='$rw',
      patuh='$patuh',
      tidak_patuh='$tidak_patuh'
    WHERE id_statistik='$id'
  ");

  echo "<script>alert('Data berhasil diperbarui');location='statistik.php';</script>";
}

/* ================= DATA EDIT ================= */
$edit = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $edit = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM tb_statistik WHERE id_statistik='$id'")
  );
}

/* ================= DATA TABLE ================= */
$data = mysqli_query($conn, "SELECT * FROM tb_statistik ORDER BY id_statistik DESC");
?>

<?php include 'include/header.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">

    <!-- ================= FORM ================= -->
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
          <h4 class="card-title">Statistik Jumantik</h4>
          <p class="card-description">Formulir Statistik</p>

          <form method="POST">
          <input type="hidden" name="id" value="<?= $edit['id_statistik'] ?? '' ?>">

          <div class="form-group">
            <label>Nama RW</label>
            <input type="text" class="form-control" name="rw"
              value="<?= $edit['rw'] ?? '' ?>" placeholder="Masukan Nama RW" required>
          </div>

          <div class="form-group">
            <label>Jumlah Patuh Jumantik</label>
            <input type="number" class="form-control" name="patuh"
              value="<?= $edit['patuh'] ?? '' ?>" placeholder="Masukan Jumlah Patuh Jumantik" required>
          </div>

          <div class="form-group">
            <label>Jumlah Tidak Patuh Jumantik</label>
            <input type="number" class="form-control" name="tidak_patuh"
              value="<?= $edit['tidak_patuh'] ?? '' ?>" placeholder="Masukan Jumlah Tidak Patuh Jumantik" required>
          </div>

          <?php if ($edit): ?>
            <button type="submit" name="update" class="btn btn-warning mr-2">Perbarui</button>
            <a href="statistik.php" class="btn btn-light">Batal</a>
          <?php else: ?>
            <button type="submit" name="simpan" class="btn btn-primary mr-2">Simpan</button>
            <button type="reset" class="btn btn-light">Batal</button>
          <?php endif; ?>

          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- ================= TABLE ================= -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
        <h4 class="card-title">Data Statistik Kepatuhan Jumantik</h4>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nomor Rukun Warga (RW)</th>
                  <th>Patuh Jumantik</th>
                  <th>Tidak Patuh Jumantik</th>
                  <th>Total Statistik RW</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($r = mysqli_fetch_assoc($data)): ?>
                <tr>
                  <td>RW <?= $r['rw'] ?></td>
                  <td><?= $r['patuh'] ?></td>
                  <td><?= $r['tidak_patuh'] ?></td>
                  <td><strong><?= $r['patuh'] + $r['tidak_patuh'] ?></strong></td>
                  <td>
                    <a href="statistik.php?edit=<?= $r['id_statistik'] ?>" class="btn btn-sm btn-warning">
                      <i class="ti-pencil"></i>
                    </a>
                    <a href="statistik.php?hapus=<?= $r['id_statistik'] ?>"
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
  <?php include 'include/footer.php'; ?>


  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted">© 2026. All System Created by <strong>KKN 017 UMP 2026</strong></span>
    </div>
  </footer>
  </div>
</div>