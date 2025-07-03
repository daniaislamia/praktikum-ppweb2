<?php
include 'dbkoneksi.php';
$stmt = $dbh->query("SELECT pasien.*, kelurahan.nama AS nama_kelurahan FROM pasien 
LEFT JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id");
$data = $stmt->fetchAll();
?>
<h2>Data Pasien</h2>
<a href="form_pasien.php">+ Tambah Pasien</a>
<table border="1">
    <tr>
        <th>Kode</th><th>Nama</th><th>Tmp Lahir</th><th>Tgl Lahir</th>
        <th>Gender</th><th>Email</th><th>Alamat</th><th>Kelurahan</th><th>Aksi</th>
    </tr>
    <?php foreach ($data as $row): ?>
    <tr>
        <td><?= $row['kode'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['tmp_lahir'] ?></td>
        <td><?= $row['tgl_lahir'] ?></td>
        <td><?= $row['gender'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['nama_kelurahan'] ?></td>
        <td>
            <a href="form_pasien.php?id=<?= $row['id'] ?>">Edit</a> | 
            <a href="proses_pasien.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
