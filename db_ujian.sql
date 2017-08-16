-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Des 2015 pada 06.07
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ujian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_admin`
--

CREATE TABLE IF NOT EXISTS `t_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` text,
  `status` char(1) NOT NULL,
  `created_admin` datetime NOT NULL,
  `modified_admin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `t_admin`
--

INSERT INTO `t_admin` (`id`, `username`, `password`, `foto`, `status`, `created_admin`, `modified_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '../images/boy main komputer.gif', 'A', '2015-11-08 21:00:00', '2015-11-23 15:58:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_detail_nilai`
--

CREATE TABLE IF NOT EXISTS `t_detail_nilai` (
  `id_dtl_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `jawaban` varchar(1) DEFAULT NULL COMMENT 'A,B,C,D',
  `created_dtl_nilai` datetime NOT NULL,
  `modified_dtl_nilai` datetime DEFAULT NULL,
  PRIMARY KEY (`id_dtl_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `t_detail_nilai`
--

INSERT INTO `t_detail_nilai` (`id_dtl_nilai`, `user_id`, `soal_id`, `jawaban`, `created_dtl_nilai`, `modified_dtl_nilai`) VALUES
(1, 2, 11, 'A', '2015-12-31 10:59:31', NULL),
(2, 2, 13, 'B', '2015-12-31 10:59:31', NULL),
(3, 2, 10, 'B', '2015-12-31 10:59:31', NULL),
(4, 2, 12, '', '2015-12-31 10:59:31', NULL),
(5, 2, 14, 'C', '2015-12-31 10:59:31', NULL),
(6, 2, 20, 'B', '2015-12-31 10:59:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelas`
--

CREATE TABLE IF NOT EXISTS `t_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  `created_kelas` datetime NOT NULL,
  `modified_kelas` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `t_kelas`
--

INSERT INTO `t_kelas` (`id_kelas`, `kelas`, `status`, `created_kelas`, `modified_kelas`) VALUES
(1, 'X', 'A', '2015-12-26 21:00:00', NULL),
(2, 'XI', 'A', '2015-12-26 21:00:00', '2015-12-29 17:20:26'),
(3, 'XII', 'A', '2015-12-29 17:25:01', '2015-12-31 09:22:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_matapelajaran`
--

CREATE TABLE IF NOT EXISTS `t_matapelajaran` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(200) NOT NULL,
  `keterangan` text COMMENT 'mis: UAS 2015',
  `kelas_id` int(11) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `created_mapel` datetime NOT NULL,
  `modified_mapel` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `t_matapelajaran`
--

INSERT INTO `t_matapelajaran` (`id_mapel`, `nama_mapel`, `keterangan`, `kelas_id`, `status`, `created_mapel`, `modified_mapel`) VALUES
(1, 'Matematika', 'Ulangan Harian 1', 1, 'A', '2015-11-12 16:00:00', '2015-11-25 00:31:53'),
(2, 'Bahasa Inggris', 'Ulangan Harian 1', 1, 'A', '2015-11-17 14:00:00', '2015-11-25 00:31:59'),
(4, 'IPS Sejarah', 'Ulangan Harian 1', 2, 'A', '2015-11-21 10:32:24', '2015-11-25 00:32:12'),
(5, 'Bahasa Indonesia', 'Ulangan Harian 1', 2, 'A', '2015-11-27 21:14:32', '2015-12-29 18:06:23'),
(8, 'Agama', 'Ulangan Harian 1', 3, 'A', '2015-12-31 10:39:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_nilai`
--

CREATE TABLE IF NOT EXISTS `t_nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `nilai` varchar(4) NOT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `created_nilai` datetime NOT NULL,
  `modified_nilai` datetime DEFAULT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `t_nilai`
--

INSERT INTO `t_nilai` (`id_nilai`, `user_id`, `mapel_id`, `nilai`, `benar`, `salah`, `created_nilai`, `modified_nilai`) VALUES
(1, 2, 4, '8.3', 5, 1, '2015-12-31 10:59:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_soal`
--

CREATE TABLE IF NOT EXISTS `t_soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) NOT NULL,
  `soal` text NOT NULL,
  `pilihanA` text,
  `pilihanB` text,
  `pilihanC` text,
  `pilihanD` text,
  `pilihanE` text,
  `kunci_jawaban` varchar(100) DEFAULT NULL,
  `created_soal` datetime NOT NULL,
  `modified_soal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `t_soal`
--

INSERT INTO `t_soal` (`id_soal`, `mapel_id`, `soal`, `pilihanA`, `pilihanB`, `pilihanC`, `pilihanD`, `pilihanE`, `kunci_jawaban`, `created_soal`, `modified_soal`) VALUES
(1, 1, 'Menghitung Rumus Luas Persegi?', 'Panjang x Lebar', 'Panjang + Lebar', 'Tinggi x Panjang', '1/2 (Alas x Tinggi)', '', 'A', '2015-11-08 20:00:00', '2015-11-22 18:58:46'),
(2, 1, 'Rumus menghitung luas segi tiga?', 'Alas x Tinggi', '1/2 (Alas x Tinggi)', 'Panjang x Lebar', 'Panjang + Lebar', '', 'B', '2015-11-08 18:00:00', '2015-11-22 18:59:02'),
(3, 1, 'Berapa jumlah bilangan prima dari angka 1-20 ?', '6', '7', '8', '9', '', 'C', '2015-11-09 15:00:00', '2015-11-22 19:02:12'),
(4, 2, 'How are you ?', 'Yes', 'Fine', 'Oke', 'Thanks', '', 'B', '2015-11-17 12:00:00', '2015-11-22 19:14:53'),
(6, 1, 'Berapa akar kuadrat dari 8?', '46', '54', '64', '72', '', 'C', '2015-11-23 07:19:06', '2015-11-23 07:20:28'),
(7, 1, 'Berapa nilai 100 / 10 ?', '7', '8', '9', '10', '', 'D', '2015-11-23 07:23:05', '2015-11-27 20:49:04'),
(9, 2, 'How do you do?', 'Fine', 'Good', 'Work', 'Beautifull', '', 'C', '2015-11-23 07:44:36', '2015-11-23 07:44:47'),
(10, 4, 'Siapa nama presiden Indonesia pertama ?', 'Suharto', 'Sukarno', 'Bj Habibie', 'Adam Malik', '', 'B', '2015-11-23 14:49:44', NULL),
(11, 4, 'Di Jawa Timur Kota mana yang disebut sebagai Kota Pahlawan ?', 'Surabaya', 'Malang', 'Semarang', 'Pacitan', '', 'A', '2015-11-25 00:35:16', NULL),
(12, 4, 'Siapa pencipta lagu Indonesia Raya ?', 'ir. Sukarno', 'ir. Suharto', 'Ahmad Yani', 'Jendral Sudirman', '', 'D', '2015-11-25 00:37:04', NULL),
(13, 4, 'Kapan Indonesia resmi merdeka ?', '17-08-1944', '17-08-1945', '17-08-1946', '17-08-1947', '', 'B', '2015-11-25 00:38:37', NULL),
(14, 4, 'Sebelum Djakarta nama kota tersebut adalah ?', 'The Jack', 'Tanjung Priok', 'Batavia', 'Kemayoran', '', 'C', '2015-11-25 00:40:13', '2015-11-27 21:04:55'),
(15, 2, 'English of 10 ?', 'Eleven', 'Ten', 'Eight', 'Nine', '', 'B', '2015-11-25 00:43:45', '2015-11-25 00:44:10'),
(16, 2, 'English of 12 ?', 'Twenteen', 'Twenty', 'Twentiin', 'Twenti', '', 'A', '2015-11-25 00:45:09', NULL),
(17, 2, 'English of 11 ?', 'One One', 'Eleven', 'Eight ', 'Eightteen', '', 'B', '2015-11-25 00:46:23', NULL),
(19, 2, 'English of 1 ?', 'One', 'Two', 'Tri', 'Four', '', 'A', '2015-11-27 21:02:59', '2015-11-27 21:07:04'),
(20, 4, 'Siapa pahlawan dari Aceh ?', 'Imam Bonjol ', 'Cut nyak dien', 'Cut tari', 'Sudirman', '', 'B', '2015-11-27 21:06:25', NULL),
(21, 1, '25 + 25 ?', '40', '45', '48', '50', '', 'D', '2015-11-27 21:09:16', NULL),
(23, 5, 'Cari Subjek dari kalimat "Edi sedang bermain bola" adalah ?', 'Edi', 'Sedang', 'Bermain', 'Bola', '', 'A', '2015-12-29 23:12:51', '2015-12-31 10:42:30'),
(24, 5, 'Cari Objek dari kalimat "Edi sedang bermain bola" adalah ?', 'Edi', 'Sedang', 'Bermain', 'Bola', '', 'D', '2015-12-31 09:26:14', '2015-12-31 10:44:03'),
(25, 5, 'Cari Predikat dari kalimat "Edi sedang bermain bola" adalah ?', 'Edi', 'Sedang', 'Bermain', 'Bola', '', 'C', '2015-12-31 09:31:34', '2015-12-31 10:44:48'),
(26, 5, 'Cari Keterangan dari kalimat "Edi sedang bermain bola dilapangan" adalah ?', 'Edi', 'Dilapangan', 'Bermain', 'Bola', '', 'B', '2015-12-31 10:50:15', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `created_user` datetime NOT NULL,
  `modified_user` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `kelas_id`, `foto`, `status`, `created_user`, `modified_user`) VALUES
(1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 1, '../images/anak sekolah.jpg', 'A', '2015-11-23 22:22:53', '2015-12-31 12:06:28'),
(2, 'sutanto', 'c3842cea197e7dc21e953bd14d7622b7', 2, '../images/boy main komputer.gif', 'A', '2015-11-23 23:35:38', '2015-12-31 12:06:18');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
