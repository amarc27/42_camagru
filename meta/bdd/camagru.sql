-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 05 fév. 2020 à 09:34
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
  `mail` varchar(40) NOT NULL,
  `name` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `profile_pic` varchar(255) NOT NULL DEFAULT './public/icons/profile.png',
  `bio` varchar(140) NOT NULL,
  `activation_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mail`, `name`, `pass`, `active`, `profile_pic`, `bio`, `activation_key`) VALUES
(1, 'amarc', 'amarc@student.42.com', 'Antoine Marc', 'toto', '0', './public/images/profile.png', '', '0'),
(76, 'toto', 'mitiva9807@mailboxt.net', 'Tototo42', '$2y$10$xsTUyy527JaA8mNDe.r/UOd8q9.5Me5yXKN91XHIzRorDty4u0aCq', '1', './public/images/profile.png', 'Co-Founder, The Family\r\nthefamily.co', '0cedde00216192c3c7bef3ec268a5d52');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
