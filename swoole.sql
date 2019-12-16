/*
 Navicat Premium Data Transfer

 Source Server         : 自己的腾讯云
 Source Server Type    : MySQL
 Source Server Version : 50644
 Source Host           : 119.29.37.25:3306
 Source Schema         : swoole

 Target Server Type    : MySQL
 Target Server Version : 50644
 File Encoding         : 65001

 Date: 16/12/2019 15:21:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `send_id` int(11) NOT NULL COMMENT '发送者id',
  `receiver_id` int(11) NOT NULL COMMENT '接收者ID',
  `time` int(11) NOT NULL COMMENT '发送时间',
  `msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
