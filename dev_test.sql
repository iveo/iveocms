-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 10 Février 2013 à 15:10
-- Version du serveur: 5.1.65
-- Version de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dev_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `hostime_admin_note`
--

CREATE TABLE IF NOT EXISTS `hostime_admin_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `com` text NOT NULL,
  `stamp` int(11) NOT NULL,
  `on` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `hostime_admin_note`
--

INSERT INTO `hostime_admin_note` (`id`, `user`, `com`, `stamp`, `on`) VALUES
(1, 'root', 'test', 0, 0),
(2, 'root', 'test2', 0, 0),
(3, 'root', 'test3', 1359578061, 0),
(4, 'root', 'Hey, 1er message de l\\''administration, U mad ?', 1359578404, 1),
(5, 'root', 'j\\''aime la choucroute ', 1359581483, 1),
(6, 'root', 'J\\''ai mon zizi tout dur :3', 1359622105, 1),
(7, 'Ghost', 'Ghost buster', 1359656710, 1),
(8, 'moogooza', 'Bonjour,\r\n\r\nJe me présente.\r\nJe m\\''appel MoOgOoZA et euh c\\''est tout.', 1359805717, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hostime_config`
--

CREATE TABLE IF NOT EXISTS `hostime_config` (
  `nomsite` varchar(50) NOT NULL,
  `gratuite` float NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hostime_config`
--

INSERT INTO `hostime_config` (`nomsite`, `gratuite`) VALUES
('Hostime', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hostime_domaine`
--

CREATE TABLE IF NOT EXISTS `hostime_domaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ext` varchar(50) NOT NULL,
  `annee` int(11) NOT NULL,
  `achat` float NOT NULL,
  `renouv` float NOT NULL,
  `trans` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `hostime_domaine`
--

INSERT INTO `hostime_domaine` (`id`, `ext`, `annee`, `achat`, `renouv`, `trans`) VALUES
(1, '.com', 1, 12.99, 12.99, 12.99),
(2, '.net', 1, 12.99, 12.99, 12.99),
(3, '.biz', 1, 12.99, 12.99, 12.99),
(4, '.us', 2, 12.99, 12.99, 12.99),
(5, '.co.uk', 1, 16, 12.99, 12.99),
(6, '.info', 2, 12.99, 12.99, 12.99),
(7, '.org', 2, 16, 12.99, 12.99),
(8, '.pk', 3, 12.99, 12.99, 12.99),
(9, '.com.pk', 2, 16, 12.99, 12.99),
(12, '.jp', 2, 12.99, 12.99, 12.99),
(13, '.ws', 1, 12.99, 12.99, 12.99),
(15, '.com.de', 1, 12.99, 12.99, 12.99),
(16, '.mx', 1, 12.99, 12.99, 12.99),
(17, '.com.mx', 3, 12.99, 12.99, 12.99),
(18, '.co.za', 1, 12.99, 12.99, 12.99),
(20, '.pro', 3, 12.99, 12.99, 12.99),
(21, '.cc', 1, 12.99, 12.99, 12.99),
(23, '.org.uk', 1, 12.99, 12.99, 12.99),
(24, '.asia', 1, 12.99, 12.99, 12.99),
(25, '.tel', 1, 12.99, 12.99, 12.99),
(26, '.com', 2, 12.99, 12.99, 12.99),
(27, '.com', 3, 12.99, 12.99, 12.99),
(28, '.net', 2, 12.99, 12.99, 12.99),
(29, '.net', 3, 12.99, 12.99, 12.99);

-- --------------------------------------------------------

--
-- Structure de la table `hostime_hebergement`
--

CREATE TABLE IF NOT EXISTS `hostime_hebergement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `duree` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `hostime_hebergement`
--

INSERT INTO `hostime_hebergement` (`id`, `nom`, `prix`, `duree`) VALUES
(1, 'Basique', 0, 0),
(2, 'Standart', 1, 0),
(3, 'Premium', 2, 0),
(5, 'Best''ime', 3, 0),
(6, 'Best''ime+', 34, 1),
(4, 'Premium+', 22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hostime_hebergement_file`
--

CREATE TABLE IF NOT EXISTS `hostime_hebergement_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `validated` int(11) NOT NULL DEFAULT '-1',
  `stamp` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `sousdom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `hostime_hebergement_file`
--

INSERT INTO `hostime_hebergement_file` (`id`, `validated`, `stamp`, `userid`, `user`, `sousdom`) VALUES
(5, -1, 1359236040, 11, 'moogooza', 'momo');

-- --------------------------------------------------------

--
-- Structure de la table `hostime_paypal_log`
--

CREATE TABLE IF NOT EXISTS `hostime_paypal_log` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(19) NOT NULL,
  `payer_email` varchar(75) NOT NULL,
  `mc_gross` float(9,2) NOT NULL,
  `user` varchar(50) NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `txn_id` (`txn_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `hostime_paypal_log`
--

INSERT INTO `hostime_paypal_log` (`order_id`, `txn_id`, `payer_email`, `mc_gross`, `user`) VALUES
(1, '21261744', 'buyer@paypalsandbox.com', 1.30, ''),
(2, '21261745', 'buyer@paypalsandbox.com', 1.30, ''),
(3, '18A8741525424362K', 'julien-boone@hotmail.com', 1.30, ''),
(4, '461282054', 'buyer@paypalsandbox.com', 10.60, 'root'),
(5, '461282069', 'buyer@paypalsandbox.com', 31.00, 'root'),
(6, '461282070', 'buyer@paypalsandbox.com', 31.00, 'root');

-- --------------------------------------------------------

--
-- Structure de la table `hostime_support_pm`
--

CREATE TABLE IF NOT EXISTS `hostime_support_pm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `stamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `hostime_support_tickets`
--

CREATE TABLE IF NOT EXISTS `hostime_support_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `date` int(11) NOT NULL,
  `user` text NOT NULL,
  `user_vip` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `hostime_support_tickets`
--

INSERT INTO `hostime_support_tickets` (`id`, `sujet`, `nom`, `detail`, `date`, `user`, `user_vip`, `actif`) VALUES
(1, 'Probleme de connection à son compte', 'bonjour', 'Ceci est un test ', 0, '', 0, 1),
(2, 'Probleme de connection à son compte', 'jn', 'Expliquez ici votre probleme ou posez tout simplement votre question ', 0, '', 0, 1),
(3, 'Probleme vis à vis des commandes', 'oinjnv', 'coup de boule clavier', 0, '', 0, 1),
(4, 'Probleme vis à vis des commandes', 'oinjnv', 'coup de boule clavier', 0, '', 0, 1),
(5, 'Probleme de connection à son compte', '', 'Expliquez ici votre probleme ou posez tout simplement votre question ', 0, '', 0, 1),
(6, 'Probleme de connection à  son compte', 'fvfv', 'Expliquez ici votre probleme ou r', 0, '', 0, 1),
(7, 'Probleme de connection Ã  son compte', 'fvfv', 'Expliquez ici votre preczecobleme ou r', 0, '', 0, 1),
(8, 'Probleme de connection Ã  son compte', 'fvfv', 'Expliquez ici votre preczecobleme ou r', 0, '', 0, 1),
(9, '', '', '', 0, '', 0, 1),
(10, 'Réseau', 'mou ', 'Expliquez ici votre probleme ou posez tout simplement votre question ', 0, '', 0, 1),
(11, '', '', '', 0, '', 0, 1),
(12, 'Probleme de connection Ã  son compte', '', 'Expliquez ici votre probleme ou posez tout simplement votre question ', 0, '', 0, 1),
(13, 'Probleme de connection à son compte', 'root@hostime.eu', 'oooo', 0, '', 0, 1),
(14, 'Probleme de connection à son compte', 'root@hostime.eu', 'oooooooooo', 0, '', 0, 1),
(15, ' htmlspecialchars(Probleme de connection à son com', ' htmlspecialchars(root@hostime.eu)', ' htmlspecialchars(<a>bonjour</a>)', 0, '', 0, 1),
(16, ' htmlentities(Probleme de connection à son compte)', ' htmlentities(root@hostime.eu)', ' htmlentities(<a> bonjour)', 0, '', 0, 1),
(17, 'Probleme de connection à son compte', 'root@hostime.eu', '<a>', 0, '', 0, 1),
(18, 'Probleme de connection à son compte', 'root@hostime.eu', 'test', 0, '', 0, 1),
(19, 'Probleme de connection à son compte', 'root@hostime.eu', 'testheure', 0, '', 0, 1),
(20, 'Probleme de connection à son compte', 'root@hostime.eu', 're testheure', 0, '', 0, 1),
(21, 'Probleme de connection à son compte', 'root@hostime.eu', 'kzec,nesbfbsfn esfkjb', 1358892829, '', 0, 0),
(22, 'Réseau', 'root@hostime.eu', 'coucoy <3', 1359561710, '', 0, 1),
(23, 'Probleme de connection à son compte', 'root@hostime.eu', 'test', 1359564043, '', 0, 1),
(24, 'Probleme de connection à son compte', 'root@hostime.eu', 'test2', 1359564212, '', 0, 1),
(25, 'Probleme de connection à son compte', 'root@hostime.eu', 'test2', 1359564285, '', 0, 1),
(26, 'Probleme vis à vis des commandes', 'root@hostime.eu', 'coucou c''est mogo', 1359564393, '', 0, 1),
(27, 'Probleme de connection à son compte', 'caca', ' mad?', 1359565318, '', 0, 0),
(28, 'Probleme de connection à son compte', 'root@hostime.eu', 'bonjour. ''-''', 1359579235, 'root', 0, 1),
(29, 'Probleme de connection à son compte', 'root@hostime.eu', 'test456', 1359580176, 'root', 1, 1),
(30, 'Probleme de connection à son compte', 'root@hostime.eu', 'é_é ".', 1359581992, 'root', 1, 1),
(31, 'Probleme de connection à son compte', 'root@hostime.eu', 'ba je test :D', 1359804432, 'root', 1, 1),
(32, 'Réseau', 'root@hostime.eu', 'ba test 1 actif', 1359804608, 'root', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hostime_users`
--

CREATE TABLE IF NOT EXISTS `hostime_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `last_co` int(11) NOT NULL,
  `inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tokens` float NOT NULL DEFAULT '0',
  `vip` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(300) CHARACTER SET utf8 NOT NULL,
  `root` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(32) CHARACTER SET utf8 NOT NULL,
  `suspendu` int(11) NOT NULL,
  `suspend_stamp` int(11) NOT NULL,
  `suspender_id` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `hostime_users`
--

INSERT INTO `hostime_users` (`id`, `user`, `pwd`, `email`, `last_co`, `inscription`, `tokens`, `vip`, `nom`, `prenom`, `adresse`, `root`, `ip`, `suspendu`, `suspend_stamp`, `suspender_id`) VALUES
(1, 'root', '21232f297a57a5a743894a0e4a801fc3', 'root@hostime.eu', 1360418934, '2013-01-16 21:24:26', 71.2, 1, 'Web', 'Master', 'Hostime', 1, '87.89.220.98', 0, 0, '0'),
(8, 'bolosse', '73c18c59a39b18382081ec00bb456d43', 'ad@gg', 1358614553, '2013-01-19 16:55:53', 0, 0, 'nom', 'prenom', 'Belgique |-| 77 |-| 44', 0, '', 1, 1359699570, 'root'),
(9, 'caca', '88cbc990f555585c848f265d56bbb85a', 'ghost@moul.eu', 1358716758, '2013-01-20 21:19:18', 0, 0, 'Nizet', 'Guillaume', 'Autre |-| ta soeur |-| glaglagla', 0, '81.244.163.200', 0, 0, '0'),
(10, 'CrQck3d', '43a8c4485cdcd681997570035abb0873', 'hardcore91540@gmail.fr', 1358880044, '2013-01-22 18:40:44', 0, 0, 'Choppy', 'Thibaut', 'France |-| 91540 |-| 1 rue fort oiseau', 0, '88.168.90.3', 1, 1359805741, 'moogooza'),
(11, 'moogooza', '721a9b52bfceacc503c056e3b9b93cfa', 'thomas-ga@hotmail.fr', 1360074137, '2013-01-23 17:49:05', 0, 0, 'ma couille droite', 'thomas', 'France |-| 99999 |-| sdf', 1, '86.64.10.166', 0, 0, '0'),
(12, 'Ghost', 'e471ae8c7ecb2cc5db62016cdba1af13', 'ghost@hostime.eu', 1359660016, '2013-01-31 16:41:14', 0, 0, 'Boone', 'Cédric', 'Belgique |-| 7760 |-| Rue des écoles, 9', 1, '81.244.57.147', 0, 0, '0'),
(13, 'crazy sponge', '10ce59726d45de443f96bc25bb37a808', 'crazysponge50@gmail.com', 1359660168, '2013-01-31 18:26:58', 0, 1, 'jolaine', 'guillaume', 'France |-| 50300 |-| 9 allé du loji', 1, '87.89.220.98', 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `hostime_users_hebergement`
--

CREATE TABLE IF NOT EXISTS `hostime_users_hebergement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `offre_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `cpanel_user` varchar(80) NOT NULL,
  `cpanel_pwd` varchar(50) NOT NULL,
  `domaine` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `hostime_users_hebergement`
--

INSERT INTO `hostime_users_hebergement` (`id`, `user_id`, `offre_id`, `start`, `expire`, `ip`, `cpanel_user`, `cpanel_pwd`, `domaine`) VALUES
(1, 1, 5, 1358546154, 1390082154, '91.244.ooo', 'https://cpanel1.hostime.eu:2083', '', 'dev'),
(2, 1, 1, 1359478279, 1451407879, '##', 'root', 'blabla', 'cpanel1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
