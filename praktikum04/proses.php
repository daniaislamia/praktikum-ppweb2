<?php
require_once("Kunjungan.php");
session_start();

if (!isset($_SESSION['bukutamu'])) {
    $_SESSION['bukutamu'] = [];
}

if(isset($_POST['submit'])) {
    $kunjungan = new Kunjungan();
    $kunjungan->fullname = $_POST['fullname'];
    $kunjungan->email = $_POST['fullname'];
    $kunjungan->jenis_kunjungan_id= $_POST['fullname'];
    $kunjungan->save();

}

$daftar_kunjungan = Kunjungan::getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Kujungan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Timestamp</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
             <?php foreach ($daftar_kunjungan as $entry): ?>
               <tr>
                <td><?=htmlspecialchars($entry->id); ?></td>
                <td><?=htmlspecialchars($entry->timestamp); ?></td>
                <td><?=htmlspecialchars($entry->fullname); ?></td>
                <td><?=htmlspecialchars($entry->email); ?></td>
                <td><?=htmlspecialchars($entry->jenis_kunjungan_id); ?></td>
               </tr>
             <?php endforeach; ?>   

            </tbody>
        </table>
        <a href="index.php">&lt;&lt;&lt; Kembali</a>
    </div>
</body>

</html>