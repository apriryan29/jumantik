<?php
include 'include/config.php';

/* ================= HAPUS DATA ================= */
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);

  $cek = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT foto FROM tb_galeri WHERE id_galeri='$id'")
  );

  if ($cek['foto'] && file_exists('../uploads/galeri/'.$cek['foto'])) {
    unlink('../uploads/galeri/'.$cek['foto']);
  }

  mysqli_query($conn, "DELETE FROM tb_galeri WHERE id_galeri='$id'");
  echo "<script>alert('Data berhasil dihapus');location='galeri.php';</script>";
}

/* ================= SIMPAN DATA ================= */
if (isset($_POST['simpan'])) {
  $judul     = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];

  $foto = '';
  if (!empty($_FILES['foto']['name'])) {
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png'])) {
      $foto = time().'_'.$judul.'.'.$ext;
      move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/galeri/'.$foto);
    }
  }

  mysqli_query($conn, "
    INSERT INTO tb_galeri (judul, foto, deskripsi)
    VALUES ('$judul','$foto','$deskripsi')
  ");

  echo "<script>alert('Data berhasil disimpan');location='galeri.php';</script>";
}

/* ================= UPDATE DATA ================= */
if (isset($_POST['update'])) {
  $id        = $_POST['id'];
  $judul     = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];

  $lama = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT foto FROM tb_galeri WHERE id_galeri='$id'")
  );

  $foto = $lama['foto'];
  if (!empty($_FILES['foto']['name'])) {
    if ($foto && file_exists('../uploads/galeri/'.$foto)) {
      unlink('../uploads/galeri/'.$foto);
    }

    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png'])) {
      $foto = time().'_'.$judul.'.'.$ext;
      move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/galeri/'.$foto);
    }
  }

  mysqli_query($conn, "
    UPDATE tb_galeri SET
      judul='$judul',
      foto='$foto',
      deskripsi='$deskripsi'
    WHERE id_galeri='$id'
  ");

  echo "<script>alert('Data berhasil diperbarui');location='galeri.php';</script>";
}

/* ================= DATA EDIT ================= */
$edit = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $edit = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM tb_galeri WHERE id_galeri='$id'")
  );
}

/* ================= DATA TABLE ================= */
$data = mysqli_query($conn, "SELECT * FROM tb_galeri ORDER BY id_galeri DESC");
?>

<?php include 'include/header.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">

    <!-- ================= FORM ================= -->
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Dokumentasi Kegiatan</h4>
            <p class="card-description">Formulir Dokumentasi Kegiatan</p>

            <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $edit['id_galeri'] ?? '' ?>">

            <div class="form-group">
              <label>Judul Dokumentasi</label>
              <input type="text" class="form-control" name="judul"
                value="<?= $edit['judul'] ?? '' ?>" placeholder="Masukan Judul Dokumentasi Kegiatan" required>
            </div>

            <div class="form-group">
              <label>Deskripsi Dokumentasi</label>
              <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Kegiatan" required><?= $edit['deskripsi'] ?? '' ?></textarea>
            </div>

            <div class="form-group">
              <label>Unggah Foto</label>
              <input type="file" class="file-upload-default" name="foto" accept=".jpg,.jpeg,.png">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Unggah Foto">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                </span>
              </div>

              <?php if ($edit && $edit['foto']): ?>
                <small class="text-muted">Foto saat ini:</small><br>
                <img src="../uploads/galeri/<?= $edit['foto'] ?>" width="120" class="mt-2 rounded">
              <?php endif; ?>
            </div>

            <?php if ($edit): ?>
              <button type="submit" name="update" class="btn btn-warning mr-2">Perbarui</button>
              <a href="galeri.php" class="btn btn-light">Batal</a>
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
            <h4 class="card-title">Data Dokumentasi</h4>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php while ($r = mysqli_fetch_assoc($data)): ?>
                  <tr>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 300px;"><?= $r['judul'] ?></td>
                    <td style="white-space: normal; word-wrap: break-word; max-width: 300px;"><?= $r['deskripsi'] ?></td>
                    <td>
                      <?php if ($r['foto']): ?>
                        <a href="../uploads/galeri/<?= $r['foto'] ?>" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                      <?php else: ?>
                        -
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="galeri.php?edit=<?= $r['id_galeri'] ?>" class="btn btn-sm btn-warning">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="galeri.php?hapus=<?= $r['id_galeri'] ?>"
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

<script>
  document.querySelector('.file-upload-browse').addEventListener('click', function() {
    document.querySelector('.file-upload-default').click();
  });
  document.querySelector('.file-upload-default').addEventListener('change', function() {
    document.querySelector('.file-upload-info').value = this.files[0].name;
  });
</script>
