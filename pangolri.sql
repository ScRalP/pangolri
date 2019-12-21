-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 21 déc. 2019 à 00:47
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pangolri`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BA388B78D9F6D38` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `order_id`, `price`) VALUES
(2, NULL, 0),
(3, NULL, 0),
(4, NULL, 0),
(5, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'posé'),
(2, 'hard'),
(3, 'bon kdo'),
(4, 'mauvais kdo'),
(5, 'soirée d\'intégration'),
(6, 'désintégration'),
(7, 'inutiles'),
(8, 'fun');

-- --------------------------------------------------------

--
-- Structure de la table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`product_id`),
  KEY `IDX_149244D312469DE2` (`category_id`),
  KEY `IDX_149244D34584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C4584665A` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `product_id`, `author`, `description`, `date`) VALUES
(1, 5, 'HaterDu76', 'Trop nul..', '2019-12-20 23:35:56'),
(2, 7, 'HaterDu76', 'Pas assez grand pour toute ma famille, vraiment de la merde...', '2019-12-20 23:42:53'),
(3, 4, 'GoodGuy78', 'Génial!! il peut marcher tout seul et c\'est très divertissant, un must have!', '2019-12-20 23:44:45'),
(4, 9, 'GoodGuy78', 'J\'en ai acheté au moins 7, super idée de cadeau pour tout les enfants en bas âge! Ils ont adoré', '2019-12-20 23:45:47');

-- --------------------------------------------------------

--
-- Structure de la table `credit_card`
--

DROP TABLE IF EXISTS `credit_card`;
CREATE TABLE IF NOT EXISTS `credit_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `owner_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3781EC108D9F6D38` (`order_id`),
  KEY `IDX_3781EC10A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `credit_card_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6D28840DA76ED395` (`user_id`),
  KEY `IDX_6D28840D7048FD0F` (`credit_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `stock` int(11) NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `stock`, `brand`, `rate`, `images`) VALUES
(2, 'Souffleur à confettis', 'Très puissant et grande capacité de confettis, pratiques lors d\'évènements ou de grosses soirées', 329.99, 6, 'Prozic', 0, 'a:2:{i:0;s:25:\"souffleur_confettis_1.jpg\";i:1;s:25:\"souffleur_confettis_2.jpg\";}'),
(3, 'Canon à confettis', 'Lot de 6 canon a confettis à usages unique. Petit mais puissants!', 6.99, 52, 'Konfetti', 0, 'a:2:{i:0;s:21:\"canon_confettis_1.jpg\";i:1;s:21:\"canon_confettis_2.jpg\";}'),
(4, 'Véritable pangolin !!', 'Véritable pangolin à vendre!!! Il ne fait que 50cm et est en plein forme!! (oui c\'est illégal mais on diras rien tqt).', 1500, 2, NULL, 0, 'a:2:{i:0;s:14:\"pangolin_1.jpg\";i:1;s:14:\"pangolin_2.jpg\";}'),
(5, 'Lot de gobelets rouges', 'Idéales pour les soirées entre amis et pour faire des bières-pongs. Ce lot comporte 50 verres rouges de 33cl pour un maximum de beuverie!', 14.99, 23, 'TRESKO', 0, 'a:3:{i:0;s:13:\"red_cup_1.jpg\";i:1;s:13:\"red_cup_2.jpg\";i:2;s:13:\"red_cup_3.jpg\";}'),
(6, 'Casque anti-soif', 'Ce casque vous permet de rester hydrater 24h/24 et 7j/7.', 10.75, 36, NULL, 0, 'a:3:{i:0;s:20:\"casque_a_boire_1.jpg\";i:1;s:20:\"casque_a_boire_2.jpg\";i:2;s:20:\"casque_a_boire_3.jpg\";}'),
(7, 'Piscine a balle taille adulte', 'Piscine à balle 100L, adéquate pour des soirées amusantes!', 67, 7, 'Beeztees', 0, 'a:2:{i:0;s:21:\"piscine_a_balle_2.jpg\";i:1;s:21:\"piscine_a_balle_1.jpg\";}'),
(9, 'Lot de 3 mugs Shrek', 'Idéale pour offrir à de vrai fan de Shrek!', 15.8, 19, NULL, 0, 'a:3:{i:0;s:15:\"mug_shrek_1.jpg\";i:1;s:15:\"mug_shrek_2.jpg\";i:2;s:15:\"mug_shrek_3.jpg\";}'),
(10, 'Sac de confettis', 'Ce produit contient 10Kg de confettis! C\'est bientôt nouvel an, faites des provisions!!', 19.99, 22, NULL, 0, 'a:2:{i:0;s:15:\"confettis_1.jpg\";i:1;s:15:\"confettis_2.jpg\";}'),
(11, 'Balles pour piscine à balles', 'Lots de 100 balles en plastique léger de couleurs !', 9.99, 7, NULL, 0, 'a:2:{i:0;s:20:\"balles_piscine_1.jpg\";i:1;s:20:\"balles_piscine_2.jpg\";}');

-- --------------------------------------------------------

--
-- Structure de la table `product_cart`
--

DROP TABLE IF EXISTS `product_cart`;
CREATE TABLE IF NOT EXISTS `product_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_864BAA161AD5CDBF` (`cart_id`),
  KEY `IDX_864BAA164584665A` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_cart`
--

INSERT INTO `product_cart` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(1, 5, 9, 3),
(2, 5, 2, 1),
(3, 4, 3, 1),
(4, 4, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `IDX_CDFC73564584665A` (`product_id`),
  KEY `IDX_CDFC735612469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(2, 2),
(2, 5),
(2, 6),
(2, 8),
(3, 1),
(3, 3),
(3, 5),
(3, 8),
(4, 3),
(4, 4),
(4, 6),
(4, 8),
(5, 1),
(5, 5),
(5, 8),
(6, 1),
(6, 2),
(6, 5),
(6, 6),
(6, 8),
(7, 8),
(9, 3),
(9, 8),
(10, 2),
(10, 5),
(10, 6),
(10, 8),
(11, 1),
(11, 8);

-- --------------------------------------------------------

--
-- Structure de la table `product_wishlist`
--

DROP TABLE IF EXISTS `product_wishlist`;
CREATE TABLE IF NOT EXISTS `product_wishlist` (
  `product_id` int(11) NOT NULL,
  `wishlist_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`wishlist_id`),
  KEY `IDX_575140A64584665A` (`product_id`),
  KEY `IDX_575140A6FB8E54CD` (`wishlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE IF NOT EXISTS `shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_323FC9CA4C3A3BB` (`payment_id`),
  KEY `IDX_323FC9CAA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) DEFAULT NULL,
  `wishlist_id` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cellphone` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649AAA18E60` (`cellphone`),
  UNIQUE KEY `UNIQ_8D93D6491AD5CDBF` (`cart_id`),
  UNIQUE KEY `UNIQ_8D93D649FB8E54CD` (`wishlist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `cart_id`, `wishlist_id`, `username`, `email`, `cellphone`, `first_name`, `last_name`, `age`, `address`, `roles`, `password`) VALUES
(2, 2, NULL, 'user', 'user@gmail.com', '06 10 10 10 10', 'user', 'X', 19, '10 user street', '[\"ROLE_USER\"]', '$2y$13$Od1acLdZ.fZYxolby9rHf.HOYhAXkr.dIK/R0SrY5U/Jxy9oKyBLm'),
(3, 3, NULL, 'admin', 'admin@gmail.com', '06 09 09 09 09', 'admin', 'Y', 76, '10 admin street', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$yH3HQKKYSGNpgvPndZKVYuJ299rUSdAqMOCwWnVgf2eDmN7bxLyUe'),
(4, 4, NULL, 'HaterDu76', 'hater@gmail.com', '07 15 15 15 15', 'Henri', 'Delacroix', 56, 'Rue des haters', '[\"ROLE_USER\"]', '$2y$13$hQOZGMokyXZbWW9rpm8vMOk8sUU41/ncVaqp4qzUIHGext8Rqrv2i'),
(5, 5, NULL, 'GoodGuy78', 'goodguy@gmail.com', '06 15 15 15 15', 'Guy', 'Good', 20, '8 rue des jam bon', '[\"ROLE_USER\"]', '$2y$13$7EG12js4sBqiHuKtXPhvdOdo0adljj2KFOtCYGfYmN2rvRkTRuxhe');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B78D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `shop_order` (`id`);

--
-- Contraintes pour la table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `FK_149244D312469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_149244D34584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `FK_3781EC108D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `shop_order` (`id`),
  ADD CONSTRAINT `FK_3781EC10A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_6D28840D7048FD0F` FOREIGN KEY (`credit_card_id`) REFERENCES `credit_card` (`id`),
  ADD CONSTRAINT `FK_6D28840DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `product_cart`
--
ALTER TABLE `product_cart`
  ADD CONSTRAINT `FK_864BAA161AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_864BAA164584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  ADD CONSTRAINT `FK_575140A64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_575140A6FB8E54CD` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `shop_order`
--
ALTER TABLE `shop_order`
  ADD CONSTRAINT `FK_323FC9CA4C3A3BB` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `FK_323FC9CAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6491AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_8D93D649FB8E54CD` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
