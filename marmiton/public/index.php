<?php

require '../app/Autoloader.php';

define('ROOT', __DIR__);
\App\Autoloader::register();

// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements
error_reporting(E_ALL);

if (isset($_GET['pages'])) {
    $pages = $_GET['pages'];
} else {
    $pages = 'home';
}


ob_start();

switch ($pages) {
    case "home":
        $controller = new \Controllers\PostControllers();
        $controller->homeView();
        break;
    case "create_recipeView":
        $controller = new \Controllers\PostControllers();
        $controller->create_recipeView();
        break;
    case "search_recipeView";
        $controller = new \Controllers\PostControllers();
        $controller->search_recipeView();
        break;
    case "RecipeController":
        $controller = new \Controllers\PostControllers();
        $controller->recipeController();
        break;
}

/**
 * recupere le contenu de la page
 */
//$content = ob_get_clean();

/**
 * on genere le templates par default
 */
//require '../app/Views/templates/default.php';
