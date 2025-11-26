-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Sep 2025 pada 07.41
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinikterbaruuuuuuuuu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_peralatan`
--

CREATE TABLE `biaya_peralatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` enum('pemeriksaan-umum','laboratorium','radiologi') NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `nomor_seri` varchar(255) DEFAULT NULL,
  `tahun_pembelian` year(4) DEFAULT NULL,
  `harga_beli` decimal(15,2) NOT NULL DEFAULT 0.00,
  `biaya_operasional` decimal(15,2) NOT NULL DEFAULT 0.00,
  `biaya_perawatan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('aktif','tidak_aktif','rusak','maintenance') NOT NULL DEFAULT 'aktif',
  `lokasi` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal_maintenance_terakhir` date DEFAULT NULL,
  `tanggal_maintenance_selanjutnya` date DEFAULT NULL,
  `spesifikasi_teknis` text DEFAULT NULL,
  `daya_listrik` varchar(255) DEFAULT NULL,
  `dimensi` varchar(255) DEFAULT NULL,
  `berat` varchar(255) DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `distributor` varchar(255) DEFAULT NULL,
  `kontak_support` varchar(255) DEFAULT NULL,
  `tanggal_garansi_habis` date DEFAULT NULL,
  `frekuensi_penggunaan_per_hari` int(11) NOT NULL DEFAULT 0,
  `kapasitas_maksimal_per_hari` int(11) NOT NULL DEFAULT 0,
  `biaya_per_penggunaan` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tanggal_kalibrasi_terakhir` date DEFAULT NULL,
  `tanggal_kalibrasi_selanjutnya` date DEFAULT NULL,
  `nomor_sertifikat_kalibrasi` varchar(255) DEFAULT NULL,
  `nomor_polis_asuransi` varchar(255) DEFAULT NULL,
  `tanggal_asuransi_habis` date DEFAULT NULL,
  `nilai_asuransi` decimal(15,2) DEFAULT NULL,
  `nilai_penyusutan_per_tahun` decimal(15,2) NOT NULL DEFAULT 0.00,
  `nilai_buku_saat_ini` decimal(15,2) NOT NULL DEFAULT 0.00,
  `catatan_khusus` text DEFAULT NULL,
  `riwayat_kerusakan` text DEFAULT NULL,
  `riwayat_perbaikan` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `biaya_peralatan`
--

INSERT INTO `biaya_peralatan` (`id`, `kategori`, `nama_alat`, `merek`, `model`, `nomor_seri`, `tahun_pembelian`, `harga_beli`, `biaya_operasional`, `biaya_perawatan`, `status`, `lokasi`, `penanggung_jawab`, `keterangan`, `gambar`, `tanggal_maintenance_terakhir`, `tanggal_maintenance_selanjutnya`, `spesifikasi_teknis`, `daya_listrik`, `dimensi`, `berat`, `vendor`, `distributor`, `kontak_support`, `tanggal_garansi_habis`, `frekuensi_penggunaan_per_hari`, `kapasitas_maksimal_per_hari`, `biaya_per_penggunaan`, `tanggal_kalibrasi_terakhir`, `tanggal_kalibrasi_selanjutnya`, `nomor_sertifikat_kalibrasi`, `nomor_polis_asuransi`, `tanggal_asuransi_habis`, `nilai_asuransi`, `nilai_penyusutan_per_tahun`, `nilai_buku_saat_ini`, `catatan_khusus`, `riwayat_kerusakan`, `riwayat_perbaikan`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'radiologi', '4354', 'f4f', '567y', '76h', '2020', 7676.00, 7667.00, 70.00, 'aktif', 'ujyuj', 'juyjyuj', NULL, 'peralatan/1751515827_klimikiju-Page-12.png', '2000-09-09', '2001-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, '2025-07-03 04:10:27', '2025-07-03 04:21:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` bigint(20) UNSIGNED NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `no_str` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jadwal_praktik` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`jadwal_praktik`)),
  `foto` varchar(255) DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `jenis_kelamin`, `spesialisasi`, `no_str`, `tanggal_lahir`, `alamat`, `no_telepon`, `email`, `jadwal_praktik`, `foto`, `status_aktif`, `created_at`, `updated_at`) VALUES
(2, 'bbb', 'Laki-laki', 'Anak', '54343', '2000-08-09', 'r4r', '4323', 'bilalaa@gmail.com', '{\"senin\":{\"jam_mulai\":\"09:00\",\"jam_selesai\":\"12:00\"}}', 'dokter-photos/Lfe59ft9aVw2m67Zku3K2xX3oxQIWNI45iqe8uXl.png', 1, '2025-06-09 10:34:40', '2025-06-09 10:34:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_rekam_medis` varchar(20) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `kontak_darurat` varchar(255) DEFAULT NULL,
  `hubungan_kontak` varchar(255) DEFAULT NULL,
  `status_pemeriksaan` enum('menunggu','sedang_diperiksa','selesai') NOT NULL DEFAULT 'menunggu',
  `no_antrian` varchar(10) DEFAULT NULL,
  `hasil_lab` text DEFAULT NULL,
  `dokter_pemeriksa` varchar(255) DEFAULT NULL,
  `tgl_pemeriksaan` date DEFAULT NULL,
  `catatan_lab` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_lpk_sentosa` tinyint(1) DEFAULT 0,
  `set_antrian_by` bigint(20) UNSIGNED DEFAULT NULL,
  `set_antrian_at` timestamp NULL DEFAULT NULL,
  `mulai_periksa_by` bigint(20) UNSIGNED DEFAULT NULL,
  `mulai_periksa_at` timestamp NULL DEFAULT NULL,
  `selesai_periksa_by` bigint(20) UNSIGNED DEFAULT NULL,
  `selesai_periksa_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `pemeriksaan_umum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `laboratorium_id` bigint(20) UNSIGNED DEFAULT NULL,
  `radiologi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_rekam_medis` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `alamat_lengkap` text NOT NULL,
  `kontak_darurat` varchar(15) NOT NULL,
  `hubungan_kontak` enum('ayah','ibu','saudara') NOT NULL,
  `keluhan_awal` enum('pemeriksaan_umum','lab','radiologi') NOT NULL,
  `catatan_pendaftaran` text DEFAULT NULL,
  `tgl_pendaftaran` datetime NOT NULL,
  `status_pendaftaran` enum('menunggu','dikonfirmasi','ditolak') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_lpk_sentosa` tinyint(1) DEFAULT 0,
  `no_antrian_umum` varchar(10) DEFAULT NULL,
  `tgl_pemeriksaan_umum` date DEFAULT NULL,
  `status_pemeriksaan_umum` enum('menunggu','dikonfirmasi','sedang_diperiksa','selesai') DEFAULT NULL,
  `diagnosis_sementara` text DEFAULT NULL,
  `obat_diberikan` text DEFAULT NULL,
  `anjuran_instruksi` text DEFAULT NULL,
  `rujukan` text DEFAULT NULL,
  `catatan_pemeriksaan_umum` text DEFAULT NULL,
  `no_antrian_lab` varchar(10) DEFAULT NULL,
  `tgl_pemeriksaan_lab` date DEFAULT NULL,
  `status_pemeriksaan_lab` enum('menunggu','sedang_diperiksa','selesai') DEFAULT NULL,
  `hasil_lab` text DEFAULT NULL,
  `dokter_pemeriksa_lab` varchar(255) DEFAULT NULL,
  `catatan_lab` text DEFAULT NULL,
  `no_antrian_radiologi` varchar(10) DEFAULT NULL,
  `tgl_pemeriksaan_radiologi` date DEFAULT NULL,
  `status_pemeriksaan_radiologi` varchar(20) DEFAULT NULL,
  `jenis_radiologi` enum('rontgen','ct_scan','mri','usg','mammografi') DEFAULT NULL,
  `hasil_radiologi` text DEFAULT NULL,
  `dokter_radiologi` varchar(255) DEFAULT NULL,
  `teknisi_radiologi` varchar(255) DEFAULT NULL,
  `catatan_radiologi` text DEFAULT NULL,
  `status_keseluruhan` enum('pendaftaran','pemeriksaan_berlangsung','selesai_sebagian','selesai_semua') DEFAULT 'pendaftaran',
  `tgl_selesai_semua` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `pendaftaran_id`, `pemeriksaan_umum_id`, `laboratorium_id`, `radiologi_id`, `no_rekam_medis`, `nik`, `nama`, `jenis_kelamin`, `tgl_lahir`, `no_hp`, `no_bpjs`, `alamat_lengkap`, `kontak_darurat`, `hubungan_kontak`, `keluhan_awal`, `catatan_pendaftaran`, `tgl_pendaftaran`, `status_pendaftaran`, `email`, `is_lpk_sentosa`, `no_antrian_umum`, `tgl_pemeriksaan_umum`, `status_pemeriksaan_umum`, `diagnosis_sementara`, `obat_diberikan`, `anjuran_instruksi`, `rujukan`, `catatan_pemeriksaan_umum`, `no_antrian_lab`, `tgl_pemeriksaan_lab`, `status_pemeriksaan_lab`, `hasil_lab`, `dokter_pemeriksa_lab`, `catatan_lab`, `no_antrian_radiologi`, `tgl_pemeriksaan_radiologi`, `status_pemeriksaan_radiologi`, `jenis_radiologi`, `hasil_radiologi`, `dokter_radiologi`, `teknisi_radiologi`, `catatan_radiologi`, `status_keseluruhan`, `tgl_selesai_semua`, `created_at`, `updated_at`) VALUES
(2, 2, 2, NULL, NULL, '20251509001', '3204110809950001', 'Sari Dewi Lestari', 'P', '1995-05-12', '08123456789', '0001234567890', 'Jl. Merdeka No. 45 RT.03 RW.05, Desa Sukamaju\nDesa Sukamaju, Kecamatan Cibiru, Kabupaten Bandung', '08987654321', 'ibu', 'pemeriksaan_umum', 'Keluhan demam dan batuk sejak 3 hari', '2025-09-15 08:30:00', 'dikonfirmasi', 'saridewi@gmail.com', 0, 'PKU-02', '2025-09-15', 'selesai', 'ISPA (Infeksi Saluran Pernafasan Akut)', 'Paracetamol 500mg 3x1, OBH Combi Batuk Berdahak 15ml 3x1', 'Istirahat cukup, minum air putih yang banyak, hindari makanan pedas dan dingin', 'Kontrol kembali jika keluhan tidak membaik dalam 3 hari', 'Pemeriksaan selesai, kondisi membaik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-15 02:15:30', '2025-09-14 18:30:15', '2025-09-14 19:15:30'),
(3, 3, 3, NULL, NULL, '20251509002', '3204110809880002', 'Ahmad Rizky Pratama', 'L', '1988-11-20', '08234567890', '0002345678901', 'Jl. Veteran No. 78 RT.02 RW.04, Kelurahan Babakan\nKelurahan Babakan, Kecamatan Bojongloa Kaler, Kota Bandung', '08876543210', 'ayah', 'pemeriksaan_umum', 'Nyeri perut dan mual sejak kemarin malam', '2025-09-15 09:15:00', 'dikonfirmasi', 'ahmadrizky88@gmail.com', 0, 'PKU-03', '2025-09-15', 'selesai', 'Gastritis Akut', 'Omeprazole 20mg 1x1 (sebelum makan pagi), Domperidone 10mg 3x1 (sebelum makan)', 'Diet lunak, hindari makanan pedas, asam, dan berlemak. Makan teratur dengan porsi kecil tapi sering', 'Jika nyeri perut tidak berkurang dalam 2 hari, segera kontrol kembali', 'Pemeriksaan selesai, gastritis akut terobati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-15 03:05:00', '2025-09-14 19:15:30', '2025-09-14 20:05:00'),
(4, 4, 4, NULL, NULL, '20251509003', '3204110809920003', 'Maya Indah Sari', 'P', '1992-07-15', '08345678901', NULL, 'Jl. Sudirman No. 123 RT.01 RW.03, Desa Cisarua\nDesa Cisarua, Kecamatan Lembang, Kabupaten Bandung Barat', '08765432109', 'saudara', 'pemeriksaan_umum', 'Sakit kepala berkepanjangan dan pusing', '2025-09-15 10:00:00', 'dikonfirmasi', 'mayaindah92@gmail.com', 0, 'PKU-04', '2025-09-15', 'selesai', 'Tension Headache', 'Asam Mefenamat 500mg 3x1, Vitamin B Complex 1x1', 'Istirahat yang cukup, kelola stress, olahraga ringan, kompres hangat di area leher', 'Kontrol dalam 1 minggu untuk evaluasi. Jika sakit kepala semakin parah, segera kembali', 'Pemeriksaan pertama selesai, perlu kontrol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-15 03:50:45', '2025-09-14 20:00:22', '2025-09-14 20:50:45'),
(5, 5, 5, NULL, NULL, '20251509003', '3204110809920003', 'Maya Indah Sari', 'P', '1992-07-15', '08345678901', NULL, 'Jl. Sudirman No. 123 RT.01 RW.03, Desa Cisarua\nDesa Cisarua, Kecamatan Lembang, Kabupaten Bandung Barat', '08765432109', 'saudara', 'pemeriksaan_umum', 'Kontrol sakit kepala, keluhan sudah berkurang', '2025-09-22 14:30:00', 'dikonfirmasi', 'mayaindah92@gmail.com', 0, 'PKU-01', '2025-09-22', 'selesai', 'Kondisi membaik, tidak ada keluhan sakit kepala', 'Vitamin B Complex 1x1 (lanjutkan 1 minggu)', 'Pertahankan pola hidup sehat, olahraga teratur, kelola stress dengan baik', 'Kondisi sudah membaik, tidak perlu kontrol rutin kecuali ada keluhan', 'Kontrol selesai, kondisi sudah sembuh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-22 08:10:15', '2025-09-22 00:30:15', '2025-09-22 01:10:15'),
(6, 6, 6, NULL, NULL, '20251509004', '3204110809850004', 'Budi Santoso', 'L', '1985-03-08', '08456789012', '0003456789012', 'Jl. Pajajaran No. 67 RT.05 RW.02, Kelurahan Jamika\nKelurahan Jamika, Kecamatan Bojongloa Kidul, Kota Bandung', '08654321098', 'ayah', 'pemeriksaan_umum', 'Nyeri punggung dan kaku otot setelah angkat barang berat', '2025-09-15 13:45:00', 'dikonfirmasi', 'budisantoso85@gmail.com', 0, 'PKU-05', '2025-09-15', 'selesai', 'Low Back Pain (Nyeri Punggung Bawah) akibat muscle strain', 'Diclofenac Sodium 50mg 3x1 (sesudah makan), Vitamin B1 B6 B12 2x1', 'Istirahat relatif, kompres hangat 15-20 menit 3x sehari, hindari mengangkat beban berat', 'Kontrol dalam 3 hari. Jika nyeri tidak berkurang atau ada mati rasa, segera kembali', 'Pemeriksaan pertama selesai, perlu kontrol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-15 07:35:20', '2025-09-14 23:45:12', '2025-09-15 00:35:20'),
(7, 7, 7, NULL, NULL, '20251509004', '3204110809850004', 'Budi Santoso', 'L', '1985-03-08', '08456789012', '0003456789012', 'Jl. Pajajaran No. 67 RT.05 RW.02, Kelurahan Jamika\nKelurahan Jamika, Kecamatan Bojongloa Kidul, Kota Bandung', '08654321098', 'ayah', 'pemeriksaan_umum', 'Kontrol nyeri punggung, keluhan sudah mendingan', '2025-09-18 10:15:00', 'dikonfirmasi', 'budisantoso85@gmail.com', 0, 'PKU-01', '2025-09-18', 'selesai', 'Low Back Pain membaik, nyeri berkurang signifikan', 'Vitamin B Complex 1x1 (lanjutkan 1 minggu)', 'Mulai aktivitas fisik ringan, lakukan peregangan punggung, hindari posisi duduk terlalu lama', 'Kondisi sudah membaik 80%, tidak perlu kontrol rutin. Kembali jika nyeri kambuh', 'Kontrol selesai, kondisi sudah membaik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-18 03:50:30', '2025-09-17 20:15:30', '2025-09-17 20:50:30'),
(8, 8, 8, NULL, NULL, '20251509006', '3204110809900005', 'Dewi Anggraini', 'P', '1990-12-25', '08567890123', NULL, 'Jl. Dago No. 89 RT.04 RW.01, Kelurahan Dago\nKelurahan Dago, Kecamatan Coblong, Kota Bandung', '08543210987', 'ibu', 'pemeriksaan_umum', 'Gatal-gatal di kulit dan ruam merah setelah makan seafood', '2025-09-15 15:20:00', 'dikonfirmasi', 'dewi.anggraini90@gmail.com', 0, 'PKU-06', '2025-09-15', 'selesai', 'Dermatitis Alergi (Alergi makanan - seafood)', 'Cetirizine 10mg 1x1 (malam hari), Hydrocortisone cream 2,5% (oleskan tipis di area gatal 2x sehari)', 'Hindari seafood dan makanan laut, jaga kebersihan kulit, gunakan sabun hypoallergenic, hindari menggaruk', 'Kontrol dalam 5 hari jika gatal tidak berkurang. Segera ke IGD jika ada sesak nafas atau bengkak di wajah', 'Pemeriksaan selesai, alergi terobati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'selesai_semua', '2025-09-15 09:20:40', '2025-09-15 01:20:45', '2025-09-15 02:20:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan_umum`
--

CREATE TABLE `pemeriksaan_umum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `no_rekam_medis` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `no_bpjs` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text NOT NULL,
  `kontak_darurat` varchar(255) NOT NULL,
  `hubungan_kontak` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_transfer` date NOT NULL,
  `no_antrian` varchar(10) DEFAULT NULL,
  `waktu_konfirmasi` timestamp NULL DEFAULT NULL,
  `konfirmasi_by` bigint(20) UNSIGNED DEFAULT NULL,
  `waktu_mulai_periksa` timestamp NULL DEFAULT NULL,
  `mulai_periksa_by` bigint(20) UNSIGNED DEFAULT NULL,
  `waktu_selesai_periksa` timestamp NULL DEFAULT NULL,
  `selesai_periksa_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status_pemeriksaan` enum('menunggu','dikonfirmasi','sedang_diperiksa','selesai') DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `diagnosis_sementara` text DEFAULT NULL,
  `obat_diberikan` text DEFAULT NULL,
  `anjuran_instruksi` text DEFAULT NULL,
  `rujukan` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_lpk_sentosa` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemeriksaan_umum`
--

INSERT INTO `pemeriksaan_umum` (`id`, `pendaftaran_id`, `no_rekam_medis`, `nik`, `nama`, `jenis_kelamin`, `tgl_lahir`, `no_hp`, `no_bpjs`, `alamat_lengkap`, `kontak_darurat`, `hubungan_kontak`, `catatan`, `tgl_transfer`, `no_antrian`, `waktu_konfirmasi`, `konfirmasi_by`, `waktu_mulai_periksa`, `mulai_periksa_by`, `waktu_selesai_periksa`, `selesai_periksa_by`, `status_pemeriksaan`, `created_at`, `updated_at`, `diagnosis_sementara`, `obat_diberikan`, `anjuran_instruksi`, `rujukan`, `email`, `is_lpk_sentosa`) VALUES
(1, 1, '20251509005', '3204110809020005', 'Wibi', 'L', '2000-08-08', '43234223', NULL, 'Jln Cicukang No 3 RT.07 RW.02, Desa Mekarrahayu\r\nDesa Mekarrahayu, Kecamatan Margaasih, Kabupaten Bandung', '342432', 'ayah', NULL, '2025-09-15', 'PKU-01', '2025-09-15 05:11:40', 6, '2025-09-15 05:11:48', 6, '2025-09-15 05:12:14', 6, 'selesai', '2025-09-15 05:10:37', '2025-09-15 05:12:14', 'Flu', 'Oksadon', 'Istirahat', 'Aman', 'fakturis@example.com', 0),
(2, 2, '20251509001', '3204110809950001', 'Sari Dewi Lestari', 'P', '1995-05-12', '08123456789', NULL, 'Jl. Merdeka No. 45 RT.03 RW.05, Desa Sukamaju\r\nDesa Sukamaju, Kecamatan Cibiru, Kabupaten Bandung', '08987654321', 'ibu', NULL, '2025-09-15', 'PKU-02', '2025-09-14 18:45:22', 6, '2025-09-14 18:50:00', 6, '2025-09-14 19:15:30', 6, 'selesai', '2025-09-14 18:45:22', '2025-09-14 19:15:30', 'ISPA', 'Paracetamol', 'Istirahat cukup', 'Aman', 'saridewi@gmail.com', 0),
(3, 3, '20251509002', '3204110809880002', 'Ahmad Rizky Pratama', 'L', '1988-11-20', '08234567890', NULL, 'Jl. Veteran No. 78 RT.02 RW.04, Kelurahan Babakan\r\nKelurahan Babakan, Kecamatan Bojongloa Kaler, Kota Bandung', '08876543210', 'ayah', NULL, '2025-09-15', 'PKU-03', '2025-09-14 19:30:45', 6, '2025-09-14 19:35:15', 6, '2025-09-14 20:05:00', 6, 'selesai', '2025-09-14 19:30:45', '2025-09-14 20:05:00', 'Gastritis', 'Omeprazole', 'Diet lunak', 'Kontrol jika perlu', 'ahmadrizky88@gmail.com', 0),
(4, 4, '20251509003', '3204110809920003', 'Maya Indah Sari', 'P', '1992-07-15', '08345678901', NULL, 'Jl. Sudirman No. 123 RT.01 RW.03, Desa Cisarua\r\nDesa Cisarua, Kecamatan Lembang, Kabupaten Bandung Barat', '08765432109', 'saudara', NULL, '2025-09-15', 'PKU-04', '2025-09-14 20:20:18', 6, '2025-09-14 20:25:30', 6, '2025-09-14 20:50:45', 6, 'selesai', '2025-09-14 20:20:18', '2025-09-14 20:50:45', 'Headache', 'Asam Mefenamat', 'Istirahat', 'Kontrol jika perlu', 'mayaindah92@gmail.com', 0),
(5, 5, '20251509004', '3204110809850004', 'Budi Santoso', 'L', '1985-03-08', '08456789012', NULL, 'Jl. Pajajaran No. 67 RT.05 RW.02, Kelurahan Jamika\r\nKelurahan Jamika, Kecamatan Bojongloa Kidul, Kota Bandung', '08654321098', 'ayah', NULL, '2025-09-15', 'PKU-05', '2025-09-15 00:00:25', 6, '2025-09-15 00:05:40', 6, '2025-09-15 00:35:20', 6, 'selesai', '2025-09-15 00:00:25', '2025-09-15 00:35:20', 'Back Pain', 'Diclofenac', 'Kompres hangat', 'Istirahat', 'budisantoso85@gmail.com', 0),
(6, 6, '20251509006', '3204110809900005', 'Dewi Anggraini', 'P', '1990-12-25', '08567890123', NULL, 'Jl. Dago No. 89 RT.04 RW.01, Kelurahan Dago\r\nKelurahan Dago, Kecamatan Coblong, Kota Bandung', '08543210987', 'ibu', NULL, '2025-09-15', 'PKU-06', '2025-09-15 01:40:12', 6, '2025-09-15 01:45:25', 6, '2025-09-15 02:20:40', 6, 'selesai', '2025-09-15 01:40:12', '2025-09-15 02:20:40', 'Alergi', 'Cetirizine', 'Hindari alergen', 'Aman', 'dewi.anggraini90@gmail.com', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `alamat_lengkap` text NOT NULL,
  `kontak_darurat` varchar(15) NOT NULL,
  `hubungan_kontak` enum('ayah','ibu','saudara') NOT NULL,
  `keluhan` enum('pemeriksaan_umum','lab','radiologi') NOT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_pendaftaran` datetime NOT NULL,
  `waktu_submit` timestamp NULL DEFAULT NULL,
  `status` enum('menunggu','dikonfirmasi','ditolak') NOT NULL DEFAULT 'menunggu',
  `no_rekam_medis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_lpk_sentosa` tinyint(1) DEFAULT 0,
  `transferred_by` bigint(20) UNSIGNED DEFAULT NULL,
  `transferred_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nik`, `nama`, `jenis_kelamin`, `tgl_lahir`, `no_hp`, `no_bpjs`, `alamat_lengkap`, `kontak_darurat`, `hubungan_kontak`, `keluhan`, `catatan`, `tgl_pendaftaran`, `waktu_submit`, `status`, `no_rekam_medis`, `created_at`, `updated_at`, `email`, `is_lpk_sentosa`, `transferred_by`, `transferred_at`) VALUES
(1, '3204110809020005', 'Wibi', 'L', '2000-08-08', '43234223', NULL, 'Jln Cicukang No 3 RT.07 RW.02, Desa Mekarrahayu\r\nDesa Mekarrahayu, Kecamatan Margaasih, Kabupaten Bandung', '342432', 'ayah', 'pemeriksaan_umum', NULL, '2025-09-15 00:00:00', '2025-09-15 05:10:01', 'dikonfirmasi', '20251509005', '2025-09-15 05:10:01', '2025-09-15 05:10:37', 'fakturis@example.com', 0, 6, '2025-09-15 05:10:37'),
(2, '3204110809950001', 'Sari Dewi Lestari', 'P', '1995-05-12', '08123456789', NULL, 'Jl. Merdeka No. 45 RT.03 RW.05, Desa Sukamaju\r\nDesa Sukamaju, Kecamatan Cibiru, Kabupaten Bandung', '08987654321', 'ibu', 'pemeriksaan_umum', NULL, '2025-09-15 00:00:00', '2025-09-14 18:30:15', 'dikonfirmasi', '20251509001', '2025-09-14 18:30:15', '2025-09-14 18:45:22', 'saridewi@gmail.com', 0, 6, '2025-09-14 18:45:22'),
(3, '3204110809880002', 'Ahmad Rizky Pratama', 'L', '1988-11-20', '08234567890', NULL, 'Jl. Veteran No. 78 RT.02 RW.04, Kelurahan Babakan\r\nKelurahan Babakan, Kecamatan Bojongloa Kaler, Kota Bandung', '08876543210', 'ayah', 'pemeriksaan_umum', NULL, '2025-09-15 00:00:00', '2025-09-14 19:15:30', 'dikonfirmasi', '20251509002', '2025-09-14 19:15:30', '2025-09-14 19:30:45', 'ahmadrizky88@gmail.com', 0, 6, '2025-09-14 19:30:45'),
(4, '3204110809920003', 'Maya Indah Sari', 'P', '1992-07-15', '08345678901', NULL, 'Jl. Sudirman No. 123 RT.01 RW.03, Desa Cisarua\r\nDesa Cisarua, Kecamatan Lembang, Kabupaten Bandung Barat', '08765432109', 'saudara', 'pemeriksaan_umum', NULL, '2025-09-15 00:00:00', '2025-09-14 20:00:22', 'dikonfirmasi', '20251509003', '2025-09-14 20:00:22', '2025-09-14 20:20:18', 'mayaindah92@gmail.com', 0, 6, '2025-09-14 20:20:18'),
(5, '3204110809850004', 'Budi Santoso', 'L', '1985-03-08', '08456789012', NULL, 'Jl. Pajajaran No. 67 RT.05 RW.02, Kelurahan Jamika\r\nKelurahan Jamika, Kecamatan Bojongloa Kidul, Kota Bandung', '08654321098', 'ayah', 'pemeriksaan_umum', NULL, '2025-09-15 00:00:00', '2025-09-14 23:45:12', 'dikonfirmasi', '20251509004', '2025-09-14 23:45:12', '2025-09-15 00:00:25', 'budisantoso85@gmail.com', 0, 6, '2025-09-15 00:00:25'),
(6, '3204110809900005', 'Dewi Anggraini', 'P', '1990-12-25', '08567890123', NULL, 'Jl. Dago No. 89 RT.04 RW.01, Kelurahan Dago\r\nKelurahan Dago, Kecamatan Coblong, Kota Bandung', '08543210987', 'ibu', 'pemeriksaan_umum', NULL, '2025-09-15 00:00:00', '2025-09-15 01:20:45', 'dikonfirmasi', '20251509006', '2025-09-15 01:20:45', '2025-09-15 01:40:12', 'dewi.anggraini90@gmail.com', 0, 6, '2025-09-15 01:40:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perawat`
--

CREATE TABLE `perawat` (
  `id_perawat` bigint(20) UNSIGNED NOT NULL,
  `nama_perawat` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tingkat_pendidikan` enum('D3 Keperawatan','S1 Keperawatan','Ners') NOT NULL,
  `no_str` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jadwal_kerja` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`jadwal_kerja`)),
  `status_aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `radiologi`
--

CREATE TABLE `radiologi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_rekam_medis` varchar(20) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `kontak_darurat` varchar(255) DEFAULT NULL,
  `hubungan_kontak` varchar(255) DEFAULT NULL,
  `status_pemeriksaan` varchar(20) DEFAULT NULL,
  `no_antrian` varchar(10) DEFAULT NULL,
  `jenis_radiologi` enum('rontgen','ct_scan','mri','usg','mammografi') DEFAULT NULL,
  `hasil_radiologi` text DEFAULT NULL,
  `dokter_radiologi` varchar(255) DEFAULT NULL,
  `teknisi_radiologi` varchar(255) DEFAULT NULL,
  `tgl_pemeriksaan` date DEFAULT NULL,
  `catatan_radiologi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_lpk_sentosa` tinyint(1) DEFAULT 0,
  `transfer_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID user yang melakukan transfer dari pendaftaran',
  `antrian_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID user yang set antrian',
  `mulai_periksa_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID user yang mulai pemeriksaan',
  `selesai_periksa_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID user yang selesaikan pemeriksaan',
  `transfer_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu transfer dari pendaftaran',
  `antrian_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu set antrian',
  `mulai_periksa_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu mulai pemeriksaan',
  `selesai_periksa_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu selesai pemeriksaan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `radiologi`
--

INSERT INTO `radiologi` (`id`, `pendaftaran_id`, `nik`, `nama`, `no_rekam_medis`, `jenis_kelamin`, `tgl_lahir`, `no_hp`, `alamat_lengkap`, `keluhan`, `kontak_darurat`, `hubungan_kontak`, `status_pemeriksaan`, `no_antrian`, `jenis_radiologi`, `hasil_radiologi`, `dokter_radiologi`, `teknisi_radiologi`, `tgl_pemeriksaan`, `catatan_radiologi`, `created_at`, `updated_at`, `email`, `is_lpk_sentosa`, `transfer_by`, `antrian_by`, `mulai_periksa_by`, `selesai_periksa_by`, `transfer_at`, `antrian_at`, `mulai_periksa_at`, `selesai_periksa_at`) VALUES
(1, 67, '3204110809020005', 'Bixya', '20250406005', 'L', '2000-08-09', '434243', 'Jln Cicukang No 3 RT.07 RW.02, Desa Mekarrahayu\r\nDesa Mekarrahayu, Kecamatan Margaasih, Kabupaten Bandung', 'radiologi', '4332', 'ibu', 'selesai', 'RAD-01', 'mri', 'wfwef', 'fewf', 'wede', '2025-06-04', 'ewdw', '2025-06-04 04:40:53', '2025-06-04 04:41:25', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 69, '3204110809021115', 'bill', '20250406115', 'L', '2000-08-09', '34432', '2eewdw', 'radiologi', '234323', 'ayah', 'selesai', 'RAD-02', 'mri', 'cwedwe', 'wecew', 'wecew', '2025-06-04', 'cecw', '2025-06-04 08:00:54', '2025-06-04 08:01:56', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 75, '3242354345564567', 'AStrid', '20252306567', 'P', '2000-08-09', '43546454354643', 'freefe', 'radiologi', '43434', 'ibu', 'sedang_diperiksa', 'RAD-01', NULL, NULL, NULL, NULL, '2025-06-23', NULL, '2025-06-23 07:00:20', '2025-06-23 07:00:38', '233423@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 80, '2435453245643545', 'casacs', '20250309545', 'L', '2000-09-09', '342343432', 'wfeww', 'radiologi', '43434324', 'ayah', 'selesai', 'RAD-01', 'mri', 'wfew', '23d', 'ewcw', '2025-09-03', NULL, '2025-09-03 13:31:01', '2025-09-03 13:31:25', 'saddf@gmail.com', 0, 13, 13, 13, 13, NULL, NULL, NULL, NULL),
(5, 82, '4532456434546434', 'dwecw', '20250309434', 'P', '2000-08-08', '3241343', 'cwe', 'radiologi', '2232132', 'ibu', 'selesai', 'RAD-02', 'ct_scan', 'cwf', 'we23', 'wedw', '2025-09-03', NULL, '2025-09-03 15:08:30', '2025-09-03 15:08:59', 'oraaraorauwu@gmail.com', 0, 6, 6, 6, 6, NULL, NULL, NULL, NULL),
(6, 83, '4354324534534433', 'wcsac', '20250309433', 'L', '2000-08-09', '344243234234', 'ecwds', 'radiologi', '32423', 'ayah', 'selesai', 'RAD-03', 'usg', 'cwecw', 'ces', 'wecs', '2025-09-03', NULL, '2025-09-03 15:39:39', '2025-09-03 15:40:41', '323@gmail.com', 0, 6, 6, 6, 6, '2025-09-03 15:39:39', '2025-09-03 15:39:51', '2025-09-03 15:40:01', '2025-09-03 15:40:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keterangan`
--

CREATE TABLE `surat_keterangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('template','history') NOT NULL COMMENT 'Type: template atau history',
  `jenis_surat` enum('sehat','sakit') NOT NULL COMMENT 'Jenis: surat sehat atau sakit',
  `content` text DEFAULT NULL COMMENT 'Isi template surat',
  `printed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu cetak surat',
  `printed_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'User yang mencetak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_keterangan`
--

INSERT INTO `surat_keterangan` (`id`, `type`, `jenis_surat`, `content`, `printed_at`, `printed_by`, `created_at`, `updated_at`) VALUES
(1, 'template', 'sehat', '<div class=\"text-center mb-4\">\n                    <h2><strong>SURAT KETERANGAN SEHAT</strong></h2>\n                    <p>No: _______________</p>\n                </div>\n                \n                <p>Yang bertanda tangan di bawah ini, Dokter:</p>\n                \n                <table class=\"mb-3\">\n                    <tr>\n                        <td width=\"120\">Nama</td>\n                        <td width=\"20\">:</td>\n                        <td>_______________________________</td>\n                    </tr>\n                    <tr>\n                        <td>SIP</td>\n                        <td>:</td>\n                        <td>_______________________________</td>\n                    </tr>\n                </table>\n                \n                <p>Menerangkan bahwa:</p>\n                \n                <table class=\"mb-3\">\n                    <tr>\n                        <td width=\"120\">Nama</td>\n                        <td width=\"20\">:</td>\n                        <td>_______________________________</td>\n                    </tr>\n                    <tr>\n                        <td>TTL</td>\n                        <td>:</td>\n                        <td>_______________________________</td>\n                    </tr>\n                    <tr>\n                        <td>Alamat</td>\n                        <td>:</td>\n                        <td>_______________________________</td>\n                    </tr>\n                    <tr>\n                        <td>Pekerjaan</td>\n                        <td>:</td>\n                        <td>_______________________________</td>\n                    </tr>\n                </table>\n                \n                <p><strong>Dalam keadaan SEHAT</strong> dan dapat melakukan aktivitas normal.</p>\n                \n                <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>\n                \n                <div class=\"mt-5 text-right\">\n                    <p>______________________, __________</p>\n                    <p class=\"mt-5\">\n                        <strong>_______________________</strong><br>\n                        Dokter\n                    </p>\n                </div>', NULL, NULL, '2025-06-24 02:52:31', '2025-06-26 09:49:58'),
(2, 'history', 'sehat', NULL, '2025-06-24 03:13:07', 6, '2025-06-24 03:13:07', '2025-06-24 03:13:07'),
(3, 'history', 'sehat', NULL, '2025-06-24 03:13:29', 6, '2025-06-24 03:13:29', '2025-06-24 03:13:29'),
(4, 'history', 'sehat', NULL, '2025-06-24 03:19:58', 6, '2025-06-24 03:19:58', '2025-06-24 03:19:58'),
(5, 'history', 'sehat', NULL, '2025-06-24 03:23:55', 6, '2025-06-24 03:23:55', '2025-06-24 03:23:55'),
(6, 'history', 'sehat', NULL, '2025-06-24 03:30:10', 6, '2025-06-24 03:30:10', '2025-06-24 03:30:10'),
(7, 'history', 'sehat', NULL, '2025-06-24 03:38:37', 6, '2025-06-24 03:38:37', '2025-06-24 03:38:37'),
(8, 'history', 'sehat', NULL, '2025-06-24 03:41:00', 6, '2025-06-24 03:41:00', '2025-06-24 03:41:00'),
(9, 'history', 'sehat', NULL, '2025-06-24 03:41:20', 6, '2025-06-24 03:41:20', '2025-06-24 03:41:20'),
(10, 'history', 'sehat', NULL, '2025-06-24 03:41:45', 6, '2025-06-24 03:41:45', '2025-06-24 03:41:45'),
(11, 'history', 'sehat', NULL, '2025-06-24 03:49:07', 6, '2025-06-24 03:49:07', '2025-06-24 03:49:07'),
(12, 'template', 'sakit', '\r\n            <div style=\"text-align: center; margin-bottom: 20px;\">\r\n                <h2><strong>SURAT KETERANGAN SAKIT</strong></h2>\r\n                <p>No: <span class=\"blank-line\"></span></p>\r\n            </div>\r\n            \r\n            <p>Yang bertanda tangan di bawah ini, Dokter:</p>\r\n            \r\n            <table style=\"width: 100%; margin-bottom: 15px;\">\r\n                <tr>\r\n                    <td style=\"width: 120px; padding: 5px 0;\">Nama</td>\r\n                    <td style=\"width: 20px; padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"padding: 5px 0;\">SIP</td>\r\n                    <td style=\"padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n            </table>\r\n            \r\n            <p>Menerangkan bahwa:</p>\r\n            \r\n            <table style=\"width: 100%; margin-bottom: 15px;\">\r\n                <tr>\r\n                    <td style=\"width: 120px; padding: 5px 0;\">Nama</td>\r\n                    <td style=\"width: 20px; padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"padding: 5px 0;\">TTL</td>\r\n                    <td style=\"padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"padding: 5px 0;\">Alamat</td>\r\n                    <td style=\"padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"padding: 5px 0;\">Pekerjaan</td>\r\n                    <td style=\"padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n            </table>\r\n            \r\n            <p><strong>Sedang SAKIT</strong> dan perlu istirahat selama:</p>\r\n            \r\n            <table style=\"width: 100%; margin-bottom: 15px;\">\r\n                <tr>\r\n                    <td style=\"width: 120px; padding: 5px 0;\">Dari tanggal</td>\r\n                    <td style=\"width: 20px; padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"padding: 5px 0;\">Sampai tanggal</td>\r\n                    <td style=\"padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style=\"padding: 5px 0;\">Diagnosis</td>\r\n                    <td style=\"padding: 5px 0; text-align: center;\">:</td>\r\n                    <td style=\"padding: 5px 0;\"></td>\r\n                </tr>\r\n            </table>\r\n            \r\n            <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>\r\n            \r\n            <div style=\"margin-top: 40px; text-align: right;\">\r\n                <p><span class=\"blank-line\"></span>, <span class=\"blank-line\"></span></p>\r\n                <p style=\"margin-top: 60px;\">\r\n                    <strong><span class=\"blank-line\"></span></strong><br>\r\n                    Dokter\r\n                </p>\r\n            </div>\r\n        ', NULL, NULL, '2025-06-24 03:56:28', '2025-06-24 03:56:28'),
(13, 'history', 'sakit', NULL, '2025-06-24 03:56:36', 6, '2025-06-24 03:56:36', '2025-06-24 03:56:36'),
(14, 'history', 'sehat', NULL, '2025-06-24 04:30:16', 6, '2025-06-24 04:30:16', '2025-06-24 04:30:16'),
(15, 'history', 'sehat', NULL, '2025-06-26 09:48:28', 6, '2025-06-26 09:48:28', '2025-06-26 09:48:28'),
(16, 'history', 'sehat', NULL, '2025-06-26 09:49:05', 6, '2025-06-26 09:49:05', '2025-06-26 09:49:05'),
(17, 'history', 'sehat', NULL, '2025-06-26 09:49:37', 6, '2025-06-26 09:49:37', '2025-06-26 09:49:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','karyawan','user') NOT NULL DEFAULT 'user',
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `reminder_date` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `permissions`, `is_active`, `password`, `reminder_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Super Admin', 'superadmin@klinik.com', 'superadmin', '[\"pendaftaran\",\"pemeriksaan_umum\",\"laboratorium\",\"radiologi\",\"data_pasien\",\"user_management\"]', 1, '$2y$10$g11vAosQr.GRVEhnXLSJFe4d.ZseC1U3pl7VhYXFrnS8ezPNd5Rm6', NULL, NULL, '2025-06-05 02:53:27', '2025-06-05 02:53:27'),
(7, 'Admin Klinik', 'admin@klinik.com', 'admin', '[\"pendaftaran\",\"pemeriksaan_umum\",\"laboratorium\",\"radiologi\",\"data_pasien\"]', 1, '$2y$10$B/rcrSedY4dBcCrEyaFBs.OThQNVA5xHlN9LMW1emGbwE4GIoT7qS', NULL, NULL, '2025-06-05 02:53:27', '2025-06-05 02:53:27'),
(8, 'Karyawan Pendaftaran', 'pendaftaran@klinik.com', 'karyawan', '[\"pendaftaran\"]', 1, '$2y$10$vPE3ZvNP80HC7Pg0Hxj3z.5R7cmul8CCCaviHJa.5sNaxxvMES6sC', NULL, NULL, '2025-06-05 02:53:27', '2025-06-05 02:53:27'),
(9, 'Karyawan Lab', 'lab@klinik.com', 'karyawan', '[\"laboratorium\",\"data_pasien\"]', 0, '$2y$10$zk6DKpy6FPG19r8uIPYZtOzJ0gGAlbCExOVLGFZfvQy0VwIYsEwYW', NULL, NULL, '2025-06-05 02:53:27', '2025-06-09 10:36:13'),
(11, 'Wibi Syah A', 'bilal@gmail.com', 'karyawan', '[\"pendaftaran\",\"data_pasien\"]', 1, '$2y$10$BZJpZfNEnpalFjpmPCZcCOfF41udxFHxsoub82vm9pUZvPO5SmD4K', NULL, NULL, '2025-06-05 07:54:08', '2025-06-05 07:54:08'),
(12, 'Bilalxyz', 'oraaraorauwu99@gmail.com', 'karyawan', '[\"pendaftaran\",\"laporan\",\"data_perawat\"]', 1, '$2y$10$QKJzYQWNUEio8udrIzEvROVQ6EA.JK/Oi1JqFOZethAHIC6tvsGnm', NULL, NULL, '2025-06-27 02:09:52', '2025-06-27 02:09:52'),
(13, 'bilal', 'oraaraorauwu11@gmail.com', 'karyawan', '[\"pendaftaran\",\"pemeriksaan_umum\",\"laboratorium\",\"radiologi\",\"data_pasien\",\"surat_keterangan\",\"data_perawat\"]', 1, '$2y$10$vOceOra8l.biRX72Y.x7JO8UT2am5CzZ9bP6FeTQyAJ0HdRJmFLAa', NULL, NULL, '2025-09-02 01:45:33', '2025-09-03 08:36:04'),
(15, 'Ahmad Fauzi', 'ahmad.fauzi@klinik.com', 'karyawan', '[\"laboratorium\", \"radiologi\", \"data_pasien\"]', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2025-09-15 02:05:54', '2025-09-15 04:48:51'),
(16, 'Maya Sari Dewi', 'maya.dewi@klinik.com', 'karyawan', '[\"pendaftaran\", \"pemeriksaan_umum\"]', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2025-09-15 02:05:54', '2025-09-15 02:05:54'),
(17, 'Rizky Pratama', 'rizky.pratama@klinik.com', 'karyawan', '[\"pendaftaran\", \"data_pasien\", \"surat_keterangan\"]', 0, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2025-09-15 02:05:54', '2025-09-15 03:44:30'),
(18, 'haisuper', 'superhai@gmail.com', 'karyawan', '[\"pendaftaran\",\"surat_keterangan\"]', 1, '$2y$10$WOP9f4MsRDbBRTuqI1ULL.Ootp8NCuWgjXq0yl7yCmi86ItAyfs0i', NULL, NULL, '2025-09-15 04:46:48', '2025-09-15 04:46:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_peralatan`
--
ALTER TABLE `biaya_peralatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya_peralatan_kategori_status_index` (`kategori`,`status`),
  ADD KEY `biaya_peralatan_nama_alat_index` (`nama_alat`),
  ADD KEY `biaya_peralatan_status_index` (`status`),
  ADD KEY `biaya_peralatan_tanggal_maintenance_selanjutnya_index` (`tanggal_maintenance_selanjutnya`),
  ADD KEY `biaya_peralatan_tanggal_kalibrasi_selanjutnya_index` (`tanggal_kalibrasi_selanjutnya`),
  ADD KEY `biaya_peralatan_created_by_foreign` (`created_by`),
  ADD KEY `biaya_peralatan_updated_by_foreign` (`updated_by`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `dokter_no_str_unique` (`no_str`),
  ADD UNIQUE KEY `dokter_email_unique` (`email`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laboratorium_pendaftaran_id_status_pemeriksaan_index` (`pendaftaran_id`,`status_pemeriksaan`),
  ADD KEY `laboratorium_tgl_pemeriksaan_index` (`tgl_pemeriksaan`),
  ADD KEY `laboratorium_set_antrian_by_foreign` (`set_antrian_by`),
  ADD KEY `laboratorium_mulai_periksa_by_foreign` (`mulai_periksa_by`),
  ADD KEY `laboratorium_selesai_periksa_by_foreign` (`selesai_periksa_by`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pemeriksaan_umum`
--
ALTER TABLE `pemeriksaan_umum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_umum_pendaftaran_id_foreign` (`pendaftaran_id`),
  ADD KEY `pemeriksaan_umum_no_rekam_medis_index` (`no_rekam_medis`),
  ADD KEY `pemeriksaan_umum_nik_index` (`nik`),
  ADD KEY `pemeriksaan_umum_tgl_transfer_index` (`tgl_transfer`),
  ADD KEY `pemeriksaan_umum_status_pemeriksaan_index` (`status_pemeriksaan`),
  ADD KEY `fk_konfirmasi_by` (`konfirmasi_by`),
  ADD KEY `fk_mulai_periksa_by` (`mulai_periksa_by`),
  ADD KEY `fk_selesai_periksa_by` (`selesai_periksa_by`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perawat`
--
ALTER TABLE `perawat`
  ADD PRIMARY KEY (`id_perawat`),
  ADD UNIQUE KEY `perawat_no_str_unique` (`no_str`),
  ADD UNIQUE KEY `perawat_email_unique` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `radiologi`
--
ALTER TABLE `radiologi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `radiologi_pendaftaran_id_status_pemeriksaan_index` (`pendaftaran_id`,`status_pemeriksaan`),
  ADD KEY `radiologi_tgl_pemeriksaan_index` (`tgl_pemeriksaan`),
  ADD KEY `radiologi_jenis_radiologi_index` (`jenis_radiologi`),
  ADD KEY `radiologi_transfer_by_index` (`transfer_by`),
  ADD KEY `radiologi_antrian_by_index` (`antrian_by`),
  ADD KEY `radiologi_mulai_periksa_by_index` (`mulai_periksa_by`),
  ADD KEY `radiologi_selesai_periksa_by_index` (`selesai_periksa_by`);

--
-- Indeks untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_keterangan_type_jenis_surat_index` (`type`,`jenis_surat`),
  ADD KEY `surat_keterangan_printed_at_index` (`printed_at`),
  ADD KEY `surat_keterangan_printed_by_foreign` (`printed_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_peralatan`
--
ALTER TABLE `biaya_peralatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan_umum`
--
ALTER TABLE `pemeriksaan_umum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `perawat`
--
ALTER TABLE `perawat`
  MODIFY `id_perawat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `radiologi`
--
ALTER TABLE `radiologi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biaya_peralatan`
--
ALTER TABLE `biaya_peralatan`
  ADD CONSTRAINT `biaya_peralatan_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `biaya_peralatan_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD CONSTRAINT `laboratorium_mulai_periksa_by_foreign` FOREIGN KEY (`mulai_periksa_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laboratorium_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laboratorium_selesai_periksa_by_foreign` FOREIGN KEY (`selesai_periksa_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laboratorium_set_antrian_by_foreign` FOREIGN KEY (`set_antrian_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pemeriksaan_umum`
--
ALTER TABLE `pemeriksaan_umum`
  ADD CONSTRAINT `fk_konfirmasi_by` FOREIGN KEY (`konfirmasi_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_mulai_periksa_by` FOREIGN KEY (`mulai_periksa_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_selesai_periksa_by` FOREIGN KEY (`selesai_periksa_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pemeriksaan_umum_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `radiologi`
--
ALTER TABLE `radiologi`
  ADD CONSTRAINT `radiologi_antrian_by_foreign` FOREIGN KEY (`antrian_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `radiologi_mulai_periksa_by_foreign` FOREIGN KEY (`mulai_periksa_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `radiologi_pendaftaran_id_foreign` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `radiologi_selesai_periksa_by_foreign` FOREIGN KEY (`selesai_periksa_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `radiologi_transfer_by_foreign` FOREIGN KEY (`transfer_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD CONSTRAINT `surat_keterangan_printed_by_foreign` FOREIGN KEY (`printed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
