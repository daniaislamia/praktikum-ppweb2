<?php
include 'dbkoneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        $_POST['kode'], $_POST['nama'], $_POST['tmp_lahir'],
        $_POST['tgl_lahir'], $_POST['gender'], $_POST['email'],
        $_POST['alamat'], $_POST['kelurahan_id']
    ];

    if ($_POST['proses'] === 'Simpan') {
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $dbh->prepare($sql)->execute($data);
    } elseif ($_POST['proses'] === 'Update') {
        $data[] = $_POST['id'];
        $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, kelurahan_id=? 
                WHERE id=?";
        $dbh->prepare($sql)->execute($data);
    }
    header("Location: data_pasien.php");
    exit;
} elseif (isset($_GET['hapus'])) {
    $dbh->prepare("DELETE FROM pasien WHERE id=?")->execute([$_GET['hapus']]);
    header("Location: data_pasien.php");
    exit;
}
?>
