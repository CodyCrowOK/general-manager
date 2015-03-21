-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

DROP DATABASE IF EXISTS `manager`;
CREATE DATABASE `manager` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `manager`;

DROP TABLE IF EXISTS `batting`;
CREATE TABLE `batting` (
  `team` int(10) unsigned NOT NULL,
  `game` int(10) unsigned NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `pa` tinyint(3) unsigned NOT NULL,
  `h` tinyint(3) unsigned NOT NULL,
  `bb` tinyint(3) unsigned NOT NULL,
  `so` tinyint(3) unsigned NOT NULL,
  `hbp` tinyint(3) unsigned NOT NULL,
  `2b` tinyint(3) unsigned NOT NULL,
  `3b` tinyint(3) unsigned NOT NULL,
  `hr` tinyint(3) unsigned NOT NULL,
  `rbi` tinyint(3) unsigned NOT NULL,
  `sh` tinyint(3) unsigned NOT NULL,
  `sf` tinyint(3) unsigned NOT NULL,
  `r` tinyint(3) unsigned NOT NULL,
  `sb` tinyint(3) unsigned NOT NULL,
  `cs` tinyint(3) unsigned NOT NULL,
  `gdp` tinyint(3) unsigned NOT NULL COMMENT 'double plays grounded into',
  `tob` tinyint(3) unsigned NOT NULL,
  KEY `team` (`team`),
  KEY `game` (`game`),
  KEY `player` (`player`),
  CONSTRAINT `batting_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`),
  CONSTRAINT `batting_ibfk_2` FOREIGN KEY (`game`) REFERENCES `game` (`id`),
  CONSTRAINT `batting_ibfk_3` FOREIGN KEY (`player`) REFERENCES `player` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `win` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `opponent` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team` (`team`),
  CONSTRAINT `game_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DELIMITER ;;

CREATE TRIGGER `game_bi` BEFORE INSERT ON `game` FOR EACH ROW
IF(NEW.date = "0000-00-00") THEN
SET NEW.date=NOW();
END IF;;

DELIMITER ;

DROP TABLE IF EXISTS `pitching`;
CREATE TABLE `pitching` (
  `team` int(10) unsigned NOT NULL,
  `game` int(10) unsigned NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `start` tinyint(1) NOT NULL,
  `win` tinyint(1) NOT NULL,
  `loss` tinyint(1) NOT NULL,
  `ip` double NOT NULL,
  `h` smallint(6) NOT NULL,
  `bb` smallint(6) NOT NULL,
  `hbp` smallint(6) NOT NULL,
  `er` smallint(6) NOT NULL,
  `k` smallint(6) NOT NULL,
  `hold` tinyint(1) NOT NULL,
  `s` tinyint(1) NOT NULL,
  `bs` tinyint(1) NOT NULL,
  `bf` smallint(6) NOT NULL,
  `hr` smallint(6) NOT NULL,
  KEY `team` (`team`),
  KEY `game` (`game`),
  KEY `player` (`player`),
  CONSTRAINT `pitching_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`),
  CONSTRAINT `pitching_ibfk_2` FOREIGN KEY (`game`) REFERENCES `game` (`id`),
  CONSTRAINT `pitching_ibfk_3` FOREIGN KEY (`player`) REFERENCES `player` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  `number` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `is_pitcher` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `team` (`team`),
  CONSTRAINT `player_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(60) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `user` int(10) unsigned NOT NULL,
  `key` varchar(40) NOT NULL,
  `value` varchar(40) NOT NULL,
  KEY `user` (`user`),
  CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `team_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `active_team` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `active_team` (`active_team`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `workspace_lineup`;
CREATE TABLE `workspace_lineup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `team` int(10) unsigned NOT NULL,
  `json` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `team` (`team`),
  CONSTRAINT `workspace_lineup_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  CONSTRAINT `workspace_lineup_ibfk_2` FOREIGN KEY (`team`) REFERENCES `team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-03-21 23:10:09
