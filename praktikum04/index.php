<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Submission</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        require_once("JenisKunjungan.php");

        $jenis_kunjungan = JenisKunjungan::getAll();

        ?>
        <div class="container">
            <h2>Selamat Datang di Perpustakaan STT-NF</h2>
            <p>Silahkan isi buku tamu dibawah ini</p>
            <hr />
            <form method="post" action="proses.php">
                <div class="form-group row">
                    <label for="fullname" class="col-3 col-form-label">Nama Lengkap</label> 
                    <div class="col-9">
                    <input id="fullname" name="fullname" type="text" aria-describedby="fullnameHelpBlock" class="form-control"> 
                    <span id="fullnameHelpBlock" class="form-text text-muted">isi nama lengkap kamu.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3 col-form-label">Email</label> 
                    <div class="col-9">
                    <input id="email" name="email" type="text" class="form-control" aria-describedby="emailHelpBlock"> 
                    <span id="emailHelpBlock" class="form-text text-muted">isi dengan email aktif kamu</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3 col-form-label">Jenis Kunjungan</label> 
                    <div class="col-9">
                    <select id="jenis_kunjungan_id" name="jenis_kunjungan_id" class="custom-select">
                        <?php foreach ($jenis_kunjungan as $jenis): ?>
                            <option value="<?= $jenis->id ?>">
                                <?php echo $jenis->display_name; ?>
                            </option>    
                        <?php endforeach; ?>    
                    </select>
                    <span id="jenisKunjunganBlock" class="form-text text-muted">Tujuan kunjungan kamu</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-3 col-9">
                    <button name="submit" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>