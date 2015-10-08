

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `dtb_menu_items`
-- ----------------------------
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
  `image_id` varchar(255) NOT NULL DEFAULT '' COMMENT '画像ファイル名',
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
