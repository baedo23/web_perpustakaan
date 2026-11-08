CREATE DATABASE IF NOT EXISTS db_perpustakaan;
USE db_perpustakaan;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin: admin / admin123
INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', '0192023a7bbd73250516f069df18b500', 'admin');
-- User: user / user123
INSERT INTO `users` (`username`, `password`, `role`) VALUES ('user', '6ad14ba9986e3615423dfca256d04e3f', 'user');

CREATE TABLE `buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `penulis` varchar(150) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `status_ketersediaan` varchar(50) NOT NULL,
  `sampul` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
