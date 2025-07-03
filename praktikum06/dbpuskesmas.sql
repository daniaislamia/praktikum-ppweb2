CREATE DATABASE IF NOT EXISTS dbpuskesmas;
USE dbpuskesmas;

CREATE TABLE kelurahan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100)
);

CREATE TABLE pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10),
    nama VARCHAR(100),
    tmp_lahir VARCHAR(100),
    tgl_lahir DATE,
    gender CHAR(1),
    email VARCHAR(100),
    alamat TEXT,
    kelurahan_id INT,
    FOREIGN KEY (kelurahan_id) REFERENCES kelurahan(id)
);

INSERT INTO kelurahan (nama) VALUES 
('Sukamaju'), ('Cilangkap'), ('Depok Lama'), ('Cinere'), ('Sawangan');

INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES
('P001', 'Ani', 'Depok', '2000-01-01', 'P', 'ani@mail.com', 'Jl. A', 1),
('P002', 'Budi', 'Jakarta', '1999-05-20', 'L', 'budi@mail.com', 'Jl. B', 2),
('P003', 'Citra', 'Bogor', '2001-03-15', 'P', 'citra@mail.com', 'Jl. C', 3),
('P004', 'Dedi', 'Bekasi', '2002-07-30', 'L', 'dedi@mail.com', 'Jl. D', 4),
('P005', 'Eka', 'Tangerang', '1998-11-10', 'P', 'eka@mail.com', 'Jl. E', 5);
