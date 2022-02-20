/*
SQLyog Community v13.1.8 (64 bit)
MySQL - 5.7.26 : Database - webtest
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'post ID',
  `title` text COLLATE utf8_unicode_ci,
  `category` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `author` int(11) NOT NULL COMMENT 'linked to userid',
  `mainpost` int(11) unsigned zerofill DEFAULT NULL COMMENT 'if not 0 then belongs to a post',
  `hide` tinyint(1) unsigned zerofill DEFAULT NULL COMMENT 'visible or not',
  PRIMARY KEY (`pid`),
  KEY `author` (`author`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `post` */

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'report ID',
  `pid` int(11) NOT NULL COMMENT 'reported post ID',
  `userid` int(11) NOT NULL COMMENT 'user who report',
  `comment` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'reason',
  PRIMARY KEY (`reportid`),
  KEY `pid` (`pid`),
  KEY `userid` (`userid`),
  CONSTRAINT `report_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`),
  CONSTRAINT `report_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `report` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `permission` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`userid`,`username`,`password`,`bio`,`permission`) values 
(1,'admin','$2y$10$XirbpwFpgc5fVRUkTqhYnuqPBGI3i5Ie7Jm8nJRNfptGd/Qg9p4FS',NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
