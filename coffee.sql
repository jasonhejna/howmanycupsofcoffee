/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : coffee

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2013-12-18 23:11:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cups`
-- ----------------------------
DROP TABLE IF EXISTS `cups`;
CREATE TABLE `cups` (
  `cupnumber` int(7) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`cupnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cups
-- ----------------------------
