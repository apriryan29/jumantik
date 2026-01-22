<?php
include 'include/config.php';

/* ================= HAPUS DATA ================= */
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);

  $q = mysqli_query($conn, "SELECT foto FROM tb_tim WHERE id_tim='$id'");
  $d = mysqli_fetch_assoc($q);

  if ($d && $d['foto'] && file_exists('../uploads/'.$d['foto'])) {
    unlink('../uploads/'.$d['foto']);
  }

  mysqli_query($conn, "DELETE FROM tb_tim WHERE id_tim='$id'");
  echo "<script>location='tim.php';</script>";
}

/* ================= SIMPAN DATA ================= */
if (isset($_POST['simpan'])) {
  $nama    = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $nomor   = $_POST['nomor'];
  $ig      = $_POST['link_ig'];
  $fb      = $_POST['link_fb'];

  $foto = '';
  if (!empty($_FILES['foto']['name'])) {
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png'])) {
      $foto = time().'-'.rand(100,999).'.'.$ext;
      move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/'.$foto);
    }
  }

  mysqli_query($conn, "
    INSERT INTO tb_tim (nama,jabatan,nomor,foto,link_ig,link_fb)
    VALUES ('$nama','$jabatan','$nomor','$foto','$ig','$fb')
  ");

  echo "<script>alert('Data berhasil disimpan');location='tim.php';</script>";
}

/* ================= UPDATE DATA ================= */
if (isset($_POST['update'])) {
  $id      = $_POST['id'];
  $nama    = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $nomor   = $_POST['nomor'];
  $ig      = $_POST['link_ig'];
  $fb      = $_POST['link_fb'];

  $old = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT foto FROM tb_tim WHERE id_tim='$id'")
  );

  $foto = $old['foto'];
  if (!empty($_FILES['foto']['name'])) {
    if ($foto && file_exists('../uploads/'.$foto)) {
      unlink('../uploads/'.$foto);
    }

    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png'])) {
      $foto = time().'-'.rand(100,999).'.'.$ext;
      move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/'.$foto);
    }
  }

  mysqli_query($conn, "
    UPDATE tb_tim SET
      nama='$nama',
      jabatan='$jabatan',
      nomor='$nomor',
      foto='$foto',
      link_ig='$ig',
      link_fb='$fb'
    WHERE id_tim='$id'
  ");

  echo "<script>alert('Data berhasil diperbarui');location='tim.php';</script>";
}

/* ================= DATA EDIT ================= */
$edit = null;
if (isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $edit = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM tb_tim WHERE id_tim='$id'")
  );
}

/* ================= DATA TABLE ================= */
$data = mysqli_query($conn, "SELECT * FROM tb_tim ORDER BY id_tim DESC");
?>

<?php include 'include/header.php'; ?>


<div class="main-panel">
  <div class="content-wrapper">

  <!-- ================= FORM ================= -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Tim Kader Jumantik</h4>
            <p class="card-description">Formulir Isian</p>

            <form method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?= $edit['id_tim'] ?? '' ?>">

              <div class="form-group">
                <label>Nama Kader</label>
                <input type="text" class="form-control" name="nama"
                  value="<?= $edit['nama'] ?? '' ?>" placeholder="Masukan Nama Kader Jumantik" required>
              </div>

              <div class="form-group">
                <label>Jabatan</label>
                <input type="text" class="form-control" name="jabatan"
                  value="<?= $edit['jabatan'] ?? '' ?>" placeholder="Masukan Jabatan Kader Jumantik" required>
              </div>

              <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" class="form-control" name="nomor"
                  value="<?= $edit['nomor'] ?? '' ?>" placeholder="Masukan Nomor Telepon" required>
              </div>

              <div class="form-group">
                <label>Unggah Foto Ukuran 3x4</label>
                <input type="file" class="file-upload-default" name="foto" accept=".jpg,.jpeg,.png">
                <div class="input-group">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Pilih foto">
                  <span class="input-group-append">
                    <button type="button" class="file-upload-browse btn btn-primary">Unggah</button>
                  </span>
                </div>
                <?php if ($edit && $edit['foto']): ?>
                  <small>Foto lama: <?= $edit['foto'] ?></small>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label>Link Instagram</label>
                <input type="text" class="form-control" name="link_ig"
                  value="<?= $edit['link_ig'] ?? '' ?>" placeholder="Masukan Link Instagram (Opsional)">
              </div>

              <div class="form-group">
                <label>Link Facebook</label>
                <input type="text" class="form-control" name="link_fb"
                  value="<?= $edit['link_fb'] ?? '' ?>" placeholder="Masukan Link Facebook (Opsional)">
              </div>

              <?php if ($edit): ?>
                <button type="submit" name="update" class="btn btn-warning mr-2">Perbarui</button>
                <a href="tim.php" class="btn btn-light">Batal</a>
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
            <h4 class="card-title">Data Kader Jumantik</h4>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Nomor</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              <tbody>

                <?php while ($r = mysqli_fetch_assoc($data)): ?>
                <tr>
                  <td><?= $r['nama'] ?></td>
                  <td><?= $r['jabatan'] ?></td>
                  <td><?= $r['nomor'] ?></td>
                  <td>
                    <?php if ($r['foto']): ?>
                      <a href="../uploads/<?= $r['foto'] ?>" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="tim.php?edit=<?= $r['id_tim'] ?>" class="btn btn-sm btn-warning">
                      <i class="ti-pencil"></i>
                    </a>
                    <a href="tim.php?hapus=<?= $r['id_tim'] ?>"
                      class="btn btn-sm btn-danger"
                      onclick="return confirm('Hapus data ini?')">
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
</div>

<?php include 'include/footer.php'; ?>

<script>
document.querySelector('.file-upload-browse').onclick = function () {
  document.querySelector('.file-upload-default').click();
};

document.querySelector('.file-upload-default').onchange = function () {
  document.querySelector('.file-upload-info').value = this.files[0].name;
};
</script>
