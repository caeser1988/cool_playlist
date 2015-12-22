-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Dez-2015 às 11:25
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `playlist`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `playlist_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`playlist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_playlist_tracks`
--

CREATE TABLE IF NOT EXISTS `rel_playlist_tracks` (
  `rel_playlist_tracks_id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `rel_playlist_tracks_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`rel_playlist_tracks_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `track_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_title` varchar(50) NOT NULL,
  `track_image_file` varchar(50) NOT NULL,
  `track_bit_rate` varchar(50) NOT NULL,
  `track_copyright_c` varchar(50) NOT NULL,
  `track_composer` varchar(50) NOT NULL,
  `track_lyricist` varchar(50) NOT NULL,
  `track_publisher` varchar(50) NOT NULL,
  `track_information` varchar(50) NOT NULL,
  `track_status_encoding` varchar(50) NOT NULL,
  `track_date_recorded` varchar(50) NOT NULL,
  `track_date_created` varchar(50) NOT NULL,
  `track_date_published` varchar(50) NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `album_title` varchar(50) NOT NULL,
  `license_id` varchar(50) NOT NULL,
  `license_parent_id` varchar(50) NOT NULL,
  `license_title` varchar(50) NOT NULL,
  `license_url` varchar(50) NOT NULL,
  `track_code` varchar(255) NOT NULL,
  `track_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Extraindo dados da tabela `tracks`
--

INSERT INTO `tracks` (`track_id`, `track_title`, `track_image_file`, `track_bit_rate`, `track_copyright_c`, `track_composer`, `track_lyricist`, `track_publisher`, `track_information`, `track_status_encoding`, `track_date_recorded`, `track_date_created`, `track_date_published`, `artist_name`, `album_title`, `license_id`, `license_parent_id`, `license_title`, `license_url`, `track_code`, `track_status`) VALUES
(44, 'one horse', 'https://freemusicarchive.org/file/images/artists/G', '320000', '', '', '', '', '', 'complete', '', '12/21/2015 11:34:22 PM', '12/21/2015 11:39:35 PM', 'Granpa Abela', '', '16', '5', 'Attribution-Noncommercial-Share Alike 3.0 United S', 'http://creativecommons.org/licenses/by-nc-sa/3.0/u', '129671', 0),
(45, 'Wondertaker- Live at Alternative Arts Gallery (All', 'https://freemusicarchive.org/file/images/albums/Wo', '320000', '', '', '', '', '', 'complete', '', '12/20/2015 03:59:21 PM', '12/21/2015 10:52:22 PM', 'Wondertaker', 'Live at Alternative Art Gallery (Allentown, PA) De', '5', '5', 'Attribution-NonCommercial-ShareAlike 3.0 Internati', 'http://creativecommons.org/licenses/by-nc-sa/3.0/', '129669', 0),
(46, 'Have A Really Crappy Christmas', 'https://freemusicarchive.org/file/images/artists/P', '192000', '', '', '', '', '', 'complete', '', '12/21/2015 10:06:52 PM', '12/21/2015 10:08:16 PM', 'Pete Galub', '', '16', '5', 'Attribution-Noncommercial-Share Alike 3.0 United S', 'http://creativecommons.org/licenses/by-nc-sa/3.0/u', '129670', 0),
(47, 'paranoiaXVI', 'https://freemusicarchive.org/file/images/tracks/Tr', '206623', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:27 PM', '12/21/2015 08:03:24 PM', 'The Fucked Up Beat', 'thesadnessofca pitalismisthe attachm ntsweaccumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129667', 0),
(48, 'paranoiaXVII', 'https://freemusicarchive.org/file/images/tracks/Tr', '227507', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:27 PM', '12/21/2015 08:03:23 PM', 'The Fucked Up Beat', 'thesadnessofc apitalismist eattach mentswe accumul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129665', 0),
(49, 'paranoiaXXVI', 'https://freemusicarchive.org/file/images/tracks/Tr', '192531', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:28 PM', '12/21/2015 08:03:24 PM', 'The Fucked Up Beat', 'thesadnessofcapitalis mistheatt achmentsweaccumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129668', 0),
(50, 'paranoiaIX', 'https://freemusicarchive.org/file/images/tracks/Tr', '220996', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:27 PM', '12/21/2015 08:03:23 PM', 'The Fucked Up Beat', 'thesadne ssofcapitalismisthe attach mentsweaccumul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129666', 0),
(51, 'paranoiaXII', 'https://freemusicarchive.org/file/images/tracks/Tr', '221512', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:26 PM', '12/21/2015 08:03:22 PM', 'The Fucked Up Beat', 'thesadnessof capitalismisthea tachmentswe accumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129663', 0),
(52, 'paranoiaX', 'https://freemusicarchive.org/file/images/tracks/Tr', '205184', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:26 PM', '12/21/2015 08:03:23 PM', 'The Fucked Up Beat', 'thesadnessofcapital ismistheattac hments weaccumul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129664', 0),
(53, 'paranoiaXI', 'https://freemusicarchive.org/file/images/tracks/Tr', '233486', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:25 PM', '12/21/2015 08:03:22 PM', 'The Fucked Up Beat', 'thesad nessofcapitalismisth eattachment weaccumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129662', 0),
(54, 'paranoiaXXV', 'https://freemusicarchive.org/file/images/tracks/Tr', '224012', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:25 PM', '12/21/2015 08:03:21 PM', 'The Fucked Up Beat', 'thesadnessofca pitalismi stheattac hmentsweaccumul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129661', 0),
(55, 'paranoiaVIII', 'https://freemusicarchive.org/file/images/tracks/Tr', '235138', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:24 PM', '12/21/2015 08:03:21 PM', 'The Fucked Up Beat', 'thesad nessofcapitali smi stheattach mentsweaccu m', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129660', 0),
(56, 'paranoiaXXII', 'https://freemusicarchive.org/file/images/tracks/Tr', '220011', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:24 PM', '12/21/2015 08:03:20 PM', 'The Fucked Up Beat', 'thesadness ofcapitalis misthea tachme ntsweaccu mu', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129659', 0),
(57, 'paranoiaIII', 'https://freemusicarchive.org/file/images/tracks/Tr', '191019', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:23 PM', '12/21/2015 08:03:20 PM', 'The Fucked Up Beat', 'thesadnesso fcapitalism stheattachmen tsweaccum ul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129657', 0),
(58, 'paranoiaXXI', 'https://freemusicarchive.org/file/images/tracks/Tr', '221803', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:23 PM', '12/21/2015 08:03:20 PM', 'The Fucked Up Beat', 'thesadnessof capitalis mistheattachme tsweaccumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129658', 0),
(59, 'paranoiaXXVII', 'https://freemusicarchive.org/file/images/tracks/Tr', '228528', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:23 PM', '12/21/2015 08:03:19 PM', 'The Fucked Up Beat', 'thesadnessofc apitalismisth eattachmen sweaccumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129656', 0),
(60, 'paranoiaV', 'https://freemusicarchive.org/file/images/tracks/Tr', '227366', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:22 PM', '12/21/2015 08:03:19 PM', 'The Fucked Up Beat', 'thesadnessofc apitalismist heattachmentswea ccumul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129655', 0),
(61, 'paranoiaXXIII', 'https://freemusicarchive.org/file/images/tracks/Tr', '217476', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:22 PM', '12/21/2015 08:03:18 PM', 'The Fucked Up Beat', 'thesadnessofcapi talismist heattachment sweaccumul', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129653', 0),
(62, 'paranoiaXIX', 'https://freemusicarchive.org/file/images/tracks/Tr', '219788', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:22 PM', '12/21/2015 08:03:18 PM', 'The Fucked Up Beat', 'thesadness ofcapitalism istheat achmentsweaccumula', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129654', 0),
(63, 'paranoiaXV', 'https://freemusicarchive.org/file/images/tracks/Tr', '209283', '', '', '', '', '', 'complete', '', '12/21/2015 07:57:21 PM', '12/21/2015 08:03:17 PM', 'The Fucked Up Beat', 'thesadnes sofcapit alismistheat tachment sweaccumu', '127', '3', 'Attribution-ShareAlike', 'http://creativecommons.org/licenses/by-sa/4.0/', '129652', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
