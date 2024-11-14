CREATE DATABASE todolist;

USE todolist;

CREATE TABLE task
(
    Nomor INT AUTO_INCREMENT PRIMARY KEY,
    Nama_Kegiatan VARCHAR(250) NOT NULL,
    Waktu_dan_Tanggal_dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Status_Kegiatan VARCHAR(50) NOT NULL,
    Deadline DATETIME
);