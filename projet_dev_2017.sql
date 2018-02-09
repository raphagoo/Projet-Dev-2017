-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 09 fév. 2018 à 18:09
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_dev_2017`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
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
-- Structure de la table `artist`
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
-- Structure de la table `correspond`
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
-- Structure de la table `music`
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
-- Structure de la table `playlist`
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
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(9) NOT NULL,
  `userdetails_id` varchar(9) NOT NULL,
  `pseudo` varchar(20) DEFAULT NULL,
  `passwd` varchar(20) DEFAULT NULL,
  `playlist_id` varchar(50) NOT NULL,
  `premium_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_user_premium_id` (`premium_id`),
  KEY `FK_user_details_id` (`userdetails_id`),
  KEY `FK_playlist_user_id` (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `userdetails_id` varchar(9) NOT NULL,
  `creationdate` date DEFAULT NULL,
  `favorites` char(50) DEFAULT NULL,
  `rank` char(50) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `name` char(25) DEFAULT NULL,
  PRIMARY KEY (`userdetails_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `userpremium`
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
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_album_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`);

--
-- Contraintes pour la table `correspond`
--
ALTER TABLE `correspond`
  ADD CONSTRAINT `FK_correspond_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`),
  ADD CONSTRAINT `FK_correspond_type_name` FOREIGN KEY (`type_name`) REFERENCES `type` (`type_name`);

--
-- Contraintes pour la table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `FK_music_album_id` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  ADD CONSTRAINT `FK_music_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_playlist_user_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`),
  ADD CONSTRAINT `FK_user_details_id` FOREIGN KEY (`userdetails_id`) REFERENCES `userdetails` (`userdetails_id`),
  ADD CONSTRAINT `FK_user_premium_id` FOREIGN KEY (`premium_id`) REFERENCES `userpremium` (`userpremium_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
