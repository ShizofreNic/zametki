-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 17 2023 г., 01:01
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zadanie`
--

-- --------------------------------------------------------

--
-- Структура таблицы `zametka`
--

CREATE TABLE `zametka` (
  `id` int NOT NULL,
  `zagolovok` varchar(200) NOT NULL,
  `text` varchar(5000) NOT NULL,
  `status` int NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `zametka`
--

INSERT INTO `zametka` (`id`, `zagolovok`, `text`, `status`, `data`) VALUES
(1, 'текст текст текст текст текст', 'текст текст текст текст текст', 0, '2023-03-16'),
(18, 'текст текст текст текст текст', '', 0, '2023-03-16'),
(19, '', 'текст текст текст текст текст', 1, '2023-03-09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `zametka`
--
ALTER TABLE `zametka`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `zametka`
--
ALTER TABLE `zametka`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
