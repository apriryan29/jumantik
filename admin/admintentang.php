<?php 
include 'include/config.php';

// Cek data tentang
$cek  = mysqli_query($conn, "SELECT * FROM tb_tentang LIMIT 1");
$data = mysqli_fetch_assoc($cek);

if (isset($_POST['simpan'])) {
  $nama      = $_POST['nama'];
  $email     = $_POST['email'];
  $nomor     = $_POST['nomor'];
  $alamat    = $_POST['alamat'];
  $deskripsi = $_POST['deskripsi'];
  $link_ig   = $_POST['link_ig'];
  $link_tt   = $_POST['link_tt'];

  if ($data) {
    $query = mysqli_query($conn, "
      UPDATE tb_tentang SET
        nama='$nama',
        email='$email',
        nomor='$nomor',
        alamat='$alamat',
        deskripsi='$deskripsi',
        link_ig='$link_ig',
        link_tt='$link_tt'
      WHERE id_tentang='{$data['id_tentang']}'
    ");
  } else {
    $query = mysqli_query($conn, "
      INSERT INTO tb_tentang
      (nama,email,nomor,alamat,deskripsi,link_ig,link_tt)
      VALUES
      ('$nama','$email','$nomor','$alamat','$deskripsi','$link_ig','$link_tt')
    ");
  }

  if ($query) {
    echo "<script>alert('Data berhasil disimpan');location='';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan data');</script>";
  }
}
?>


<?php include 'include/header.php' ?>

    <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tentang Kami</h4>
                  <p class="card-description">
                    Formulir isian tentang Jumantik
                  </p>
                  <form class="forms-sample" method="POST">
                    <?php $readonly = $data ? 'readonly' : ''; ?>
                    <?php
                    function val($data, $key) {
                      return htmlspecialchars($data[$key] ?? '');
                    }
                    ?>
                    <div class="form-group">
                      <label>Nama Program Jumantik</label>
                      <input type="text" class="form-control" name="nama"
                        value="<?= val($data,'nama') ?>"
                        data-default="<?= val($data,'nama') ?>"
                        <?= $readonly ?>>
                    </div>

                    <div class="form-group">
                      <label>Email Jumantik</label>
                      <input type="email" class="form-control" name="email"
                        value="<?= val($data,'email') ?>"
                        data-default="<?= val($data,'email') ?>"
                        <?= $readonly ?>>
                    </div>

                    <div class="form-group">
                      <label>Nomor Telepon Koordinator</label>
                      <input type="text" class="form-control" name="nomor"
                        value="<?= val($data,'nomor') ?>"
                        data-default="<?= val($data,'nomor') ?>"
                        <?= $readonly ?>>
                    </div>

                    <div class="form-group">
                      <label>Alamat Jumantik</label>
                      <textarea class="form-control" name="alamat" rows="2"
                        data-default="<?= val($data,'alamat') ?>"
                        <?= $readonly ?>><?= val($data,'alamat') ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Deskripsi Program Jumantik</label>
                      <textarea class="form-control" name="deskripsi" rows="5"
                        data-default="<?= val($data,'deskripsi') ?>"
                        <?= $readonly ?>><?= val($data,'deskripsi') ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Link Instagram</label>
                      <input type="text" class="form-control" name="link_ig"
                        value="<?= val($data,'link_ig') ?>"
                        data-default="<?= val($data,'link_ig') ?>"
                        <?= $readonly ?>>
                    </div>

                    <div class="form-group">
                      <label>Link Tiktok</label>
                      <input type="text" class="form-control" name="link_tt"
                        value="<?= val($data,'link_tt') ?>"
                        data-default="<?= val($data,'link_tt') ?>"
                        <?= $readonly ?>>
                    </div>

                    <!-- TOMBOL -->
                    <?php if ($data): ?>
                      <button type="button" id="btnEdit" class="btn btn-warning mr-2">
                        Perbarui
                      </button>
                    <?php endif; ?>

                    <button type="submit" name="simpan" id="btnSimpan"
                      class="btn btn-primary mr-2"
                      <?= $data ? 'style="display:none"' : '' ?>>
                      Simpan
                    </button>

                    <button type="button" id="btnBatal"
                      class="btn btn-light"
                      style="display:none">
                      Batal
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        

<?php include 'include/footer.php' ?>


<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© 2026. All System Created by <strong>KKN 017 UMP 2026</strong></span>
      </div>
    </footer>  
<!-- partial -->
</div>

<script>
const btnEdit   = document.getElementById('btnEdit');
const btnSimpan = document.getElementById('btnSimpan');
const btnBatal  = document.getElementById('btnBatal');
const fields    = document.querySelectorAll('input[name], textarea[name]');

btnEdit?.addEventListener('click', () => {
  fields.forEach(el => el.removeAttribute('readonly'));
  btnEdit.style.display   = 'none';
  btnSimpan.style.display = 'inline-block';
  btnBatal.style.display  = 'inline-block';
});

btnBatal?.addEventListener('click', () => {
  fields.forEach(el => {
    el.value = el.dataset.default;
    el.setAttribute('readonly', true);
  });
  btnEdit.style.display   = 'inline-block';
  btnSimpan.style.display = 'none';
  btnBatal.style.display  = 'none';
});
</script>

