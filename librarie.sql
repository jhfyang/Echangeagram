-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 08 Mai 2016 à 23:52
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `librarie`
--

-- --------------------------------------------------------

--
-- Structure de la table `albumphoto`
--

CREATE TABLE IF NOT EXISTS `albumphoto` (
  `id_album` int(11) NOT NULL,
  `email` text NOT NULL,
  `idphoto` int(11) NOT NULL,
  `id_albumphoto` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_albumphoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `albumphoto`
--

INSERT INTO `albumphoto` (`id_album`, `email`, `idphoto`, `id_albumphoto`) VALUES
(1, 'nicolas@hotmail.fr', 20, 1),
(3, 'nicolas@hotmail.fr', 3, 5),
(3, 'nicolas@hotmail.fr', 20, 6),
(8, 'yang@hotmail.fr', 25, 8),
(1, 'nicolas@hotmail.fr', 17, 9),
(1, 'nicolas@hotmail.fr', 17, 10),
(8, 'yang@hotmail.fr', 25, 11),
(1, 'nicolas@hotmail.fr', 20, 12),
(8, 'nicolas@hotmail.fr', 17, 13),
(8, 'nicolas@hotmail.fr', 3, 14),
(8, 'nicolas@hotmail.fr', 20, 15),
(8, 'yang@hotmail.fr', 25, 16),
(9, 'yang@hotmail.fr', 25, 17),
(10, 'balzer@hotmail.fr', 27, 18),
(10, 'balzer@hotmail.fr', 26, 19),
(11, 'balzer@hotmail.fr', 30, 20),
(11, 'balzer@hotmail.fr', 29, 21);

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `email` text NOT NULL,
  `titre_album` text NOT NULL,
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `statut` int(1) NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `albums`
--

INSERT INTO `albums` (`email`, `titre_album`, `id_album`, `statut`) VALUES
('nicolas@hotmail.fr', 'albumtest', 1, 0),
('nicolas@hotmail.fr', 'fhuhfeihfi', 3, 0),
('yang@hotmail.fr', 'yolo', 8, 0),
('yang@hotmail.fr', 'zadazdazd', 9, 0),
('balzer@hotmail.fr', 'Jeux :D ', 10, 0),
('balzer@hotmail.fr', 'testprivÃ©Ã©', 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE IF NOT EXISTS `favoris` (
  `email` varchar(25) NOT NULL,
  `idphoto` int(11) NOT NULL,
  `id_favoris` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_favoris`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `favoris`
--

INSERT INTO `favoris` (`email`, `idphoto`, `id_favoris`) VALUES
('nicolas@hotmail.fr', 18, 3),
('nicolas@hotmail.fr', 17, 7),
('yang@hotmail.fr', 21, 12),
('yang@hotmail.fr', 25, 13),
('yang@hotmail.fr', 25, 14),
('yang@hotmail.fr', 17, 15);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `idphoto` int(50) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `commentaire` text NOT NULL,
  `path` varchar(50) NOT NULL,
  `titre_photo` text NOT NULL,
  PRIMARY KEY (`idphoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`idphoto`, `lieu`, `date`, `statut`, `theme`, `email`, `commentaire`, `path`, `titre_photo`) VALUES
(3, 'paris', '2016-04-14', 0, 'th1', 'nicolas@hotmail.fr', ' ', 'images/japon.jpg', 'Le Japon la vie'),
(17, ' ', '2016-04-21', 0, 'th1', 'nicolas@hotmail.fr', '  ', 'images/009 - The Elder Scrolls.jpg', 'Casque Skyrim'),
(18, 'doekdoekdoekodk', '2016-04-21', 1, 'th3', 'nicolas@hotmail.fr', ' Description de la photo dkeodkoekdoe', 'images/082 - Pac Man.jpg', 'Art appliquer digne des mecs des arts'),
(20, 'starwars', '2016-04-21', 0, 'th3', 'nicolas@hotmail.fr', ' Description de la photodzadazdazd', 'images/19.jpg', 'light sabers!!!!'),
(21, 'texas', '2016-04-21', 0, 'th2', 'nicolas@hotmail.fr', ' Description de la photo', 'images/usa.jpg', 'Ce coucher de soleil magnifique'),
(25, 'Niseko', '2016-04-21', 0, 'th2', 'yang@hotmail.fr', ' Description de la photo', 'images/snow_snow.jpg', 'Snowboard'),
(26, 'games', '2016-04-21', 0, 'th3', 'balzer@hotmail.fr', 'Ce jeux est magnifique', 'images/14.jpg', 'Halo Hero'),
(27, 'intergalactic', '2016-04-21', 0, 'th3', 'balzer@hotmail.fr', 'Pew PEw PEW PEW ', 'images/15.jpg', 'PEW PEW PEW PEW PEW PEW '),
(28, 'house', '2016-04-21', 0, 'th6', 'balzer@hotmail.fr', ' Description de la photofafaf', 'images/tortillacat.jpg', 'tortilla cate'),
(29, 'azdazd', '2016-04-21', 0, 'th1', 'balzer@hotmail.fr', ' Description de la photodazdazd', 'images/afrique.jpg', 'dazdaz'),
(30, 'thailand', '0000-00-00', 0, 'th1', 'balzer@hotmail.fr', 'le zbeul', 'images/mehdi_strippeur.jpg', 'Party in thailanddd'),
(31, 'games', '0000-00-00', 0, 'th3', 'balzer@hotmail.fr', ' Description de la photodzdazd', 'images/082 - Pac Man.jpg', 'trop de pacman');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(1000) DEFAULT NULL,
  `date` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `profil_picture` varchar(100) NOT NULL DEFAULT 'images/profil_start.jpg',
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`email`, `pass`, `nom`, `prenom`, `date`, `sex`, `profil_picture`, `admin`) VALUES
('nicolas@hotmail.fr', 'azerty', 'chouteau', 'jojo', '1/1/1916', 'h', 'profil/008 - Fallout.png', 1),
('balzer@hotmail.fr', 'bababa', 'balzer', 'cedric', '1/1/1916', '', 'profil/cedric_content.jpg', 0),
('yang@hotmail.fr', 'bababa', 'jeong', 'yang', '1/1/1916', 'h', 'images/profil_start.jpg', 1),
('laetitia@hotmail.fr', 'bababa', 'morere', 'laeti', '1/1/1916', 'f', 'images/profil_start.jpg', 0),
('babar@hotmail.fr', 'bababa', 'bg', 'babar', '1/1/1916', 'h', 'images/profil_start.jpg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
