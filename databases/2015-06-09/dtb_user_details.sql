# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.22)
# Database: saturn_dev
# Generation Time: 2015-03-02 06:02:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table dtb_user_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_user_details`;

CREATE TABLE `dtb_user_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'SEQ',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `company_name` varchar(255) NOT NULL DEFAULT '' COMMENT '会社名',
  `tel1` varchar(4) NOT NULL DEFAULT '' COMMENT '電話番号（市外局番）',
  `tel2` varchar(4) NOT NULL DEFAULT '' COMMENT '電話番号（上4桁）',
  `tel3` varchar(4) NOT NULL DEFAULT '' COMMENT '電話番号（下4桁）',
  `fax1` varchar(4) NOT NULL DEFAULT '' COMMENT 'FAX番号（市外局番）',
  `fax2` varchar(4) NOT NULL DEFAULT '' COMMENT 'FAX番号（上4桁）',
  `fax3` varchar(4) NOT NULL DEFAULT '' COMMENT 'FAX番号（下4桁）',
  `mobile_tel1` varchar(4) NOT NULL DEFAULT '' COMMENT '携帯番号（市外局番）',
  `mobile_tel2` varchar(4) NOT NULL DEFAULT '' COMMENT '携帯番号（上4桁）',
  `mobile_tel3` varchar(4) NOT NULL DEFAULT '' COMMENT '携帯番号（下4桁）',
  `zip_code1` varchar(3) NOT NULL DEFAULT '' COMMENT '郵便番号（上3桁）',
  `zip_code2` varchar(4) NOT NULL DEFAULT '' COMMENT '郵便番号（下4桁）',
  `country` varchar(4) NOT NULL DEFAULT '',
  `pref` varchar(255) NOT NULL DEFAULT '' COMMENT '都道府県',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT '市区町村',
  `address_opt1` varchar(255) NOT NULL DEFAULT '' COMMENT '住所（番地）',
  `address_opt2` varchar(255) NOT NULL DEFAULT '' COMMENT '住所（建物）',
  `remarks_agent` text NOT NULL COMMENT '備考欄（代理店用）',
  `remarks_manager` text COMMENT '備考欄（マスター用）',
  `created` datetime NOT NULL COMMENT '登録日時',
  `modified` datetime NOT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザー詳細情報';

LOCK TABLES `dtb_user_details` WRITE;
/*!40000 ALTER TABLE `dtb_user_details` DISABLE KEYS */;

INSERT INTO `dtb_user_details` (`id`, `user_id`, `company_name`, `tel1`, `tel2`, `tel3`, `fax1`, `fax2`, `fax3`, `mobile_tel1`, `mobile_tel2`, `mobile_tel3`, `zip_code1`, `zip_code2`, `country`, `pref`, `city`, `address_opt1`, `address_opt2`, `remarks_agent`, `remarks_manager`, `created`, `modified`)
VALUES
	(1,66,'北川屋','086','212','0077','086','212','0066','','','','','','','33','','','','',NULL,'2015-02-17 13:46:40','2015-02-17 13:46:40'),
	(5,14,'てすとだぉ','086','212','0077','','','','','','','709','0614','','33','','','','',NULL,'2015-02-18 13:46:16','2015-02-18 13:46:16'),
	(9,67,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 17:40:06','2015-02-18 17:40:06'),
	(11,63,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 18:45:04','2015-02-18 18:45:04'),
	(18,80,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 19:10:57','2015-02-18 19:10:57'),
	(19,81,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 19:12:38','2015-02-18 19:12:38'),
	(20,82,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 19:14:14','2015-02-18 19:14:14'),
	(21,83,'北川屋','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 19:14:41','2015-02-18 19:14:41'),
	(22,85,'テスト代理店','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 20:08:15','2015-02-18 20:08:15'),
	(23,87,'会社名','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 20:11:56','2015-02-18 20:11:56'),
	(24,88,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 20:12:34','2015-02-18 20:12:34'),
	(25,44,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 21:14:53','2015-02-18 21:14:53'),
	(26,36,'','','','','','','','','','','','','','0','','','','',NULL,'2015-02-18 21:50:13','2015-02-18 21:50:13'),
	(27,90,'','','','','','','','','','','','','','','','','','',NULL,'2015-02-18 23:04:39','2015-02-18 23:04:39'),
	(28,91,'','','','','','','','','','','','','','','','','','',NULL,'2015-02-19 14:33:44','2015-02-19 14:33:44'),
	(29,92,'','','','','','','','','','','','','','','','','','',NULL,'2015-03-02 14:27:24','2015-03-02 14:27:24'),
	(30,93,'','','','','','','','','','','','','','','','','','',NULL,'2015-03-02 14:28:10','2015-03-02 14:28:10');

/*!40000 ALTER TABLE `dtb_user_details` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
