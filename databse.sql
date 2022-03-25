-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table basni..comments: ~1 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `poem_id`, `author_id`, `text`, `date`) VALUES
	(6, 22, 3, 'To je dobré', '2020-04-30 13:49:21');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping data for table basni..poems: ~0 rows (approximately)
/*!40000 ALTER TABLE `poems` DISABLE KEYS */;
INSERT INTO `poems` (`id`, `owner_id`, `heading`, `content`, `owner_full_name`, `date`) VALUES
	(22, 3, 'Moja mama', 'Tvoja mam ', 'a', '2020-04-30 13:50:42');
/*!40000 ALTER TABLE `poems` ENABLE KEYS */;

-- Dumping data for table basni..users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`, `name`, `last_name`, `age`, `email`, `description`) VALUES
	(3, 'Admin', '$2y$10$.twNemyVpOJf62bZBA2hQuk1PBT7x63bS/vFNqPwAEYLYNGUWEpmW	', 'Michal', 'Dzurík', 16, 'misko7104@gmail.com', 'Volám sa Michal mám 16 rokov. Ak sa pozeráš na túto stránku tak ti ďakujem '),
	(38, 'MaxZal', '$2y$10$mdD9wn1f8nEosFvOSD2K4uECMCSQ1HzGGin5/76u4FRFq8L2QAtKC	', 'Max', 'Záletný', 55, 'max@gmail.com', 'More kiko ');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
