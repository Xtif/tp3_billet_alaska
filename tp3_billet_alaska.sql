-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2017 at 05:54 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp3_billet_alaska`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonnes_newsletter`
--

CREATE TABLE `abonnes_newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abonnes_newsletter`
--

INSERT INTO `abonnes_newsletter` (`id`, `email`) VALUES
(3, 'thibault.fiacre@gmail.com'),
(5, 'thibault.fiacre@kidsempowerment.org'),
(19, 'vqdsvs@qdf.fr'),
(18, 'eaer@egaerg.fr'),
(17, 'test@test.fr'),
(20, 'reggze@fj.ersr'),
(21, 'ezrg@gul.rfh'),
(22, 'erg@aega.eg'),
(23, 'erger@earg.ga');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `date_publication` datetime NOT NULL,
  `contenu` text NOT NULL,
  `nbre_signalements` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `episode_id`, `etat`, `auteur`, `date_publication`, `contenu`, `nbre_signalements`) VALUES
(79, 28, 1, 'lzhflz', '2017-10-12 16:12:49', 'lzjherlhejnd', 6),
(80, 28, 0, 'kjehfkerjhnelrezgez', '2017-10-13 09:40:33', 'zerhzrhrhzrz', 1),
(81, 28, 1, 'zrhrzhrzhzrhzrh', '2017-10-13 09:40:37', 'zrhzrhzrhzrh', 5),
(82, 28, 0, 'zrhzrhzrhzrh', '2017-10-13 09:40:41', 'zrhzrhzrhrzhrz', 1),
(83, 28, 0, 'zrhzrhrzh', '2017-10-13 09:40:45', 'zrhzrhrhzz', 2),
(84, 28, 0, 'Le supprimé', '2017-10-13 09:40:55', 'le supprimé etet', 1),
(85, 28, 1, 'grg', '2017-10-13 14:37:45', 'ezgzerg', 1),
(86, 58, 1, 'etjhtyjt', '2017-10-13 15:18:20', 'jtrjrtjrt', 1),
(87, 28, 1, 'ergrg', '2017-10-13 18:03:38', 'egeg', 0),
(88, 28, 1, 'tghjg', '2017-10-13 18:04:36', 'gfjfgj', 0),
(89, 28, 1, 'eerer', '2017-10-13 18:04:43', 'eerer', 0),
(90, 28, 1, 'era', '2017-10-13 18:05:49', 'qdgd', 1),
(91, 28, 1, 'rrhrhre', '2017-10-14 14:27:47', 'rzhrzhrzh', 1),
(92, 28, 1, '&lt;strong&gt;test&lt;/strong&gt;', '2017-10-14 14:28:18', '&quot;la folie&quot; c\'est la vie', 2);

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `numero_episode` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_maj` datetime DEFAULT NULL,
  `contenu` text NOT NULL,
  `nbre_commentaires` int(11) NOT NULL,
  `nbre_signalements` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `numero_episode`, `titre`, `etat`, `date_creation`, `date_maj`, `contenu`, `nbre_commentaires`, `nbre_signalements`) VALUES
(28, 1, 'Alaska me voil&agrave; !', 1, '2017-10-12 10:55:34', '2017-10-13 14:09:41', '<p><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 13, 21),
(38, 2, 'C\'est le &quot;2eme&quot;', 1, '2017-10-12 16:34:41', '2017-10-13 11:09:09', '<p><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to m<span style=\"text-decoration: underline;\"><strong><em>ake a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</em></strong></span></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 0, 0),
(41, 3, '3eme', 1, '2017-10-12 16:48:06', '2017-10-13 11:09:17', '<p>zeffefe</p>', 0, 0),
(60, 6, '6eme', 0, '2017-10-14 15:31:04', '2017-10-14 15:31:04', '<p>jleakgj,eg</p>', 0, 0),
(59, 5, '5eme', 0, '2017-10-14 15:30:52', '2017-10-14 15:30:52', '<p>uozfheoiearg</p>', 0, 0),
(58, 4, 'dgjdgj', 1, '2017-10-13 14:24:15', '2017-10-13 14:24:15', '<p>dgjdgj</p>', 1, 1),
(61, 7, '7eme', 1, '2017-10-14 15:31:14', '2017-10-14 15:31:14', '<p>eagegearg</p>', 0, 0),
(62, 8, '8eme', 1, '2017-10-14 15:31:25', '2017-10-14 15:31:25', '<p>azaeg</p>', 0, 0),
(63, 9, '9eme', 0, '2017-10-14 15:31:35', '2017-10-14 15:31:35', '<p>egearg</p>', 0, 0),
(64, 10, '10eme', 1, '2017-10-14 15:31:49', '2017-10-14 15:31:49', '<p>eagegearg</p>', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `identifiant`, `password`) VALUES
(1, 'Xtif', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonnes_newsletter`
--
ALTER TABLE `abonnes_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonnes_newsletter`
--
ALTER TABLE `abonnes_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
