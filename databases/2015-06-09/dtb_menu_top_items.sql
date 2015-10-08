
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `dtb_menu_top_items`
-- ----------------------------
DROP TABLE IF EXISTS `dtb_menu_top_items`;
CREATE TABLE `dtb_menu_top_items` (
  `user_id` int(11) unsigned NOT NULL COMMENT 'クライアントID',
  `image_id` varchar(255) NOT NULL DEFAULT '' COMMENT '画像ファイル名',
  `updated_at` datetime NOT NULL COMMENT '最終更新日時',
  `created_at` datetime NOT NULL COMMENT '登録日時',
  PRIMARY KEY (`user_id`),
  KEY `index_client_id` (`user_id`),
  KEY `multi_index1` (`user_id`),
  KEY `multi_index2` (`user_id`),
  KEY `multi_index3` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='メニュー：商品情報';