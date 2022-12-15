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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.categorie : ~5 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'Football'),
	(2, 'Animaux'),
	(4, 'Jeux vidéo'),
	(5, 'dramas coréens'),
	(6, 'Soin de la peau');

-- Listage de la structure de table forum_php. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texte` text NOT NULL,
  `topic_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `membre_id` (`user_id`) USING BTREE,
  KEY `sujet_id` (`topic_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.post : ~51 rows (environ)
INSERT INTO `post` (`id_post`, `dateCreation`, `texte`, `topic_id`, `user_id`) VALUES
	(2, '2022-11-28 15:57:45', 'God Of War est bien parti pour être jeu de l\'année même s\'il est loin de mériter cette place comparé à Elden Ring', 2, 4),
	(4, '2022-11-29 16:08:38', 'Qu\'en avez-vous pensé ? Personnellement j\'ai beaucoup aimé que le personnage principal reste Yumi, que ce soit son histoire et que l\'on doit accepter qu\'il y ait des personnes qui s\'en aillent', 5, 7),
	(5, '2022-11-29 16:10:11', 'J\'ai beaucoup aimé voir les cellules sous la forme de petits personnages pour mieux comprendre ce qu\'il peut se passer en nous', 5, 1),
	(18, '2022-12-02 10:34:25', 'L&#39;Allemagne éliminée suite à la victoire du Japon', 67, 3),
	(19, '2022-12-02 10:40:25', 'Les Capybaras sont de grands et gentils rongeurs', 68, 3),
	(20, '2022-12-02 10:42:50', 'En France, nous n&#39;avons pas le droit de les adopter, et pourtant on pourrait leur sauver la vie', 69, 3),
	(21, '2022-12-07 16:41:58', 'D&#39;ailleurs, ça me fait penser à Hamtaro', 70, 12),
	(22, '2022-12-08 09:45:55', 'De grands chats..n&#39;est-ce pas ?', 71, 13),
	(23, '2022-12-08 09:58:24', 'Très beau match face à la Suisse !', 72, 14),
	(24, '2022-12-08 15:01:28', 'Oui c&#39;est dommage', 69, 14),
	(25, '2022-12-08 15:17:19', 'un Hotel mysterieux', 77, 14),
	(26, '2022-12-08 15:17:40', 'Bien vrai', 77, 14),
	(27, '2022-12-08 15:18:20', 'un drama qui traite d&#39;une pathologie', 78, 14),
	(29, '2022-12-08 15:53:15', 'A wonderful story of a simple life', 80, 14),
	(30, '2022-12-08 15:55:41', 'Vous pensez que le brésil va laminer les Croates ?', 81, 14),
	(31, '2022-12-08 15:56:05', '(Comme ils l&#39;ont fait à la Corée du Sud)', 81, 14),
	(32, '2022-12-09 08:47:07', 'dermatite', 82, 14),
	(33, '2022-12-09 08:52:50', 'Elles sont géantes mais très gentilles', 83, 14),
	(34, '2022-12-09 08:58:23', 'Un excellent drama, je pense que c&#39;est mon préféré !', 84, 14),
	(35, '2022-12-09 09:44:04', 'Ils sont très respectés dans les pays d&#39;Asie', 85, 14),
	(36, '2022-12-09 09:44:04', 'Ils sont très respectés dans les pays d&#39;Asie', 85, 14),
	(37, '2022-12-09 09:46:38', 'A quand le 3ème opus ?', 86, 14),
	(38, '2022-12-09 09:50:50', 'Essayez la crème d&#39;aloé vera quand votre peau est sèche', 87, 14),
	(39, '2022-12-09 09:50:50', 'Essayez la crème d&#39;aloé vera quand votre peau est sèche', 87, 14),
	(40, '2022-12-09 10:03:17', 'Grand oiseau', 88, 14),
	(41, '2022-12-09 10:15:22', 'Double Fine a récemment partagé des vidéos des essais de pouvoir de Raz !', 86, 14),
	(42, '2022-12-09 11:01:50', 'Nous sommes déjà aux quarts de finale !', 89, 14),
	(43, '2022-12-09 11:21:47', 'Ils ont aussi l&#39;air très protecteurs', 68, 14),
	(44, '2022-12-09 11:24:02', 'Oui ! On espère qu&#39;ils vont jouer aussi bien en quarts de finale !', 72, 14),
	(45, '2022-12-09 11:24:45', 'Lili Dogen Raz', 86, 14),
	(46, '2022-12-09 11:35:48', 'Une histoire passionnante et des graphismes très sympas', 90, 14),
	(47, '2022-12-09 11:37:21', 'Encore un post pour un test', 85, 14),
	(48, '2022-12-09 11:37:43', 'Quand on teste, on doit se parler tout seul', 84, 14),
	(49, '2022-12-09 11:38:11', 'Oui ! Qu&#39;est-ce que c&#39;est animé dans ce topic !', 89, 14),
	(50, '2022-12-09 11:38:37', 'Encore un post pour cette Session, on y croit !', 90, 14),
	(51, '2022-12-09 11:53:55', 'Parmi les 3 opus, celuici est mon favori', 91, 14),
	(52, '2022-12-09 11:55:22', 'tres doux', 92, 14),
	(53, '2022-12-09 13:22:25', 'Test Test Test', 85, 14),
	(54, '2022-12-09 13:26:07', 'Une crème hydratante pour la dermatite atopique', 93, 14),
	(55, '2022-12-09 13:29:24', 'commentaire', 88, 14),
	(56, '2022-12-09 13:29:51', 'dzdzdz', 84, 14),
	(57, '2022-12-09 13:30:10', 'ggggg', 85, 14),
	(59, '2022-12-09 13:34:50', 'Les zèbres communs ont des rayures noires et blanches, ils proviennent du continent Africain', 94, 14),
	(60, '2022-12-09 13:38:41', '94', 94, 14),
	(61, '2022-12-09 14:07:33', '94', 94, 14),
	(63, '2022-12-09 15:45:55', 'okamitest', 90, 14),
	(64, '2022-12-13 13:53:23', 'Vous avez raison, j&#39;ai essayé et ma peau va beaucoup mieux !&#13;&#10;', 87, 12),
	(66, '2022-12-14 09:28:56', 'Oui ! Bonne chance aux équipes encore en compétition !', 89, 12),
	(67, '2022-12-14 13:50:24', 'Essai nouveau post', 94, 14),
	(68, '2022-12-14 15:14:08', 'test zebre&#13;&#10;', 94, 14),
	(69, '2022-12-14 16:54:20', 'test compter messages', 94, 14);

-- Listage de la structure de table forum_php. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre` varchar(255) NOT NULL,
  `verrouillage` tinyint NOT NULL DEFAULT '0',
  `categorie_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `categorie_id` (`categorie_id`),
  KEY `membre_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.topic : ~24 rows (environ)
INSERT INTO `topic` (`id_topic`, `dateCreation`, `titre`, `verrouillage`, `categorie_id`, `user_id`) VALUES
	(2, '2022-11-28 15:54:39', 'Game Awards 2022', 1, 4, 3),
	(67, '2022-12-02 10:34:25', 'Victoire du Japon face à l&#39;Espagne', 0, 1, 3),
	(68, '2022-12-02 10:40:25', 'Capybara', 0, 2, 3),
	(69, '2022-12-02 10:42:50', 'Herrissons', 1, 2, 3),
	(70, '2022-12-07 16:41:58', 'Hamster', 1, 2, 12),
	(71, '2022-12-08 09:45:55', 'Tigre', 1, 2, 13),
	(72, '2022-12-08 09:58:24', 'Portugal en quart de finale de la coupe du monde', 0, 1, 14),
	(77, '2022-12-08 15:17:19', 'Hotel del luna', 1, 5, 14),
	(78, '2022-12-08 15:18:20', 'Clean it with Passion for now', 1, 5, 14),
	(80, '2022-12-08 15:53:15', 'Yumi&#39;s Cells', 1, 5, 14),
	(81, '2022-12-08 15:55:41', 'Croatie contre Brésil (coupe du monde)', 1, 1, 14),
	(82, '2022-12-09 08:47:07', 'eczema', 0, 6, 14),
	(83, '2022-12-09 08:52:50', 'Girafe', 1, 2, 14),
	(84, '2022-12-09 08:58:23', '30 but 17', 0, 5, 14),
	(85, '2022-12-09 09:44:04', 'Elephant', 0, 2, 14),
	(86, '2022-12-09 09:46:38', 'Psychonauts', 0, 4, 14),
	(87, '2022-12-09 09:50:50', 'Aloe verra', 0, 6, 14),
	(88, '2022-12-09 10:03:17', 'Autruche', 0, 2, 14),
	(89, '2022-12-09 11:01:50', 'Quarts de finale', 1, 1, 14),
	(90, '2022-12-09 11:35:48', 'Okami', 0, 4, 14),
	(91, '2022-12-09 11:53:55', 'Reply 1988', 0, 5, 14),
	(92, '2022-12-09 11:55:22', 'Argan', 0, 6, 14),
	(93, '2022-12-09 13:26:07', 'Dexeryl', 0, 6, 14),
	(94, '2022-12-09 13:34:50', 'zebres communs d&#39;Afrique', 0, 2, 14);

-- Listage de la structure de table forum_php. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_php.user : ~13 rows (environ)
INSERT INTO `user` (`id_user`, `pseudo`, `mail`, `password`, `dateInscription`, `role`) VALUES
	(1, 'chichiLou', 'loullou@gmail.com', '12345', '2022-11-28 15:51:38', 'user'),
	(2, 'leRoiDesPoulets', 'rdp@gmail.com', 'deff65', '2022-11-28 15:53:04', 'user'),
	(3, 'Elden_wrong', 'eldw@gmail.com', 'efsg6', '2022-11-28 15:54:17', 'user'),
	(4, 'LeJoueurDuPanier', 'ldasdj@gmail.com', 'efs', '2022-11-28 15:55:53', 'user'),
	(6, 'fouDuFoot', 'cr7@gmail.com', 'n8hg4g', '2022-11-29 14:34:59', 'user'),
	(7, 'missLala', 'mimimi@gmail.com', 'ijfcyub4', '2022-11-29 16:07:00', 'user'),
	(8, 'dédé', 'dedede@gmail.com', 'az', '2022-12-02 16:06:02', 'role'),
	(9, 'didi', 'didid@gmail.com', '$2y$10$XYfx/S26/zWBD.FTh1.x3eK.PPN4yI71wOKf.73COYLvfVDBipMFm', '2022-12-02 16:08:28', 'role'),
	(10, 'maya', 'yayaydo@gmail.com', '$2y$10$Nk2V010AiRdEwtWMs7Xj7.2Fzg/hv..i.O7/dgQOR/eL30cwniIaa', '2022-12-02 16:24:34', 'role'),
	(11, 'moma', 'moma@gmail.com', '$2y$10$YcpeV8xKlI.3eOOWj5.GeumvOToD.Ap9J2KtUrw9o00WIocOd79Dy', '2022-12-02 16:27:04', 'role'),
	(12, 'ma', 'ma@gmail.com', '$2y$10$WZf0zXkkUIaylQsgr5fY/ujgmNYVxWxHYQEKO1NwVg/l/wgwlB5zu', '2022-12-07 16:39:19', 'admin'),
	(14, 'mu', 'mu@gmail.com', '$2y$10$NF7fsySVwLKjHFViwUScOuTpoKCIeP1vTAEvAEvdo.2nyDOX4pz9G', '2022-12-08 09:57:33', 'user'),
	(16, 'li', 'li@gmail.com', '$2y$10$8RfEfZD7bYBe9dhcTVDMBe2sbj1rCTUnfQwMShyMtZfX6rR0WH2N6', '2022-12-09 15:54:16', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
