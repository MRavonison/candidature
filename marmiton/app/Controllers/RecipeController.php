<?php
/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 23/01/2017
 * Time: 14:12
 */

namespace Controllers;

use App\Table\Recipe;
use App\Upload;

class RecipeController extends Upload
{
    public function recipePost(array $form)
    {
        if (!empty($_POST['nom_rec']) && !empty($_POST['e_mail'])
            && !empty($_POST['pseudo']) && !empty($_POST['descript']) )
        {
            if($this->getUploadFile('mon_img'))
            {
                $image = $this->moveUploadFile('mon_img');
            }
            else
            {
                $image = 'no-photo.png';
            }
            $recipe = new Recipe($_POST);
            $recipe->create(
                $form['nom_rec'],
                $form['pseudo'],
                $form['e_mail'],
                $form['descript'],
                $image
            );

            echo "<p>Données transmises</p>";
        }
        else
            {
                if (empty($_POST['nom_rec']))
                {
                    echo "<p>Erreur : Veuillez donner un nom à la recette </p>";
                }
                if (empty($_POST['pseudo']))
                {
                    echo "<p>Erreur : Veuillez donner un pseudo</p>";
                }
                if (empty($_POST['e_mail']))
                {
                    echo "<p>Erreur : Veuillez donner un email </p>";
                }
                if (empty($_POST['descript']))
                {
                    echo "<p>Erreur : Veuillez donner une description de la recette </p>";
                }
            }
        var_dump($_POST['mon_img']);
    }
}