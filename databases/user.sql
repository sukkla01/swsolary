/*
Navicat MySQL Data Transfer

Source Server         : Khirimat_hos
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : dbslip

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2015-05-18 09:32:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `create_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `ban_time` timestamp NULL DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cid` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '1', '1', 'neo@neo.com', null, 'neo', '$2y$13$dyVw4WkZGkABf2UrGWrhHO4ZmVBv.K4puhOL59Y9jQhIdj63TlV.O', 'TH2AUKuy5x4e6twJxkwbWYrauXYft1qA', 'hUUWHtFrlikN86zmPP01Df6QQXcVbnXL', '::1', '2015-05-18 01:09:08', null, '2015-03-11 10:44:30', null, null, null, '1111111111111');
INSERT INTO `user` VALUES ('2', '1', '1', 'sukkla01@gmail.com', null, 'sukkla01', '$2y$13$eNVKCkDjNi6n.dijZJDY9OuvhIwyrl4P9.Y7XkmEkQqM/8HGwaF4e', 'eXj01t0LNy_qeUMQJ1WOHbItywirjNDS', 'Q0Ay_gAC8JwmAN22P8YkjvdrlAu3H23b', '::1', '2015-05-18 08:49:49', '::1', '2015-03-11 11:09:21', '2015-05-03 16:17:49', null, null, '2222222222222');
INSERT INTO `user` VALUES ('8', '1', '1', 'kchatsut@gmail.com', null, '3600200280880', '$2y$13$wn6P4g7wlp7USRpd9rXrveLIV6m9O1oHkoytEDU.qq0MvamhbcLUK', null, null, '180.183.178.5', '2015-05-05 15:27:55', null, '2015-05-03 16:42:47', null, null, null, null);
INSERT INTO `user` VALUES ('9', '2', '1', 'pok@gmail.com', null, '3640600003875', '$2y$13$tSaCj8ZyWS1eQNsdvvybluDM0hEgeM0alibczs41VKcud5WJBrFbu', null, null, '::1', '2015-05-15 22:58:47', null, '2015-05-03 16:52:22', null, null, null, null);
INSERT INTO `user` VALUES ('10', '2', '1', 'dd@test.com', null, 'testrrrrr', '$2y$13$vTVgkcoodlhfg/Y4BpODTu2G.YUtSZfTbjrjC/fk97g4SPeWDHc6C', null, null, '::1', '2015-05-15 23:25:49', null, null, null, null, null, null);
INSERT INTO `user` VALUES ('11', '2', '1', '3669800188192@test.com', null, '3669800188192', '$2y$13$zciR5pL9leK9ukfRm.0HAudCZvhi946g/DZJ1KK3.gOhgg6O31nZ.', null, null, '::1', '2015-05-15 23:38:30', null, null, null, null, null, null);
