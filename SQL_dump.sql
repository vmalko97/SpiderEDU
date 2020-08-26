-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 10 2018 г., 21:34
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auditories`
--

CREATE TABLE `auditories` (
  `id` int(11) NOT NULL,
  `cist_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cist_timetable`
--

CREATE TABLE `cist_timetable` (
  `auditory_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `period_number` varchar(2) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `app_name` varchar(50) NOT NULL,
  `tg_bot_api_key` varchar(100) NOT NULL,
  `wp_url` varchar(50) NOT NULL,
  `wp_db_host` varchar(50) NOT NULL,
  `wp_db_user` varchar(32) NOT NULL,
  `wp_db_password` varchar(32) NOT NULL,
  `wp_db_name` varchar(32) NOT NULL,
  `notes` varchar(500) NOT NULL,
  `cist_timetable_update_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `configuration`
--

INSERT INTO `configuration` (`id`, `app_name`, `tg_bot_api_key`, `wp_url`, `wp_db_host`, `wp_db_user`, `wp_db_password`, `wp_db_name`, `notes`, `cist_timetable_update_time`) VALUES
(1, 'CARAMEL EDU', '570475514:AAGLL2VpSQ35yPCfYCDhpcTsFjEbQ-NaetY', 'http://vmalkoyw.beget.tech/', 'localhost', 'vmalkoyw_wp1', 'ZKr5Qbok2', 'vmalkoyw_wp1', '\n', '04.06.2018 20:50:06');

-- --------------------------------------------------------

--
-- Структура таблицы `digital_journal_marks`
--

CREATE TABLE `digital_journal_marks` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `mark` varchar(3) NOT NULL DEFAULT '0',
  `date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `digital_journal_themes`
--

CREATE TABLE `digital_journal_themes` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date` varchar(11) NOT NULL,
  `theme` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(60) NOT NULL,
  `description` varchar(300) NOT NULL,
  `type` varchar(11) NOT NULL,
  `price` varchar(10) NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unmoderated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(15) NOT NULL,
  `message` varchar(500) NOT NULL,
  `user_from` varchar(40) NOT NULL,
  `user_to` varchar(40) NOT NULL,
  `status` int(1) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `periods`
--

CREATE TABLE `periods` (
  `period_number` int(11) NOT NULL,
  `time_range` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `periods`
--

INSERT INTO `periods` (`period_number`, `time_range`) VALUES
(1, '07:45-09:20'),
(2, '09:20-11:05'),
(3, '11:15-12:50'),
(4, '13:10-14:45'),
(5, '14:55-16:30'),
(6, '16:40-18:15'),
(7, '18:25-20:00'),
(8, '20:10-21:45');

-- --------------------------------------------------------

--
-- Структура таблицы `records_to_event`
--

CREATE TABLE `records_to_event` (
  `id` int(15) NOT NULL,
  `student_id` int(15) NOT NULL,
  `event_id` int(15) NOT NULL,
  `accepted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `study_place` varchar(100) NOT NULL,
  `working_place` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `skype` varchar(30) NOT NULL,
  `telegram` varchar(30) NOT NULL,
  `address` varchar(80) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `super_administrators`
--

CREATE TABLE `super_administrators` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `super_administrators`
--

INSERT INTO `super_administrators` (`id`, `login`, `password`, `telephone`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '380662907712');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `education` varchar(100) NOT NULL,
  `job_place` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `skype` varchar(30) NOT NULL,
  `telegram` varchar(30) NOT NULL,
  `address` varchar(80) NOT NULL,
  `cist_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL DEFAULT 'it_professional'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `telegram_bot_chats`
--

CREATE TABLE `telegram_bot_chats` (
  `id` int(15) NOT NULL,
  `tg_chat_id` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `telegram_groups_and_channels`
--

CREATE TABLE `telegram_groups_and_channels` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `chat_id` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `verified` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `auditory_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `period_number` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auditories`
--
ALTER TABLE `auditories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `digital_journal_marks`
--
ALTER TABLE `digital_journal_marks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `digital_journal_themes`
--
ALTER TABLE `digital_journal_themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`period_number`);

--
-- Индексы таблицы `records_to_event`
--
ALTER TABLE `records_to_event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `super_administrators`
--
ALTER TABLE `super_administrators`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `telegram_bot_chats`
--
ALTER TABLE `telegram_bot_chats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `telegram_groups_and_channels`
--
ALTER TABLE `telegram_groups_and_channels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auditories`
--
ALTER TABLE `auditories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `digital_journal_marks`
--
ALTER TABLE `digital_journal_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `digital_journal_themes`
--
ALTER TABLE `digital_journal_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `periods`
--
ALTER TABLE `periods`
  MODIFY `period_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `records_to_event`
--
ALTER TABLE `records_to_event`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `super_administrators`
--
ALTER TABLE `super_administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `telegram_bot_chats`
--
ALTER TABLE `telegram_bot_chats`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `telegram_groups_and_channels`
--
ALTER TABLE `telegram_groups_and_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
