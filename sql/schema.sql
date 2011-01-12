-- phpMyAdmin SQL Dump
-- version 3.3.7deb3build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 12 Janvier 2011 à 16:46
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `consumer_nonce`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `token`
--


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
