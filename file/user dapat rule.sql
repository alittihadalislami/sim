/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.10-MariaDB : Database - alitt452_sim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `user_dapat_rule` */

DROP TABLE IF EXISTS `user_dapat_rule`;

CREATE TABLE `user_dapat_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `rule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

/*Data for the table `user_dapat_rule` */

insert  into `user_dapat_rule`(`id`,`user_id`,`rule_id`) values 
(1,18,5),
(2,20,1),
(3,24,5),
(4,25,5),
(5,28,3),
(6,29,5),
(7,31,8),
(8,32,5),
(9,36,5),
(10,37,8),
(11,38,5),
(12,39,8),
(13,41,5),
(14,42,8),
(15,44,5),
(16,45,5),
(17,46,5),
(18,47,3),
(19,48,5),
(20,49,8),
(21,50,5),
(22,51,5),
(23,52,8),
(24,53,8),
(25,54,5),
(26,57,5),
(27,58,5),
(28,59,8),
(29,60,5),
(30,61,8),
(31,62,8),
(32,63,5),
(33,64,5),
(34,65,5),
(35,66,5),
(36,68,5),
(37,69,8),
(38,70,8),
(39,72,8),
(40,73,5),
(41,74,8),
(42,75,8),
(43,76,8),
(44,77,8),
(45,78,8),
(46,79,8),
(47,80,8),
(48,81,8),
(49,82,8),
(50,83,8),
(51,84,8),
(52,85,8),
(53,86,8),
(54,87,8),
(55,88,8),
(56,89,8),
(57,90,8),
(58,91,8),
(59,92,8),
(60,93,8),
(61,94,8),
(62,95,8),
(63,96,9),
(64,97,8),
(65,98,8),
(66,99,8),
(67,100,10),
(68,101,8),
(69,102,8),
(70,103,5),
(128,74,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
