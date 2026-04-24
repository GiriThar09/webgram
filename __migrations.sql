-- Adminer 4.8.1 MySQL 8.3.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `photogram`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `phone` varchar(12) NOT NULL,
  `blocked` int NOT NULL DEFAULT '0',
  `active` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `token` varchar(32) NOT NULL,
  `login_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(20) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `session_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `auth` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `bio` varchar(235) NOT NULL,
  `avatar` varchar(1024) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `instagram` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `facebook` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `auth` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2026-04-23 10:17:30