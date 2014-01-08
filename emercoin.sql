-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 08 2014 г., 21:36
-- Версия сервера: 5.5.33a-MariaDB
-- Версия PHP: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `emercoin`
--
CREATE DATABASE IF NOT EXISTS `emercoin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `emercoin`;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;


-- --------------------------------------------------------

--
-- Структура таблицы `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ammount` int(10) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY `order_id_2` (`order_id`,`product_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payback_admin`
--

CREATE TABLE IF NOT EXISTS `payback_admin` (
  `password` varchar(40) NOT NULL,
  `address` varchar(34) NOT NULL,
  `ammount` double(16,6) NOT NULL DEFAULT '10.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payback_admin`
--

INSERT INTO `payback_admin` (`password`, `address`, `ammount`) VALUES
('21232f297a57a5a743894a0e4a801fc3', 'EQLYz6CUoqwLuyc8EyPTom7jnSGNomKXbu', 10.000000);

-- --------------------------------------------------------

--
-- Структура таблицы `payback_transactions`
--

CREATE TABLE IF NOT EXISTS `payback_transactions` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ammount` double(16,6) NOT NULL DEFAULT '0.000000',
  `address` varchar(34) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` double(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `user_ip` char(15) NOT NULL,
  `skey` char(32) NOT NULL,
  `data` mediumblob,
  `_edited` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `valid` char(3) DEFAULT NULL,
  PRIMARY KEY (`skey`),
  UNIQUE KEY `skey_2` (`skey`),
  KEY `user_ip` (`user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
