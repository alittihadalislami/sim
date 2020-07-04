/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.10-MariaDB : Database - alitt452_sim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `m_kelas` */

DROP TABLE IF EXISTS `m_kelas`;

CREATE TABLE `m_kelas` (
  `id_kelas` int(4) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(4) DEFAULT NULL,
  `kelas_alias` varchar(12) DEFAULT NULL,
  `rombel` int(2) DEFAULT NULL,
  `jenjang` int(4) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `m_kelas` */

insert  into `m_kelas`(`id_kelas`,`nama_kelas`,`kelas_alias`,`rombel`,`jenjang`,`active`) values 
(1,'1B','VII-B',1,1,1),
(2,'2B','VIII-B',2,1,1),
(3,'2C','VIII-C',2,1,1),
(4,'3B','IX-B',3,1,1),
(5,'3C','IX-C',3,1,0),
(6,'4A','X-A',4,2,1),
(7,'4B','X-B',4,2,1),
(8,'4C','X-C',4,2,1),
(9,'5A','XI-A',5,2,1),
(10,'5B','XI-B',5,2,1),
(11,'5C','XI-C',5,2,1),
(12,'6A','XII-A',6,2,1),
(13,'6B','XII-B',6,2,1),
(14,'1A','VII-A',1,1,1),
(15,'2A','VIII-A',2,1,1),
(16,'3A','IX-A',3,1,1),
(17,'7A','TAKHASUS-A',7,3,1),
(18,'7B','TAKHASUS-B',7,3,1),
(19,'0','Tidak Punya ',0,0,0),
(20,'8','Lulus',8,8,0),
(21,'9','Keluar',9,9,0),
(22,'1C','VII-C',1,1,1),
(23,'1D','VII-D',1,1,0),
(24,'6C','XII-C',6,2,1),
(25,'2D','VIII-D',2,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
