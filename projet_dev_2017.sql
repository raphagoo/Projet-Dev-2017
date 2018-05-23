-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 23 2018 г., 09:49
-- Версия сервера: 5.7.19
-- Версия PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `projet_dev_2017`
--

CREATE DATABASE projet_dev_2017;

use projet_dev_2017;

-- --------------------------------------------------------

--
-- Структура таблицы `album`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `artiste_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `type_name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`artiste_id`),
  KEY `FK_artist_type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `music`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `music_playlist`
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
-- Структура таблицы `playlist`
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_name` varchar(80) NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`type_name`) VALUES
('Classique'),
('rock');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `userdetails`
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_album_artiste_id` FOREIGN KEY (`artiste_id`) REFERENCES `artist` (`artiste_id`)
ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Ограничения внешнего ключа таблицы `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `FK_artist_type_name` FOREIGN KEY (`type_name`) REFERENCES `type` (`type_name`)
ON DELETE SET NULL ON UPDATE CASCADE;
--
-- Ограничения внешнего ключа таблицы `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_album0_FK` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`)
ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Ограничения внешнего ключа таблицы `music_playlist`
--
ALTER TABLE `music_playlist`
  ADD CONSTRAINT `FK_music_playlist_music_id` FOREIGN KEY (`music_id`) REFERENCES `music` (`music_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;
  
 ALTER TABLE `music_playlist`
  ADD CONSTRAINT `FK_music_playlist_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;
  

--
-- Ограничения внешнего ключа таблицы `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_playlist_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_userdetails_id` FOREIGN KEY (`userdetails_id`) REFERENCES `userdetails` (`userdetails_id`)
ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Ограничения внешнего ключа таблицы `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `FK_userdetails_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
