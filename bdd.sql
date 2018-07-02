-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2018 at 02:52 PM
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
(7, 'cat1', 'modele5555'),
(8, 'cat2', ''),
(10, 'RollUp', ''),
(11, 'dzqfegrsdhtjyu', '');

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
  `valeur` varchar(2000) DEFAULT 'non',
  `default_select` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `champs`
--

INSERT INTO `champs` (`id`, `nom`, `typeinput`, `unit`, `name`, `valeur`, `default_select`) VALUES
(1, 'rotation à gauche', 'text', 'mm', 'left', 'non', NULL),
(2, 'rotation à droite', 'text', 'mm', 'right', 'non', NULL),
(3, 'rotation supérieure', 'text', 'mm', 'up', 'non', NULL),
(4, 'rotation inférieure', 'text', 'mm', 'down', 'non', NULL),
(5, 'longueur', 'text', 'mm', 'value', 'non', NULL),
(6, 'angle', 'text', 'degrès', 'angle', 'non', NULL),
(7, 'Nom', 'text', '', 'customerfirstname', 'non', NULL),
(8, 'Prenom', 'text', '', 'customerlastname', 'non', NULL),
(10, 'Ajouter blanc en haut', 'text', 'mm', 'AddBlancUp', 'non', NULL),
(11, 'Ajouter blanc en bas', 'text', 'mm', 'AddBlancDown', 'non', NULL),
(12, 'Ajouter blanc à gauche', 'text', 'mm', 'AddBlancLeft', 'non', NULL),
(13, 'Ajouter un blanc à droite', 'text', 'mm', 'AddBlancRight', 'non', NULL),
(14, 'Convertir en RVB', 'text', '', 'ConvertRVB', 'non', NULL),
(15, 'Ajouter une ligne de coupe en haut à gauche (verticale)', 'text', 'mm', 'AddCropMarcUp_Left_Vertical', 'non', NULL),
(16, 'Ajouter une ligne de coupe en haut à gauche (horizontale)', 'text', 'mm', 'AddCropMarcUp_Left_Horizontal', 'non', NULL),
(17, 'Ajouter une ligne de coupe en bas à gauche (honrizontale)', 'text', 'mm', 'AddCropMarcDown_Left_Horizontal', 'non', NULL),
(18, 'Ajouter une ligne de coupe en bas à gauche (verticale)', 'text', 'mm', 'AddCropMarcDown_Left_Vertical', 'non', NULL),
(19, 'Ajouter une ligne de coupe en haut à droite (verticale)', 'text', 'mm', 'AddCropMarcUp_Right_Vertical', 'non', NULL),
(20, 'Ajouter une ligne de coupe en haut à droite (horizontale)', 'text', 'mm', 'AddCropMarcUp_Right_Horizontal', 'non', NULL),
(21, 'Ajouter une ligne de coupe en bas à droite (verticale)', 'text', 'mm', 'AddCropMarcDown_Right_Vertical', 'non', NULL),
(22, 'Ajouter une ligne de coupe en bas à droite (horizontale)', 'text', 'mm', 'AddCropMarcDown_Right_Horizontal', 'non', NULL);

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
(1, 'addmirror', 'Ajouter un mirroir', 'left,right,up,down'),
(2, 'rotate', 'Ajouter une rotation', 'value,angle'),
(3, 'customerinfo', 'Ajouter des informations utilisateur', 'customerfirstname,customerlastname,test_test'),
(9, 'AddBlanc', 'Ajouter des blancs sur les bords', 'AddBlancUp,AddBlancDown,AddBlancLeft,AddBlancRight'),
(10, 'AddCropMarc', 'Ajoute des lignes de coupe sur l\'image', 'AddCropMarcUp_Left_Vertical,AddCropMarcUp_Left_Horizontal,AddCropMarcDown_Left_Horizontal,AddCropMarcDown_Left_Vertical,AddCropMarcUp_Right_Vertical,AddCropMarcUp_Right_Horizontal,AddCropMarcDown_Right_Vertical,AddCropMarcDown_Right_Horizontal'),
(13, 'coucou', 'coucou', 'AddBlancLeft,AddBlancDown,AddBlancUp,AddBlancRight,AddCropMarcDown_Right_Horizontal,AddCropMarcDown_Right_Vertical,AddCropMarcDown_Left_Horizontal,AddCropMarcDown_Left_Vertical,AddCropMarcUp_Right_Horizontal,AddCropMarcUp_Right_Vertical,AddCropMarcUp_Left_Horizontal,AddCropMarcUp_Left_Vertical,angle,ConvertRVB,value,customerfirstname,customerlastname,right,left,down,up,test_test');

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
(38, 'modele5555', 'aefrzthry', 'AddBlanc,AddCropMarc,addmirror');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `champs`
--
ALTER TABLE `champs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `fonctions`
--
ALTER TABLE `fonctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
