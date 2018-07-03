# Angular XML

Application de création de fichier XML complexes à la demande

## Introduction

Cette application est une application de production intervenant dans une chaine de production d'une entreprise. Elle utilise le framework AngularJs 1.6.1, Jquery 3.3.1 et bootstrap 3.3.7.

## Prérequis

Il est nécessaire d'avoir une connexion internet, Apache, php 5 mini et un SGBD (gestionnaire de base de donnée) type MAMP pour Mac pour que l'app soit fonctionnelle. Quelques étapes de configuration sont nécessaires avant de commencer.


## Installation

Tout d'abord il faut créer la base de donnée dans votre SGBD

```
CREATE DATABASE 'nom' IF NOT EXISTS
```

Ensuite, il faut insérer le script sql fourni 'bdd.sql' dans cette base

```
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Table structure for table `categories`
--
.....
```

Une fois ceci fait, il faut lier votre base à l'application, tout se passe dans le fichier localisé ici : 'backend/libs/config.php'

```
$BDD_host="host";
$BDD_user="user";
$BDD_password="password";
$BDD_base="nom";
```

# Premiers Pas

## Configuration

### Champs

L'interface est assez intuitive bien que simpliste. Plusieurs views, la première étape reste l'ajout des champs possibles, ceux qui vont être utilisés dans toutes les fonctions.

Vous pouvez soit les ajouter manuellement dans le SGBD mais une vue à été prévue pour cela. Entrez y les différentes informations du champs :

![](https://image.noelshack.com/fichiers/2018/27/2/1530613743-capture-d-ecran-2018-07-03-a-12-28-37.png)
---
A noter que pour le moment, seulement les champs de type Text et Select ont été testés

### Fonctions

Une fois ceci fait, vous pouvez utiliser tous ces champs dans des fonctions, les fonctions qui seront ensuite utilisées dans les modèles. Pour les créer, une interface similaire a été développée :

![](https://image.noelshack.com/fichiers/2018/27/2/1530616387-capture-d-ecran-2018-07-03-a-13-12-40.png)




### Catégories

Les catégories ont pour seul intêret de classer les modèles pour les organiser plus ergonomiquement :

![](https://image.noelshack.com/fichiers/2018/27/2/1530616947-capture-d-ecran-2018-07-03-a-13-22-14.png)




### Modèles

Nous voici au coeur du sujet, les modèles constituent le raccourci de création de fichiers XML, c'est l'outil principal de l'application. Voici le formulaire de création :

![](https://image.noelshack.com/fichiers/2018/27/2/1530616618-capture-d-ecran-2018-07-03-a-13-16-40.png)



## Utilisation

Une fois les modèle créés, vous avez en votre possession un outil de création de fichier XML performant et très rapide. l'interface principale se présente de la manière suivante :

![](https://image.noelshack.com/fichiers/2018/27/2/1530617411-capture-d-ecran-2018-07-03-a-13-29-46.png)

Pour chaque modèle, 3 actions sont possibles :
* Copier le modèle

* Créer le fichier XML lié au modèle

* Supprimer le modèle

# Création des fichiers XML

Rien de plus simple, un simple formulaire recensant les différentes fonctions aisin que leurs champs respectifs, chaque champs à une valeur par défaut : false, pour que si vous ne vouliez pas renseigner celui-ci, ce soit facilement détectable dans l'XML.
Voici un formulaire type :

![](https://image.noelshack.com/fichiers/2018/27/2/1530618009-capture-d-ecran-2018-07-03-a-13-39-16.png)

Une fois tout ceci rempli, vous avez votre fichier XML créé et pret à l'emploi :

```
<?xml version="1.0" encoding="utf-8"?>
<Infos_Modele nom="ModèleTest" description="ceci est un test"/>
<Addblanc>
  <down>false</down>
  <left>false</left>
  <right>false</right>
  <up>false</up>
</Addblanc>
```

Cet exemple de contient qu'une fonction mais on peut aller beaucoup plus loin dans la démarche, comme un modèle avec beaucoup plus de  fonctions :
```
<?xml version="1.0" encoding="utf-8"?>
<Infos_Modele nom="ModeleRollUp" description="Modèle typique des RollUp"/>
<Addblanc>
  <down>false</down>
  <left>false</left>
  <right>false</right>
  <up>false</up>
</Addblanc>
<AddCropLine>
  <distance_du_bas>false</distance_du_bas>
</AddCropLine>
<AddCropMarksExt>
  <left_down_horizontal>false</left_down_horizontal>
  <left_down_vertical>false</left_down_vertical>
  <left_up_horizontal>false</left_up_horizontal>
  <left_up_vertical>false</left_up_vertical>
  <right_down_horizontal>false</right_down_horizontal>
  <right_down_vertical>false</right_down_vertical>
  <right_up_horizontal>false</right_up_horizontal>
  <right_up_vertical>false</right_up_vertical>
</AddCropMarksExt>
<AddCropMarksInt>
  <left_down_horizontal>false</left_down_horizontal>
  <left_down_vertical>false</left_down_vertical>
  <left_up_horizontal>false</left_up_horizontal>
  <left_up_vertical>false</left_up_vertical>
  <right_down_horizontal>false</right_down_horizontal>
  <right_down_vertical>false</right_down_vertical>
  <right_up_horizontal>false</right_up_horizontal>
  <right_up_vertical>false</right_up_vertical>
</AddCropMarksInt>
<AddFoldLine>
  <distance_du_bas>false</distance_du_bas>
</AddFoldLine>
<AddMachineLine>
  <distance_du_bas>false</distance_du_bas>
</AddMachineLine>
<AddText>
  <distance_du_bord>false</distance_du_bord>
  <down>false</down>
  <left>false</left>
  <right>false</right>
  <up>false</up>
</AddText>
<CheckResolution>
  <max>1</max>
  <min>1</min>
</CheckResolution>
<Dimensions>
  <hauteur>false</hauteur>
  <largeur>false</largeur>
</Dimensions>
<Miroir>
  <down>false</down>
  <left>false</left>
  <right>false</right>
  <up>false</up>
</Miroir>
<Preflight>
  <value>false</value>
</Preflight>
<Rotation>
  <rotation>false</rotation>
</Rotation>
```

Ce type de fichier XML peut constituer un excellent fichier de configuration pour beaucoup de logiciels / schémas de production.









## Frameworks utilisés

* [AngularJs 1.6.1](https://angularjs.org/) - framework web
* [Jquery 3.3.1](https://jquery.com/) - Modals
* [Bootstrap 3.3.7](https://getbootstrap.com/) - Modals

## Auteur

* **Barczyk Alexandre** - *Developpeur* - [Profil](https://github.com/Abarczyk)
