<?php

// Save the project root directory as a global constant.

define('ROOT_PATH',__DIR__); //__DIR__ Permet de fixer la position du fichier , peut etre aussi appeler par : const ROOT = __DIR__;


/*
 * Create a global constant used to get the filesystem path to the
 * application configuration directory.
 */


define('CFG_PATH', realpath(ROOT_PATH.'/application/config'));

$wwwUrl ='/programmation/big-project/e-commerce/application/www';
include CFG_PATH.'/database.php';

//include ROOT_PATH.'/library/Database.class.php';/*voir ci-dessous*/
//include ROOT_PATH.'/application/models/MealModel.class.php'; /*voir ci-dessous*/
// autoload permet de ne plus gerer les includes ci-dessus, dont surtout l'ordre qui deviendra complexe


spl_autoload_register(function($class)
{
    if(substr($class,-5)=='Model')
    {
        $classFileName  = ROOT_PATH ."/application/models/$class.class.php"; //  les (" ") est de l'interpolation, il permet d'eviter la concatenation voir dev doc spl_autoload_register
    }
    else
    {
        $classFileName  = ROOT_PATH."/library/$class.class.php";
    }
        include $classFileName;
});


$mealModel  = new MealModel();
$meals      = $mealModel->listAll($config); // il faut une variable pour stocker une valeur




// voir HomeView.phtml dans le main
$template   = ROOT_PATH.'/application/www/HomeView.phtml';













include ROOT_PATH.'/application/www/LayoutView.phtml';