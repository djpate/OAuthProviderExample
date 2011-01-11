-- phpMyAdmin SQL Dump
-- version 3.3.7deb3build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 11 Janvier 2011 à 09:41
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `oauthProvider`
--

-- --------------------------------------------------------

--
-- Structure de la table `access_token`
--

CREATE TABLE IF NOT EXISTS `access_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_secret` varchar(255) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consumer_id` (`consumer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `access_token`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `consumer_nonce`
--


-- --------------------------------------------------------

--
-- Structure de la table `request_token`
--

CREATE TABLE IF NOT EXISTS `request_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_secret` varchar(255) NOT NULL,
  `callback_url` text NOT NULL,
  `verifier` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consumer_id` (`consumer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `request_token`
--

INSERT INTO `request_token` (`id`, `consumer_id`, `token`, `token_secret`, `callback_url`, `verifier`) VALUES
(8, 1, '43e87ef19d7bdbccf2eb3e9adaecc3669eda4edd', '5f8b58d97e2db09f59bc55a616e3ece8d0ed246d', 'http://localhost/', ''),
(9, 1, '415993405fb01da44eb19657bfeffcfda06fb5d0', '05d981bdabcde3fdab6d2eeec5abe977e8463aa9', 'http://localhost/', ''),
(10, 1, '1648df8bdd7120ac012b187141b1fa24967daefe', 'e454f04fec6c98ac869513b8db69124b26359d00', 'http://localhost/', ''),
(11, 1, '392bf4b8c18a14fa0bb869f792b99c2d57866b01', '644399998d9e62c7274f5c7f2806930df89dffdd', 'http://localhost/', ''),
(12, 1, 'ecf240b5cafccfdcde04d186ad45e10eaf8197ae', 'c35f686e1af0a5c0031dc2d9afec21e159be2ad2', 'http://localhost/', ''),
(13, 1, '7dc0a434455ef4c62994a3d4a0d00942f5d46da3', 'e95151a995fde61add1bbe597fc263dc9c929a2b', 'http://localhost/', ''),
(14, 1, '2b18c19ef68313d724146af9c315407c4086e8b9', '49543d0d418456b3a5144aa484f03b2f9ef05c75', 'http://localhost/', ''),
(15, 1, '418d9d6280ca515af60ecc9c52f1025580bb5486', 'a73226b5cb002afcaa902bcccc4e7802040751e1', 'http://localhost/', ''),
(16, 1, '21e562c46410ab1123455efd087467e9de4c3fc1', 'dc31859d7bf173a08e912abd4d49b7333c44f829', 'http://localhost/', ''),
(17, 1, '300427983e8262275e80d79338744d86c9ccfcb3', 'a3a4dd6001d801a844494f8f47e8740550f40c38', 'http://localhost/', ''),
(18, 1, '9ba2f9dd8abead9d03ed050194393a953a3aa013', '033120ede275e110458b5f52473f89ba5654c259', 'http://localhost/', ''),
(19, 1, 'ada0f81a0a2ac5cda1414962ce2fb07233140468', '000faf616200531c707123e3759b646239db1041', 'http://localhost/', ''),
(20, 1, '589386cab150a10e49715cd0579f6d363c4c33dd', '85cd0662f988d02a4710865cfb2a3106dfade9c7', 'http://localhost/', ''),
(21, 1, 'aa298a18875e0bcae71211eb9ce20ac72a899aef', '3cc8c0512c3243f34004e5a218dc6190e022bc8b', 'http://localhost/', ''),
(22, 1, '78287a5cbee23dbe8b0b2e18f5ff394b10fbbacf', '2839ad97425f8a302ee591e479f00f6f64f86476', 'http://localhost/', '153cb6bb2fad2ace420838a0c64aad84338f06b2'),
(23, 1, '9c1ee6dcc21fb0e8ca9480ccb00c2bdcf2d5998b', '3d6418ca58df98ec8106e536d935ffaf6fcc3fb3', 'http://localhost/', ''),
(24, 1, 'dcbb27b67a11f89552f8c5848f4dad2734b4cc75', '767368589efbe939dc96dd18f433807724ff7efb', 'http://localhost/', ''),
(25, 1, 'dea31739c9818a161942e88be2cccc2d951a467a', 'b6b324e3903e4705fbb01561cfa7c71037b666b3', 'http://localhost/', '');

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
-- Contraintes pour la table `access_token`
--
ALTER TABLE `access_token`
  ADD CONSTRAINT `access_token_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `consumer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `access_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `consumer_nonce`
--
ALTER TABLE `consumer_nonce`
  ADD CONSTRAINT `consumer_nonce_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `consumer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `request_token`
--
ALTER TABLE `request_token`
  ADD CONSTRAINT `request_token_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `consumer` (`id`) ON DELETE CASCADE;

