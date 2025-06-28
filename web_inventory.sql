-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jun 2025 pada 03.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_keluar`
--

CREATE TABLE `tb_barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_produk` varchar(50) DEFAULT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar_produk`
--

CREATE TABLE `tb_daftar_produk` (
  `id_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `jenis_produk` varchar(25) NOT NULL,
  `perusahaan_produk` varchar(10) NOT NULL,
  `jenis_satuan` varchar(10) NOT NULL,
  `banyak_produk` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_daftar_produk`
--

INSERT INTO `tb_daftar_produk` (`id_produk`, `nama_produk`, `jenis_produk`, `perusahaan_produk`, `jenis_satuan`, `banyak_produk`, `tanggal_masuk`, `tanggal_keluar`) VALUES
('P-001', 'Tango Wafer', 'Makanan', 'Orang Tua', 'PCS', 5, NULL, NULL),
('P-002', 'Milku', 'Minuman', 'WingsFood', 'PCS', 6, NULL, NULL),
('P-003', 'meja', 'furniture', 'uqon mebel', 'pcs', 2, '2025-05-31', '2025-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `no_karyawan` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password_karyawan` varchar(100) NOT NULL,
  `nama_lengkap` varchar(35) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`no_karyawan`, `username`, `password_karyawan`, `nama_lengkap`, `level`) VALUES
(1, 'danur', '50c3b963420d4f261fd1876f8054f422', 'Danur Syarif', 'Admin'),
(2, 'akbar', '202cb962ac59075b964b07152d234b70', 'akbar syarifan', 'Admin'),
(4, 'admin12', 'd9b1d7db4cd6e70935368a1efb10e377', 'admin12', 'Karya'),
(100, 'alec', '202cb962ac59075b964b07152d234b70', 'alec sefano', 'Karya'),
(101, 'reza', 'd9b1d7db4cd6e70935368a1efb10e377', 'rezaaa', 'Karya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log_login`
--

CREATE TABLE `tb_log_login` (
  `id_log` int(11) NOT NULL,
  `no_karyawan` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `waktu_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `browser_agent` text DEFAULT NULL,
  `status` enum('success','failed') NOT NULL DEFAULT 'success'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_log_login`
--

INSERT INTO `tb_log_login` (`id_log`, `no_karyawan`, `username`, `waktu_login`, `ip_address`, `browser_agent`, `status`) VALUES
(1, '2', 'akbar', '2025-05-27 14:38:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'success'),
(2, '2', 'akbar', '2025-05-31 13:53:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'success'),
(3, '100', 'alec', '2025-05-31 16:48:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'success'),
(4, '2', 'akbar', '2025-05-31 16:49:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'success'),
(5, '2', 'akbar', '2025-06-01 13:02:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'success'),
(6, '2', 'akbar', '2025-06-14 16:18:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'success'),
(7, '2', 'akbar', '2025-06-25 01:34:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'success');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan_danur`
--

CREATE TABLE `tb_pelanggan_danur` (
  `nik_ktp_danur` varchar(16) NOT NULL,
  `nama_pelanggan_danur` varchar(35) NOT NULL,
  `no_hp_danur` varchar(15) NOT NULL,
  `alamat_danur` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pelanggan_danur`
--

INSERT INTO `tb_pelanggan_danur` (`nik_ktp_danur`, `nama_pelanggan_danur`, `no_hp_danur`, `alamat_danur`) VALUES
('3206381212190003', 'Juned', '0884587899', 'ciamis'),
('322588448545', 'rose solo', '854844554', 'nganjuk'),
('9885554871', 'markus', '812554985', 'tasik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rental_danur`
--

CREATE TABLE `tb_rental_danur` (
  `no_trx_danur` varchar(20) NOT NULL,
  `nama_pelanggan_danur` varchar(35) NOT NULL,
  `nik_ktp_danur` varchar(16) NOT NULL,
  `no_plat_danur` varchar(15) NOT NULL,
  `tgl_rental_danur` date NOT NULL,
  `jam_rental_danur` time NOT NULL,
  `harga_danur` int(11) NOT NULL,
  `lama_danur` int(11) NOT NULL,
  `total_bayar_danur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_rental_danur`
--

INSERT INTO `tb_rental_danur` (`no_trx_danur`, `nama_pelanggan_danur`, `nik_ktp_danur`, `no_plat_danur`, `tgl_rental_danur`, `jam_rental_danur`, `harga_danur`, `lama_danur`, `total_bayar_danur`) VALUES
('TRX_20241230045255', 'akbar', '2230101040510', 'Z 4433 MW', '2024-12-30', '10:53:00', 200000, 2, 400000),
('TRX_20241230051047', 'rose solo', '322588448545', 'Z 4433 MW', '2024-12-30', '11:11:00', 1100002, 4, 4400008),
('TRX_20241230053214', 'Juned', '3206381212190003', 'Z 4433 MW', '2024-12-30', '11:32:00', 150000, 5, 750000),
('TRX_20241230135420', 'markus', '9885554871', 'Z 2321 SA', '2024-12-30', '19:54:00', 2000000, 1, 2000000),
('TRX_20241230174446', 'Juned', '3206381212190003', 'Z 2321 SA', '2024-12-30', '23:45:00', 5000000, 3, 15000000),
('TRX_20241230175012', 'rose solo', '322588448545', 'Z 2321 SA', '2024-12-30', '23:50:00', 1500000, 2, 3000000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `tb_daftar_produk`
--
ALTER TABLE `tb_daftar_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`no_karyawan`);

--
-- Indeks untuk tabel `tb_log_login`
--
ALTER TABLE `tb_log_login`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `tb_pelanggan_danur`
--
ALTER TABLE `tb_pelanggan_danur`
  ADD PRIMARY KEY (`nik_ktp_danur`);

--
-- Indeks untuk tabel `tb_rental_danur`
--
ALTER TABLE `tb_rental_danur`
  ADD PRIMARY KEY (`no_trx_danur`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_log_login`
--
ALTER TABLE `tb_log_login`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
