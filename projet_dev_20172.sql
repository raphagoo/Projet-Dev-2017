-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 23, 2018 at 03:04 PM
-- Server version: 5.7.19
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_dev_2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `album_id` varchar(50) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `titlenumber` int(11) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `releasedate` date DEFAULT NULL,
  `artist_id` varchar(50) NOT NULL,
  `label_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`album_id`),
  KEY `FK_album_artist_id` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `artist_id` varchar(50) NOT NULL,
  `type` char(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `correspond`
--

DROP TABLE IF EXISTS `correspond`;
CREATE TABLE IF NOT EXISTS `correspond` (
  `artist_id` varchar(50) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`artist_id`,`type_name`),
  KEY `FK_correspond_type_name` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
CREATE TABLE IF NOT EXISTS `music` (
  `music_id` varchar(50) NOT NULL,
  `lyrics` tinyint(1) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `playcompteur` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `played` tinyint(1) DEFAULT NULL,
  `artist_id` varchar(50) NOT NULL,
  `album_id` varchar(50) NOT NULL,
  `fichier` text,
  PRIMARY KEY (`music_id`),
  KEY `FK_music_artist_id` (`artist_id`),
  KEY `FK_music_album_id` (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `playlist_id` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `creationdate` date DEFAULT NULL,
  `pseudo` varchar(20) DEFAULT NULL,
  `titlenumber` int(11) DEFAULT NULL,
  PRIMARY KEY (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `userdetails_id` int(6) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `playlist_id` varchar(50) DEFAULT NULL,
  `premium_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_user_premium_id` (`premium_id`),
  KEY `FK_playlist_user_id` (`playlist_id`),
  KEY `FK_user_userdetails` (`userdetails_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `userdetails_id`, `pseudo`, `passwd`, `playlist_id`, `premium_id`) VALUES
(1, 1, 'Qtzzz', '$argon2i$v=19$m=1024,t=2,p=2$cUdJcXN2czFNQi5MQkFXNg$qFu/l/CfSLxzq5uJEeE3qtBeXNZHpMYLbHEWt04c/z8', NULL, NULL),
(2, 2, 'Klk', '$argon2i$v=19$m=1024,t=2,p=2$NmEvQkRCQUhKZUNWM1l1NA$k1SohSy4/gUggUfdMOSRst/m+NVhXtvw7sk9knmygMo', NULL, NULL),
(3, 3, 'dfghjk', '$argon2i$v=19$m=1024,t=2,p=2$YUloTlM5cUFubUVUN2hqbw$FIIHD4m5dbAjL8ie9DIPXH58wudACrejiWXwxTvpj3U', NULL, NULL),
(4, 4, 'Raph', '$argon2i$v=19$m=1024,t=2,p=2$OHBTcEdkLkVSc0YzbFJDeg$Bq8AhEm/lcNFT1VGWsaCppV1ZKwRtKyTEqx07GrX2WM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `userdetails_id` int(6) NOT NULL AUTO_INCREMENT,
  `creationdate` date DEFAULT NULL,
  `favorites` char(50) DEFAULT NULL,
  `rank` char(50) DEFAULT NULL,
  `gender` enum('male','female','other','') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `name` char(25) DEFAULT NULL,
  `mail` varchar(60) NOT NULL,
  PRIMARY KEY (`userdetails_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userdetails_id`, `creationdate`, `favorites`, `rank`, `gender`, `birthdate`, `name`, `mail`) VALUES
(1, '2018-02-13', NULL, NULL, 'male', '2018-02-16', 'BRAUN', 'braun@f.com'),
(2, '2018-02-13', NULL, NULL, 'male', '2018-02-15', 'RISBOURG', 'nookye@hotmail.fr'),
(3, '2018-02-13', NULL, NULL, 'male', '2018-02-24', 'dfghj', 'jjj@gmail.com'),
(4, '2018-04-23', NULL, NULL, 'male', '2018-04-10', 'Raphael', 'raph@f.com');

-- --------------------------------------------------------

--
-- Table structure for table `userpremium`
--

DROP TABLE IF EXISTS `userpremium`;
CREATE TABLE IF NOT EXISTS `userpremium` (
  `userpremium_id` varchar(50) NOT NULL,
  `premium` tinyint(1) DEFAULT NULL,
  `duration` float DEFAULT NULL,
  `pseudo` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`userpremium_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_album_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`);

--
-- Constraints for table `correspond`
--
ALTER TABLE `correspond`
  ADD CONSTRAINT `FK_correspond_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`),
  ADD CONSTRAINT `FK_correspond_type_name` FOREIGN KEY (`type_name`) REFERENCES `type` (`type_name`);

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `FK_music_album_id` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  ADD CONSTRAINT `FK_music_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_playlist_user_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`),
  ADD CONSTRAINT `FK_user_premium_id` FOREIGN KEY (`premium_id`) REFERENCES `userpremium` (`userpremium_id`),
  ADD CONSTRAINT `FK_user_userdetails` FOREIGN KEY (`userdetails_id`) REFERENCES `userdetails` (`userdetails_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
