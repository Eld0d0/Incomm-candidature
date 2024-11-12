# wordpress
 
# Projet WordPress de Recettes

Ce projet est un site WordPress de recettes avec un custom post type et des champs personnalisés, développé pour un recrutement ches Incomm.

## Prérequis

- PHP 8.0 ou plus
- Serveur Apache ou Nginx
- MySQL >= 5.7
- [WordPress](https://wordpress.org/download/) (installer la dernière version)
- Un environnement de développement local (MAMP, WAMP, XAMPP, etc.)

## Installation

### 1. Clonez le dépôt

```bash
git clone https://github.com/Eld0d0/Incomm-candidature.git
cd nom-du-repo
```
### 2. Configurez la Base de Données

Créez une nouvelle base de données dans votre environnement local (ex : wordpress_recette).
Importez le fichier de base de données database/db.sql.zip dans la base de données créée (via phpMyAdmin ou une autre interface).

### 3. Configurez le fichier wp-config.php

Renommez wp-config-sample.php en wp-config.php.
Ouvrez wp-config.php et modifiez les valeurs suivantes en fonction de votre configuration locale :
```
define('DB_NAME', 'votre_nom_de_base_de_donnees');
define('DB_USER', 'votre_nom_d_utilisateur');
define('DB_PASSWORD', 'votre_mot_de_passe');
define('DB_HOST', 'localhost');
```


### 4. Lancer WordPress

Lancez votre serveur local (MAMP, WAMP, XAMPP, etc.).
Accédez à l'URL du site dans votre navigateur (par exemple : http://localhost/nom-du-repo).


## Structure du projet

wp-content/themes/hello-elementor-child - Le thème WordPress personnalisé pour ce projet.
database/db.sql.zip - Fichier de la base de données exportée.
index.php - Modèle de page pour l'accueil.
single-recette.php - Modèle de page pour afficher les recettes en détail.


## Usage

Accéder à la page d'accueil
La page d'accueil affiche les dernières recettes ajoutées avec l’image, le titre et un extrait.

Page de Détail des Recettes
Chaque recette possède une page dédiée pour afficher les ingrédients, le temps de cuisson et les étapes.

## Dépendances

Ce projet utile le thème Hello elementor comme base, et la librairie Slick slider, pour le slider de la page d'accueil.


## Points d'amélioration

Avec plus de temps, le projet pour être amélioré visuellement.
Nous pouvons également envisager l'ajout d'un champ temps de préparation, des catégories, ou encore améliorer le champ CPT de la liste d'ingrédients ou d'étapes afin de le rendre plus simple d'utilisation pour un utilisateur novice.


## Aide

En cas de problèmes lors de l'installation, contactez-moi ou consultez la documentation WordPress.

