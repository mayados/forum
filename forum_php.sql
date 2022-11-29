-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_php
CREATE DATABASE IF NOT EXISTS `forum_php` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_php`;

-- Listage de la structure de table forum_php. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.categorie : ~4 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'Football'),
	(2, 'Animaux'),
	(3, 'Dramas Coréens'),
	(4, 'Jeux vidéo');

-- Listage de la structure de table forum_php. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texte` text NOT NULL,
  `sujet_id` int NOT NULL,
  `membre_id` int NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `sujet_id` (`sujet_id`),
  KEY `membre_id` (`membre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.post : ~5 rows (environ)
INSERT INTO `post` (`id_message`, `dateCreation`, `texte`, `sujet_id`, `membre_id`) VALUES
	(1, '2022-11-28 15:56:47', 'Ces rongeurs doivent se baigner dans du sable', 1, 2),
	(2, '2022-11-28 15:57:45', 'God Of War est bien parti pour être jeu de l\'année même s\'il est loin de mériter cette place comparé à Elden Ring', 2, 4),
	(3, '2022-11-29 15:06:08', 'Effectivement, aussi ils ont des goûts peu communs pour la nourriture, comme par exemple les pétales de rose..', 1, 6),
	(4, '2022-11-29 16:08:38', 'Qu\'en avez-vous pensé ? Personnellement j\'ai beaucoup aimé que le personnage principal reste Yumi, que ce soit son histoire et que l\'on doit accepter qu\'il y ait des personnes qui s\'en aillent', 5, 7),
	(5, '2022-11-29 16:10:11', 'J\'ai beaucoup aimé voir les cellules sous la forme de petits personnages pour mieux comprendre ce qu\'il peut se passer en nous', 5, 1);

-- Listage de la structure de table forum_php. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_sujet` int NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre` varchar(255) NOT NULL,
  `verrouillage` tinyint NOT NULL DEFAULT '0',
  `categorie_id` int NOT NULL,
  `membre_id` int NOT NULL,
  PRIMARY KEY (`id_sujet`),
  KEY `categorie_id` (`categorie_id`),
  KEY `membre_id` (`membre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.topic : ~5 rows (environ)
INSERT INTO `topic` (`id_sujet`, `dateCreation`, `titre`, `verrouillage`, `categorie_id`, `membre_id`) VALUES
	(1, '2022-11-28 15:49:28', 'Chinchillas', 0, 2, 1),
	(2, '2022-11-28 15:54:39', 'Game Awards 2022', 0, 4, 3),
	(3, '2022-11-29 14:32:02', 'Baleines', 0, 2, 5),
	(4, '2022-11-29 14:35:37', 'Portugal - Uruguay (Qatar)', 0, 1, 6),
	(5, '2022-11-29 16:06:35', 'Les cellules de Yumi', 0, 3, 7);

-- Listage de la structure de table forum_php. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_membre` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.user : ~7 rows (environ)
INSERT INTO `user` (`id_membre`, `pseudo`, `mail`, `password`, `dateInscription`, `role`) VALUES
	(1, 'chichiLou', 'loullou@gmail.com', '12345', '2022-11-28 15:51:38', 'user'),
	(2, 'leRoiDesPoulets', 'rdp@gmail.com', 'deff65', '2022-11-28 15:53:04', 'user'),
	(3, 'Elden_wrong', 'eldw@gmail.com', 'efsg6', '2022-11-28 15:54:17', 'user'),
	(4, 'LeJoueurDuPanier', 'ldasdj@gmail.com', 'efs', '2022-11-28 15:55:53', 'user'),
	(5, 'douceFleur', 'ijijug@gmail.com', 'zgghhh', '2022-11-29 14:31:29', 'user'),
	(6, 'fouDuFoot', 'cr7@gmail.com', 'n8hg4g', '2022-11-29 14:34:59', 'user'),
	(7, 'missLala', 'mimimi@gmail.com', 'ijfcyub4', '2022-11-29 16:07:00', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
