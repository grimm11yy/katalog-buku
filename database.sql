-- ============================================================
-- database.sql  |  Katalog Buku Sederhana (ATOL Tugas 2)
-- Import lewat phpMyAdmin (tab Import) atau: mysql -u root < database.sql
-- ============================================================
CREATE DATABASE IF NOT EXISTS db_katalog
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_katalog;

DROP TABLE IF EXISTS buku;
DROP TABLE IF EXISTS users;

-- Tabel pengguna untuk login (password disimpan dalam bentuk hash bcrypt)
CREATE TABLE users (
    id       INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50)  NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL
);

-- Tabel data utama
CREATE TABLE buku (
    id            INT PRIMARY KEY AUTO_INCREMENT,
    isbn          VARCHAR(13)  NOT NULL UNIQUE,
    judul         VARCHAR(150) NOT NULL,
    penulis       VARCHAR(100) NOT NULL,
    penerbit      VARCHAR(100) NOT NULL,
    kategori      VARCHAR(50)  NOT NULL,
    tahun_terbit  YEAR         NOT NULL
);

-- Akun default: username = admin | password = admin123
INSERT INTO users (username, password, fullname) VALUES
('admin', '$2y$10$Cgqbjs8v0BhgM8fB4cEooee6NEAQb5wA93fQAVwb4MM6Z8rX0ZcRq', 'Administrator');

-- Data contoh (boleh diganti)
INSERT INTO buku (isbn, judul, penulis, penerbit, kategori, tahun_terbit) VALUES
('9789793062792', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 'Fiksi', 2005),
('9780132350884', 'Clean Code', 'Robert C. Martin', 'Prentice Hall', 'Teknologi', 2008),
('9780062316097', 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harper', 'Sejarah', 2015),
('9780553380163', 'A Brief History of Time', 'Stephen Hawking', 'Bantam', 'Sains', 1998),
('9780735211292', 'Atomic Habits', 'James Clear', 'Avery', 'Non-Fiksi', 2018);
