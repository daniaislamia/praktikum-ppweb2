<?php
require_once 'Config/DB.php';

class UnitKerja
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua unit kerja
    public function index()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM unit_kerja");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Menampilkan unit kerja berdasarkan ID
    public function show($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM unit_kerja WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Membuat unit kerja baru
    public function create($data)
    {
        try {
            // Validasi data
            if (empty($data['nama'])) {
                throw new Exception("Nama unit kerja tidak boleh kosong");
            }

            // Periksa apakah unit kerja sudah ada
            $stmt = $this->pdo->prepare("SELECT * FROM unit_kerja WHERE nama = ?");
            $stmt->execute([$data['nama']]);
            if ($stmt->rowCount() > 0) {
                throw new Exception("Unit kerja dengan nama '{$data['nama']}' sudah ada.");
            }

            $sql = "INSERT INTO unit_kerja (nama) VALUES (?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data['nama']]);

            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Memperbarui unit kerja
    public function update($id, $data)
    {
        try {
            // Validasi data
            if (empty($data['nama'])) {
                throw new Exception("Nama unit kerja tidak boleh kosong");
            }

            // Periksa apakah unit kerja sudah ada dengan nama yang sama
            $stmt = $this->pdo->prepare("SELECT * FROM unit_kerja WHERE nama = ? AND id != ?");
            $stmt->execute([$data['nama'], $id]);
            if ($stmt->rowCount() > 0) {
                throw new Exception("Unit kerja dengan nama '{$data['nama']}' sudah ada.");
            }

            $sql = "UPDATE unit_kerja SET nama = :nama WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $this->show($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Menghapus unit kerja
    public function delete($id)
    {
        try {
            // Periksa apakah unit kerja masih memiliki relasi dengan data lain (misalnya, ada foreign key)
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM some_table WHERE unit_kerja_id = ?");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("Unit kerja ini masih digunakan di tabel lain dan tidak dapat dihapus.");
            }

            // Tampilkan data yang akan dihapus
            $row = $this->show($id);

            // Hapus unit kerja
            $stmt = $this->pdo->prepare("DELETE FROM unit_kerja WHERE id = ?");
            $stmt->execute([$id]);

            return $row;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Membuat objek UnitKerja dan menggunakan PDO
$unitkerja = new UnitKerja($pdo);
