/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 11.3.2-MariaDB-log : Database - alitt452_sim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`alitt452_sim` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;

USE `alitt452_sim`;

/*Table structure for table `t_lembaga` */

DROP TABLE IF EXISTS `t_lembaga`;

CREATE TABLE `t_lembaga` (
  `id_lembaga` varchar(512) DEFAULT NULL,
  `lembaga` varchar(512) DEFAULT NULL,
  `kepala` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `t_lembaga` */

insert  into `t_lembaga`(`id_lembaga`,`lembaga`,`kepala`) values 
('1','Ma\'had Al Ittihad Al Islami','mudir'),
('2','MA Al Ittihad Al Islami','kamad'),
('3','SMPS Al - Ittihad Camplong','kasek');

/*Table structure for table `t_penugasan` */

DROP TABLE IF EXISTS `t_penugasan`;

CREATE TABLE `t_penugasan` (
  `id_penugasan` int(11) DEFAULT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `lembaga_id` int(11) DEFAULT NULL,
  `niy` int(11) DEFAULT NULL,
  `no_surat` varchar(512) DEFAULT NULL,
  `status` varchar(512) DEFAULT NULL,
  `tgl_ditetapkan` varchar(512) DEFAULT NULL,
  `tahun` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `t_penugasan` */

insert  into `t_penugasan`(`id_penugasan`,`tugas_id`,`lembaga_id`,`niy`,`no_surat`,`status`,`tgl_ditetapkan`,`tahun`) values 
(1,2,1,940613004,'003/YPAA/KEP/MII/VII/2023','tidak tetap','15 Juli 1992','2023-2024'),
(2,2,1,940613008,'004/YPAA/KEP/MII/VII/2023','tetap','12 Agustus 1994','2023-2024'),
(3,2,1,940613010,'005/YPAA/KEP/MII/VII/2023','tetap','1 Juli 1994','2023-2024'),
(4,2,1,940613016,'006/YPAA/KEP/MII/VII/2023','tetap','12 Desember 1996','2023-2024'),
(5,2,1,940613036,'007/YPAA/KEP/MII/VII/2023','tidak tetap','15 April 2003','2023-2024'),
(6,2,1,940613040,'008/YPAA/KEP/MII/VII/2023','tidak tetap','01 Agustus 2005','2023-2024'),
(7,2,1,940613126,'009/YPAA/KEP/MII/VII/2023','tidak tetap','11 Juli 2019','2023-2024'),
(8,2,1,940613127,'010/YPAA/KEP/MII/VII/2023','tidak tetap','11 Juli 2019','2023-2024'),
(9,2,1,940613133,'011/YPAA/KEP/MII/VII/2023','tidak tetap','15 Juli 2020','2023-2024'),
(10,2,1,940613148,'012/YPAA/KEP/MII/VII/2023','tidak tetap','15 Juli 2023','2023-2024'),
(11,3,1,940613152,'013/YPAA/KEP/MII/VII/2023','tetap','15 Juli 2017','2023-2024'),
(12,2,2,940613009,'014/YPAA/KEP/MA/VII/2023','tetap','03 April 1994','2023-2024'),
(13,2,2,940613011,'015/YPAA/KEP/MA/VII/2023','tidak tetap','12 Agustus 1994','2023-2024'),
(14,2,2,940613015,'016/YPAA/KEP/MA/VII/2023','tetap','1 Juli 1996','2023-2024'),
(15,2,2,940613017,'017/YPAA/KEP/MA/VII/2023','tidak tetap','17 Juli 1994','2023-2024'),
(16,3,2,940613018,'018/YPAA/KEP/MA/VII/2023','tetap','16 Mei 1997','2023-2024'),
(17,2,2,940613035,'019/YPAA/KEP/MA/VII/2023','tetap','15 Juli 2001','2023-2024'),
(18,2,2,940613045,'020/YPAA/KEP/MA/VII/2023','tetap','11 Juli 2019','2023-2024'),
(19,2,2,940613051,'021/YPAA/KEP/MA/VII/2023','tidak tetap','2 Juli 2012','2023-2024'),
(20,2,2,940613056,'022/YPAA/KEP/MA/VII/2023','tetap','17 Juli 2009','2023-2024'),
(21,2,2,940613059,'023/YPAA/KEP/MA/VII/2023','tidak tetap','20 Juli 2005','2023-2024'),
(22,2,2,940613072,'024/YPAA/KEP/MA/VII/2023','tetap','1 Juli 2009','2023-2024'),
(23,2,2,940613074,'025/YPAA/KEP/MA/VII/2023','tetap','1 Juli 2009','2023-2024'),
(24,2,2,940613076,'026/YPAA/KEP/MA/VII/2023','tidak tetap','17 Juli 2010','2023-2024'),
(25,2,2,940613078,'027/YPAA/KEP/MA/VII/2023','tetap','1 Juli 2009','2023-2024'),
(26,2,2,940613080,'028/YPAA/KEP/MA/VII/2023','tidak tetap','14 Juli 2010','2023-2024'),
(27,3,2,940613081,'029/YPAA/KEP/MA/VII/2023','tidak tetap','17 Juli 2010','2023-2024'),
(28,2,2,940613086,'030/YPAA/KEP/MA/VII/2023','tidak tetap','14 Juli 2010','2023-2024'),
(29,2,2,940613087,'031/YPAA/KEP/MA/VII/2023','tetap','2 Juli 2012','2023-2024'),
(30,2,2,940613095,'032/YPAA/KEP/MA/VII/2023','tidak tetap','17 Juli 2014','2023-2024'),
(31,2,2,940613096,'033/YPAA/KEP/MA/VII/2023','tidak tetap','15 September 2014','2023-2024'),
(32,2,2,940613097,'034/YPAA/KEP/MA/VII/2023','tidak tetap','16 Agustus 2014','2023-2024'),
(33,2,2,940613102,'035/YPAA/KEP/MA/VII/2023','tidak tetap','27 Juli 2015','2023-2024'),
(34,2,2,940613104,'036/YPAA/KEP/MA/VII/2023','tidak tetap','17 Juli 2016','2023-2024'),
(35,2,2,940613113,'037/YPAA/KEP/MA/VII/2023','tidak tetap','03 September 2017','2023-2024'),
(36,2,2,940613117,'038/YPAA/KEP/MA/VII/2023','tidak tetap','12 Juli 2018','2023-2024'),
(37,2,2,940613120,'039/YPAA/KEP/MA/VII/2023','tidak tetap','12 Juli 2018','2023-2024'),
(38,3,2,940613131,'040/YPAA/KEP/MA/VII/2023','tidak tetap','17 Juli 2019','2023-2024'),
(39,2,2,940613136,'041/YPAA/KEP/MA/VII/2023','tidak tetap','15 Juli 2020','2023-2024'),
(40,3,2,940613137,'042/YPAA/KEP/MA/VII/2023','tetap','8 Pebruari 2020','2023-2024'),
(41,3,2,940613138,'043/YPAA/KEP/MA/VII/2023','tetap','10 Maret 2021','2023-2024'),
(42,2,2,940613139,'044/YPAA/KEP/MA/VII/2023','tidak tetap','10 Juli 2021','2023-2024'),
(43,2,2,940613140,'045/YPAA/KEP/MA/VII/2023','tidak tetap','01 Juli 2021','2023-2024'),
(44,2,2,940613144,'046/YPAA/KEP/MA/VII/2023','tidak tetap','16 Juli 2022','2023-2024'),
(45,2,2,940613149,'047/YPAA/KEP/MA/VII/2023','tidak tetap','15 Juli 2023','2023-2024'),
(46,2,2,940613150,'048/YPAA/KEP/MA/VII/2023','tidak tetap','15 Juli 2023','2023-2024'),
(47,3,2,940613153,'049/YPAA/KEP/MA/VII/2023','tidak tetap','1 Agustus 2019','2023-2024'),
(48,3,2,940613107,'050/YPAA/KEP/MA/VII/2023','tidak tetap','12 Juli 2014','2023-2024'),
(49,3,3,940613018,'051/YPAA/KEP/SMP/VII/2023','tetap','17 Juli 2003','2023-2024'),
(50,2,3,940613019,'052/YPAA/KEP/SMP/VII/2023','tidak tetap','17 Juli 1997','2023-2024'),
(51,2,3,940613020,'053/YPAA/KEP/SMP/VII/2023','tetap','15 Juli 2004','2023-2024'),
(52,2,3,940613046,'054/YPAA/KEP/SMP/VII/2023','tetap','15 Juli 2004','2023-2024'),
(53,2,3,940613051,'055/YPAA/KEP/SMP/VII/2023','tetap','22 Juli 2005','2023-2024'),
(54,2,3,940613052,'056/YPAA/KEP/SMP/VII/2023','tidak tetap','15 Juli 2007','2023-2024'),
(55,2,3,940613066,'057/YPAA/KEP/SMP/VII/2023','tidak tetap','12 Juli 2012','2023-2024'),
(56,2,3,940613070,'058/YPAA/KEP/SMP/VII/2023','tetap','15 Juli 2013','2023-2024'),
(57,2,3,940613076,'059/YPAA/KEP/SMP/VII/2023','tidak tetap','17 Juli 2010','2023-2024'),
(58,3,3,940613081,'060/YPAA/KEP/SMP/VII/2023','tetap','17 Juli 2010','2023-2024'),
(59,2,3,940613085,'061/YPAA/KEP/SMP/VII/2023','tetap','15 Juli 2011','2023-2024'),
(60,2,3,940613089,'062/YPAA/KEP/SMP/VII/2023','tetap','27 Juli 2015','2023-2024'),
(61,2,3,940613090,'063/YPAA/KEP/SMP/VII/2023','tidak tetap','10 Oktober 2012','2023-2024'),
(62,2,3,940613097,'064/YPAA/KEP/SMP/VII/2023','tidak tetap','16 Agustus 2014','2023-2024'),
(63,2,3,940613102,'065/YPAA/KEP/SMP/VII/2023','tetap','27 Juli 2015','2023-2024'),
(64,2,3,940613107,'066/YPAA/KEP/SMP/VII/2023','tidak tetap','10 Juli 2021','2023-2024'),
(65,2,3,940613111,'067/YPAA/KEP/SMP/VII/2023','tidak tetap','23 Juli 2016','2023-2024'),
(66,2,3,940613113,'068/YPAA/KEP/SMP/VII/2023','tetap','03 September 2017','2023-2024'),
(67,2,3,940613117,'069/YPAA/KEP/SMP/VII/2023','tidak tetap','12 Juli 2018','2023-2024'),
(68,2,3,940613118,'070/YPAA/KEP/SMP/VII/2023','tetap','12 Juli 2018','2023-2024'),
(69,2,3,940613119,'071/YPAA/KEP/SMP/VII/2023','tidak tetap','12 Juli 2018','2023-2024'),
(70,2,3,940613121,'072/YPAA/KEP/SMP/VII/2023','tetap','12 Januari 2019','2023-2024'),
(71,2,3,940613122,'073/YPAA/KEP/SMP/VII/2023','tidak tetap','11 Juli 2019','2023-2024'),
(72,2,3,940613124,'074/YPAA/KEP/SMP/VII/2023','tetap','11 Juli 2019','2023-2024'),
(73,3,3,940613131,'075/YPAA/KEP/SMP/VII/2023','tidak tetap','17 Juli 2019','2023-2024'),
(74,2,3,940613135,'076/YPAA/KEP/SMP/VII/2023','tidak tetap','13 Juli 2020','2023-2024'),
(75,3,3,940613137,'077/YPAA/KEP/SMP/VII/2023','tetap','8 Pebruari 2020','2023-2024'),
(76,3,3,940613138,'078/YPAA/KEP/SMP/VII/2023','tetap','10 Maret 2021','2023-2024'),
(77,2,3,940613139,'079/YPAA/KEP/SMP/VII/2023','tidak tetap','10 Juli 2021','2023-2024'),
(78,2,3,940613141,'080/YPAA/KEP/SMP/VII/2023','tidak tetap','10 Juli 2021','2023-2024'),
(79,2,3,940613142,'081/YPAA/KEP/SMP/VII/2023','tidak tetap','10 Juli 2021','2023-2024'),
(80,2,3,940613143,'082/YPAA/KEP/SMP/VII/2023','tidak tetap','10 Juli 2021','2023-2024'),
(81,2,3,940613145,'083/YPAA/KEP/SMP/VII/2023','tidak tetap','16 Juli 2022','2023-2024'),
(82,2,3,940613146,'084/YPAA/KEP/SMP/VII/2023','tidak tetap','16 Juli 2022','2023-2024'),
(83,2,3,940613147,'085/YPAA/KEP/SMP/VII/2023','tidak tetap','16 Juli 2022','2023-2024'),
(84,2,3,940613151,'086/YPAA/KEP/SMP/VII/2023','tidak tetap','15 Juli 2023','2023-2024');

/*Table structure for table `t_tugas` */

DROP TABLE IF EXISTS `t_tugas`;

CREATE TABLE `t_tugas` (
  `id_tugas` varchar(512) DEFAULT NULL,
  `tugas` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `t_tugas` */

insert  into `t_tugas`(`id_tugas`,`tugas`) values 
('1','kepala'),
('2','guru'),
('3','pegawai');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
