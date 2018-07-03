-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2018 at 09:55 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `creationXml`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `modeles` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `modeles`) VALUES
(12, 'RollUp', 'ModeleRollUp'),
(13, 'Brochures', 'ModeleBrochures'),
(14, 'Cartes de visite', 'ModeleCard'),
(15, 'Affiches', 'ModeleAffiches'),
(16, 'Flyers', 'ModeleFlyers');

-- --------------------------------------------------------

--
-- Table structure for table `champs`
--

CREATE TABLE `champs` (
  `id` int(11) NOT NULL,
  `nom` varchar(2000) DEFAULT NULL,
  `typeinput` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `valeur` varchar(2000) DEFAULT 'false',
  `default_select` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `champs`
--

INSERT INTO `champs` (`id`, `nom`, `typeinput`, `unit`, `name`, `valeur`, `default_select`) VALUES
(25, 'Valeur', 'text', '', 'value', 'false', ''),
(27, 'Hauteur', 'text', 'mm', 'hauteur', 'false', ''),
(28, 'Largeur', 'text', 'mm', 'largeur', 'false', ''),
(29, 'Pages attendues', 'text', '', 'pages', '1', ''),
(30, 'Rotation', 'select', 'degrès', 'rotation', 'false', '0,90,180,270'),
(31, 'Left', 'text', 'mm', 'left', 'false', ''),
(32, 'Right', 'text', 'mm', 'right', 'false', ''),
(33, 'up', 'text', 'mm', 'up', 'false', ''),
(34, 'down', 'text', 'mm', 'down', 'false', ''),
(35, 'Left up horizontal', 'text', 'mm', 'left_up_horizontal', 'false', ''),
(36, 'Right up horizontal', 'text', 'mm', 'right_up_horizontal', 'false', ''),
(37, 'Left up vertical', 'text', 'mm', 'left_up_vertical', 'false', ''),
(38, 'Left down horizontal', 'text', 'mm', 'left_down_horizontal', 'false', ''),
(39, 'Left down vertical', 'text', 'mm', 'left_down_vertical', 'false', ''),
(40, 'Right down vertical', 'text', 'mm', 'right_down_vertical', 'false', ''),
(41, 'Right down horizontal', 'text', 'mm', 'right_down_horizontal', 'false', ''),
(42, 'Right up vertical', 'text', 'mm', 'right_up_vertical', 'false', ''),
(43, 'Min', 'text', '', 'min', '1', ''),
(44, 'Max', 'text', '', 'max', '1', ''),
(45, 'Distance du bas', 'text', 'mm', 'distance_du_bas', 'false', ''),
(46, 'Position', 'select', 'mm', 'position', 'false', 'Up,Down,Left,Right'),
(47, 'Distance du bord', 'text', 'mm', 'distance_du_bord', 'false', '');

-- --------------------------------------------------------

--
-- Table structure for table `fonctions`
--

CREATE TABLE `fonctions` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `champs` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonctions`
--

INSERT INTO `fonctions` (`id`, `nom`, `description`, `champs`) VALUES
(14, 'Preflight', '', 'value'),
(15, 'Template', 'zone de saisie unique', 'value'),
(16, 'Rotation', '', 'rotation'),
(17, 'Dimensions', '', 'hauteur,largeur'),
(18, 'NbPages', '', 'pages'),
(19, 'Miroir', '', 'down,left,right,up'),
(20, 'Addblanc', '', 'down,left,right,up'),
(21, 'AddCropMarksInt', '', 'left_down_horizontal,left_down_vertical,left_up_horizontal,left_up_vertical,right_down_horizontal,right_down_vertical,right_up_horizontal,right_up_vertical'),
(22, 'AddCropMarksExt', '', 'left_down_horizontal,left_down_vertical,left_up_horizontal,left_up_vertical,right_down_horizontal,right_down_vertical,right_up_horizontal,right_up_vertical'),
(23, 'CheckResolution', '', 'max,min'),
(24, 'AddFoldLine', '', 'distance_du_bas'),
(25, 'AddMachineLine', '', 'distance_du_bas'),
(26, 'AddCropLine', '', 'distance_du_bas'),
(27, 'AddText', '', 'distance_du_bord,down,left,right,up'),
(28, 'Enlarge', '', 'down,left,right,up');

-- --------------------------------------------------------

--
-- Table structure for table `modeles`
--

CREATE TABLE `modeles` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `fct` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modeles`
--

INSERT INTO `modeles` (`id`, `nom`, `description`, `fct`) VALUES
(40, 'ModeleBrochures', 'Modèle typique pour les brochures', 'Addblanc,CheckResolution,Dimensions,Preflight,Rotation'),
(42, 'ModeleCard', 'Modèle typique des cartes de visite', 'AddText,CheckResolution,Dimensions,Template'),
(43, 'ModeleAffiches', 'Modèle typique des affiches', 'Addblanc,AddCropLine,AddCropMarksExt,AddCropMarksInt,AddFoldLine,AddMachineLine,CheckResolution,Dimensions,Miroir,NbPages,Preflight,Rotation,Template'),
(44, 'ModeleRollUp', 'Modèle typique des RollUp', 'Addblanc,AddCropLine,AddCropMarksExt,AddCropMarksInt,AddFoldLine,AddMachineLine,AddText,CheckResolution,Dimensions,Miroir,Preflight,Rotation'),
(45, 'ModeleFlyers', 'Modèle typique des Flyers', 'AddText,CheckResolution,Dimensions,Rotation,Template');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `champs`
--
ALTER TABLE `champs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonctions`
--
ALTER TABLE `fonctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modeles`
--
ALTER TABLE `modeles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `champs`
--
ALTER TABLE `champs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `fonctions`
--
ALTER TABLE `fonctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
