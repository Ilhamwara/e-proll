-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pr01_db
CREATE DATABASE IF NOT EXISTS `pr01_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pr01_db`;

-- Dumping structure for table pr01_db.master_bank
CREATE TABLE IF NOT EXISTS `master_bank` (
  `bank_id` varchar(10) NOT NULL,
  `bank_name` varchar(90) DEFAULT NULL,
  `bank_alamat` varchar(255) DEFAULT NULL,
  `bank_isdisabled` tinyint(1) NOT NULL DEFAULT 1,
  `_createby` varchar(30) NOT NULL,
  `_createdate` datetime NOT NULL DEFAULT current_timestamp(),
  `_modifyby` varchar(30) DEFAULT NULL,
  `_modifydate` datetime DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_bank: ~2 rows (approximately)
DELETE FROM `master_bank`;
/*!40000 ALTER TABLE `master_bank` DISABLE KEYS */;
INSERT INTO `master_bank` (`bank_id`, `bank_name`, `bank_alamat`, `bank_isdisabled`, `_createby`, `_createdate`, `_modifyby`, `_modifydate`) VALUES
	('1', 'BANK MANDIRI', 'Cabang Jakarta', 0, 'agung', '2019-11-25 11:24:20', NULL, NULL),
	('121212', 'BANK BRI', 'Cabang Panyabungan', 0, 'agung', '2019-11-25 11:42:30', NULL, NULL);
/*!40000 ALTER TABLE `master_bank` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_divisi
CREATE TABLE IF NOT EXISTS `master_divisi` (
  `divisi_id` varchar(5) NOT NULL,
  `divisi_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`divisi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_divisi: ~5 rows (approximately)
DELETE FROM `master_divisi`;
/*!40000 ALTER TABLE `master_divisi` DISABLE KEYS */;
INSERT INTO `master_divisi` (`divisi_id`, `divisi_name`) VALUES
	('D0002', 'DIREKSI'),
	('D0003', 'AKUNTANSI'),
	('D0004', 'PEMASARAN'),
	('D0005', 'KEUANGAN'),
	('D0006', 'PAJAK');
/*!40000 ALTER TABLE `master_divisi` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_employee
CREATE TABLE IF NOT EXISTS `master_employee` (
  `employee_id` varchar(10) NOT NULL,
  `employee_name` varchar(250) DEFAULT NULL,
  `employee_nip` varchar(30) DEFAULT NULL,
  `employee_ktp` varchar(50) DEFAULT NULL,
  `employee_tplahir` varchar(50) DEFAULT NULL,
  `employee_tglahir` date DEFAULT NULL,
  `employee_alamat` varchar(510) DEFAULT NULL,
  `employee_sex` varchar(10) DEFAULT NULL,
  `employee_agama` varchar(20) DEFAULT NULL,
  `employee_education` varchar(30) DEFAULT NULL,
  `employee_email` varchar(50) DEFAULT NULL,
  `employee_status` varchar(20) DEFAULT NULL,
  `employee_telp` varchar(20) DEFAULT NULL,
  `employee_anak` int(11) DEFAULT NULL,
  `employee_region_id` varchar(7) DEFAULT NULL,
  `employee_jabatan_id` varchar(7) DEFAULT NULL,
  `employee_divisi_id` varchar(7) DEFAULT NULL,
  `employee_gol_id` varchar(7) DEFAULT NULL,
  `employee_kontrak` varchar(10) DEFAULT NULL,
  `employee_start` date DEFAULT NULL,
  `employee_end` date DEFAULT NULL,
  `employee_isshift` tinyint(1) DEFAULT NULL,
  `employee_npwp` varchar(50) DEFAULT NULL,
  `employee_spajak` varchar(5) DEFAULT NULL,
  `employee_isactive` tinyint(1) DEFAULT NULL,
  `employee_bank` varchar(10) DEFAULT NULL,
  `employee_rek` varchar(30) DEFAULT NULL,
  `employee_pict` varchar(50) DEFAULT NULL,
  KEY `Index 1` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_employee: ~15 rows (approximately)
DELETE FROM `master_employee`;
/*!40000 ALTER TABLE `master_employee` DISABLE KEYS */;
INSERT INTO `master_employee` (`employee_id`, `employee_name`, `employee_nip`, `employee_ktp`, `employee_tplahir`, `employee_tglahir`, `employee_alamat`, `employee_sex`, `employee_agama`, `employee_education`, `employee_email`, `employee_status`, `employee_telp`, `employee_anak`, `employee_region_id`, `employee_jabatan_id`, `employee_divisi_id`, `employee_gol_id`, `employee_kontrak`, `employee_start`, `employee_end`, `employee_isshift`, `employee_npwp`, `employee_spajak`, `employee_isactive`, `employee_bank`, `employee_rek`, `employee_pict`) VALUES
	('G20010010', 'Maria', '1210', '31139103847409', 'Jakarta', '1984-11-07', 'Cibubur', 'wanita', 'katolik', 'S1', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'BNI', NULL, NULL),
	('G20010011', 'Nacha', '1210', '31139103847408', 'Panyabungan', '1984-11-07', 'Cibubur', 'pria', 'islam', 'S2', 'maria@yahoo.co.it', 'kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'MANDIRI', NULL, NULL),
	('G20010013', 'Maksunss', '1210', '31139103847407', 'Panyabungan', '1984-11-07', 'Cibubur', 'pria', 'islam', 'D1', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'BRI', NULL, NULL),
	('G20010012', 'Anjayy', '1210', '31139103847407', 'Medan', '1984-11-07', 'Cibubur', 'pria', 'islam', 'S1', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 0, '', '', '', '', 'permanent', '2007-11-07', '2089-11-07', 0, '', '3', 1, '8', '', NULL),
	('G20010014', 'Dewi', '1210', '31139103847407', 'Sipirok', '1984-11-07', 'Cibubur', 'wanita', 'islam', 'S1', 'maria@yahoo.co.it', 'kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'BNI', NULL, NULL),
	('G20010015', 'Makas', '1210', '31139103847407', 'Pidoli', '1984-11-07', 'Cibubur', 'wanita', 'islam', 'S1', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'MEGA', NULL, NULL),
	('G20010017', 'Lomlom', '1210', '31139103847407', 'Bandung', '1984-11-07', 'Cibubur', 'wanita', 'islam', 'D3', 'maria@yahoo.co.it', 'kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'MANDIRI', NULL, NULL),
	('G20010018', 'Herbert', '1210', '31139103847407', 'Panyabungan', '1984-11-07', 'Cibubur', 'pria', 'kristen', 'S1', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'BNI', NULL, NULL),
	('G20010019', 'Robert', '1210', '31139103847407', 'Padang', '1984-09-07', 'Cibubur', 'pria', 'kristen', 'S1', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 2, 'R0002', 'J0003', 'D0003', 'G0003', 'permanent', '2007-11-07', '2089-11-07', 0, '', '7', 1, '7', '', NULL),
	('G20010020', 'Suday', '', '31139103847407', 'Panyabungan', '1984-11-07', 'Cibubur', 'pria', 'islam', 'S1', 'maria@yahoo.co.it', 'kawin', '021-0281201', 0, '', '', '', '', 'permanent', '2007-11-07', '2089-11-07', 0, '', '', 1, '', '', NULL),
	('G20010022', 'Mema', '1210', '31139103847407', 'Panyabungan', '1984-11-07', 'Cibubur', 'wanita', 'islam', 'SMA', 'maria@yahoo.co.it', 'tidak kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'BCA', NULL, NULL),
	('G20010021', 'Emam', '1210', '31139103847407', 'Sukabumi', '1984-11-07', 'Cibubur', 'wanita', 'islam', 'S1', 'maria@yahoo.co.it', 'kawin', '021-0281201', 0, 'Bandung', 'Staff', 'Acc', '1A', 'permanent', '2007-11-07', '2089-11-07', 0, NULL, NULL, 1, 'MANDIRI', NULL, NULL),
	('G20010023', 'Abdul Nasrah', '9210920120', '3210291021021', 'Panyabungan', '0000-00-00', 'jln. Mess TNI AL, perum. Graha Cibubur View Sentani Blok D.5\r\nJatiraden\r\nJatisampurna\r\nBekasi', 'pria', 'islam', 'S1', 'nachadong@gmail.com', 'married', '021-9102827', 2, 'R0001', 'J0001', 'D0005', 'G0002', 'permanent', '0000-00-00', '0000-00-00', 0, '210920129032130', '6', 1, '2', '1300200018102021', NULL),
	('EP000027', 'Nacha Doang', '19101-110', '2109218495302', 'Batang Toru', '1987-09-27', 'Cibodas Jln Nangka..', 'pria', 'islam', 'D3', 'cindai@gmail.com', 'single', '081232013430', 0, 'R0004', 'J0004', 'D0006', 'G0003', 'permanent', '2013-11-28', '2030-12-25', 0, '210.20210.10120', '1', 1, '1', '92203925822100', NULL),
	('EP000028', 'Cidee', '182010', '3201-2930202', 'Medan', '1990-02-19', 'Mandailing Natal aja yee... \'oke\' ??', 'wanita', 'islam', 'SMA', 'cide_ayik@yahoo.co.id', 'single', '0821-9100-2010', 0, 'R0001', 'J0002', 'D0005', 'G0004', 'permanent', '2019-07-25', '2030-12-31', 0, '719210200211949', '1', 1, '4', '01092019201212', NULL);
/*!40000 ALTER TABLE `master_employee` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_gol
CREATE TABLE IF NOT EXISTS `master_gol` (
  `gol_id` varchar(5) NOT NULL,
  `gol_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`gol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_gol: ~5 rows (approximately)
DELETE FROM `master_gol`;
/*!40000 ALTER TABLE `master_gol` DISABLE KEYS */;
INSERT INTO `master_gol` (`gol_id`, `gol_name`) VALUES
	('G0001', '1A'),
	('G0002', '2A'),
	('G0003', '1B'),
	('G0004', '1C'),
	('G0005', 'A3');
/*!40000 ALTER TABLE `master_gol` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_group
CREATE TABLE IF NOT EXISTS `master_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `group_descr` varchar(200) DEFAULT NULL,
  `group_ico` varchar(200) DEFAULT NULL,
  `group_order` int(11) DEFAULT 0,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_group: ~5 rows (approximately)
DELETE FROM `master_group`;
/*!40000 ALTER TABLE `master_group` DISABLE KEYS */;
INSERT INTO `master_group` (`group_id`, `group_name`, `group_descr`, `group_ico`, `group_order`) VALUES
	(1, 'Setting', NULL, 'icon-settings', 0),
	(2, 'Master Data', NULL, 'icon-briefcase', 0),
	(3, 'Employee', NULL, 'icon-users', 0),
	(4, 'Payroll', NULL, 'icon-wallet', 0),
	(5, 'Report', NULL, 'icon-bar-chart', 0);
/*!40000 ALTER TABLE `master_group` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_jabatan
CREATE TABLE IF NOT EXISTS `master_jabatan` (
  `jabatan_id` varchar(5) NOT NULL,
  `jabatan_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_jabatan: ~5 rows (approximately)
DELETE FROM `master_jabatan`;
/*!40000 ALTER TABLE `master_jabatan` DISABLE KEYS */;
INSERT INTO `master_jabatan` (`jabatan_id`, `jabatan_name`) VALUES
	('J0001', 'MANAJER'),
	('J0002', 'STAFF'),
	('J0003', 'SENIOR MANAJER'),
	('J0004', 'SUPERVISOR'),
	('J0005', 'GENERAL MANAGER');
/*!40000 ALTER TABLE `master_jabatan` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_program
CREATE TABLE IF NOT EXISTS `master_program` (
  `program_id` varchar(50) NOT NULL DEFAULT '0',
  `program_group_id` int(11) NOT NULL,
  `program_title` varchar(100) DEFAULT NULL,
  `program_url` varchar(50) DEFAULT NULL,
  `program_ico` varchar(30) DEFAULT NULL,
  `program_class` varchar(50) DEFAULT NULL,
  `program_dir` varchar(50) DEFAULT NULL,
  `_createby` varchar(50) DEFAULT NULL,
  `_createdate` datetime DEFAULT current_timestamp(),
  `_modifyby` varchar(50) DEFAULT NULL,
  `_modifydate` datetime DEFAULT NULL,
  PRIMARY KEY (`program_id`),
  KEY `FK_master_program_master_group` (`program_group_id`),
  CONSTRAINT `FK_master_program_master_group` FOREIGN KEY (`program_group_id`) REFERENCES `master_group` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_program: ~17 rows (approximately)
DELETE FROM `master_program`;
/*!40000 ALTER TABLE `master_program` DISABLE KEYS */;
INSERT INTO `master_program` (`program_id`, `program_group_id`, `program_title`, `program_url`, `program_ico`, `program_class`, `program_dir`, `_createby`, `_createdate`, `_modifyby`, `_modifydate`) VALUES
	('1', 3, 'E.01 List Employee', 'employee/employee_list', 'fa fa-users', 'employesss', NULL, NULL, NULL, NULL, NULL),
	('2', 1, 'S.01 Modul', 'program/program_list', 'fa fa-setting', 'programs', NULL, NULL, NULL, NULL, NULL),
	('3', 1, 'S.02 Group', 'group/group_list', 'fa fa-group', 'group', NULL, NULL, NULL, NULL, NULL),
	('4', 1, 'S.01 Programs', 'programs/programs_list', 'fa fa-setting', 'programs', NULL, NULL, NULL, NULL, NULL),
	('5', 1, 'S.03 Users', 'user/user_list', 'fa fa-users', 'users', NULL, NULL, NULL, NULL, NULL),
	('5f27df801bbf1', 2, 'Program 2', 'Program', NULL, 'Program ', NULL, NULL, NULL, NULL, NULL),
	('5f280ee897279', 1, 'Master Onyon', 'dsad', NULL, 'dsad', NULL, NULL, NULL, NULL, NULL),
	('5f28124f2035d', 1, 'Programs', 'programs/programs_list', NULL, 'program', NULL, NULL, '2020-08-03 20:34:07', NULL, NULL),
	('5f2817520a6e6', 4, 'Gaji', 'Gaji Juga', NULL, 'dede', NULL, NULL, '2020-08-03 20:55:30', NULL, NULL),
	('5f28176c85026', 4, 'Tunjangan Jabatan', 'tunjangan', NULL, 'tunjangan', NULL, NULL, '2020-08-03 20:55:56', NULL, NULL),
	('5f28178b74548', 4, 'Tunjangan anak istri', '', NULL, '', NULL, NULL, '2020-08-03 20:56:27', NULL, NULL),
	('5f2904cb7f378', 2, 'oke', '', NULL, '', NULL, NULL, '2020-08-04 13:48:43', NULL, NULL),
	('5f29eb2448722', 5, '\'\'\'\'\'\'', '', NULL, '', NULL, NULL, '2020-08-05 06:11:32', NULL, NULL),
	('5f29eb3021769', 5, '\'\'\'\'\'\'', '', NULL, '', NULL, NULL, '2020-08-05 06:11:44', NULL, NULL),
	('5f29eb3428b33', 5, '\'\'\'\'\'\'', '', NULL, '', NULL, NULL, '2020-08-05 06:11:48', NULL, NULL),
	('5f29ec63bd826', 3, 'Absen', '', NULL, '', NULL, NULL, '2020-08-05 06:16:51', NULL, NULL),
	('5f29ed1615a69', 1, 'Coba Lagi', '', NULL, '', NULL, NULL, '2020-08-05 06:19:50', NULL, NULL),
	('5f29f2890231f', 1, '', '', NULL, '', NULL, NULL, '2020-08-05 06:43:05', NULL, NULL),
	('5f2a085983ada', 2, '', '', NULL, '', NULL, NULL, '2020-08-05 08:16:09', NULL, NULL),
	('5f2a29684a38d', 2, '', '', NULL, '', NULL, NULL, '2020-08-05 10:37:12', NULL, NULL),
	('5f2a299e85aff', 2, '', '', NULL, '', NULL, NULL, '2020-08-05 10:38:06', NULL, NULL),
	('5f2a29b087b9e', 2, '', '', NULL, '', NULL, NULL, '2020-08-05 10:38:24', NULL, NULL),
	('5f2a29c7a5da7', 2, '', '', NULL, '', NULL, NULL, '2020-08-05 10:38:47', NULL, NULL);
/*!40000 ALTER TABLE `master_program` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_region
CREATE TABLE IF NOT EXISTS `master_region` (
  `region_id` varchar(5) NOT NULL,
  `region_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_region: ~4 rows (approximately)
DELETE FROM `master_region`;
/*!40000 ALTER TABLE `master_region` DISABLE KEYS */;
INSERT INTO `master_region` (`region_id`, `region_name`) VALUES
	('R0001', 'Kantor Pusat H/O'),
	('R0002', 'Kantor Cabang Pembantu I'),
	('R0003', 'Kantor Cabang Pembantu II'),
	('R0004', 'Kantor Cabang Medan');
/*!40000 ALTER TABLE `master_region` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_role
CREATE TABLE IF NOT EXISTS `master_role` (
  `role_id` int(11) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_role: ~1 rows (approximately)
DELETE FROM `master_role`;
/*!40000 ALTER TABLE `master_role` DISABLE KEYS */;
INSERT INTO `master_role` (`role_id`, `role_name`) VALUES
	(1, 'superadmin');
/*!40000 ALTER TABLE `master_role` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_seq
CREATE TABLE IF NOT EXISTS `master_seq` (
  `seq_type` varchar(5) DEFAULT NULL,
  `seq_lastid` int(11) DEFAULT NULL,
  `seq_lastdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_seq: ~5 rows (approximately)
DELETE FROM `master_seq`;
/*!40000 ALTER TABLE `master_seq` DISABLE KEYS */;
INSERT INTO `master_seq` (`seq_type`, `seq_lastid`, `seq_lastdate`) VALUES
	('EP', 28, '2019-11-21 12:42:47'),
	('R', 0, '2019-11-21 15:49:05'),
	('J', 0, '2019-11-21 15:49:22'),
	('D', 0, '2019-11-21 15:50:10'),
	('G', 0, '2019-11-21 15:51:05');
/*!40000 ALTER TABLE `master_seq` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_spajak
CREATE TABLE IF NOT EXISTS `master_spajak` (
  `spajak_id` int(11) NOT NULL AUTO_INCREMENT,
  `spajak_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`spajak_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_spajak: ~8 rows (approximately)
DELETE FROM `master_spajak`;
/*!40000 ALTER TABLE `master_spajak` DISABLE KEYS */;
INSERT INTO `master_spajak` (`spajak_id`, `spajak_name`) VALUES
	(1, 'TK/ 0'),
	(2, 'TK/ 1'),
	(3, 'TK/ 2'),
	(4, 'TK/ 3'),
	(5, 'K/ 0'),
	(6, 'K/ 1'),
	(7, 'K/ 2'),
	(8, 'K/ 3');
/*!40000 ALTER TABLE `master_spajak` ENABLE KEYS */;

-- Dumping structure for table pr01_db.master_user
CREATE TABLE IF NOT EXISTS `master_user` (
  `user_id` varchar(50) NOT NULL DEFAULT uuid_short(),
  `username` varchar(50) DEFAULT NULL,
  `user_fullname` varchar(250) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pr01_db.master_user: ~1 rows (approximately)
DELETE FROM `master_user`;
/*!40000 ALTER TABLE `master_user` DISABLE KEYS */;
INSERT INTO `master_user` (`user_id`, `username`, `user_fullname`, `password`) VALUES
	('1', 'nacha', 'Abdul Nasrah', 'ac43724f16e9241d990427ab7c8f4228');
/*!40000 ALTER TABLE `master_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
