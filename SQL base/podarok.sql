-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.45 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных podarok
DROP DATABASE IF EXISTS `podarok`;
CREATE DATABASE IF NOT EXISTS `podarok` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `podarok`;


-- Дамп структуры для таблица podarok.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы podarok.category: ~0 rows (приблизительно)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.comment
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_p` int(11) NOT NULL DEFAULT '0',
  `id_u` int(11) NOT NULL DEFAULT '0',
  `comment` varchar(1000) NOT NULL DEFAULT '0',
  `rating` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_comment_product` (`id_p`),
  CONSTRAINT `FK_comment_product` FOREIGN KEY (`id_p`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы podarok.comment: ~0 rows (приблизительно)
DELETE FROM `comment`;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.image
DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_p` int(11) NOT NULL DEFAULT '0',
  `osn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_image_product` (`id_p`),
  CONSTRAINT `FK_image_product` FOREIGN KEY (`id_p`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы podarok.image: ~0 rows (приблизительно)
DELETE FROM `image`;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.order
DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='status 1-ожидаеться 2-закрыт 3-потвердить';

-- Дамп данных таблицы podarok.order: ~3 rows (приблизительно)
DELETE FROM `order`;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id`, `id_u`, `status`, `date`) VALUES
	(12, 1, 2, '2016-03-20'),
	(13, 1, 1, '2016-03-20'),
	(14, 1, 1, '2016-03-20');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `id_sr` int(11) NOT NULL DEFAULT '0',
  `id_s` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `description` varchar(1000) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_s_category` (`id_s`),
  CONSTRAINT `FK_product_s_category` FOREIGN KEY (`id_s`) REFERENCES `s_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='id_sr- статистика продукта';

-- Дамп данных таблицы podarok.product: ~0 rows (приблизительно)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.p_order
DROP TABLE IF EXISTS `p_order`;
CREATE TABLE IF NOT EXISTS `p_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_t` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `col` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `id_o` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_p_order_order` (`id_o`),
  CONSTRAINT `FK_p_order_order` FOREIGN KEY (`id_o`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='Товары к одном заказе id_o номер основного заказа';

-- Дамп данных таблицы podarok.p_order: ~0 rows (приблизительно)
DELETE FROM `p_order`;
/*!40000 ALTER TABLE `p_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `p_order` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.s_category
DROP TABLE IF EXISTS `s_category`;
CREATE TABLE IF NOT EXISTS `s_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `id_c` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_s_category_category` (`id_c`),
  CONSTRAINT `FK_s_category_category` FOREIGN KEY (`id_c`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы podarok.s_category: ~0 rows (приблизительно)
DELETE FROM `s_category`;
/*!40000 ALTER TABLE `s_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `s_category` ENABLE KEYS */;


-- Дамп структуры для таблица podarok.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы podarok.users: ~2 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `login`, `password`, `email`, `active`) VALUES
	(1, 'Иван', 'Ivan', '3d7b3d97350a5342e48bccc2a97d6764', 'Ivan@Ivan.Ivan', 1),
	(3, 'Степа', 'Stepa', 'bd056813981cef90d7981551eef74379', 'qw@qw', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
