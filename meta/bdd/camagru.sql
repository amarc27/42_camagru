-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 fév. 2020 à 12:21
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
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id_img` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `like` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id_img`, `id_user`, `img`, `date`, `like`) VALUES
(24, 83, 'public/picture/toto/toto(4).png', '2020-02-18 18:01:56', 0),
(25, 83, 'public/picture/toto/toto(5).png', '2020-02-18 18:02:05', 0),
(26, 83, 'public/picture/toto/toto(6).png', '2020-02-18 18:24:34', 0),
(27, 83, 'public/picture/toto/toto(7).png', '2020-02-18 18:26:58', 0),
(28, 83, 'public/picture/toto/toto(8).png', '2020-02-18 22:18:35', 0),
(29, 83, 'public/picture/toto/toto(9).png', '2020-02-19 16:50:10', 0),
(31, 83, 'public/picture/toto/toto(11).png', '2020-02-19 17:42:24', 0),
(32, 83, 'public/picture/toto/toto(12).png', '2020-02-19 18:03:04', 0),
(33, 83, 'public/picture/toto/toto(13).png', '2020-02-19 18:03:26', 0),
(36, 83, 'public/picture/toto/toto(14).png', '2020-02-24 19:43:47', 0),
(37, 83, 'public/picture/toto/toto(15).png', '2020-02-24 19:43:50', 0),
(38, 83, 'public/picture/toto/toto(16).png', '2020-02-24 19:43:52', 0),
(39, 83, 'public/picture/toto/toto(17).png', '2020-02-24 19:44:02', 0),
(40, 83, 'public/picture/toto/toto(18).png', '2020-02-24 19:44:06', 0),
(41, 83, 'public/picture/toto/toto(19).png', '2020-02-24 19:44:08', 0);

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
(3, 'mask', './public/stickers/mask.png', './public/stickers/maskLabel.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(12) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `name` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `profile_pic` varchar(255) NOT NULL DEFAULT './public/images/profile.png',
  `bio` varchar(140) NOT NULL,
  `activation_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mail`, `name`, `pass`, `active`, `profile_pic`, `bio`, `activation_key`) VALUES
(1, 'amarc', 'amarc@student.42.com', 'Antoine Marc', 'toto', '0', './public/images/profile.png', '', '0'),
(77, 'dodo', 'dasoh77092@mailmink.com', 'Antoine dada', '$2y$10$Donxz.IzXD8wAZ9p562t5.HUJmwHpWIXHe.8Lz8DpSiFJpJo5yb1G', '1', './public/images/profile.png', 'Bonjour, Lorem ipsum. dada est a la playaaaaaa !', '9ab10b51520e5217dd44f8e14e8be912'),
(82, 'titi', 'weyos16275@jmail7.com', 'Tototo42', '$2y$10$PFEFSdhNg3tv5S15LfwTquThHU7gaikojaoQ072DrRSeCCGZq.jB.', '1', './public/images/profile.png', 'Coding in progress...', 'd6585e715e9a1e2f83313d20eb0ececa'),
(83, 'toto', 'hiyim64412@link3mail.com', 'Caesar', '$2y$10$JrtEZNG1Nqf1gm0/7FjEuO9MNnLE4Xubu8XSztQVsAXb386gZBeBm', '1', './public/images/profile.png', 'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum', '0b4c1c9a1846e4b01857d8b355d88269');

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `sticker`
--
ALTER TABLE `sticker`
  MODIFY `id_sticker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
