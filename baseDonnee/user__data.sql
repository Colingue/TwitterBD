-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 juin 2020 à 23:05
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `user__data`
--

-- --------------------------------------------------------

--
-- Structure de la table `retweet`
--

CREATE TABLE `retweet` (
  `retweet_id` int(11) NOT NULL,
  `retweet_tweet_id` int(11) DEFAULT NULL,
  `retweet_user_id` int(11) DEFAULT NULL,
  `retweet_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscriptions_id` int(11) NOT NULL,
  `subscriptions_follow_ups_id` int(11) DEFAULT NULL,
  `subscriptions_follower_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`subscriptions_id`, `subscriptions_follow_ups_id`, `subscriptions_follower_id`) VALUES
(1, 5, 6),
(2, 6, 5),
(3, 5, 2),
(4, 3, 5),
(5, 6, 1),
(6, 4, 6),
(8, 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `tweet_id` int(11) NOT NULL,
  `tweet_user_id` int(11) DEFAULT NULL,
  `tweet_like` int(11) DEFAULT NULL,
  `tweet_date` datetime DEFAULT NULL,
  `tweet_message` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`tweet_id`, `tweet_user_id`, `tweet_like`, `tweet_date`, `tweet_message`) VALUES
(9, 6, 0, '2020-06-16 18:54:09', 'Je eusis le meilleur'),
(10, 5, 0, '2020-06-16 18:58:06', 'nouvea'),
(11, 5, 0, '2020-06-16 21:50:02', 'ceci est un tweet'),
(12, 5, 0, '2020-06-16 21:50:54', 'bonjour'),
(13, 5, 0, '2020-06-16 22:41:32', 'dire'),
(14, 5, 0, '2020-06-16 22:44:25', 'oui'),
(15, 5, 0, '2020-06-16 22:47:01', 'oui'),
(16, 5, 0, '2020-06-16 22:50:05', 'oui toujours'),
(17, 5, 0, '2020-06-16 22:56:25', 'en premier de la liste'),
(18, 6, 0, '2020-06-16 23:03:08', 'je dis ça'),
(19, 6, 0, '2020-06-16 23:03:16', 'et ça !'),
(20, 6, 0, '2020-06-16 23:03:23', 'et encore ça !'),
(21, 5, 0, '2020-06-16 23:42:58', 'fe'),
(22, 5, 0, '2020-06-16 23:43:05', 'fefe'),
(23, 5, 0, '2020-06-16 23:43:12', 'feef'),
(24, 6, 0, '2020-06-16 23:55:24', 'je dis ca'),
(25, 5, 0, '2020-06-17 15:11:59', 'ad\r\n'),
(26, 5, 0, '2020-06-17 17:02:33', 'zdzd'),
(27, 5, 0, '2020-06-17 17:02:38', 'zdzd'),
(28, 5, 0, '2020-06-17 18:07:33', 'J\'aime les champigons\r\n'),
(29, 5, 0, '2020-06-17 19:23:56', 'dedede'),
(30, 5, 0, '2020-06-17 19:24:36', 'dcdcd'),
(31, 5, 0, '2020-06-17 19:24:44', 'sdss'),
(32, 5, 0, '2020-06-17 19:26:40', 'quoi de Neuf ?'),
(33, 5, 0, '2020-06-17 21:46:18', 'rien de special'),
(34, 5, 0, '2020-06-17 21:58:59', 'bonjour les amis !'),
(35, 5, 0, '2020-06-18 15:40:04', 'pas rer1'),
(36, 5, 0, '2020-06-18 15:40:17', 'jnejcej cejcccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc'),
(37, 5, 0, '2020-06-18 15:40:52', 'jnejcej cejcccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc'),
(38, 5, 0, '2020-06-18 15:41:10', 'pourquoi il ya deux fois'),
(39, 5, 0, '2020-06-18 15:41:14', 'pourquoi il ya deux fois'),
(40, 5, 0, '2020-06-18 15:42:00', '2doiois'),
(41, 5, 0, '2020-06-18 15:42:05', '2doiois'),
(42, 5, 0, '2020-06-18 15:43:18', '2doiois'),
(43, 5, 0, '2020-06-18 15:43:22', '2doiois'),
(44, 5, 0, '2020-06-18 15:44:40', 'bonjoru'),
(45, 5, 0, '2020-06-18 15:44:50', 'bonjoru'),
(46, 6, 0, '2020-06-18 16:55:43', 'ngringnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn'),
(47, 6, 0, '2020-06-18 16:56:09', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj'),
(48, 6, 0, '2020-06-18 16:56:57', 'Que dit-on en 140 caractères, que dit-on en suites de 140 caractères? Ce carnet analyse les potentialités de twitter en tant que pratique d\''),
(49, 6, 0, '2020-06-18 17:01:02', '0\r\nCONFINEMENT 202014/04/2020\r\nLe sable et la glycine\r\nOn s’éclipse furtivement, enfin on peut du moins, tous les jours un peu, pas trop loi'),
(50, 6, 0, '2020-06-18 17:02:00', 'djzbbdzbdjzbdzdbzjdbzjdbzjbdjzbdjzbjdbjzdbjkadkazbdazbdzabjdjabdazbkddazdkaznkazldazj bdzab djaz bjdzb zabjkzabjdzbjdzjkbbdjzajkbzdabbkjazdb'),
(51, 6, 0, '2020-06-18 17:02:22', 'vjvvjbvjzrjbzkehhjbkjvkzhjvzhjvhzevh jzevhjvzevhjvzevhjvhjezvhjzehvjhezjvhjzvhjvehzvhjzjedjzbbdzbdjzbdzdbzjdbzjdbzjbdjzbdjzbjdbjzdbjkadkazbd'),
(52, 6, 0, '2020-06-18 17:06:03', 'hddede'),
(53, 5, 0, '2020-06-18 20:08:40', 'bonjour'),
(54, 5, 0, '2020-06-18 20:10:14', 'efefken'),
(55, 5, 0, '2020-06-18 20:10:57', 'feknf'),
(56, 5, 0, '2020-06-18 21:55:11', 'un tweet');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `motdepasse`) VALUES
(1, 'prems', '$2y$10$HtHbod/TFC4/3xik6dogCeIyACM/xmH7cB0PfTR3CKOHZl0DYOBe2'),
(2, 'Colin03', '$2y$10$RqEDIMMjusMosQSUQE.nYO/Zd4EwzUGFQ8eKbwP0uiu2kBfGWaI0W'),
(3, 'Col', '$2y$10$jH1/nW2iRQJ4fJf0l2ISEOkN/SNdDuRgrG8YpMwa/dyiqNlj67zgC'),
(4, 'cmoi', '$2y$10$D5ccPqVSC5lPT5ThUaC07OS.aXCvUCR5Q2ckP5IVxqR9WFZmM7fd.'),
(5, 'test1', '$2y$10$6L66JNQp8I7sRYriBsxlxOujIDg2vTKtmJmZER35XbVnBafimr80.'),
(6, 'test2', '$2y$10$PvU2zTXGJQpn0oO1mgws3e9DZi.qwaYi33YIKyMXq9XNZCxfmv/eS'),
(7, 'coliene', '$2y$10$ZSQeixerYEtxmLcJEeNTW.nySJrNzWLEEJC9DgSHjCNByHd6wTiNC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `retweet`
--
ALTER TABLE `retweet`
  ADD PRIMARY KEY (`retweet_id`),
  ADD KEY `retweet_tweet_id` (`retweet_tweet_id`),
  ADD KEY `retweet_user_id` (`retweet_user_id`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscriptions_id`),
  ADD KEY `subscriptions_follow_ups_id` (`subscriptions_follow_ups_id`),
  ADD KEY `subscriptions_follower_id` (`subscriptions_follower_id`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`tweet_id`),
  ADD KEY `tweet_user_id` (`tweet_user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `retweet`
--
ALTER TABLE `retweet`
  MODIFY `retweet_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscriptions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `tweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`subscriptions_follow_ups_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`subscriptions_follower_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`tweet_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
