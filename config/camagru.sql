-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 05 mars 2020 à 06:59
-- Version du serveur :  5.6.43
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_com` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_com`, `id_user`, `id_img`, `text`, `date`) VALUES
(2, 83, 48, 'toto', '2020-02-26 19:13:47'),
(3, 77, 47, 'ICI DODO', '2020-02-26 19:14:19'),
(4, 77, 48, 'Non ! Dodo est la !', '2020-02-26 19:14:38'),
(5, 77, 32, 'Magnifique tonton <3', '2020-02-27 13:45:11'),
(6, 77, 32, 'J\'adore', '2020-02-27 13:45:36'),
(10, 77, 32, 'Viva 42', '2020-02-27 13:45:51'),
(34, 83, 32, 'yes\r\n', '2020-02-27 18:54:42'),
(36, 83, 32, 'top\r\n', '2020-02-27 19:39:44'),
(39, 82, 32, 'Je suis la aussi !\r\n', '2020-02-27 21:21:21'),
(40, 83, 32, 'salut\r\n', '2020-02-28 14:40:36'),
(42, 84, 48, 'yesssss\r\n', '2020-02-29 15:07:18'),
(43, 84, 50, 'yes', '2020-02-29 15:34:00'),
(44, 84, 50, 'yes', '2020-02-29 15:34:44'),
(45, 84, 50, 'yes', '2020-02-29 15:34:49'),
(46, 84, 50, 'no', '2020-02-29 15:36:30'),
(47, 84, 50, 'no', '2020-02-29 15:39:50'),
(48, 84, 50, 'houhou\r\n', '2020-02-29 15:39:56'),
(49, 84, 50, 'ergerret', '2020-02-29 15:41:12'),
(50, 84, 50, 'wefcg', '2020-02-29 15:42:06'),
(51, 84, 50, 'dsfhvt', '2020-02-29 15:45:26'),
(52, 84, 50, 'dsfhvt', '2020-02-29 15:45:54'),
(53, 84, 50, 'dsfhvt', '2020-02-29 15:46:07'),
(54, 84, 50, 'dsfhvt', '2020-02-29 15:46:22'),
(55, 84, 50, 'opopopop', '2020-02-29 15:48:45'),
(56, 84, 50, 'opopopop', '2020-02-29 15:49:36'),
(57, 84, 50, 'opopopop', '2020-02-29 15:49:54'),
(58, 84, 50, 'opopopop', '2020-02-29 15:50:47'),
(59, 84, 50, 'qwqqwq', '2020-02-29 15:51:55'),
(60, 84, 50, 'qwqqwq', '2020-02-29 15:52:52'),
(61, 84, 50, 'qwqqwq', '2020-02-29 15:53:17'),
(62, 84, 50, 'qwqqwq', '2020-02-29 15:53:26'),
(63, 84, 50, 'qwqqwq', '2020-02-29 15:53:27'),
(64, 84, 50, 'tutututu', '2020-02-29 15:54:06'),
(65, 84, 50, 'pqpqpqpqpq', '2020-02-29 15:54:48'),
(66, 84, 50, 'eryerrety', '2020-02-29 15:56:16'),
(67, 84, 50, 'eryerrety', '2020-02-29 15:57:21'),
(68, 84, 50, 'eryerrety', '2020-02-29 15:57:49'),
(69, 84, 50, 'eryerrety', '2020-02-29 15:58:42'),
(70, 84, 50, 'ahahahaha', '2020-02-29 15:58:48'),
(71, 84, 50, 'ohohohohohho', '2020-02-29 15:59:13'),
(72, 84, 40, 'ahahahahahah', '2020-02-29 16:02:34'),
(77, 77, 44, 'amazing', '2020-03-02 18:44:41'),
(82, 77, 48, 'Je teste la reception des mails', '2020-03-03 18:57:36'),
(104, 84, 51, 'toto', '2020-03-03 21:46:28'),
(105, 83, 47, 'Alex tu t\'es raté', '2020-03-04 16:09:59'),
(106, 83, 54, 'Quasi fini Camagru', '2020-03-04 16:10:39'),
(107, 77, 55, 'Amazing filter !', '2020-03-04 17:17:51'),
(108, 83, 55, 'Wow je confirme', '2020-03-04 17:23:18'),
(121, 83, 62, 'Amazing George Lucas !', '2020-03-04 19:19:56'),
(124, 83, 57, 'Billion dollar unicorn boy', '2020-03-04 19:32:44');

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `liked` enum('0','1') NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_img`, `liked`, `date`) VALUES
(23, 83, 46, '1', '2020-02-26 17:35:46'),
(26, 77, 44, '1', '2020-02-26 17:36:51'),
(27, 77, 43, '1', '2020-02-26 17:36:52'),
(28, 77, 46, '1', '2020-02-26 17:36:53'),
(30, 77, 48, '1', '2020-02-27 12:56:10'),
(31, 83, 47, '1', '2020-03-02 13:56:55'),
(48, 83, 40, '1', '2020-03-02 15:34:08'),
(65, 83, 48, '1', '2020-03-03 14:46:47'),
(66, 83, 32, '1', '2020-03-03 18:18:42'),
(69, 83, 54, '1', '2020-03-04 16:11:02'),
(70, 83, 54, '1', '2020-03-04 16:11:21'),
(71, 77, 56, '1', '2020-03-04 17:15:23'),
(72, 83, 57, '1', '2020-03-04 19:32:53');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id_img` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `like` int(11) NOT NULL DEFAULT '0',
  `id_com` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id_img`, `id_user`, `img`, `date`, `like`, `id_com`) VALUES
(24, 83, 'public/picture/toto/toto(4).png', '2020-02-18 18:01:56', 0, 0),
(25, 83, 'public/picture/toto/toto(5).png', '2020-02-18 18:02:05', 0, 0),
(26, 83, 'public/picture/toto/toto(6).png', '2020-02-18 18:24:34', 0, 0),
(27, 83, 'public/picture/toto/toto(7).png', '2020-02-18 18:26:58', 0, 0),
(28, 83, 'public/picture/toto/toto(8).png', '2020-02-18 22:18:35', 0, 0),
(29, 83, 'public/picture/toto/toto(9).png', '2020-02-19 16:50:10', 0, 0),
(31, 83, 'public/picture/toto/toto(11).png', '2020-02-19 17:42:24', 0, 0),
(32, 83, 'public/picture/toto/toto(12).png', '2020-02-19 18:03:04', 0, 0),
(33, 83, 'public/picture/toto/toto(13).png', '2020-02-19 18:03:26', 0, 0),
(36, 83, 'public/picture/toto/toto(14).png', '2020-02-24 19:43:47', 0, 0),
(37, 83, 'public/picture/toto/toto(15).png', '2020-02-24 19:43:50', 0, 0),
(38, 83, 'public/picture/toto/toto(16).png', '2020-02-24 19:43:52', 0, 0),
(39, 83, 'public/picture/toto/toto(17).png', '2020-02-24 19:44:02', 0, 0),
(40, 83, 'public/picture/toto/toto(18).png', '2020-02-24 19:44:06', 0, 0),
(41, 83, 'public/picture/toto/toto(19).png', '2020-02-24 19:44:08', 0, 0),
(42, 83, 'public/picture/toto/toto(20).png', '2020-02-25 16:19:26', 0, 0),
(45, 83, 'public/picture/toto/toto(23).png', '2020-02-25 16:20:01', 0, 0),
(47, 83, 'public/picture/toto/toto(25).png', '2020-02-26 17:30:05', 0, 0),
(48, 83, 'public/picture/toto/toto(26).png', '2020-02-26 17:30:48', 0, 0),
(51, 77, 'public/picture/dodo/dodo(1).png', '2020-03-03 19:01:26', 0, 0),
(52, 84, 'public/picture/Cecece92/Cecece92(3).png', '2020-03-03 21:36:34', 0, 0),
(53, 84, 'public/picture/Cecece92/Cecece92(4).png', '2020-03-03 21:36:40', 0, 0),
(54, 84, 'public/picture/Cecece92/Cecece92(5).png', '2020-03-03 21:36:46', 0, 0),
(55, 77, 'public/picture/toto/toto(27).png', '2020-03-04 17:13:28', 0, 0),
(56, 77, 'public/picture/toto/toto(28).png', '2020-03-04 17:13:41', 0, 0),
(57, 77, 'public/picture/toto/toto(29).png', '2020-03-04 17:13:47', 0, 0),
(58, 82, 'public/picture/toto/toto(30).png', '2020-03-04 18:50:08', 0, 0),
(59, 82, 'public/picture/toto/toto(31).png', '2020-03-04 18:53:48', 0, 0),
(60, 84, 'public/picture/toto/toto(32).png', '2020-03-04 19:18:38', 0, 0),
(62, 84, 'public/picture/toto/toto(34).png', '2020-03-04 19:18:57', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sticker`
--

CREATE TABLE `sticker` (
  `id_sticker` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img_sticker` varchar(255) DEFAULT NULL,
  `sticker_label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sticker`
--

INSERT INTO `sticker` (`id_sticker`, `name`, `img_sticker`, `sticker_label`) VALUES
(1, '42', './public/stickers/42.png', './public/stickers/42Label.png'),
(2, 'glasses', './public/stickers/glasses.png', './public/stickers/glassesLabel.png'),
(3, 'mask', './public/stickers/mask.png', './public/stickers/maskLabel.png'),
(4, 'eiffel', './public/stickers/eiffel.png', './public/stickers/eiffelLabel.png'),
(5, 'hearts', './public/stickers/hearts.png', './public/stickers/heartsLabel.png'),
(6, 'stars', './public/stickers/stars.png', './public/stickers/starsLabel.png'),
(7, 'starwars', './public/stickers/starwars.png', './public/stickers/starwarsLabel.png'),
(8, 'unicorn', './public/stickers/unicorn.png', './public/stickers/unicornLabel.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(12) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `receive_mail` enum('0','1') NOT NULL DEFAULT '1',
  `name` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `profile_pic` varchar(255) NOT NULL DEFAULT './public/images/profile.png',
  `bio` varchar(140) DEFAULT NULL,
  `activation_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mail`, `receive_mail`, `name`, `pass`, `active`, `profile_pic`, `bio`, `activation_key`) VALUES
(1, 'amarc', 'amarc@student.42.com', '1', 'Antoine Marc', 'toto', '0', './public/images/profile.png', '', '0'),
(77, 'dodo', 'sapiko3820@mytrumail.com', '1', 'Antoine dada', '$2y$10$Donxz.IzXD8wAZ9p562t5.HUJmwHpWIXHe.8Lz8DpSiFJpJo5yb1G', '1', './public/images/profile.png', 'Bonjour, Lorem ipsum. dada est a la playaaaaaa !', '9ab10b51520e5217dd44f8e14e8be912'),
(82, 'titi', 'weyos16275@jmail7.com', '1', 'Tototo42', '$2y$10$PFEFSdhNg3tv5S15LfwTquThHU7gaikojaoQ072DrRSeCCGZq.jB.', '1', './public/images/profile.png', 'Coding in progress...', 'd6585e715e9a1e2f83313d20eb0ececa'),
(83, 'toto', 'dasoh77092@mailmink.com', '1', 'Caesar', '$2y$10$vlfIipKLlE7AGGF5b5vhmu8eebjmBZoV/wlVW5z/7bhIqzokV4Twm', '1', './public/images/profile.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim', '7a313934224504b09e8cb432897c095d'),
(84, 'cecece92', 'lokame4699@smlmail.net', '1', 'New York', '$2y$10$JYtoHG/sKG0Wl0S689BaTO3d/3PpE2WdNHRasO7d6O.gU9PkaErmW', '1', './public/images/profile.png', 'Chrysler Tower', 'e08f0287f0e7ce57d6711a70989cf9f5');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_com`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id_like`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id_img`);

--
-- Index pour la table `sticker`
--
ALTER TABLE `sticker`
  ADD PRIMARY KEY (`id_sticker`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT pour la table `like`
--
ALTER TABLE `like`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `sticker`
--
ALTER TABLE `sticker`
  MODIFY `id_sticker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
