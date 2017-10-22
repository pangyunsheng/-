/*
Navicat MySQL Data Transfer

Source Server         : wamp集成包
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : dfz

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-10-22 15:57:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dfz_user
-- ----------------------------
DROP TABLE IF EXISTS `dfz_user`;
CREATE TABLE `dfz_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '手机号登录',
  `password` varchar(32) NOT NULL COMMENT '登录密码',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfz_user
-- ----------------------------
INSERT INTO `dfz_user` VALUES ('1', '15767976876', 'w8777777777');
INSERT INTO `dfz_user` VALUES ('9', '18397646259', 'w12345678');
INSERT INTO `dfz_user` VALUES ('10', '18877572859', 'asd123213');
