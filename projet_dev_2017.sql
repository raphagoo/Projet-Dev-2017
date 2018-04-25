-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2018 at 05:24 PM
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
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `nbTracks` int(11) DEFAULT NULL,
  `disponibility` tinyint(4) NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `labelName` varchar(80) DEFAULT NULL,
  `artiste_id` int(11) NOT NULL,
  PRIMARY KEY (`album_id`),
  KEY `FK_album_artiste_id` (`artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `artiste_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `type_name` varchar(80) NOT NULL,
  PRIMARY KEY (`artiste_id`),
  KEY `FK_artist_type_name` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
CREATE TABLE IF NOT EXISTS `music` (
  `music_id` int(11) NOT NULL AUTO_INCREMENT,
  `lyrics` tinyint(4) NOT NULL,
  `duration` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `playedCounter` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `file` text NOT NULL,
  PRIMARY KEY (`music_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `music_album`
--

DROP TABLE IF EXISTS `music_album`;
CREATE TABLE IF NOT EXISTS `music_album` (
  `music_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`music_id`,`album_id`),
  KEY `FK_music_album_album_id` (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `music_playlist`
--

DROP TABLE IF EXISTS `music_playlist`;
CREATE TABLE IF NOT EXISTS `music_playlist` (
  `music_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  PRIMARY KEY (`music_id`,`playlist_id`),
  KEY `FK_music_playlist_playlist_id` (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `creationDate` date DEFAULT NULL,
  `nbTitles` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`playlist_id`),
  KEY `FK_playlist_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_name` varchar(80) NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `premium` tinyint(4) NOT NULL,
  `premium_duration` float DEFAULT NULL,
  `userdetails_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_user_userdetails_id` (`userdetails_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pseudo`, `passwd`, `premium`, `premium_duration`, `userdetails_id`) VALUES
(1, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$aEdvVEZraXhkSTR4d0N6WQ$RdFrdU7/hv/UQAeVcMKOx+3Jx/t7D7JtMxKHsPHyILk', 0, NULL, NULL),
(2, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$bllQZ0NhOWsyR1oxZ0tWTA$eRFplK2KXwt+oc+AbDgjjmHHnUpMVK+AfIHEpyXqctI', 0, NULL, NULL),
(3, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$SzhNT01uU0RjWG5FNlVpZg$3arZB9dLv5MB80gRT0vtzW4i4Qh09B1GXnsB/qkk22s', 0, NULL, NULL),
(4, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$aU5vUXB2Ymg1a1kvUXh1OQ$sCzs+qBjP366aj++nPu6VboGTeZIDE/MJsTUCEgtEm4', 0, NULL, NULL),
(5, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$Nng0RDJBVHBqNWYyVUNHNA$it6xSUOti3jGoV8/ymYEv5Y89lczaZYoKtTwhALpg9E', 0, NULL, NULL),
(6, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$WmUubWpIZ1FQdUVFd05pRQ$xJg5eD8eRwJqwl2PcnCa+JwaH4xlj8TXkLB5nk7BclI', 0, NULL, NULL),
(7, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$czQzUm44THEyVjNwWGdhaQ$tL2gkNLdzwwhClMHl5Y8lDkv3Y+PkCCLCdIHZkUgyqg', 0, NULL, 1),
(8, 'Klk', '$argon2i$v=19$m=1024,t=2,p=2$WlFzNVZITmMxOXNoTFZYRA$Cten6lcdV0c0kP8NhNKiZG9550dtZhqJzDWnT95GVe4', 0, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `userdetails_id` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` date NOT NULL,
  `rank` varchar(50) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`userdetails_id`),
  KEY `FK_userdetails_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userdetails_id`, `creationDate`, `rank`, `gender`, `birthdate`, `name`, `email`, `user_id`) VALUES
(1, '2018-04-25', 'user', 1, '2018-04-01', 'Risbourg', 'nookye@hotmail.fr', 7),
(2, '2018-04-25', 'user', 2, '2018-04-09', 'af', 'r@f.com', 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_album_artiste_id` FOREIGN KEY (`artiste_id`) REFERENCES `artist` (`artiste_id`);

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `FK_artist_type_name` FOREIGN KEY (`type_name`) REFERENCES `type` (`type_name`);

--
-- Constraints for table `music_album`
--
ALTER TABLE `music_album`
  ADD CONSTRAINT `FK_music_album_album_id` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  ADD CONSTRAINT `FK_music_album_music_id` FOREIGN KEY (`music_id`) REFERENCES `music` (`music_id`);

--
-- Constraints for table `music_playlist`
--
ALTER TABLE `music_playlist`
  ADD CONSTRAINT `FK_music_playlist_music_id` FOREIGN KEY (`music_id`) REFERENCES `music` (`music_id`),
  ADD CONSTRAINT `FK_music_playlist_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_playlist_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_userdetails_id` FOREIGN KEY (`userdetails_id`) REFERENCES `userdetails` (`userdetails_id`);

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `FK_userdetails_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
