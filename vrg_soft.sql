-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 11 2021 г., 03:07
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vrg_soft`
--

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `first_name`, `last_name`, `middle_name`) VALUES
(12, 'Joanne ', 'Rowling', ''),
(13, 'Stephen ', 'King', '');

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `book_title`, `short_description`, `picture_path`, `authors_id`, `publication_date`) VALUES
(11, 'Harry Potter and the prisoner of Azkaban', '-', '/upload/6024995d10e63638731798.jpg', '13', '2021-02-09'),
(10, 'Harry Potter And The Chamber of secrets', '-', '/upload/60249915c01ca090724037.jpg', '12', '2021-02-03'),
(9, 'Harry Зotter and the philosopher\'s stone', '-', '/upload/602498e797185729087684.jpg', '12', '1998-02-11'),
(12, 'Harry Potter and the Goblet of Fire', '-', '/upload/6024996dca642680886297.jpg', '12', '2021-02-01'),
(13, 'Dragon Eyes', '-', '/upload/602499b715162576344047.jpg', '13', '1995-07-19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
