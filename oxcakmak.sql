-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for oxcakmak
CREATE DATABASE IF NOT EXISTS `oxcakmak` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci */;
USE `oxcakmak`;

-- Dumping structure for table oxcakmak.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `picture` char(100) COLLATE utf8_turkish_ci DEFAULT 'assets/index/images/default.png',
  `slug` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` char(160) COLLATE utf8_turkish_ci DEFAULT NULL,
  `createDate` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `modifyDate` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- Dumping data for table oxcakmak.article: 1 rows
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `picture`, `slug`, `title`, `content`, `description`, `createDate`, `modifyDate`) VALUES
	(1, 'http://localhost/assets/file/2023-03-11/166c4e33e350206d83e68cd5f8f3dcc0f4fb4b0b.jpeg', 'test', 'test', '<p>test2</p>\n', 'test', '11.03.2023-14:25', '11.03.2023-14:28');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table oxcakmak.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` char(6) COLLATE utf8_turkish_ci DEFAULT 'config',
  `title` char(75) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` char(160) COLLATE utf8_turkish_ci DEFAULT NULL,
  `footer` char(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `phone` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` char(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `address` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bannerTitle` char(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bannerParagraph` char(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bannerBtnText` char(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bannerBtnAddress` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `bannerBtnStatus` enum('yes','no') COLLATE utf8_turkish_ci DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- Dumping data for table oxcakmak.config: 1 rows
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `name`, `title`, `description`, `footer`, `phone`, `email`, `address`, `bannerTitle`, `bannerParagraph`, `bannerBtnText`, `bannerBtnAddress`, `bannerBtnStatus`) VALUES
	(1, 'config', 'Freelancer Web Yazılımcısı', 'Web tasarım ve programlama alanın da uzman php yazılımcısı bir freelancer ile profesyonel web tasarım, profosyonel web yazılım hizmeti arıyorsanız doğru yerdesi', 'Tüm Hakları Saklıdır.', '+90 262 606 0829', 'info@oxcakmak.com', 'Sultan Orhan Mah. Gebze, KOCAELİ', 'OXCAKMAK', 'Web tasarım ve programlama alanın da uzman php yazılımcısı bir freelancer ile profesyonel web tasarım, profosyonel web yazılım hizmeti arıyorsanız doğru yerdesiniz.', 'iletişim', '#', 'no');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Dumping structure for table oxcakmak.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` tinyint(10) NOT NULL AUTO_INCREMENT,
  `hash` char(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `name` char(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `folder` char(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `location` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `link` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `createDate` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- Dumping data for table oxcakmak.file: 0 rows
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id`, `hash`, `name`, `folder`, `location`, `link`, `createDate`) VALUES
	(1, '166c4e33e350206d83e68cd5f8f3dcc0f4fb4b0b', '166c4e33e350206d83e68cd5f8f3dcc0f4fb4b0b.jpeg', '2023-03-11', 'assets/file/2023-03-11/166c4e33e350206d83e68cd5f8f3dcc0f4fb4b0b.jpeg', 'http://localhost/assets/file/2023-03-11/166c4e33e350206d83e68cd5f8f3dcc0f4fb4b0b.jpeg', '11.03.2023-14:25');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table oxcakmak.page
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `slug` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` char(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` char(160) COLLATE utf8_turkish_ci DEFAULT NULL,
  `nav` enum('main','sub') COLLATE utf8_turkish_ci DEFAULT 'main' COMMENT '0no1main2sub',
  `footer` enum('yes','no') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'no' COMMENT '0no1yes',
  `createDate` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `modifyDate` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- Dumping data for table oxcakmak.page: 1 rows
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` (`id`, `slug`, `title`, `content`, `description`, `nav`, `footer`, `createDate`, `modifyDate`) VALUES
	(1, 'test', 'test', '<p>test</p>\n', 'test', 'main', 'yes', '11.03.2023-14:24', '11.03.2023-14:24');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;

-- Dumping structure for table oxcakmak.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `username` char(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` char(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `password` char(40) COLLATE utf8_turkish_ci DEFAULT NULL,
  `resetCode` char(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- Dumping data for table oxcakmak.user: 1 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `email`, `password`, `resetCode`) VALUES
	(1, 'admin', 'admin@hotmail.com', '6da5e1e6dcf7685b3ae3bb1b67da6618', 'yQX8MCYnT19QwW39SYfk');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
