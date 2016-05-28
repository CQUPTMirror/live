/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50712
 Source Host           : localhost
 Source Database       : live

 Target Server Type    : MySQL
 Target Server Version : 50712
 File Encoding         : utf-8

 Date: 05/28/2016 15:42:19 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `room`
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `living_token` varchar(255) NOT NULL DEFAULT '',
  `room_cover` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '3' COMMENT '0ban 1normal 2living 3applying',
  `hot` int(11) NOT NULL DEFAULT '0',
  `care_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `uid` varchar(255) DEFAULT '' COMMENT '学号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
