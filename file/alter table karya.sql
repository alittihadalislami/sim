/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.10-MariaDB : Database - sim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sim` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sim`;

/*Table structure for table `t_karya` */

DROP TABLE IF EXISTS `t_karya`;

CREATE TABLE `t_karya` (
  `santri_id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_tematik` int(11) DEFAULT NULL,
  `nilai_penelitian` int(11) DEFAULT NULL,
  `judul_tematik` longtext DEFAULT NULL,
  `judul_penelitian` longtext DEFAULT NULL,
  `nilai_karya` int(11) DEFAULT NULL,
  `tahun_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`santri_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_karya` */

insert  into `t_karya`(`santri_id`,`nilai_tematik`,`nilai_penelitian`,`judul_tematik`,`judul_penelitian`,`nilai_karya`,`tahun_id`) values 
(57,11,11,'','',11,3),
(58,90,90,'','',90,3),
(59,87,87,'','',87,3),
(61,NULL,NULL,'','',NULL,3),
(62,NULL,NULL,'','',NULL,3),
(63,NULL,NULL,'','',NULL,3),
(64,NULL,NULL,'','',NULL,3),
(65,NULL,NULL,'','',NULL,3),
(66,NULL,NULL,'','',NULL,3),
(67,NULL,NULL,'','',NULL,3),
(68,NULL,NULL,'','',NULL,3),
(69,NULL,NULL,'','',NULL,3),
(70,NULL,NULL,'','',NULL,3),
(72,NULL,NULL,'','',NULL,3),
(73,NULL,NULL,'','',NULL,3),
(74,NULL,NULL,'','',NULL,3),
(75,NULL,NULL,'','',NULL,3),
(76,NULL,NULL,'','',NULL,3),
(77,NULL,NULL,'','',NULL,3),
(78,NULL,NULL,'','',NULL,3),
(79,NULL,NULL,'','',NULL,3),
(80,NULL,NULL,'','',NULL,3),
(81,NULL,NULL,'','',NULL,3),
(82,NULL,NULL,'','',NULL,3),
(83,NULL,NULL,'','',NULL,3),
(86,NULL,NULL,'','',NULL,3),
(87,NULL,NULL,'','',NULL,3),
(89,NULL,NULL,'','',NULL,3),
(91,NULL,NULL,'','',NULL,3),
(92,NULL,NULL,'','',NULL,3),
(93,NULL,NULL,'','',NULL,3),
(94,NULL,NULL,'','',NULL,3),
(95,NULL,NULL,'','',NULL,3),
(96,NULL,NULL,'','',NULL,3),
(97,NULL,NULL,'','',NULL,3),
(98,NULL,NULL,'','',NULL,3),
(99,NULL,NULL,'','',NULL,3),
(100,NULL,NULL,'','',NULL,3),
(101,NULL,NULL,'','',NULL,3),
(102,NULL,NULL,'','',NULL,3),
(103,NULL,NULL,'','',NULL,3),
(104,NULL,NULL,'','',NULL,3),
(105,NULL,NULL,'','',NULL,3),
(106,NULL,NULL,'','',NULL,3),
(107,NULL,NULL,'','',NULL,3),
(108,NULL,NULL,'','',NULL,3),
(109,NULL,NULL,'','',NULL,3),
(110,NULL,NULL,'','',NULL,3),
(111,NULL,NULL,'','',NULL,3),
(112,NULL,NULL,'','',NULL,3),
(113,NULL,NULL,'','',NULL,3),
(114,NULL,NULL,'','',NULL,3),
(115,NULL,NULL,'','',NULL,3),
(116,NULL,NULL,'','',NULL,3),
(117,NULL,NULL,'','',NULL,3),
(118,NULL,NULL,'','',NULL,3),
(119,NULL,NULL,'','',NULL,3),
(120,NULL,NULL,'','',NULL,3),
(121,NULL,NULL,'','',NULL,3),
(122,NULL,NULL,'','',NULL,3),
(123,NULL,NULL,'','',NULL,3),
(124,NULL,NULL,'','',NULL,3),
(125,NULL,NULL,'','',NULL,3),
(126,NULL,NULL,'','',NULL,3),
(128,NULL,NULL,'','',NULL,3),
(129,NULL,NULL,'','',NULL,3),
(130,NULL,NULL,'','',NULL,3),
(131,NULL,NULL,'','',NULL,3),
(132,NULL,NULL,'','',NULL,3),
(133,NULL,NULL,'','',NULL,3),
(134,NULL,NULL,'','',NULL,3),
(135,NULL,NULL,'','',NULL,3),
(136,NULL,NULL,'','',NULL,3),
(137,NULL,NULL,'','',NULL,3),
(138,NULL,NULL,'','',NULL,3),
(139,100,100,'','',100,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
