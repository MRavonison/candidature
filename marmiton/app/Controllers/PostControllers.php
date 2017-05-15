<?php
/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 17/01/2017
 * Time: 10:53
 */

namespace Controllers;

use App\Table\Recipe;

class PostControllers extends AppController
{
    /*Fonction à utiliser plus tard  pour les model
     * Video 17:00
     * public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');

    }*/

    public function homeView()
    {
        $recipes = new Recipe();
        $posts = $recipes->getNomRecette();

        $this->render('homeView', array(
            'posts' => $posts
        ));
    }

    public function create_recipeView()
    {
        $this->render('create_recipeView');
    }

    public function search_recipeView()
    {
        $this->render('search_recipeView');
    }

    public function recipeController()
    {
        $recipController = new RecipeController();
        $recipController->recipePost($_POST);
    }


}
