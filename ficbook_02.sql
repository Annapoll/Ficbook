-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 22 2022 г., 19:00
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fic_ira`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admine` bigint(20) UNSIGNED NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admine`, `nickname`, `password`, `email`) VALUES
(1, 'Annapoll', '', ''),
(2, 'Nocshnizi', '', ''),
(6, 'Admin', '13', 'sdss@dfd.df');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id_reader` bigint(20) UNSIGNED NOT NULL,
  `mark` bigint(20) NOT NULL,
  `text_comment` text DEFAULT NULL,
  `id_story` bigint(20) UNSIGNED NOT NULL,
  `id_feedback` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id_reader`, `mark`, `text_comment`, `id_story`, `id_feedback`) VALUES
(6, 10, 'good story) without gays)))))', 18, 1),
(39, 6, 'uiuiuiuiu', 19, 2),
(8, 10, 'i love the idea, he gives her money... i want it too', 27, 3),
(8, 9, 'its not even wierd, its disgusting', 18, 5),
(9, 9, 'its not like taste tasty, but act like tasty', 27, 6),
(15, 9, 'test', 27, 8),
(15, 9, 'test', 27, 9),
(15, 5, 'i dont know what to say ', 19, 10),
(15, 9, 'test', 19, 13),
(39, 9, 'Incredible song ?dont understed what it will do here', 19, 17),
(39, 5, 'Test', 19, 18),
(40, 8, '', 19, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `reader`
--

CREATE TABLE `reader` (
  `id_reader` bigint(20) UNSIGNED NOT NULL,
  `read_story` bigint(20) DEFAULT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reader`
--

INSERT INTO `reader` (`id_reader`, `read_story`, `nickname`, `password`, `email`) VALUES
(1, 545, 'JK  ', '111', 'anna@gmail.com'),
(2, 454, 'Nora ', '', ''),
(5, 88, 'Tonks', '', ''),
(6, 2, 'Charly', '', ''),
(7, 99, 'Teodor', '', ''),
(8, 89, 'Kram', '', ''),
(9, 50, 'Drako', '', ''),
(10, 90, 'Nevil', '', ''),
(11, 70, 'Minevra', '', ''),
(12, 1000, 'Dumbleldore ', '', ''),
(15, NULL, 'test', '5', 'sdss@dfd.df'),
(32, NULL, '///', 'kl', 'sdss@dfd.df'),
(33, NULL, '', 'kl', 'sdss@dfd.df'),
(35, NULL, 'Hello World!', 'йцукен', 'annapollvp@gmail.com'),
(36, NULL, 'test23', 'quwywuw', 'annapollvp@gmail.com'),
(37, NULL, 'tes!t', '147', 'nastaj004@gmail.com'),
(39, NULL, 'Nill', '147258369', 'nill@gmail.com'),
(40, NULL, 'Reader', '123', 'sdss@dfd.df');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id_writer` bigint(20) UNSIGNED NOT NULL,
  `id_admine` bigint(20) UNSIGNED NOT NULL,
  `request` tinyint(1) NOT NULL COMMENT '1-yes/0-no',
  `id_request` bigint(20) UNSIGNED NOT NULL,
  `name_story` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id_writer`, `id_admine`, `request`, `id_request`, `name_story`) VALUES
(26, 6, 1, 1, ''),
(30, 2, 1, 2, ''),
(21, 1, 1, 3, ''),
(22, 1, 1, 4, ''),
(29, 2, 1, 8, ''),
(27, 1, 1, 9, ''),
(25, 1, 1, 10, ''),
(26, 1, 1, 15, ''),
(28, 1, 1, 16, ''),
(30, 2, 0, 21, ''),
(39, 1, 1, 22, 'Let it go'),
(39, 1, 0, 23, 'Monster'),
(39, 1, 0, 27, 'Show yourself'),
(39, 1, 0, 39, 'Test'),
(39, 1, 0, 40, 'Testtet');

-- --------------------------------------------------------

--
-- Структура таблицы `story`
--

CREATE TABLE `story` (
  `id_story` bigint(20) UNSIGNED NOT NULL,
  `name_story` varchar(100) NOT NULL,
  `num_reader` bigint(20) UNSIGNED NOT NULL,
  `id_writer` bigint(20) UNSIGNED NOT NULL,
  `average_score` float NOT NULL,
  `id_request` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `story`
--

INSERT INTO `story` (`id_story`, `name_story`, `num_reader`, `id_writer`, `average_score`, `id_request`) VALUES
(1, 'Lana Del Rey is queen of the depression', 1202100, 26, 10, 1),
(2, 'Poor soul worse than poor wallet', 78, 30, 8.9, 2),
(18, 'Mo Dao Zu Shi', 1000000, 22, 10, 15),
(19, 'Into the unknown', 1001, 28, 6, 4),
(27, 'Goblin', 1000000000000000, 28, 10, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `writer`
--

CREATE TABLE `writer` (
  `id_writer` bigint(20) UNSIGNED NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `id_request` bigint(20) UNSIGNED DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `writer`
--

INSERT INTO `writer` (`id_writer`, `nickname`, `id_request`, `password`, `email`) VALUES
(21, 'JK  Rowling', 3, '0', ''),
(22, 'Mo Xian Tong Xiu', 4, '0', ''),
(25, 'Author ', 10, '0', ''),
(26, 'Book Fox', 15, '0', ''),
(27, 'Yuliya Moon', 9, '0', ''),
(28, 'AnnaMun', 16, '0', ''),
(29, 'rikookie', 8, '0', ''),
(30, 'Magnus', NULL, '0', ''),
(31, 'DFDF', NULL, '1', 'sdss@dfd.df'),
(37, 'Nora ', NULL, '147', 'sdss@dfd.df'),
(39, 'Writer', NULL, '147', 'sdss@dfd.df');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admine`) USING BTREE;

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_reader` (`id_reader`),
  ADD KEY `id_story` (`id_story`);

--
-- Индексы таблицы `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`id_reader`) USING BTREE;

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`) USING BTREE,
  ADD KEY `id_admine` (`id_admine`),
  ADD KEY `id_writer` (`id_writer`) USING BTREE;

--
-- Индексы таблицы `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id_story`),
  ADD UNIQUE KEY `id_request` (`id_request`) USING BTREE,
  ADD KEY `id_writer` (`id_writer`),
  ADD KEY `num_reader` (`num_reader`);

--
-- Индексы таблицы `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`id_writer`) USING BTREE,
  ADD KEY `id_request` (`id_request`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admine` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `reader`
--
ALTER TABLE `reader`
  MODIFY `id_reader` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id_request` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `story`
--
ALTER TABLE `story`
  MODIFY `id_story` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `writer`
--
ALTER TABLE `writer`
  MODIFY `id_writer` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_reader`) REFERENCES `reader` (`id_reader`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_story`) REFERENCES `story` (`id_story`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_admine`) REFERENCES `admin` (`id_admine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`id_writer`) REFERENCES `writer` (`id_writer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `story_ibfk_1` FOREIGN KEY (`id_writer`) REFERENCES `writer` (`id_writer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_ibfk_3` FOREIGN KEY (`id_request`) REFERENCES `request` (`id_request`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `writer`
--
ALTER TABLE `writer`
  ADD CONSTRAINT `writer_ibfk_1` FOREIGN KEY (`id_request`) REFERENCES `request` (`id_request`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
