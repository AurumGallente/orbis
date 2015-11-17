-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 17 2015 г., 19:50
-- Версия сервера: 5.1.73-community-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `orbis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `listener`
--

CREATE TABLE IF NOT EXISTS `listener` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listenerName` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `listenerTitle` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `listenerMsg` text CHARACTER SET cp1251 NOT NULL,
  `status` int(11) DEFAULT NULL,
  `reporterAnswer` text CHARACTER SET cp1251 NOT NULL,
  `createTime` int(20) NOT NULL,
  `moderatedTime` int(20) NOT NULL,
  `answeredTime` int(20) NOT NULL,
  `del` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `listener`
--

INSERT INTO `listener` (`id`, `listenerName`, `listenerTitle`, `listenerMsg`, `status`, `reporterAnswer`, `createTime`, `moderatedTime`, `answeredTime`, `del`) VALUES
(1, 'sarma 1', 'test 1', 'Yii — это высокоэффективный основанный на компонентной структуре PHP-фреймворк для разработки масштабных веб-приложений.', 3, 'answer to sarma 1', 1431084837, 1431085026, 1431085011, 1),
(2, 'sarma 2', 'test 2', 'Он позволяет максимально применить концепцию повторного использования кода и может существенно ускорить процесс веб-разработки.', 1, 'answer to sarma 2', 1431084867, 1431084988, 1431085016, 1),
(3, 'sarma 3', 'test 3', 'Данное учебное пособие описывает процесс создания блога, показанного в демонстрационном приложении, которое можно найти в архиве с фреймворком.', 2, '', 1431084885, 1431084992, 0, 2),
(4, 'sarma 4', 'test 4', 'Каждый шаг разработки описан подробно и может быть применён при создании других приложений. В дополнение к полному руководству и API, данное пособие показывает, вместо полного и подробного описания, пример практического применения Yii.', 1, '', 1431084913, 1431084996, 0, 1),
(5, 'sarma 5', 'test 5', 'Для того, чтобы читать данное пособие, не обязательно знать Yii. Тем не менее, начальное знание объектно-ориентированного программирования и баз данных помогут легче понять материал.', 0, '', 1431084937, 0, 0, 0),
(6, 'sarma 6', 'test 6', 'В данном разделе мы опишем создание основы приложения, которая будет служить нашей отправной точкой.', 0, '', 1431084967, 0, 0, 0),
(7, 'sarma N', 'sarma N', 'test N', 0, '', 1433147387, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
