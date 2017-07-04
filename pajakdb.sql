-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2017 at 06:42 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pajakdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `alket`
--

CREATE TABLE `alket` (
  `NO_ALKET` varchar(10) NOT NULL,
  `UNIT_KERJA_ASAL` varchar(10) DEFAULT NULL,
  `UNIT_KERJA_TUJUAN` varchar(10) DEFAULT NULL,
  `KODE_WP` varchar(10) DEFAULT NULL,
  `KODE_NON_WP` varchar(10) DEFAULT NULL,
  `KODE_JENIS_DOKUMEN` varchar(10) DEFAULT NULL,
  `LEMBAR` int(11) DEFAULT NULL,
  `KODE_STATUS_DOKUMEN` varchar(10) DEFAULT NULL,
  `NILAI_ALKET` int(11) DEFAULT NULL,
  `TGL_KIRIM` datetime DEFAULT NULL,
  `TGL_TERIMA` datetime DEFAULT NULL,
  `TGL_REALISASI` date DEFAULT NULL,
  `KETERANGAN` varchar(300) DEFAULT NULL,
  `TGL_LAPORAN` datetime DEFAULT NULL,
  `NILAI_REALISASI` int(11) DEFAULT NULL,
  `DOKUMEN` varchar(50) DEFAULT NULL,
  `NIP` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alket`
--

INSERT INTO `alket` (`NO_ALKET`, `UNIT_KERJA_ASAL`, `UNIT_KERJA_TUJUAN`, `KODE_WP`, `KODE_NON_WP`, `KODE_JENIS_DOKUMEN`, `LEMBAR`, `KODE_STATUS_DOKUMEN`, `NILAI_ALKET`, `TGL_KIRIM`, `TGL_TERIMA`, `TGL_REALISASI`, `KETERANGAN`, `TGL_LAPORAN`, `NILAI_REALISASI`, `DOKUMEN`, `NIP`) VALUES
('AK001', '200', '611', 'WP001', NULL, 'JD001', 1, 'SD003', 1, '2017-06-01 00:00:00', '2017-06-05 11:00:29', '2017-06-06', '', '2017-06-05 12:27:41', 1000, 'Lighthouse.jpg', '61104'),
('AK002', '200', '611', NULL, 'NW001', 'JD002', 1, 'SD004', 123, '2017-06-12 05:26:34', '2017-06-12 03:39:49', '2017-06-14', '', '2017-06-13 04:41:16', 22, 'kirim kanwil.PNG', '61105'),
('AK003', '200', '611', NULL, 'NW001', 'JD002', 2, 'SD001', 10000, '2017-06-13 05:49:00', '2017-06-14 09:55:36', NULL, '', NULL, NULL, 'tabel realisasi kpp.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `NO_DISPOSISI` int(11) NOT NULL,
  `NO_ALKET` varchar(10) NOT NULL,
  `PENGIRIM_DISPOSISI` varchar(10) DEFAULT NULL,
  `PENERIMA_DISPOSISI` varchar(10) DEFAULT NULL,
  `TGL_DISPOSISI` datetime DEFAULT NULL,
  `KETERANGAN` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`NO_DISPOSISI`, `NO_ALKET`, `PENGIRIM_DISPOSISI`, `PENERIMA_DISPOSISI`, `TGL_DISPOSISI`, `KETERANGAN`) VALUES
(3, 'AK001', '61101', '61102', '2017-06-05 10:59:44', 'HMM'),
(4, 'AK001', '61102', '61104', '2017-06-05 11:00:29', 'haaa'),
(5, 'AK002', '61101', '61103', '2017-06-12 03:02:26', 'Besok yy'),
(8, 'AK002', '61103', '61105', '2017-06-12 03:39:49', 'LUSA AJA GPP'),
(9, 'AK003', '61101', '61103', '2017-06-14 09:55:15', 'ko'),
(10, 'AK003', '61103', '61105', '2017-06-14 09:55:36', 'den');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `KODE_DIVISI` varchar(10) NOT NULL,
  `NAMA_DIVISI` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`KODE_DIVISI`, `NAMA_DIVISI`) VALUES
('DV001', 'Pelaksana Data dan Potensi'),
('DV002', 'Pengawasan dan Konsultasi'),
('DV003', 'Ekstentifikasi'),
('DV004', 'Dukungan Teknis Komputer'),
('DV005', 'Bimbingan Konsultasi'),
('DV006', 'Administrasi Penyidikan'),
('DV007', 'Bimbingan Penagihan'),
('DV008', ' Bimbingan Pemeriksaan Dan Kepatuhan Internal'),
('DV009', 'Hubungan Masyarakat'),
('DV010', 'Bimbingan Pelayanan');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `KODE_JABATAN` varchar(10) NOT NULL,
  `JABATAN_INDUK` varchar(10) DEFAULT NULL,
  `KODE_DIVISI` varchar(10) DEFAULT NULL,
  `NAMA_JABATAN` varchar(40) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`KODE_JABATAN`, `JABATAN_INDUK`, `KODE_DIVISI`, `NAMA_JABATAN`, `LEVEL`) VALUES
('JB001', NULL, 'DV001', 'Pelaksana', 0),
('JB002', NULL, NULL, 'Kepala KPP', 1),
('JB003', 'JB002', 'DV002', 'Kepala Seksi', 2),
('JB004', 'JB002', 'DV003', 'Kepala Seksi', 2),
('JB005', 'JB003', 'DV002', 'Account Representative', 3),
('JB006', 'JB004', 'DV003', 'Account Representative', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dokumen`
--

CREATE TABLE `jenis_dokumen` (
  `KODE_JENIS_DOKUMEN` varchar(10) NOT NULL,
  `NAMA_JENIS_DOKUMEN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_dokumen`
--

INSERT INTO `jenis_dokumen` (`KODE_JENIS_DOKUMEN`, `NAMA_JENIS_DOKUMEN`) VALUES
('JD001', 'PPAT'),
('JD002', 'KP.PDIP.3.1'),
('JD003', 'Jual Beli'),
('JD004', 'A'),
('JD005', 'B'),
('JD006', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `m_pemberitahuan`
--

CREATE TABLE `m_pemberitahuan` (
  `kode_mp` varchar(10) NOT NULL,
  `keterangan_mp` varchar(50) NOT NULL,
  `link_mp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pemberitahuan`
--

INSERT INTO `m_pemberitahuan` (`kode_mp`, `keterangan_mp`, `link_mp`) VALUES
('MP02', 'Alat Keterangan Pajak Baru', 'penerimaan'),
('MP03', 'Alat Keterangan Pajak Direalisasi', 'pengiriman'),
('MP04', 'Alat Keterangan Pajak Direalisasi', 'penerimaan');

-- --------------------------------------------------------

--
-- Table structure for table `non_wajib_pajak`
--

CREATE TABLE `non_wajib_pajak` (
  `KODE_NON_WP` varchar(10) NOT NULL,
  `NAMA_NON_WP` varchar(30) DEFAULT NULL,
  `TELP_NON_WP` varchar(15) DEFAULT NULL,
  `KPP_NON_WP` varchar(10) DEFAULT NULL,
  `ALAMAT_NON_WP` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `non_wajib_pajak`
--

INSERT INTO `non_wajib_pajak` (`KODE_NON_WP`, `NAMA_NON_WP`, `TELP_NON_WP`, `KPP_NON_WP`, `ALAMAT_NON_WP`) VALUES
('NW001', 'Kevin Julio', '081277884456', '618', 'Jl Pahlawan 102'),
('NW002', 'Fanywati Dasalim', '02158355020', '615', 'Jl. Surya Mandala I Jakarta Barat'),
('NW003', 'Devina Alfina', '02158355021', '615', 'Jl. Pulo Lentut Kav. II-E/4 Pulogadung Jakarta Timur'),
('NW004', 'Desi Rismaya', '0214608820', '615', 'Jl. S. Wiryopranoto No. 37 Sawah Besar Jakarta Barat'),
('NW005', 'Imam Safarudin', '0214608829', '618', 'Jl. Jend. Sudirman Kav. 60 Jakarta Selatan '),
('NW006', 'Tina Karlina', '0216591166', '618', 'Jl. Pemuda No. 296 Jakarta Timur '),
('NW007', 'Dian Romansyah', '0215220111', '611', 'Jl. Hayam Wuruk No 100 Jakarta Barat'),
('NW008', 'Arif Fiansyah', '0217891224', '611', 'Jl. HR. Rasuna Said Kav. B-1 Kuningan Jakarta Selatan'),
('NW009', 'Maman Sulaeman', '0216498755', '611', 'Jl. Casablanca Kav. 18 Jakarta Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `NIP` varchar(10) NOT NULL,
  `KODE_JABATAN` varchar(10) DEFAULT NULL,
  `KODE_UNIT_KERJA` varchar(10) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  `NAMA_PEGAWAI` varchar(30) DEFAULT NULL,
  `ALAMAT_PEGAWAI` varchar(300) DEFAULT NULL,
  `TELP_PEGAWAI` varchar(15) DEFAULT NULL,
  `EMAIL_PEGAWAI` varchar(30) DEFAULT NULL,
  `FOTO_PEGAWAI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`NIP`, `KODE_JABATAN`, `KODE_UNIT_KERJA`, `PASSWORD`, `NAMA_PEGAWAI`, `ALAMAT_PEGAWAI`, `TELP_PEGAWAI`, `EMAIL_PEGAWAI`, `FOTO_PEGAWAI`) VALUES
('20001', 'JB001', '200', '12345', 'Ahmad Ali', 'Jl Kenjeran 105 Surabaya', '081285845955', '', 'man.png'),
('61101', 'JB002', '611', '26575', 'Baharudin Fajar', 'Jl Boscha 17', '087754326754', '', 'men.png'),
('61102', 'JB003', '611', '30654', 'Cindy Amalia', 'Perum Pluit Indah', '087965438897', '', 'min.png'),
('61103', 'JB004', '611', '56743', 'Ciko Saputra', 'Jl Juanda X/45', '08765439907', NULL, 'pap.png'),
('61104', 'JB005', '611', '64538', 'Dinda Amelia', 'Jl Arjuna Gg V/12', '081264739578', NULL, 'pep.png'),
('61105', 'JB006', '611', '45676', 'Deni Darko', 'Komp Al Azhar Bintaro', '086473467992', NULL, 'pip.png'),
('61501', 'JB002', '615', '12859', 'Abdul Aziz', 'Dusun Bambu No 12 Bandung', '087851423695', 'Abdulaziz@gmail.com', 'boss.png'),
('61502', 'JB003', '615', '19774', 'Henry Bima', 'Jl. Daan Mogot No.34 Grogol', '082330602071', 'bimahenry@gmail.com', 'young.png'),
('61503', 'JB004', '615', '7985', 'Iriawan Tanti', 'Jl. K. S. Tubun No. 92 - 94', '083871576645', 'irtanti@gmail.com', 'indian.png'),
('61504', 'JB005', '615', '26134', 'Shelly Agnessia', 'Jl. Daan Mogot Km. 17 Cengkareng', '081286616893', 'agnes@gmail.com', 'kid.png');

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `kode_pemberitahuan` varchar(10) NOT NULL,
  `status_pemberitahuan` varchar(20) NOT NULL,
  `asal_pemberitahuan` varchar(10) NOT NULL,
  `tujuan_pemberitahuan` varchar(10) NOT NULL,
  `keterangan_pemberitahuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`kode_pemberitahuan`, `status_pemberitahuan`, `asal_pemberitahuan`, `tujuan_pemberitahuan`, `keterangan_pemberitahuan`) VALUES
('170612001', 'sudah', '20001', '61101', 'MP02'),
('170612002', 'sudah', '61101', '61103', 'MP02'),
('170612003', 'sudah', '61103', '61105', 'MP02'),
('170613004', 'sudah', '20001', '61101', 'MP02'),
('170614005', 'sudah', '61101', '61103', 'MP02'),
('170614006', 'sudah', '61103', '61105', 'MP02'),
('170614007', 'sudah', '61105', '61103', 'MP04'),
('170614008', 'belum', '61105', '61101', 'MP04'),
('170614009', 'sudah', '61105', '20001', 'MP03');

-- --------------------------------------------------------

--
-- Table structure for table `status_dokumen`
--

CREATE TABLE `status_dokumen` (
  `KODE_STATUS_DOKUMEN` varchar(10) NOT NULL,
  `NAMA_STATUS_DOKUMEN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_dokumen`
--

INSERT INTO `status_dokumen` (`KODE_STATUS_DOKUMEN`, `NAMA_STATUS_DOKUMEN`) VALUES
('SD001', 'Dikirim'),
('SD002', 'Diterima'),
('SD003', 'Dikunjungi'),
('SD004', 'Himbauan');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `KODE_UNIT_KERJA` varchar(10) NOT NULL,
  `NAMA_UNIT_KERJA` varchar(70) DEFAULT NULL,
  `ALAMAT_UNIT_KERJA` varchar(70) DEFAULT NULL,
  `TELP_UNIT_KERJA` varchar(15) NOT NULL,
  `FAX_UNIT_KERJA` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`KODE_UNIT_KERJA`, `NAMA_UNIT_KERJA`, `ALAMAT_UNIT_KERJA`, `TELP_UNIT_KERJA`, `FAX_UNIT_KERJA`) VALUES
('200', 'Kantor Wilayah Direktorat Jendral Pajak Jawa Timur I', 'Jl Jagir Wonokromo 104 (Lt 6)', '031 8482480', '8481127'),
('605', 'Kantor Pelayanan Pajak Pratama Surabaya Krembangan', 'Gedung GKN I, Jl. Indrapura No.5 Surabaya', '031 3556879', '3556880'),
('607', 'Kantor Pelayanan Pajak Pratama Surabaya Tegalsari', 'Gedung GKN II, Jl. Dinoyo No.111 Surabaya', '031 5615369', '5615367'),
('609', 'Kantor Pelayanan Pajak Pratama Surabaya Wonocolo', 'Jl. Jagir Wonokromo No.104 Surabaya', '031 8417629', '8411692'),
('611', 'Kantor Pelayanan Pajak Pratama Surabaya Gubeng', 'Jl Gubeng Airlangga 28 A Surabaya', '031 5031905', '5031566'),
('613', 'Kantor Pelayanan Pajak Pratama Surabaya Pabean Cantikan', 'Gedung GKN I, Jl. Indrapura No.5 Surabaya', '031 35230937', '3571156'),
('614', 'Kantor Pelayanan Pajak Pratama Surabaya Sawahan', 'Gedung GKN II, Jl. Dinoyo No.111 Surabaya', '031 566523133', '5665230'),
('615', 'Kantor Pelayanan Pajak Pratama Surabaya Rungkut', 'Jl. Jagir Wonokromo No.104 Surabaya', '031 8483196', '8483197'),
('618', 'Kantor Pelayanan Pajak Pratama Surabaya Karangpilang', 'Jl Jagir Wonokromo 104 (Lt 3)', '031 848391116', '8483914'),
('619', 'Kantor Pelayanan Pajak Pratama Surabaya Mulyorejo', 'Jl. Jagir Wonokromo No.100 Surabaya', '031 848390609', '8483905'),
('631', 'KPP Madya Surabaya', 'Jl. Jagir Wonokromo No.104 Surabaya', '031 8497200', '8482557');

-- --------------------------------------------------------

--
-- Table structure for table `wajib_pajak`
--

CREATE TABLE `wajib_pajak` (
  `KODE_WP` varchar(10) NOT NULL,
  `AR` varchar(10) DEFAULT NULL,
  `NPWP` varchar(20) DEFAULT NULL,
  `NAMA_WP` varchar(30) DEFAULT NULL,
  `ALAMAT_WP` varchar(100) DEFAULT NULL,
  `TELP_WP` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wajib_pajak`
--

INSERT INTO `wajib_pajak` (`KODE_WP`, `AR`, `NPWP`, `NAMA_WP`, `ALAMAT_WP`, `TELP_WP`) VALUES
('WP001', '61104', '123.456.789-0.111', 'Livana', 'Jl Margonda Raya Depok', '08765485968');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alket`
--
ALTER TABLE `alket`
  ADD PRIMARY KEY (`NO_ALKET`),
  ADD KEY `FK_BERJENIS` (`KODE_JENIS_DOKUMEN`),
  ADD KEY `FK_BERSTATUS` (`KODE_STATUS_DOKUMEN`),
  ADD KEY `FK_MEMILIKI` (`KODE_WP`),
  ADD KEY `FK_MENERIMA` (`UNIT_KERJA_TUJUAN`),
  ADD KEY `FK_MENGELOLA` (`NIP`),
  ADD KEY `FK_MENGIRIM` (`UNIT_KERJA_ASAL`),
  ADD KEY `FK_RELATION_464` (`KODE_NON_WP`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`NO_DISPOSISI`),
  ADD KEY `FK_MENERIMA2` (`PENGIRIM_DISPOSISI`),
  ADD KEY `FK_MENGIRIM2` (`PENERIMA_DISPOSISI`),
  ADD KEY `FK_SUMBER_DATA` (`NO_ALKET`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`KODE_DIVISI`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`KODE_JABATAN`),
  ADD KEY `FK_BERDIVISI` (`KODE_DIVISI`),
  ADD KEY `FK_SUPERVISI` (`JABATAN_INDUK`);

--
-- Indexes for table `jenis_dokumen`
--
ALTER TABLE `jenis_dokumen`
  ADD PRIMARY KEY (`KODE_JENIS_DOKUMEN`);

--
-- Indexes for table `m_pemberitahuan`
--
ALTER TABLE `m_pemberitahuan`
  ADD PRIMARY KEY (`kode_mp`);

--
-- Indexes for table `non_wajib_pajak`
--
ALTER TABLE `non_wajib_pajak`
  ADD PRIMARY KEY (`KODE_NON_WP`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `FK_BERTEMPAT` (`KODE_UNIT_KERJA`),
  ADD KEY `FK_MENJABAT` (`KODE_JABATAN`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`kode_pemberitahuan`);

--
-- Indexes for table `status_dokumen`
--
ALTER TABLE `status_dokumen`
  ADD PRIMARY KEY (`KODE_STATUS_DOKUMEN`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`KODE_UNIT_KERJA`);

--
-- Indexes for table `wajib_pajak`
--
ALTER TABLE `wajib_pajak`
  ADD PRIMARY KEY (`KODE_WP`),
  ADD KEY `FK_MEMBAWAHI` (`AR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `NO_DISPOSISI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alket`
--
ALTER TABLE `alket`
  ADD CONSTRAINT `FK_BERJENIS` FOREIGN KEY (`KODE_JENIS_DOKUMEN`) REFERENCES `jenis_dokumen` (`KODE_JENIS_DOKUMEN`),
  ADD CONSTRAINT `FK_BERSTATUS` FOREIGN KEY (`KODE_STATUS_DOKUMEN`) REFERENCES `status_dokumen` (`KODE_STATUS_DOKUMEN`),
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`KODE_WP`) REFERENCES `wajib_pajak` (`KODE_WP`),
  ADD CONSTRAINT `FK_MENERIMA` FOREIGN KEY (`UNIT_KERJA_TUJUAN`) REFERENCES `unit_kerja` (`KODE_UNIT_KERJA`),
  ADD CONSTRAINT `FK_MENGELOLA` FOREIGN KEY (`NIP`) REFERENCES `pegawai` (`NIP`),
  ADD CONSTRAINT `FK_MENGIRIM` FOREIGN KEY (`UNIT_KERJA_ASAL`) REFERENCES `unit_kerja` (`KODE_UNIT_KERJA`),
  ADD CONSTRAINT `FK_RELATION_464` FOREIGN KEY (`KODE_NON_WP`) REFERENCES `non_wajib_pajak` (`KODE_NON_WP`);

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `FK_MENERIMA2` FOREIGN KEY (`PENGIRIM_DISPOSISI`) REFERENCES `pegawai` (`NIP`),
  ADD CONSTRAINT `FK_MENGIRIM2` FOREIGN KEY (`PENERIMA_DISPOSISI`) REFERENCES `pegawai` (`NIP`),
  ADD CONSTRAINT `FK_SUMBER_DATA` FOREIGN KEY (`NO_ALKET`) REFERENCES `alket` (`NO_ALKET`);

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `FK_BERDIVISI` FOREIGN KEY (`KODE_DIVISI`) REFERENCES `divisi` (`KODE_DIVISI`),
  ADD CONSTRAINT `FK_SUPERVISI` FOREIGN KEY (`JABATAN_INDUK`) REFERENCES `jabatan` (`KODE_JABATAN`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_BERTEMPAT` FOREIGN KEY (`KODE_UNIT_KERJA`) REFERENCES `unit_kerja` (`KODE_UNIT_KERJA`),
  ADD CONSTRAINT `FK_MENJABAT` FOREIGN KEY (`KODE_JABATAN`) REFERENCES `jabatan` (`KODE_JABATAN`);

--
-- Constraints for table `wajib_pajak`
--
ALTER TABLE `wajib_pajak`
  ADD CONSTRAINT `FK_MEMBAWAHI` FOREIGN KEY (`AR`) REFERENCES `pegawai` (`NIP`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
