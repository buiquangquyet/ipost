# ************************************************************
# Sequel Pro SQL dump
# バージョン 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# ホスト: 127.0.0.1 (MySQL 5.1.73-log)
# データベース: ipost_saturn
# 作成時刻: 2015-02-23 10:12:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ dtb_basic_infos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_basic_infos`;

CREATE TABLE `dtb_basic_infos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '種類',
  `info` text NOT NULL COMMENT '内容がjsonで登録される',
  `lang` varchar(5) NOT NULL DEFAULT 'ja' COMMENT '言語',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_devices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_devices`;

CREATE TABLE `dtb_devices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL COMMENT 'どの管理者のIDのアプリIDか',
  `allow_flg` tinyint(4) NOT NULL COMMENT '0:PUSH非許可 1:PUSH許可',
  `device` tinyint(4) NOT NULL COMMENT '端末情報 1:iOS 2:Android',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT 'デバイストークン',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_images`;

CREATE TABLE `dtb_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime` varchar(50) NOT NULL,
  `file` longblob NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:有効 2:削除',
  `lang` varchar(5) NOT NULL DEFAULT 'ja',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_media`;

CREATE TABLE `dtb_media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '所有者ID',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT 'ファイルのフルパス',
  `file_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'ファイル名単体',
  `mime` varchar(50) NOT NULL DEFAULT '' COMMENT 'mime type',
  `file` longblob NOT NULL COMMENT '画面からアクセスするためのURL',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:有効 2:削除',
  `lang` varchar(5) NOT NULL DEFAULT 'jp',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_menu_configs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_menu_configs`;

CREATE TABLE `dtb_menu_configs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT 'クライアントID',
  `use_flg` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '利用：0:未利用/1:利用中',
  `mode` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'メニュー種別：0:未利用/1:シンプル/2:カテゴリ別',
  `updated_at` datetime NOT NULL COMMENT '最終更新日時',
  `created_at` datetime NOT NULL COMMENT '登録日時',
  PRIMARY KEY (`id`),
  KEY `index_client_id` (`user_id`),
  KEY `index_created_at` (`created_at`),
  KEY `multi_index1` (`id`,`user_id`),
  KEY `multi_index2` (`id`,`user_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_menu_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_menu_items`;

CREATE TABLE `dtb_menu_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'メニュー商品ID',
  `user_id` int(11) unsigned NOT NULL COMMENT 'クライアントID',
  `parent_id` int(10) unsigned NOT NULL COMMENT 'カテゴリーID (Pref:MENU_CATEGORY.id)',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'メニュー商品名',
  `sub_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'メニュー商品一覧説明',
  `description` text NOT NULL COMMENT 'メニュー商品説明',
  `url` text NOT NULL COMMENT 'URL(※予約カラム)',
  `file_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'ファイル種別(※予約カラム)',
  `file_name` varchar(255) NOT NULL DEFAULT '' COMMENT '画像ファイル名',
  `tmp_file_name` varchar(255) NOT NULL COMMENT '一時画像ファイル名',
  `price` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品価格：本体価格',
  `tax` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品価格：税',
  `position` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '表示順序',
  `enable` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '表示：0:非表示/1:表示',
  `updated_at` datetime NOT NULL COMMENT '最終更新日時',
  `created_at` datetime NOT NULL COMMENT '登録日時',
  PRIMARY KEY (`id`),
  KEY `index_client_id` (`user_id`),
  KEY `index_parent` (`parent_id`),
  KEY `index_position` (`position`),
  KEY `index_enable` (`enable`),
  KEY `multi_index1` (`user_id`,`parent_id`),
  KEY `multi_index2` (`user_id`,`position`),
  KEY `multi_index3` (`user_id`,`parent_id`,`enable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='メニュー：商品情報';



# テーブルのダンプ dtb_menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_menus`;

CREATE TABLE `dtb_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `image_id` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `info` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `lang` varchar(5) NOT NULL DEFAULT 'jp',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_news`;

CREATE TABLE `dtb_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'SEQ',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `title` varchar(11) NOT NULL DEFAULT '' COMMENT 'タイトル',
  `body` text NOT NULL COMMENT '本文',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '添付画像',
  `youtube` varchar(255) NOT NULL DEFAULT '' COMMENT '添付YoutubeURL',
  `notice` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'PUSHフラグ(0:しない / 1:する)',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '配信フラグ(0:未/1:済)',
  `noticed` datetime NOT NULL COMMENT '予約配信日時',
  `send` datetime NOT NULL COMMENT '配信日時',
  `lang` varchar(5) NOT NULL DEFAULT 'jp',
  `created` datetime NOT NULL COMMENT '登録日時',
  `modified` datetime NOT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_pushes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_pushes`;

CREATE TABLE `dtb_pushes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL COMMENT '管理者のID',
  `message` varchar(255) NOT NULL DEFAULT '' COMMENT 'メッセージ内容',
  `notify_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:準備完了 2:送信中 3:完了 9:例外',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_regist_requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_regist_requests`;

CREATE TABLE `dtb_regist_requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `hash` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_user_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_user_details`;

CREATE TABLE `dtb_user_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `company_name` varchar(255) NOT NULL DEFAULT '' COMMENT '会社名',
  `tel` varchar(12) NOT NULL DEFAULT '' COMMENT '電話番号',
  `fax` varchar(12) NOT NULL DEFAULT '' COMMENT 'FAX番号',
  `post_code` varchar(8) NOT NULL DEFAULT '' COMMENT '郵便番号',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '住所',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_user_relations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_user_relations`;

CREATE TABLE `dtb_user_relations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `parent_id` int(11) NOT NULL COMMENT '対象のユーザが所属するユーザ',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:有効 2:無効',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# テーブルのダンプ dtb_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dtb_users`;

CREATE TABLE `dtb_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1:通常ユーザ　2:子ユーザ',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT 'メールアドレス兼ログインID',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT 'SHA1とsaltで暗号化されたパスワード',
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'ユーザ名',
  `user_name_furi` varchar(255) NOT NULL DEFAULT '' COMMENT 'ユーザ名ふりがな',
  `last_login` datetime NOT NULL COMMENT '最終ログイン日付',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:仮登録 2:利用中 3:停止 9:削除',
  `created` datetime NOT NULL COMMENT '作成日',
  `modified` datetime NOT NULL COMMENT '更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dtb_users` WRITE;
/*!40000 ALTER TABLE `dtb_users` DISABLE KEYS */;

INSERT INTO `dtb_users` (`id`, `type`, `email`, `password`, `user_name`, `user_name_furi`, `last_login`, `status`, `created`, `modified`)
VALUES
	(1,0,'admin@hiropro.net','e81659431128bf0b5925cfd6f531696446877cac','テストユーザ','テストユーザ','2015-02-23 18:10:47',2,'0000-00-00 00:00:00','2015-02-23 18:10:47');

/*!40000 ALTER TABLE `dtb_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
