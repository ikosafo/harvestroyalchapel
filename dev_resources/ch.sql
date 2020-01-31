/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.21-log : Database - church_it
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`church_it` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `church_it`;

/*Table structure for table `attendance` */

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `datereported` datetime DEFAULT NULL,
  `service` int(12) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Table structure for table `branch` */

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `cell` */

DROP TABLE IF EXISTS `cell`;

CREATE TABLE `cell` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `cell_name` varchar(256) DEFAULT NULL,
  `cell_id` varchar(256) DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `children` */

DROP TABLE IF EXISTS `children`;

CREATE TABLE `children` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `childname` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Table structure for table `convert` */

DROP TABLE IF EXISTS `convert`;

CREATE TABLE `convert` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(256) DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `residence` varchar(256) DEFAULT NULL,
  `denomination` varchar(256) DEFAULT NULL,
  `hearing_about` varchar(250) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(256) DEFAULT NULL,
  `department_id` varchar(256) DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Table structure for table `document` */

DROP TABLE IF EXISTS `document`;

CREATE TABLE `document` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `document_title` varchar(256) DEFAULT NULL,
  `document_description` varchar(256) DEFAULT NULL,
  `document_id` varchar(256) DEFAULT NULL,
  `period_uploaded` datetime DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `document_files` */

DROP TABLE IF EXISTS `document_files`;

CREATE TABLE `document_files` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(256) DEFAULT NULL,
  `document_location` varchar(256) DEFAULT NULL,
  `document_size` varchar(256) DEFAULT NULL,
  `document_type` varchar(256) DEFAULT NULL,
  `document_id` varchar(256) DEFAULT NULL,
  `period_uploaded` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `f_contributions` */

DROP TABLE IF EXISTS `f_contributions`;

CREATE TABLE `f_contributions` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `purpose` varchar(256) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `f_firstfruit` */

DROP TABLE IF EXISTS `f_firstfruit`;

CREATE TABLE `f_firstfruit` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `year` varchar(250) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `f_mpcontributions` */

DROP TABLE IF EXISTS `f_mpcontributions`;

CREATE TABLE `f_mpcontributions` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `purpose` varchar(256) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `f_partners` */

DROP TABLE IF EXISTS `f_partners`;

CREATE TABLE `f_partners` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(256) DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `denomination` varchar(256) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `period` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `f_tithe` */

DROP TABLE IF EXISTS `f_tithe`;

CREATE TABLE `f_tithe` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `year_month` varchar(250) DEFAULT NULL,
  `week` varchar(200) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `payment_mode` varchar(250) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `f_welfare` */

DROP TABLE IF EXISTS `f_welfare`;

CREATE TABLE `f_welfare` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `year_month` varchar(250) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `logid` int(111) NOT NULL AUTO_INCREMENT,
  `message` text,
  `userid` int(11) DEFAULT NULL,
  `applicantid` varchar(256) DEFAULT NULL,
  `logdate` datetime DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `macaddress` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(255) DEFAULT NULL,
  `emailaddress` varchar(250) DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`logid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(256) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `othertitle` varchar(250) DEFAULT NULL,
  `surname` varchar(250) DEFAULT NULL,
  `firstname` varchar(250) DEFAULT NULL,
  `othername` varchar(250) DEFAULT NULL,
  `emailaddress` varchar(250) DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `alttelephone` varchar(250) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `nationality` varchar(250) DEFAULT NULL,
  `hometown` varchar(256) DEFAULT NULL,
  `residence` varchar(256) DEFAULT NULL,
  `housenumber` varchar(256) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `maritalstatus` varchar(250) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `branch` varchar(200) DEFAULT NULL,
  `educationallevel` varchar(250) DEFAULT NULL,
  `institutionattended` varchar(256) DEFAULT NULL,
  `qualification` varchar(256) DEFAULT NULL,
  `occupation` varchar(256) DEFAULT NULL,
  `workplace` varchar(256) DEFAULT NULL,
  `jobposition` varchar(256) DEFAULT NULL,
  `spousename` varchar(256) DEFAULT NULL,
  `fatheralive` varchar(200) DEFAULT NULL,
  `fathername` varchar(256) DEFAULT NULL,
  `motheralive` varchar(200) DEFAULT NULL,
  `mothername` varchar(256) DEFAULT NULL,
  `havechildren` varchar(200) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `ministry` varchar(250) DEFAULT NULL,
  `cell` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Table structure for table `member_images` */

DROP TABLE IF EXISTS `member_images`;

CREATE TABLE `member_images` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `memberid` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_location` varchar(255) DEFAULT NULL,
  `image_size` varchar(255) DEFAULT NULL,
  `image_type` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`memberid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `ministry` */

DROP TABLE IF EXISTS `ministry`;

CREATE TABLE `ministry` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `ministry_name` varchar(256) DEFAULT NULL,
  `ministry_id` varchar(256) DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `mnotify` */

DROP TABLE IF EXISTS `mnotify`;

CREATE TABLE `mnotify` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `mnotify_key` varchar(256) DEFAULT NULL,
  `key_id` varchar(256) DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `service` */

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(250) DEFAULT NULL,
  `start_period` datetime DEFAULT NULL,
  `end_period` datetime DEFAULT NULL,
  `service_period` varchar(250) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(256) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `branch` varchar(256) DEFAULT NULL,
  `usertype` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `users_admin` */

DROP TABLE IF EXISTS `users_admin`;

CREATE TABLE `users_admin` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(256) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `usertype` varchar(250) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `users_adminmain` */

DROP TABLE IF EXISTS `users_adminmain`;

CREATE TABLE `users_adminmain` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `users_login` */

DROP TABLE IF EXISTS `users_login`;

CREATE TABLE `users_login` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `email_address` varchar(250) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `branch` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `visitor` */

DROP TABLE IF EXISTS `visitor`;

CREATE TABLE `visitor` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(256) DEFAULT NULL,
  `telephone` varchar(250) DEFAULT NULL,
  `residence` varchar(256) DEFAULT NULL,
  `denomination` varchar(256) DEFAULT NULL,
  `hearing_about` varchar(250) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
