-- phpMyAdmin SQL Dump
-- version 3.3.7deb3build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 11 Janvier 2011 à 16:20
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `oauthProvider`
--

-- --------------------------------------------------------

--
-- Structure de la table `consumer`
--

CREATE TABLE IF NOT EXISTS `consumer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_key` varchar(255) NOT NULL,
  `consumer_secret` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `consumer`
--

INSERT INTO `consumer` (`id`, `consumer_key`, `consumer_secret`, `active`) VALUES
(1, 'key', 'secret', 1);

-- --------------------------------------------------------

--
-- Structure de la table `consumer_nonce`
--

CREATE TABLE IF NOT EXISTS `consumer_nonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_id` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `nonce` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consumer_id` (`consumer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `consumer_nonce`
--

INSERT INTO `consumer_nonce` (`id`, `consumer_id`, `timestamp`, `nonce`) VALUES
(1, 1, 1294757729, '2976154794d2c6f618bc483.23732359'),
(2, 1, 1294757751, '10509176314d2c6f77ad4275.55071316'),
(3, 1, 1294757838, '18660214244d2c6fcec0a1a7.65990300'),
(4, 1, 1294758269, '11599848504d2c717d881e99.02414189'),
(5, 1, 1294758336, '19224957604d2c71c0589d10.49233830'),
(6, 1, 1294759020, '6687229184d2c746cc32bc5.31210714'),
(7, 1, 1294759040, '10019149574d2c7480a2ffe7.01479224');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_secret` varchar(255) NOT NULL,
  `callback_url` text NOT NULL,
  `verifier` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consumer_id` (`consumer_id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `token`
--

INSERT INTO `token` (`id`, `type`, `consumer_id`, `user_id`, `token`, `token_secret`, `callback_url`, `verifier`) VALUES
(1, 1, 1, 1, '06197f5330f83fdce9942634a2da74e126bb6db5', 'b13bcba3adf8d11265122e84ab4d6a2c984bb522', 'http://localhost/OAuthProviderExample/client/callback.php', '01c5b4d116b93503892c4eef8a9beb2903785f10'),
(2, 1, 1, 1, 'c7732f64edf63cba8c11426cfd06306bdb9a2d05', '4b67e09bd13e57695a5c37603d20088613864878', 'http://localhost/OAuthProviderExample/client/callback.php', '632e0db933a2dfe9621ee6fe0dade187e311b061');

-- --------------------------------------------------------

--
-- Structure de la table `token_type`
--

CREATE TABLE IF NOT EXISTS `token_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `token_type`
--

INSERT INTO `token_type` (`id`, `type`) VALUES
(1, 'request'),
(2, 'access');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`) VALUES
(1, 'test');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `consumer_nonce`
--
ALTER TABLE `consumer_nonce`
  ADD CONSTRAINT `consumer_nonce_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `consumer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_2` FOREIGN KEY (`type`) REFERENCES `token_type` (`id`),
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `consumer` (`id`) ON DELETE CASCADE;

