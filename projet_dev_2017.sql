-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 28 mai 2018 à 19:08
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

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
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `nbTracks` int(11) DEFAULT NULL,
  `disponibility` tinyint(4) NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `labelName` varchar(80) DEFAULT NULL,
  `picturePath` varchar(200) DEFAULT NULL,
  `artiste_id` int(11) NOT NULL,
  PRIMARY KEY (`album_id`),
  KEY `FK_album_artiste_id` (`artiste_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`album_id`, `name`, `nbTracks`, `disponibility`, `releaseDate`, `labelName`, `picturePath`, `artiste_id`) VALUES
(1, 'In Tongues', NULL, 1, '2018-05-04', '88Rising', 'Assets/IMG/intongues.jpg', 1),
(2, 'Black Cab', NULL, 1, '2018-04-18', '88Rising', 'Assets/IMG/blackcab.jpg', 2),
(3, 'New Model', NULL, 1, '2018-01-10', 'BloodyMusic', 'Assets/IMG/perturbator.jpg', 3),
(4, 'Django Django', NULL, 1, '2014-03-05', 'Ribbon Music', 'Assets/IMG/Django-Django.jpg', 4),
(5, 'Back in Black', NULL, 1, '1980-07-25', 'ATCO', 'Assets/IMG/backinblack.jpg', 5),
(6, '?', NULL, 1, '2018-03-16', 'Bad Vibes Forever', 'Assets/IMG/pointdinterro.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `artist`
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`artiste_id`, `type`, `name`, `nickname`, `type_name`) VALUES
(1, NULL, 'Georges Miller', 'Joji', 'Rap'),
(2, NULL, 'Higher Brothers', 'Higher Brothers', 'Rap'),
(3, NULL, 'Perturbator', 'Perturbator', 'Electro'),
(4, NULL, 'Django Django', 'Django Django', 'Pop'),
(5, NULL, 'ACDC', 'ACDC', 'Rock'),
(6, NULL, 'XXXTentacion', 'XXXTentacion', 'Rap');

-- --------------------------------------------------------

--
-- Structure de la table `music`
--

DROP TABLE IF EXISTS `music`;
CREATE TABLE IF NOT EXISTS `music` (
  `music_id` int(11) NOT NULL AUTO_INCREMENT,
  `lyricsPath` varchar(250) DEFAULT NULL,
  `duration` varchar(50) NOT NULL,
  `title` varchar(80) NOT NULL,
  `playedCounter` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `file` text NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`music_id`),
  KEY `music_album0_FK` (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `music`
--

INSERT INTO `music` (`music_id`, `lyricsPath`, `duration`, `title`, `playedCounter`, `name`, `file`, `album_id`) VALUES
(1, '', '3 : 07', 'Will He', NULL, 'Will He', 'Assets/Music/joji - will he.mp3', 1),
(3, '', '2 : 56', 'Pills', NULL, 'Pills', 'Assets/Music/Joji - Pills (Audio).mp3', 1),
(4, '', '3 : 06', 'Demons', NULL, 'Demons', 'Assets/Music/joji - demons.mp3', 1),
(6, '', '2 : 36', 'Isabellae', NULL, 'Isabellae', 'Assets/Music/joji - demons.mp3', 2),
(7, '', '4 : 36', 'Made In China', NULL, 'Made In China', 'Assets/Music/Joji - Pills (Audio).mp3', 2),
(9, '', '4 : 04', 'Black Cab', NULL, 'Black Cab', 'Assets/Music/joji - demons.mp3', 2),
(11, '', '4 : 15', 'Franklin', NULL, 'Franklin', 'Assets/Music/joji - demons.mp3', 2),
(12, '', '4 : 16', 'WeChat', NULL, 'WeChat', 'Assets/Music/joji - will he.mp3', 2),
(13, '', '5 : 09', 'Birth of the new model', NULL, 'Birth of the new model', 'Assets/Music/Joji - Pills (Audio).mp3', 3),
(14, '', '5 : 25', 'Tactical Precision Disarray', NULL, 'Tactical Precision Disarray', 'Assets/Music/joji - will he.mp3', 3),
(15, '', '4 : 54', 'Vantablack', NULL, 'Vantablack', 'Assets/Music/Joji - Pills (Audio).mp3', 3),
(16, '', '5 : 01', 'Tainted Empire', NULL, 'Tainted Empire', 'Assets/Music/joji - demons.mp3', 3),
(17, '', '4 : 46', 'Corrupted by Design', NULL, 'Corrupted by Design', 'Assets/Music/Joji - Pills (Audio).mp3', 3),
(18, '', '9 : 24', 'God Complex', NULL, 'God Complex', 'Assets/Music/Joji - Pills (Audio).mp3', 3),
(19, '', '2 : 12', 'Introduction', NULL, 'Introduction', 'Assets/Music/joji - will he.mp3', 4),
(20, '', '4 : 06', 'Hail Bop', NULL, 'Hail Bop', 'Assets/Music/joji - demons.mp3', 4),
(21, '', '3 : 05', 'Hells Bells', NULL, 'Hells Bells', 'Assets/Music/joji - will he.mp3', 5),
(22, '', '4 : 25', 'Shoot to Thrill', NULL, 'Shoot to Thrill', 'Assets/Music/joji - will he.mp3', 5),
(23, '', '3 : 37', 'What Do You Do for Money Honey', NULL, 'What Do You Do for Money Honey', 'Assets/Music/Joji - Pills (Audio).mp3', 5),
(24, '', '3 : 33', 'Givin the Dog a Bone', NULL, 'Givin the Dog a Bone', 'Assets/Music/joji - demons.mp3', 5),
(25, '', '4 : 16', 'Let Me Put My Love into You', NULL, 'Let Me Put My Love into You', 'Assets/Music/joji - will he.mp3', 5),
(26, '', '4 : 16', 'Back in Black', NULL, 'Back in Black', 'Assets/Music/joji - will he.mp3', 5),
(27, '', '4 : 16', 'You Shook Me All Night Long', NULL, 'You Shook Me All Night Long', 'Assets/Music/joji - will he.mp3', 5),
(28, '', '3 : 32', 'Have a Drink on Me', NULL, 'Have a Drink on Me', 'Assets/Music/joji - will he.mp3', 5),
(29, '', '4 : 06', 'Shake a Leg', NULL, 'Shake a Leg', 'Assets/Music/joji - demons.mp3', 5),
(30, '', '1 : 57', 'Introduction (Instructions)', NULL, 'Introduction (Instructions)', 'Assets/Music/Joji - Pills (Audio).mp3', 6),
(31, '', '1 : 49', 'Alone, Pt. 3', NULL, 'Alone, Pt. 3', 'Assets/Music/Joji - Pills (Audio).mp3', 6),
(32, '', '2 : 15', 'Moonlight', NULL, 'Moonlight', 'Assets/Music/joji - demons.mp3', 6),
(33, '', '2 : 46', 'Sad!', NULL, 'Sad!', 'Assets/Music/joji - will he.mp3', 1),
(34, '', '2 : 40', 'The Remedy for a Broken Heart (Why Am I So in Love)', NULL, 'The Remedy for a Broken Heart (Why Am I So in Love)', 'Assets/Music/joji - demons.mp3', 6),
(35, '', '1 : 33', 'Floor 555', NULL, 'Floor 555', 'Assets/Music/joji - will he.mp3', 6),
(36, '', '3 : 06', 'Numb', NULL, 'Numb', 'Assets/Music/joji - demons.mp3', 6);

-- --------------------------------------------------------

--
-- Structure de la table `music_playlist`
--

DROP TABLE IF EXISTS `music_playlist`;
CREATE TABLE IF NOT EXISTS `music_playlist` (
  `music_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  PRIMARY KEY (`music_id`,`playlist_id`),
  KEY `FK_music_playlist_playlist_id` (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `music_playlist`
--

INSERT INTO `music_playlist` (`music_id`, `playlist_id`) VALUES
(1, 1),
(6, 1),
(7, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `name`, `creationDate`, `nbTitles`, `user_id`) VALUES
(1, 'issou', '2018-05-26', NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_name` varchar(80) NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`type_name`) VALUES
('Electro'),
('Pop'),
('Rap'),
('Rock');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `premium` tinyint(4) NOT NULL,
  `premium_duration` varchar(255) DEFAULT NULL,
  `userdetails_id` int(11) DEFAULT NULL,
  `recenttype` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_user_userdetails_id` (`userdetails_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `pseudo`, `passwd`, `premium`, `premium_duration`, `userdetails_id`, `recenttype`) VALUES
(12, 'dab', '$argon2i$v=19$m=1024,t=2,p=2$aVEuUUFjZ0xTNFVSWUQ2Tw$TcwUjTlATx5+Ms5K6LOGVL2XywZuUlZghtD1M+ibRoE', 1, '17:43:17', 7, 'a:5:{i:0;s:1:\"?\";i:1;s:13:\"Back in Black\";i:2;s:9:\"New Model\";i:3;s:9:\"Black Cab\";i:4;s:10:\"In Tongues\";}'),
(13, 'daa', '$argon2i$v=19$m=1024,t=2,p=2$NllkczBNc1BwcC5JV0Jtcw$e1Ud3lsM1YVX55DcqUFEnpTYcI/5yS5b64FjwfJT7oQ', 0, NULL, 8, 'a:1:{i:0;s:10:\"In Tongues\";}');

-- --------------------------------------------------------

--
-- Structure de la table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `userdetails_id` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` date NOT NULL,
  `rank` varchar(50) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`userdetails_id`),
  KEY `FK_userdetails_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `userdetails`
--

INSERT INTO `userdetails` (`userdetails_id`, `creationDate`, `rank`, `gender`, `birthdate`, `name`, `email`, `user_id`) VALUES
(7, '2018-05-22', 'admin', 1, '2018-05-24', 'dab', 'dab@dab.fr', 12),
(8, '2018-05-22', 'admin', 1, '2018-05-24', 'daa', 'daa@daa.com', 13);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_album_artiste_id` FOREIGN KEY (`artiste_id`) REFERENCES `artist` (`artiste_id`);

--
-- Contraintes pour la table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `FK_artist_type_name` FOREIGN KEY (`type_name`) REFERENCES `type` (`type_name`);

--
-- Contraintes pour la table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_album0_FK` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`);

--
-- Contraintes pour la table `music_playlist`
--
ALTER TABLE `music_playlist`
  ADD CONSTRAINT `FK_music_playlist_music_id` FOREIGN KEY (`music_id`) REFERENCES `music` (`music_id`),
  ADD CONSTRAINT `FK_music_playlist_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Contraintes pour la table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_playlist_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_userdetails_id` FOREIGN KEY (`userdetails_id`) REFERENCES `userdetails` (`userdetails_id`);

--
-- Contraintes pour la table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `FK_userdetails_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
