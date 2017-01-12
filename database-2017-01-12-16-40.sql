-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 12 2017 г., 16:40
-- Версия сервера: 5.7.16-0ubuntu0.16.04.1
-- Версия PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `fence`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advantages`
--

CREATE TABLE `advantages` (
  `id` int(7) NOT NULL,
  `adv_text` varchar(255) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `advantages`
--

INSERT INTO `advantages` (`id`, `adv_text`, `type`, `icon`) VALUES
(1, 'Готовый забор «под ключ» уже через <span>5 дней</span><br>\nОт профессионалов с <span>9-летним</span> опытом<br>\nРассчитайте стоимость на сайте', 1, ''),
(2, '<span>В июле </span> скидки<br>на профнастил <span>10%</span>', 1, ''),
(3, 'Работаем по договору с гарантией сроков', 2, 'icon-contract'),
(4, 'Устанавливаем до 100м забора в день', 2, 'icon-tools'),
(5, 'Даем гарантию на монтаж и материалы от 5 лет', 2, 'icon-achievment'),
(6, '10 собственных бригад<br>регулярно аттестуются<br>и имеют опыт от 9 лет', 3, ''),
(7, 'Даем гарантию на<br>материалы от 10 лет<br>и 5 лет гарантии на монтаж', 3, ''),
(8, 'За 9 лет произвели<br>и установили более<br>1093 км ограждений', 3, ''),
(9, 'Стоимость работ фиксируется<br>в смете и не меняется.<br>Гибкие условия оплаты', 3, ''),
(10, 'Устанавливаем заборы согласно<br>строительным нормам. Проводим<br>геотесты и подготовку участка', 3, ''),
(11, 'Ограждали предприятия,<br>жилые дома, коттеджные поселки,<br>инфраструктурные объекты.', 3, '');

-- --------------------------------------------------------

--
-- Структура таблицы `fence_types`
--

CREATE TABLE `fence_types` (
  `id` int(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fence_types`
--

INSERT INTO `fence_types` (`id`, `title`, `description`, `text`, `image`) VALUES
(1, 'Заборы из профлиста', 'от 1 450 руб./м.п.', '<li>Доступная цена</li>\r\n           <li>Срок службы до 50 лет</li>\r\n            <li>Защита от окружающей среды</li>\r\n           <li>Большой выбор расцветов</li>\r\n            <li>Не требует ухода</li>', 'fence-proflist.png'),
(2, '3D сетка Гиттер', 'от 980 руб./м.п.', '<li>Доступная цена</li>\r\n<li>Срок службы до 30 лет</li>\r\n<li>Пропускает солнечный свет</li>\r\n<li>Подходит для перепадов высот</li>\r\n<li>Устойчив к механическому воздействию</li>', 'fence-3d-gitter.png'),
(3, 'Заборы из сетки Рабицы', 'от 360 руб./м.п.', '<li>Низкая цена</li>\r\n           <li>Быстрый монтаж</li>\r\n           <li>Пропускает солнечный свет</li>\r\n            <li>Простота в обслуживании</li>\r\n            <li>Легко превратить в живую изгородь</li>', 'fence-rabizy.png'),
(4, 'Заборы из поликарбоната', 'от ... руб./м.п.', '<li>Не гниет и не поддается коррозии</li>\r\n<li>Отлично поглощает звук</li>\r\n<li>Пропускает солнечный свет</li>\r\n<li>Экологически чистый материал</li>\r\n<li>Визуально увеличивает участок</li>', 'fence-polycarbon.png'),
(5, 'Деревянный штакетник', 'от ... руб./м.п.', '<li>Невысокая стоимость</li>\r\n           <li>Срок эксплуатация до 15 лет</li>\r\n            <li>Большой выбор расцветок</li>\r\n            <li>Экологически чистый материал</li>\r\n           <li>Требуется ежегодное обслуживание</li>', 'fence-wood.png'),
(6, 'Металлический штакетник', 'от ... руб./м.п.', '<li>Доступная цена</li>\r\n           <li>Срок службы до 50 лет</li>\r\n            <li>Эстетический внешний вид</li>\r\n           <li>Большой выбор расцветов</li>\r\n            <li>Не требует ухода</li>', 'fence-metal.png');

-- --------------------------------------------------------

--
-- Структура таблицы `forms`
--

CREATE TABLE `forms` (
  `id` int(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `button` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forms`
--

INSERT INTO `forms` (`id`, `title`, `button`) VALUES
(1, 'Узнайте стоимость забора за 10 минут', 'Узнать стоимость'),
(2, 'Узнайте всё о заборах<br>от нашего специалиста. Перезвоним за 5 минут!', 'Получить консультацию'),
(3, 'Получите расчёт стоимости от нашего специалиста. Перезвоним за 5 минут!', 'Получить консультацию'),
(4, 'Специалист начал расчёт заполните форму, чтобы он связался с вами', 'Получить консультацию');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image`) VALUES
(1, 'Установка забора в селе Климовское', 'sl_photo2.jpg'),
(2, 'Работа над депо Сансап совместно с Simens', 'sl_photo1.jpg'),
(3, 'Установка забора в селе Климовское', 'sl_photo2.jpg'),
(4, 'Работа над депо Сансап совместно с Simens', 'sl_photo1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`title`, `value`) VALUES
('address', 'Санкт-Петербург, ул. Седова, д.7'),
('email', 'kezoneko@gmail.com'),
('phone', '8 (800) 940 11 80'),
('phone2', '8 (800) 312 - 11 - 42'),
('worktime', 'с 8:00 до 22:00 без выходных');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(88, 'kezoneko', 'a029d0df84eb5549c641e04a9ef389e5');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advantages`
--
ALTER TABLE `advantages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fence_types`
--
ALTER TABLE `fence_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`title`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advantages`
--
ALTER TABLE `advantages`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `fence_types`
--
ALTER TABLE `fence_types`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;