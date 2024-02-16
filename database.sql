CREATE DATABASE ukk_perpustakaan

USE ukk_perpustakaan

CREATE TABLE user (
    UserID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    NamaLengkap VARCHAR(255) NOT NULL,
    Alamat TEXT NULL,
    Role ENUM('admin', 'petugas', 'peminjam') NOT NULL
)

CREATE TABLE buku(
    BukuID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Judul VARCHAR(255) NOT NULL,
    Penulis VARCHAR(255) NOT NULL,
    Penerbit VARCHAR(255) NOT NULL,
    TahunTerbit YEAR NOT NULL
)

CREATE TABLE kategoribuku(
    KategoriID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NamaKategori VARCHAR(255) NOT NULL
)

CREATE TABLE kategoribuku_relasi (
    KategoriBukuID INT(11) NOT NULL AUTO_INCREMENT,
    BukuID INT(11) NOT NULL,
    KategoriID INT(11) NOT NULL,
    PRIMARY KEY (KategoriBukuID, BukuID, KategoriID)
)

-- DROP TABLE kategoribuku_relasi;

ALTER TABLE kategoribuku_relasi
ADD CONSTRAINT fk_kategoribuku_relasi_buku
FOREIGN KEY (BukuID) REFERENCES buku(BukuID)

ALTER TABLE kategoribuku_relasi
ADD CONSTRAINT fk_kategoribuku_relasi_kategori
FOREIGN KEY (KategoriID) REFERENCES kategoribuku(KategoriID)

CREATE TABLE ulasanbuku (
    UlasanID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserID INT(11) NOT NULL,
    BukuID INT(11) NOT NULL,
    Ulasan TEXT NULL,
    Rating INT(5),
    FOREIGN KEY (UserID) REFERENCES user(UserID),
    FOREIGN KEY (BukuID) REFERENCES buku(BukuID)
)

CREATE TABLE koleksipribadi (
    KoleksiID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserID INT(11) NOT NULL,
    BukuID INT(11) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES user(UserID),
    FOREIGN KEY (BukuID) REFERENCES buku(BukuID)
)

CREATE TABLE peminjaman (
    PeminjamanID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserID INT(11) NOT NULL,
    BukuID INT(11) NOT NULL,
    TanggalPeminjaman DATE NOT NULL,
    TanggalPengembalian DATE NOT NULL,
    StatusPeminjaman ENUM('dipinjam', 'dikembalikan'),
    FOREIGN KEY (UserID) REFERENCES user(UserID),
    FOREIGN KEY (BukuID) REFERENCES buku(BukuID)
)

SELECT * FROM tasks

UPDATE tasks SET status = 'selesai' WHERE id = 1;