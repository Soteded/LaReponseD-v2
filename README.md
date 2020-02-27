# LaReponseD-v2

## Présentation
LaReponseD est un site de quiz, où les utilisateurs pourront créer leur propre Quiz et participé à ceux des autres membres.

Le projet choisit devra obligatoirement se composer :
* d’unebase de données
* utilisationde librairie JavaScript
* d’unsystème d’authentificationdifficulté:2
* des pages permettant à l’administrateur de:difficulté:5
    * gérer les utilisateurs 
    * gérer le contenu 
* des pages permettant aux utilisateursde :difficulté:5
    * modifier leur profil
    * gérer le contenu
* desfonctionnalités mettant en avant vos compétences enalgorithmie
* envoide maildifficulté:2

## Techno utilisé
  * Laravel
  * Mysql
  * Bootstrap
  * NodeJS
  * PHP

## Fonctionnalités 

1. Quiz:
    * Titre
    * Categorie
    * Image
    * Note
    * Commentaire
    * Questions
        * Choix

2. Utilisateurs:
    * Chaque utilisateur possède:
        * Pseudo
        * Avatar
        * Adresse mail
        * Date de naissance
        * Role   
    * Ils peuvent faire:
        * un Quiz (CRUD)
            * Titre
            * Catégorie
            * Questions
                * Choix
        * Modifier leur profile
            * Pseudo
            * Adresse mail
            * Date de naissance
        * Noter un Quiz
        * Laisser un commentaire

3. Administrateur:
    * Les Admin peuvent :
        * CRUD sur tout les utilisateurs
            * Pseudo
            * Avatar
            * Adresse mail
            * Date de naissance
            * Role
        * CRUD sur tout les Quizs
            * Titre
            * Categorie
            * Image
            * Note
            * Commentaire
            * Questions
                * Choix
    * Informations : 
        * Liste des utilisateurs
        * Informations des Quizs

## Pages

Les pages auront automatiquement les boutons:
* Connection
* Profil
* Home

Le site aura comme page obligatoire :

* Page Accueil:
    * Catalogue des quizs
    * Recherche par nom de quiz/utilisateur
    * Filtre
* Page Contact
    * Sujet
    * Mail (si pas connecté)
    * Message
* Page de connexion/inscription
* Page de profil
* Page de Quiz
    * Participation
    * Mettre une note
    * Mettre un commentaire
* Page de Création de Quiz

L'administration aura :
* Page Tableau de bord
* Page des mzmbres
