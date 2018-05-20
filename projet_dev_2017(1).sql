-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2018 г., 16:20
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

--
-- Дамп данных таблицы `album`
--

INSERT INTO `album` (`album_id`, `name`, `nbTracks`, `disponibility`, `releaseDate`, `labelName`, `picturePath`, `artiste_id`) VALUES
(1, 'ep1', NULL, 1, '2018-05-19', 'af', NULL, 2),
(2, 'w', NULL, 1, '2018-05-07', 'Valittder', 'Assets/IMG/13450190_1213163208702593_6652050158245010946_n.jpg', 1);

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
  `type_name` varchar(80) NOT NULL,
  PRIMARY KEY (`artiste_id`),
  KEY `FK_artist_type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `artist`
--

INSERT INTO `artist` (`artiste_id`, `type`, `name`, `nickname`, `type_name`) VALUES
(1, NULL, 'Ivan Rebroff', 'I.Rebrov', 'Classique'),
(2, NULL, 'Eduard Khil', 'E.K', 'Classique');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `music`
--

INSERT INTO `music` (`music_id`, `lyricsPath`, `duration`, `title`, `playedCounter`, `name`, `file`, `album_id`) VALUES
(1, 'Assets/Lyrics/lyrics.txt', '1 : 23', 'musiccc', NULL, 'gg', 'Assets/Music/Boris_Vian_-_La_complainte_du_progrÃ¨s_1956[www.MP3Fiber.com].mp3', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `pseudo`, `passwd`, `premium`, `premium_duration`, `userdetails_id`) VALUES
(1, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$aEdvVEZraXhkSTR4d0N6WQ$RdFrdU7/hv/UQAeVcMKOx+3Jx/t7D7JtMxKHsPHyILk', 0, NULL, NULL),
(2, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$bllQZ0NhOWsyR1oxZ0tWTA$eRFplK2KXwt+oc+AbDgjjmHHnUpMVK+AfIHEpyXqctI', 0, NULL, NULL),
(3, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$SzhNT01uU0RjWG5FNlVpZg$3arZB9dLv5MB80gRT0vtzW4i4Qh09B1GXnsB/qkk22s', 0, NULL, NULL),
(4, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$aU5vUXB2Ymg1a1kvUXh1OQ$sCzs+qBjP366aj++nPu6VboGTeZIDE/MJsTUCEgtEm4', 0, NULL, NULL),
(5, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$Nng0RDJBVHBqNWYyVUNHNA$it6xSUOti3jGoV8/ymYEv5Y89lczaZYoKtTwhALpg9E', 0, NULL, NULL),
(6, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$WmUubWpIZ1FQdUVFd05pRQ$xJg5eD8eRwJqwl2PcnCa+JwaH4xlj8TXkLB5nk7BclI', 0, NULL, NULL),
(7, 'klk', '$argon2i$v=19$m=1024,t=2,p=2$czQzUm44THEyVjNwWGdhaQ$tL2gkNLdzwwhClMHl5Y8lDkv3Y+PkCCLCdIHZkUgyqg', 0, NULL, 1),
(8, 'Klk', '$argon2i$v=19$m=1024,t=2,p=2$WlFzNVZITmMxOXNoTFZYRA$Cten6lcdV0c0kP8NhNKiZG9550dtZhqJzDWnT95GVe4', 0, NULL, 2),
(9, 'Nat', '$argon2i$v=19$m=1024,t=2,p=2$Q0R0RDNaSzhCTklYS0FMRw$SbFeKcESkrOv7C4lo6njkcChks+iW+ezBmzCU7toYcs', 0, NULL, 3),
(10, 'admin', '$argon2i$v=19$m=1024,t=2,p=2$dEdlaUg3TTBDNXlhcjJsQg$QP4pNTsYhiHXqztWyAShHMmq0DQNKCETnskLnG0VztA', 0, NULL, 5),
(11, 'pierreAdmin', '$argon2i$v=19$m=1024,t=2,p=2$aFVielhMMUQ2bmZqMWtnRA$HB9mnm/Rjwwm1fZDgY4bRBKnuRB+fEB9idh3ZPypwA8', 1, NULL, 6);

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
-- Дамп данных таблицы `userdetails`
--

INSERT INTO `userdetails` (`userdetails_id`, `creationDate`, `rank`, `gender`, `birthdate`, `name`, `email`, `user_id`) VALUES
(1, '2018-04-25', 'user', 1, '2018-04-01', 'Risbourg', 'nookye@hotmail.fr', 7),
(2, '2018-04-25', 'user', 2, '2018-04-09', 'af', 'r@f.com', 8),
(3, '2018-05-19', 'user', 1, '2018-05-23', 'Nathan', 'nathan.risbodurg@ynov.com', 9),
(4, '2018-05-19', 'admin', 1, '2018-05-19', 'Administrateur', 'admin@admin.com', 10),
(6, '2018-05-19', 'admin', NULL, NULL, NULL, NULL, 11);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_album_artiste_id` FOREIGN KEY (`artiste_id`) REFERENCES `artist` (`artiste_id`);

--
-- Ограничения внешнего ключа таблицы `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `FK_artist_type_name` FOREIGN KEY (`type_name`) REFERENCES `type` (`type_name`);

--
-- Ограничения внешнего ключа таблицы `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_album0_FK` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`);

--
-- Ограничения внешнего ключа таблицы `music_playlist`
--
ALTER TABLE `music_playlist`
  ADD CONSTRAINT `FK_music_playlist_music_id` FOREIGN KEY (`music_id`) REFERENCES `music` (`music_id`),
  ADD CONSTRAINT `FK_music_playlist_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Ограничения внешнего ключа таблицы `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_playlist_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_userdetails_id` FOREIGN KEY (`userdetails_id`) REFERENCES `userdetails` (`userdetails_id`);

--
-- Ограничения внешнего ключа таблицы `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `FK_userdetails_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
