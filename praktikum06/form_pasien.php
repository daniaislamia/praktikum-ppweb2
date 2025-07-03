<?php
include 'dbkoneksi.php';
$id = $_GET['id'] ?? '';
$edit = false;
$data = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
    $edit = true;
}

$kelurahan = $dbh->query("SELECT * FROM kelurahan")->fetchAll();
?>
<h2><?= $edit ? 'Edit' : 'Tambah' ?> Pasien</h2>
<form method="POST" action="proses_pasien.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">
    Kode: <input type="text" name="kode" value="<?= $data['kode'] ?? '' ?>"><br>
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>"><br>
    Tempat Lahir: <input type="text" name="tmp_lahir" value="<?= $data['tmp_lahir'] ?? '' ?>"><br>
    Tgl Lahir: <input type="date" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?? '' ?>"><br>
    Gender:
        <input type="radio" name="gender" value="L" <?= ($data['gender'] ?? '') === 'L' ? 'checked' : '' ?>> Laki-laki
        <input type="radio" name="gender" value="P" <?= ($data['gender'] ?? '') === 'P' ? 'checked' : '' ?>> Perempuan<br>
    Kelurahan:
        <select name="kelurahan_id">
            <?php foreach ($kelurahan as $k): ?>
                <option value="<?= $k['id'] ?>" <?= ($data['kelurahan_id'] ?? '') == $k['id'] ? 'selected' : '' ?>>
                    <?= $k['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>
    Email: <input type="email" name="email" value="<?= $data['email'] ?? '' ?>"><br>
    Alamat: <textarea name="alamat"><?= $data['alamat'] ?? '' ?></textarea><br>
    <button type="submit" name="proses" value="<?= $edit ? 'Update' : 'Simpan' ?>">
        <?= $edit ? 'Update' : 'Simpan' ?>
    </button>
</form>
