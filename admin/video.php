<?php
include 'include/config.php';

// Ambil data (hanya 1)
$q = mysqli_query($conn, "SELECT * FROM tb_video LIMIT 1");
$data = mysqli_fetch_assoc($q);

$readonly = $data ? 'readonly' : '';
$isEdit = isset($_GET['edit']);

// PROSES SIMPAN / UPDATE
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    if ($data) {
        // UPDATE
        mysqli_query($conn, "
            UPDATE tb_video SET
            judul='$judul',
            link='$link',
            deskripsi='$deskripsi'
            WHERE id_video='{$data['id_video']}'
        ");
    } else {
        // INSERT
        mysqli_query($conn, "
            INSERT INTO tb_video (judul, link, deskripsi)
            VALUES ('$judul', '$link', '$deskripsi')
        ");
    }

    header("Location: video.php");
    exit;
}
?>

<?php include 'include/header.php'; ?>

<div class="main-panel">        
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Link Video Edukasi</h4>
                        <p class="card-description">Formulir Isian Video Edukasi</p>

                        <form method="POST">
                            <div class="form-group">
                                <label>Judul Video</label>
                                <input type="text" name="judul" class="form-control"
                                value="<?= $data['judul'] ?? '' ?>"
                                <?= ($data && !$isEdit) ? 'readonly' : '' ?> required>
                            </div>

                            <div class="form-group">
                                <label>Link Video</label>
                                <input type="text" name="link" class="form-control"
                                value="<?= $data['link'] ?? '' ?>"
                                <?= ($data && !$isEdit) ? 'readonly' : '' ?> required>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Video</label>
                                <textarea name="deskripsi" rows="4" class="form-control"
                                <?= ($data && !$isEdit) ? 'readonly' : '' ?>><?= $data['deskripsi'] ?? '' ?></textarea>
                            </div>

                            <?php if (!$data || $isEdit): ?>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                <a href="video.php" class="btn btn-light">Batal</a>
                            <?php else: ?>
                                <a href="video.php?edit=true" class="btn btn-warning">Perbarui</a>
                            <?php endif; ?>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'include/footer.php'; ?>
