# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.22)
# Database: saturn_dev
# Generation Time: 2015-06-20 05:40:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table dtb_lang_maps
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_lang_maps`;

CREATE TABLE `dtb_lang_maps` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'SEQ',
  `lang_before` varchar(10) NOT NULL COMMENT '言語',
  `lang_after` varchar(10) NOT NULL DEFAULT '' COMMENT '対応言語',
  `created` datetime NOT NULL COMMENT '登録日時',
  `modified` datetime NOT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='言語マップ';

LOCK TABLES `dtb_lang_maps` WRITE;
/*!40000 ALTER TABLE `dtb_lang_maps` DISABLE KEYS */;

INSERT INTO `dtb_lang_maps` (`id`, `lang_before`, `lang_after`, `created`, `modified`)
VALUES
	(3,'jpn','ja','2015-06-20 14:21:56','2015-06-20 14:21:56'),
	(4,'eng','en','2015-06-20 14:22:57','2015-06-20 14:30:11'),
	(6,'en','en','2015-06-20 14:30:53','2015-06-20 14:30:53'),
	(7,'jp','ja','2015-06-20 14:31:12','2015-06-20 14:31:19'),
	(8,'en-us','en','2015-06-20 14:39:14','2015-06-20 14:39:14'),
	(9,'vi','vi','2015-06-20 14:39:27','2015-06-20 14:39:27'),
	(10,'vn','vi','2015-06-20 14:39:33','2015-06-20 14:39:33'),
	(11,'zh','zh','2015-06-20 14:39:39','2015-06-20 14:39:39'),
	(12,'hk','zh','2015-06-20 14:39:44','2015-06-20 14:39:44');

/*!40000 ALTER TABLE `dtb_lang_maps` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
