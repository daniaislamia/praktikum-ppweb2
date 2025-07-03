<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>
</head>
<body>
    <h2>Form Penilaian Mahasiswa</h2>
    <form method="post">
        <label>Nama:</label><br/>
        <input type="text" name="nama" required><br/>
        <label>Mata Kuliah:</label><br/>
        <input type="text" name="matkul" required><br/>
        <label>Nilai UTS:</label><br/>
        <input type="number" name="nilai_uts" step="0.01" required><br/>
        <label>Nilai UAS:</label><br/>
        <input type="number" name="nilai_uas" step="0.01" required><br/>
        <label>Nilai Tugas Praktikum:</label><br/>
        <input type="number" name="nilai_tugas" step="0.01" required><br/>
        <button type="submit" name="proses" value="Simpan">Simpan</button>
    </form>
    <hr/>
<?php
$proses = $_POST['proses'] ?? '';
$nama_siswa = $_POST['nama'] ?? '';
$mata_kuliah = $_POST['matkul'] ?? '';
$nilai_uts = (float) ($_POST['nilai_uts'] ?? 0);
$nilai_uas = (float) ($_POST['nilai_uas'] ?? 0);
$nilai_tugas = (float) ($_POST['nilai_tugas'] ?? 0);

if (!empty($proses)) {
    $nilai_akhir = ($nilai_uts * 0.30) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
    $status = ($nilai_akhir > 55) ? 'Lulus' : 'Tidak Lulus';

    if ($nilai_akhir >= 0 && $nilai_akhir <= 35) {
        $grade = 'E';
    } elseif ($nilai_akhir <= 55) {
        $grade = 'D';
    } elseif ($nilai_akhir <= 69) {
        $grade = 'C';
    } elseif ($nilai_akhir <= 84) {
        $grade = 'B';
    } elseif ($nilai_akhir <= 100) {
        $grade = 'A';
    } else {
        $grade = 'I';
    }

    switch ($grade) {
        case 'E':
            $predikat = 'Sangat Kurang';
            break;
        case 'D':
            $predikat = 'Kurang';
            break;
        case 'C':
            $predikat = 'Cukup';
            break;
        case 'B':
            $predikat = 'Memuaskan';
            break;
        case 'A':
            $predikat = 'Sangat Memuaskan';
            break;
        default:
            $predikat = 'Tidak Ada';
    }

    echo '<h3>Hasil Penilaian</h3>';
    echo 'Proses: ' . htmlspecialchars($proses) . '<br/>';
    echo 'Nama: ' . htmlspecialchars($nama_siswa) . '<br/>';
    echo 'Mata Kuliah: ' . htmlspecialchars($mata_kuliah) . '<br/>';
    echo 'Nilai UTS: ' . $nilai_uts . '<br/>';
    echo 'Nilai UAS: ' . $nilai_uas . '<br/>';
    echo 'Nilai Tugas Praktikum: ' . $nilai_tugas . '<br/>';
    echo 'Nilai Akhir: ' . $nilai_akhir . '<br/>';
    echo 'Status: ' . $status . '<br/>';
    echo 'Grade: ' . $grade . '<br/>';
    echo 'Predikat: ' . $predikat . '<br/>';
}
?>
</body>
</html>
