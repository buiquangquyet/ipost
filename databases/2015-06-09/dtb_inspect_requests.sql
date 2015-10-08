/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : saturn_back

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-05-17 18:57:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dtb_inspect_requests`
-- ----------------------------
DROP TABLE IF EXISTS `dtb_inspect_requests`;
CREATE TABLE `dtb_inspect_requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'SEQ',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ユーザーID',
  `agent_result` tinyint(4) unsigned DEFAULT NULL COMMENT '代理店審査結果(0:NG/1:OK)',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '申請状況（Config/ipost.php）',
  `master_result` tinyint(4) unsigned DEFAULT NULL COMMENT '審査結果(0:NG/1:OK)',
  `master_id` int(11) unsigned DEFAULT NULL COMMENT '審査官',
  `android_released` datetime NOT NULL COMMENT 'アンドロイドリリース日時',
  `ios_released` datetime NOT NULL COMMENT 'iOSリリース日時',
  `created` datetime NOT NULL COMMENT '登録日時',
  `modified` datetime NOT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='アプリの申請状況 ※ステータス状態のマスターは、コンフィグファイルipost.phpに記載';

-- ----------------------------
-- Records of dtb_inspect_requests
-- ----------------------------
