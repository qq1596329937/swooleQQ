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

 Date: 16/12/2019 15:07:44
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

-- ----------------------------
-- Records of record
-- ----------------------------
INSERT INTO `record` VALUES (50, 2, 1, 1576467214, '1');
INSERT INTO `record` VALUES (51, 1, 2, 1576467221, '你是？');
INSERT INTO `record` VALUES (52, 2, 1, 1576467224, '呦西');
INSERT INTO `record` VALUES (53, 3, 2, 1576467230, '哈喽');
INSERT INTO `record` VALUES (54, 2, 1, 1576467234, '八嘎');
INSERT INTO `record` VALUES (55, 2, 1, 1576467241, '啊哈哈');
INSERT INTO `record` VALUES (56, 1, 2, 1576467255, '11');
INSERT INTO `record` VALUES (57, 6, 7, 1576467518, '在吗');
INSERT INTO `record` VALUES (58, 7, 6, 1576467526, '在');
INSERT INTO `record` VALUES (59, 6, 7, 1576467530, '哦哦');
INSERT INTO `record` VALUES (60, 8, 5, 1576467569, '你是');
INSERT INTO `record` VALUES (61, 12, 11, 1576478031, '1');
INSERT INTO `record` VALUES (62, 11, 12, 1576478036, '2');
INSERT INTO `record` VALUES (63, 13, 11, 1576478053, '23');
INSERT INTO `record` VALUES (64, 13, 11, 1576478061, '2356');
INSERT INTO `record` VALUES (65, 11, 12, 1576478063, '213123');
INSERT INTO `record` VALUES (66, 13, 11, 1576478072, '900');
INSERT INTO `record` VALUES (67, 11, 12, 1576478077, '8989');
INSERT INTO `record` VALUES (68, 14, 11, 1576478203, '在？');
INSERT INTO `record` VALUES (69, 14, 13, 1576478208, '在？');
INSERT INTO `record` VALUES (70, 11, 12, 1576478256, 'ok');
INSERT INTO `record` VALUES (71, 11, 12, 1576478342, '99');
INSERT INTO `record` VALUES (72, 15, 14, 1576478397, '1');
INSERT INTO `record` VALUES (73, 14, 15, 1576478403, '1');
INSERT INTO `record` VALUES (74, 15, 14, 1576478405, '1');
INSERT INTO `record` VALUES (75, 14, 15, 1576478407, '1');
INSERT INTO `record` VALUES (76, 15, 14, 1576478427, '1');
INSERT INTO `record` VALUES (77, 15, 14, 1576478466, '11');

SET FOREIGN_KEY_CHECKS = 1;
