-- --------------------------------------------------------
-- Hostiteľ:                     127.0.0.1
-- Verze serveru:                10.4.22-MariaDB - mariadb.org binary distribution
-- OS serveru:                   Win64
-- HeidiSQL Verzia:              11.0.0.6097
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportování struktury databáze pro
CREATE DATABASE IF NOT EXISTS `basni.` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `basni.`;

-- Exportování struktury pro tabulka basni..comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poem_id` int(11) NOT NULL DEFAULT 0,
  `author_id` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT curdate(),
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Exportování dat pro tabulku basni..comments: ~0 rows (přibližně)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `poem_id`, `author_id`, `text`, `date`) VALUES
	(6, 22, 3, 'To je dobré', '2020-04-30'),
	(7, 25, 39, 'Hello', '2022-03-25'),
	(8, 27, 40, 'Krásna báseň, vskutku', '2022-03-25');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Exportování struktury pro tabulka basni..poems
CREATE TABLE IF NOT EXISTS `poems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `heading` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `owner_full_name` text DEFAULT NULL,
  `date` date DEFAULT curdate(),
  `public` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Exportování dat pro tabulku basni..poems: ~1 rows (přibližně)
/*!40000 ALTER TABLE `poems` DISABLE KEYS */;
INSERT INTO `poems` (`id`, `owner_id`, `heading`, `content`, `owner_full_name`, `date`, `public`) VALUES
	(22, 3, 'Moja mama', 'Tvoja mam ', 'a', '2020-04-30', 0);
/*!40000 ALTER TABLE `poems` ENABLE KEYS */;

-- Exportování struktury pro tabulka basni..users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` tinytext NOT NULL DEFAULT '',
  `password` text NOT NULL DEFAULT '',
  `name` text NOT NULL DEFAULT '',
  `last_name` text NOT NULL DEFAULT '',
  `email` text NOT NULL DEFAULT '',
  `description` text NOT NULL DEFAULT '',
  `age` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- Exportování dat pro tabulku basni..users: ~2 rows (přibližně)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`, `name`, `last_name`, `email`, `description`, `age`) VALUES
	(3, 'Admin', '$2y$10$.twNemyVpOJf62bZBA2hQuk1PBT7x63bS/vFNqPwAEYLYNGUWEpmW	', 'Michal', 'Dzurík', 'misko7104@gmail.com', 'Volám sa Michal mám 16 rokov. Ak sa pozeráš na túto stránku tak ti ďakujem ', 16),
	(38, 'MaxZal', '$2y$10$mdD9wn1f8nEosFvOSD2K4uECMCSQ1HzGGin5/76u4FRFq8L2QAtKC	', 'Max', 'Záletný', 'max@gmail.com', 'More kiko ', 55),
	(39, 'jano', '$2y$10$Tx/0sg88j9kPynCfcfSkI.Ki1cLk4xAQ.31dnv/dcxG/AEnWQ5d5C	', 'Michal Dzurík', 'Dzurík', 'mob@gmail.com', 'Hello there', 18),
	(40, 'michal', '$2y$10$6p7EcYOueQBB.tq7Zke0ceCmlp7qE8xGhggJJbKAE7EuCMNc8d4bO	', 'Michal', 'Dzurík', 'mail@gmail.com', 'Som študent na strednej škole', 18);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
