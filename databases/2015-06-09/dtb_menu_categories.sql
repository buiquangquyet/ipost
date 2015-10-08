DROP TABLE IF EXISTS `dtb_menu_categories`;
CREATE TABLE `dtb_menu_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'カテゴリーID',
  `user_id` int(11) unsigned NOT NULL COMMENT 'クライアントID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'カテゴリ名',
  `sub_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'カテゴリ説明',
  `image_id` varchar(255) NOT NULL COMMENT '画像ファイル名',
  `position` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '表示順序',
  `enable` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '表示：0:非表示/1:表示',
  `updated_at` datetime NOT NULL COMMENT '最終更新日時',
  `created_at` datetime NOT NULL COMMENT '登録日時',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_enable` (`enable`),
  KEY `multi_index1` (`user_id`,`enable`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='メニュー：カテゴリ情報';