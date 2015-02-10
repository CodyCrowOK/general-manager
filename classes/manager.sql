-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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

INSERT INTO `batting` (`team`, `game`, `player`, `pa`, `h`, `bb`, `so`, `hbp`, `2b`, `3b`, `hr`, `rbi`, `sh`, `sf`, `r`, `sb`, `cs`, `gdp`, `tob`) VALUES
(1,	77,	7,	4,	1,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1),
(1,	77,	3,	4,	1,	1,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	2),
(1,	77,	5,	4,	0,	0,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	77,	2,	4,	1,	1,	1,	0,	0,	0,	1,	1,	0,	0,	2,	0,	0,	0,	2),
(1,	77,	8,	3,	0,	2,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	2),
(1,	77,	6,	2,	0,	0,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	77,	12,	1,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1),
(1,	77,	10,	2,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	77,	13,	1,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0),
(1,	77,	11,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	77,	1,	3,	0,	0,	0,	0,	0,	0,	0,	1,	1,	0,	0,	0,	0,	0,	0),
(1,	77,	9,	3,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	7,	4,	1,	0,	0,	1,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	2),
(1,	78,	3,	4,	1,	1,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	2),
(1,	78,	5,	4,	2,	0,	0,	0,	1,	0,	0,	1,	0,	1,	0,	0,	0,	0,	2),
(1,	78,	2,	4,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0),
(1,	78,	8,	4,	2,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	3),
(1,	78,	17,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	6,	3,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	12,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	11,	4,	1,	0,	0,	1,	0,	0,	1,	2,	0,	0,	0,	0,	0,	0,	2),
(1,	78,	1,	4,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0),
(1,	78,	18,	1,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	15,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	16,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	78,	13,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	79,	7,	6,	2,	0,	2,	0,	1,	0,	0,	0,	0,	0,	1,	0,	1,	1,	2),
(1,	79,	13,	5,	1,	1,	1,	0,	0,	0,	0,	1,	0,	0,	1,	1,	0,	0,	2),
(1,	79,	5,	5,	1,	2,	0,	0,	1,	0,	0,	0,	0,	0,	2,	0,	0,	0,	3),
(1,	79,	2,	5,	3,	0,	1,	0,	0,	0,	1,	2,	0,	0,	1,	1,	0,	0,	3),
(1,	79,	8,	5,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0),
(1,	79,	6,	3,	2,	0,	0,	0,	0,	0,	1,	1,	0,	0,	1,	0,	0,	0,	2),
(1,	79,	12,	2,	1,	0,	1,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	1),
(1,	79,	11,	5,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0),
(1,	79,	3,	5,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	79,	1,	2,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	79,	18,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(1,	79,	19,	2,	0,	0,	1,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0);

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

INSERT INTO `game` (`id`, `team`, `date`, `win`, `opponent`) VALUES
(77,	1,	'1995-10-21',	1,	'Cleveland Indians'),
(78,	1,	'1995-10-22',	1,	'Cleveland Indians'),
(79,	1,	'1995-10-24',	0,	'Cleveland Indians');

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

INSERT INTO `pitching` (`team`, `game`, `player`, `start`, `win`, `loss`, `ip`, `h`, `bb`, `hbp`, `er`, `k`, `hold`, `s`, `bs`, `bf`, `hr`) VALUES
(1,	77,	9,	1,	1,	0,	9,	2,	0,	0,	0,	4,	0,	0,	0,	30,	0),
(1,	78,	14,	1,	1,	0,	6,	3,	3,	0,	2,	3,	0,	0,	0,	25,	1),
(1,	78,	15,	0,	0,	0,	0.2,	1,	1,	0,	0,	1,	1,	0,	0,	5,	0),
(1,	78,	16,	0,	0,	0,	1,	1,	1,	0,	0,	0,	1,	0,	0,	4,	0),
(1,	78,	17,	0,	0,	0,	1.1,	1,	0,	0,	0,	1,	0,	1,	0,	5,	0),
(1,	79,	20,	1,	0,	0,	2.1,	6,	2,	0,	4,	4,	0,	0,	0,	15,	0),
(1,	79,	21,	0,	0,	0,	2.1,	1,	0,	0,	0,	1,	0,	0,	0,	7,	0),
(1,	79,	22,	0,	0,	0,	2,	1,	2,	0,	1,	2,	0,	0,	0,	9,	0),
(1,	79,	15,	0,	0,	0,	0.2,	1,	1,	0,	1,	1,	0,	0,	0,	4,	0),
(1,	79,	17,	0,	0,	0,	2.2,	1,	3,	0,	0,	2,	0,	0,	1,	12,	0),
(1,	79,	16,	0,	0,	1,	0,	2,	1,	0,	1,	0,	0,	0,	0,	3,	0);

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

INSERT INTO `player` (`id`, `team`, `name`, `number`, `is_pitcher`) VALUES
(1,	1,	'Rafael Belliard',	2,	0),
(2,	1,	'Fred McGriff',	27,	0),
(3,	1,	'Mark Lemke',	20,	0),
(4,	1,	'Jeff Blauser',	4,	0),
(5,	1,	'Chipper Jones',	10,	0),
(6,	1,	'Ryan Klesko',	18,	0),
(7,	1,	'Marquis Grissom',	9,	0),
(8,	1,	'David Justice',	23,	0),
(9,	1,	'Greg Maddux',	31,	1),
(10,	1,	'Charlie O\'Brien',	11,	0),
(11,	1,	'Javy Lopez',	8,	0),
(12,	1,	'Mike Devereaux',	24,	0),
(13,	1,	'Luis Polonia',	17,	0),
(14,	1,	'Tom Glavine',	47,	1),
(15,	1,	'Greg McMichael',	38,	1),
(16,	1,	'Alejandro Pena',	26,	1),
(17,	1,	'Mark Wohlers',	43,	1),
(18,	1,	'Dwight Smith',	7,	0),
(19,	1,	'Mike Mordecai',	16,	0),
(20,	1,	'John Smoltz',	29,	1),
(21,	1,	'Brad Clontz',	52,	1),
(22,	1,	'Kent Mercker',	50,	1);

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(60) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `session` (`id`, `timestamp`, `ip`, `data`) VALUES
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;'),
('lpnm9f28jpq9haef8p2u3nlhp2',	'2015-02-10 04:43:43',	'127.0.0',	'uid|s:1:\"2\";is_logged|b:1;');

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `team_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `team` (`id`, `user`, `name`) VALUES
(1,	2,	'Atlanta Braves');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `active_team` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active_team` (`active_team`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`active_team`) REFERENCES `team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `active_team`) VALUES
(2,	'James Dean',	'james@gmail.com',	'$2y$10$iEqImSY8oYn.ZD/m87OqkeTaC.cZ.uoEBl.2n8So/jFmNUYbHJ712',	1);

-- 2015-02-10 05:06:45
