-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 fév. 2020 à 10:51
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
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(12) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `profile` varchar(255) NOT NULL DEFAULT './public/icons/profile.png',
  `bio` text,
  `activation_key` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mail`, `name`, `pass`, `active`, `profile`, `bio`, `activation_key`) VALUES
(1, 'amarc', 'amarc@student.42.com', 'Antoine Marc', 'toto', '0', './public/icons/profile.png', NULL, '0'),
(65, 'toto', 'conodo6407@reptech.org', 'Tototo42', '$2y$10$QT9f6cJYAp/zUhJnhAbDT.QtlUJqgwZ86osJCl80CUrRqDTkwMTla', '1', './public/icons/profile.png', NULL, 'f701467c8871e5ffe374eaebff977ef1'),
(71, 'FourtyTwo', 'mokitib266@allmtr.com', 'FourtyTwo42', '$2y$10$.672zF.j.aAXV81JMdJYDez1rSu9MwRICfzzG9zIkyzqiXJy4FpAm', '1', './public/icons/profile.png', NULL, '81314bc5e002407791506868bb4a826b');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
