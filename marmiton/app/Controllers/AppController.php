<?php
/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 17/01/2017
 * Time: 11:15
 */

namespace Controllers;


use App\Controller;

use App\Table\Recipe;

/*Class intermédiaire$*/

class AppController extends Controller
{
    protected $template = 'default';

    public function __construct()
    {
         $this->viewPath= ROOT . '/app/Views/';
    }

    /* Fonction à utiliser plus tard  pour les model
     * Video 17:00
     *
    public function loadModel($model_name)
    {
        $this->$model_name = \App\Table\Recipe::getNomRecette();
    }*/
}