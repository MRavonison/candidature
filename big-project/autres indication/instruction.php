/*

Projet 3W Restaurant
====================


Objectif
--------

Construire le site de e-commerce d'un restaurant permettant de réserver en ligne une table et d'acheter (puis se faire livrer) des produits alimentaires.

Le site sert autant aux clients qu'aux salariés du restaurant qui, quand ils se connecteront, pourront suivre les commandes, les réservations, le catalogue de produits alimentaires.



Organisation des dossiers et fichiers
-------------------------------------

/application							Code source de l'application
	/config								Configuration de l'application
    	database.php					Configuration base de données (identifiants de connexion)
    /controllers						Le C de MVC, les chefs d'orchestres de l'application
    /models								Le M de MVC, le coeur de l'application
    	MealModel.class.php				Classe de gestion du catalogue de produits alimentaires
    /www								Le V de MVC, les fichiers statiques (HTML, CSS, JS, images, fonts, etc.)
    	/css							Feuilles de styles CSS
        /fonts							Polices de caractères
        /images							Images
        /js								Code source JavaScript
        	/classes					Classes (code source orienté objet)
        HomeView.phtml					Template interne de la page d'accueil
        LayoutView.phtml				Template global
/library								Code source générique, réutilisable dans d'autres projets
	Database.class.php					Classe d'accès à la base de données
index.php								Code principal



D'autres dossiers et fichiers vont apparaître au fur et à mesure dans le dossier "application"