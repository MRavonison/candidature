/*
Les variables speciales :

$_GET
$_POST
$_FILE
$_SESSION

Projet 3W Restaurant
====================
Liens intéressants
------------------

- Upload de fichiers en PHP :
http://www.php.net/manual/en/features.file-upload.post-method.php

- Veille Intégration HTML/CSS et JavaScript :
https://uptodate.frontendrescue.org/


http://www.crazyegg.com/

http://www.eyrolles.com/Informatique/Livre/design-d-experience-utilisateur-9782212141764

UX Design :
http://www.eyrolles.com/Informatique/Livre/design-d-experience-utilisateur-9782212141764

- Learning PHP, MySQL and JavaScript :
http://shop.oreilly.com/product/0636920036463.do
http://www.amazon.com/Learning-PHP-MySQL-JavaScript-Javascript/dp/1491918667

- OWASP :
https://www.owasp.org/index.php/Category:OWASP_Top_Ten_Project

Objectif
--------

Construire le site de e-commerce d'un restaurant permettant de réserver en ligne une table et d'acheter (puis se faire livrer) des produits alimentaires.

Le site sert autant aux clients qu'aux salariés du restaurant qui, quand ils se connecteront, pourront suivre les commandes, les réservations, le catalogue de produits alimentaires.



Organisation des dossiers et fichiers
-------------------------------------

/application							Code source de l'application
	/config								Configuration de l'application
    	database.php					Configuration base de données (identifiants de connexion)
    /controllers						Le C de MVC, les chefs d'orchestres de l'application / gére tous ce qui est en HTTP
    /models								Le M de MVC, le coeur de l'application
    	MealModel.class.php				Classe de gestion du catalogue de produits alimentaires
    /www								Le V de MVC, les fichiers statiques (HTML, CSS, JS, images, fonts, etc.) / Vue de l'application
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

UserServiceModel
----------------

- Créer une classe UserServiceModel
- Créer une méthode signUp() avec en arguments : $firstName, $lastName, $address, $city, $zipCode, $phone, $birthDate, $email, $password
- Créer une instance de la classe CustomerModel
- Appeler correctement la méthode create() de la classe CustomerModel

- Dans la méthode signUp(), avant la création du compte client et utilisateur il faut vérifier que l'e-mail saisi n'est pas déjà utilisé pour un compte utilisateur existant

*** Ecrire le code au tout début de signUp() ***

- Créer une requête SQL SELECT qui recherche un compte utilisateur en fonction de l'e-mail saisi
- Instancier la classe Database
- Combien la requête renvoie de ligne tout au plus ? Si plusieurs lignes alors il faut appeler query() sinon queryOne() de la classe Database
- Afficher echo "Erreur : e-mail déjà utilisé" suivi d'un exit() si jamais un compte utilisateur a bien été trouvé

Tester en tentant de créer un compte client + utilisateur non existant, puis en créant avec un utilisateur déjà existant

Objectif : afficher le message :

Votre compte client a bien été créé.

Sur la page d'accueil, une fois que le compte client a été créé en base de données

- Créer une méthode login() avec les arguments $email et $password

Créer une instance de la classe UserAccountModel
- Appeler la méthode findWithCredentials() et récupérer le résultat dans la variable $userAccount

- Est-ce que le compte utilisateur est celui d'un client ou d'un administrateur ?
- Si c'est un client :
- Créer une instance de la classe CustomerModel
- Appeler la méthode find() de la classe CustomerModel
- Initialiser $firstName et $lastName avec le prénom et le nom du client

- Dans la méthode signUp(), il y a un test pour vérifier s'il n'y a pas déjà un compte utilisateur avec l'adresse email saisie

- Remplacer le code du test par la création d'une exception de la classe DomainException() avec le message :

"Il existe déjà un compte utilisateur avec cette adresse e-mail"

CustomerModel
-------------

- Créer une méthode create() avec en arguments : $firstName, $lastName, $address, $city, $zipCode, $phone, $birthDate
- Créer une instance de la classe Database

- Construire une variable $sql avec la requête SQL INSERT dans la table Customer

- Appeler la méthode executeSql() de la classe Database : il faut fournir la variable $sql et un tableau pour venir remplacer les points d'interrogation, le tableau a les éléments dans le même ordre que les points d'interrogation

- La méthode executeSql() renvoie l'id généré pour la nouvelle ligne (la clé primaire), le stocker dans une variable $customerId

- Renvoyer la variable $customerId

Créer la méthode find() avec un argument $customerId

- Construire la requête SQL qui récupère les données du client ayant l'id spécifié dans $customerId
Colonnes SQL FirstName, LastName, Address, City, ZipCode, Phone, BirthDate

- Appeler la méthode queryOne() pour lire la ligne dans la base de données et renvoyer le résultat



UserAccountModel
----------------

- Méthode create()
- Créer une variable locale $passwordHash et appeler correctement la méthode privée hashPassword() de la classe
- Utiliser la variable locale $passwordHash pour la valeur de la colonne SQL Password


D'autres dossiers et fichiers vont apparaître au fur et à mesure dans le dossier "application"

UserSession
-----------

- Créer une méthode isAuthenticated() qui permet de savoir si l'utilisateur est loggué (authentifié) ou pas
- La méthode renvoie true s'il y a des données dans $_SESSION['user'] sinon elle renvoie false

- Créer une méthode getXXXX() permettant de récupérer chaque partie de la session utilisateur, par exemple getEmail()
- Pour chaque méthode il faut vérifier si l'utilisateur est loggué : si ce n'est pas le cas il faut renvoyer null
- Sinon il faut renvoyer les données dans $_SESSION['user']

- Ajouter une méthode getFullName() également qui renvoie d'un coup et le prénom et le nom de l'utilisateur loggué (séparé par un espace)

LoginController
---------------

- httpPostMethod()
- Créer une instance de la classe UserServiceModel
- Appeler la méthode login() de la classe UserServiceModel, en spécifiant les données de formulaire

UserController
--------------

- Implémenter la validation de formulaire comme dans LoginController :

- Ecrire le code nécessaire dans les deux méthodes httpGetMethod() et httpPostMethod()
- Utiliser la classe UserForm (voir instructions en-dessous)

UserForm
--------

- Créer une classe UserForm qui déclare les champs de formulaires suivants :

lastName, firstName, address, city, zipCode, phone, email



===> Tester en tentant de créer un compte client avec un email déjà utilisé.

UserView
--------

- Implémenter la validation de formulaire comme dans LoginView :

- Ajouter le <aside> au début du formulaire

    - Ajouter une variable en echo pour chaque champ de formulaire, la variable s'appelle comme ce qui est écrit dans la classe UserForm

    - Mettre de côté la date de naissance et le mot de passe, l'utilisateur devra les ressaisir




autres :

    <script>

        // JAVASCRIPT


        // OBJET CONTENEUR

        // Syntaxe longue
        contact = new Object();
        contact.firstName = 'Tom';			// objet
        contact.lastName  = 'HARDY';

        // Syntaxe raccourcie
        contact = { firstName : 'Tom', lastName : 'HARDY' };

        // TABLEAU ASSOCIATIF

        // Syntaxe longue
        contact = new Array();
        contact['firstName'] = 'Tom';			// tableau associatif ou dictionnaire
        contact['lastName'] = 'HARDY';

        // Syntaxe raccourcie
        contact = [ 'firstName' : 'Tom', 'lastName' : 'Catherine' ];

        // TABLEAU DE DONNEES

        // Syntaxe longue
        prenoms = new Array();
        prenoms[0] = 'Tom';
        prenoms[1] = 'Catherine';

        // Syntaxe raccourcie
        prenoms = [ 'Tom', 'Catherine' ];

    </script>




<?php

// PHP


// OBJET CONTENEUR

$contact = new StdClass();
$contact->firstName = 'Tom';
$contact->lastName  = 'HARDY';



// TABLEAU ASSOCIATIF

// Syntaxe longue
$contact = array();
$contact['firstName'] = 'Tom';			// tableau associatif ou dictionnaire
$contact['lastName'] = 'HARDY';

// Syntaxe raccourcie
$contact = [ 'firstName' => 'Tom', 'lastName' => 'Catherine' ];


// TABLEAU DE DONNEES

// Syntaxe longue
$prenoms = array();
$prenoms[0] = 'Tom';
$prenoms[1] = 'Catherine';

// Syntaxe raccourcie
$prenoms = [ 'Tom', 'Catherine' ];
